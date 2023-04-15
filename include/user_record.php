<?php

include('connect.php');
session_start();
if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > 18000) {
  $title = 'Error';
  $text = 'หมดเวลาเชื่อมต่อกรุณา login ใหม่!...';
  $delay = '2000';
  $link = 'login.php';
  msg_error($title,$text,$delay,$link);
  session_destroy();
  exit;
}
if (isset($_SESSION['u_name']) && $_SESSION['u_name'] != '7' && $_SESSION['u_name'] != '6') {
  // Allow access to authorized users only
} else if (basename($_SERVER['PHP_SELF']) != 'index.php' && basename($_SERVER['PHP_SELF']) != 'login.php' && basename($_SERVER['PHP_SELF']) != 'register.php' && basename($_SERVER['PHP_SELF']) != 'updatepassword.php' && basename($_SERVER['PHP_SELF']) != 'blog.php' && basename($_SERVER['PHP_SELF']) != 'readblog.php') {
 $title = 'Error';
 $text = 'โปรดเข้าสู่ระบบก่อน!...';
 $delay = '3000';
 $link = 'login.php';
 msg_error($title,$text,$delay,$link);
 exit();
}


$name = $_SESSION['u_name'];

$strSQL = "SELECT * FROM user_profile WHERE u_name =  '".$name."' ";
$user_query = mysqli_query($conn,$strSQL);
$user_record = mysqli_fetch_array($user_query);







  
 
// }
// else {
//   // Handle error here
// }

include('logout.php');
?>