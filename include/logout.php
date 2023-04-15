<?php
if(isset($_POST['submit'])){
    session_destroy();
    $usernick = $user_record['u_name'];
    $message = $usernick." ได้ออกจาก BasedSEO ";
    $title = 'ออกจากระบบสำเร็จ'; $text = $message; $delay = '2000'; $link = '/basedseo/index.php';
    msg_success($title,$text,$delay,$link);
}
?>