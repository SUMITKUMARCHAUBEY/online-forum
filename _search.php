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
  include 'partials/_dbconnect.php';
  include 'partials/_header.php';
  $vari=$_GET['search'];
echo '<h1 class="container m-5 "><b>Search result for "'.$vari.'"</b></h1>';  


$empty=true;
$sql3="SELECT * FROM `catagories` WHERE catagory_name='$vari';";
      $res=mysqli_query($con,$sql3);
      while($row=mysqli_fetch_assoc($res))
      {
        $empty=false;
        $cat=$row['catagory_name'];
        $cat_id=$row['sl_no'];
        $cat_dis=$row['catagory_discription'];
        echo '<div class="container">
        <div class="col-md-4">
      
        <div class="card my-3" style="width: 18rem;">
        <img src="https://source.unsplash.com/375x250/?'.$cat.',programming" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><a href="_threads_list.php? cata='.$cat_id.'">'.$cat.' </a></h5>
          <p class="card-text">'.substr($cat_dis,0,80).'...</p>
          <a href="_threads_list.php? cata='.$cat_id.'"  class="btn btn-success">View Treads</a>
        </div>
      </div>
      </div>
      </div>';
      }

      if($empty)
   {
    echo '<div class="jumbotron jumbotron-fluid my-4">
    <div class="container">
      <p class="display-5">Catagory does not exist !!</p>
      <p class="lead">You can add this catagory on this website if you like.</p>
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