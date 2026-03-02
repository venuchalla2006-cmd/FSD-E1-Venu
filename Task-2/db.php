<?php
$conn = new mysqli("localhost", "root", "", "student_db", 3304);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>