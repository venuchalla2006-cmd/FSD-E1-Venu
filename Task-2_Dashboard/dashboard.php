<?php
include("db.php");

$sort = "";
$filter = "";

if(isset($_GET['sort'])){
    if($_GET['sort']=="name"){
        $sort="ORDER BY name ASC";
    }
    if($_GET['sort']=="dob"){
        $sort="ORDER BY dob ASC";
    }
}

if(isset($_GET['department']) && $_GET['department']!=""){
    $dept=$_GET['department'];
    $filter="WHERE department='$dept'";
}

$query="SELECT * FROM students $filter $sort";
$result=mysqli_query($conn,$query);

$countQuery="SELECT department,COUNT(*) as total FROM students GROUP BY department";
$countResult=mysqli_query($conn,$countQuery);

?>

<!DOCTYPE html>
<html>

<head>

<title>Student Dashboard</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<h2>Student Data Dashboard</h2>

<!-- Sorting -->

<a href="?sort=name">Sort by Name</a>
<a href="?sort=dob">Sort by DOB</a>

<br><br>

<!-- Filter -->

<form method="GET">

<select name="department">

<option value="">All Departments</option>
<option value="CSE">CSE</option>
<option value="ECE">ECE</option>
<option value="EEE">EEE</option>
<option value="MECH">MECH</option>

</select>

<button type="submit">Filter</button>

</form>

<br>

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

while($row=mysqli_fetch_assoc($result)){

echo "<tr>
<td>".$row['id']."</td>
<td>".$row['name']."</td>
<td>".$row['email']."</td>
<td>".$row['dob']."</td>
<td>".$row['department']."</td>
<td>".$row['phone']."</td>
</tr>";

}

?>

</table>

<br><br>

<h3>Student Count Per Department</h3>

<table>

<tr>
<th>Department</th>
<th>Total Students</th>
</tr>

<?php

while($row=mysqli_fetch_assoc($countResult)){

echo "<tr>
<td>".$row['department']."</td>
<td>".$row['total']."</td>
</tr>";

}

?>

</table>

</body>
</html>