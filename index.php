<?php
$title="Home";
require_once("template/header.php");
require_once("classes/User.php");
require_once("classes/Post.php");

if(isset($_SESSION['username'])){
  $userLoggedIn=$_SESSION['username'];

  $query="SELECT * FROM users WHERE username='$userLoggedIn'";
  $user_details_query=mysqli_query($conn,$query);
  $user=mysqli_fetch_array($user_details_query);
}else{
  header("Location:./login.php");
}


if(isset($_POST['post'])){
$post=new Post($conn,$userLoggedIn);
$post->submitPost($_POST['post_text'],'none');
header("Loaction:index.php");
exit;
}


?>

<div class="grid">
  <div class="user-info">
    <div>
      <a href="<?php echo $userLoggedIn ?>">
      <img src="<?php echo $user['profile_pic'] ?>" alt="">
      </a>
    </div>
    <div>
      <span><a href="<?php echo $userLoggedIn ?>">
      <?php echo $user['first_name']?></span>
      </a>
    
      <span>posts  <?php echo $user['num_posts'] ?></span>
      <span>likes  <?php echo $user['num_likes'] ?></span>
    </div>
  </div>
  <div class="main">
  <form action="index.php" method="post">
  <textarea name="post_text" id="post_text" cols="60" rows="10"></textarea>
  <input type="submit" name="post" value="Post" class="btn">
  </form>
  
  </div>

</div>





<?php require_once("template/footer.php"); ?>