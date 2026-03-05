<?php

include("db.php");

$name = $_POST['name'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$department = $_POST['department'];
$phone = $_POST['phone'];

$sql = "INSERT INTO students(name,email,dob,department,phone)
VALUES('$name','$email','$dob','$department','$phone')";

if(mysqli_query($conn,$sql)){
echo "<script>
alert('Student Registered Successfully');
window.location='index.html';
</script>";
}
else{
echo "Error: " . mysqli_error($conn);
}

?>