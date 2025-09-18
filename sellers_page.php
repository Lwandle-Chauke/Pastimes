<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <?php include 'header.php'; ?>


</head>

<body> 

<div class="hero-image">
  <div class="hero-text">
    <h1 style="font-size:50px">Want to find your clothes a new home?</h1>
    <p>Order a Pastimes bag and start selling!</p>
    <a href="waitlist_php" class="btn">Join Waitlist</a>
  </div>
</div>

</body>

<section class="sellers-Order A Bag">

   <h1 class="title">How it Works</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/cat-1.png" alt="">
         <h3>Fill</h3>
         <p>Ready to say goodbye and maybe earn some cash? Order a bag with us today </p>
         <p>and fill it to the brim with clothes, accessories and shoes!</p>
      </div>

      <div class="box">
         <img src="images/cat-2.png" alt="">
         <h3>Send</h3>
         <p>Send us your bag when you are redy to say goodbye!</p>
         <p> We do offer home collection within the area, locker drop-offs and more!</p>
      </div>

      <div class="box">
         <img src="images/cat-3.png" alt="">
         <h3>Sell</h3>
         <p>Once the items have been cleared from inspection, we'll handle the rest</p>
         <p>Should your item be sold, you can earn either cash, credit to spend on thrifts,</p>
         <p>or donate to a charity of your choice</p>
         <a href="waitlist_php" class="btn">Order now!</a>
      </div>

</section> 


<section class="sellers-Brand Checker">

<h1 class= "title" </h1>
<div class="box"> 
    <h2>class = tit</h2>

<form action="" method="POST">
      <input type="text" class="box" name="search_box" placeholder="Search Brand name">
      <input type="submit" name="search_btn" value="search" class="btn">
   </form>

</div>
   

</section>









<?php
      if(isset($_POST['search_btn'])){
      $search_box = $_POST['search_box'];
      $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
      $select_products = $conn->prepare("SELECT * FROM `brands` WHERE name LIKE '%{$search_box}%'");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no result found!</p>';
      }
      
   };
   ?>

   </div>

</section>




