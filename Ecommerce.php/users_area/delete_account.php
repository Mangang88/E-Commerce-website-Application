<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Account</title>
</head>
<body>
  <h3 class="text-danger mb-4">Delete Account</h3>
  <form action="delete_account.php" method="post" class=" mt-5">
    <div class="form-outline mb-4">
      <input type="submit" class="form-control w-50 m-auto" name="delete" value="Delete Account">
    </div>
    <div class="form-outline mb-4">
      <input type="submit" class="form-control w-50 m-auto" name="dont_delete" value="Don't Delete Account">
    </div>
  </form>
</body>
</html>

<?php
session_start();
include('../includes/connect.php');

if(isset($_SESSION['username'])){
    $username_session = $_SESSION['username'];

    if(isset($_POST['delete'])){
        // Prepare the delete query
        $delete_query = "DELETE FROM `user_table` WHERE username='$username_session'";
        
        // Execute the query
        $result = mysqli_query($con, $delete_query);

        if($result){
            // Destroy the session and redirect to the home page
            session_destroy();
            echo "<script> alert('Account Deleted successfully')</script>";
            echo "<script>window.open('../index.php','_self')</script>";
        } else {
            // Handle query execution error
            echo "<script>alert('Failed to delete account. Please try again.')</script>";
            echo "<script>window.open('delete_account.php','_self')</script>";
        }
    }

    if(isset($_POST['dont_delete'])){
        // Redirect back to the profile page
        echo "<script>window.open('./profile.php','_self')</script>";
    }
} else {
    // Handle session username not set
    echo "Session username not set!";
}
?>

