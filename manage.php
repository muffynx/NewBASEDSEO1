<?php
include("include/user_record.php");
include('include/head.php');
include('include/connect.php');
include("include/admin_record.php");
$alluserSQL = "SELECT * FROM user_profile";
$alluserSQL_query = mysqli_query($conn, $alluserSQL);
$alluserSQL_record = mysqli_fetch_array($alluserSQL_query);

$webSQL = "SELECT * FROM web_setting";
$webSQL_query = mysqli_query($conn, $webSQL);
$webSQL_record = mysqli_fetch_array($webSQL_query);
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

        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="page-content">
            <div class="inner-box">
              <div class="dashboard-box" style="background-color:rgba(15,15,15,0.9); color:whitesmoke;">
                <h2 class="dashbord-title" style="color:whitesmoke;">MANAGE WEBSITE</h2>
              </div>
              <div class="dashboard-wrapper">
                <div class="dashboard-sections">
                  <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <ul class="nav nav-tabs text-center">
                        <li class="active"><a data-toggle="tab" href="#addannounce">ADD ANNOUNCE</a></li>
                        <li><a data-toggle="tab" href="#user">MANAGE USER</a></li>
                        <li><a data-toggle="tab" href="#banner">MANAGE BANNER</a></li>
                      </ul>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="tab-content" style="margin-top:20px;">
                        <div id="addannounce" class="tab-pane fade in active">
                          <div class="col-sm-12 col-md-12 col-lg-12">
                            <form action="manage.php" method="POST">
                              <h1 style="margin-top:20px;"> IMAGE LINK </h1><br>
                              <input class="input100" style="background-color:rgba(15,15,15,0.9); color:whitesmoke; margin-top:1px;" type="text" name="image">
                              <h1 style="margin-top:20px;"> TOPIC </h1><br>
                              <input class="input100" style="background-color:rgba(15,15,15,0.9); color:whitesmoke; margin-top:1px;" type="text" name="topic">
                              <h1 style="margin-top:20px;"> CONTENT </h1><br>
                              <input class="input100" style="background-color:rgba(15,15,15,0.9); color:whitesmoke; margin-top:1px;" type="text" name="content">
                              <button class="btn btn-common" type="addannounce" name="addannounce" style="background-color:GREEN; width:100%; margin-top:10px; border-radius:20px;">ADD ANNOUNCE</button>
                            </form>
                          </div>
                        </div>
                        <div id="user" class="tab-pane fade">
                          <h3>MANAGE USER</h3>
                          <table class="table table-responsive dashboardtable tablemyads">
                            <thead>
                              <tr>
                                <th style="text-align:center;">ID</th>
                                <th style="text-align:center;">RANK</th>
                                <th style="text-align:center;">USERNAME</th>
                                <th style="text-align:center;">NICKNAME</th>
                                <th style="text-align:center;">EMAIL</th>
                                <th style="text-align:center;">U_SID</th>
                                <th style="text-align:center;">POINT</th>
                                <th style="text-align:center;">FOLLOW</th>
                                <th style="text-align:center;">POST</th>
                                <th style="text-align:center;">ACTION</th>
                              </tr>
                            </thead>
                            <?php if ($alluserSQL_record == 0) { ?>
                              <td style="text-align:center;">EMPTY</td>
                              <td style="text-align:center;">EMPTY</td>
                              <td style="text-align:center;">EMPTY</td>
                              <td style="text-align:center;">EMPTY</td>
                              <td style="text-align:center;">EMPTY</td>
                              <td style="text-align:center;">EMPTY</td>
                              <td style="text-align:center;">EMPTY</td>
                              <td style="text-align:center;">EMPTY</td>
                              <td style="text-align:center;">EMPTY</td>
                              <td style="text-align:center;">EMPTY</td>
                              <?php
                            } else {
                              do { ?>
                                <tbody class="text-center">

                                  <td style="text-align:center;"><?= $alluserSQL_record['id']; ?></td>
                                  <td style="text-align:center;">
                                    <?php
                                    if ($alluserSQL_record['level'] == 7) {
                                      echo "ADMIN";
                                    } elseif ($alluserSQL_record['level'] == 1) {
                                      echo "MEMBER";
                                    }
                                    ?>
                                    <?= $alluserSQL_record['level']; ?>
                                  </td>
                                  <td style="text-align:center;"><?= $alluserSQL_record['u_name']; ?></td>
                                  <td style="text-align:center;"><?= $alluserSQL_record['u_nickname']; ?></td>
                                  <td style="text-align:center;"><?= $alluserSQL_record['e_mail']; ?></td>
                                  <td style="text-align:center;"><?= $alluserSQL_record['U_SID']; ?></td>
                                  <td style="text-align:center;"><?= $alluserSQL_record['point']; ?></td>
                                  <td style="text-align:center;"><?= $alluserSQL_record['follow']; ?></td>
                                  <td style="text-align:center;"><?= $alluserSQL_record['created']; ?></td>
                                  <td>
                                    <form action="manage.php" method="POST">
                                      <button class="btn btn-common" type="deleteuser" name="deleteuser" value="<?= $alluserSQL_record['id']; ?> " style="background-color:red;">DELETE</button>
                                      </from>
                                  </td>
                              <?php } while ($alluserSQL_record = mysqli_fetch_array($alluserSQL_query));
                            } ?>
                                </tbody>
                          </table>
                        </div>
                        <div id="banner" class="tab-pane fade">
                          <div class="col-sm-12 col-md-12 col-lg-12">
                            <h3>MANAGE BANNER</h3>
                            <form action="manage.php" method="POST">
                              <h1 style="margin-top:20px;"> NOW BANNER </h1><br>
                              <input class="input100" style="background-color:rgba(15,15,15,0.9); color:whitesmoke;" type="text" name="banner" placeholder="<?= $webSQL_record['dashboardads']; ?>">
                              <button class="btn btn-common" type="changebanner" name="changebanner" style="background-color:GREEN; width:100%; margin-top:10px; border-radius:20px;">CHANGE</button>
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
      </div>
      </div>


      <footer>



      </footer>
      <div id="preloader">
        <div class="loader" id="loader-1"></div>
      </div>


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
  <?php
  if (isset($_POST['addannounce'])) {
    $image = $_POST['image'];
    $topic = $_POST['topic'];
    $who = "SYSTEM";
    $see = 1;
    $cate = 9;
    $content = $_POST['content'];

    $addanounceSQL = "INSERT INTO `allcourse`(`ttopic`, `tcontent`, `twhowrite`, `twhonickname`, `tcansee`, `timg`, `tcate`) VALUES ('" . $topic . "' , '" . $content . "' , '" . $who . "', '" . $who . "' , '" . $see . "' , '" . $image . "' , '" . $cate . "')";
    $addanounceSQL_query = mysqli_query($conn, $addanounceSQL);

    $title = 'สร้าง ANNOUNCE เรียบร้อยแล้ว';
    $text = 'กำลังเชื่อมต่อข้อมูล...';
    $delay = '3000';
    $link = 'manage.php';
    msg_success($title, $text, $delay, $link);
  }
  ?>

  <?php
  if (isset($_POST['deleteuser'])) {
    $userid = $_POST['deleteuser'];

    $deleteIDSQL = "DELETE FROM `user_profile` WHERE `id` = $userid";
    $deleteIDSQL_query = mysqli_query($conn, $deleteIDSQL);

    $title = 'ลบสำเร็จ';
    $text = 'กำลังเชื่อมต่อข้อมูล...';
    $delay = '3000';
    $link = 'manage.php';
    msg_success($title, $text, $delay, $link);
  }
  ?>

  <?php
  if (isset($_POST['changebanner'])) {
    $bannerlink = $_POST['banner'];
    $bannerid = 1;

    $changeSQL = "UPDATE `web_setting` SET `dashboardads` = '" . $bannerlink . "' WHERE id = $bannerid";
    $changeSQL_query = mysqli_query($conn, $changeSQL);

    $title = 'แก้ไข banner เรียบร้อยแล้ว';
    $text = 'กำลังเชื่อมต่อข้อมูล...';
    $delay = '3000';
    $link = 'manage.php';
    msg_success($title, $text, $delay, $link);
  }
  ?>