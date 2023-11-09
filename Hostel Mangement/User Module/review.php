<?php
session_start();
if(!isset($_SESSION['s_id'])){
    header("Location:login.html");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_connect.php'; 
    $student_id = $_SESSION['s_id'];
    $review_text = $_POST['review_text'];
    $rating = $_POST['rating'];

    $insert_query = "INSERT INTO reviews (s_id, review_text, rating, review_date) 
                     VALUES ('$student_id', '$review_text', '$rating', NOW())";

    if (mysqli_query($conn, $insert_query)) {
        //echo "Review submitted successfully";
        header("Location:dashboard.php"); 
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="review.php" method="POST">
     <!-- Hidden student id-->
    <input type="hidden" name="student_id" value="<?php echo $_SESSION['s_id'];?>">

    <!-- Review Text Area -->
    <textarea name="review_text" placeholder="Write your review here" required></textarea>
    <!-- Star Rating -->
    <div class="star-rating">
        <input type="radio" name="rating" value="5" id="5-stars" required>
        <label for="5-stars"></label>
        <input type="radio" name="rating" value="4" id="4-stars">
        <label for="4-stars"></label>
        <input type="radio" name="rating" value="3" id="3-stars">
        <label for="3-stars"></label>
        <input type="radio" name="rating" value="2" id="2-stars">
        <label for="2-stars"></label>
        <input type="radio" name="rating" value="1" id="1-star">
        <label for="1-star"></label>
    </div>

    <!-- Submit Button -->
    <button type="submit">Submit Review</button>
</form>

</body>
</html>