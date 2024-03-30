<?php
if(isset($_GET['delete_category'])){
  $delete_id=$_GET['delete_category'];
  // echo $delete_category;

  //Delete query
  $delete_query="DELETE FROM `categories` WHERE category_id=$delete_id";
  $result=mysqli_query($con,$delete_query);
  if($result){
    echo "<script>alert('Category is deleted successfully!')</script>";
    echo "<script>window.open('./index.php?view_category','_self')</script>";
  }
}
?>