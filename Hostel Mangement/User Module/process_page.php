<?php
session_start();
if(!isset($_SESSION['s_id'])){
   header("Location:login.php");
   exit();
}
@include'db_connect.php';
$studentid=$_SESSION['s_id'];
$roomid=$_POST['id'];
$name=$_POST['name'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$state=$_POST['state'];
$city=$_POST['city'];
$college=$_POST['college'];

$query="SELECT * FROM reservation WHERE s_id=$studentid";
$result=mysqli_query($conn,$query);
if($result && mysqli_num_rows($result)>0){
   $updatequery="UPDATE reservation SET name='$name',address='$address',phone='$phone',state='$state',city='$city',clgname='$college' WHERE s_id='$studentid'";
   $updateresult=mysqli_query($conn,$updatequery);
   if($updateresult){
      echo"<script>alert('Reservation details updated successfull!');window.location.href='confirmation.php';</script>";
   }else{
      echo"Error updating reservation details".mysqli_error($conn);
   }
}else{

$insertquery="INSERT INTO reservation(s_id,RoomId,name,address,phone,state,city,clgname,status)
             VALUES('$studentid','$roomid','$name','$address','$phone','$state','$city','$college','Pending')";
 if(mysqli_query($conn,$insertquery))
 {
    $resid=mysqli_insert_id($conn);
    echo"Reservation successfull".$resid;
    echo"<script>alert('Reservation successfull!');window.location.href='confirmation.php';</script>";
 }else{
    echo "Reservation failed";
 }
}
 mysqli_close($conn);

?>
