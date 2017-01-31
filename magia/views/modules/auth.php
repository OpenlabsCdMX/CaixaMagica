<?php
$userId = 1;//Session::get("uid");//Replace for an User BL method
if(empty($userId)){
  header("Location:".URL."Login");
}
?>
