<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="image_website/Logo.png">
   <title>Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="css/style_admin.css">

</head>
<body>

   <?php include 'admin_header.php' ?>

   <section class="dashboard">

      <h1 class="heading">Dashboard</h1>

      <div class="box-container">

         <div class="box">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
            ?>
            <h3><?= $number_of_orders; ?></h3>
            <p>Bookings Placed</p>
            <a href="admin_bookings.php" class="btn">see bookings</a>
         </div>

         <div class="box">
            <?php
            $select_tour_packages = $conn->prepare("SELECT * FROM `tour_packages`");
            $select_tour_packages->execute();
            $number_of_tour_packages = $select_tour_packages->rowCount()
            ?>
            <h3><?= $number_of_tour_packages; ?></h3>
            <p>Tour Packages Added</p>
            <a href="admin_tour_packages.php" class="btn">see tour packages</a>
         </div>

         <div class="box">
            <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $count_messages = $select_messages->rowCount();
            ?>
            <h3><?= $count_messages; ?></h3>
            <p>Total Messages</p>
            <a href="admin_messages.php" class="btn">see messages</a>
         </div>

         <div class="box">
            <?php
            $select_admins = $conn->prepare("SELECT * FROM `admin`");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
            ?>
            <h3><?= $number_of_admins; ?></h3>
            <p>Admin Users</p>
            <a href="admin_accounts.php" class="btn">see admins</a>
         </div>

      </div>

   </section>

   <script src="js/admin_script.js"></script>

</body>
</html>