<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Notice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Notice</h1>
    <?php
     include 'db_connect.php';
     if(isset($_GET['id'])){
        $noticeid=$_GET['id'];
        $query="SELECT * FROM notices WHERE id=$noticeid";
        $result=mysqli_query($conn,$query);
        if($result && mysqli_num_rows($result)>0){
            $notice=mysqli_fetch_assoc($result);
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $newtitle=$_POST['title'];
                $newmessage=$_POST['message'];
                $updatequery="UPDATE notices SET title='$newtitle',message='$newmessage'WHERE id=$noticeid";
                $updateresult=mysqli_query($conn,$updatequery);
                if($updateresult){
                    echo "<script>alert('Update successful!');window.location.href='view_notice.php';</script>";
                }else{
                    echo '<p class="error">Error Updating notice:' .mysqli_error($conn).'</p>';
                }
            }
            ?>
            <form action="" method="POST">
                <label for="title">Notice Title:</label>
                <input type="text" id="title" name="title" value="<?php echo $notice['title'];?>"required><br>
                <label for="message">Notice Message:</label>
                <textarea name="message" id="message"  rows="4" required><?php echo $notice['message'];?></textarea><br>
                <input type="submit" value="Update Notice">
            </form>
            <?php
        }else{
            echo '<p class="error">Notice not found.</p>';
        }
        mysqli_close($conn);
    }else{
        echo '<p class="error">Invaild Request.</p>';
    }
    ?>
</body>
</html>