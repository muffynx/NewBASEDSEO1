<?php
    ini_set('display_errors', 0); 
     include("../include/user_recordforblog.php");
    $na = $user_record['u_name'];
    $mySQL = "SELECT * FROM allcourse WHERE tcansee = 1 ORDER BY tvote DESC LIMIT 3";
    $my_query = mysqli_query($conn,$mySQL);
    $my_record = mysqli_fetch_array($my_query);
    $totalmy_record = mysqli_num_rows($my_query);
    $strSQLweb = "SELECT * FROM allcourse WHERE tcansee = 1";
    $web_query = mysqli_query($conn,$strSQLweb);
    $web_record = mysqli_fetch_array($web_query);
    
?>