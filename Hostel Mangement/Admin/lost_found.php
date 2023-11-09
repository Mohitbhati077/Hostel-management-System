<?php
include 'db_connect.php';

$query = "SELECT lf.item_id, lf.item_name, lf.des, lf.status,lf.date_reported, s.f_name
FROM lost_found lf
JOIN students s ON lf.s_id = s.s_id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Notices</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>View Lost and Found</h1>
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
            <li><a href="lost_found.php">Lost and found</a></li>
            <li><a href="#" id="logout">Log Out</a></li>
        </ul>
        </nav>
    </div>
    <main>
        <section class="notice-list">
            <h2>Lost and Found </h2>
            <table>
                <tr>
                    <th>Item Name</th>
                    <th>Item Description</th>
                    <th>Status</th>
                    <th>Date Reported</th>
                    <th>Student Name</th>
                    <th>Action</th>
                </tr>
                <?php while ($lost = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $lost['item_name']; ?></td>
                        <td><?php echo $lost['des']; ?></td>
                        <td><?php echo $lost['status']; ?></td>
                        <td><?php echo $lost['date_reported']; ?></td>
                        <td><?php echo $lost['f_name']; ?></td>
                        <td>
                            
                            <a href="edit_lost_found.php?id=<?php echo $lost['item_id']; ?>">Edit</a>
                            <a href="delete_lost.php?id=<?php echo $notice['item_id']; ?>" onclick="return confirm('Are you sure you want to delete this notice?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </section>
    </main>
</body>
</html>
