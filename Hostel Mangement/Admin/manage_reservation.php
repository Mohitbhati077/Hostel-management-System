<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location:admin_login.php");
    exit();
}
include 'db_connect.php';
$reservationquery="SELECT r.resid,r.s_id,r.RoomId,r.name,r.status,p.payment_status,rm.RoomNo FROM reservation r
LEFT JOIN payment_record p ON r.s_id=p.s_id 
LEFT JOIN rooms rm ON r.RoomId=rm.RoomId";
$reservationresult=mysqli_query($conn,$reservationquery);
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
        <h1>Manage Reservation</h1>
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
          <section class="manage_payment">
            <h2>Manage Reservation</h2>
            <table>
                <tr>
                    <th>Reservation Id</th>
                    <th>Student Id</th>
                    <th>Room No</th>
                    <th>Student Name</th>
                    <th>Payment Status</th>
                    <th>Reservation Status</th>
                    <th>Action</th>
                </tr>
                <?php while($reservationrecord=mysqli_fetch_assoc($reservationresult)){?>
                <tr>
                    <td><?php echo $reservationrecord['resid'];?></td>
                    <td><?php echo $reservationrecord['s_id'];?></td>
                    <td><?php echo $reservationrecord['RoomNo'];?></td>
                    <td><?php echo $reservationrecord['name'];?></td>
                    <td><?php echo $reservationrecord['payment_status'];?></td>
                    <td><?php echo $reservationrecord['status'];?></td>
                    <td>
                        <?php if($reservationrecord['status']=='Pending'){?>
                        <form action="update_reservation_status.php" method="post">
                        <input type="hidden" name="reservation_id" value="<?php echo $reservationrecord['resid'];?>">
                        <input type="hidden" name="new_status" value="Confirmed">
                        <button type="submit">Confirm Reservation</button>
                        </form>
                        <?php
                        if($reservationrecord['payment_status']=='Recevied'){
                           $roomid=$reservationrecord['RoomId'];
                           $occupantquery="SELECT COUNT(*) AS num_occupants FROM reservation WHERE RoomId=$roomid";
                           $occupantresult=mysqli_query($conn,$occupantquery);
                           $occupantdata=mysqli_fetch_assoc($occupantresult);
                           $currentoccupants=$occupantdata['num_occupants'];
                           $updateroomquery="UPDATE rooms SET Occupants=$currentoccupants WHERE RoomId=$roomid";
                           mysqli_query($conn,$updateroomquery);
                           if($currentoccupants==4){
                            $updateroomquery="UPDATE rooms SET Availablility='Not Available' WHERE RoomId=$roomid";
                            mysqli_query($conn,$updateroomquery);
                           }
                        }
                        ?>
                        <?php }else{ ?>
                              Confirmed
                       <?php }?>
                    </td>
                </tr>
                <?php } ?>
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
</body>
</html>