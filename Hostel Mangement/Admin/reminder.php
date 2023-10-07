<?php
// session_start();
// if(!isset($_SESSION['admin_id'])){
//     header("Location:admin_login.php");
//     exit();
// }
include 'db_connect.php';
$studentquery="SELECT s_id,f_name from students";
$studentresult=mysqli_query($conn,$studentquery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Reminder</h1>
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
          <section class="send-reminder-form">
             <h2> Compose Reminder</h2>
             <!-- Add this button to your reminder.php file -->
              <button onclick="location.href='view_reminder.php';">View Reminder</button>

             <form action="process_send_reminder.php" method="POST">
              <label for="student">Select Student:</label>
              <select name="student" id="student">
               <?php
               while($row=mysqli_fetch_assoc($studentresult)){
                echo '<option value="' .$row['s_id']. '">'.$row['f_name'].'</option>';
               }
               mysqli_close($conn);
               ?>  
              </select>
           <label for="title">Title:</label>
           <input type="text" name="title" id="title" required>
           <label for="message">Message:</label>
           <textarea name="message" id="message" rows="4" required></textarea>
           <!-- <button type="button" id="sendReminderButton">Send Reminder</button> -->
           <button type="submit">Send Reminder</button>
             </form>
          </section>
     </main>
     <script>
        document.addEventListener('DOMContentLoaded',function(){
            var logoutbutton=document.getElementById('logout');
            logoutbutton.addEventListener('click',function(event){
                event.preventDefault();
                var confirmLogout=confirm("Are you sure you want to log out?");
                if(confirmLogout){
                    window.location.href='logout.php';
                }
            });
        });
    </script>
     <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $("#sendReminderButton").click(function() {
        // Assuming you want to send reminders to selected students
        var studentID = $("#student").val(); // Get the selected student ID
        var title = $("#title").val(); // Get the title from the input
        var message = $("#message").val(); // Get the message from the textarea

        // Make an AJAX request to trigger the reminder sending
        $.ajax({
            type: "POST",
            url: "process_send_reminder.php",
            data: {
                student: studentID,
                title: title,
                message: message
            },
            success: function(response) {
                // Handle the response from the server (e.g., display a success message)
                alert("Reminder sent successfully!");
            },
            error: function() {
                // Handle errors if the request fails
                alert("Error sending reminder.");
            }
        });
    });
});
</script> -->

</body>
</html>