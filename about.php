<?php

@include 'DBConn.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>


<section class="vision-mission">

   <div class="row">

      <div class="box">
         <h3>Our Vision</h3>
         <p>To become the leading platform for branded pre-owned clothing, creating a global community of conscious consumers who value sustainability, affordability, and high-quality fashion.</p>
      </div>

      <div class="box">
         <h3>Our Mission</h3>
         <p>Our mission is to make second-hand shopping the first choice by offering a wide range of premium, authenticated, and sustainable fashion. We aim to provide a seamless shopping experience while fostering a community of eco-conscious individuals.</p>
      </div>

      <div class="box">
         <h3>Our Statement</h3>
         <p>At Pastimes, we believe in reducing fashion waste by giving high-quality, branded pre-loved clothing a second chance. We strive to offer an inclusive and reliable marketplace where buyers and sellers can engage with transparency, trust, and ease.</p>
      </div>

   </div>

</section>


<section class="reviews">

   <h1 class="title">clients reivews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p><b>"Amazing experience!"</b></p>
         <p>"I absolutely love shopping at Pastimes! The selection of branded second-hand clothes is fantastic, and the platform is so easy to use. I found some amazing pieces at great prices, and the whole process was smooth."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john doe</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
         <p><b>"Sustainable fashion at its best!"</b></p>
         <p>"Pastimes has truly redefined second-hand shopping. Not only do they offer quality, branded clothing, but I love how they focus on sustainability. It's great to know I'm contributing to reducing waste."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>stephanie jones</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p><b>"A game-changer for sellers!"</b></p>
         <p>"As a seller, Pastimes has been a game-changer. The seller dashboard is super user-friendly, and I love how easy it is to list my items. It's the perfect platform to give my pre-loved clothes a new home."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>mark smith</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <p><b>"Trustworthy and reliable!"</b></p>
         <p>"I was a bit hesitant at first, but Pastimes made me feel secure with their reliable authentication process and secure payment options. I trust the site for both buying and selling, and it's been a great experience!"</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>sarah santori</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.png" alt="">
         <p><b>"Fantastic customer service!"</b></p>
         <p>"I had a small issue with my order, and the customer service team was incredibly helpful and responsive. They resolved the issue quickly, and I felt valued as a customer."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>joshua gopal</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.png" alt="">
         <p><b>"Affordable and high-quality!"</b></p>
         <p>"I’ve found some amazing deals on Pastimes! The clothes are in great condition, and the prices are unbeatable. It's the perfect place to shop for branded items without breaking the bank."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>emma wang</h3>
      </div>

   </div>

</section>

<section class="about">

   <div class="row">

      <div class="box">
         <h3>why choose us?</h3>
         <p><b>1.	Sustainability First: </b>By supporting Pastimes, you’re not just purchasing clothes; you’re contributing to a more sustainable future. We believe in giving pre-loved items a second chance, helping reduce waste and promoting conscious shopping.</p>
         <p><b>2.	Buyer Confidence: </b>With features like high-resolution product images, a zoom-in tool, and customer reviews, you can shop with complete peace of mind. You can inspect products thoroughly before making a purchase, ensuring you’re getting what you expect.</p>
         <p><b>3.	High-Quality, Verified Products: </b>Every item listed on Pastimes goes through a thorough verification process, ensuring that only high-quality, branded clothing makes it to our marketplace. Our stringent quality control means you get the best pre-owned fashion at unbeatable prices.</p>

         <a href="contact.php" class="btn">contact us</a>
      </div>

      <div class="box">
         <h3>what we provide?</h3>
         <p><b>1.	An Extensive Product Range: </b>Explore a wide variety of high-quality branded clothing, accessories, and shoes for men, women, kids, and more. Our platform showcases top-quality pre-owned items across various categories, ensuring there’s something for everyone.</p>
         <p><b>2.	Advanced Search & Filtering: </b>Find exactly what you’re looking for with our powerful search and filtering options. Narrow your results by brand, size, condition, price range, and more, ensuring a smooth and tailored shopping experience.</p>
         <p><b>2.	Seller Dashboard: </b>For sellers, we provide an intuitive dashboard to manage listings, track sales, view earnings, and monitor performance. The dashboard helps sellers optimize their strategies and stay on top of their inventory.</p>
         <a href="shop.php" class="btn">our shop</a>
      </div>

   </div>

</section>

<section class="company-policy">

   <div class="row">

      <div class="box">
         <h3>Company Policy</h3>
         <p><b>1. Return & Refund Policy:</b> We offer a 30-day return policy for all purchases. If you are not satisfied with your item, you can return it within 30 days of receiving it for a full refund, as long as the item is in its original condition.</p>
         <p><b>2. Shipping Policy:</b> We provide various shipping options for both buyers and sellers, ensuring timely and reliable delivery of all orders. Shipping fees are calculated at checkout based on location.</p>
         <p><b>3. Seller Guidelines:</b> Sellers must ensure all items listed are accurate, authentic, and in good condition. Any violation of these terms may result in suspension or removal from the platform.</p>
         <p><b>4. Privacy Policy:</b> We prioritize the privacy and security of our users. Your personal data will never be shared with third parties without your consent, and all transactions are processed securely.</p>
         <p><b>5. Customer Support:</b> Our customer service team is available 24/7 to assist with any inquiries or issues you may have. Please feel free to reach out to us via our contact page for support.</p>
      </div>

   </div>

</section>


<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>