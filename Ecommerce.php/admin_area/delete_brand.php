<?php
if (isset($_GET['delete_brand'])) {
    $delete_id = $_GET['delete_brand'];
    // echo $delete_brand;

    // Delete query
    $delete_query = "DELETE FROM `brands` WHERE brand_id = $delete_id";
    $result = mysqli_query($con, $delete_query);

    if ($result) {
        echo "<script>alert('Brand is deleted successfully!')</script>";
        echo "<script>window.open('./index.php?view_brands','_self')</script>";
    }
}
?>