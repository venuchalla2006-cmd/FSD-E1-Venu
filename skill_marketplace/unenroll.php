<?php
include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$course_id = $_GET['id'] ?? 0;

$conn->query("DELETE FROM enrollments
              WHERE user_id='$user_id'
              AND course_id='$course_id'");

header("Location: dashboard.php");
exit();
?>