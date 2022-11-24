<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}


if(isset($_POST['delete'])){

   $delete_id = $_POST['delete_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_delete = $conn->prepare("SELECT * FROM `messages` WHERE id = ?");
   $verify_delete->execute([$delete_id]);

   if($verify_delete->rowCount() > 0){
      $delete_bookings = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
      $delete_bookings->execute([$delete_id]);
      $success_msg[] = 'Message deleted!';
   }else{
      $warning_msg[] = 'Message deleted already!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="image_website/Logo.png">
   <title>Messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="css/style_admin.css">

</head>
<body>
   
   <!-- header section starts  -->
   <?php include 'admin_header.php' ?>
   <!-- header section ends -->

   <!-- messages section starts  -->

   <section class="pesan">

      <h1 class="heading">Messages</h1>

      <div class="box-container">

         <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         if($select_messages->rowCount() > 0){
            while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
               ?>
               <div class="box">
                  <p>Name : <span><?= $fetch_messages['name']; ?></span></p>
                  <p>Email : <span><?= $fetch_messages['email']; ?></span></p>
                  <p>Number : <span><?= $fetch_messages['number']; ?></span></p>
                  <p>Message : <span><?= $fetch_messages['message']; ?></span></p>
                  <form action="" method="POST">
                     <input type="hidden" name="delete_id" value="<?= $fetch_messages['id']; ?>">
                     <input type="submit" value="delete message" onclick="return confirm('delete this message?');" name="delete" class="delete-btn">
                  </form>
               </div>

               <?php
            }
         }else{
            ?>
            <div class="box" style="text-align: center;">
               <p class="empty">no messages!</p>
               <a href="admin_page.php" class="btn">Go To Home</a>
            </div>
            <?php
         }
         ?>

      </div>

   </section>

   <!-- messages section ends -->

   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

   <!-- custom js file link  -->
   <script src="js/admin_script.js"></script>

   <?php include 'messages.php'; ?>

</body>
</html>