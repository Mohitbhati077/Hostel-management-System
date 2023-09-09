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
        </ul>
    </nav>
    </div>
     <main>
          <section class="room_list">
            <h2>Room List</h2>
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
                        <button>Edit</button>
                        <button>Mark Available</button>
                    </td>
                </tr>
            <?php }?>
            </table> 
          </section>
     </main>
</body>
</html>               