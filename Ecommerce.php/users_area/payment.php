<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Page</title>
  <!-- bootstrap css link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<style>
  img{
    width:90%;
    margin: auto;
    display:block;
  }
  footer{
    margin-bottom: 20px;
    padding: 20px;
    text-align: center;
    width: 100%;
    position: fixed;
    bottom: 0;
    left: 0;
  }
</style>
<body>
  <!-- php code to access user id  -->
  <?php
  $user_ip=getIPAddress();
  $get_user="SELECT * FROM `user_table` WHERE user_ip='$user_ip'";
  $result=mysqli_query($con,$get_user);
  $run_query=mysqli_fetch_array($result);
  $user_id=$run_query['user_id'];
  ?>
  <div class="container">
    <h2 class="text-center text-info mb-5">Payment Options</h2>
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-md-6">
      <a href="https://www.paypal.com" target="_blank">
        <img src="../images/upi.jpg" alt="" class="">
      </a>
      </div>
      <div class="col-md-6">
      <a href="order.php?user_id=<?php echo $user_id ?>"><h2 class="text-center">Pay Offline</h2></a>
      </div>
    </div>
  </div>
   <!-- includes footer -->
   <footer class="footer"> <?php include("../includes/footer.php") ?></footer>
 
</body>
</html>