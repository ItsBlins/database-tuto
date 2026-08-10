<?php include 'db.php'; ?>
<h2>Student List</h2>
<a href="add.php">Add New Student</a>
<table border="1" cellpadding="10">
<tr>
  <th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Action</th>
</tr>
<?php
$result = $conn->query("SELECT * FROM students");
while($row = $result->fetch_assoc()) {
  echo "<tr>
    <td>".$row['id']."</td>
    <td>".$row['name']."</td>
    <td>".$row['email']."</td>
    <td>".$row['course']."</td>
    <td>
      <a href='edit.php?id=".$row['id']."'>Edit</a> | 
      <a href='delete.php?id=".$row['id']."'>Delete</a>
    </td>
  </tr>";
}
?>
</table>
