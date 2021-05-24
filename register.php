<?php
$title="Register";
require_once("config/db.php");
// declaring var

$fname="";
$lname="";
$em="";
$em2="";
$password="";
$password2="";
$date="";
$error_array=[];

if(isset($_POST['register_button'])){

  $fname=strip_tags($_POST['reg_fname']);
  $fname=str_replace(' ','',$fname);
  $fname=ucfirst(strtolower($fname));
  $_SESSION['reg_fname']=$fname;


  $lname=strip_tags($_POST['reg_lname']);
  $lname=str_replace(' ','',$lname);
  $lname=ucfirst(strtolower($lname));
  $_SESSION['reg_lname']=$lname;

  $em=strip_tags($_POST['reg_email']);
  $em=str_replace(' ','',$em);
  $em=ucfirst(strtolower($em));
  $_SESSION['reg_email']=$em;

  $em2=strip_tags($_POST['reg_email2']);
  $em2=str_replace(' ','',$em2);
  $em2=ucfirst(strtolower($em2));
  $_SESSION['reg_email2']=$em2;
  

  $password=strip_tags($_POST['reg_password']);


  $password2=strip_tags($_POST['reg_password2']);
  
  $date=date("Y-m-d");


  if($em == $em2){
    if(filter_var($em,FILTER_VALIDATE_EMAIL)){
    $em=filter_var($em,FILTER_VALIDATE_EMAIL);
     
    $query="SELECT email FROM users WHERE email='$em'";
    $e_check=mysqli_query($conn,$query);

    $num_rows=mysqli_num_rows($e_check);

    if($num_rows > 0){
      array_push( $error_array,"Email already in use");
    }



    }else{
      array_push($error_array,"Invalid format");
    }

  } else{
    array_push($error_array,"email don't much");
  }


  if(strlen($fname) > 25 || strlen($fname) <2){
    array_push($error_array,"your first name must be between 2 and 25 characters");
  }

  if(strlen($lname) > 25 || strlen($lname) <2){
    array_push($error_array,"your first name must be between 2 and 25 characters");
  }

  if($password != $password2){
    array_push($error_array,"Your password not much");
  } else{
    if(preg_match('/[^A-Za-z0-9]/',$password)){
      array_push($error_array,"your password can only english characters or numbers");
    }
  }

  if(strlen($password) > 25 || strlen($password) <5){
    array_push($error_array,"your password must be between 2 and 25 characters and number");
  }


  if(empty($error_array)){
    $password=md5($password);
    
    $username=strtolower($fname . "_" . $lname);
    $query="SELECT username FROM users WHERE username='$username'";
    $check_username_query=mysqli_query($conn,$query);

    $i=0;
     while(mysqli_num_rows($check_username_query) !=0){
       $i++;
       $username=$username . "_" .$i;
       $query="SELECT username FROM users WHERE username='$username'";
       $check_username_query=mysqli_query($conn,$query);
     }
     
     $rand=rand(1,2);
     if($rand == 1){
     $profile_pic="assets/images/profile_pic/defaults/fun.svg";
    }else if ($rand == 2){
      $profile_pic="assets/images/profile_pic/defaults/strength.svg";
    }
   $query="INSERT INTO users VALUES 
    ('0','$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no',',')";
    mysqli_query($conn,$query);

    array_push($error_array,"<span style='color:green;'>You all set ! Go head and login</span>");

    $_SESSION['reg_fname']="";
    $_SESSION['reg_lname']="";
    $_SESSION['reg_email']="";
    $_SESSION['reg_email2']="";
    


 
  }

  
}


?>

<?php require_once("template/header.php"); ?>
<form action="register.php" method="post">
<div>
<input type="text" name="reg_fname" placeholder="First Name" value="<?php if(isset($_SESSION['reg_fname'])){
  echo $_SESSION['reg_fname'];
} ?>"  required>

<span> <?php  if(in_array("your first name must be between 2 and 25 characters" ,$error_array))
echo "your first name must be between 2 and 25 characters "
 ?></span>

</div>

<div>
<input type="text" name="reg_lname" placeholder="Last Name" value="<?php if(isset($_SESSION['reg_lname'])){
  echo $_SESSION['reg_lname'];
} ?>"  required>

<span> <?php  if(in_array("your last name must be between 2 and 25 characters" ,$error_array))
echo "your last name must be between 2 and 25 characters "
 ?></span>
</div>

<div>
<input type="email" name="reg_email" placeholder="Email" value="<?php if(isset($_SESSION['reg_email'])){
  echo $_SESSION['reg_email'];
} ?>"  required>

</div>

<div>

<input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php if(isset($_SESSION['reg_email2'])){
  echo $_SESSION['reg_email2'];
} ?>"  required>


<span> 
<?php  if(in_array("Email already in use" ,$error_array))
echo "Email is already in user ";
  else if(in_array("Invalid format" ,$error_array))
echo "Invalid format";

 else if(in_array("email don't much" ,$error_array))
echo "email don't much";
 ?>
 </span>

</div>

<div>
<input type="password" name="reg_password" placeholder="Password" required>
<input type="password" name="reg_password2" placeholder="Confirm Password" required>



<span> 
<?php  if(in_array("Your password not much" ,$error_array))
echo "Your password not much";

  else if(in_array("your password can only english characters or numbers" ,$error_array))
echo "your password can only english characters or numbers";

 else if(in_array("your password must be between 2 and 25 characters and number" ,$error_array))
echo "your password must be between 2 and 25 characters and number";
 ?>
 </span>

</div>

<div>
<input type="submit" value="Register" name="register_button">
</div>
<span>
<?php  if(in_array("<span style='color:green;'>You all set ! Gohead and login</span>" ,$error_array))
echo "You all set ! Go head and login";
?>
</span>
</form>
  
<?php require_once("template/footer.php") ?>