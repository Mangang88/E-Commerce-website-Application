<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Orders</title>
  <!-- bootstrap css link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

<?php
// Check if the username is set in the session
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $get_user = "SELECT * FROM `user_table` WHERE username='$username'";
    $result = mysqli_query($con, $get_user);
    
    // Check if the query was successful and the user exists
    if($result && mysqli_num_rows($result) > 0){
        $row_fetch = mysqli_fetch_assoc($result);
        $user_id = $row_fetch['user_id'];
        
        ?>
        <h3 class="text-success">All my orders</h3>
        <table class="table table-bordered mt-5">
          <thead class="bg-info">
            <tr>
              <th class="bg-info">SL no.</th>
              <th class="bg-info">Order number</th>
              <th class="bg-info">Amount Due</th>
              <th class="bg-info">Total products</th>
              <th class="bg-info">Invoice number</th>
              <th class="bg-info">Date</th>
              <th class="bg-info">Complete/Incomplete</th>
              <th class="bg-info">Status</th>
            </tr>
          </thead> 
          <tbody class="bg-secondary text-light">
            <?php
            $get_order_details = "SELECT * FROM `user_orders` WHERE user_id=$user_id";
            $result_orders = mysqli_query($con, $get_order_details);
            $number = 1; // Initialize number outside the loop 
            while($row_orders = mysqli_fetch_assoc($result_orders)){
              $order_id = $row_orders['order_id'];
              $amount_due = $row_orders['amount_due'];
              $total_products = $row_orders['total_products'];
              $invoice_number = $row_orders['invoice_number'];
              $order_date = $row_orders['order_date'];
              $order_status = $row_orders['order_status'];
              if($order_status == 'pending'){
                $order_status = 'Incomplete';
              }else{
                $order_status = 'Complete';
              }
              echo "<tr>
              <td class='bg-secondary text-light'>$number</td>
              <td class='bg-secondary text-light'>$order_id</td>
              <td class='bg-secondary text-light'>$amount_due</td>
              <td class='bg-secondary text-light'>$total_products</td>
              <td class='bg-secondary text-light'>$invoice_number</td>
              <td class='bg-secondary text-light'>$order_date</td>
              <td class='bg-secondary text-light'>$order_status</td>";
              ?>
              <?php
              if($order_status=='complete'){
                echo "<td>Paid</td>";
              }else{
              echo "<td class='bg-secondary text-light'><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a></td>
              </tr>";
              }
              $number++; // Increment number inside the loop
            }
            ?>
          </tbody>
        </table>
<?php
    } else {
        // Handle the case where the user does not exist
        echo "<p>User not found</p>";
    }
} else {
    // Handle the case where the username is not set in the session
    echo "<p>Username not set</p>";
}
?>
</body>
</html>


