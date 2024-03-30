<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Payments</title>
  <!-- Include jQuery library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h3 class="text-center text-success">All Payments</h3>
<table class="table table-bordered mt-5">
  <thead class="bg-info">
    <?php
    $get_payments="SELECT * FROM `user_payments`";
    $result=mysqli_query($con,$get_payments);
    $row_count=mysqli_num_rows($result);
    echo "<tr class='text-center'>
    <th class='bg-info'>SLno.</th>
    <th class='bg-info'>Invoice Number</th>
    <th class='bg-info'>Amount</th>
    <th class='bg-info'>Payment mode</th>
    <th class='bg-info'>Order date</th>
    <th class='bg-info'>Delete</th>
  </tr>
</thead>
<tbody>";

if($row_count==0){
  echo "<h2 class='bg-danger text-center mt-5'>No Payments yet</h2>";
}else{
  $number=0;
  while($row_data=mysqli_fetch_assoc($result)){
    $payment_id=$row_data['payment_id'];
    $amount=$row_data['amount'];
    $invoice_number=$row_data['invoice_number'];
    $payment_mode=$row_data['payment_mode'];
    $date=$row_data['date'];
    $number++;
    echo "<tr>
    <td class='bg-secondary text-center text-light'>$number</td>
    <td class='bg-secondary text-center text-light'>$invoice_number</td>
    <td class='bg-secondary text-center text-light'>$amount</td>
    <td class='bg-secondary text-center text-light'>$payment_mode</td>
    <td class='bg-secondary text-center text-light'>$date</td>
    <td class='bg-secondary text-light'><a href='#exampleModal' data-toggle='modal' class='text-light delete-link' data-id='".$payment_id."'><i class='fa-solid fa-trash'></i></a></td>
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
    var paymentId = $(this).data('id');
    var deleteUrl = 'delete_payments.php?delete_payments=' + paymentId;
    $('#exampleModal #confirmDeleteBtn').attr('onclick', "window.location.href='" + deleteUrl + "'");
  });
});
</script>

</body>
</html>



