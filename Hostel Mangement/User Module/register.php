<?php
  @include'db_connect.php';
  $firstname=$_POST['firstname'];
  $lastname=$_POST['lastname'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $cpassword=$_POST['cpassword'];
   
  if($password!=$cpassword){
    echo "<script>alert('Password do not match.Please try again.');window.location.href='register.html';</script>";
  }else{
    $checkquery="SELECT COUNT(*) as count FROM students WHERE email='$email'";
    $checkresult=mysqli_query($conn,$checkquery);
    if($checkresult){
        $row=mysqli_fetch_assoc($checkresult);
        if($row['count']>0){
            echo "<script>alert('Email already exits.Please Login.');window.location.href='register.html';</script>";
        }else{
            $hashedpassword=password_hash($password,PASSWORD_DEFAULT);
            $insertquery="INSERT INTO students(f_name,l_name,email,password) VALUES('$firstname','$lastname','$email','$hashedpassword')";
            $insertresult=mysqli_query($conn,$insertquery);
            if($insertresult){
               echo"<script>alert('Registration successfull!');window.location.href='login.html';</script>";
            }else{
                echo"<script>alert('Registration Failed.');window.location.href='register.html';</script>";
            }
        }
    }else{
        echo"Error Checking Email.";
    }
  }
  mysqli_close($conn);
  ?>