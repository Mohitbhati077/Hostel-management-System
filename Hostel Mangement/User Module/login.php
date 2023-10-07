<?php
@include 'db_connect.php';
$email = $_POST['email'];
$password = $_POST['password'];
$query = "SELECT * FROM students WHERE email='$email'";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        session_start();
        $_SESSION['s_id'] = $row['s_id'];
        
        // Check if the student has made a payment
        $studentID = $_SESSION['s_id'];
        $paymentQuery = "SELECT * FROM payment_record WHERE s_id = '$studentID'";
        $paymentResult = mysqli_query($conn, $paymentQuery);
        
        $resquery = "SELECT * FROM reservation WHERE s_id=" . $_SESSION['s_id'];
        $reservresult = mysqli_query($conn, $resquery);

        if (mysqli_num_rows($paymentResult) > 0) {
            // Student has made a payment, set session variable and redirect to Wait For Confirmation page
            $paymentrecord=mysqli_fetch_assoc($paymentResult);
            if($paymentrecord['payment_status']=='pending'){
                header("Location: wait_for_confirmation.php");
            exit();
         } else{
            echo "<script>alert('Login successful! Welcome to Student Dashboard');window.location.href='dashboard.php';</script>";
            // header("Location:dashboard.html");
            exit();
        }
    } elseif (mysqli_num_rows($reservresult)>0){
            header("Location:confirmation.php");
            exit();
        } else {
                echo "<script>alert('Login successful!');window.location.href='room_avail.php';</script>";
                exit();
            }
        } else {
        echo "Invalid password";
    } 
}
else {
    echo "Invalid email.";
}
mysqli_close($conn);
?>
