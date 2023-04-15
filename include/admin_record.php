<?php
    include('connect.php');
  
    $checkSQL = "SELECT * FROM user_profile WHERE u_name =  '".$name."' ";
    $checkSQL_query = mysqli_query($conn,$checkSQL);
    $checkSQL_record = mysqli_fetch_array($checkSQL_query);

    if ($checkSQL_record['level'] == 7){
        $SHEEEEEEESH = "WELCOME";
    }else{
        $title = 'คุณไม่ใช่แอดมิน'; $text = 'กำลังพาท่านไป...'; $delay = '3000'; $link = 'main.php';
        msg_error($title,$text,$delay,$link);
    }
    include('logout.php');
?>