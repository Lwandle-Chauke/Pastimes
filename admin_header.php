<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if admin is logged in and set admin_id
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
} else {
    // Redirect to login page if admin is not logged in
    header('Location: login.php');
    exit();
}

if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}

?>

<header class="header">

    <div class="flex">

        <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

        <nav class="navbar">
            <a href="admin_page.php">home</a>
            <a href="admin_products.php">products</a>
            <a href="admin_orders.php">orders</a>
            <a href="admin_users.php">users</a>
            <a href="admin_contacts.php">messages</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="profile">
            <?php
            // Prepare the query to get the admin profile details
            $select_profile = $conn->prepare("SELECT * FROM `tblusers` WHERE id = ?");
            $select_profile->execute([$admin_id]);

            // Fetch the profile details
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

            // Check if the profile exists
            if ($fetch_profile) {
                ?>
                <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
                <p><?= $fetch_profile['name']; ?></p>
                <a href="admin_update_profile.php" class="btn">update profile</a>
                <a href="logout.php" class="delete-btn">logout</a>
                <?php
            } else {
                // Handle the case where no profile was found
                echo 'Profile not found.';
            }
            ?>

            <div class="flex-btn">
                <a href="login.php" class="option-btn">login</a>
                <a href="register.php" class="option-btn">register</a>
            </div>
        </div>

    </div>

</header>
