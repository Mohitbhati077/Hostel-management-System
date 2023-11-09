<?php
session_start();
if(!isset($_SESSION['s_id'])){
    header("Location:login.html");
    exit();
}
include 'db_connect.php';
// $student_id = $_SESSION['s_id'];
// $profilequery = "SELECT name, email FROM students WHERE s_id = $student_id";
// $profileresult = mysqli_query($conn, $profilequery);

// if ($profileresult && mysqli_num_rows($profileresult) > 0) {
//     $row = mysqli_fetch_assoc($profileresult);
//     $studentName = $row['name'];
//     $studentEmail = $row['email'];
// } else {
//     // Handle the case where the student's data couldn't be retrieved
//     $studentName = "Unknown"; // Provide a default name
//     $studentEmail = "Unknown"; // Provide a default email
// }

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
                    <li class="nav-list"><img src="images/lstfound.svg" alt="" class="nav-list__logo"><a href="lost_found.php">Lost&Found</a></li>
                    <li class="nav-list"><img src="images/review.svg" alt="" class="nav-list__logo"><a href="review.php">Reviews</a></li>
                </ul>
            </nav>
        </div>
        <header>
        <img src="images/profile-circle.svg" class="profile" id="profile-image" onclick="toggleMenu()">

        <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
                <div class="user-info">
                    <!-- <h2>Mohit Bhati</h2> -->
                    <?php
           
                        include 'db_connect.php'; 

                        $student_id = $_SESSION['s_id'];
                        $query = "SELECT f_name FROM students WHERE s_id = $student_id";
                        $result = mysqli_query($conn, $query);

                         if ($result && mysqli_num_rows($result) > 0) {
                         $row = mysqli_fetch_assoc($result);
                        $studentName = $row['f_name'];
                        echo "<h2> Hello,$studentName</h2>";
            } else {
               
                        echo "<h2>Unknown</h2>";
            }
            //mysqli_close($conn);
            ?>
                </div>
                <a href="editprofile.php" class="sub-menu-link">
                    <p>Edit Profile</p>
                    <span>></span>
                </a>
                <a href="logout.php" class="sub-menu-link">
                    <p>Logout</p>
                    <span>></span>
                </a>
            </div>

        </div>
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
        window.location.href = 'view_notices.php'; 
    }

    
    if (viewMoreButton) {
        viewMoreButton.addEventListener('click', redirectToViewNoticesPage);
    }
});

// const profileImage = document.getElementById('profile-image');
// const profileDropdown = document.getElementById('profile-dropdown');

// profileImage.addEventListener('click', function (event) {
//     event.stopPropagation(); // Prevent the click event from propagating
//     profileDropdown.style.display = (profileDropdown.style.display === 'block') ? 'none' : 'block';
// });

// // Close the dropdown when clicking outside of it
// document.addEventListener('click', function (event) {
//     if (event.target !== profileImage) {
//         profileDropdown.style.display = 'none';
//     }
// });
// profileImage.addEventListener('click', function (event) {
//     event.stopPropagation();
//     profileContainer.classList.toggle('open');
// });

// document.addEventListener('click', function (event) {
//     if (event.target !== profileImage) {
//         profileContainer.classList.remove('open');
//     }
// });
 </script>
<script>
    let subMenu=document.getElementById("subMenu");
    function toggleMenu(){
        subMenu.classList.toggle("open-menu");
    }
</script>
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
    
</body>
</html>