<?php
require 'config.php';
$rows = $pdo->query("SELECT * FROM students ORDER BY id DESC")->fetchAll();
?>

<h2>Student List</h2>

<table border="1" cellpadding="10">
<tr>
  <th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Created</th>
</tr>

<?php foreach($rows as $r): ?>
<tr>
  <td><?= $r['id'] ?></td>
  <td><?= $r['name'] ?></td>
  <td><?= $r['email'] ?></td>
  <td><?= $r['course'] ?></td>
  <td><?= $r['created_at'] ?></td>
</tr>
<?php endforeach; ?>

</table>

<br>
<a href="form.php">Add New Student</a>
