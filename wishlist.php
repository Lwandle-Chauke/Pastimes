<?php

@include 'DBConn.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

// Query to fetch wishlist items for the logged-in user
$select_wishlist = $conn->prepare("SELECT * FROM `tblwishlist` WHERE user_id = ?");
$select_wishlist->bind_param("i", $user_id); // Binding user_id parameter
$select_wishlist->execute();
$wishlist_result = $select_wishlist->get_result();  // Use get_result

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Wishlist</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="wishlist">

   <h1 class="title">Products Added</h1>

   <div class="box-container">

   <?php
      $grand_total = 0;

      if ($wishlist_result->num_rows > 0) {
         // Loop through wishlist items
         while ($fetch_wishlist = $wishlist_result->fetch_assoc()) { 
   ?>
   
   <form action="" method="POST" class="box">
      <a href="wishlist.php?delete=<?= $fetch_wishlist['id']; ?>" class="fas fa-times" onclick="return confirm('Delete this from wishlist?');"></a>
      <a href="view_page.php?pid=<?= $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>
      <img src="project images/<?= htmlspecialchars($fetch_wishlist['image']); ?>" alt="Product Image">
      <div class="name"><?= htmlspecialchars($fetch_wishlist['name']); ?></div>
      <div class="price">R<?= htmlspecialchars($fetch_wishlist['price']); ?></div> 
      <input type="number" min="1" value="1" class="qty" name="p_qty">
      <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_wishlist['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_wishlist['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_wishlist['image']; ?>">
      <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
   </form>

   <?php
         $grand_total += $fetch_wishlist['price'];
         }
      } else {
         echo '<p class="empty">Your wishlist is empty</p>';
      }
   ?>
   </div>

   <div class="wishlist-total">
      <p>Grand Total: <span>R<?= $grand_total; ?></span></p>
      <a href="shop.php" class="option-btn">Continue Shopping</a>
      <a href="wishlist.php?delete_all" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Delete All</a>
   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>

<?php
// Handle wishlist item deletion
if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_item = $conn->prepare("DELETE FROM `tblwishlist` WHERE id = ?");
   $delete_item->bind_param("i", $delete_id);
   $delete_item->execute();
   header('location:wishlist.php');
}

// Handle delete all items in wishlist
if (isset($_GET['delete_all'])) {
   $delete_all = $conn->prepare("DELETE FROM `tblwishlist` WHERE user_id = ?");
   $delete_all->bind_param("i", $user_id);
   $delete_all->execute();
   header('location:wishlist.php');
}

// Handle add to cart functionality
if (isset($_POST['add_to_cart'])) {
   $pid = $_POST['pid'];
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_POST['p_image'];
   $p_qty = $_POST['p_qty'];

   // Ensure $p_price is a float since the price is typically a decimal number
   $p_price = floatval($p_price);

   // Insert the item into the cart
   $add_to_cart = $conn->prepare("INSERT INTO `tblcart` (user_id, pid, name, price, quantity, image) VALUES (?, ?, ?, ?, ?, ?)");
   
   // Ensure the correct types for bind_param (i = integer, s = string)
   $add_to_cart->bind_param("iisis", $user_id, $pid, $p_name, $p_price, $p_qty, $p_image);
   $add_to_cart->execute();
   header('location:wishlist.php');
}
?>
