<!--  Connect file -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecommerce Website using PHP and MySQL.</title>
  <!-- bootstrap css link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Link css file -->
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- Navbar -->
  <div class="container-fluid p-0">
    <!-- First child -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
      <div class="container-fluid">
        <img src="./images/logo.jpg" alt="" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="display_all.php">Products</a>
            </li>
            <?php
            if(isset($_SESSION['username'])){
              echo "<li class='nav-item'>
              <a class='nav-link' href='./users_area/profile.php'>My Account</a>
            </li>";
            }else{
              echo"<li class='nav-item'>
              <a class='nav-link' href='./users_area/user_registration.php'>Register</a>
            </li>";
            } 
            ?>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cart.php"><i class="fa-solid fa-shopping-cart"></i><sup><?php 
              cart_item();
              ?>
              </sup>Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"> Total Price: <?php
              total_cart_price();?> /-
              </a>
            </li>
          </ul>
          <form class="d-flex" action="search_product.php" method="get">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
          <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
          </form>
        </div>
      </div>  
    </nav>

    <!-- Calling  Cart function  -->
    <?php
     cart();
    ?>

    <!-- Second Child -->
    <div class="row">
      <div class="col-md-2">
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
          <ul class="navbar-nav me-auto"> 
            <?php
            if(!isset($_SESSION['username'])){
              echo " <li class='nav-item'>
              <a href='' class='nav-link'>Welcome Guest</a>
            </li>";
            }else{
              echo "<li class='nav-item'>
              <a href='#' class='nav-link'>Welcome ".$_SESSION['username']."</a>
            </li>";
            }
            if(!isset($_SESSION['username'])){
              echo "<li class='nav-item'>
              <a href='./users_area/user_login.php' class='nav-link'>Login</a>
            </li>";
            }else{
              echo "<li class='nav-item'>
              <a href='./users_area/logout.php' class='nav-link'>Logout</a>
            </li>";
            }
            ?>
            
          </ul>
        </nav>
      </div>
      <div class="col-md-10">
        <!-- Third Child -->
        <div class="bg-light">
          <h3 class="text-center">Hidden Store</h3>
          <p class="text-center">Communications is at the heart of e-commerce and community</p>
        </div>

        <!-- Fourth Child -->
        <div class="row px-1">
          <div class="col-md-10">
          <!-- Products -->
          <div class="row">

        <!-- fetching products -->

          <?php
          // Calling Function
          getproducts();
          get_unique_categories();
          get_unique_brands();
        //  $ip = getIPAddress();  
       //   echo 'User Real IP Address - '.$ip;
          ?>

          <!-- row end -->
        </div>

        <!-- column end -->
      </div>
      <div class="col-md-2 bg-secondary p-0">
        <!-- Brands to be displayed -->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="" class="nav-link text-light"><h4>Brands</h4></a>
          </li>
          <?php
          getbrands();
          ?>         
        </ul>

        <!-- Categories to be displayed -->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light"><h4>Categories</h4>
          </a>
         <?php
           getcategories();
          ?>  
        </ul>
      </div>
    </div>
 
    <!-- Last Child -->
    <!-- includes footer -->
    <?php include("./includes/footer.php") ?>
  </div>

  <!-- bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


