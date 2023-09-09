<?php
session_start();
if(!isset($_SESSION['s_id'])){
    header("Location:login.php");
    exit();
}
include 'db_connect.php';
$studentID=$_SESSION['s_id'];
$query="SELECT payment_status FROM payment_records WHERE s_id=$studentID ORDER BY payment_id DESC LIMIT 1";
$result=mysqli_query($conn,$query);
if($result && mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    $paymentStatus=$row['payment_status'];
}else{

}
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wait Confirmation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container1">
    <h1>Wait For Confirmation</h1>
     <p>You payment is pending confirmation from admin</p>
</div>
</body>
</html>