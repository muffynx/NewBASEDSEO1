<?php
$course_css = $user_record['Course_CSS'];
$_SESSION['Course_CSS'] = $user_record['Course_CSS'];



   
   if ($course_css == 0) {
    // Delete row from sql_course_css table
    $sql = "DELETE FROM sql_course_css WHERE tcansee='1' AND u_name='{$_SESSION['u_name']}' AND e_mail='{$_SESSION['e_mail']}'";
    
    if ($conn->query($sql) === TRUE) {
      $_SESSION['message'] = "Record deleted successfully";
   
     
    } else {
      $_SESSION['message'] = "Error deleting record";
    }
  } else {
    // Check if user already registered for the course
    $sql = "SELECT * FROM sql_course_css WHERE u_name='{$_SESSION['u_name']}' AND e_mail='{$_SESSION['e_mail']}' and tcansee='1'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {

      //ถ้ามี session ใน course_css will be show 
  
      
      


      $sql = "UPDATE sql_course_css SET u_name='{$_SESSION['u_name']}', tcansee='1' WHERE e_mail='{$_SESSION['e_mail']}'";
    
      if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Email updated successfully";
      
      
      } else {
        $_SESSION['message'] = "Email error successfully";
      }
    } else {
      // User not registered, insert new record
      $sql = "INSERT INTO sql_course_css (u_name, e_mail, tcansee) VALUES ('{$_SESSION['u_name']}', '{$_SESSION['e_mail']}', '1')";
    
      if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Record inserted successfully";
     
     
      } else {
        $_SESSION['message'] = "Error inserting record";
      }
    }
  }
  ?>