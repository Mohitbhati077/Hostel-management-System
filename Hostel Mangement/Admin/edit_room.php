<?php
// Include your database connection file (e.g., db_connect.php)
include 'db_connect.php';

// Check if the room ID is provided in the URL
if (isset($_GET['room_id'])) {
    $roomID = $_GET['room_id'];

    // Fetch the room details from the database based on the room ID
    $selectQuery = "SELECT * FROM rooms WHERE RoomId = $roomID";
    $result = mysqli_query($conn, $selectQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        $room = mysqli_fetch_assoc($result);
    } else {
        // Handle room not found
        echo "Room not found.";
        exit();
    }
} else {
    // Handle missing room ID parameter
    echo "Room ID is missing.";
    exit();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $roomNo = $_POST['room_no'];
    $capacity = $_POST['capacity'];
    $availability = $_POST['availability'];

    // Update the room details in the database
    $updateQuery = "UPDATE rooms SET RoomNo = '$roomNo', Capacity = '$capacity', Availablility = '$availability' WHERE RoomID = $roomID";
    if (mysqli_query($conn, $updateQuery)) {
        // Room updated successfully, redirect to the room management page or show a success message
        header("Location: manage_room.php?success=1"); // Redirect to the room management page
        exit();
    } else {
        // Handle database error
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Edit Room</h1>
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
        <section class="edit-room-form">
            <h2>Edit Room</h2>
            <form action="edit_room.php?room_id=<?php echo $roomID; ?>" method="POST">
                <!-- Hidden field to pass the room ID -->
                <input type="hidden" name="room_id" value="<?php echo $roomID; ?>">
                <label for="room_no">Room Number:</label>
                <input type="text" id="room_no" name="room_no" value="<?php echo $room['RoomNo']; ?>" required>
                <label for="capacity">Capacity:</label>
                <input type="number" id="capacity" name="capacity" value="<?php echo $room['Capacity']; ?>" required>
                <label for="availability">Availability:</label>
                <select id="availability" name="availability" required>
                    <option value="Available" <?php if ($room['Availablility'] === 'Available') echo 'selected'; ?>>Available</option>
                    <option value="Not Available" <?php if ($room['Availablility'] === 'Not Available') echo 'selected'; ?>>Not Available</option>
                </select>
                <button type="submit">Update Room</button>
            </form>
        </section>
    </main>
</body>
</html>
