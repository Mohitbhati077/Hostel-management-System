<?php
include 'db_connect.php';

// Get the selected student ID from the form
$studentID = $_POST['student'];

// Get the title and message from the form
$title = $_POST['title'];
$message = $_POST['message'];

// Insert the reminder into the database
$insertReminderQuery = "INSERT INTO reminder(s_id, title, message, sent_date, read_status)
                        VALUES ($studentID, '$title', '$message', NOW(), 'unread')";
if (mysqli_query($conn, $insertReminderQuery)) {
    // Reminder inserted successfully
    echo"<script>alert('Reminder sent successfull!');window.location.href='reminder.php';</script>";
    exit();
} else {
    // Handle database error
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
