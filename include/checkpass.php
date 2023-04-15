<?php 

  include("include/user_record.php");
 
  if(isset($_POST['confirmpass'])){
    

   
    $currentlypass = mysqli_real_escape_string($conn, $_POST['currentlypass']);


    $newpass = mysqli_real_escape_string($conn, $_POST['newpass']);
    $confirmpass = mysqli_real_escape_string($conn, $_POST['confirmpass']);


  if ($newpass !== $confirmpass) {
      $title = 'Error'; 
      $text = 'รหัสผ่านใหม่และยืนยันรหัสผ่านไม่ตรงกัน'; 
      $delay = '3000'; 
      $link = 'profilesetting.php';
      msg_error($title,$text,$delay,$link);
     
    }
    else{
      $sql = "SELECT * FROM user_profile WHERE  p_word='" . $currentlypass . "' ";
      $result = mysqli_query($conn, $sql);
      $sql = "SELECT * FROM user_profile WHERE u_name = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $user_record['u_name']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    if (!password_verify($currentlypass, $row['p_word'])) {
      $title = 'Error'; 
      $text = 'รหัสผ่านปัจจุบันไม่ถูกต้อง'; 
      $delay = '3000'; 
      $link = 'profilesetting.php';
      msg_error($title,$text,$delay,$link);
     
    }else{
      $new_hashed_password = password_hash($newpass, PASSWORD_DEFAULT);
      $sql = "UPDATE user_profile SET p_word = ? WHERE u_name = ?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "ss", $new_hashed_password, $user_record['u_name']);
      $result = mysqli_stmt_execute($stmt);
      if ($result){
        $title = 'Success'; 
        $text = 'เปลี่ยนรหัสผ่านสำเร็จ'; 
        $delay = '3000'; 
        $link = 'profilesetting.php';
        msg_success($title,$text,$delay,$link);
      } else {
        $title = 'Error'; 
        $text = 'Error changing password. Please try again later.'; 
        $delay = '3000'; 
        $link = 'profilesetting.php';
        msg_error($title,$text,$delay,$link);
      }
    }
    }
    }
    
?>
