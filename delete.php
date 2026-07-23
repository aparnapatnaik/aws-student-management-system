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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: list.php");
    exit();
}

include 'header.php';
?>

<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card shadow-sm border-danger">

            <div class="card-header bg-danger text-white">
                <h4 class="mb-0">Delete Student</h4>
            </div>

            <div class="card-body">

                <div class="alert alert-warning">
                    Are you sure you want to delete this student?
                </div>

                <table class="table table-bordered">

                    <tr>
                        <th>Name</th>
                        <td><?= htmlspecialchars($student['name']) ?></td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td><?= htmlspecialchars($student['email']) ?></td>
                    </tr>

                    <tr>
                        <th>Course</th>
                        <td><?= htmlspecialchars($student['course']) ?></td>
                    </tr>

                </table>

                <form method="POST">

                    <div class="d-flex justify-content-between">

                        <a href="list.php" class="btn btn-secondary">
                            Cancel
                        </a>

                        <button class="btn btn-danger">
                            Delete Student
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?php include 'footer.php'; ?>
