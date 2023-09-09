<?php
// session_start();
// if(!isset($_SESSION['admin_id'])){
//     header("Location:admin_login.php");
//     exit();
// }

include 'db_connect.php';
$studentquery="SELECT s.*,payment_status,r.status,rm.RoomNo FROM students s
LEFT JOIN payment_record p ON s.s_id=p.s_id
LEFT JOIN reservation r ON s.s_id=r.s_id
LEFT JOIN rooms rm ON r.RoomId=rm.RoomId";
$studentresult=mysqli_query($conn,$studentquery);
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
        <h1>Manage Student</h1>
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
          <section class="manage_students">
            <h2>Manage Students</h2>
            <table>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Payment Status</th>
                    <th>Reservation Status</th>
                    <th>Room Number</th>
                </tr>
                <?php while($studentrecord=mysqli_fetch_assoc($studentresult)){?>
                <tr>
                    <td><?php echo $studentrecord['s_id'];?></td>
                    <td><?php echo $studentrecord['f_name'];?></td>
                    <td><?php echo $studentrecord['payment_status'];?></td>
                    <td><?php echo $studentrecord['status'];?></td>
                    <td><?php echo $studentrecord['RoomNo'];?></td>
                </tr>
            <?php }?>
            </table> 
          </section>
     </main>
</body>
</html>               