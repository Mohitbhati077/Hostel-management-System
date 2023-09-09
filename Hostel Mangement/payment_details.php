<?php
session_start();
if(!isset($_SESSION['s_id'])){
    header("Location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container1">
    <h1>Payment Details</h1>
    <p>Bank Account:HDFC BANK<br>Account Number:52100012011<br>IFSC CODE:HDFC00053</p>
    <p>Upid:mohit10@hdfcbank</p>
    <h2>Monthly Room Charge:3000</h2>
    <form action="confirm_payment.php" method="post">
        <div class="checkbox-wrapper">
        <input type="checkbox" name="mess" id="mess" class="checkbox">
        <label for="mess">Do you want mess service?</label> 
        </div>
        <br>
        <input type="submit" value="Procced to payment.">
    </form>
    </div>
</body>
</html>