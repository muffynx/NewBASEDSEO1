<form action="?logout" method="POST">
  <?php

  ?>
  <div class="navbar-fixed-top navbar-inverse" style="margin:0px; padding:0px; background-color: #fff;">

    <div class="container-fluid">

      <div class="navbar-header">

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>

        </button>
      </div>
      <div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-left">
            <li><a class="navbar-brand fonts-thai" style="color: black;" href="/newbasedseo/index.php">BasedSEO</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-left">
            <li><a href="/newbasedseo/index.php" class="fonts-thai" style="color: black;"><span class="glyphicon glyphicon-home"></span> หน้าแรก</a></li>
            <li><a href="/newbasedseo/blog.php" class="fonts-thai-login" style="color:black;"><span class="glyphicon glyphicon-book"></span> บทความ </a></li>
            <li><a href="/newbasedseo/index.php#price-table-id" class="fonts-thai" style="color: black;"><span class="	glyphicon glyphicon-tasks"></span> การบริการ</a></li>
           
          </ul>
          <ul class="nav navbar-nav navbar-right">

            <?php
    

            if (isset($_SESSION['u_name']) && ($_SESSION['u_name'] == '7' || $_SESSION['u_name'] == '6')) {
             
              $title = 'Error';
              $text = 'โปรดเข้าสู่ระบบก่อน!...';
              $delay = '3000';
              $link = 'login.php';
              msg_error($title, $text, $delay, $link);
              exit();
            } else if (isset($_SESSION['u_name'])) {
             
              $name = $_SESSION['u_name'];
              $strSQL = "SELECT * FROM user_profile WHERE u_name = '" . $name . "'";
              $user_query = mysqli_query($conn, $strSQL);
              $user_record = mysqli_fetch_assoc($user_query);
            ?>
            
              <li><a href="/newbasedseo/main.php" class="fonts-thai-login" style="color:black;"><span class="glyphicon glyphicon-user"></span> Dashboard </a></li>
              <li><a href="#" class="fonts-thai-login">USER : <?php echo $user_record['u_name']; ?></a></li>
              
              <li><a><button type="submit" name="submit" value="logout" style="width:5%;margin: 1px;justify-items: center;color:red;font-weight:bold;" class="fonts-thai"> <strong>LOGOUT</strong></button> </a></li>
              </form>
            <?php
            } else {
              
              
            ?>
            <li><a href="/newbasedseo/register.php" class="fonts-thai-login" style="color:black;"><span class="glyphicon glyphicon-user"></span> สมัครสมาชิก </a></li>
            <li><a href="/newbasedseo/login.php" class="fonts-thai-login" style="color:black;"><span class="glyphicon glyphicon-log-in"></span> เข้าสู่ระบบ </a></li>
            <?php
           
            }?>
            

          </ul>
        </div>
      </div>

    </div>
  </div>