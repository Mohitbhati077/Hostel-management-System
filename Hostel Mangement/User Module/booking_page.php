<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking</title>
    <link rel="stylesheet" href="booking_page.css">
</head>

<body>
    <div class="container">
        <div class="title">
            <a href="home.html"><img src="images/logo.svg" alt="logo"></a>
            <p>ICCS</p>
        </div>
        <div class="form_container">
            <form action="process_page.php" method="post" class="form">
                <p class="heading">book your room now</p>
                <p class="line">Become an ICCS member. Fill up the necessary details given below.</p>
                <div class="field-holder">
                    <input type="text" id="name" name="name" required>
                    <label for="name">Name</label>
                </div>

                <div class="field-holder">
                    <input type="text" id="address" name="address" required>
                    <label for="address">Address</label>
                </div>
                <div class="field-holder">
                    <input type="tel" id="phone" name="phone" required>
                    <label for="phone">Phone</label>
                </div>
                <div class="field-holder">
                    <input type="text" id="state" name="state" required>
                    <label for="state">State</label>
                </div>
                <div class="field-holder">
                    <input type="text" id="city" name="city" required>
                    <label for="city">City:</label>
                </div>
                <div class="field-holder">
                    <input type="text" id="college" name="college" required>
                    <label for="college">College</label>
                </div>
                <input type="hidden" name="id" value='<?php echo $_GET['id']; ?>'>
                <input type="submit" value="submit" class="submit-btn">
            </form>
        </div>
    </div>
</body>

</html>