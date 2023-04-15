<?php include('include/connect.php'); ?>
<?php include('include/checklogin.php'); ?>
<?php include('include/link.php'); ?>
<?php include('include/navsimple.php'); ?>
<?php include('include/refresh_page.php');?>

<!DOCTYPE html>
<html lang="en">

<div class="limiter">
	<div class="container-login100">
		<div class="card">
			<div class="wrap-login100 p-t-8 p-b-8">

				<form class="login100-form validate-form" ACTION="login.php" name="loginform" method="POST">
					<span class="login100-form-title p-b-25" style="color:black;">
						BasedSEO
					</span>
					<p class="login50-form-title p-b-20 text-center" style="color:black;">
						“BasedSEO is the best solution for your business”
					</p>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
						<input class="input100" type="text" name="user" minlength="4" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" placeholder="Username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-20" data-validate="Please enter password">
						<span class="btn-show-pass">
							<i class="fa fa fa-eye"></i>
						</span>
						<input class="input100" type="password" minlength="4" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
					</div>


					<div class="container-login100-form-btn" style="background-color:transparent;">

						<div class="g-recaptcha validate-form"" data-sitekey=" 6LcqqGEkAAAAAAh3hBXC8L6tekBy6eAyJ4gadC9Q">
						</div>
						<br>
						<div>
							<br>
							<button class="button-85" class="button-85" role="button" type="submitlogin" name="submitlogin" style="background-color:transparent;">
								<span style="font-family: Oswald-Medium;color: #43383e; font-size: 16px;">
									Login
								</span>
							</button>
						</div>



					</div>

					<div class="flex-col-c p-t-37" style="background-color:transparent;">
						<span class="fonts-thai " style="color:black;">
							ยังไม่มีบัญชีผู้ใช้งาน?
						</span>
						<a href="register.php" class="fonts-thai bo1 hov1" style="color:black;">
							สมัครสมาชิก
						</a>
						<br>
						<a href="reset_password.php" class="fonts-thai " style="color:black;">
							ลืมรหัสหรือเปล่า คลิก!
						</a>
					</div>

				</form>
			</div>
		</div>

	</div>
</div>






<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/animsition/js/animsition.min.js"></script>
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="js/main.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</body>

</html>