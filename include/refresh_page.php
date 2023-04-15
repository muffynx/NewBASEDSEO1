<?php
    ini_set('display_errors', 0); 

 $refresh_page = $user_record['refresh_page'];
 $_SESSION['Refresh_page'] = $user_record['refresh_page'];
 if ($refresh_page == 1) {

    $title = 'System Notification';
    $text = 'The system needs to refresh.';
    $delay = '2000';
    $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    msg_success($title, $text, $delay, $link);
    $_SESSION['message1'] = "7";
    $sql = "UPDATE user_profile SET refresh_page = 2 WHERE refresh_page = '{$_SESSION['Refresh_page']}'";
    if ($conn->query($sql) === TRUE) {
      $_SESSION['message1'] = "8";
    } else {
      $_SESSION['message1'] = "9";
    }
  }
  ?>