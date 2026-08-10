<?php include 'db.php'; ?>
<h2>Add Student</h2>
<form method="post">
  Name: <input type="text" name="name"><br>
  Email: <input type="email" name="email"><br>
  Course: <input type="text" name="course"><br>
  <input type="submit" name="save" value="Save">
</form>

<?php
if(isset($_POST['save'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $course = $_POST['course'];
  $conn->query("INSERT INTO students (name,email,course) VALUES ('$name','$email','$course')");
  header("Location: index.php");
}
?>
