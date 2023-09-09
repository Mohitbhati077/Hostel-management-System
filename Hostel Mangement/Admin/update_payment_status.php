<?php
include 'db_connect.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
      $payment_id=$_POST['payment_id'];
      $newstatus=$_POST['new_status'];
      $updatequery="UPDATE payment_record SET payment_status='$newstatus'WHERE payment_id='$payment_id'";
      $updateresult=mysqli_query($conn,$updatequery);
      if(!$updateresult){
        die("Update Query failed.".mysqli_error($conn));
      }
      mysqli_close($conn);
      echo"<script>alert('Payment Received !');window.location.href='manage_payment.php';</script>";
      exit();
}
?>