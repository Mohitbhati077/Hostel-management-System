<?php
include 'db_connect.php';
if(isset($_GET['id'])){
    $noticeid=$_GET['id'];
    $deletequery="DELETE FROM notices WHERE id=$noticeid";
    $deleteresult=mysqli_query($conn,$deletequery);
    if($deleteresult){
        echo "<script>alert('Delete successful!');window.location.href='view_notice.php';</script>";
    }else{
        echo '<p class="error">Error Updating notice:' .mysqli_error($conn).'</p>';
    }
    mysqli_close($conn);
}else{
    echo '<p class="error">Invaild Request.</p>';
}
?>