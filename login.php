<?php

include "db.php";

$email = $_POST["email"];

$adminEmail = "admin@gmail.com";

if ($email === $adminEmail) {

    header("Location: admin.php");
    exit();

} else {

    echo "Invalid admin email.";

}