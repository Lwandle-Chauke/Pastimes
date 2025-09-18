<?php
@include 'DBConn.php';

session_start();

$user_id = $_SESSION['user_id'];

// Redirect to login if user is not logged in
if (!isset($user_id)) {
   header('location:login.php');
   exit;
}

if (isset($_POST['send'])) {
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_SPECIAL_CHARS);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_SPECIAL_CHARS);

   // Prepare the select statement
$select_message = $conn->prepare("SELECT * FROM `message` WHERE name = ? AND email = ? AND number = ? AND message = ?");
$select_message->bind_param("ssss", $name, $email, $number, $msg); // Bind parameters
$select_message->execute();

// Get the result
$result = $select_message->get_result();

// Check if any rows are found
if ($result->num_rows > 0) {
   $message[] = 'Message already sent!';
} else {
   // Insert new message into database
   $insert_message = $conn->prepare("INSERT INTO `message` (user_id, name, email, number, message) VALUES (?, ?, ?, ?, ?)");
   $insert_message->bind_param("issss", $user_id, $name, $email, $number, $msg); // Bind parameters
   $insert_message->execute();

   $message[] = 'Message sent successfully!';
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>

   <!-- Font Awesome CDN link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="contact">
   <h1 class="title">Get in Touch</h1>

   <!-- Contact Form -->
   <form action="" method="POST">
      <input type="text" name="name" class="box" required placeholder="Enter your name">
      <input type="email" name="email" class="box" required placeholder="Enter your email">
      <input type="number" name="number" min="0" class="box" required placeholder="Enter your number">
      <textarea name="msg" class="box" required placeholder="Enter your message" cols="30" rows="10"></textarea>
      <input type="submit" value="Send Message" class="btn" name="send">
   </form>
</section>

<!-- Display user's messages and admin replies -->
<section class="user-messages">
   <h2>Your Messages</h2>
   
   <div class="box-container">
   <?php
// Fetch user's messages and admin replies
$select_user_messages = $conn->prepare("SELECT * FROM `message` WHERE user_id = ?");
$select_user_messages->bind_param("i", $user_id);
$select_user_messages->execute();
$result = $select_user_messages->get_result();

if ($result->num_rows > 0) {
   while ($user_message = $result->fetch_assoc()) {
      ?>
      <div class="box">
         <p><strong>Your Message:</strong> <?= htmlspecialchars($user_message['message']); ?></p>
         <p><strong>Admin Reply:</strong> <?= $user_message['reply'] ?: 'No reply yet'; ?></p>
      </div>
      <?php
   }
} else {
   echo '<p class="empty">You have no messages!</p>';
}
?>

   </div>
</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
