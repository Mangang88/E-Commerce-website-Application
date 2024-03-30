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
<title>Admin Login</title>
<!-- Bootstrap CSS link -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
  <div class="container-fluid m-3">
    <h2 class="text-center mb-5">Admin Login</h2>
    <div class="row d-flex justify-content-center">
      <div class="col-lg-6 col-xl-5">
        <img src="../images/adminreg.jpg" alt="Admin Registration" class="img-fluid">
      </div>
      <div class="col-lg-6 col-xl-4">
        <form action="" class="" method="post">
          <div class="form-outline mb-4">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" placeholder="enter your username" required="required" class="form-control">
          </div>
          
          <div class="form-outline mb-4">
            <label for="password" class="form-label">password</label>
            <input type="password" id="password" name="password" placeholder="enter your password" required="required" class="form-control">
          </div>
          
          <!-- Button -->
          <div class="form-outline mb-4 w-50">
          <a href="forgot_password.php" class="">Forgot password</a>
          <br>
            <input type="submit" name="admin_login" class="btn btn-info mb-3 px-3" value="Login">
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't you have an account? <a href="admin_registration.php" class="text-danger"> Login</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>


<?php
global $con;
if(isset($_POST['admin_login'])){
  $admin_name=$_POST['username'];
  $admin_password=$_POST['password'];
  $select_query="SELECT * FROM `admin_table` WHERE admin_name='$admin_name'" ;
  $result=mysqli_query($con,$select_query);
  $rows_count=mysqli_num_rows($result);
  $row_data=mysqli_fetch_assoc($result);
  $user_ip=getIPAddress();


  if($rows_count>0){
    $_SESSION['admin_name']=$admin_name;
    if(password_verify($admin_password,$row_data['admin_password'])){
     // echo "<script>alert('Login successful!')</script>";
     if($rows_count==1 and $rows_count_cart==0){
      $_SESSION['admin_name']=$admin_name;
      echo "<script>alert('Login successful!')</script>";
      echo "<script>window.open('index.php','_self')</script>";
    }
  }else{
      echo "<script>alert('Invalid credentials')</script>";
    }
}else{
    echo "<script>alert('Invalid credentials')</script>";
}
}
?>