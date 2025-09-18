<?php

@include 'DBConn.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="placed-orders">

   <h1 class="title">Placed Orders</h1>

   <div class="box-container">

   <?php
      // Prepare the query to fetch orders
      $select_orders = $conn->prepare("SELECT * FROM `tblorders` WHERE user_id = ?");
      $select_orders->bind_param("i", $user_id);  // Bind user_id parameter as integer
      $select_orders->execute();

      // Fetch results using get_result and fetch_assoc for mysqli
      $result = $select_orders->get_result();

      if ($result->num_rows > 0) {
         while ($fetch_orders = $result->fetch_assoc()) { 
   ?>
   <div class="box">
    <p><b> ordernum: </b><span><?= $fetch_orders['id']; ?></span> </p>
    <p><b> session ID: </b><span><?= $fetch_orders['user_id']; ?></span> </p>
    <p><b> placed on: </b><span><?= $fetch_orders['placed_on']; ?></span> </p>
    <p><b> name: </b><span><?= $fetch_orders['name']; ?></span> </p>
    <p><b> number: </b><span><?= $fetch_orders['number']; ?></span> </p>
    <p><b> email: </b><span><?= $fetch_orders['email']; ?></span> </p>
    <p><b> address: </b><span><?= $fetch_orders['address']; ?></span> </p>
    <p><b> payment method: </b><span><?= $fetch_orders['method']; ?></span> </p>
    <p><b> your orders: </b><span><?= $fetch_orders['total_products']; ?></span> </p>
    <p><b> total price: </b><span>R<?= $fetch_orders['total_price']; ?></span> </p> 
    <p><b> payment status: </b><span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') { echo 'red'; } else { echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
</div>

   <?php
         }
      } else {
         echo '<p class="empty">No orders placed yet!</p>';
      }
   ?>

   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
