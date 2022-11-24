<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
      <span>'.$message.'</span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">
      <a href="admin_page.php" class="logo"><img src="image_website/Logo.png" width="40px" height="40px"> Agensi<span> Travel</span></a>

      <nav class="navbar">
         <a href="admin_page.php">Home</a>
         <a href="admin_tour_packages.php">Tour Packages</a>
         <a href="admin_bookings.php">Bookings</a>
         <a href="admin_messages.php">Messages</a>
         <a href="admin_accounts.php">Admin</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
         $select_profile->execute([$admin_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="admin_profile_update.php" class="btn">Update Profile</a>
         <a href="admin_logout.php" class="delete-btn">Logout</a>
         <div class="flex-btn">
            <a href="admin_login.php" class="option-btn">Login</a>
            <a href="admin_register.php" class="option-btn">Register</a>
         </div>
      </div>
   </section>

</header>