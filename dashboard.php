<?php
include("include/user_record.php");

include('include/connect.php');

$mytopicuser = $user_record['u_name'];
$mytopicSQL = "SELECT * FROM allcourse WHERE twhowrite = '" . $mytopicuser . "' ORDER BY tvote DESC";
$mytopic_query = mysqli_query($conn, $mytopicSQL);
$mytopic_record = mysqli_fetch_array($mytopic_query);


?>
</head>

<body>
  <header id="header-wrap">
    <?php
    if ($user_record['level'] == 7) {
      include('include/nav_admin.php');
      $rank = "ADMIN";
    } elseif ($user_record['level'] == 6) {
      include('include/nav_member.php');
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
                <h2 class="dashbord-title" style="color:whitesmoke;">Dashboard</h2>
              </div>
              <div class="dashboard-wrapper">
                <div class="dashboard-sections">
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <div class="dashboardbox">
                        <div class="icon"><i class="lni-write" style="background-color:rgba(15,15,15,0.9);"></i></div>
                        <div class="contentbox">
                          <h2><a href="">Total Posted</a></h2>
                          <h3><?php echo $user_record['created']; ?> POSTED</h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <div class="dashboardbox">
                        <div class="icon"><i class="lni-add-files" style="background-color:rgba(15,15,15,0.9);"></i></div>
                        <div class="contentbox">
                          <h2><a href="">FOLLOW</a></h2>
                          <h3><?php echo $user_record['follow']; ?> FOLLOW</h3>
                        </div>
                      </div>
                    </div>

                    <table class="table table-responsive dashboardtable tablemyads">
                      <thead>
                        <tr>
                          <th style="text-align:center;">TOPIC</th>
                          <th style="text-align:center;">CATEGORY</th>
                          <th style="text-align:center;">VOTED</th>
                          <th style="text-align:center;">STATUS</th>
                        </tr>
                      </thead>
                      <?php if ($mytopic_record == 0) { ?>
                        <td style="text-align:center;">EMPTY</td>
                        <td style="text-align:center;">EMPTY</td>
                        <td style="text-align:center;">EMPTY</td>
                        <td style="text-align:center;">EMPTY</td>
                        <?php
                      } else {
                        do { ?>
                          <tbody>

                            <td style="text-align:center;"><?= $mytopic_record['ttopic']; ?></td>
                            <td style="text-align:center;">
                              <?php
                              if ($mytopic_record['tcate'] == 1) {
                                echo "JOB";
                              } elseif ($mytopic_record['tcate'] == 2) {
                                echo "TRAVEL";
                              } elseif ($mytopic_record['tcate'] == 3) {
                                echo "EDUCATION";
                              } elseif ($mytopic_record['tcate'] == 9) {
                                echo "ANNOUNCE";
                              }
                              ?>
                            </td>
                            <td style="text-align:center;"><?= $mytopic_record['tvote']; ?></td>
                            <td style="text-align:center;">
                              <?php
                              if ($mytopic_record['tcansee'] == 1) {
                                echo "SUCCESSED";
                              } elseif ($mytopic_record['tcansee'] == 0) {
                                echo "DELETED";
                              } elseif ($mytopic_record['tcansee'] == 2) {
                                echo "FAILED";
                              } else {
                                echo "EMPTY";
                              } ?></td>
                        <?php } while ($mytopic_record = mysqli_fetch_array($mytopic_query));
                      } ?>
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