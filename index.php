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
  

    $notmatch=false;
    $login=false;
    $userexist=false;
    $cpassfail=false;
    include 'partials/_dbconnect.php';
    include 'partials/_header.php';
    
    
    // $notmatch=$_GET['notmatch'];
    
 if(isset($_GET['cpassfail']) && $_GET['cpassfail']==true){
  echo '
<div class="alert alert-danger" role="alert">
 Your password did not match, please match your password and try again.
</div>
';
}
if(isset($_GET['userexist']) && $_GET['userexist']==true){
  echo '<div class="alert alert-danger" role="alert">
 Username already exist, please choose another.
</div>';

}
if(isset($_GET['notmatch']) && $_GET['notmatch']==true){
  echo '<div class="alert alert-danger" role="alert">
 Invalid Cradencials!!<br>
 Please SignUp, if you do not have an account.
</div>';

}
if(isset($_GET['login']) && $_GET['login']==true){
  echo '<div class="alert alert-success" role="alert">
  Logged In Successfully!!
</div>';

}

if(isset($_GET['logout']) && $_GET['logout']==true){
  echo '<div class="alert alert-success" role="alert">
  Logged Out Successfully!!
</div>';

}

if(isset($_GET['signup']) && $_GET['signup']==true){
  echo '<div class="alert alert-success" role="alert">
  Signed Up Successfully!!
</div>';

}
?>


   <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://source.unsplash.com/4000x1000/?microsoft,code" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/4000x1000/?NASA,hacking", class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/4000x1000/?binary,web" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>




    <div class="container my-3">
        <h1 class="text-center m-4">Catagories</h1>
       
        <div class="row m-3">

        <?php
      $sql3="SELECT * FROM `catagories`;";
      $res=mysqli_query($con,$sql3);
      while($row=mysqli_fetch_assoc($res))
      {
        $cat=$row['catagory_name'];
        $cat_id=$row['sl_no'];
        $cat_dis=$row['catagory_discription'];
        echo '<div class="col-md-4">
      
        <div class="card my-3" style="width: 18rem;">
        <img src="https://source.unsplash.com/375x250/?'.$cat.',programming" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><a href="_threads_list.php? cata='.$cat_id.'">'.$cat.' </a></h5>
          <p class="card-text">'.substr($cat_dis,0,80).'...</p>
          <a href="_threads_list.php? cata='.$cat_id.'"  class="btn btn-success">View Treads</a>
        </div>
      </div>
      </div>';
      }

      ?>



          
         
         

     
      </div>
</div> 


  
    <?php
    include 'partials/_footer.php';
    
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>