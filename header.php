<?php
if (session_status() == PHP_SESSION_NONE) {
   session_start();
}
@include 'DBConn.php';

$user_id = $_SESSION['user_id'] ?? null;

// Check if user is logged in
if ($user_id) {
   // Count items in cart
$count_cart_items = $conn->prepare("SELECT * FROM `tblcart` WHERE user_id = ?");
$count_cart_items->bind_param("i", $user_id);
$count_cart_items->execute();
$count_cart_items->store_result(); // Store the result set
$cart_count = $count_cart_items->num_rows; // Get the row count
$count_cart_items->close();

    // Count items in wishlist
$count_wishlist_items = $conn->prepare("SELECT * FROM `tblwishlist` WHERE user_id = ?");
$count_wishlist_items->bind_param("i", $user_id);
$count_wishlist_items->execute();
$count_wishlist_items->store_result(); // Store the result set
$wishlist_count = $count_wishlist_items->num_rows; // Get the row count
$count_wishlist_items->close();

    // Fetch user profile
    $get_profile = $conn->prepare("SELECT * FROM `tblusers` WHERE id = ?");
    $get_profile->bind_param("i", $user_id);
    $get_profile->execute();
    $profile_data = $get_profile->get_result()->fetch_assoc();
    $get_profile->close();
} else {
    $wishlist_count = 0;
    $cart_count = 0;
}

if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Pastimes<span>.</span></a>

      <nav class="navbar">
         <a href="home.php">home</a>
         <a href="shop.php">shop</a>
         <a href="orders.php">orders</a>
         <a href="about.php">about</a>
         <a href="contact.php">contact</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <a href="search_page.php" class="fas fa-search"></a>
         <!-- Display wishlist and cart item counts -->
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $wishlist_count; ?>)</span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $cart_count; ?>)</span></a>
      </div>

      <div class="profile">
         <?php if ($user_id): ?>
            <img src="uploaded_img/<?= $profile_data['image']; ?>" alt="">
            <p><?= $profile_data['name']; ?></p>
            <a href="user_profile_update.php" class="btn">update profile</a>
            <a href="logout.php" class="delete-btn">logout</a>
         <?php else: ?>
            <div class="flex-btn">
               <a href="login.php" class="option-btn">login</a>
               <a href="register.php" class="option-btn">register</a>
            </div>
         <?php endif; ?>
      </div>

   </div>

</header>
