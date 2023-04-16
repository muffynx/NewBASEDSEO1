<?php
   $course_html = $user_record['Course_HTML'];
   $_SESSION['Course_HTML'] = $user_record['Course_HTML'];
   

  if(!isset($_SESSION['token_html'])){
    $_SESSION['token_html'] = gentoken_html();
    $query = "SELECT * FROM sql_course_html WHERE token = '{$_SESSION['token_html']}'";
    $result = mysqli_query($conn,$query);

    if (mysqli_num_rows($result)> 0 ){
      unset($_SESSION['token_html']);
    }
  }
$token_html = $_SESSION['token_html'];



   if ($course_html == 0) {
    // Delete row from sql_course_python table
    $sql = "DELETE FROM sql_course_html WHERE tcansee='2' AND u_name='{$_SESSION['u_name']}' AND e_mail='{$_SESSION['e_mail']}' AND token='{$_SESSION['token_html']}'";
    
    if ($conn->query($sql) === TRUE) {
      $_SESSION['message'] = "Record deleted successfully";
    } else {
      $_SESSION['message'] = "Error deleting record";
    }
  } else {
    // Check if user already registered for the course
    $sql = "SELECT * FROM sql_course_html WHERE u_name='{$_SESSION['u_name']}' AND e_mail='{$_SESSION['e_mail']}' AND tcansee='2' AND token='{$_SESSION['token_html']}'";
    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
      // User already registered, update existing record
      $sql = "UPDATE sql_course_html SET u_name='{$_SESSION['u_name']}', tcansee='2' WHERE e_mail='{$_SESSION['e_mail']}' AND token='{$_SESSION['token_html']}'";

    
      if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Email updated successfully";
      } else {
        $_SESSION['message'] = "Email error successfully";
      }
    } else {
      // User not registered, insert new record
      $sql = "INSERT INTO sql_course_html (u_name, e_mail, tcansee, token) VALUES ('{$_SESSION['u_name']}', '{$_SESSION['e_mail']}', '2', '{$_SESSION['token_html']}')";
    
      if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Record inserted successfully";
      } else {
        $_SESSION['message'] = "Error inserting record";
      }
    }
  }
  ?>