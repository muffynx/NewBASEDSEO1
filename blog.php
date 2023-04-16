<?php include('include/connect.php'); ?>
<?php include('include/link.php'); ?>

<?php include("include/hinderrorandconnect.php");?>
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
   
        
       

        <?php
        $mySQL = "SELECT *  FROM blog WHERE tcansee = 1 ";
        $my_query = mysqli_query($conn, $mySQL);
        $my_record = mysqli_fetch_array($my_query);

        
        $totalmy_record = mysqli_num_rows($my_query);

        $strSQLweb = "SELECT *  FROM blog WHERE tcansee = 1";
        $web_query = mysqli_query($conn, $strSQLweb);
        $web_record = mysqli_fetch_array($web_query);

        ?>
 



    <section class="featured section-padding">
        <div class="container">
            <h1 class="section-title">TOP 3 TOPIC</h1>
            <div class="row">

                <?php if ($totalmy_record == 0) { ?>
                    <h1 style="text-align:center; color:black;">EMPTY</h1>
                    <?php
                } else {
                    do {
                    ?>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                            <div class="featured-box" style="width:100%;">
                                <figure>
                                <form class="login100-form validate-form" action="readblog.php" name="readblog" method="POST">
    <input type="hidden" name="readblog" value="<?= $my_record['id']; ?>">
    <a href="<?php  echo 'blog/'. $my_record['nameblog'] . '.php'; ?>">
        <img class="img-fluid" style="width:100%; background-size:cover; max-width:1920px; max-height:1080px;" src="<?= $my_record['timg']; ?>" alt="">
    </a>
</form>


                                </figure>
                                <div class="feature-content" style="width:100%;">
                                <h4 class="fonts-thai"><?php echo implode(' ', array_slice(explode(' ', $my_record['ttopic']), 0, 5)) ; ?></h4>

                                    
                                

                                    <div class="listing-bottom">
                                        <p style="color:red;">Category :
                                            <?php
                                            if ($my_record['tcate'] == 1) {
                                                echo "JOB";
                                            } elseif ($my_record['tcate'] == 2) {
                                                echo "TRAVEL";
                                            } elseif ($my_record['tcate'] == 3) {
                                                echo "EDUCATION";
                                            } elseif ($my_record['tcate'] == 9) {
                                                echo "ANNOUNCE";
                                            }
                                            ?>
                                        </p>
                                        <p style="color:red;">Date : <?= $my_record['tdate']; ?></p>
                                        <p style="color:red;">Created by : <?= $my_record['twhonickname']; ?></p>
                                        
                                        <form class="login100-form validate-form" action="<?php  echo 'blog/'. $my_record['nameblog'] . '.php'; ?>" method="POST">
    
    <button class="btn btn-common" type="submit" name="read_blog" style="width: 100%; margin: 1px; background-color: #4f8d3a;">Read</button>
</form>

                                    </div>
                                </div>
                            </div>
                        </div>
                <?php } while ($my_record = mysqli_fetch_array($my_query));
                } ?>


            </div>
        </div>
    </section>




    <div id="preloader">
    <div class="loader" id="loader-1"></div>
  </div>
  <script src="assets/js/reload.js"></script>









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