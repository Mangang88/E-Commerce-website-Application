<?php
include('../includes/connect.php');
include('../functions/common_function.php');

if (isset($_GET['delete_user'])) {
    $delete_id = $_GET['delete_user'];

    // Delete query
    $delete_query = "DELETE FROM `user_table` WHERE user_id = '$delete_id'";
    $result = mysqli_query($con, $delete_query);

    if ($result) {
        echo "<script>alert('User is deleted successfully!')</script>";
        echo "<script>window.open('./index.php','_self')</script>"; // Redirect to the users list page
    } else {
        echo "<script>alert('Failed to delete user. Please try again.')</script>";
        echo "<script>window.open('./index.php','_self')</script>"; // Redirect to the users list page
    }
}
