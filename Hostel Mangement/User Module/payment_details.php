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
    <link rel="stylesheet" href="payment_details.css">
    <script src="https://kit.fontawesome.com/19461f0c8d.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <div class="title">
            <a href="home.html"><img src="images/blue-logo.svg" alt="logo"></a><p>ICCS</p>
        </div>
        <div class="box">
        <h1>Payment Details</h1>
        <div class="box__content">
            <div class="pay_details">
                <p><span><i class="fa-solid fa-building-columns" style="color: #32424a;"></i> Bank Account:</span> HDFC Bank</p>
                <p><span><i class="fa-solid fa-money-check" style="color: #32424a;"></i> Account Number:</span> 52100012011</p>
                <p><span><i class="fa-solid fa-i" style="color: #32424a;"></i> IFSC CODE:</span> HDFC00053</p>
                <p><span>UPI:</span> user123@hdfcbank</p>
                </div>
                <div class="price">
                <h2>Monthly Room Charge <i class="fa-solid fa-indian-rupee-sign"></i>3000</h2>
                <h2>Monthly Mess Charge <i class="fa-solid fa-indian-rupee-sign"></i>1000</h2>
            </div>
        </div>
    <form action="confirm_payment.php" method="post" class="form">
    
        <div class="checkbox-wrapper">
        <input type="checkbox" name="mess" id="mess" class="checkbox" class="check">
        <label for="mess">Do You Want Mess Service?</label>
        <br>
        <button type="submit" value="Proceed to payment." id="next">Next <i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></button>
        </div>
    </form>
        </div>
    </div>
</body>
</html>