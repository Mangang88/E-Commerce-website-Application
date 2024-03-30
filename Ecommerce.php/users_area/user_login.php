<!--  Connect file -->
<?php
include('../includes/connect.php');
$con = mysqli_connect('localhost', 'root', '', 'mystore');
include('../functions/common_function.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
   <!-- bootstrap css link -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
      body{overflow-x:hidden;
      }
      .footer{
        margin-top: 250px;
      }
    </style>
</head>
<body>
<div class="container-fluid my-3">
    <h2 class="text-center">User Login</h2>
    
      <form action="" method="post"  class="" enctype="multipart/form-data">
        <!-- title -->
    <div class="form-outline mb-4 w-50 m-auto">
      <label for="user_username" class="form-label">Username</label>
      <input type="text" name="user_username" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required">
    </div>

    

    <!-- user password -->
    <div class="form-outline mb-4 w-50 m-auto">
      <label for="user_password" class="form-label">Password</label>
      <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required">
    </div>

  
    <!-- Button --> 
    <div class="form-outline mb-4 w-50 m-auto">
      <a href="forgot_password.php" class="">Forgot password</a>
      <br>
    <input type="submit" name="user_login" class="btn btn-info mb-3 mt-5 px-3" value="Login">
    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="user_registration.php" class="text-danger"> Register</a></p>
    </div>
    </form>

     <!-- includes footer -->
     <div class="footer">
    <?php include("../includes/footer.php") ?>
    </div>
  </div>
</body>
</html>



<?php
global $con;
if(isset($_POST['user_login'])){
  $user_username=$_POST['user_username'];
  $user_password=$_POST['user_password'];
  $select_query="SELECT * FROM `user_table` WHERE username='$user_username'" ;
  $result=mysqli_query($con,$select_query);
  $rows_count=mysqli_num_rows($result);
  $row_data=mysqli_fetch_assoc($result);
  $user_ip=getIPAddress();

  // cart item
  $select_query_cart="SELECT * FROM `cart_details` WHERE ip_address='$user_ip'" ;
  $select_cart=mysqli_query($con,$select_query_cart);
  $rows_count_cart=mysqli_num_rows( $select_cart);
  if($rows_count>0){
    $_SESSION['username']=$user_username;
    if(password_verify($user_password,$row_data['user_password'])){
     // echo "<script>alert('Login successful!')</script>";
     if($row_count==1 and $rows_count_cart==0){
      $_SESSION['username']=$user_username;
      echo "<script>alert('Login successful!')</script>";
      echo "<script>window.open('profile.php','_self')</script>";
    }else{
      $_SESSION['username']=$user_username;
      echo "<script>alert('Login successful!')</script>";
      echo "<script>window.open('payment.php','_self')</script>";
    }
  }else{
      echo "<script>alert('Invalid credentials')</script>";
    }
}else{
    echo "<script>alert('Invalid credentials')</script>";
}
}
?>
