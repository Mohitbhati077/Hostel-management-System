<?php
session_start();
if(!isset($_SESSION['s_id'])){
    header("Location:login.php");
    exit();
}
include 'db_connect.php';
$studentID=$_SESSION['s_id'];
$messservice=isset($_POST['mess'])?1:0;
$roomfee=3000;
$messfee=1000;
$totalamt=$roomfee+($messservice *$messfee);
$query="INSERT INTO payment_record(s_id,payment_date,payment_amount,mess_service,payment_status) 
VALUES('$studentID',NOW(),'$totalamt','$messservice','pending')";
mysqli_query($conn,$query);
$reservationquery="SELECT resid FROM reservation WHERE s_id='$studentID'";
$reservationresult=mysqli_query($conn,$reservationquery);
$row=mysqli_fetch_assoc($reservationresult);
$reservationID=$row['resid'];
$_SESSION['payment_pending'] = true;
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="payment_details.css">
    <script src="https://kit.fontawesome.com/19461f0c8d.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="title">
        <a href="home.html"><img src="images/blue-logo.svg" alt="logo"></a><p>ICCS</p>
    </div>
    <div class="box">
        <h1>Payment Confirmation</h1>
        <div class="box__content">
            <div class="pay_details">
                <p><span><i class="fa-solid fa-building-columns" style="color: #32424a;"></i> Bank Account:</span> HDFC Bank</p>
                <p><span><i class="fa-solid fa-money-check" style="color: #32424a;"></i> Account Number:</span> 52100012011</p>
                <p><span><i class="fa-solid fa-i" style="color: #32424a;"></i> IFSC CODE:</span> HDFC00053</p>
                <p><span>UPI:</span> user123@hdfcbank</p>
            </div>
            <div class="price">
                <h2>Monthly Room Charge <i class="fa-solid fa-indian-rupee-sign"></i><?php echo $roomfee;?></h2>
                <?php 
                if($messservice==1){
                    echo "<h2>Monthly Mess Charge <i class='fa-solid fa-indian-rupee-sign'></i>".$messfee."</h2>";
                }
                ?>
            </div>
        </div>
            <form action="wait_for_confirmation.php" method="post" class="form">
            <p class="total">Total Amount- <i class="fa-solid fa-indian-rupee-sign"></i><?php echo $totalamt;?></p>
                <p>After your successful transaction for room reservation, please click on the Confirm Payment to ping us about you.</p>
                <div class="buttons">
                <button type="submit" value="Confirm Payment"><i class="fa-regular fa-circle-check" style="color: #ffffff;"></i> Confirm Payment</button>
                <a href="payment_details.php"><i class="fa-solid fa-chevron-left" style="color: #ffffff;"></i> Back</a>
                </div>
            </form>
    </div>
</div>
</body>
</html>