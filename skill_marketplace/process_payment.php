<?php
include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$course_id = $_POST['course_id'] ?? 0;

// Prevent duplicate enrollment
$check = $conn->query("SELECT * FROM enrollments 
                       WHERE user_id='$user_id' 
                       AND course_id='$course_id'");

if($check->num_rows == 0){
    $conn->query("INSERT INTO enrollments(user_id,course_id,payment_status) 
                  VALUES('$user_id','$course_id','Paid')");
}

// Redirect to dashboard
header("Location: dashboard.php?enrolled=success");
exit();
?>