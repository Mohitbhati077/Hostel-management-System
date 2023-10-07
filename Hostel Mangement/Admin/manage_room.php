<?php
// session_start();
// if(!isset($_SESSION['admin_id'])){
//     header("Location:admin_login.php");
//     exit();
// }

include 'db_connect.php';
$roomquery="SELECT * from rooms";
$roomresult=mysqli_query($conn,$roomquery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Manage Room</h1>
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
          <section class="room_list">
           <h2>Room List</h2>
            <button id="addRoomButton">Add Room</button>
            <table>
                <tr>
                    <th>Room Number</th>
                    <th>Capacity</th>
                    <th>Occupants</th>
                    <th>Availablility</th>
                    <th>Action</th>
                </tr>
                <?php while($roomrecord=mysqli_fetch_assoc($roomresult)){?>
                <tr>
                    <td><?php echo $roomrecord['RoomNo'];?></td>
                    <td><?php echo $roomrecord['Capacity'];?></td>
                    <td><?php echo $roomrecord['Occupants'];?></td>
                    <td><?php echo $roomrecord['Availablility'];?></td>
                    <td>
                        <button class="editRoomButton" data-room-id="<?php echo $roomrecord['RoomId'];?>">Edit</button>
                        <!-- <button>Mark Available</button> -->
                    </td>
                </tr>
            <?php }?>
            </table> 
          </section>
     </main>
     <script>
        document.addEventListener('DOMContentLoaded',function(){
            var logoutbutton=document.getElementById('logout');
            logoutbutton.addEventListener('click',function(event){
                event.preventDefault();
                var confirmLogout=confirm("Are you sure you want to log out?");
                if(confirmLogout){
                    window.location.href='logout.php';
                }
            });
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add Room Button Click Event
        var addRoomButton = document.getElementById('addRoomButton');
        addRoomButton.addEventListener('click', function () {
            // Redirect to the "Add Room" page or display an "Add Room" form as needed
            window.location.href = 'add_room.php'; // Change this URL as per your implementation
        });

        // Edit Room Button Click Events
        var editRoomButtons = document.querySelectorAll('.editRoomButton');
        editRoomButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var roomId = button.getAttribute('data-room-id');
                // Redirect to the "Edit Room" page with the room ID as a parameter
                window.location.href = 'edit_room.php?room_id=' + roomId; // Change this URL as per your implementation
            });
        });
    });
</script>

</body>
</html>               