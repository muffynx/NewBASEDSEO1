

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="BasedSEO.online">
  <meta name="keywords" content="ราคาถูกกว่าเมื่อเทียบกับค่ายอื่นๆ
    บริการของเราถูกมากกว่าเว็บไซต์ต่างๆ
    เมื่อเทียบกันแล้ว ต่างกัน 5-6 เท่า">
  <meta name="description" content="SEO Boot CTR, Bounce Rate
    SEO สำหรับคนไทย ราคาไม่แพงเริ่มต้น 400 บาท เพิ่มอันดับ CTR ของคุณโดยใช้อัตราการคลิกของเรา!.">
  <title>บริการ SEO สำหรับคนไทย BasedSEO</title>
  
  <?php include("include/hinderrorandconnect.php");?>
  <?php include('include/link.php'); ?>
  <?php include('include/connect.php'); ?>
  <?php include('include/script.php'); ?>
  <?php include('include/search.php'); ?>
  <?php include('include/refresh_page.php');?>
<?php

if (isset($_SESSION['u_name'])) {
  if ($user_record['level'] == 7) {
    include('include/nav_admin.php');
  } elseif ($user_record['level'] == 6) {
    include('include/nav1.php');
  }
}else{
  include('include/navsimple.php');
  
}


?>

</head>
<body>

  <?php include('include/cover.php'); ?>
  
  <?php include('include/showpage.php'); ?>
  
  <?php include('include/resultseo.php'); ?>
 
  <?php include('include/price-table.php'); ?>
  <?php include('include/card1.php'); ?>
  <?php include('include/section.php'); ?>
  <?php include('include/footer.php'); ?>




  
</body>


</html>