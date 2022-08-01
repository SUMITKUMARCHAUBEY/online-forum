<?php
 $success=false;
 $unsuccess=false;
 $cata=$_GET['cata'];

include 'partials/_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST")
{
  
  $uuid=$_GET['uid'];
  $title=$_POST['title'];
  $title=str_replace('<','&lt',$title);
  $title=str_replace('>','&gt',$title);
  $desc=$_POST['desc'];
  $desc=str_replace('<','&lt',$desc);
  $desc=str_replace('>','&gt',$desc);

  $sql="INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_user_id`, `thread_cat_id`, `timestamp`) VALUES (NULL, '$title', '$desc', '$uuid', '$cata', current_timestamp());";
  $result=mysqli_query($con,$sql);
  if($result)
  {
    $success=true;
  }
  else{
    $unsuccess=true;
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
  
   
<?php
  include 'partials/_header.php';
  if( $success)
  {
    echo '<div class="alert alert-success" role="alert">
    Successful!!<br>
    You problem has been up-loaded successfully, please wait for someone to respond.
   </div>';
  } 

  if($unsuccess)
  {
    echo '<div class="alert alert-danger" role="alert">
    Something went wrong!!<br>
    Please try again.
   </div>';
  }
  $sql4="SELECT * FROM `catagories` WHERE sl_no=$cata;";
   $result4=mysqli_query($con,$sql4);
   while($row=mysqli_fetch_assoc($result4)){
    echo ' 
    <div class="container my-5 mx-4">
   <div class="jumbotron">
  <h1 class="display-4 my-5 ">'.$row['catagory_name'].'</h1>
  <p class="lead mx-10 ">'.$row['catagory_discription'].'</p>
  
</div>
   </div>
';
 }
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

  $thr_unam=$_SESSION['username'];

  
  $sql12="SELECT * FROM `users` WHERE user_name='$thr_unam';";
  $result12=mysqli_query($con,$sql12);
  $row12=mysqli_fetch_assoc($result12);
  $uid=$row12['sl_no'];
  // echo $uid;


 echo' <div class="container my-5">
 <h2 class="my-4">Open a conversation</h2>
 <form action="_threads_list.php?uid='.$uid.' && cata='.$cata.'" method="post">
<div class="mb-3">
  <label for="exampleInputEmail1" class="form-label">Title of the problem</label>
  <input type="text" name="title" id="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  <div id="emailHelp" class="form-text">keep the title short and crisp</div>
</div>
<div class="mb-3">
  <label for="exampleInputPassword1" class="form-label">Describe your problem.</label>
  <input type="text" name="desc" id="desc" class="form-control" id="exampleInputPassword1" required>
</div>

<button type="submit" class="btn btn-success">Submit</button>
</form></div>';
}
else{
  echo '<h1 class="container " style="height:120px; text-align:center;"><b>Please login to open a conversation.</b><br>
  <button type="button" class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#loginmodal">LogIn</button>
      <button type="button" class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#signupmodal">SignUp</button></h1>';
}
echo '<h1 class="container mx-5"><b>Browse Questions</b></h1>';  



   $empty=true;
   $sql4="SELECT * FROM `threads` WHERE thread_cat_id=$cata;";
   $result4=mysqli_query($con,$sql4);
   while($row=mysqli_fetch_assoc($result4)){
    $empty=false;
    $thr_id=$row['thread_id'];
    $thr_uid=$row['thread_user_id'];
    // echo $thr_uid;
    $sql11="SELECT * FROM `users` WHERE sl_no=$thr_uid;";
    $result11=mysqli_query($con,$sql11);
    $row11=mysqli_fetch_assoc($result11);
    
    
   
    echo '<div class="container my-5 mx-6">
   
    <div class="media my-3">
<img class="mr-3" src="img1.webp" width=54px alt="Generic placeholder image">
<div class="media-body">
  <h5 class="mt-0"><a href="thread.php? cata='.$cata.' &thread_id='.$thr_id.'">'.$row['thread_title'].'</a></h5>
  '.substr($row['thread_desc'],0,25).'
</div>
</div>
<div style="text-align: right;"><b > posted by :- '.$row11['user_name'].'</b></div>
</div>
<hr>'; 
   }


   if($empty)
   {
    echo '<div class="jumbotron jumbotron-fluid my-4">
    <div class="container">
      <p class="display-5">No Questions Yet!!</p>
      <p class="lead">Be the first person to ask a question.</p>
    </div>
  </div>';
   }
   ?>
  
    

   
  
    <?php
    include 'partials/_footer.php';
    
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>