<?php

@include 'DBConn.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
   exit();
}

if(isset($_POST['add_to_wishlist'])){

   $pid = filter_var($_POST['pid'], FILTER_SANITIZE_SPECIAL_CHARS);
   $p_name = filter_var($_POST['p_name'], FILTER_SANITIZE_SPECIAL_CHARS);
   $p_price = filter_var($_POST['p_price'], FILTER_SANITIZE_SPECIAL_CHARS);
   $p_image = str_replace("C:\\wamp\\www\\Pastimes\\_images\\", "", filter_var($_POST['p_image'], FILTER_SANITIZE_SPECIAL_CHARS));

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `tblwishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->bind_param("si", $p_name, $user_id);
   $check_wishlist_numbers->execute();
   $wishlist_result = $check_wishlist_numbers->get_result();

   $check_cart_numbers = $conn->prepare("SELECT * FROM `tblcart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->bind_param("si", $p_name, $user_id);
   $check_cart_numbers->execute();
   $cart_result = $check_cart_numbers->get_result();

   if($wishlist_result->num_rows > 0){
      $message[] = 'already added to wishlist!';
   } elseif($cart_result->num_rows > 0){
      $message[] = 'already added to cart!';
   } else {
      $insert_wishlist = $conn->prepare("INSERT INTO `tblwishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->bind_param("iisss", $user_id, $pid, $p_name, $p_price, $p_image);
      $insert_wishlist->execute();
      $message[] = 'added to wishlist!';
   }

}

if(isset($_POST['add_to_cart'])){

   $pid = filter_var($_POST['pid'], FILTER_SANITIZE_SPECIAL_CHARS);
   $p_name = filter_var($_POST['p_name'], FILTER_SANITIZE_SPECIAL_CHARS);
   $p_price = filter_var($_POST['p_price'], FILTER_SANITIZE_SPECIAL_CHARS);
   $p_image = str_replace("C:\\wamp\\www\\Pastimes\\_images\\", "", filter_var($_POST['p_image'], FILTER_SANITIZE_SPECIAL_CHARS));
   $p_qty = filter_var($_POST['p_qty'], FILTER_SANITIZE_SPECIAL_CHARS);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `tblcart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->bind_param("si", $p_name, $user_id);
   $check_cart_numbers->execute();
   $cart_result = $check_cart_numbers->get_result();

   if($cart_result->num_rows > 0){
      $message[] = 'already added to cart!';
   } else {
      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `tblwishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->bind_param("si", $p_name, $user_id);
      $check_wishlist_numbers->execute();
      $wishlist_result = $check_wishlist_numbers->get_result();

      if($wishlist_result->num_rows > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `tblwishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->bind_param("si", $p_name, $user_id);
         $delete_wishlist->execute();
      }

      $insert_cart = $conn->prepare("INSERT INTO `tblcart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->bind_param("iissis", $user_id, $pid, $p_name, $p_price, $p_qty, $p_image);
      $insert_cart->execute();
      $message[] = 'added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Quick View</title>

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="quick-view">

   <h1 class="title">Quick View</h1>

   <?php
$pid = $_GET['pid'];
$select_products = $conn->prepare("SELECT * FROM `tblproducts` WHERE id = ?");
$select_products->bind_param("i", $pid);
$select_products->execute();
$result = $select_products->get_result();

if($result->num_rows > 0){
    while($fetch_products = $result->fetch_assoc()){
?>
<form action="" class="box" method="POST">
    <div class="price">R<span><?= htmlspecialchars($fetch_products['price']); ?></span></div>
    <a href="view_page.php?pid=<?= htmlspecialchars($fetch_products['id']); ?>" class="fas fa-eye"></a>
    <img src="project images/<?= htmlspecialchars($fetch_products['image']); ?>" alt="">
    <div class="name"><?= htmlspecialchars($fetch_products['name']); ?></div>
    <div class="details"><b>Brand:</b> <?= htmlspecialchars($fetch_products['brand']); ?></div>
    <div class="details"><b>Condition:</b> <?= htmlspecialchars($fetch_products['condition']); ?></div>
    <div class="details"><b>Size:</b> <?= htmlspecialchars($fetch_products['size']); ?></div>

    <input type="hidden" name="pid" value="<?= htmlspecialchars($fetch_products['id']); ?>">
    <input type="hidden" name="p_name" value="<?= htmlspecialchars($fetch_products['name']); ?>">
    <input type="hidden" name="p_price" value="<?= htmlspecialchars($fetch_products['price']); ?>">
    <input type="hidden" name="p_image" value="<?= htmlspecialchars($fetch_products['image']); ?>">
    <input type="number" min="1" value="1" name="p_qty" class="qty">
    <input type="submit" value="Add to Wishlist" class="option-btn" name="add_to_wishlist">
    <input type="submit" value="Add to Cart" class="btn" name="add_to_cart">
</form>
<?php
    }
} else {
    echo "<p>No product found!</p>";
}
?>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
