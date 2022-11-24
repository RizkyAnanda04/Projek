<?php

include 'config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_GET['logout'])){
   session_unset();
   session_destroy();
   header('location:home.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="image_website/Logo.png">
   <title>Home</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Icon Font Stylesheet -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

   <!-- Customized Bootstrap Stylesheet -->
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

   <!-- link swiper untuk slide -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

   <!-- script Chatbot -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

   <!-- custom css file link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

   <?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>';
      }
   }
   ?>

   <!-- header section -->

   <header class="header">

      <section class="flex">

         <a href="#home" class="logo"><img src="image_website/Logo.png" width="40px" height="40px"><span>Agensi</span> Travel</a>

            <nav class="navbar">
               <a href="#home">Home</a>
               <a href="#about">About</a>
               <a href="#wisata">Wisata</a>
               <a href="#tourpackages.php">Tour Packages</a>
               <a href="#guide">Guide</a>
               <a href="#reviewklien">Review</a>
            </nav>

         <div class="icons">
          <div id="menu-btn" class="fas fa-bars"></div>
          <div id="user-btn" class="fas fa-user"></div>
       </div>

    </section>

 </header>

 <!-- user account section -->
 <div class="user-account">

   <section>

      <div id="close-account"><span>close</span></div>

      <div class="user">
         <?php
         $select_user = $conn->prepare("SELECT * FROM `user` WHERE id = ?");
         $select_user->execute([$user_id]);
         if($select_user->rowCount() > 0){
            while($fetch_user = $select_user->fetch(PDO::FETCH_ASSOC)){
               echo '<p>welcome ! <span>'.$fetch_user['name'].'</span></p>';
               echo '<a href="home.php?logout" class="btn">logout</a>';
            }
         }else{
            echo '<p><span>you are not logged in now!</span></p>';
         }
         ?>
      </div>

      <div class="flex">

         <form action="user_login.php" method="post">
            <h3>login now</h3>
            <input type="email" name="email" required class="box" placeholder="enter your email" maxlength="50">
            <input type="password" name="pass" required class="box" placeholder="enter your password" maxlength="20">
            <input type="submit" value="login now" name="login" class="btn-account">
         </form>

         <form action="user_register.php" method="post">
            <h3>register now</h3>
            <input type="text" name="name" oninput="this.value = this.value.replace(/\s/g, '')" required class="box" placeholder="enter your username" maxlength="20">
            <input type="email" name="email" required class="box" placeholder="enter your email" maxlength="50">
            <input type="password" name="pass" required class="box" placeholder="enter your password" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="cpass" required class="box" placeholder="confirm your password" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="register now" name="register" class="btn-account">
         </form>

      </div>

   </section>

</div>

<!-- home section -->
<section class="home" id="home">

   <div class="swiper home-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide" style="background:url(image_website/slide1.jpg) no-repeat">
            <div class="content">
               <h2> WISATA PANTAI INDONESIA </h2>
               <h3> INDONESIAN BEACH TOURISM </h3>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(image_website/slide2.jpg) no-repeat">
            <div class="content">
               <h2> ALAM INDONESIA INDAH </h2>
               <h3> BEAUTIFUL INDONESIAN NATURE </h3>
            </div>
         </div>

      </div>

      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

   </div>

</section>

<!-- about section -->
<section class="home-about" id="about">

   <div class="image">
      <img src="image_website/about.jpg" alt="">
   </div>

   <div class="content">
      <h3>About</h3>
      <p style="text-align: justify;">Web ini  bertujuan untuk menampilkan wisata dan melakukan pemesanan wisata </p>
   </div>

</section>

<!-- wisata section -->
<section class="wisata" id="wisata">
<div class="container-xxl py-5 destination">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-5">Popular Destination</h1>
        </div>
        <div class="row g-3">
            <div class="col-lg-7 col-md-6">
                <div class="row g-3">
                    <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                        <a class="position-relative d-block overflow-hidden" href="">
                            <img class="img-fluid" src="image_website/wisata-1.jpg" alt="" width="700px">
                            <div class="bg-white text-primary fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">Pantai Bali Lestari</div>
                            <div class="bg-white text-info fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Read More</div>                        
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                        <a class="position-relative d-block overflow-hidden" href="">
                            <img class="img-fluid" src="image_website/wisata-2.jpg" alt="" width="600px">
                            <div class="bg-white text-primary fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">Pantai Bulbul</div>
                            <div class="bg-white text-info fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Read More</div>  
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                        <a class="position-relative d-block overflow-hidden" href="">
                            <img class="img-fluid" src="image_website/wisata-3.jpg" alt="" width="600px">
                            <div class="bg-white text-primary fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">Pantai Loa</div>
                            <div class="bg-white text-info fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Read More</div>  
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                <a class="position-relative d-block h-100 overflow-hidden" href="">
                    <img class="img-fluid position-absolute w-100 h-100" src="image_website/wisata-4.jpg" alt="" style="object-fit: cover;">
                    <div class="bg-white text-primary fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">Pantai Mutiara</div>
                    <div class="bg-white text-info fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Read More</div>  
                </a>
            </div>
        </div>
    </div>
</div>
</section>

<!-- tour package section -->
<section class="tourpackages" id="tourpackages">
</section>

<!-- guide section -->
<section class="guide" id="guide">
   <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-5">Meet Our Guide</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="image_website/guide-5.png" alt="" height="800px" width="250px">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                        <a class="btn2 btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn2 btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn2 btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">Raisa Diandra</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="image_website/guide-4.png" alt="" height="800px" width="250px">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                        <a class="btn2 btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn2 btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn2 btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">Kevin Gultom</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="image_website/guide-5.png" alt="" height="800px" width="250px">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                        <a class="btn2 btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn2 btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn2 btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">Raisa Saraswati</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="team-item">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="image_website/guide-4.png" alt="" height="800px" width="250px">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                        <a class="btn2 btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn2 btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn2 btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">Handoko Chen</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<!-- message section -->
<section class="messages" id="messages">

   <div class="row">

      <form action="" method="post">

         <h3>Send Us Message</h3>

         <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="box">
         <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
         <input type="number" name="number" required maxlength="10" min="0" max="9999999999" placeholder="enter your number" class="box">
         <textarea name="message" class="box" required maxlength="1000" placeholder="enter your message" cols="30" rows="10"></textarea>
         <input type="submit" value="send message" name="send" class="btn1">

      </form>

   </div>

</section>

<!-- reviews section -->
<section class="reviewklien" id="reviewklien">

   <h3>Review Kliens</h3>

   <div class="swiper reviewklien-slider">

      <div class="swiper-wrapper">
         <div class="swiper-slide box">
            <img src="image_website/review-1.jpeg" alt="">
            <h4>Andrew Subakja</h4>
            <h6>"Recommended sih nih agency,harga terjangkau,servicenya oke banget pokoknya".</h6>
         </div>

         <div class="swiper-slide box">
            <img src="image_website/review-2.jpeg" alt="">
            <h4>Bila Vendra</h4>
            <h6>"Awalnya aku iseng doang pake jasa agensi ini,tapi ternyata bagus banget,
            cobain deh pokoknya".</h6>
         </div>

         <div class="swiper-slide box">
            <img src="image_website/review-3.jpeg" alt="">
            <h4>Gilang Bakti</h4>
            <h6>"Gua awalnya ragu nyobain nih agency,cuman teman gue nyaranin buat coba agen travel ini.Ternyata ga sia sia, selain harganya pas di kantong guidenya juga ramah, recommended pokoknya".</h6>
         </div>

         <div class="swiper-slide box">
            <img src="image_website/review-4.jpg" alt="">
            <h4>Elisa Yunita</h4>
            <h6>"Wajib kembali lagi ke travel ini".</h6>
         </div>

         <div class="swiper-slide box">
            <img src="image_website/review-5.jpg" alt="">
            <h4>Sabrina Ananda</h4>
            <h6>"Travel ini sangat cocok untuk mahasiswa travelling".</h6>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<!-- maps section -->
<section class="maps">

   <h3>Maps Agensi Travel</h3>

   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.1127073259872!2d98.62959771373573!3d3.561513451474888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312fbd7aa7a1bb%3A0x44578709a4c9f198!2sJl.%20Kenanga%20Raya%2C%20Tj.%20Sari%2C%20Kec.%20Medan%20Selayang%2C%20Kota%20Medan%2C%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1667708545604!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

</section>

<!-- footer section -->
<section class="footer">

   <div class="box-container">

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>Hubungi Ke</h3>
         <p>081397366572</p>
      </div>

      <div class="box">
         <i class="fas fa-clock"></i>
         <h3>Buka Jam</h3>
         <p>08.00-16.00</p>
      </div>

      <div class="box">
         <i class="fas fa-envelope"></i>
         <h3>Email</h3>
         <p>travelwisata@gmail.com</p>
      </div>

      <div class="box">
         <i class="fas fa-map-marker-alt"></i>
         <h3>Alamat</h3>
         <p>Jalan Kenanga Raya</p>
      </div>

   </div>

</section>

<!-- Back to Top -->
<a href="#" class="btn2 btn-lg btn-info btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- script swiper untuk slide -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/Script.js"></script>

<?php include 'messages.php'; ?>

<!--Chatbot-->
<div id="chatBtn"></div>

<script>
   $(function() {
      $("#chatBtn").load("Chatbot/Chatbot.php")
   })
</script>

<script src="assets/js/jquery.js"></script>
<script src="assets/js/popper.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</body>
</html>