<?php

@include 'DBConn.php';

session_start();

$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
   header('location:login.php');
   exit();
}

if (isset($_POST['order'])) {
   // Sanitize form data
   $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
   $number = filter_var($_POST['number'], FILTER_SANITIZE_SPECIAL_CHARS);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
   $method = filter_var($_POST['method'], FILTER_SANITIZE_SPECIAL_CHARS);
   $address = 'flat no. ' . $_POST['flat'] . ' ' . $_POST['street'] . ' ' . $_POST['city'] . ' ' . $_POST['state'] . ' ' . $_POST['country'] . ' - ' . $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_SPECIAL_CHARS);
   $placed_on = date('d-M-Y');

   // Initialize cart total and products
   $cart_total = 0;
   $cart_products = [];

   // Retrieve cart items from the database (using mysqli)
   $cart_query = $conn->prepare("SELECT * FROM `tblcart` WHERE user_id = ?");
   $cart_query->bind_param('i', $user_id); // 'i' for integer type
   $cart_query->execute();
   $result = $cart_query->get_result(); // Get the result from executed query

   // Check if there are any items in the cart
   if ($result->num_rows > 0) {
      while ($cart_item = $result->fetch_assoc()) {
         // Add product name and quantity to cart products array
         $cart_products[] = $cart_item['name'] . ' ( ' . $cart_item['quantity'] . ' )';
         // Calculate subtotal for each cart item
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   // Convert array of cart products to a string
   $total_products = implode(', ', $cart_products);

   // Check if the same order already exists
   $order_query = $conn->prepare("SELECT * FROM `tblorders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
   $order_query->bind_param('sssssss', $name, $number, $email, $method, $address, $total_products, $cart_total);
   $order_query->execute();
   $order_result = $order_query->get_result();

   // Handle empty cart and duplicate order
   if ($cart_total == 0) {
      $message[] = 'Your cart is empty';
   } elseif ($order_result->num_rows > 0) {  // Change to mysqli_num_rows
      $message[] = 'Order has already been placed!';
   } else {
      // Insert the new order into the database
      $insert_order = $conn->prepare("INSERT INTO `tblorders` (user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $insert_order->bind_param('issssssss', $user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on);
      $insert_order->execute();

      // Remove items from the cart after order placement
      $delete_cart = $conn->prepare("DELETE FROM `tblcart` WHERE user_id = ?");
      $delete_cart->bind_param('i', $user_id); // 'i' for integer type
      $delete_cart->execute();

      $message[] = 'Order placed successfully!';
   }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="display-orders">
   <?php
      // Display cart items and total
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `tblcart` WHERE user_id = ?");
      $select_cart_items->bind_param('i', $user_id);  // Bind user_id parameter (type 'i' for integer)
      $select_cart_items->execute();

      // Get the result of the query
      $result = $select_cart_items->get_result();

      if ($result->num_rows > 0) {
         while ($fetch_cart_items = $result->fetch_assoc()) {
            $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
            $cart_grand_total += $cart_total_price;
   ?>
      <p> <?= $fetch_cart_items['name']; ?> <span>(R<?= number_format($fetch_cart_items['price'], 2); ?> x <?= $fetch_cart_items['quantity']; ?>)</span> </p>
   <?php
         }
      } else {
         echo '<p class="empty">Your cart is empty!</p>';
      }
   ?>
   <div class="grand-total">Grand total: <span>R<?= number_format($cart_grand_total, 2); ?></span></div>
</section>


<section class="checkout-orders">

   <form action="" method="POST">

      <h3>place your order</h3>

      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" placeholder="enter your name" class="box" required>
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" placeholder="enter your number" class="box" required>
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" placeholder="enter your email" class="box" required>
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method" class="box" required>
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paytm">paytm</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="text" name="flat" placeholder="e.g. house number" class="box" required>
         </div>
         <div class="inputBox">
            <span>address line 02 :</span>
            <input type="text" name="street" placeholder="e.g. street name" class="box" required>
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" placeholder="e.g. Qhebega" class="box" required>
         </div>
         <div class="inputBox">
            <span>province :</span>
            <input type="text" name="state" placeholder="e.g. Eastern Cape" class="box" required>
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" placeholder="e.g. South Africa" class="box" required>
         </div>
         <div class="inputBox">
            <span>postal code :</span>
            <input type="number" min="0" name="pin_code" placeholder="e.g. 1234" class="box" required>
         </div>
      </div>

      <input type="submit" name="order" class="btn <?= ($cart_grand_total > 1)?'':'disabled'; ?>" value="place order">

   </form>

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>