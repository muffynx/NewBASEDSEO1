<?php

$course_php = $user_record['Course_PHP'];
$_SESSION['Course_PHP'] = $user_record['Course_PHP'];


if (!isset($_SESSION['token_php'])){
  $_SESSION['token_php'] = gentoken_php();

  $query = "SELECT * FROM sql_course_python WHERE token = '{$_SESSION['token_php']}'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result)> 0){
    unset($_SESSION['token_php']);
    exit();
  }
}
$token = $_SESSION['token_php'];



   
   if ($course_php == 0) {
    // Delete row from sql_course_python table
    $sql = "DELETE FROM sql_course_php WHERE tcansee='3' AND u_name='{$_SESSION['u_name']}' AND e_mail='{$_SESSION['e_mail']}' AND token='{$_SESSION['token_php']}'";
    
    if ($conn->query($sql) === TRUE) {
      $_SESSION['message'] = "Record deleted successfully";
    } else {
      $_SESSION['message'] = "Error deleting record";
    }
  } else {
    // Check if user already registered for the course
    $sql = "SELECT * FROM sql_course_php WHERE u_name='{$_SESSION['u_name']}' AND e_mail='{$_SESSION['e_mail']}' AND tcansee='3' AND token='{$_SESSION['token_php']}'";
    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
      // User already registered, update existing record
      $sql = "UPDATE sql_course_php SET u_name='{$_SESSION['u_name']}', tcansee='3' WHERE e_mail='{$_SESSION['e_mail']}' AND token='{$_SESSION['token_php']}'";
    
      if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Email updated successfully";
      } else {
        $_SESSION['message'] = "Email error successfully";
      }
    } else {
      // User not registered, insert new record
      $sql = "INSERT INTO sql_course_php (u_name, e_mail, tcansee, token) VALUES ('{$_SESSION['u_name']}', '{$_SESSION['e_mail']}', '3', '{$_SESSION['token_php']}')";
    
      if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Record inserted successfully";
      } else {
        $_SESSION['message'] = "Error inserting record";
      }
    }
  }
  ?>