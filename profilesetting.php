<?php


include('include/link.php');
include('include/connect.php');
include('include/checkpass.php');


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
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="dashboardbox">
												<h1>USERNAME </h1>
												<h4>: <?php echo $user_record['u_name']; ?></h4>
												<h1>NICKNAME </h1>
												<h4>: <?php echo $user_record['u_nickname']; ?></h4>
												<h1>EMAIL </h1>
												<h4>: <?php echo $user_record['e_mail']; ?></h4>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="dashboard-box" style="background-color:rgba(15,15,15,0.9); color:whitesmoke;">
							<h2 class="dashbord-title" style="color:whitesmoke;">CHANGE Pass</h2>
						</div>
						<div class="dashboard-wrapper">
							<div class="dashboard-sections">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="dashboardbox">
											<form class="" ACTION="profilesetting.php" name="pass" method="POST">
												<div class="wrap-input100 validate-input m-b-16">
													<input class="input100" style="background-color:rgba(15,15,15,0.9); color:whitesmoke;" type="password" name="currentlypass" minlength="4" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" placeholder="รหัสผ่านปัจจุบัน" required />
													<span class="focus-input100"></span>
												</div>
												<div class="wrap-input100 validate-input m-b-20" data-validate="Please Confirm password">
													<span class="btn-show-pass">
														<i class="fa fa fa-eye"></i>
													</span>
													<input class="input100" style="background-color:rgba(15,15,15,0.9); color:whitesmoke;" type="password" name="newpass" minlength="4" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" placeholder="new Password" required />
													<span class="focus-input100"></span>
												</div>
												<div class="wrap-input100 validate-input m-b-20" data-validate="Please Confirm password">
													<span class="btn-show-pass">
														<i class="fa fa fa-eye"></i>
													</span>
													<input class="input100" style="background-color:rgba(15,15,15,0.9); color:whitesmoke;" type="password" name="confirmpass" minlength="4" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" placeholder="conforim Password" required />
													<span class="focus-input100"></span>
												</div>
												
												<div class="container-login100-form-btn" style="background-color:transparent;">
													<button class="login100-form-btn" type="submit" name="submitpass" style="background-color:transparent;">
														SAVE
													</button>
												</div>



											



											</form>
										</div>
									</div>
								</div>
							</div>
						</div>



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