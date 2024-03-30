<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>


<?php
if (isset($_GET['delete_orders'])) {
    $delete_id = $_GET['delete_orders'];

    // Delete query
    $delete_query = "DELETE FROM `user_orders` WHERE order_id = '$delete_id'";
    $result = mysqli_query($con, $delete_query);

    if ($result) {
        echo "<script>alert('Order is deleted successfully!')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    } 
}
?>




