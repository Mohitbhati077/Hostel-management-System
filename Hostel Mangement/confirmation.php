<?php
@include 'db_connect.php';
session_start();

if(isset($_SESSION['s_id'])) {
    $studentID = $_SESSION['s_id'];

    $query = "SELECT resid, name, address, dob, phone, state, city, clgname, status FROM reservation WHERE s_id = '$studentID'";
    $result = mysqli_query($conn, $query);

    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Fetch the reservation details
        $resID = $row['resid'];
        $name = $row['name'];
        $address = $row['address'];
        $dob = $row['dob'];
        $phone = $row['phone'];
        $state = $row['state'];
        $city = $row['city'];
        $college = $row['clgname'];
        $status = $row['status'];
    } else {
        // No reservation found for the student
        $errorMessage = "No reservation found.";
    }

    mysqli_close($conn);
} else {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container1">
        <h1>Reservation Confirmation</h1>
        <p>Thank you for reserving a room in our hostel. Here are details of your reservation:</p>
        
        <?php
        if(isset($errorMessage)) {
            echo "<p>$errorMessage</p>";
        } else {
            // Display the reservation details
            echo "<p><strong>Reservation ID:</strong> $resID</p>";
            echo "<p><strong>Name:</strong> $name</p>";
            echo "<p><strong>Address:</strong> $address</p>";
            echo "<p><strong>Date of Birth:</strong> $dob</p>";
            echo "<p><strong>Phone Number:</strong> $phone</p>";
            echo "<p><strong>State:</strong> $state</p>";
            echo "<p><strong>City:</strong> $city</p>";
            echo "<p><strong>College Name:</strong> $college</p>";
            echo "<p><strong>Status:</strong> $status</p>";
            
        }
        ?>
        <p>Your reservation is currently pending. Please proceed to the payment gateway to complete your payment and confirm your reservation.</p>
        <a href="payment_details.php" class="btn">Proceed to Payment</a>
        <?php
        echo"<a href='editreservation.php?resid=$resID' class='btn'>Edit</a>";
        ?>
    </div>
</body>
</html>
