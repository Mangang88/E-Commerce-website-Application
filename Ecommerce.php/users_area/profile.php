<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();

// Check if the username is set in the session
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Redirect the user to the login page or display an error message
    // Example: header("Location: user_login.php");
    echo "User is not logged in.";
    exit; // Stop further execution of the script
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome <?php echo $username ?></title>
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Link css file -->
  <link rel="stylesheet" href="../style.css">
  <style>
    .profile_image{
      width: 50%;
      height: 50%;
      margin: auto;
      display:block;
      object-fit:contain;
}
  </style>
</head>
<body>
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
              <a class="nav-link" href="profile.php">My Account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../cart.php"><i class="fa-solid fa-shopping-cart"></i><sup><?php 
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
          <form class="d-flex" action="../search_product.php" method="get">
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
              <a href='#' class='nav-link'>Welcome ".$username."</a>
            </li>";
            }
            if(!isset($_SESSION['username'])){
              echo "<li class='nav-item'>
              <a href='../users_area/user_login.php' class='nav-link'>Login</a>
            </li>";
            }else{
              echo "<li class='nav-item'>
              <a href='../users_area/logout.php' class='nav-link'>Logout</a>
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

        <!-- Fourth child -->
        <div class="row">
          <div class="col-md-2">
            <ul class="navbar-nav bg-secondary navbar-dark text-center" style="height:100vh">
              <li class="nav-item">
                <a href="" class="nav-link text-light"><h4>Your Profile</h4></a>
              </li>

              <?php
              $username = $_SESSION['username']; // Make sure to set $username
              $user_image="SELECT * FROM `user_table` WHERE username='$username'";
              $result_image=mysqli_query($con,$user_image);
              $row_image=mysqli_fetch_array($result_image);
              $user_image=$row_image['user_image'];
              echo "<li class='nav-item'>
              <img src='./user_images/$user_image' alt='' class='profile_image my-4'>
              </li> ";
              ?>
                          
              <li class="nav-item">
                <a href="profile.php" class="nav-link text-light">Pending Orders</a>
              </li>
              <li class="nav-item">
                <a href="profile.php?edit_account" class="nav-link text-light">Edit Account</a>
              </li>
              <li class="nav-item">
                <a href="profile.php?my_orders" class="nav-link text-light">My Orders</a>
              </li>
              <li class="nav-item">
                <a href="profile.php?delete_account" class="nav-link text-light">Delete Account</a>
              </li>
              <li class="nav-item">
                <a href="./logout.php" class="nav-link text-light">Logout</a>
              </li>
            </ul>
          </div>
          <div class="col-md-10 text-center">
            <?php
            get_user_order_details();
            if(isset($_GET['edit_account'])){
              include('edit_account.php');
            }
            if(isset($_GET['my_orders'])){
              include('user_orders.php');
            }
            if(isset($_GET['delete_account'])){
              include('delete_account.php');
            }
            ?>
          </div>
        </div>

        <!-- Last Child -->
    <!-- includes footer -->
    <?php include("../includes/footer.php") ?>
  </div>

  <!-- bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>
</html>


