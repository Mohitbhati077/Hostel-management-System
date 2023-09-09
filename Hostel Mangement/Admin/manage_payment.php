<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location:admin_login.php");
    exit();
}
include 'db_connect.php';
$paymentquery="SELECT payment_record.*,students.f_name AS student_name FROM payment_record INNER JOIN students ON payment_record.s_id=students.s_id";
$paymentresult=mysqli_query($conn,$paymentquery);
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
        <h1>Manage Payment</h1>
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
          <section class="manage_payment">
            <h2>Manage Payments</h2>
            <table>
                <tr>
                    <th>Payment Id</th>
                    <th>Student Id</th>
                    <th>Student Name</th>
                    <th>Payment Amount</th>
                    <th>Payment Date</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
                <?php while($paymentrecord=mysqli_fetch_assoc($paymentresult)){?>
                <tr>
                    <td><?php echo $paymentrecord['payment_id'];?></td>
                    <td><?php echo $paymentrecord['s_id'];?></td>
                    <td><?php echo $paymentrecord['student_name'];?></td>
                    <td><?php echo $paymentrecord['payment_amount'];?></td>
                    <td><?php echo $paymentrecord['payment_date'];?></td>
                    <td><?php echo $paymentrecord['payment_status'];?></td>
                    <td>
                        <?php if($paymentrecord['payment_status']=='pending'){?>
                        <form action="update_payment_status.php" method="post">
                        <input type="hidden" name="payment_id" value="<?php echo $paymentrecord['payment_id'];?>">
                        <input type="hidden" name="new_status" value="Recevied">
                        <button type="submit">Mark as Recevied</button>
                        </form>
                        <?php }else{ ?>
                              Recevied
                       <?php }?>
                    </td>
                </tr>
                <?php } ?>
            </table>
          </section>
     </main>
</body>
</html>