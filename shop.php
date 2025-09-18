<?php
@include 'DBConn.php'; // Include the database connection file

session_start(); // Start the session

// Check if user is logged in
$user_id = $_SESSION['user_id'] ?? null;
if (!isset($user_id)) {
    header('location:login.php');
    exit;
}

// Add to wishlist
if (isset($_POST['add_to_wishlist'])) {
    $pid = filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT);
    $p_name = filter_var($_POST['p_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $p_price = filter_var($_POST['p_price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $p_image = filter_var($_POST['p_image'], FILTER_SANITIZE_SPECIAL_CHARS);

    // Adjust image path to be relative, similar to home.php
    $p_image = str_replace("C:\\wamp\\www\\Pastimes\\_images\\", "", $p_image);
    $p_image = str_replace("\"", "", $p_image); // Remove quotes if needed

    // Check if product already in wishlist or cart
    $check_wishlist = $conn->prepare("SELECT * FROM `tblwishlist` WHERE name = ? AND user_id = ?");
    $check_wishlist->bind_param("si", $p_name, $user_id);
    $check_wishlist->execute();
    $wishlist_result = $check_wishlist->get_result();

    $check_cart = $conn->prepare("SELECT * FROM `tblcart` WHERE name = ? AND user_id = ?");
    $check_cart->bind_param("si", $p_name, $user_id);
    $check_cart->execute();
    $cart_result = $check_cart->get_result();

    if ($wishlist_result->num_rows > 0) {
        $message[] = 'Already added to wishlist!';
    } elseif ($cart_result->num_rows > 0) {
        $message[] = 'Already added to cart!';
    } else {
        $insert_wishlist = $conn->prepare("INSERT INTO `tblwishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
        $insert_wishlist->bind_param("iisss", $user_id, $pid, $p_name, $p_price, $p_image);
        $insert_wishlist->execute();
        $message[] = 'Added to wishlist!';
    }
}

// Add to cart
if (isset($_POST['add_to_cart'])) {
    $pid = filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT);
    $p_name = filter_var($_POST['p_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $p_price = filter_var($_POST['p_price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $p_image = filter_var($_POST['p_image'], FILTER_SANITIZE_SPECIAL_CHARS);
    $p_qty = filter_var($_POST['p_qty'], FILTER_SANITIZE_NUMBER_INT);

    // Adjust image path to be relative, similar to home.php
    $p_image = str_replace("C:\\wamp\\www\\Pastimes\\_images\\", "", $p_image);
    $p_image = str_replace("\"", "", $p_image); // Remove quotes if needed

    // Check if product already in cart
    $check_cart = $conn->prepare("SELECT * FROM `tblcart` WHERE name = ? AND user_id = ?");
    $check_cart->bind_param("si", $p_name, $user_id);
    $check_cart->execute();
    $cart_result = $check_cart->get_result();

    if ($cart_result->num_rows > 0) {
        $message[] = 'Already added to cart!';
    } else {
        // Remove item from wishlist if it exists
        $check_wishlist = $conn->prepare("SELECT * FROM `tblwishlist` WHERE name = ? AND user_id = ?");
        $check_wishlist->bind_param("si", $p_name, $user_id);
        $check_wishlist->execute();
        if ($check_wishlist->get_result()->num_rows > 0) {
            $delete_wishlist = $conn->prepare("DELETE FROM `tblwishlist` WHERE name = ? AND user_id = ?");
            $delete_wishlist->bind_param("si", $p_name, $user_id);
            $delete_wishlist->execute();
        }

        // Add to cart
        $insert_cart = $conn->prepare("INSERT INTO `tblcart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
        $insert_cart->bind_param("iissis", $user_id, $pid, $p_name, $p_price, $p_qty, $p_image);
        $insert_cart->execute();
        $message[] = 'Added to cart!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<section class="p-category">

   <a href="category.php?category=women">women</a>
   <a href="category.php?category=men">men</a>
   <a href="category.php?category=kids">kids</a>
   <a href="category.php?category=accessories">accessories</a>
   <a href="category.php?category=shoes">shoes</a>

</section>

<section class="products">
    <h1 class="title">Shop</h1>
    <div class="box-container">
    <?php
    $select_products = $conn->prepare("SELECT id, name, price, image, brand, `condition`, size FROM `tblproducts`");
    $select_products->execute();
    $select_products->bind_result($id, $name, $price, $image, $brand, $condition, $size);

    if ($select_products->fetch()) {
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
        echo '<p class="empty">No products added yet!</p>';
    }
    $select_products->close();
    ?>
    </div>
</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
