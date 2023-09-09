<?php
// Include your database connection
include 'db_connect.php';

// Admin data
$username = 'admin123';
$password = 'admin';

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// SQL query to insert data
$query = "INSERT INTO admin (username, password) 
          VALUES ('$username', '$hashedPassword')";

// Execute the query
if (mysqli_query($conn, $query)) {
    echo "Admin data inserted successfully!";
} else {
    echo "Error inserting admin data: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
