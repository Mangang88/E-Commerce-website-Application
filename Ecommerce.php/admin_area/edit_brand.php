<?php
if(isset($_GET['edit_brand'])){
  $edit_brand=$_GET['edit_brand'];
  // echo $edit_brand;

  $get_brand="SELECT * FROM `brands` WHERE brand_id=$edit_brand";
  $result=mysqli_query($con,$get_brand);
  $row=mysqli_fetch_assoc($result);
  $brand_title=$row['brand_title'];
}

if(isset($_POST['edit_brand'])){
  $brand_title=$_POST['brand_title'];
  $update_query="UPDATE `brands` SET brand_title='$brand_title' WHERE brand_id=$edit_brand";
  $result_brand=mysqli_query($con,$update_query);
  if($result_brand){
    echo "<script>alert('brand has been updated successfully!')</script>";
    echo "<script>window.open('./index.php?view_brands','_self')</script>";
  }
}
?>


<div class="container mt-3">
  <h1 class="text-center">Edit Brand</h1>
  <form action="" method="post"  class="text-center" enctype="multipart/form-data">
        <!-- Category title-->
    <div class="form-outline mb-4 w-50 m-auto">
      <label for="brand_title" class="form-label">Brand Title</label>
      <input type="text" value="<?php echo $brand_title;?>" name="brand_title" id="brand_title" class="form-control" placeholder="Enter your brand title" autocomplete="off" required="required">
    </div>
     <!--Update Button --> 
     <div class="form-outline mb-4 w-50 m-auto">
    <input type="submit" name="edit_brand" class="btn btn-info mb-3 px-3" value="Update Brand">
</div>
</form>
</div>