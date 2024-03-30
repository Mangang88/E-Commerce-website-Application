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
  <title>Ecommerce Website-cart details.</title>
  <!-- bootstrap css link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Link css file -->
  <link rel="stylesheet" href="style.css">

  <style>
    .footer{
        margin-top: 330px;
      }
  </style>
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
            <li class="nav-item">
              <a class="nav-link" href="./users_area/user_registration.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cart.php"><i class="fa-solid fa-shopping-cart"></i><sup><?php 
              cart_item();
              ?>
              </sup>Cart</a>
            </li>
          </ul>
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

        <!-- fourth child -->
        <div class="container">
          <div class="row">
            <form action="" method="post" class="">
            <table class="table table-border text-center">
              
              <tbody class="">

              <!-- php code to display dynamic data -->
              <?php
              global $con;
              $get_ip_add = getIPAddress();
              $total_price = 0;
              $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
              $result = mysqli_query($con, $cart_query);
              $result_count=mysqli_num_rows($result);
              if($result_count>0){
                echo "<thead class=''>
                <tr class=''>
                  <th>Product Title</th>
                  <th>Product Image</th>
                  <th>Quantity</th>
                  <th>Total Price</th>
                  <th>Remove</th>
                  <th colspan='2'>Operations</th>
                </tr>
              </thead>";

              while ($row = mysqli_fetch_array($result)) {
             $product_id = $row['product_id'];
             $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
             $result_products = mysqli_query($con, $select_products);
             while ($row_product_price = mysqli_fetch_array($result_products)) {
             $product_price = $row_product_price['product_price'];
             $price_table = $product_price;
             $product_title = $row_product_price['product_title']; 
             $product_image1 = $row_product_price['product_image1'];
             $product_values = $product_price;
             $total_price += $product_values;
             ?>
                <tr class="">
                  <td class=""><?php echo $product_title ?></td>
                  <td>
                    <img src="./admin_area/product_images/<?php echo $product_image1?>" alt="" class="" style='max-width: 40px; height: auto;'>
                  </td>
                  <td>
                    <input type="quantity" name="quantity" value="<?php echo $row['quantity'] ?>" id="" class="form-input w-50">
                  </td>

                  <?php
                  $get_ip_address = getIPAddress();
                  if(isset($_POST['update_cart'])) {
             // Check if the 'quantity' field is set in the form submission
                if(isset($_POST['quantity'])) {
                $quantities = $_POST['quantity'];
        
             // Prepare and execute the SQL query to update quantity
               $update_cart = "UPDATE `cart_details` SET quantity='$quantities' WHERE ip_address='$get_ip_address'";
               $result_products_quantity = mysqli_query($con,  $update_cart);
        
            // Check if the query was successful
              if($result_products_quantity) {
              echo "Cart updated successfully!";
            
            // Recalculate the total price based on the updated quantities
              $total_price = 0; // Reset total price
              $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
              $result = mysqli_query($con, $cart_query);
              while($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $quantity = $row['quantity'];
                
                // Query to fetch product price
                $select_product_query = "SELECT product_price FROM `products` WHERE product_id='$product_id'";
                $result_product = mysqli_query($con, $select_product_query);
                if($row_product = mysqli_fetch_assoc($result_product)) {
                    $product_price = $row_product['product_price'];
                    // Calculate subtotal for each product and add to total price
                    $total_price += $product_price * $quantity;
                }
            }
            echo "Total price: $total_price"; // Output total price
        } else {
            echo "Error updating cart: " . mysqli_error($con);
        }
    } else {
        // Handle the case where 'quantity' is not set in the form submission
        echo "Quantity not provided!";
    }
}
?>
<td><?php echo $price_table ?>/-</td>
<td>
  <input type="checkbox" name="remove_item[]" value="<?php echo $product_id ?>">
</td>
<td class="d-flex">
  <!--  <button class="bg-info p-3 py-2 border-0 mx-3">Update</button>  -->
  <input type="submit" value="Update Cart" class="bg-info text-center p-3 py-2 border-0 mx-3" name="update_cart">
  <!-- <button  class="bg-info p-3 py-2 border-0 mx-3">Remove</button>  -->
  <input type="submit" value="Remove Cart" class="bg-info text-center p-3 py-2 border-0 mx-3" name="remove_cart">  
</td>
</tr>
<?php
}}}
else{
  echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
}
?>
</tbody>
</table>
<!-- subtotal -->
<div class="d-flex mb-5">
  <?php
  $get_ip_add = getIPAddress();
  $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
  $result = mysqli_query($con, $cart_query);
  $result_count=mysqli_num_rows($result);
  if($result_count>0){
    echo "<h4 class='px-3'>Subtotal:<strong class='text-info'>$total_price/-</strong></h4>
    <input type='submit' value='Continue Shopping' class='bg-info text-center p-3 py-2 border-0 mx-3' name='continue_shopping'>
    <button class='bg-secondary p-3 py-2 border-0'><a href='./users_area/checkout.php' class='text-light text-decoration-none'>Checkout</a></button>";
  }else {
    echo "<input type='submit' value='Continue Shopping' class='bg-info text-center p-3 py-2 border-0 mx-3' name='continue_shopping'>";
  }
  if(isset($_POST['continue_shopping'])){
    echo "<script>window.open('index.php','_self')</script>";
  }
?>
  
</div>
</div>
</div>
</form>
 
        <!-- function to remove item -->
        <?php
function remove_cart_item(){
    global $con;
    if(isset($_POST['remove_cart']) && isset($_POST['remove_item'])) { // Check if $_POST['remove_item'] is set
        foreach($_POST['remove_item'] as $remove_id){
            // Use prepared statements to prevent SQL injection
            $delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id";
            $run_delete=mysqli_query($con,$delete_query);
            if($run_delete){
                echo "<script>window.open('cart.php','_self')</script>";
            }
        }
    }
}
// Call the function to execute the removal process
remove_cart_item(); // Don't echo the result of the function call
?>



    <!-- Last Child -->
    <!-- includes footer -->
    <div class="footer">
    <?php include("./includes/footer.php") ?>
  </div>

  <!-- bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>