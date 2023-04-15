<?php


include('include/link.php');
include('include/connect.php');
include('include/checkpass.php');
if (isset($_GET['token']) && $_SESSION['token'] === $_GET['token']) {
    $u_name = $_SESSION['u_name'];
    $e_mail = $_SESSION['e_mail'];
    $token = $_SESSION['token'];
    $sql = "SELECT * FROM sql_course_python WHERE u_name=? AND e_mail=? AND token=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $u_name, $e_mail, $token);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        include './view/view.html';
    } else {
        $text = 'No data found for the given user credentials';
        $title = 'Error';
        $delay = '3000';
        msg_error($title, $text, $delay);
    }
} else {
    $text = 'Invalid or missing token';
    $title = 'Error';
    $delay = '3000';
    msg_error($title, $text, $delay);
}


?>
</head>

<body>
	<header id="header-wrap">
		<?php
		if ($user_record['level'] == 7) {
			include('include/nav_admin.php');
			$rank = "ADMIN";
		} elseif ($user_record['level'] == 6) {
			include('include/nav1.php');
			$rank = "MEMBER";
		}
		?>
	</header>

	<body>

		<header id="header-wrap">


			<div id="content" class="section-padding">
				<?php include('include/asideprofile.php'); ?>

				<div class="col-sm-12 col-md-8 col-lg-9">
					<div class="page-content">
						<div class="inner-box">
							<div class="dashboard-box" style="background-color:rgba(15,15,15,0.9); color:whitesmoke;">
								<h2 class="dashbord-title" style="color:whitesmoke;">PROFILE SETTINGS</h2>
							</div>
							<div class="dashboard-wrapper">
								<div class="dashboard-sections">
									<div class="row">

									</div>
								</div>
							</div>
						</div>

		
						<div class="dashboard-wrapper">
	
                        <?php

if (isset($_GET['token']) && $_SESSION['token'] === $_GET['token']) {
    $u_name = $_SESSION['u_name'];
    $e_mail = $_SESSION['e_mail'];
    $token = $_SESSION['token'];
    $sql = "SELECT * FROM sql_course_python WHERE u_name=? AND e_mail=? AND token=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $u_name, $e_mail, $token);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        include './view/view.html';
    } else {
        $text = 'No data found for the given user credentials';
        $title = 'Error';
        $delay = '3000';
        msg_error($title, $text, $delay);
    }
} else {
    $text = 'Invalid or missing token';
    $title = 'Error';
    $delay = '3000';
    msg_error($title, $text, $delay);
}


?>


					</div>
				</div>
			</div>


			</div>



			</div>




			<footer>



			</footer>
			


			<script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
			<script src="assets/js/jquery-min.js"></script>
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