<?php

include("db.php");

$amount=$_POST['amount'];

mysqli_begin_transaction($conn);

try{

// Deduct from user
$deduct="UPDATE users SET balance=balance-$amount WHERE id=1";
mysqli_query($conn,$deduct);

// Add to merchant
$add="UPDATE merchants SET balance=balance+$amount WHERE id=1";
mysqli_query($conn,$add);

// Commit transaction
mysqli_commit($conn);

echo "<h2>Payment Successful</h2>";

// Get updated balances
$user=mysqli_query($conn,"SELECT balance FROM users WHERE id=1");
$user_balance=mysqli_fetch_assoc($user);

$merchant=mysqli_query($conn,"SELECT balance FROM merchants WHERE id=1");
$merchant_balance=mysqli_fetch_assoc($merchant);

echo "User balance → ".$user_balance['balance']."<br>";
echo "Merchant balance → ".$merchant_balance['balance'];

}

catch(Exception $e){

mysqli_rollback($conn);

echo "Payment Failed";

}

?>