<?php include('include/connect.php'); ?>
<?php include('include/checklogin.php'); ?>
<?php include('include/link.php'); ?>

<?php include('include/script.php'); ?>
<?php include('include/refresh_page.php'); ?>
<!DOCTYPE html>
<html lang="en">

<div class="limiter">
    <div class="container-login100">
        <div class="card">
            <div class="wrap-login100 p-t-8 p-b-8">

                <form class="login100-form validate-form" ACTION="reset_password.php" name="loginform" method="POST">

                    <p class="login50-form-title p-b-20 text-center" style="color:black;">
                        “Forgot your password? Please enter your username or email address. You will receive a link to create a new password via email.”
                    </p>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter email: example01@gmail.com">
                        <input class="input100" type="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" name="mail" id="form3Example3" class="form-control" placeholder="Email" required />
                        <span class="focus-input100"></span>
                    </div>
                    <div class="container-login100-form-btn" style="background-color:transparent;">

                        <div class="g-recaptcha validate-form"" data-sitekey=" 6LcqqGEkAAAAAAh3hBXC8L6tekBy6eAyJ4gadC9Q">
                        </div>
                        <br>
                        <div>
                            <br>
                            <button class="button-85" class="button-85" role="button" type="submit" name="submitreset" style="background-color:transparent;">
                                <span style="font-family: Oswald-Medium;color: #43383e; font-size: 16px;">
                                submitreset
                                </span>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>


</body>

</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$reset_token){
    require('PHPMailer/PHPMailer.php');
    require('PHPMailer/SMTP.php');
    require('PHPMailer/Exception.php');
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();                                         
        $mail->Host       = 'smtp.gmail.com';                   
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'basedseo.online@gmail.com';                   
        $mail->Password   = 'songmrvpfdsbllve';                               
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
        $mail->Port       = 587;                                  
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('basedseo.online@gmail.com', 'BasedSEO');
        $mail->addAddress($email);    
        $mail->SMTPSecure = "tls";
        
        $mail->isHTML(true);    
                 
        $mail->Subject = 'Important: Reset Your BasedSEO Password Now';
        $mail->Body = "Dear BasedSEO User,<br>

        You are receiving this email because you recently requested to reset your BasedSEO password. To ensure the security of your account, please follow the instructions below to complete the password reset process.<br>
        
        Click the button below to reset your password:<br><br>
        
        [Reset Password Button]<br><br>
        <a href='http://localhost/BasedseoPHP4/updatepassword.php?reset_token=" . $reset_token . "'>Reset Password</a><br>
        If you did not request a password reset, please disregard this email and contact us immediately at [contact email or phone number].
        <br>
        <br>
        <br>
        Thank you for using BasedSEO!
        <br>
       
        The BasedSEO Team";

        if($mail->send()){
            return true;
        }else{
            return false;
        }
    } 
    catch (Exception $e) {
        return false;
    }
}

if(isset($_POST['submitreset'])) {
    $email = mysqli_real_escape_string($conn, $_POST['mail']);
    $_SESSION['email'] = $email;
    $sql = "SELECT * FROM user_profile WHERE e_mail =  '".$email."' ";
    $result = mysqli_query($conn, $sql);
    if ($result){
        if (mysqli_num_rows($result)==1){
            $reset_token=bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/Bangkok');
            $date=date("Y-m-d");
            $_SESSION['data'] =  $date;
            $query = "UPDATE `user_profile` SET `resettoken` = '$reset_token', `resettokenexpire` = '$date' WHERE `e_mail` = '$email'";
            if(mysqli_query($conn, $query) && sendMail($_POST['mail'],$reset_token)){
                $title = 'Success';
                $text = 'กรุณาตรวจสอบอีเมลของคุณ';
                $delay = '3000';
                $link = 'reset_password.php';
                msg_success($title,$text,$delay,$link);
            } else {
                $title = 'error';
                $text = 'There was an error while resetting your password. Please try again later.';
                $delay = '3000';
                $link = 'reset_password.php';
                msg_error($title,$text,$delay,$link);
            }
        } else {
            $title = 'error';
            $text = 'The email you entered does not exist in our database.';
            $delay = '3000';
            $link = 'reset_password.php';
            msg_error($title,$text,$delay,$link);
        }
    } else {
        echo "Database error: " . mysqli_error($conn);
    }
}
?>
