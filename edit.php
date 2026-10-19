<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db.php";


/* =========================
   CHECK ID
   ========================= */

if (!isset($_GET["id"])) {
    die("Student ID not provided.");
}

$id = intval($_GET["id"]);


/* =========================
   GET STUDENT DATA
   ========================= */

$sql = "SELECT 
            education_users.id,
            education_users.Names,
            education_users.Email,
            education_users.Student_ID,
            education_users.Class,
            education_users.Course,
            education_results.Semester_1,
            education_results.Semester_2,
            education_results.Semester_3,
            education_results.Semester_4,
            education_results.Semester_5,
            education_results.CGPA
        FROM education_users
        LEFT JOIN education_results
        ON education_users.id = education_results.id
        WHERE education_users.id = $id";

$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}

if ($result->num_rows == 0) {
    die("Student not found.");
}

$row = $result->fetch_assoc();


/* =========================
   UPDATE DATA
   ========================= */

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


    /* =========================
       UPDATE STUDENT INFORMATION
       ========================= */

    $sqlUser = "UPDATE education_users SET
                Names = '$name',
                Email = '$email',
                Student_ID = '$studentID',
                Class = '$class',
                Course = '$course'
                WHERE id = $id";

    if ($conn->query($sqlUser) === TRUE) {


        /* =========================
           CHECK IF RESULTS EXIST
           ========================= */

        $checkResults = "SELECT id
                         FROM education_results
                         WHERE id = $id";

        $check = $conn->query($checkResults);


        if ($check->num_rows > 0) {

            /* =========================
               UPDATE EXISTING RESULTS
               ========================= */

            $sqlResults = "UPDATE education_results SET
                           Semester_1 = '$semester1',
                           Semester_2 = '$semester2',
                           Semester_3 = '$semester3',
                           Semester_4 = '$semester4',
                           Semester_5 = '$semester5',
                           CGPA = '$cgpa'
                           WHERE id = $id";

        } else {

            /* =========================
               CREATE RESULTS IF MISSING
               ========================= */

            $sqlResults = "INSERT INTO education_results
                           (id, Semester_1, Semester_2, Semester_3, Semester_4, Semester_5, CGPA)
                           VALUES
                           ($id, '$semester1', '$semester2', '$semester3', '$semester4', '$semester5', '$cgpa')";
        }


        if ($conn->query($sqlResults) === TRUE) {

            header("Location: admin.php");
            exit();

        } else {

            die("Results Error: " . $conn->error);
        }

    } else {

        die("Student Error: " . $conn->error);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Student</title>

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
    background-color: #333;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #555;
}

.back {
    display: inline-block;
    margin-top: 15px;
    text-decoration: none;
    color: #333;
}

</style>

</head>

<body>

<div class="container">

<h1>Edit Student</h1>

<form method="POST">

    <label>Name</label>
    <input type="text"
           name="Names"
           value="<?php echo htmlspecialchars($row['Names']); ?>"
           required>


    <label>Email</label>
    <input type="email"
           name="Email"
           value="<?php echo htmlspecialchars($row['Email']); ?>"
           required>


    <label>Student ID</label>
    <input type="text"
           name="Student_ID"
           value="<?php echo htmlspecialchars($row['Student_ID']); ?>"
           required>


    <label>Class</label>
    <input type="text"
           name="Class"
           value="<?php echo htmlspecialchars($row['Class']); ?>"
           required>


    <label>Course</label>
    <input type="text"
           name="Course"
           value="<?php echo htmlspecialchars($row['Course']); ?>"
           required>


    <label>Semester 1 GPA</label>
    <input type="number"
           name="Semester_1"
           step="0.01"
           min="0"
           max="4"
           value="<?php echo htmlspecialchars($row['Semester_1'] ?? ''); ?>"
           required>


    <label>Semester 2 GPA</label>
    <input type="number"
           name="Semester_2"
           step="0.01"
           min="0"
           max="4"
           value="<?php echo htmlspecialchars($row['Semester_2'] ?? ''); ?>"
           required>


    <label>Semester 3 GPA</label>
    <input type="number"
           name="Semester_3"
           step="0.01"
           min="0"
           max="4"
           value="<?php echo htmlspecialchars($row['Semester_3'] ?? ''); ?>"
           required>


    <label>Semester 4 GPA</label>
    <input type="number"
           name="Semester_4"
           step="0.01"
           min="0"
           max="4"
           value="<?php echo htmlspecialchars($row['Semester_4'] ?? ''); ?>"
           required>


    <label>Semester 5 GPA</label>
    <input type="number"
           name="Semester_5"
           step="0.01"
           min="0"
           max="4"
           value="<?php echo htmlspecialchars($row['Semester_5'] ?? ''); ?>"
           required>


    <button type="submit">Save Changes</button>

</form>

<a href="admin.php" class="back">← Back to Admin Dashboard</a>

</div>

</body>

</html>