<?php

include "db.php";

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
        WHERE education_users.Email != 'admin@gmail.com'";

$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin Dashboard</title>


    <style>

        body {

            font-family: Arial, sans-serif;

            background-color: #ff9b9bff;

            margin: 0;

            padding: 30px;

        }


        h1 {

            text-align: center;

            margin-bottom: 30px;

        }


        .container {

            background-color: yellow;

            padding: 25px;

            border-radius: 10px;

            overflow-x: auto;

        }


        .top-bar {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 20px;

        }


        .top-bar h2 {

            margin: 0;

        }


        .add-button {

            background-color: #28a745;

            color: white;

            padding: 10px 15px;

            text-decoration: none;

            border-radius: 5px;

            display: inline-block;

        }


        .add-button:hover {

            background-color: #218838;

        }


        table {

            width: 100%;

            border-collapse: collapse;

        }


        th,
        td {

            padding: 12px;

            border: 1px solid #ddd;

            text-align: center;

        }


        th {

            background-color: #333;

            color: white;

        }


        tr:nth-child(even) {

            background-color: #f5f3f3ff;

        }


        .edit-button {

            background-color: #333;

            color: white;

            padding: 8px 12px;

            text-decoration: none;

            border-radius: 5px;

            display: inline-block;

            margin-right: 5px;

        }


        .edit-button:hover {

            background-color: #555;

        }


        .delete-button {

            background-color: greenyellow;

            color: white;

            padding: 8px 12px;

            text-decoration: none;

            border-radius: 5px;

            display: inline-block;

        }


        .delete-button:hover {

            background-color: #c82333;

        }


    </style>

</head>


<body>


    <h1>Admin Dashboard</h1>


    <div class="container">


        <div class="top-bar">

            <h2>Student Records</h2>


            <a
                href="edit.php"
                class="add-button"
            >
                + Add Student
            </a>

        </div>


        <table>

            <tr>

                <th>ID</th>

                <th>Name</th>

                <th>Email</th>

                <th>Student ID</th>

                <th>Class</th>

                <th>Course</th>

                <th>Semester 1</th>

                <th>Semester 2</th>

                <th>Semester 3</th>

                <th>Semester 4</th>

                <th>Semester 5</th>

                <th>CGPA</th>

                <th>Action</th>

            </tr>


            <?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

            ?>

                    <tr>

                        <td>
                            <?php
                            echo htmlspecialchars($row["id"]);
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars($row["Names"]);
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars($row["Email"]);
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars($row["Student_ID"]);
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars($row["Class"]);
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars($row["Course"]);
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars($row["Semester_1"] ?? "");
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars($row["Semester_2"] ?? "");
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars($row["Semester_3"] ?? "");
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars($row["Semester_4"] ?? "");
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars($row["Semester_5"] ?? "");
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars($row["CGPA"] ?? "");
                            ?>
                        </td>

                        <td>

                            <a
                                class="edit-button"
                                href="edit.php?id=<?php echo $row["id"]; ?>"
                            >
                                Edit
                            </a>

                            <a
                                class="delete-button"
                                href="delete.php?id=<?php echo $row["id"]; ?>"
                                onclick="return confirm('Are you sure you want to delete this student?');"
                            >
                                Delete
                            </a>

                        </td>

                    </tr>

            <?php

                }

            } else {

            ?>

                <tr>

                    <td colspan="13">
                        No students found.
                    </td>

                </tr>

            <?php

            }

            ?>

        </table>

    </div>

</body>

</html>