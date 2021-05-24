<?php
$title="Home";
require_once("template/header.php"); ?>


<div class="grid">
  <div class="user-info">
    <div>
      <img src="<?php echo $user['profile_pic'] ?>" alt="">
    </div>
    <div>
      <span><?php echo $user['first_name']?></span>
      <span>posts  <?php echo $user['num_posts'] ?></span>
      <span>likes  <?php echo $user['num_likes'] ?></span>
    </div>
  </div>
  <div class="main">
   <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, temporibus.</p>
  </div>

</div>





<?php require_once("template/footer.php"); ?>