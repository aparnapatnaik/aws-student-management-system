<?php
require 'config.php';
include 'header.php';

$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? 'id';

$allowedSort = ['id', 'name', 'email', 'course', 'created_at'];
if (!in_array($sort, $allowedSort)) {
    $sort = 'id';
}

$sql = "SELECT * FROM students
        WHERE name LIKE :search
           OR email LIKE :search
           OR course LIKE :search
        ORDER BY $sort ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':search' => "%$search%"
]);

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h2>Student List</h2>
        <a href="form.php" class="btn btn-primary">+ Add Student</a>
    </div>

    <form method="GET" class="row mb-3">

        <div class="col-md-5">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search..."
                value="<?= htmlspecialchars($search) ?>">
        </div>

        <div class="col-md-3">
            <select name="sort" class="form-select">

                <option value="id" <?= $sort=='id'?'selected':'' ?>>ID</option>
                <option value="name" <?= $sort=='name'?'selected':'' ?>>Name</option>
                <option value="email" <?= $sort=='email'?'selected':'' ?>>Email</option>
                <option value="course" <?= $sort=='course'?'selected':'' ?>>Course</option>
                <option value="created_at" <?= $sort=='created_at'?'selected':'' ?>>Date</option>

            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-success w-100">Search</button>
        </div>

    </form>

    <table class="table table-bordered table-striped table-hover">

        <thead class="table-dark">

        <tr>
            <th>#</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>

        </thead>

        <tbody>

        <?php
        $i = 1;

        foreach($students as $r):
        ?>

        <tr>

            <td><?= $i++ ?></td>

            <td>

                <?php if(!empty($r['photo_url'])): ?>

                    <img
                        src="<?= htmlspecialchars($r['photo_url']) ?>"
                        width="60"
                        height="60"
                        style="border-radius:50%; object-fit:cover;">

                <?php else: ?>

                    <img
                        src="https://via.placeholder.com/60"
                        width="60"
                        height="60"
                        style="border-radius:50%;">

                <?php endif; ?>

            </td>

            <td><?= htmlspecialchars($r['name']) ?></td>

            <td><?= htmlspecialchars($r['email']) ?></td>

            <td><?= htmlspecialchars($r['course']) ?></td>

            <td><?= date("d M Y", strtotime($r['created_at'])) ?></td>

            <td>

                <a href="edit.php?id=<?= $r['id'] ?>" class="btn btn-warning btn-sm">
                    Edit
                </a>

                <a href="delete.php?id=<?= $r['id'] ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Delete this student?');">
                    Delete
                </a>

            </td>

        </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?php include 'footer.php'; ?>
