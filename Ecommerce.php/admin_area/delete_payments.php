<?php
include('../includes/connect.php');
include('../functions/common_function.php');

if(isset($_GET['delete_payments'])){
  $delete_id = $_GET['delete_payments'];

  // Sanitize input to prevent SQL injection
  $delete_id = mysqli_real_escape_string($con, $delete_id);

  // Delete query
  $delete_payments = "DELETE FROM `user_payments` WHERE payment_id='$delete_id'";
  $result_payments = mysqli_query($con, $delete_payments);

  // Check if the deletion query executed successfully
  if($result_payments){
    echo "<script>alert('Payment deleted successfully!')</script>";
    echo "<script>window.open('./index.php?list_payments','_self')</script>"; // Redirect to the payments list page
  } else {
    echo "<script>alert('Failed to delete payment. Please try again.')</script>";
    echo "<script>window.open('./index.php?list_payments','_self')</script>"; // Redirect to the payments list page
  }
}
?>


