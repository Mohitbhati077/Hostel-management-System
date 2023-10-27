<?php
session_start();
if(!isset($_SESSION['s_id'])){
    header("Location:login.php");
    exit();
}
include 'db_connect.php';
$studentID=$_SESSION['s_id'];
$query="SELECT payment_status FROM payment_record WHERE s_id=$studentID ORDER BY payment_id DESC LIMIT 1";
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
    <link rel="stylesheet" href="wait_for_confirmation.css">
    <script src="https://kit.fontawesome.com/19461f0c8d.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <nav>
        <div class="title">
                <a href="home.html"><img src="images/logo.svg" alt="logo"></a><p>ICCS</p>
        </div>
        <a href=""><i class="fa-solid fa-arrow-right-from-bracket" style="color: #ffffff;"></i>  Sign Out</a>
    </nav>
    <p class="heading">Wait for Confirmation</p>
    <p class="info">
    Hey Mate! We're excited to have you as part of our vibrant hostel community at ICCS. At this stage, your payment has been securely received and is currently undergoing a meticulous verification process.<br><br> We truly appreciate your choice to stay with us, and we're committed to making your transition into your new accommodation a seamless one. Kindly be patient with the process.<br><br><br>
    <strong>Contact Us</strong><br>
    If you're facing any trouble or you want to reach out to us, feel free to connect :)<br><br>
    <i>+91 9123456780</i><br>
    <i>icshostel@gmail.com</i>
    </p>
</div>
</body>
</html>