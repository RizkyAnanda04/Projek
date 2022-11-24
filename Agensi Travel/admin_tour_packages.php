<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_tour_packages'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);


   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_tour_packages = $conn->prepare("SELECT * FROM `tour_packages` WHERE name = ?");
   $select_tour_packages->execute([$name]);

   if($select_tour_packages->rowCount() > 0){
      $message[] = 'tour_packages name already exist!';
   }else{
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert_tour_packages = $conn->prepare("INSERT INTO `tour_packages`(name, image) VALUES(?,?,?)");
         $insert_tour_packages->execute([$name, $image]);
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'new tour packages added!';
      }
   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_tour_packages_image = $conn->prepare("SELECT image FROM `tour_packages` WHERE id = ?");
   $delete_tour_packages_image->execute([$delete_id]);
   $fetch_delete_image = $delete_tour_packages_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   $delete_tour_packages = $conn->prepare("DELETE FROM `tour_packages` WHERE id = ?");
   $delete_tour_packages->execute([$delete_id]);
   header('location:admin_tour_packages.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="image_website/Logo.png">
   <title>Tour Packages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="css/style_admin.css">

</head>
<body>

   <?php include 'admin_header.php' ?>

   <section class="add-tour-packages">

      <h1 class="heading">Add Tour Packages</h1>

      <form action="" method="post" enctype="multipart/form-data">
         <input type="text" class="box" required maxlength="100" placeholder="enter tour packages detail" name="name">
         <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
         <input type="submit" value="add tour packages" class="btn" name="admin_tour_packages">
      </form>

   </section>

   <section class="show-tour-packages">

      <h1 class="heading">Tour Packages Added</h1>

      <div class="box-container">

         <?php
         $select_tour_packages = $conn->prepare("SELECT * FROM `tour_packages`");
         $select_tour_packages->execute();
         if($select_tour_packages->rowCount() > 0){
            while($fetch_tour_packages = $select_tour_packages->fetch(PDO::FETCH_ASSOC)){ 
               ?>
               <div class="box">
                  <img src="uploaded_img/<?= $fetch_tour_packages['image']; ?>" alt="">
                  <div class="name"><?= $fetch_tour_packages['name']; ?></div>
                  <div class="flex-btn">
                     <a href="admin_tour_package_update.php?update=<?= $fetch_tour_packages['id']; ?>" class="option-btn">update</a>
                     <a href="admin_tour_packages.php?delete=<?= $fetch_tour_packages['id']; ?>" class="delete-btn" onclick="return confirm('delete this tour packages?');">delete</a>
                  </div>
               </div>
               <?php
            }
         }else{
            echo '<p class="empty">no tour packages added yet!</p>';
         }
         ?>
         
      </div>

   </section>



   <script src="js/admin_script.js"></script>

</body>
</html>