<?php
include("db.php");

$sql = "SELECT * FROM students";
$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Student List</title>
<style>

table{
border-collapse:collapse;
width:80%;
margin:auto;
}

th,td{
padding:10px;
border:1px solid black;
text-align:center;
}

th{
background-color:#4CAF50;
color:white;
}

h2{
text-align:center;
}

</style>
</head>

<body>

<h2>Student Records</h2>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>DOB</th>
<th>Department</th>
<th>Phone</th>
</tr>

<?php

if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)){

echo "<tr>";
echo "<td>".$row['id']."</td>";
echo "<td>".$row['name']."</td>";
echo "<td>".$row['email']."</td>";
echo "<td>".$row['dob']."</td>";
echo "<td>".$row['department']."</td>";
echo "<td>".$row['phone']."</td>";
echo "</tr>";

}

}
else{
echo "<tr><td colspan='6'>No Records Found</td></tr>";
}

?>

</table>

</body>
</html>