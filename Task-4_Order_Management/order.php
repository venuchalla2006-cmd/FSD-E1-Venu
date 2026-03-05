<?php
include("db.php");
?>

<!DOCTYPE html>
<html>

<head>
<title>Order Management</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<h2>Customer Order History</h2>

<table border="1">

<tr>
<th>Customer</th>
<th>Product</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
</tr>

<?php

$query = "
SELECT customers.name,
products.product_name,
products.price,
orders.quantity,
(products.price * orders.quantity) AS total
FROM orders
JOIN customers ON orders.customer_id = customers.id
JOIN products ON orders.product_id = products.id
ORDER BY total DESC
";

$result = mysqli_query($conn,$query);

while($row=mysqli_fetch_assoc($result)){

echo "<tr>
<td>".$row['name']."</td>
<td>".$row['product_name']."</td>
<td>".$row['price']."</td>
<td>".$row['quantity']."</td>
<td>".$row['total']."</td>
</tr>";

}

?>

</table>

<br><br>

<h3>Highest Value Order</h3>

<?php

$high = "
SELECT customers.name,
(products.price * orders.quantity) AS total
FROM orders
JOIN customers ON orders.customer_id = customers.id
JOIN products ON orders.product_id = products.id
ORDER BY total DESC
LIMIT 1
";

$res = mysqli_query($conn,$high);
$row = mysqli_fetch_assoc($res);

echo "Customer: ".$row['name']." | Order Value: ".$row['total'];

?>

<br><br>

<h3>Most Active Customer</h3>

<?php

$active = "
SELECT customers.name,
COUNT(orders.id) AS order_count
FROM orders
JOIN customers ON orders.customer_id = customers.id
GROUP BY customers.name
ORDER BY order_count DESC
LIMIT 1
";

$res2 = mysqli_query($conn,$active);
$row2 = mysqli_fetch_assoc($res2);

echo "Customer: ".$row2['name']." | Orders: ".$row2['order_count'];

?>

</body>
</html>