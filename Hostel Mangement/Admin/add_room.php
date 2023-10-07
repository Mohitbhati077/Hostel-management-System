<?php
include 'db_connect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $roomno=$_POST['room_no'];
    $capacity=$_POST['capacity'];
    $availability=$_POST['availability'];
    $insertquery="INSERT INTO rooms(RoomNo,Capacity,Availablility)VALUES ('$roomno','$capacity','$availability')";
    if(mysqli_query($conn,$insertquery)){
        header("Location:manage_room.php?success=1");
        exit();
    }else{
        echo "Error".mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Add Room</h1>
    </header>
    <div class="navbar">
        <nav>
        <ul>
            <li><a href="admin_dashboard.php">Home</a></li>
            <li><a href="manage_room.php">Manage Room</a></li>
            <li><a href="view_student.php">Manage Students</a></li>
            <li><a href="manage_reservation.php">Manage Reservation</a></li>
            <li><a href="manage_payment.php">Manage Payment</a></li>
            <li><a href="notice.html">Notice</a></li>
            <li><a href="reminder.php">Reminder</a></li>
            <li><a href="#" id="logout">Log Out</a></li>
        </ul>
    </nav>
    </div>
    <main>
        <section class="add-room-form">
            <h2>Add New Room</h2>
            <form action="add_room.php" method="POST">
                <label for="room_no">Room Number:</label>
                <input type="text" id="room_no" name="room_no" required>
                <label for="capacity">Capacity:</label>
                <input type="number" id="capacity" name="capacity" required>
                <label for="availability">Availablility:</label>
               <select name="availability" id="availability" required>
                <option value="Available">Available</option>
                <option value="Not Available">Not Available</option>
               </select>
                 <button type="submit">Add Room</button>
            </form>
        </section>
    </main>
</body>
</html>