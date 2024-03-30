<?php 
// Check if the function exists before declaring it
if (!function_exists('getproducts')) {
    // Define the function only if it doesn't exist
    function getproducts() {
        global $con;
        
        // Condition to check isset or not
        if (!isset($_GET['category'])) {
            if (!isset($_GET['brand'])) {
                $select_query = "SELECT * FROM `products` ORDER BY RAND() LIMIT 0,4";
                $result_query = mysqli_query($con, $select_query);
                
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $product_image1 = $row['product_image1'];
                    $product_price = $row['product_price'];
                    $category_id = $row['category_id'];
                    $brand_id = $row['brand_id'];
                    
                    echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>Price: $product_price/-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
                }
}
}
  }
}

// getting all products
// Check if the function exists before declaring it
if (!function_exists('get_all_products')) {
    // Define the function only if it doesn't exist
    function get_all_products() {
        global $con;
        
        // Condition to check isset or not
        if (!isset($_GET['category']) && !isset($_GET['brand'])) {
            $select_query = "SELECT * FROM `products` ORDER BY RAND()";
            $result_query = mysqli_query($con, $select_query);
            
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                
                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>";
            }
        }
    }
}



// getting unique categories
// Check if the function exists before declaring it
if (!function_exists('get_unique_categories')) {
  // Define the function only if it doesn't exist
  function get_unique_categories() {
      global $con;
      
      // Condition to check isset or not
      if (isset($_GET['category'])) {
          $category_id = $_GET['category'];
          $select_query = "SELECT * FROM `products` WHERE category_id=$category_id";
          $result_query = mysqli_query($con, $select_query);
          $num_of_rows = mysqli_num_rows($result_query);
          
          if ($num_of_rows == 0) {
              echo "<h2 class='text-center text-danger'>No Stock For this Category!</h2>";
          }
          
          while ($row = mysqli_fetch_assoc($result_query)) {
              $product_id = $row['product_id'];
              $product_title = $row['product_title'];
              $product_description = $row['product_description'];
              $product_image1 = $row['product_image1'];
              $product_price = $row['product_price'];
              $category_id = $row['category_id'];
              $brand_id = $row['brand_id'];
              
              echo "<div class='col-md-4 mb-2'>
                      <div class='card'>
                          <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                          <div class='card-body'>
                              <h5 class='card-title'>$product_title</h5>
                              <p class='card-text'>$product_description</p>
                              <p class='card-text'>Price: $product_price/-</p>
                              <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                              <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                          </div>
                      </div>
                  </div>";
          }
      }
  }
}

// getting unique brands
// Check if the function exists before declaring it
if (!function_exists('get_unique_brands')) {
  // Define the function only if it doesn't exist
  function get_unique_brands() {
      global $con;
      
      // Condition to check isset or not
      if (isset($_GET['brand'])) {
          $brand_id = $_GET['brand'];
          $select_query = "SELECT * FROM `products` WHERE brand_id=$brand_id";
          $result_query = mysqli_query($con, $select_query);
          $num_of_rows = mysqli_num_rows($result_query);
          
          if ($num_of_rows == 0) {
              echo "<h2 class='text-center text-danger'>This brand is not available for service!</h2>";
          }
          
          while ($row = mysqli_fetch_assoc($result_query)) {
              $product_id = $row['product_id'];
              $product_title = $row['product_title'];
              $product_description = $row['product_description'];
              $product_image1 = $row['product_image1'];
              $product_price = $row['product_price'];
              $category_id = $row['category_id'];
              $brand_id = $row['brand_id'];
              
              echo "<div class='col-md-4 mb-2'>
                      <div class='card'>
                          <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                          <div class='card-body'>
                              <h5 class='card-title'>$product_title</h5>
                              <p class='card-text'>$product_description</p>
                              <p class='card-text'>Price: $product_price/-</p>
                              <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                              <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                          </div>
                      </div>
                  </div>";
          }
      }
  }
}


// Displaying brands in sidenav
// Check if the function exists before declaring it
if (!function_exists('getbrands')) {
    // Define the function only if it doesn't exist
    function getbrands() {
        global $con;
        $select_brands = "SELECT * FROM `brands`";
        $result_brands = mysqli_query($con, $select_brands);
        while ($row_data = mysqli_fetch_assoc($result_brands)) {
            $brand_title = $row_data['brand_title'];
            $brand_id = $row_data['brand_id'];
            echo "<li class='nav-item'>
                    <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
                </li>";
        }
    }
}

// Check if the function exists before declaring it
if (!function_exists('getcategories')) {
    // Define the function only if it doesn't exist
    function getcategories() {
        global $con;
        $select_categories = "SELECT * FROM `categories`";
        $result_categories = mysqli_query($con, $select_categories);
        while ($row_data = mysqli_fetch_assoc($result_categories)) {
            $category_title = $row_data['category_title'];
            $category_id = $row_data['category_id'];
            echo "<li class='nav-item'>
                    <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
                </li>";
        }
    }
}


// Searching Products function
// Check if the function exists before declaring it
if (!function_exists('search_product')) {
  // Define the function only if it doesn't exist
  function search_product() {
      global $con;
      if (isset($_GET['search_data_product'])) {
          $search_data_value = $_GET['search_data'];
          $search_query = "SELECT * FROM `products` WHERE product_keywords LIKE '%$search_data_value%'";
          $result_query = mysqli_query($con, $search_query);
          $num_of_rows = mysqli_num_rows($result_query);
          if ($num_of_rows == 0) {
              echo "<h2 class='text-center text-danger'>No results match. No products found on this category!</h2>";
          }
          while ($row = mysqli_fetch_assoc($result_query)) {
              $product_id = $row['product_id'];
              $product_title = $row['product_title'];
              $product_description = $row['product_description'];
              $product_image1 = $row['product_image1'];
              $product_price = $row['product_price'];
              $category_id = $row['category_id'];
              $brand_id = $row['brand_id'];
              
              echo "<div class='col-md-4 mb-2'>
                      <div class='card'>
                          <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                          <div class='card-body'>
                              <h5 class='card-title'>$product_title</h5>
                              <p class='card-text'>$product_description</p>
                              <p class='card-text'>Price: $product_price/-</p>
                              <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                              <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                          </div>
                      </div>
                  </div>";
          }
      }
  }
}

// view details function
// Check if the function exists before declaring it
if (!function_exists('view_details')) {
  // Define the function only if it doesn't exist
  function view_details() {
      global $con;
      if (isset($_GET['product_id'])) {
          if (!isset($_GET['category'])) {
              if (!isset($_GET['brand'])) {
                  $product_id = $_GET['product_id'];
                  $select_query = "SELECT * FROM `products` WHERE product_id = '$product_id'";
                  $result_query = mysqli_query($con, $select_query);
                  if ($result_query) {
                      while ($row = mysqli_fetch_assoc($result_query)) {
                          $product_id = $row['product_id'];
                          $product_title = $row['product_title'];
                          $product_description = $row['product_description'];
                          $product_image1 = $row['product_image1'];
                          $product_image2 = $row['product_image2'];
                          $product_image3 = $row['product_image3'];
                          $product_price = $row['product_price'];
                          $category_id = $row['category_id'];
                          $brand_id = $row['brand_id'];
                          
                          echo "<div class='col-md-4 mb-2'>
                                  <div class='card'>
                                      <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                      <div class='card-body'>
                                          <h5 class='card-title'>$product_title</h5>
                                          <p class='card-text'>$product_description</p>
                                          <p class='card-text'>Price: $product_price/-</p>
                                          <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                                          <a href='index.php' class='btn btn-secondary'>Go Home</a>
                                      </div>
                                  </div>
                              </div>

                              <div class='col-md-8'>
                                  <!-- related images -->
                                  <div class='row'>
                                      <div class='col-md-12'>
                                          <h4 class='text-center text-info mb-5'>Related products</h4>
                                      </div>
                                      <div class='col-md-6'>
                                          <img src='./admin_area/product_images/$product_image2' alt='$product_title' style='max-width: 100%; height: auto;'>
                                      </div>
                                      <div class='col-md-6'>
                                          <img src='./admin_area/product_images/$product_image3' alt='$product_title' style='max-width: 100%; height: auto;'>
                                      </div>
                                  </div>
                              </div>";
                      }
                  }
              }
          }
      }
  }
}

// get ip address function 
// Check if the function exists before declaring it
if (!function_exists('getIPAddress')) {
  // Define the function only if it doesn't exist
  function getIPAddress() {
      // Whether IP is from the shared internet
      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
      }
      // Whether IP is from the proxy
      elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }
      // Whether IP is from the remote address
      else {
          $ip = $_SERVER['REMOTE_ADDR'];
      }
      return $ip;
  }
}
// $ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip;



// cart function
// Check if the function exists before declaring it
if (!function_exists('cart')) {
  // Define the function only if it doesn't exist
  function cart() {
      if(isset($_GET['add_to_cart'])) {
          global $con;
          $get_ip_add = getIPAddress();
          $get_product_id=$_GET['add_to_cart'];
      
          $select_query="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add' and product_id=$get_product_id";
          $result_query=mysqli_query($con,$select_query);
          $num_of_rows=mysqli_num_rows($result_query);
          if($num_of_rows>0){
              echo "<script>alert('This item is already present inside the cart')</script>";
              echo "<script>window.open('index.php','_self')</script>";
          }else{
              $insert_query="INSERT INTO `cart_details` (product_id,ip_address,quantity) VALUES ('$get_product_id','$get_ip_add',0)";
              $result_query=mysqli_query($con,$insert_query);
              echo "<script>alert('Item is added to the cart')</script>";
              echo "<script>window.open('index.php','_self')</script>";
          }
      }
  }
}

//  Function to get cart item n umbers
// Check if the function exists before declaring it
if (!function_exists('cart_item')) {
  // Define the function only if it doesn't exist
  function cart_item() {
      if(isset($_GET['add_to_cart'])) {
          global $con;
          $get_ip_add = getIPAddress();
          $select_query="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
          $result_query=mysqli_query($con,$select_query);
          $count_cart_items=mysqli_num_rows($result_query);
      } else {
          global $con;
          $get_ip_add = getIPAddress();
          $select_query="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
          $result_query=mysqli_query($con,$select_query);
          $count_cart_items=mysqli_num_rows($result_query);
      }
      echo $count_cart_items;
  }
}

  //  total price function 
  // Check if the function exists before declaring it
if (!function_exists('total_cart_price')) {
  // Define the function only if it doesn't exist
  function total_cart_price() {
      global $con;
      $get_ip_add = getIPAddress();
      $total_price=0;
      $cart_query="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
      $result=mysqli_query($con,$cart_query);
      while($row=mysqli_fetch_array($result)) {
          $product_id=$row['product_id'];
          $select_products="SELECT * FROM `products` WHERE product_id='$product_id'";
          $result_products=mysqli_query($con,$select_products);
          while($row_product_price=mysqli_fetch_array($result_products)) {
              $product_price=array($row_product_price['product_price']);
              $product_values=array_sum($product_price);
              $total_price += $product_values;
          }
      }
      echo $total_price;
  }
}


// get user order details
// Check if the function exists before declaring it
if (!function_exists('get_user_order_details')) {
  // Define the function only if it doesn't exist
  function get_user_order_details() {
      global $con;
      if(isset($_SESSION['username'])) {
          $username=$_SESSION['username'];
          $get_dertails="SELECT * FROM `user_table` WHERE username='$username'";
          $result_query=mysqli_query($con,$get_dertails);
          if($result_query) {
              while($row_query=mysqli_fetch_array($result_query)){
                  $user_id=$row_query['user_id'];
                  if(!isset($_GET['edit_account'])) {
                      if(!isset($_GET['my_orders'])){
                          if(!isset($_GET['delete_account'])){
                              $get_orders="SELECT * FROM `user_orders` WHERE user_id='$user_id' and order_status='pending'";
                              $result_orders_query=mysqli_query($con,$get_orders);
                              if($result_orders_query) {
                                  $row_count=mysqli_num_rows($result_orders_query);
                                  if($row_count > 0){
                                      echo "<h3 class='text-center text-success mt-5 mb-2'> You have <span class='text-danger'>$row_count</span> pending orders</h3>
                                      <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
                                  }else{
                                      echo "<h3 class='text-center text-success mt-5 mb-2'> You have zero pending orders</h3>
                                      <p class='text-center'><a href='../index.php?my_orders' class='text-dark'>Explore Products</a></p>";
                                  }
                              } else {
                                  echo "Error retrieving user orders.";
                              }
                          }
                      }
                  }
              }
          } else {
              echo "Error retrieving user details.";
          }
      } else {
          echo "Username not found in session.";
      }
  }
}
?>
