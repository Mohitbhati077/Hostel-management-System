<?php
@include'db_connect.php';
$query="SELECT RoomId,RoomNo,Capacity,Occupants,Availablility FROM rooms";
$result=mysqli_query($conn,$query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Availablility</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container1">
    <h1>Check Room Availablility</h1>
    <table border="1">
        <tr>
            <th>RoomNo</th>
            <th>Capacity</th>
            <th>Occupants</th>
            <th>Availablility</th>
            <th>Action</th>
        </tr>
        <?php
               while($row=mysqli_fetch_assoc($result)){
                echo"<tr>";
                echo"<td>".$row['RoomNo']."</td>";
                echo"<td>".$row['Capacity']."</td>";
                echo"<td>".$row['Occupants']."</td>";
                echo"<td>".$row['Availablility']."</td>";
                echo"<td>";
                if($row['Availablility']=='Available'){
                    echo "<a href='booking_page.php?id=" .$row['RoomId']."'>Book Now</a>";
                }else{
                    echo"Not avaiable";
                }
                echo"</td>";
                echo"</tr>";
               }
        ?>
    </table>
</div>
</body>
</html>