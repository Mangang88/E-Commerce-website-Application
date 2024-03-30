<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Users</title>
  <!-- Include jQuery library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <h3 class="text-center text-success">All Users</h3>
  <table class="table table-bordered mt-5">
    <thead class="bg-info">
      <?php
      include('../includes/connect.php');
      $get_users = "SELECT * FROM `user_table`";
      $result = mysqli_query($con, $get_users);
      $row_count = mysqli_num_rows($result);
      echo "<tr class='text-center'>
      <th class='bg-info'>SLno.</th>
      <th class='bg-info'>Username</th>
      <th class='bg-info'>User email</th>
      <th class='bg-info'>User Image</th>
      <th class='bg-info'>User address</th>
      <th class='bg-info'>User mobile</th>
      <th class='bg-info'>Delete</th>
      </tr>
      </thead>
      <tbody>";

      if($row_count == 0){
        echo "<h2 class='bg-danger text-center mt-5'>No users yet</h2>";
      } else {
        $number = 0;
        while($row_data = mysqli_fetch_assoc($result)){
          $user_id = $row_data['user_id'];
          $username = $row_data['username'];
          $user_email = $row_data['user_email'];
          $user_image = $row_data['user_image'];
          $user_address = $row_data['user_address'];
          $user_mobile = $row_data['user_mobile'];

          $number++;
          echo "<tr>
          <td class='bg-secondary text-center text-light'>$number</td>
          <td class='bg-secondary text-center text-light'>$username</td>
          <td class='bg-secondary text-center text-light'>$user_email</td>
          <td class='bg-secondary text-center text-light'><img src='../users_area/user_images/$user_image' class='product_img'  alt='$username' /></td>
          <td class='bg-secondary text-center text-light'>$user_address</td>
          <td class='bg-secondary text-center text-light'>$user_mobile</td>
          <td class='bg-secondary text-light'><a href='#exampleModal' data-toggle='modal' class='text-light delete-link' data-id='$user_id'><i class='fa-solid fa-trash'></i></a></td>
          </tr>";
        }
      }

      ?>
    </tbody>
  </table>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">    
        <div class="modal-body">
          <h4 class="">Are you sure you want to delete this?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button id="confirmDeleteBtn" type="button" class="btn btn-primary">Yes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript code for dynamically updating delete link in modal -->
  <script>
    $(document).ready(function(){
      $('.delete-link').click(function(){
        var userId = $(this).data('id');
        var deleteUrl = 'delete_users.php?delete_user=' + userId;
        $('#exampleModal #confirmDeleteBtn').attr('onclick', "window.location.href='" + deleteUrl + "'");
      });
    });
  </script>
</body>
</html>






