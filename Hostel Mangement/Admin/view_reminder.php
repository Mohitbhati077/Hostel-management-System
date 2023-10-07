<?php
// Include your database connection file (e.g., db_connect.php)
include 'db_connect.php';

// Query to retrieve reminders and student names
$query = "SELECT r.*, s.f_name, s.l_name
          FROM reminder r
          JOIN students s ON r.s_id = s.s_id
          ORDER BY r.sent_date DESC"; // You can order by date or other criteria

$result = mysqli_query($conn, $query);

// Check if there are reminders
if (mysqli_num_rows($result) > 0) {
    // Output a table to display the reminders
    echo '<h1>View Reminders</h1>';
    echo '<table border=1>';
    echo '<tr><th>Student Name</th><th>Title</th><th>Message</th><th>Date Sent</th></tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['f_name'] . ' ' . $row['l_name'] . '</td>';
        echo '<td>' . $row['title'] . '</td>';
        echo '<td>' . $row['message'] . '</td>';
        echo '<td>' . $row['sent_date'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo '<p>No reminders found.</p>';
}

// Close the database connection
mysqli_close($conn);
?>
