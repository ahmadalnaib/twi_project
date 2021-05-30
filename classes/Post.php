<?php
class Post{
private $user_obj;
private $conn;

public function __construct($conn,$user){
  $this->conn=$conn;
  $this->user_obj=new User($conn,$user);
}


public function submitPost($body,$user_to){
$body=strip_tags($body);
$body=mysqli_real_escape_string($this->conn,$body);
$body=str_replace('\r\n','\n',$body);
$body=nl2br($body);
$check_empty=preg_replace('/\s+/','',$body);
if($check_empty != ""){
  $date_added=date("Y-m-d H:i:s");
  $added_by=$this->user_obj->getUsername();

  if($user_to == $added_by){
    $user_to="none";
  }
  $sql="INSERT INTO posts VALUES(NULL,'$body','$added_by','$user_to','$date_added','no','no','0')";
  $query=mysqli_query($this->conn,$sql);
  var_dump($sql);  $returned_id=mysqli_insert_id($this->conn);

  $num_posts=$this->user_obj->getNumPosts();
  $num_posts++;
  $sql="UPDATE users SET num_posts='$num_posts' WHERE usersname='$added_by'";
  $update_query=mysqli_query($this->conn,$sql);
}
}


}