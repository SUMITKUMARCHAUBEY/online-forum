<?php
include 'partials/_dbconnect.php';
include 'partials/_header.php';


$empty=false;
$added=false;
$notadded=false;
$cata=$_GET['thread_id'];
if($_SERVER['REQUEST_METHOD']=="POST")
{
  $uuid=$_GET['uid'];
  $comment=$_POST["comment"];
  $comment=str_replace('<','&lt',$comment);
  $comment=str_replace('>','&gt',$comment);
  $sql="INSERT INTO `comments` (`com_id`, `thread_id`, `com_desc`, `com_user_id`, `time`) VALUES (NULL, '$cata', '$comment', '$uuid', current_timestamp());";
  $result=mysqli_query($con,$sql);
  if($result)
  {
    $added=true;
  }
  else{
    $notadded=true;
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
   <center> <h1>Online Forum</h1></center>

    <?php
   
if( $added==true){
  echo '<div class="alert alert-success" role="alert">
 Posted!!!.
</div>';
}
if( $notadded==true){
  echo '<div class="alert alert-danger" role="alert">
 Something went wrong, please try again.
</div>';
}

$cata=$_GET['thread_id'];
$sql6="SELECT * FROM `threads` WHERE thread_id=$cata;";
$result6=mysqli_query($con,$sql6);
while($row=mysqli_fetch_assoc($result6)){
    $desc=$row['thread_desc'];
 echo '<div class="container my-5 mx-6">
 <h1>Browse Questions</h1>
 <div class="media my-3">
<img class="mr-3" src="img1.webp" width=104px alt="Generic placeholder image">
<div class="media-body my-3">
<h3 class="mt-0 my-3">'.$row['thread_title'].'</h3>
<h5 class="my-3 mx-8">'.$row['thread_desc'].'</h5>
</div>
</div>
</div>'; 
}
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

  $thr_unam=$_SESSION['username'];

  
  $sql12="SELECT * FROM `users` WHERE user_name='$thr_unam';";
  $result12=mysqli_query($con,$sql12);
  $row12=mysqli_fetch_assoc($result12);
  $uid=$row12['sl_no'];


echo '<div class="container">
<form action="thread.php?uid='.$uid.' && thread_id='.$cata.'" method="post">
<div class="form-group">
  <label for="exampleFormControlTextarea1"><h2>Comment</h2></label>
  <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
  <button type="submit" class="btn btn-success my-3">Submit</button>
</div>



</form>
</div>

';
}

  else{
    echo '<h1 class="container " style="height:120px; text-align:center;"><b>Please login to open a conversation.</b><br>
    <button type="button" class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#loginmodal">LogIn</button>
        <button type="button" class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#signupmodal">SignUp</button></h1>';
  }



   ?>



<div class="container my-5"><h2><b>Disicussion</b></h2>
<?php
   $empty=true;
   $sql4="SELECT * FROM `comments` WHERE thread_id=$cata;";
   $result4=mysqli_query($con,$sql4);
   while($row=mysqli_fetch_assoc($result4)){
    $empty=false;

    $thr_uid=$row['com_user_id'];
    // echo $thr_uid;
    $sql11="SELECT * FROM `users` WHERE sl_no=$thr_uid;";
    $result11=mysqli_query($con,$sql11);
    $row11=mysqli_fetch_assoc($result11);

    echo '<div class="container my-5 mx-6">
   
    <div class="media my-3">
<img class="mr-3" src="img1.webp" width=54px alt="Generic placeholder image">
<div class="media-body">
  '.$row['com_desc'].'
</div>
</div>
<div style="text-align: right;"><b>posted by :- '.$row11['user_name'].'</b>
</div>
</div><hr>'; 
   }
   if($empty)
   {
    echo '<div class="jumbotron jumbotron-fluid my-4">
    <div class="container">
      <p class="display-5">No Answers Yet!!</p>
      <p class="lead">Be the first person to answer this question.</p>
    </div>
  </div>';
   }
   ?>
    </div>



          
         
         



  
    <?php
    include 'partials/_footer.php';
    
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>