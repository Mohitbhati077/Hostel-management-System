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
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container1">
    <h1>Payment Confirmation</h1>
        <p>Payment Details:</p>
        <p>Monthly Room Charge:<?php echo $roomfee;?></p>
        <?php 
        if($messservice==1){
            echo "<p>Mess service Fee:".$messfee."</p>";
        }
        ?>
        <p><strong>Total Amount:<?php echo $totalamt;?></strong></p>
       <form action="wait_for_confirmation.php" method="post">
        <p>Once you have Sended your Payment.Please Click on Confirm Payment.</p>
        <!-- <input type="hidden" name="reservation_id" value="<?php echo $reservationID;?>">
        <input type="hidden" name="payment_amount" value="<?php echo $totalamt;?>"> -->
         <input type="submit" value="Confirm Payment">
       </form>
</div>
</body>
</html>