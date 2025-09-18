<?php
try {
   $conn = new PDO("mysql:host=localhost;dbname=clothing_store", "root", "");
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
   echo "Connection failed: " . $e->getMessage();
}

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
   exit;
}

if (isset($_POST['add_product'])) {
   $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
   $price = filter_var($_POST['price'], FILTER_SANITIZE_SPECIAL_CHARS);
   $category = filter_var($_POST['category'], FILTER_SANITIZE_SPECIAL_CHARS);
   $details = filter_var($_POST['details'], FILTER_SANITIZE_SPECIAL_CHARS);
   $image = filter_var($_FILES['image']['name'], FILTER_SANITIZE_SPECIAL_CHARS);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/' . $image;

   $select_products = $conn->prepare("SELECT * FROM `tblproducts` WHERE name = ?");
   $select_products->execute([$name]);

   if ($select_products->rowCount() > 0) {
      $message[] = 'Product name already exists!';
   } else {
      $insert_products = $conn->prepare("INSERT INTO `tblproducts`(name, category, details, price, image) VALUES(?,?,?,?,?)");
      $insert_products->execute([$name, $category, $details, $price, $image]);

      if ($insert_products) {
         if ($image_size > 2000000) {
            $message[] = 'Image size is too large!';
         } else {
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'New product added!';
         }
      }
   }
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $select_delete_image = $conn->prepare("SELECT image FROM `tblproducts` WHERE id = ?");
   $select_delete_image->execute([$delete_id]);
   $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_img/' . $fetch_delete_image['image']);
   $delete_products = $conn->prepare("DELETE FROM `tblproducts` WHERE id = ?");
   $delete_products->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `tblwishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `tblcart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:admin_products.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="add-products">

   <h1 class="title">add new product</h1>

   <form action="" method="POST" enctype="multipart/form-data">
   <div class="flex">
      <div class="inputBox">
         <input type="text" name="name" class="box" required placeholder="Enter product name">
         <select name="category" class="box" required>
            <option value="" selected disabled>Select category</option>
            <option value="women">Women</option>
            <option value="men">Men</option>
            <option value="kids">Kids</option>
            <option value="accessories">Accessories</option>
            <option value="shoes">Shoes</option>
         </select>
         <input type="text" name="size" class="box" required placeholder="Enter size">
      </div>
      <div class="inputBox">
         <input type="number" min="0" name="price" class="box" required placeholder="Enter product price">
         <select name="condition" class="box" required>
            <option value="" selected disabled>Select condition</option>
            <option value="new">New</option>
            <option value="like new">Like New</option>
            <option value="gently loved">Gently Loved</option>
            <option value="slightly worn">Slightly Worn</option>
         </select>
         <input type="text" name="brand" class="box" required placeholder="Enter brand">
      </div>
   </div>
   <textarea name="details" class="box" required placeholder="Enter product details" cols="30" rows="10"></textarea>
   <input type="file" name="image" required class="box" accept="image/jpg, image/jpeg, image/png">
   <input type="submit" class="btn" value="Add Product" name="add_product">
</form>


</section>

<section class="show-products">
   <h1 class="title">Your Products</h1>
   <div class="box-container">
      <?php
      $select_products = $conn->prepare("SELECT * FROM `tblproducts`");
      $select_products->execute();

      if ($select_products->rowCount() > 0) {
         while ($product = $select_products->fetch(PDO::FETCH_ASSOC)) {
            $image_path = 'project images/' . htmlspecialchars($product['image']);
            ?>
            <div class="box">
               <div class="price">R<?= htmlspecialchars($product['price']); ?></div>
               <?php if (file_exists($image_path)): ?>
                  <img src="<?= $image_path; ?>" alt="Product Image">
               <?php else: ?>
                  <img src="default_img/default.png" alt="Default Image">
               <?php endif; ?>
               <div class="name"><?= htmlspecialchars($product['name']); ?></div>
               <div class="cat"><?= htmlspecialchars($product['category']); ?></div>
               <div class="details"><?= htmlspecialchars($product['details']); ?></div>
               <div class="flex-btn">
                  <a href="admin_update_product.php?update=<?= $product['id']; ?>" class="option-btn">Update</a>
                  <a href="admin_products.php?delete=<?= $product['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
               </div>
            </div>
            <?php
         }
      } else {
         echo '<p class="empty">No products added yet!</p>';
      }
      ?>
   </div>
</section>














<script src="js/script.js"></script>

</body>
</html>