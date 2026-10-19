<?php

include "db.php";

/* =========================
   GET STUDENT ID
   ========================= */

if (!isset($_GET["id"])) {
    die("Student ID not provided.");
}

$id = intval($_GET["id"]);


/* =========================
   DELETE RESULTS
   ========================= */

$sqlResults = "DELETE FROM education_results WHERE id = $id";

if ($conn->query($sqlResults) === TRUE) {


    /* =========================
       DELETE STUDENT
       ========================= */

    $sqlUser = "DELETE FROM education_users WHERE id = $id";

    if ($conn->query($sqlUser) === TRUE) {

        // Return to admin dashboard
        header("Location: admin.php");
        exit();

    } else {

        die("Error deleting student: " . $conn->error);

    }

} else {

    die("Error deleting results: " . $conn->error);

}

?>