<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  
</head>
<body>
  <h3 class="text-center text-success">All Products</h3>
  <table class="table table-bordered mt-5">
    <thead class="bg-info">
      <tr class="">
        <th class="bg-info">Product ID</th>
        <th class="bg-info">Products Title</th>
        <th class="bg-info">Product Image</th>
        <th class="bg-info">Product Price</th>
        <th class="bg-info">Total Sold</th>
        <th class="bg-info">Status</th>
        <th class="bg-info">Edit</th>
        <th class="bg-info">Delete</th>
      </tr>
    </thead>
    <tbody class="bg-secondary text-light">
      <?php
        $get_products= "SELECT * FROM `products`";
        $result = mysqli_query($con, $get_products);
        $number=0;
        while($row = mysqli_fetch_assoc($result)){
          $product_id = $row['product_id'];
          $product_title = $row['product_title'];
          $product_image1 = $row['product_image1'];
          $product_price = $row['product_price'];
          $status = $row['status'];
          $number++;
          ?>
          <tr class='text-center'>
          <td class='bg-secondary text-light'><?php echo $number; ?></td>
          <td class='bg-secondary text-light'><?php echo $product_title; ?></td>
          <td class='bg-secondary text-light'><img src='./product_images/<?php echo $product_image1; ?>' alt='' class='product_img'></td>
          <td class='bg-secondary text-light'><?php echo $product_price;?>/-</td>
          <td class='bg-secondary text-light'>
            <?php
            $get_count="SELECT * FROM `orders_pending` WHERE product_id=$product_id";
            $result_count=mysqli_query($con,$get_count);
            $rows_count=mysqli_num_rows($result_count);
            echo $rows_count;
            
            ?></td>
          <td class='bg-secondary text-light'><?php echo $status; ?></td>
          <td class='bg-secondary text-light'><a href='index.php?edit_products=<?php echo $product_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
          <td class='bg-secondary text-light'><a href='index.php?delete_product=<?php echo $product_id ?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
  </table>
</body>
</html>