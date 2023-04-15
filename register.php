<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $code = rand(10000, 99999);
  include('include/connect.php');
   include('include/checklogin.php'); 
  include('include/link.php');
  include('include/nav1.php');
  include('include/refresh_page.php');
  ?>
  
</head>

<body>
  
<div class="limiter">
  <div class="container-login100">
    <div class="card">
      <div class="wrap-login100 p-t-1 p-b-30">

        <form class="login100-form validate-form" ACTION="register.php" name="regisform" method="POST">

          <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username: example01">
            <input class="input100" type="text" name="username" minlength="4" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" placeholder="Username" required />
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input m-b-20" data-validate="Please enter password">
            <span class="btn-show-pass">
              <i class="fa fa fa-eye"></i>
            </span>
            <input class="input100" type="password" name="pass" minlength="4" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" placeholder="Password" required />
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input m-b-20" data-validate="Please Confirm password">
            <span class="btn-show-pass">
              <i class="fa fa fa-eye"></i>
            </span>
            <input class="input100" type="password" name="cpass" minlength="4" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" placeholder="Confirm Password" required />
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter email: example01@gmail.com">
            <input class="input100" type="email" name="mail" id="form3Example3" class="form-control" placeholder="Email" required />
            <span class="focus-input100"></span>
          </div>

          <div class="container" style="width:100%;">

            <input type="hidden" name="answer" value="<?= $code; ?>" />

          </div>

          <div class="container-login100-form-btn" style="background-color:transparent;">


            <div class="g-recaptcha validate-form" data-sitekey="6LcqqGEkAAAAAAh3hBXC8L6tekBy6eAyJ4gadC9Q">
            </div>
            <div>
              <br>
              <button class="button-85" type="submit" name="submitregister" value="click" style="background-color:transparent;">
                <span style="font-family: Oswald-Medium;color: #43383e; font-size: 16px;">REGISTER</span> </button>
            </div>



          </div>

          <div class="flex-col-c p-t-35" style="background-color:transparent;">
            <a href="login.php" class="fonts-thai bo1 hov1" style="color:back;">
              มีบัญชีแล้ว? เข้าสู่ระบบ
            </a>
          </div>


        </form>
      </div>


    </div>
  </div>
</div>



<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/animsition/js/animsition.min.js"></script>
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="js/main.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>




<?php
$secret = "6LcqqGEkAAAAANMl9jvV_-hG1KemAP6I69GzOUct";
if (isset($_POST['g-recaptcha-response'])) {
  $captcha = $_POST['g-recaptcha-response'];
  $verifyResponse = file_get_contents('https://google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);
  $responseData = json_decode($verifyResponse);
}
if (isset($_POST['submitregister'])) {
  if (empty($_POST['username'])) {
    $title = 'เว้น Username ว่างไม่ได้!';
    $text = 'กรุณากรอก Username!';
    $delay = '3000';
    $link = 'register.php';
    msg_error($title, $text, $delay, $link);
  }
  if (empty($_POST['pass'])) {
    $title = 'เว้น Password ว่างไม่ได้!';
    $text = 'กรุณากรอก Password!';
    $delay = '3000';
    $link = 'register.php';
    msg_error($title, $text, $delay, $link);
  }
  if (empty($_POST['mail'])) {
    $title = 'เว้น E-mail ว่างไม่ได้!';
    $text = 'กรุณากรอก E-mail!';
    $delay = '3000';
    $link = 'register.php';
    msg_error($title, $text, $delay, $link);
  }
  
  $name = $_POST['username'];
  $nickname = $name;
  $pass = $_POST['pass'];
  $cpass = $_POST['cpass'];
  $e_mail = $_POST['mail'];

  if ($responseData->success && $_POST['answer']) {

    if ($pass != $cpass) {
      $title = 'ยืนยันรหัสผ่าน ไม่ตรงกัน!';
      $text = 'กรุณากรอก Password และ Confirm-Password ให้ตรงกัน!';
      $delay = '3000';
      $link = 'register.php';
      msg_error($title, $text, $delay, $link);
    } else {

      $check = "SELECT * FROM user_profile WHERE u_name = '$name'";
      $result = mysqli_query($conn, $check);
      $num = mysqli_num_rows($result);
      if ($num > 0) {
        $title = 'Username นี้มีผู้ใช้แล้ว!';
        $text = 'กรุณาใช้ Username อื่น!';
        $delay = '3000';
        $link = 'register.php';
        msg_error($title, $text, $delay, $link);
      } else {

        $check = "SELECT * FROM user_profile WHERE e_mail = '$e_mail'";
        $result = mysqli_query($conn, $check);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
          $title = 'E-mail นี้มีผู้ใช้แล้ว!';
          $text = 'กรุณาใช้ E-mail อื่น!';
          $delay = '3000';
          $link = 'register.php';
          msg_error($title, $text, $delay, $link);
        } else {
          
          $U_SID = base64_encode(md5(base64_encode(md5($name, rand()))));
          $cypass = password_hash($pass, PASSWORD_DEFAULT);

          $sql = "INSERT INTO user_profile (u_name, u_nickname, p_word, e_mail, U_SID, level)
        VALUES ('$name', '$nickname', '$cypass', '$e_mail', '$U_SID', '6')";
          $query = mysqli_query($conn, $sql);

   

          $title = 'สมัครสมาชิกสำเร็จ';
          $text = 'กำลังเชื่อมต่อข้อมูล...';
          $delay = '1000';
          $link = 'login.php';
          msg_success($title, $text, $delay, $link);
        }
      }
    }
  } else {
    $title = 'reCAPTCHA ไม่ถูกต้อง';
    $text = 'กรุณากรอก reCAPTCHA ให้ถูกต้อง!';
    $delay = '1000';
    $link = 'register.php';
    msg_error($title, $text, $delay, $link);
  }
}


?>