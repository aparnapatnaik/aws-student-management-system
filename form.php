<?php
require 'config.php';
require 's3_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $photo_url = "";

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {

        $fileName = time() . "_" . basename($_FILES["photo"]["name"]);

        try {

            $result = $s3->putObject([
                'Bucket'     => $bucketName,
                'Key'        => 'students/' . $fileName,
                'SourceFile' => $_FILES["photo"]["tmp_name"]
            ]);

            $photo_url = $result['ObjectURL'];

        } catch (Exception $e) {
            die("S3 Upload Failed: " . $e->getMessage());
        }
    }

    $stmt = $pdo->prepare("INSERT INTO students(name, email, course, photo_url)
                           VALUES (?, ?, ?, ?)");

    $stmt->execute([$name, $email, $course, $photo_url]);

    header("Location: list.php");
    exit;
}
?>

<?php include 'header.php'; ?>

<div class="card shadow p-4">

    <h2 class="mb-4">Add Student</h2>

    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Course</label>
            <input type="text" name="course" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Student Photo</label>
            <input type="file" name="photo" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">
            Add Student
        </button>

        <a href="list.php" class="btn btn-secondary">
            Back
        </a>

    </form>

</div>

<?php include 'footer.php'; ?>
