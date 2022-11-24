<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_tour_packages'])){

   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $update_<?php

   = $conn->prepare("UPDATE `tour_packagess` SET name = ? WHERE id = ?");
   $update_tour_packages->execute([$name, $pid]);

   $message[] = 'tour_packages updated successfully!';

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `tour_packagess` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $pid]);
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('uploaded_img/'.$old_image);
         $message[] = 'image updated successfully!';
      }
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
   <title>Update Tour Packages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="css/style_admin.css">

</head>
<body>

   <?php include 'admin_header.php' ?>

   <section class="update-tour-packages">

      <h1 class="heading">Update Tour Packages</h1>

      <?php
      $update_id = $_GET['update'];
      $select_tour_packagess = $conn->prepare("SELECT * FROM `tour_packagess` WHERE id = ?");
      $select_tour_packagess->execute([$update_id]);
      if($select_tour_packagess->rowCount() > 0){
         while($fetch_tour_packages = $select_tour_packages->fetch(PDO::FETCH_ASSOC)){ 
            ?>
            <form action="" enctype="multipart/form-data" method="post">
               <input type="hidden" name="pid" value="<?= $fetch_tour_packages['id']; ?>">
               <input type="hidden" name="old_image" value="<?= $fetch_tour_packages['image']; ?>">
               <img src="uploaded_img/<?= $fetch_tour_packages['image']; ?>" alt="">
               <input type="text" class="box" required maxlength="100" placeholder="enter tour_packages name" name="name" value="<?= $fetch_tour_packages['name']; ?>">
               <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box">
               <div class="flex-btn">
                  <input type="submit" value="update tour_packages" class="btn" name="update_tour_packages">
                  <a href="admin_tour_packages.php" class="option-btn">Go Back</a>
               </div>
            </form>

            <?php
         }
      }else{
         echo '<p class="empty">no tour_packages found!</p>';
      }
      ?>

   </section>




   <script src="js/admin_script.js"></script>

</body>
</html>