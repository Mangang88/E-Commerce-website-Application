<?php
 include('../includes/connect.php');
 include('../functions/common_function.php');
 @session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Registration</title>
<!-- Bootstrap CSS link -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
  <div class="container-fluid m-3">
    <h2 class="text-center mb-5">Admin Registration</h2>
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
            <label for="email" class="form-label">Email</label>
            <input type="text" id="email" name="email" placeholder="enter your email" required="required" class="form-control">
          </div>
          <div class="form-outline mb-4">
            <label for="password" class="form-label">password</label>
            <input type="password" id="password" name="password" placeholder="enter your password" required="required" class="form-control">
          </div>
          <div class="form-outline mb-4">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="confirm password" required="required" class="form-control">
          </div>
          <!-- Button -->
          <div class="form-outline mb-4 w-50">
            <input type="submit" name="admin_registration" class="btn btn-info mb-3 px-3" value="Register">
            <p class="small fw-bold mt-2 pt-1 mb-0">Do you already have  an account? <a href="admin_login.php" class="text-danger"> Login</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>


<?php
if(isset($_POST['admin_registration'])){ // Check if the admin registration form is submitted
  $admin_name=$_POST['username']; // Retrieve username from the form
  $admin_email=$_POST['email']; // Retrieve email from the form
  $admin_password=$_POST['password']; // Retrieve password from the form
  $hash_password=password_hash($admin_password, PASSWORD_DEFAULT); // Hash the password
  $confirm_password=$_POST['confirm_password']; // Retrieve confirmed password from the form

  // select query to check if the username or email already exists
  $select_query="SELECT * FROM `admin_table` WHERE admin_name='$admin_name' OR admin_email='$admin_email'";
  $result=mysqli_query($con,$select_query);
  $rows_count=mysqli_num_rows($result);

  if($rows_count>0){ // If username or email already exists
    echo "<script>alert('Username or Email already exists!')</script>";
  } else if($admin_password != $confirm_password){ // If passwords do not match
    echo "<script>alert('Passwords do not match!')</script>";
  } else {   
    // insert_query to add admin data into the database
    $insert_query="INSERT INTO `admin_table` (admin_name,admin_email,admin_password)  VALUES ('$admin_name','$admin_email','$hash_password')";
    $sql_execute=mysqli_query($con,$insert_query);
    
    if($sql_execute) { // If the registration was successful
      $_SESSION['admin_name']=$admin_name; // Store admin name in session
      echo "<script>alert('Successfully registered!')</script>";
      echo "<script>window.open('../index.php','_self')</script>";
    } else {
      echo "<script>alert('Registration failed!')</script>"; // If registration failed
    }
  }
}
?>
