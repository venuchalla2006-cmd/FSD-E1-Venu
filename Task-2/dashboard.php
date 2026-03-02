<?php
include "db.php";

$department="";
$order="";

if(isset($_GET['department']))
$department=$_GET['department'];

if(isset($_GET['sort'])){
if($_GET['sort']=="name")
$order=" ORDER BY name";
elseif($_GET['sort']=="date")
$order=" ORDER BY dob";
}

$sql="SELECT * FROM students";

if($department!="")
$sql.=" WHERE department='$department'";

$sql.=$order;

$result=$conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Analytics Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="navbar">
Student Analytics Dashboard
</div>

<div class="container">

<h2>Student Data</h2>

<a href="?sort=name"><button>Sort by Name</button></a>
<a href="?sort=date"><button>Sort by DOB</button></a>

<form method="GET">
<select name="department">
<option value="">All Departments</option>
<option>CSE</option>
<option>ECE</option>
<option>EEE</option>
<option>IT</option>
</select>
<button>Filter</button>
</form>

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
while($row=$result->fetch_assoc()){
echo "<tr>
<td>{$row['id']}</td>
<td>{$row['name']}</td>
<td>{$row['email']}</td>
<td>{$row['dob']}</td>
<td>{$row['department']}</td>
<td>{$row['phone']}</td>
</tr>";
}
?>

</table>

<div class="stats">
<h3>Department Statistics</h3>

<?php
$count=$conn->query(
"SELECT department,COUNT(*) total 
FROM students GROUP BY department");

while($row=$count->fetch_assoc()){
echo "<b>".$row['department']."</b> : ".
$row['total']." Students<br>";
}
?>
</div>

</div>

</body>
</html>