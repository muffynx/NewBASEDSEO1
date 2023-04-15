<?php 
    include("include/user_record.php");
    include('include/head.php');
    include('include/connect.php');
    $mytopicuser = $user_record['u_nickname'];
    $mytopicSQL = "SELECT * FROM messagebox WHERE ownermes = '".$mytopicuser."'";
    $mytopic_query = mysqli_query($conn,$mytopicSQL);
    $mytopic_record = mysqli_fetch_array($mytopic_query);
?>
</head>
<body>
<header id="header-wrap">
<?php 
if($user_record['level'] == 7){
    include('include/nav_admin.php'); 
    $rank = "ADMIN";
}elseif($user_record['level'] == 6){
    include('include/nav_member.php'); 
    $rank = "MEMBER";
}
?>
</header>
<body>

<header id="header-wrap">


<div id="content" class="section-padding" > 
<?php include('include/asideprofile.php'); ?>

<div class="col-sm-12 col-md-8 col-lg-9">
<div class="page-content">
<div class="inner-box">
<div class="dashboard-box" style="background-color:rgba(15,15,15,0.9); color:whitesmoke;">
<h2 class="dashbord-title" style="color:whitesmoke;">Send message</h2>
</div>
<div class="dashboard-wrapper">
<div class="dashboard-sections">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="dashboardbox">
<form class="" ACTION="message.php" name="sendmessagefrom" method="POST">
					<div class="wrap-input100 validate-input m-b-16">
                        <h3> SEND TO : (ONLY NICKNAME)</h3> <br>
						<input class="input100" style = "background-color:rgba(15,15,15,0.9); color:whitesmoke;" type="text" name="nickname" placeholder="ชื่อผู้รับ">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-16">
                        <h3> TOPIC : </h3> <br>
						<input class="input100" style = "background-color:rgba(15,15,15,0.9); color:whitesmoke;" type="text" name="topic" placeholder="หัวข้อ">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-16">
                        <h3> MESSAGE : </h3> <br>
						<input class="input100" style = "background-color:rgba(15,15,15,0.9); color:whitesmoke;" type="text" name="message" placeholder="เนื้อหา">
						<span class="focus-input100"></span>
					</div>
					<div class="container-login100-form-btn" style="background-color:transparent;">
						<button class="login100-form-btn" type="send" name="send" style="background-color:transparent;">
							SEND
						</button>
					</div>

				

				</form>
</div>
</div>
</div>
</div>
</div>


<div class="dashboard-box" style="background-color:rgba(15,15,15,0.9); color:whitesmoke;">
<h2 class="dashbord-title" style="color:whitesmoke;">MESSAGES</h2>
</div>


<table class="table table-responsive dashboardtable tablemyads">
<thead>
<tr>
<th style="text-align:center;">TOPIC</th>
<th style="text-align:center;">MESSAGE</th>
<th style="text-align:center;">WHO SEND</th>
</tr>
</thead>
<?php if($mytopic_record == 0){ ?>
    <td style="text-align:center;">EMPTY</td>
    <td style="text-align:center;">EMPTY</td>
    <td style="text-align:center;">EMPTY</td>
<?php 
  }else{
   do { ?>
<tbody>

<td style="text-align:center;"><?= $mytopic_record['topic']; ?></td>
<td style="text-align:center;"><?= $mytopic_record['messagebox']; ?></td>
<td style="text-align:center;"><?= $mytopic_record['whosend']; ?></td>

<?php }while ($mytopic_record = mysqli_fetch_array($mytopic_query)); }?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<footer>



</footer>
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
  if(isset($_POST['send'])){
    $realnickname = mysqli_real_escape_string($conn,$_POST['nickname']);
    $towho = $_POST['nickname'];
    $topic = $_POST['topic'];
    $message = $_POST['message'];
    $username = $user_record['u_nickname'];
    $date = date("Y/m/d");
    $sql="INSERT INTO `messagebox`(`ownermes`, `topic`, `messagebox`, `whosend`, `date`) VALUES ('$towho','$topic','$message','$username','$date')";
    $result = mysqli_query($conn,$sql);

    $title = 'ส่งข้อความสำเร็จ'; $text = 'กำลังเชื่อมต่อข้อมูล...'.$username;  $delay = '3000';  $link = 'message.php';
    msg_success($title,$text,$delay,$link);
          

  }
?>