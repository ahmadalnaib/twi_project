<?php
$title="Login";
require_once("config/db.php");
// declaring var
$error_array=[];


if(isset($_POST['login_button'])){

  $email=filter_var($_POST['log_email'],FILTER_SANITIZE_EMAIL);

  $_SESSION['log_email']=$email;
   $password=md5($_POST['log_password']);
  
   $query="SELECT * FROM users WHERE email='$email' AND password='$password'";
   $check_database_query=mysqli_query($conn,$query);

   $check_login_query=mysqli_num_rows($check_database_query);

   if($check_login_query == 1){
     $row=mysqli_fetch_array($check_database_query);
     $username=$row['username'];
     $query2="SELECT * FROM users WHERE email='$email' AND user_closed='yes'";
     $user_closed_query=mysqli_query($conn,$query2);
     if(mysqli_num_rows($user_closed_query) ==1){
       $reopen_account=mysqli_query($conn,"UPDATE users SET user_closed='no' WHERE email='$email'");
     }
     $_SESSION['username']=$username;
     header("location:index.php");
     exit();
   } else{
     array_push($error_array,"Email or passowrd was incorrect");
   }
}



?>

<?php require_once("template/header.php"); ?>


<form action="login.php" method="post">

<div>
<input type="email" name="log_email" placeholder="Email" value="<?php if(isset($_SESSION['log_email'])){
  echo $_SESSION['log_email'];
} ?>"  required>

<span> <?php  if(in_array("Email or passowrd was incorrect" ,$error_array))
echo "Email or passowrd was incorrect "
 ?></span>
</div>

<div>
<input type="password" name="log_password" placeholder="Password">
</div>

<input type="submit" name="login_button" value="Login">

</form>
  
<?php require_once("template/footer.php") ?>

