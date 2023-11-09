<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $item_id = $_GET['id'];
    
    $query = "SELECT * FROM lost_found WHERE item_id = $item_id";
    $result = mysqli_query($conn, $query);
    $item = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $item_id = $_POST['item_id'];
    $new_status = $_POST['new_status'];

    $update_query = "UPDATE lost_found SET status = '$new_status' WHERE item_id = $item_id";
    if (mysqli_query($conn, $update_query)) {
       
        echo "<script>alert('Update successful!');window.location.href='lost_found.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Lost and Found Status</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Update Lost and Found Status</h1>
    <a href="view_lost_found.php">Back to Lost and Found</a>

    <form action="" method="POST">
        <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
        <label for="new_status">Change Status:</label>
        <select name="new_status">
            <option value="Lost" <?php if ($item['status'] === 'Lost') echo "selected"; ?>>Lost</option>
            <option value="Found" <?php if ($item['status'] === 'Found') echo "selected"; ?>>Found</option>
        </select>
        <button type="submit">Update Status</button>
    </form>
</body>
</html>
