<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h1>Admin Login</h1>
        <?php
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                include 'db_connect.php';
                $username=$_POST['username'];
                $password=$_POST['password'];
                $query="SELECT * from admin WHERE username='$username'";
                $result=mysqli_query($conn,$query);
                if($result && mysqli_num_rows($result)>0){
                    $admin=mysqli_fetch_assoc($result);
                    if(password_verify($password,$admin['password'])){
                        session_start();
                        $_SESSION['admin_id']=$admin['admin_id'];
                        header("Location:admin_dashboard.php");
                        exit();
                    }else{
                        echo"Invaild Password";
                    }
                }else{
                    echo"Invalid Username";
                }
                  mysqli_close($conn);
            }

        ?>
        <form action="admin_login.php" method="post">
            <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <input type="submit" value="Login">
    </form>
    </div>
</body>
</html>