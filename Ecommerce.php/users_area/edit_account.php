<?php
if(isset($_GET['edit_account'])){
  // Check if 'username' key is set in $_SESSION array
  if(isset($_SESSION['username'])){
    $user_session_name=$_SESSION['username'];
    $select_query="SELECT * FROM `user_table` WHERE username='$user_session_name'";
    $result_query=mysqli_query($con,$select_query);
    // Check if query executed successfully
    if($result_query){
      $row_fetch=mysqli_fetch_assoc($result_query);
      // Check if user details exist in the result
      if($row_fetch){
        $user_id=$row_fetch['user_id'];
        $username=$row_fetch['username'];
        $user_email=$row_fetch['user_email'];
        // Check if 'user_mobile', 'user_address', and 'user_image' keys are set in $row_fetch array
        $user_mobile = isset($row_fetch['user_mobile']) ? $row_fetch['user_mobile'] : '';
        $user_address = isset($row_fetch['user_address']) ? $row_fetch['user_address'] : '';
        $user_image = isset($row_fetch['user_image']) ? $row_fetch['user_image'] : '';
        
        if(isset($_POST['user_update'])){
          $update_id=$user_id;
          $user_username=$_POST['user_username'];
          $user_email=$_POST['user_email'];
          $user_mobile=$_POST['user_contact'];
          $user_address=$_POST['user_address'];
          $user_image=$_FILES['user_image']['name'];
          $user_image_tmp=$_FILES['user_image']['tmp_name'];
          move_uploaded_file($user_image_tmp,"./user_images/$user_image");

          //update query
          $update_data="UPDATE `user_table` SET  username='$username',user_email='$user_email',user_image='$user_image',user_address='$user_address',user_mobile='$user_mobile' WHERE user_id=$update_id";
          $result_query_update=mysqli_query($con,$update_data);
          if($result_query_update){
            echo "<script>alert('Data updated successfully!')</script>";
            echo "<script>window.open('logout.php','_self')</script>";
          }
        }
      } else {
        echo "User details not found.";
      }
    } else {
      echo "Error retrieving user details.";
    }
  } else {
    echo "Username not found in session.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit account</title>
  <style>
        .edit_image{
          width:10%;
          height:10%;
          margin: auto;
          display:block;
          object-fit:contain;
        }
  </style>
</head>
<body>
  <h3 class="text-success mb-4">Edit account</h3>
  <form action="" class="" method="post" enctype="multipart/form-data">
    <div class="form-outline mb-4">
      <input type="text" class="form-control w-50 m-auto" placeholder="username" value="<?php echo $username ?>" name="user_username">
    </div>
    <div class="form-outline mb-4">
      <input type="text" class="form-control w-50 m-auto" placeholder="user email" value="<?php echo $user_email ?>" name="user_email">
    </div>
      <!-- user image -->
      <div class="form-outline mb-4 m-auto w-50 d-flex">
      <input type="file" name="user_image" id="user_image" class="form-control m-auto" required="required">
      <img src="./user_images/<?php echo $user_image ?>" alt="" class="edit_image">
    </div>
    <div class="form-outline mb-4">
      <input type="text" class="form-control w-50 m-auto" placeholder="user address" value="<?php echo $user_address ?>" name="user_address">
    </div>
    <div class="form-outline mb-4">
      <input type="text" class="form-control w-50 m-auto" placeholder="user contact" value="<?php echo $user_mobile ?>" name="user_contact">
    </div>
     <!-- Button --> 
     <div class="form-outline mb-4 w-50 m-auto">
    <input type="submit" name="user_update" class="bg-info py-2 px-3 border-0" value="update">
    </div>
  </form>
</body>
</html> 