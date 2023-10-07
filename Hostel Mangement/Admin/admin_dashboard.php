<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location:admin_login.php");
    exit();
}
include 'db_connect.php';
$totalstudentquery="SELECT COUNT(*) AS total_students FROM students";
$totalstudentresult=mysqli_query($conn,$totalstudentquery);
$totalstudentdata=mysqli_fetch_assoc($totalstudentresult);

$totalroomquery="SELECT COUNT(*) AS total_rooms FROM rooms WHERE Availablility='Available'";
$totalroomresult=mysqli_query($conn,$totalroomquery);
if(!$totalroomresult){
    die("Total room query failed:".mysqli_error($conn));
}
$totalroomdata=mysqli_fetch_assoc($totalroomresult);

$totalreservationquery="SELECT COUNT(*) AS total_reservation FROM reservation WHERE status='Pending'";
$totalreservationresult=mysqli_query($conn,$totalreservationquery);
$totalreservationdata=mysqli_fetch_assoc($totalreservationresult);

$totalpendingpaymentquery="SELECT COUNT(*) AS total_payment FROM payment_record WHERE payment_status='pending'";
$totalpendingpaymentresult=mysqli_query($conn,$totalpendingpaymentquery);
$totalpendingpaymentdata=mysqli_fetch_assoc($totalpendingpaymentresult);

$totalrevenuequery="SELECT IFNULL(SUM(payment_amount),0) AS total_revenue FROM payment_record WHERE payment_status='recevied'";
$totalrevenueresult=mysqli_query($conn,$totalrevenuequery);
$totalrevenuedata=mysqli_fetch_assoc($totalrevenueresult);

mysqli_close($conn);
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
        <h1>Welcome to Admin Dashboard</h1>
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
             <section class="dashboard_stats">
                <h2>Dashboard Overview</h2>
                <div class="stat">
                        <h3>Total Registered Students</h3>
                        <p><?php echo $totalstudentdata['total_students'];?></p>                    
                </div>
                <div class="stat">
                    <h3>Total Available Room</h3>
                    <p><?php echo$totalroomdata['total_rooms'];?></p>
                </div>
                <div class="stat">
                    <h3>Total Pending Reservation</h3>
                    <p><?php echo$totalreservationdata['total_reservation'];?></p>
                </div>
                <div class="stat">
                    <h3>Total Pending Payment</h3>
                    <p><?php echo$totalpendingpaymentdata['total_payment'];?></p>
                </div>
                <div class="stat">
                    <h3>Total Revenue</h3>
                    <p><?php echo$totalrevenuedata['total_revenue'];?></p>
                </div>
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