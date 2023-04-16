<?php
$course_css = $user_record['Course_CSS'];
$_SESSION['Course_CSS'] = $user_record['Course_CSS'];

if (!isset($_SESSION['token_css'])){
  $_SESSION['token_css'] = gentoken_css();

  $query = "SELECT * FROM sql_course_css WHERE token = '{$_SESSION['token_css']}'";
  $result = mysqli_query($conn,$query);

  if(mysqli_num_rows($result)>0){
    unset($_SESSION['token_css']);
  }

}
$token_css = $_SESSION['token_css'];
   
   if ($course_css == 0) {
 
    $sql = "DELETE FROM sql_course_css WHERE tcansee='1' AND u_name='{$_SESSION['u_name']}' AND e_mail='{$_SESSION['e_mail']}' AND token='{$_SESSION['token_css']}'";
    
    if ($conn->query($sql) === TRUE) {
      $_SESSION['message'] = "Record deleted successfully";
   
     
    } else {
      $_SESSION['message'] = "Error deleting record";
    }
  } else {
    // Check if user already registered for the course
    $sql = "SELECT * FROM sql_course_css WHERE u_name='{$_SESSION['u_name']}' AND e_mail='{$_SESSION['e_mail']}' AND tcansee='1' AND token='{$_SESSION['token_css']}'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {

      //ถ้ามี session ใน course_css will be show 
  
      
      


      $sql = "UPDATE sql_course_css SET u_name='{$_SESSION['u_name']}', tcansee='1' WHERE e_mail='{$_SESSION['e_mail']}' AND token='{$_SESSION['token_css']}'";
    
      if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Email updated successfully";
      
      
      } else {
        $_SESSION['message'] = "Email error successfully";
      }
    } else {
      // User not registered, insert new record
      $sql = "INSERT INTO sql_course_css (u_name, e_mail, tcansee, token) VALUES ('{$_SESSION['u_name']}', '{$_SESSION['e_mail']}', '1', '{$_SESSION['token_css']}')";
    
      if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Record inserted successfully";
     
     
      } else {
        $_SESSION['message'] = "Error inserting record";
      }
    }
  }
  ?>