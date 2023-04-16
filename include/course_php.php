<?php



$course_php = $user_record['Course_PHP'];
$_SESSION['Course_PHP'] = $user_record['Course_PHP'];


// $my_query_course = mysqli_query($conn, $sql);
// $my_record1 = mysqli_fetch_array($my_query_course);
// $totalmy_record = mysqli_num_rows($my_query);

// $strSQLweb = "SELECT *  FROM token_course WHERE tcansee = 1";
// $web_query = mysqli_query($conn, $strSQLweb);
// $web_record = mysqli_fetch_array($web_query);



if (!isset($_SESSION['token_php'])) {
  $_SESSION['token_php'] = gentoken_php();

  $query = "SELECT * FROM sql_course_php WHERE token = '{$_SESSION['token_php']}'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    unset($_SESSION['token_php']);

  }
}
$token_php = $_SESSION['token_php'];

if ($course_php == 0) {
 
  $sql = "DELETE FROM sql_course_php WHERE tcansee='3' AND u_name='{$_SESSION['u_name']}' AND e_mail='{$_SESSION['e_mail']}' AND token='{$_SESSION['token_php']}'";
  $sqll = " DELETE FROM token_course WHERE tcansee = '3' AND token= '{$_SESSION['token_php']}' AND e_mail='{$_SESSION['e_mail']}'";
  
  if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "Record deleted successfully";
    unset($_SESSION['token_php']); // destroy the token
  } else {
    $_SESSION['message'] = "Error deleting record";
  }
} else {
  // Check if user already registered for the course
  $sqll = "SELECT * FROM token_course WHERE tcansee = '3' AND token= '{$_SESSION['token_php']}' AND e_mail='{$_SESSION['e_mail']}'";
  $sql = "SELECT * FROM sql_course_php WHERE u_name='{$_SESSION['u_name']}' AND e_mail='{$_SESSION['e_mail']}' AND tcansee='3' AND token='{$_SESSION['token_php']}'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $sql = "UPDATE sql_course_php SET u_name='{$_SESSION['u_name']}', tcansee='3' WHERE e_mail='{$_SESSION['e_mail']}' AND token='{$_SESSION['token_php']}'";
    $sqll = "UPDATE token_course SET tcansee = '3', token= '{$_SESSION['token_php']}'WHERE e_mail='{$_SESSION['e_mail']}'";
    
  
    if ($conn->query($sql) === TRUE) {
      $_SESSION['message'] = "tcansee updated successfully";
      
    } else {
      $_SESSION['message'] = "tcansee error successfully";
      
    }
  } else {
    // User not registered, insert new record
    $sql = "INSERT INTO sql_course_php (u_name, e_mail, tcansee, token) VALUES ('{$_SESSION['u_name']}', '{$_SESSION['e_mail']}', '3', '{$_SESSION['token_php']}')";
    $sqll = "INSERT INTO token_course (tcansee, token,e_mail) VALUES ('3', '{$_SESSION['token_php']}' ,'{$_SESSION['e_mail']}' )";
    if($conn->query($sqll)===TRUE){
 
    }
    else{

    }
    if ($conn->query($sql) === TRUE) {
      $_SESSION['message'] = "Record inserted successfully";
    } else {
      $_SESSION['message'] = "Error inserting record";
    }
  }
}

?>
