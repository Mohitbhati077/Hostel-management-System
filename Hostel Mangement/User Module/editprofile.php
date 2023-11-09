<?php
session_start();
if (!isset($_SESSION['s_id'])) {
    header("Location: login.html");
    exit();
}

include 'db_connect.php';

$student_id = $_SESSION['s_id'];

// Check if the form is submitted for updating details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['new_name'];
    $newAddress = $_POST['new_address'];
    $newDOB = $_POST['new_dob'];
    $newPhone = $_POST['new_phone'];
    $newState = $_POST['new_state'];
    $newCity = $_POST['new_city'];
    $newCollege = $_POST['new_college'];

    // Update the student's personal details in the database
    $updateQuery = "UPDATE reservation SET name = '$newName', address = '$newAddress', dob = '$newDOB', phone = '$newPhone', state = '$newState', city = '$newCity', clgname = '$newCollege' WHERE s_id = $student_id";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Profile Updated successful!');window.location.href='dashboard.php';</script>";
        //echo "Details updated successfully.";
    } else {
        echo "Error updating details: " . mysqli_error($conn);
    }
}

// Retrieve the student's current personal details
$query = "SELECT name, address, dob, phone, state, city, clgname FROM reservation WHERE s_id = $student_id";
$result = mysqli_query($conn, $query);
if ($row = mysqli_fetch_assoc($result)) {
    $currentName = $row['name'];
    $currentAddress = $row['address'];
    $currentDOB = $row['dob'];
    $currentPhone = $row['phone'];
    $currentState = $row['state'];
    $currentCity = $row['city'];
    $currentCollege = $row['clgname'];
} else {
    echo "Student details not found.";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Profile</h1>
    <form action="editprofile.php" method="POST">
        <input type="text" name="new_name" value="<?php echo $currentName; ?>" placeholder="New Name" required>
        <input type="text" name="new_address" value="<?php echo $currentAddress; ?>" placeholder="New Address" required>
        <input type="date" name="new_dob" value="<?php echo $currentDOB; ?>" required>
        <input type="text" name="new_phone" value="<?php echo $currentPhone; ?>" placeholder="New Phone" required>
        <input type="text" name="new_state" value="<?php echo $currentState; ?>" placeholder="New State" required>
        <input type="text" name="new_city" value="<?php echo $currentCity; ?>" placeholder="New City" required>
        <input type="text" name="new_college" value="<?php echo $currentCollege; ?>" placeholder="New College" required>
        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
