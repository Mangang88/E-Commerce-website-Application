<!--  Connect file -->
<?php
include('../includes/connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecommerce Website-Checkout page</title>
  <!-- bootstrap css link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Link css file -->
  <link rel="stylesheet" href="style.css">
</head>
<style>
  .logo{
  width:5%;
  height:5%;
}
</style>
<body>
  <!-- Navbar -->
  <div class="container-fluid p-0">
    <!-- First child -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
      <div class="container-fluid">
        <img src="../images/logo.jpg" alt="" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../display_all.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../users_area/user_registration.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
          <form class="d-flex" action="search_product.php" method="get">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
          <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
          </form>
        </div>
      </div>  
    </nav>

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
              <a href='./user_login.php' class='nav-link'>Login</a>
            </li>";
            }else{
              echo "<li class='nav-item'>
              <a href='logout.php' class='nav-link'>Logout</a>
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
          <div class="col-md-12">
          <!-- Products -->
          <div class="row">
            <?php
            if(!isset($_SESSION['username'])){
              include('user_login.php');
            }else{
              include('payment.php');
            }
            ?>
          <!-- row end -->
        </div>

        <!-- column end -->
      </div>
      <div class="col-md-2 bg-secondary p-0">
       
      </div>
    </div>
 
    <!-- Last Child -->
  </div>

  <!-- bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
