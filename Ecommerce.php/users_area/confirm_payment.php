<!--  Connect file -->
<?php
include('../includes/connect.php');
session_start();

// Initialize variables
$invoice_number = "";
$amount_due = "";
$order_id = ""; 

if(isset($_GET['order_id'])){
  // Sanitize the input to prevent SQL injection
  $order_id = mysqli_real_escape_string($con, $_GET['order_id']);
  
  // Fetch data from the database
  $select_data = "SELECT * FROM `user_orders` WHERE order_id=$order_id";
  $result = mysqli_query($con, $select_data);
  
  // Check if the query was successful
  if($result) {
    // Fetch the row
    $row_fetch = mysqli_fetch_assoc($result);
    
    // Check if invoice number exists in the row
    if(isset($row_fetch['invoice_number'])) {
      $invoice_number = $row_fetch['invoice_number'];
    }
    
    // Check if amount due exists in the row
    if(isset($row_fetch['amount_due'])) {
      $amount_due = $row_fetch['amount_due'];
    }
  } else {
    // Handle the case where the query was unsuccessful
    echo "Error: " . mysqli_error($con);
  }
}
if(isset($_POST['confirm_payment'])){
  // Sanitize form input
  $invoice_number = mysqli_real_escape_string($con, $_POST['invoice_number']);
  $amount = mysqli_real_escape_string($con, $_POST['amount']);
  $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);

  // Insert query
  $insert_query = "INSERT INTO `user_payments` (order_id, invoice_number, amount, payment_mode) VALUES ('$order_id', '$invoice_number', '$amount', '$payment_mode')";
  
  // Execute the query
  $result = mysqli_query($con, $insert_query);
  
  // Check if the query was successful
  if($result){
    echo "<h3 class='text-center text-light'>Successfully completed the payment</h3>";
    echo "<script>window.open('profile.php?my_orders','_self')</script>";
  } else {
    // If the query fails, output the error message
    echo "Error: " . mysqli_error($con);
  }
  $update_orders="UPDATE `user_orders` SET order_status='Complete' WHERE order_id=$order_id";
  $result_orders=mysqli_query($con,$update_orders);
}
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
<body class="bg-secondary">
  <div class="container my-5">
    <h1 class="text-center text-light">Confirm Payment</h1>
    <form action="" class="" method="post">
      <div class="form-outline my-4 text-center">
        <input type="text" value="<?php echo $invoice_number ?>" class="form-control w-50 m-auto" name="invoice_number">
      </div>
      <div class="form-outline my-4 text-center">
        <label for="" class="text-center text-light mb-2">Amount</label>
        <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>">
      </div>
      <div class="form-outline my-4 text-center">
        <select name="payment_mode" class="form-select text-center mt-5 w-50 m-auto">
          <option>Select Payment Mode</option>
          <option>UPI</option>
          <option>Netbanking</option>
          <option>Paypal</option>
          <option>Cash on Delivery</option>
          <option>Pay offline</option>
        </select>
      </div>
      <div class="form-outline my-4 text-center">
        <input type="submit" class="bg-info border-0 py-2 px-3" value="Confirm" name="confirm_payment">
      </div>
    </form>
  </div>
</body>
</html>
