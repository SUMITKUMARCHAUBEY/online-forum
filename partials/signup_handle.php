<?php

include '_dbconnect.php';
if($_SERVER["REQUEST_METHOD"]=="POST")
{
  $email=$_POST['username'];
  $pass=$_POST['password'];
  $cpass=$_POST['cpass'];
  $sql="SELECT * FROM `users` WHERE user_name='$email';";
  $result=mysqli_query($con,$sql);
  $num=mysqli_num_rows($result);
  if($num==0)
  {
    if($pass==$cpass)
    {
      $hash=password_hash($pass,PASSWORD_DEFAULT);
      $sql2="INSERT INTO `users` (`sl_no`, `user_name`, `password`, `time`) VALUES (NULL, '$email', '$hash', current_timestamp());";
      mysqli_query($con,$sql2); 
      
      header("location:/myimdb/home.php?signup=true"); 
     
      exit();
    }
    else
    {
        header("location:/myimdb/home.php?cpassfail=true");
    }
  }
  else{
    header("location:/myimdb/home.php?userexist=true");
  }
}


?>