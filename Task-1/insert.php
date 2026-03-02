<?php
include "db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$department = $_POST['department'];
$phone = $_POST['phone'];

$sql = "INSERT INTO students (name, email, dob, department, phone)
        VALUES ('$name', '$email', '$dob', '$department', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "Registration Successful! <br><a href='view.php'>View Students</a>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>