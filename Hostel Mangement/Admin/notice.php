<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get input data from the form
    $title = $_POST['title'];
    $message = $_POST['message'];

    // Insert the notice into the database
    $insertQuery = "INSERT INTO notices (title, message) VALUES ('$title', '$message')";
    if (mysqli_query($conn, $insertQuery)) {
        // Notice inserted successfully
        echo"<script>alert('Notice sent successfull!');window.location.href='admin_dashboard.php';</script>"; // Redirect back to admin dashboard
        exit();
    } else {
        // Handle database error
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
