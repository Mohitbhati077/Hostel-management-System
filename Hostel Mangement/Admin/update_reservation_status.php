<?php
include 'db_connect.php';
$reservationID=$_POST['reservation_id'];
$newstatus=$_POST['new_status'];
$updatereservationquery="UPDATE reservation SET status='$newstatus' Where resid='$reservationID'";
mysqli_query($conn,$updatereservationquery);

mysqli_close($conn);
echo"<script>alert('Reservation Confirmed !');window.location.href='manage_reservation.php';</script>";
exit();
?>