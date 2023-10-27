<?php
@include 'db_connect.php';
$query = "SELECT RoomId,RoomNo,Capacity,Occupants,Availablility FROM rooms";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Availability</title>
    <link rel="stylesheet" href="roomAvailable.css">
</head>

<body>
    <div class="navBar" id="navBar">
            <div class="title">
                <a href="home.html"><img src="images/logo.svg" alt="logo" width="55px"></a><p>CCS</p>
            </div>
                <ul>
                    <li class="navL"><a href="login.html" id="logout">Sign Out</a></li>
                </ul>
        </div>
        <div class="container1">
        <div class="table-container">
        <div class="heading">
            <img src="images/search.svg" alt="img" class="check-img">
            <p class="heading__title">Book Your Room Now</p><br>
        </div>
        <p class="sub-heading">Dear Student, please check the room availability and click on Book Now for further process.</p>
        <table class="room-table">
            <tr class="heading-row">
                <th class="table-heading">RoomNo</th>
                <th class="table-heading">Capacity</th>
                <th class="table-heading">Occupants</th>
                <th class="table-heading">Availability</th>
                <th class="table-heading">Action</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr class='table-row'>";
                echo "<td class='room-no'>" . $row['RoomNo'] . "</td>";
                echo "<td class='table-data'>" . $row['Capacity'] . "</td>";
                echo "<td class='table-data'>" . $row['Occupants'] . "</td>";
                // echo "<td class='table-data available'>" . $row['Availablility'] . "</td>";
                echo "<td class='table-data'>";
                if ($row['Availablility'] == 'Available') {
                    echo "<p class='available'>". $row['Availablility'] ."</p>";
                } else if($row['Availablility'] == 'Not Available'){
                    echo "<p class='not-available'>". $row['Availablility'] ."</p>";
                }
                echo "</td>";
                echo "<td class='book-now'>";
                if ($row['Availablility'] == 'Available') {
                    echo "<a href='booking_page.php?id=" . $row['RoomId'] . "' class='book-link'>Book Now</a>";
                } else {
                    echo "<a href='booking_page.php?id=" . $row['RoomId'] . "' class='book-link disabled'>Book Now</a>";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        </div>
    </div>
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