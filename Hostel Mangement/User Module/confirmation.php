<?php
@include 'db_connect.php';
session_start();

if(isset($_SESSION['s_id'])) {
    $studentID = $_SESSION['s_id'];

    $query = "SELECT resid, name, address, phone, state, city, clgname, status FROM reservation WHERE s_id = '$studentID'";
    $result = mysqli_query($conn, $query);

    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Fetch the reservation details
        $resID = $row['resid'];
        $name = $row['name'];
        $address = $row['address'];
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
    <link rel="stylesheet" href="confirmation.css">
    <script src="https://kit.fontawesome.com/19461f0c8d.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="left flex-column">
        <?php
        if(isset($errorMessage)) {
            echo "<p class='error-msg'>$errorMessage</p>";
        } else {
            echo"<div class='details'>";
            echo"<div class='details__heading'>";
            echo "<h2 class='heading'>Your Final Details</h2>";
            echo "<p>Thank you for reserving a room in our hostel. Here are details of your reservation:</p>";
            echo"</div>";
            echo "<p class='details__point'>Reservation ID:<span>$resID</span></p>";
            echo "<p class='details__point'>Name:<span>$name</span></p>";
            echo "<p class='details__point'>Address:<span>$address</span></p>";
            echo "<p class='details__point'>Phone Number:<span>$phone</span></p>";
            echo "<p class='details__point'>State:<span>$state</span></p>";
            echo "<p class='details__point'>City:<span>$city</span></p>";
            echo "<p class='details__point'>College Name:<span>$college</span></p>";
            echo "<p class='details__point'>Status:<span>$status</span></p>";
        }
        
        echo"<a href='editreservation.php?resid=$resID'><button class='btn edit'>Edit</button></a>";
        ?>
        <p>Your reservation is currently pending. Please proceed to the payment gateway<br>to complete your payment and confirm your reservation.</p>
        <div class="buttons">
        <a href="payment_details.php"><button class="btn payment"><i class="fa-regular fa-credit-card"></i>Proceed to Payment</button></a>
        
        
        </div>
        </div>
        </div>
        <div class="right">
            <div class="image-section flex-column">
                <p>Hey! You're One Step Away From Being An ICCS Hostelite.</p>
                <img src="images/reservation-img.png" alt="image here" class="image">
            </div>
        </div>
    </div>
</body>
</html>
