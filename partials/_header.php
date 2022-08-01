<?php
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Online Forum</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Catagories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        $sql3="SELECT * FROM `catagories`;";
        $res=mysqli_query($con,$sql3);
        while($row=mysqli_fetch_assoc($res))
        {
          $cat=$row['catagory_name'];
          $cat_id=$row['sl_no'];

          echo '<li><a class="dropdown-item" href="/forum/_threads_list.php?cata='.$cat_id.'">'.$cat.'</a></li>';
        }
        echo '</ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contect</a>
      </li>
    </ul>
    <div class="row mx-2 ">';
          
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
    {  
      echo'<form class="d-flex" action="_search.php" method="get" role="search" style="height:50px; ">
      <input class="form-control me-2"  name="search" id="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success mx-2" type="submit">Search</button>
      <p class="text-light mx-2 my-3" style="width:600px;
      text-align:right;">Wellcome '.$_SESSION['username'].'</p>
      <a class="btn btn-success mx-0" href="partials/_logout.php"><p class="text-light mx-2 my-1" style="width:80px;
      ">Log Out</p></a>
      </form>
      </div>
     </div>
     </nav>';
    } 
    else{
      echo'<form class="d-flex" role="search" name="search" method="get" action="_search.php">
      <input class="form-control me-2" type="search" id=" search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
      <button type="button" class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginmodal">LogIn</button>
      <button type="button" class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupmodal">SignUp</button>
      </form>
      </div>
      </div>
      </nav>';
    }
include 'partials/_signup.php';
include 'partials/_login.php';
?>
