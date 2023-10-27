<?php
session_start();
if(!isset($_SESSION['s_id'])){
    header("Location:login.html");
    exit();
}
include 'db_connect.php';

$studentid=$_SESSION['s_id'];
$reminderquery="SELECT * FROM reminder WHERE s_id= $studentid ORDER BY read_status ASC,sent_date DESC";
$reminderresult=mysqli_query($conn,$reminderquery);
$hasReminders = mysqli_num_rows($reminderresult) > 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <!-- <script src="dashboard.js"></script> -->
</head>
<body>
    <div class="parent">
        <div class="nav">
            <div class="title">
                <img src="images/logo.svg" alt="logo"><p>CCS</p>
            </div>
            <nav class="navbar">
                <ul>
                    <li class="nav-list"><img src="images/home.svg" alt="" class="nav-list__logo"><a href="dashboard.php">Home</a></li>
                    <li class="nav-list"><img src="images/notice.svg" alt="" class="nav-list__logo"><a href="view_notices.php">Notice</a></li>
                    <li class="nav-list"><img src="images/reminder.svg" alt="" class="nav-list__logo"><a href="#reminders">Reminders</a></li>
                    <li class="nav-list"><img src="images/lstfound.svg" alt="" class="nav-list__logo"><a href="#lostFound">Lost&Found</a></li>
                    <li class="nav-list"><img src="images/review.svg" alt="" class="nav-list__logo"><a href="#reviews">Reviews</a></li>
                </ul>
            </nav>
        </div>
        <header>
            <img src="images/profile-circle.svg" alt="" class="profile">
        </header>
        <?php
             
             $query="SELECT * FROM notices ORDER BY created_at DESC";
             $result=mysqli_query($conn,$query);
             $notices=array();
             while($notice=mysqli_fetch_assoc($result)){
                $notices[]=$notice;
             }
            //  mysqli_close($conn);
        ?>
        <div class="screen">
            <div class="notice screen-div" id="notice">
                <p class="sub-title">Notice</p>
                <div class="border"></div>
                <ul>
                    <?php
                          $count=0;
                          foreach($notices as $notice){
                            if($count<2){
                            echo '<li>';
                            echo '<strong>' .$notice['title'].'</strong>';
                            echo '<p>' .$notice['message'].'</p>';
                            echo '<p>' .$notice['created_at'].'</p>';
                            echo '</li>';
                            $count++;
                          }else{
                            break;
                          }
                        }
                    ?>
                </ul>
                <?php
                if(count($notices)>2){
                echo '<a href="view_notices.php" id="viewMoreNotices">View More Notices</a>';
                }
                ?>
            </div>
            <div class="reminders screen-div" id="reminders">
                <p class="sub-title">Reminders</p>
                <div class="border"></div>
                <ul>
        <?php while ($reminder = mysqli_fetch_assoc($reminderresult)) { ?>
            <li>
                <?php
                if ($reminder['read_status'] == '0') {
                    // Mark the reminder as read when displayed
                    $reminderId = $reminder['reminder_id'];
                    mysqli_query($conn, "UPDATE reminder SET read_status = '1' WHERE reminder_id = $reminderId");
                }
                ?>
                <p><?php echo $reminder['title']; ?></p>
                <p><?php echo $reminder['message']; ?></p>
                <p>Sent on: <?php echo $reminder['sent_date']; ?></p>
                <?php if ($reminder['read_status'] == '0') { ?>
                    <p>Status: Unread</p>
                <?php } else { ?>
                    <p>Status: Read</p>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
    

            </div>
            <div class="lostFound screen-div" id="lostFound">
                <p class="sub-title">Lost and Found</p>
                <div class="border"></div>
            </div>
            <div class="reviews screen-div" id="reviews">
                <p class="sub-title">Reviews</p>
                <div class="border"></div>
            </div>
        </div>
    </div>
    <script>
     document.addEventListener('DOMContentLoaded', function () {
    const viewMoreButton = document.getElementById('viewMoreNotices');

    // Function to redirect to the "view notice" page
    function redirectToViewNoticesPage() {
        window.location.href = 'view_notices.php'; // Change 'view_notices.php' to the actual URL of your view notice page
    }

    // Attach a click event to the "View More Notices" button
    if (viewMoreButton) {
        viewMoreButton.addEventListener('click', redirectToViewNoticesPage);
    }
});


    </script>
</body>
</html>