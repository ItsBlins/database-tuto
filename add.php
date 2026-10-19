<?php

include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Student information
    $name = $_POST["Names"];
    $email = $_POST["Email"];
    $studentID = $_POST["Student_ID"];
    $class = $_POST["Class"];
    $course = $_POST["Course"];

    // Semester GPAs
    $semester1 = $_POST["Semester_1"];
    $semester2 = $_POST["Semester_2"];
    $semester3 = $_POST["Semester_3"];
    $semester4 = $_POST["Semester_4"];
    $semester5 = $_POST["Semester_5"];

    // Automatically calculate CGPA
    $cgpa = round(
        ($semester1 + $semester2 + $semester3 + $semester4 + $semester5) / 5,
        2
    );


    // Insert student information
    $sqlUser = "INSERT INTO education_users
                (Names, Email, Student_ID, Class, Course)
                VALUES
                ('$name', '$email', '$studentID', '$class', '$course')";

    if ($conn->query($sqlUser) === TRUE) {

        // Get the newly created student's ID
        $newID = $conn->insert_id;


        // Insert semester results and calculated CGPA
        $sqlResults = "INSERT INTO education_results
                       (id, Semester_1, Semester_2, Semester_3, Semester_4, Semester_5, CGPA)
                       VALUES
                       ('$newID', '$semester1', '$semester2', '$semester3', '$semester4', '$semester5', '$cgpa')";

        if ($conn->query($sqlResults) === TRUE) {

            // Successfully added
            header("Location: admin.php");
            exit();

        } else {

            $message = "Error adding results: " . $conn->error;
        }

    } else {

        $message = "Error adding student: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add Student</title>

<style>

body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 30px;
}

.container {
    background-color: white;
    max-width: 700px;
    margin: auto;
    padding: 30px;
    border-radius: 10px;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
}

label {
    display: block;
    margin-top: 15px;
    margin-bottom: 5px;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
}

button {
    margin-top: 25px;
    padding: 12px 20px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #218838;
}

.back {
    display: inline-block;
    margin-top: 15px;
    text-decoration: none;
    color: #333;
}

.error {
    color: red;
    margin-bottom: 15px;
}

</style>

</head>

<body>

<div class="container">

<h1>Add Student</h1>

<?php
if ($message != "") {
    echo "<p class='error'>" . htmlspecialchars($message) . "</p>";
}
?>

<form method="POST">

    <label>Name</label>
    <input type="text" name="Names" required>


    <label>Email</label>
    <input type="email" name="Email" required>


    <label>Student ID</label>
    <input type="text" name="Student_ID" required>


    <label>Class</label>
    <input type="text" name="Class" required>


    <label>Course</label>
    <input type="text" name="Course" required>


    <label>Semester 1 GPA</label>
    <input type="number"
           name="Semester_1"
           step="0.01"
           min="0"
           max="4"
           required>


    <label>Semester 2 GPA</label>
    <input type="number"
           name="Semester_2"
           step="0.01"
           min="0"
           max="4"
           required>


    <label>Semester 3 GPA</label>
    <input type="number"
           name="Semester_3"
           step="0.01"
           min="0"
           max="4"
           required>


    <label>Semester 4 GPA</label>
    <input type="number"
           name="Semester_4"
           step="0.01"
           min="0"
           max="4"
           required>


    <label>Semester 5 GPA</label>
    <input type="number"
           name="Semester_5"
           step="0.01"
           min="0"
           max="4"
           required>


    <button type="submit">Add Student</button>

</form>

<a href="admin.php" class="back">← Back to Admin Dashboard</a>

</div>

</body>

</html>
