<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="BasedSEO.online">
  <meta name="keywords" content="ราคาถูกกว่าเมื่อเทียบกับค่ายอื่นๆ
    บริการของเราถูกมากกว่าเว็บไซต์ต่างๆ
    เมื่อเทียบกันแล้ว ต่างกัน 5-6 เท่า">
  <meta name="description" content="SEO Boot CTR, Bounce Rate
    SEO สำหรับคนไทย ราคาไม่แพงเริ่มต้น 400 บาท เพิ่มอันดับ CTR ของคุณโดยใช้อัตราการคลิกของเรา!.">
  <title>บริการ SEO สำหรับคนไทย BasedSEO</title>

  <?php include('include/link.php'); ?>
  <?php session_start(); ?>
  <?php include('include/script.php'); ?>
  <?php include('include/connect.php'); ?>
  <?php include('include/refresh_page.php'); ?>


</head>

<body>

  <div class="limiter">
    <div class="container-login100">
      <div class="card">
        <div class="wrap-login100 p-t-8 p-b-8">

          <form class="login100-form validate-form" action="<?php echo $link; ?>" name="updatepass" method="POST">

            <span class="login100-form-title p-b-25" style="color:black;">
              BasedSEO
            </span>
            <p class="login50-form-title p-b-20 text-center" style="color:black;">
              “BasedSEO is the best solution for your business”
            </p>



            <div class="wrap-input100 validate-input m-b-20" data-validate="Please enter password">
              <span class="btn-show-pass">
                <i class="fa fa fa-eye"></i>
              </span>
              <input class="input100" type="password" minlength="4" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" name="ornew1" placeholder="Password" required />
              <span class="focus-input100"></span>
            </div>




            <div class="wrap-input100 validate-input m-b-20" data-validate="Please Confirm password">
              <span class="btn-show-pass">
                <i class="fa fa fa-eye"></i>
              </span>
              <input class="input100" type="password" name="ornew2" minlength="4" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" placeholder="conforim Password" required />
              <span class="focus-input100"></span>
            </div>





            <div class="container-login100-form-btn" style="background-color:transparent;">

              <div class="g-recaptcha validate-form"" data-sitekey=" 6LcqqGEkAAAAAAh3hBXC8L6tekBy6eAyJ4gadC9Q">
              </div>
              <br>




              <div>
                <br>
                <button class="button-85" class="button-85" role="button" type="submit" name="updatepassword" style="background-color:transparent;">
                  <span style="font-family: Oswald-Medium;color: #43383e; font-size: 16px;">
                    reset
                  </span>
                </button>
              </div>



            </div>


          </form>
        </div>
      </div>

    </div>
  </div>




  <?php
  $current_time = time();
  $link_sent_time = $_SESSION['reset_link_sent_time'];
  $time_elapsed = $current_time - $link_sent_time;
  include("include/user_record.php");
  if (isset($_GET['reset_token'])) {
    $_SESSION['reset_token'] = $_GET['reset_token'];

    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d");

    $query = "SELECT * FROM `user_profile` WHERE `resettoken` = ? AND `resettokenexpire` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $_GET['reset_token'], $date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);


    if ($result && mysqli_num_rows($result) == 1) {

      if ($time_elapsed < 50000) {
        $stmt = $conn->prepare("UPDATE user_profile SET resettoken = NULL, resettokenexpire = NULL WHERE resettoken = ? AND resettokenexpire = ?");
        $stmt->bind_param("ss", $_SESSION['reset_token'], $_SESSION['data']);
        $result = $stmt->execute();
        session_destroy();
      } else {

        if (isset($_POST['ornew2'])) {


          $newpassword = mysqli_real_escape_string($conn, $_POST['ornew1']);
          $checkpass = mysqli_real_escape_string($conn, $_POST['ornew2']);



          if ($newpassword !== $checkpass) {
     
              $title = 'Error';
              $text = 'รหัสผ่านไม่ตรงกัน';
              $delay = '3000';
              $link = 'updatepassword.php?reset_token=' . $_GET['reset_token'];
              msg_success($title, $text, $delay, $link);
            
             


          } else {
            $new_hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);
            $sql = "UPDATE user_profile SET p_word = ? WHERE e_mail = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $new_hashed_password,  $_SESSION['email']);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {

              $stmt = $conn->prepare("UPDATE user_profile SET resettoken = NULL, resettokenexpire = NULL WHERE resettoken = ? AND resettokenexpire = ?");
              $stmt->bind_param("ss", $_SESSION['reset_token'], $_SESSION['data']);
              $result = $stmt->execute();
              if($result){
                $title = 'Success';
                $text = 'รีเซ็ตรหัสผ่านเสร็จสิ้น';
                $delay = '3000';
                $link = 'login.php';
                msg_success($title, $text, $delay, $link);
                sleep(5);
                session_destroy();
              }

              
                // $stmt = $conn->prepare("DELETE FROM user_profile WHERE resettoken = ? AND resettokenexpire = ? LIMIT 1");
                // $stmt->bind_param("ss", $_SESSION['reset_token'], $_SESSION['reset_tokenexpire']);
                // $result = $stmt->execute();
                
              
              // $stmt = $conn->prepare("DELETE FROM user_profile WHERE resettoken = ? AND resettokenexpire = ? LIMIT 1");
              // $stmt->bind_param("ss", $_SESSION['reset_token'], $_SESSION['reset_tokenexpire']);
              // $result = $stmt->execute();


              //   if ($result) {
              //     $title = 'Success';
              //     $text = 'Success delete resettoken and resettokenexpire';
              //     $delay = '3000';
              //     $link = 'login.php';
              //     msg_success($title, $text, $delay, $link);
              //     session_destroy();
              //   } else {
              //     $title = 'Error';
              //     $text = 'Error delete resettoken and resettokenexpire';
              //     $delay = '3000';
              //     $link = 'login.php';
              //     msg_error($title, $text, $delay, $link);
              //   }



              // } else {
              //   $title = 'error';
              //   $text = 'error';
              //   $delay = '3000';
              //   $link = 'updatepassword.php?reset_token=' . $_GET['reset_token'];
              //   msg_error($title, $text, $delay, $link);
            }
          }
        }
      }





      // Check if new password and confirm password match
      // if ($newpassword !== $checkpass) {
      //     $title = 'Error'; 
      //     $text = 'รหัสผ่านใหม่และยืนยันรหัสผ่านไม่ตรงกัน'; 
      //     $delay = '3000'; 
      //     $link = 'profilesetting.php';
      //     msg_error($title,$text,$delay,$link);

      //   }
      //   else{
      //     $new_hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);
      //     $sql = "UPDATE user_profile SET p_word = ? WHERE e_mail = ?";
      //     $stmt = mysqli_prepare($conn, $sql);
      //     mysqli_stmt_bind_param($stmt, "ss", $new_hashed_password, $user_record['e_mail']);
      //     $result = mysqli_stmt_execute($stmt);
      //     if ($result){
      //       $title = 'Success'; 
      //       $text = 'เปลี่ยนรหัสผ่านสำเร็จ'; 
      //       $delay = '3000'; 
      //       $link = 'profilesetting.php';
      //       msg_success($title,$text,$delay,$link);
      //     } else {
      //       $title = 'Error'; 
      //       $text = 'Error changing password. Please try again later.'; 
      //       $delay = '3000'; 
      //       $link = 'profilesetting.php';
      //       msg_error($title,$text,$delay,$link);
      //     }


      //   }



      // }


    } else {
      $title = 'Error';
      $text = 'Token สำหรับการเปลี่ยนรหัสผ่านหมดอายุ.';
      $delay = '3000';
      $link = 'reset_password.php';
      msg_error($title, $text, $delay, $link);
    }
  }

  ?>





</body>


</html>