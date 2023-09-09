<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Room Booking</h1>
    <form action="process_page.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required><br>
    
    <label for="dob">Date Of Birth:</label>
    <input type="date" id="dob" name="dob" required><br>

    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" required><br>

    <label for="state">State:</label>
    <input type="text" id="state" name="state" required><br>

    <label for="city">City:</label>
    <input type="text" id="city" name="city" required><br>

    <label for="college">College:</label>
    <input type="text" id="college" name="college" required><br>

    <input type="hidden" name="id" value='<?php echo $_GET['id']; ?>'>
    <input type="submit" value="submit">
</form>
</body>
</html>