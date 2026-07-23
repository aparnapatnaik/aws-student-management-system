<?php
require 'config.php';
require 's3_config.php';

use Aws\S3\Exception\S3Exception;

$name = "";
$email = "";
$course = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $course = trim($_POST['course']);

    if (empty($name) || empty($email) || empty($course)) {

        $error = "All fields are required.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Invalid email address.";

    } else {

        $photoUrl = "";

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {

            $fileName = time() . "_" . basename($_FILES["photo"]["name"]);

            try {

                $result = $s3->putObject([
                    'Bucket' => $bucketName,
                    'Key' => "students/" . $fileName,
                    'SourceFile' => $_FILES["photo"]["tmp_name"]
                ]);

                $photoUrl = $result['ObjectURL'];

            } catch (S3Exception $e) {

                $error = $e->getMessage();
            }

        }

        if (empty($error)) {

            $stmt = $pdo->prepare("
                INSERT INTO students
                (name,email,course,photo_url)
                VALUES (?,?,?,?)
            ");

            $stmt->execute([
                $name,
                $email,
                $course,
                $photoUrl
            ]);

            header("Location:list.php");
            exit();
        }

    }

}

include 'header.php';
?>

<div class="row justify-content-center">

<div class="col-md-7">

<div class="card shadow-sm">

<div class="card-header bg-primary text-white">

<h4>Add Student</h4>

</div>

<div class="card-body">

<?php if($error): ?>

<div class="alert alert-danger">

<?= htmlspecialchars($error) ?>

</div>

<?php endif; ?>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">

<label>Name</label>

<input
type="text"
name="name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Course</label>

<input
type="text"
name="course"
class="form-control"
required>

</div>

<div class="mb-4">

<label>Student Photo</label>

<input
type="file"
name="photo"
class="form-control"
accept="image/*">

</div>

<div class="d-flex justify-content-between">

<a href="list.php" class="btn btn-secondary">

Cancel

</a>

<button class="btn btn-primary">

Save Student

</button>

</div>

</form>

</div>

</div>

</div>

</div>

<?php include 'footer.php'; ?>
