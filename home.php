<?php
if (session_status() == PHP_SESSION_NONE) {
   session_start();
}
@include 'DBConn.php';

$user_id = $_SESSION['user_id'] ?? null;

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_wishlist'])){
   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_SPECIAL_CHARS);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_SPECIAL_CHARS);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_SPECIAL_CHARS);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_SPECIAL_CHARS);

   // Clean the image path (remove absolute part)
   $p_image = str_replace("C:\\wamp\\www\\Pastimes\\_images\\", "", $p_image);
   $p_image = str_replace("\"", "", $p_image); // Remove quotes if needed

   // Check wishlist for existing items
   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `tblwishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->bind_param("si", $p_name, $user_id); // Use bind_param with correct types
   $check_wishlist_numbers->execute();
   $check_wishlist_numbers->store_result();
   if($check_wishlist_numbers->num_rows > 0){
      $message[] = 'already added to wishlist!';
   } else {
      // Check if the item is already in the cart
      $check_cart_numbers = $conn->prepare("SELECT * FROM `tblcart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->bind_param("si", $p_name, $user_id); // Use bind_param with correct types
      $check_cart_numbers->execute();
      $check_cart_numbers->store_result();
      if($check_cart_numbers->num_rows > 0){
         $message[] = 'already added to cart!';
      } else {
         // Add to wishlist
         $insert_wishlist = $conn->prepare("INSERT INTO `tblwishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
         $insert_wishlist->bind_param("iisss", $user_id, $pid, $p_name, $p_price, $p_image);
         $insert_wishlist->execute();
         $message[] = 'added to wishlist!';
      }
   }
}

if(isset($_POST['add_to_cart'])){
   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_SPECIAL_CHARS);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_SPECIAL_CHARS);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_SPECIAL_CHARS);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_SPECIAL_CHARS);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_SPECIAL_CHARS);

   // Clean the image path (remove absolute part)
   $p_image = str_replace("C:\\wamp\\www\\Pastimes\\_images\\", "", $p_image);
   $p_image = str_replace("\"", "", $p_image); // Remove quotes if needed

   // Check cart for existing items
   $check_cart_numbers = $conn->prepare("SELECT * FROM `tblcart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->bind_param("si", $p_name, $user_id); // Use bind_param with correct types
   $check_cart_numbers->execute();
   $check_cart_numbers->store_result();
   if($check_cart_numbers->num_rows > 0){
      $message[] = 'already added to cart!';
   } else {
      // Check wishlist for existing items
      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `tblwishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->bind_param("si", $p_name, $user_id); // Use bind_param with correct types
      $check_wishlist_numbers->execute();
      $check_wishlist_numbers->store_result();
      if($check_wishlist_numbers->num_rows > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `tblwishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->bind_param("si", $p_name, $user_id);
         $delete_wishlist->execute();
      }

      // Add to cart
      $insert_cart = $conn->prepare("INSERT INTO `tblcart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->bind_param("iissis", $user_id, $pid, $p_name, $p_price, $p_qty, $p_image);
      $insert_cart->execute();
      $message[] = 'added to cart!';
   }
}
?>

<!-- Rest of the HTML code -->



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">
         <span>the joy of finding again.</span>
         <h3>Welcome to Pastimes</h3>
         <p>Your go-to online marketplace for branded, pre-owned clothing! We offer a seamless shopping experience where buyers can find high-quality, second-hand fashion and sellers can easily list their items. Whether you're looking to refresh your wardrobe or give your gently used clothes a second life, Pastimes makes sustainable fashion both accessible and convenient for everyone.</p>
         <a href="about.php" class="btn">about us</a>
      </div>

   </section>

</div>

<section class="home-category">
   <h1 class="title">shop by category</h1>
   <div class="box-container">
      <div class="box">
         <img src="images\cat-1.jpg" alt="">
         <h3>women</h3>
         <p>The Women's category features a wide range of stylish and trendy clothing, whether you're looking for casual wear, office attire, or something special for an evening out, this category offers a diverse selection to suit every taste and occasion.</p>
         <a href="category.php?category=women" class="btn">women</a>
      </div>

      <div class="box">
         <img src="images\cat-2.jpg" alt="">
         <h3>men</h3>
         <p>The Men's category offers a curated collection of clothing designed for comfort and style, this category has everything a modern man needs to stay stylish and confident. Perfect for any occasion.</p>
         <a href="category.php?category=men" class="btn">men</a>
      </div>

      <div class="box">
         <img src="images\cat-3.jpg" alt="">
         <h3>kids</h3>
         <p>The Kids category is packed with fun, playful, and durable clothing for boys and girls of all ages. This collection ensures your little ones are always dressed in style. Enjoy high-quality, comfortable clothing that can withstand the active lifestyles of children.</p>
         <a href="category.php?category=kids" class="btn">kids</a>
      </div>

      <div class="box">
         <img src="images\cat-4.jpg" alt="">
         <h3>accessories</h3>
         <p>The Accessories category is your go-to destination for finishing touches that elevate any outfit. Whether you're looking for a statement piece or something more subtle, find the perfect accessories to enhance your personal style.</p>
         <a href="category.php?category=accessories" class="btn">accessories</a>
      </div>

      <div class="box">
         <img src="images\cat-5.jpg" alt="">
         <h3>shoes</h3>
         <p>The Shoes category features a vast array of footwear for every occasion and style. From sneakers, sandals, and boots to formal shoes and high heels, this category offers footwear that combines comfort, durability, and trendiness.</p>
         <a href="category.php?category=shoes" class="btn">shoes</a>
      </div>
   </div>
</section>

<section class="products">
   <h1 class="title">featured products</h1>
   <div class="box-container">
   <?php
   $select_products = $conn->prepare("SELECT id, name, price, image, brand, `condition`, size FROM `tblproducts` LIMIT 6");
   $select_products->execute();
   $select_products->bind_result($id, $name, $price, $image, $brand, $condition, $size);

   if($select_products->fetch()) {
      do {
?>
   <form action="" class="box" method="POST">
   <div class="price">R<span><?= htmlspecialchars($price); ?></span></div>
   <a href="view_page.php?pid=<?= htmlspecialchars($id); ?>" class="fas fa-eye"></a>
   <img src="project images/<?= htmlspecialchars($image); ?>" alt="">
   <div class="name"><?= htmlspecialchars($name); ?></div>
   <input type="hidden" name="pid" value="<?= htmlspecialchars($id); ?>">
   <input type="hidden" name="p_name" value="<?= htmlspecialchars($name); ?>">
   <input type="hidden" name="p_price" value="<?= htmlspecialchars($price); ?>">
   <input type="hidden" name="p_image" value="<?= htmlspecialchars($image); ?>">
   <input type="number" min="1" value="1" name="p_qty" class="qty">
   <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
   <input type="submit" value="add to cart" class="btn" name="add_to_cart">
</form>


<?php
      } while ($select_products->fetch());
   } else {
      echo '<p class="empty">no products added yet!</p>';
   }
   $select_products->close();
?>

   </div>
</section>

<section class="our-goals">
      <div class="content">
         <h3>Our Goals</h3>
         <p><b>1.	Customer-Centric Shopping Experience:</b>  Enhance the buying and selling process of branded second-hand clothing by providing a seamless, intuitive, and enjoyable experience for users, with features like advanced search, dynamic product zoom, and flexible payment options.</p>
         <p><b>2.	Build Trust & Transparency:</b>  Ensure a safe, reliable marketplace by integrating robust authentication, secure payment gateways, and a brand checker tool for product authenticity.</p>
         <p><b>3.	Sustainability & Quality:</b>  Promote sustainable fashion by supporting the buying and selling of high-quality, pre-owned branded clothing, contributing to reducing waste and promoting circular fashion.</p>
         <p><b>4.	Empower Sellers:</b>  Offer a comprehensive seller dashboard, flexible selling options, and real-time performance tracking to help sellers manage their inventory and optimize their sales strategies.</p>
         <p><b>5.	Accessibility & Convenience:</b> Provide an easy-to-use platform that allows users to switch seamlessly between buyer and seller roles, ensuring an inclusive and versatile experience for all users.</p>
      </div>
   </section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
