<?php
  @include'db_connect.php';
  $firstname=$_POST['firstname'];
  $lastname=$_POST['lastname'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $cpassword=$_POST['cpassword'];
   
  if($password!=$cpassword){
    echo "Password do not match.Please try again.";
  }else{
    $checkquery="SELECT COUNT(*) as count FROM students WHERE email='$email'";
    $checkresult=mysqli_query($conn,$checkquery);
    if($checkresult){
        $row=mysqli_fetch_assoc($checkresult);
        if($row['count']>0){
            echo "Email already exits.Please Login";
        }else{
            $hashedpassword=password_hash($password,PASSWORD_DEFAULT);
            $insertquery="INSERT INTO students(f_name,l_name,email,password) VALUES('$firstname','$lastname','$email','$hashedpassword')";
            $insertresult=mysqli_query($conn,$insertquery);
            if($insertresult){
               echo"<script>alert('Registration successfull!');window.location.href='login.html';</script>";
            }else{
                echo"Registration Failed";
            }
        }
    }else{
        echo"Error Checking Email.";
    }
  }
  mysqli_close($conn);
  ?>