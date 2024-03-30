<?php
 include('../includes/connect.php');
 include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration</title>
   <!-- bootstrap css link -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  
</head>
<body>
  <div class="container-fluid my-3">
    <h2 class="text-center">New User Registration</h2>
      <form action="" method="post"  class="" enctype="multipart/form-data">
        <!-- user data -->
    <div class="form-outline mb-4 w-50 m-auto">
      <label for="user_username" class="form-label">Username</label>
      <input type="text" name="user_username" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required">
    </div>

    <!-- user email -->
    <div class="form-outline mb-4 w-50 m-auto">
      <label for="user_email" class="form-label">Email</label>
      <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Enter your Email" autocomplete="off" required="required">
    </div>

    <!-- user image -->
    <div class="form-outline mb-4 w-50 m-auto">
      <label for="user_image" class="form-label">User image</label>
      <input type="file" name="user_image" id="user_image" class="form-control" required="required">
    </div>

    <!-- user password -->
    <div class="form-outline mb-4 w-50 m-auto">
      <label for="user_password" class="form-label">Password</label>
      <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required">
    </div>

    <!-- Confirm Password -->
    <div class="form-outline mb-4 w-50 m-auto">
      <label for="confirm_password" class="form-label">Confirm Password</label>
      <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="confirm password" autocomplete="off" required="required">
    </div>

    <!-- Address -->
    <div class="form-outline mb-4 w-50 m-auto">
      <label for="user_address" class="form-label">Address</label>
      <input type="text" name="user_address" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required">
    </div>

    <!-- user mobile -->
    <div class="form-outline mb-4 w-50 m-auto">
      <label for="user_mobile" class="form-label">Mobile Number</label>
      <input type="text" name="user_mobile" id="user_mobile" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required="required">
    </div>
    <!-- Button --> 
    <div class="form-outline mb-4 w-50 m-auto">
    <input type="submit" name="user_register" class="btn btn-info mb-3 px-3" value="Register">
    <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="user_login.php" class="text-danger"> Login</a></p>
    </div>
    </form>
  </div>
</body>
</html>

 
<!-- php code -->
<?php
if(isset($_POST['user_register'])){
  $user_username=$_POST['user_username'];
  $user_email=$_POST['user_email'];
  $user_password=$_POST['user_password'];
  $hash_password=password_hash($user_password, PASSWORD_DEFAULT);
  $confirm_password=$_POST['confirm_password'];
  $user_address=$_POST['user_address'];
  $user_mobile=$_POST['user_mobile']; // Changed from 'user_contact'
  $user_image=$_FILES['user_image']['name'];
  $user_image_tmp=$_FILES['user_image']['tmp_name'];
  $user_ip=getIPAddress();

  // select query
  $select_query="SELECT * FROM `user_table` WHERE username='$user_username' or user_email='$user_email'";
  $result=mysqli_query($con,$select_query);
  $rows_count=mysqli_num_rows($result);
  if($rows_count>0){
    echo "<script>alert('Username and Email already exist!')</script>";
  }else if($user_password!=$confirm_password){
    echo "<script>alert('Passwords do not match!')</script>";
  }
  else{   
  // insert_query
    move_uploaded_file($user_image_tmp,"./user_images/$user_image");
    $insert_query="INSERT INTO `user_table` (username,user_email,user_password,user_image,user_ip,user_address,user_mobile) VALUES('$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_mobile')";
    $sql_execute=mysqli_query($con,$insert_query);
  }

  // Selecting cart items
  $select_cart_items="SELECT * FROM `cart_details` WHERE  ip_address='$user_ip'";
  $result_cart=mysqli_query($con,$select_cart_items);
  $rows_count=mysqli_num_rows($result_cart);
  if($rows_count>0){
    $_SESSION['username']=$user_username;
    echo "<script>alert('You have items in your cart!')</script>";
    echo "<script>window.open('checkout.php','_self')</script>";
  }else{
    echo "<script>window.open('../index.php','_self')</script>";
  }
}
?>


