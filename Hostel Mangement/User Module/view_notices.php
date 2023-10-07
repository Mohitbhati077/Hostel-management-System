<?php
// Include your database connection file (e.g., db_connect.php)
include 'db_connect.php';

// Fetch all notices
$query = "SELECT * FROM notices";
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
        <h1>View Notices</h1>
    </header>
    <main>
        <section class="notice-list">
            <h2>Notices Sent</h2>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Sent On</th>
                    <!-- <th>Actions</th> -->
                </tr>
                <?php while ($notice = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $notice['title']; ?></td>
                        <td><?php echo $notice['message']; ?></td>
                        <td><?php echo $notice['created_at']; ?></td>
                        <!-- <td>
                            <a href="edit_notice.php?id=<?php echo $notice['id']; ?>">Edit</a>
                            <a href="delete_notice.php?id=<?php echo $notice['id']; ?>" onclick="return confirm('Are you sure you want to delete this notice?')">Delete</a>
                        </td> -->
                    </tr>
                <?php } ?>
            </table>
        </section>
    </main>
</body>
</html>
