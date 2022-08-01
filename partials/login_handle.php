<?php

if($_SERVER['REQUEST_METHOD']=="POST")
{
  include '_dbconnect.php';
    

    $user=$_POST['username'];
    $pass=$_POST['password'];
    $sql3="SELECT * FROM `users` WHERE user_name='$user';";
    $result3=mysqli_query($con,$sql3);
    $num1=mysqli_num_rows($result3);
    if($num1==1)
    {
      $row=mysqli_fetch_assoc($result3);
      if(password_verify($pass,$row['password'])){
        $login=true;
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$user;
        header("location:/forum/index.php?login=true");
      }
      else{
        $notmatch=true;
        header("location:/forum/index.php?notmatch=true");
      }
    }
    else{
        header("location:/forum/index.php?notmatch=true");
    }
}
?>