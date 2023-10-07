<?php
@include'db_connect.php';
session_start();
if(isset($_SESSION['s_id'])){
    $studentid=$_SESSION['s_id'];

    if(isset($_GET['resid'])){
      $resID=$_GET['resid'];

      $query="SELECT * FROM reservation WHERE s_id='$studentid' and resid='$resID'";
      $result=mysqli_query($conn,$query);
      if($result && mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);

        $resID = $row['resid'];
        $name = $row['name'];
        $address = $row['address'];
        $dob = $row['dob'];
        $phone = $row['phone'];
        $state = $row['state'];
        $city = $row['city'];
        $college = $row['clgname'];
        $status = $row['status'];
       }else{
            header("Location:confirmation.php");
            exit();
       }
       mysqli_close($conn);
    }else{
        header("Location:confirmation.php");
            exit();
  }
}else{
         header("Location:login.php");
            exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Reservation</h1>
    <form action="process_page.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name;?>" required><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo $address;?>" required><br>
    
    <label for="dob">Date Of Birth:</label>
    <input type="date" id="dob" name="dob" value="<?php echo $dob;?>" required><br>

    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" value="<?php echo $phone;?>" required><br>

    <label for="state">State:</label>
    <input type="text" id="state" name="state" value="<?php echo $state;?>" required><br>

    <label for="city">City:</label>
    <input type="text" id="city" name="city" value="<?php echo $city;?>" required><br>

    <label for="college">College:</label>
    <input type="text" id="college" name="college" value="<?php echo $college;?>" required><br>

    <input type="hidden" name="resid" value='<?php echo $resID; ?>'>
    <input type="submit" value="Update">
</form>
</body>
</html>