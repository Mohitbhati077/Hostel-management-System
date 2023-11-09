<?php
session_start();
if(!isset($_SESSION['s_id'])){
    header("Location:login.html");
    exit();
}
include 'db_connect.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $student_id=$_SESSION['s_id'];
//   $student_id=$_POST['s_id'];
  $item_name=$_POST['item_name'];
  $description=$_POST['description'];
  $status=$_POST['status'];
  $insertquery="INSERT INTO lost_found(s_id,item_name,des,status,date_reported)VALUES('$student_id','$item_name','$description','$status',NOW())";
  if(mysqli_query($conn,$insertquery)){
    echo "Report submitted sucessfully";
  }
  else{
    echo "error".mysqli_error($conn);
  }
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost and Found</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Lost and Found</h1>
    <form action="lost_found.php" method="post">
     <input type="hidden" name="student_id" value="<?php echo $_SESSION['s_id'];?>">
     <label for="item_name">Item Name:</label>
     <input type="text" name="item_name" id="item_name" required><br><br>

     <label for="description">Description:</label>
     <textarea name="description" id="description" rows="4" required></textarea><br><br>

     <label>Status:</label>
        <input type="radio" id="lost" name="status" value="Lost" required>
        <label for="lost">Lost</label>
        <input type="radio" id="found" name="status" value="Found" required>
    <label for="found">Found</label>

     <button type="submit">Submit</button>
     



    </form>
</body>
</html>