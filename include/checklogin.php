<?php
session_start();
$secret = "6LcqqGEkAAAAANMl9jvV_-hG1KemAP6I69GzOUct";
if (isset($_POST['g-recaptcha-response'])) {
  $captcha = $_POST['g-recaptcha-response'];
  $verifyResponse = file_get_contents('https://google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captcha);
  $responseData = json_decode($verifyResponse);
}

if (!isset($_SESSION['u_name'])){
	if (isset($_POST['user']))  {
    if ($responseData->success && $_POST['user']){
      include("connect.php");
      $realuser = mysqli_real_escape_string($conn, $_POST['user']);
      $realpass = mysqli_real_escape_string($conn, $_POST['pass']);
      $username = $realuser;
     // $password = password_hash($realpass, PASSWORD_DEFAULT);
    
      $sql = "SELECT * FROM user_profile WHERE  u_name='" . $username . "' ";
  
     
      $result = mysqli_query($conn, $sql);
    
      if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        if (password_verify($realpass, $row['p_word'])) {
          if ($row["u_status"] == 9) { //ถ้า u_tatus ถึง 9 
            $title = 'ผู้ใช้นี้ถูกแบน!';
            $text = 'กรุณาติดต่อแอดมิน...';
            $delay = '3000';
            $link = 'login.php';
            msg_error($title, $text, $delay, $link);
          } elseif ($row["level"] <= 7) {
    
            $cynpass = 1;
            $sql2 = "UPDATE user_profile SET u_status = '" . $cynpass . "' WHERE u_name = '" . $username . "'";
            $query = mysqli_query($conn, $sql2);
    
            $_SESSION["id"] = $row["id"];
            $_SESSION["u_name"] = $row["u_name"];
            $_SESSION["U_SID"] = $row["U_SID"];
    
            $userawd = $_SESSION['u_name'];
            $_SESSION['last_activity'] = time();
        
            $title = 'เข้าสู่ระบบสำเร็จ';
            $text = 'ยินดีต้อนรับคุณ ' . $username;
            $delay = '1000';
            $link = 'main.php';
            msg_success($title, $text, $delay, $link);
          }
        
        } else {
    
          $title = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
          $text = 'กรุณาลองใหม่อีกครั้ง...';
          $delay = '1000';
          $link = 'login.php';
          msg_error($title, $text, $delay, $link);
        }
      } else {
        $title = 'ข้อมูลของท่านไม่มีในระบบ';
        $text = 'กรุณาสมัครสมาชิก...';
        $delay = '5000';
        $link = 'login.php';
        msg_error($title, $text, $delay, $link);
      }
  
    }
    else {
      $title = 'reCAPTCHA ไม่ถูกต้อง';
      $text = 'กรุณาใส่ reCAPTCHA ให้ถูกต้อง!';
      $delay = '1000';
      $link = 'login.php';
      msg_error($title, $text, $delay, $link);
    }
  }
}else{
    $title = 'Error';
		$text = 'คุณอยู่ในระบบแล้ว!...';
		$delay = '3000';
		$link = 'main.php';
		
		msg_error($title, $text, $delay, $link);
    exit();
} 


