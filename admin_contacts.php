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

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:admin_contacts.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reply_message'])) {
   $reply_id = $_POST['message_id'];
   $reply_text = $_POST['reply_text'];
   
   $update_reply = $conn->prepare("UPDATE `message` SET reply = ? WHERE id = ?");
   $update_reply->execute([$reply_text, $reply_id]);
   
   header('location:admin_contacts.php');
   exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">
   <h1 class="title">Messages</h1>
   <div class="box-container">
   <?php
      $select_message = $conn->prepare("SELECT * FROM `message`");
      $select_message->execute();
      if($select_message->rowCount() > 0){
         while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> user id : <span><?= $fetch_message['user_id']; ?></span> </p>
      <p> Name : <span><?= $fetch_message['name']; ?></span> </p>
      <p> Number : <span><?= $fetch_message['number']; ?></span> </p>
      <p> Email : <span><?= $fetch_message['email']; ?></span> </p>
      <p> Message : <span><?= $fetch_message['message']; ?></span> </p>
      <p> Reply : <span><?= $fetch_message['reply'] ?: 'No reply yet'; ?></span> </p>

      <!-- Reply form -->
      <form action="admin_contacts.php" method="POST">
         <input type="hidden" name="message_id" value="<?= $fetch_message['id']; ?>">
         <textarea name="reply_text" placeholder="Enter your reply..." required><?= $fetch_message['reply']; ?></textarea>
         <button type="submit" name="reply_message" class="btn">Send Reply</button>
      </form>

      <a href="admin_contacts.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('Delete this message?');" class="delete-btn">Delete</a>
   </div>
   <?php
         }
      } else {
         echo '<p class="empty">You have no messages!</p>';
      }
   ?>
   </div>
</section>













<script src="js/script.js"></script>

</body>
</html>