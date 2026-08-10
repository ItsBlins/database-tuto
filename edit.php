<?php include 'db.php'; 
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM students WHERE id=$id");
$row = $result->fetch_assoc();
?>
<h2>Edit Student</h2>
<form method="post">
  Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
  Email: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br>
  Course: <input type="text" name="course" value="<?php echo $row['course']; ?>"><br>
  <input type="submit" name="update" value="Update">
</form>

<?php
if(isset($_POST['update'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $course = $_POST['course'];
  $conn->query("UPDATE students SET name='$name', email='$email', course='$course' WHERE id=$id");
  header("Location: index.php");
}
?>
