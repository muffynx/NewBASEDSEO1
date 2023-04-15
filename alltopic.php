<?php 
    include("include/user_record.php");
    include('include/head.php');

    $na = $user_record['u_name'];
    $mySQL = "SELECT *  FROM allcourse WHERE tcansee = 1 ORDER BY tvote DESC";
    $my_query = mysqli_query($conn,$mySQL);
    $my_record = mysqli_fetch_array($my_query);
    $totalmy_record = mysqli_num_rows($my_query);


    $strSQLweb = "SELECT *  FROM allcourse WHERE tcansee = 1 ORDER BY tdate DESC";
    $web_query = mysqli_query($conn,$strSQLweb);
    $web_record = mysqli_fetch_array($web_query);
?>
</head>
<body>
<header id="header-wrap">
<?php 
if($user_record['level'] == 7){
    include('include/nav_admin.php'); 
}elseif($user_record['level'] == 6){
    include('include/nav_member.php'); 
}else{
    include('include/nav.php'); 
}
?>
</header>

<section class="featured section-padding">
<div class="container">
<h1 class="section-title">ALL TOPIC</h1>
<div class="row">

<?php if($totalmy_record == 0){ ?>
    <h1 style="text-align:center; color:black;">EMPTY</h1>
<?php 
  }else{
      do { 
?>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
<div class="featured-box" style="width:100%;">
<figure>
<a href="#"><img class="img-fluid" style = "width:100%;" src="<?= $web_record['timg']; ?>" alt=""></a>
</figure>
<div class="feature-content" style="width:100%;">
<h4 style="color:red;"><?php echo substr($web_record['ttopic'], 0, 16).'...';?></h4>
<p class="dsc"><?php echo substr($web_record['tcontent'], 0, 16).'...';?></p>
<div class="listing-bottom">
<p  style="color:red;">Category : 
<?php 
if ($web_record['tcate'] == 1){
  echo "JOB";
}elseif ($web_record['tcate'] == 2){
  echo "TRAVEL";
}elseif ($web_record['tcate'] == 3){
  echo "EDUCATION";
}elseif ($my_record['tcate'] == 9){
  echo "ANNOUNCE";
}
?>
</p>
<p  style="color:red;">Date : <?= $web_record['tdate']; ?></p>
<p  style="color:red;">Created by : <?= $web_record['twhonickname']; ?></p>
<p  style="color:red;">Voted : <?= $web_record['tvote']; ?></p>
<form class="login100-form validate-form" ACTION="readpost.php" name="readform" method="POST">
<button class="btn btn-common" type="readpost" name="readpost" value = "<?= $web_record['id']; ?>"style="width: 100%; margin:1px; background-color:red;">Read</button>
</form>
<?php 
 $voteid = $web_record['id'];
 $user = $user_record['u_name'];
 $selectfromusersql = "SELECT * FROM user_voted WHERE idvote = '".$voteid."' AND user = '".$user."'";
 $selectfromuser_query = mysqli_query($conn,$selectfromusersql);
 $selectfromuser_record = mysqli_fetch_array($selectfromuser_query);
 if ($selectfromuser_record['status'] == 1){ ?>
   <button class="btn btn-common" style="width: 100%; margin:1px; background-color:black;">Voted</button>
 <?php }else{ ?>
 <form class="login100-form validate-form" ACTION="alltopic.php" name="voteform" method="POST">
  <button class="btn btn-common" type="voted" name="voted" value = "<?= $web_record['id']; ?>" style="width: 100%; margin:1px; background-color:red;">Vote</button>
  </form>
 <?php } ?>
  


</div>
</div>
</div>
</div>
<?php }while ($web_record = mysqli_fetch_array($web_query));} ?>


</div>
</div>
</section>





<br><br><br><br><br><br><br><br><?php include('include/footer.php');?>


<div id="preloader">
<div class="loader" id="loader-1"></div>
</div>


<script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/wow.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/jquery.slicknav.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/form-validator.min.js"></script>
<script src="assets/js/contact-form-script.min.js"></script>
<script src="assets/js/summernote.js"></script>
</body>


</html>

<?php 
  if(isset($_POST['voted'])){
   
    $my_id = $_POST['voted'];
    $my_user = $user_record['u_name'];
    $my_status = 1;
    $voteSQL = "INSERT INTO `user_voted`(`user`, `idvote`, `status`) VALUES ('$my_user','$my_id','$my_status')";
    $voteSQL_query = mysqli_query($conn,$voteSQL);
    $voteSQL_record = mysqli_fetch_array($voteSQL_query);


    $selectfromallSQL = "SELECT * FROM `allcourse` WHERE id = '".$my_id."'";
    $selectfromall_query = mysqli_query($conn,$selectfromallSQL);
    $selectfromall_record = mysqli_fetch_array($selectfromall_query);

    $calvote = $selectfromall_record['tvote'];
    $totalvote = $calvote + 1;

    $addvoteSQL = "UPDATE `allcourse` SET `tvote` = '".$totalvote."' WHERE id = '".$my_id."' ";
    $addvoteSQL_query = mysqli_query($conn,$addvoteSQL);
    $addvoteSQL_record = mysqli_fetch_array($addvoteSQL_query);

    $title = 'vote สำเร็จ'; $text = 'กำลังเชื่อมต่อข้อมูล...';  $delay = '3000';  $link = 'alltopic.php';
    msg_success($title,$text,$delay,$link);
  }
?>