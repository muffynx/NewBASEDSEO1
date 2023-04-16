<?php



$course_python = $user_record['Course_PYTHON'];
$_SESSION['Course_PYTHON'] = $user_record['Course_PYTHON'];


// $my_query_course = mysqli_query($conn, $sql);
// $my_record1 = mysqli_fetch_array($my_query_course);
// $totalmy_record = mysqli_num_rows($my_query);

// $strSQLweb = "SELECT *  FROM token_course WHERE tcansee = 1";
// $web_query = mysqli_query($conn, $strSQLweb);
// $web_record = mysqli_fetch_array($web_query);



if (!isset($_SESSION['token_python'])) {
  $_SESSION['token_python'] = gentoken_python();

  $query = "SELECT * FROM sql_course_python WHERE token = '{$_SESSION['token_python']}'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    unset($_SESSION['token_python']);

  }
}
$token_python = $_SESSION['token_python'];

if ($course_python == 0) {
  // Delete row from sql_course_python table
  $sql = "DELETE FROM sql_course_python WHERE tcansee='4' AND u_name='{$_SESSION['u_name']}' AND e_mail='{$_SESSION['e_mail']}' AND token='{$_SESSION['token_python']}'";
  $sqll = " DELETE FROM token_course WHERE tcansee = '4' AND token= '{$_SESSION['token_python']}'AND e_mail='{$_SESSION['e_mail']}'";
  
  if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "Record deleted successfully";
    unset($_SESSION['token_python']); // destroy the token
  } else {
    $_SESSION['message'] = "Error deleting record";
  }
} else {
  // Check if user already registered for the course
  $sqll = "SELECT * FROM token_course WHERE tcansee = '4' AND token= '{$_SESSION['token_python']}' AND e_mail='{$_SESSION['e_mail']}'";
  $sql = "SELECT * FROM sql_course_python WHERE u_name='{$_SESSION['u_name']}' AND e_mail='{$_SESSION['e_mail']}' AND tcansee='4' AND token='{$_SESSION['token_python']}'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $sql = "UPDATE sql_course_python SET u_name='{$_SESSION['u_name']}', tcansee='4' WHERE e_mail='{$_SESSION['e_mail']}' AND token='{$_SESSION['token_python']}'";
    $sqll = "UPDATE token_course SET tcansee = '4', token= '{$_SESSION['token_python']}'WHERE e_mail='{$_SESSION['e_mail']}'";
    
  
    if ($conn->query($sql) === TRUE) {
      $_SESSION['message'] = "tcansee updated successfully";
      
    } else {
      $_SESSION['message'] = "tcansee error successfully";
      
    }
  } else {
    // User not registered, insert new record
    $sql = "INSERT INTO sql_course_python (u_name, e_mail, tcansee, token) VALUES ('{$_SESSION['u_name']}', '{$_SESSION['e_mail']}', '4', '{$_SESSION['token_python']}')";
    $sqll = "INSERT INTO token_course (tcansee, token, e_mail) VALUES ('4', '{$_SESSION['token_python']}' ,'{$_SESSION['e_mail']}')";
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
