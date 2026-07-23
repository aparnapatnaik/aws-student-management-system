<?php
require 'config.php';

if (!isset($_GET['id'])) {
    header("Location: list.php");
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch();

if (!$student) {
    die("Student not found.");
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $course = trim($_POST['course']);

    if (empty($name) || empty($email) || empty($course)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {

        $stmt = $pdo->prepare("
            UPDATE students
            SET name = ?, email = ?, course = ?
            WHERE id = ?
        ");

        $stmt->execute([$name, $email, $course, $id]);

        header("Location: list.php");
        exit();
    }
}

include 'header.php';
?>

<div class="row justify-content-center">

<div class="col-md-7">

<div class="card shadow-sm">

<div class="card-header bg-warning">
<h4 class="mb-0">Edit Student</h4>
</div>

<div class="card-body">

<?php if($error): ?>

<div class="alert alert-danger">
<?= htmlspecialchars($error) ?>
</div>

<?php endif; ?>

<form method="POST">

<div class="mb-3">
<label class="form-label">Student Name</label>
<input
type="text"
name="name"
class="form-control"
value="<?= htmlspecialchars($student['name']) ?>"
required>
</div>

<div class="mb-3">
<label class="form-label">Email Address</label>
<input
type="email"
name="email"
class="form-control"
value="<?= htmlspecialchars($student['email']) ?>"
required>
</div>

<div class="mb-4">
<label class="form-label">Course</label>
<input
type="text"
name="course"
class="form-control"
value="<?= htmlspecialchars($student['course']) ?>"
required>
</div>

<div class="d-flex justify-content-between">

<a href="list.php" class="btn btn-secondary">
Cancel
</a>

<button class="btn btn-warning">
Update Student
</button>

</div>

</form>

</div>

</div>

</div>

</div>

<?php include 'footer.php'; ?>
