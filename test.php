$_SESSION['u_name'] = $user_record['u_name'];
  $_SESSION['e_mail'] = $user_record['e_mail'];


  $_SESSION['name'] = $_SESSION["u_name"];

  // Check if the user has access to all courses
  $sql_check_all = "SELECT * FROM sql_course_python WHERE u_name = '" . $_SESSION['name'] . "'
                    UNION SELECT * FROM sql_course_php WHERE u_name = '" . $_SESSION['name'] . "'
                    UNION SELECT * FROM sql_course_html WHERE u_name = '" . $_SESSION['name'] . "'
                    UNION SELECT * FROM sql_course_css WHERE u_name = '" . $_SESSION['name'] . "'";
  $result_all = $conn->query($sql_check_all);

  if ($result_all->num_rows >= 4) {
    $mySQL = "SELECT * FROM allcourse WHERE tcansee IN (1,2,3,4)";
  } else {
    // Check which courses the user has access to
    $tcansee_array = array();
    $sql_check_python = "SELECT * FROM sql_course_python WHERE u_name = '" . $_SESSION['name'] . "'";
    $result_python = $conn->query($sql_check_python);
    if ($result_python->num_rows > 0) {
      $tcansee_array[] = 4;
    }
    $sql_check_php = "SELECT * FROM sql_course_php WHERE u_name = '" . $_SESSION['name'] . "'";
    $result_php = $conn->query($sql_check_php);
    if ($result_php->num_rows > 0) {
      $tcansee_array[] = 3;
    }
    $sql_check_html = "SELECT * FROM sql_course_html WHERE u_name = '" . $_SESSION['name'] . "'";
    $result_html = $conn->query($sql_check_html);
    if ($result_html->num_rows > 0) {
      $tcansee_array[] = 2;
    }
    $sql_check_css = "SELECT * FROM sql_course_css WHERE u_name = '" . $_SESSION['name'] . "'";
    $result_css = $conn->query($sql_check_css);
    if ($result_css->num_rows > 0) {
      $tcansee_array[] = 1;
    }
    // Build the query
    if (!empty($tcansee_array)) {
      $tcansee_string = implode(',', $tcansee_array);
      $mySQL = "SELECT * FROM allcourse WHERE tcansee IN ($tcansee_string)";
    } else {
      // User doesn't have access to any course
      $mySQL = "SELECT * FROM allcourse WHERE 1 = 0";
    }
  }

  $my_query = mysqli_query($conn, $mySQL);
  $my_record = mysqli_fetch_array($my_query);
  $totalmy_record = mysqli_num_rows($my_query);
  $sql_course = "SELECT * FROM token_course WHERE tcansee IN (1,2,3,4,5)";
  $my_query_course = mysqli_query($conn, $sql_course);
  $my_record_course = mysqli_fetch_array($my_query_course);
  ?>


  <section class="featured section-padding">
    <div class="container">
      <h1 class="section-title">WELCOME</h1>
      <div class="row">
        <?php
        if ($totalmy_record == 0) {
          // display message when no records are found
        ?>
          <h1 style="text-align:center; color:black;">You haven't registered with our course, please contact the Admin to do it for you.</h1>
          <?php
        } else {
          // display records when at least one is found
          while ($my_record = mysqli_fetch_array($my_query)) {


            do {
          ?>
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                <div class="featured-box" style="width:100%;">
                  <figure>
                    <a href="#"><img class="img-fluid" style="width:100%;" src="<?= $my_record['timg']; ?>" alt=""></a>
                  </figure>
                  <div class="feature-content" style="width:100%;">
                    <h4 style="color:red;"><?php echo substr($my_record['ttopic'], 0, 16) . '...'; ?></h4>
                    <p class="dsc"><?php echo substr($my_record['tcontent'], 0, 16) . '...'; ?></p>
                    <div class="listing-bottom">
                      <p style="color:red;">Category :
                        <?php
                        if ($my_record['tcate'] == 1) {
                          echo "lab1";
                        } elseif ($my_record['tcate'] == 2) {
                          echo "lab2";
                        } elseif ($my_record['tcate'] == 3) {
                          echo "lab3";
                        } elseif ($my_record['tcate'] == 4) {
                          echo "lab4";
                        }
                        ?>
                      </p>
                      <p> <?= $tcansee_list; ?></p>
                      <p><?= 'jeoo'; ?></p>
                      <p> <?= $_SESSION['e_mail']; ?></p>
                      <p> <?= $_SESSION['message'] ?></p>
                      <p> <?= $_SESSION['message1'] ?></p>
                      <p style="color:red;">Date : <?= $my_record['tdate']; ?></p>
                      <p style="color:red;">End : <?= $my_record['tdate']; ?></p>

                      <p style="color:red;">Created by : <?= $my_record['twhonickname']; ?></p>
                      <p style="color:red;">Created by : <?= $my_record['link']; ?></p>


                      <form class="login100-form validate-form" action="view.php?token=<?= $my_record_course['token'] ?>" name="readform" method="POST">
                        <input type="hidden" name="token" value="<?= $my_record['id']; ?>">
                        <button class="btn btn-common" type="readpost" name="readpost" value="<?= $my_record_course['id']; ?>" style="width: 100%; margin:1px; background-color:red;">ดูความคืบหน้า</button>
                      </form>





                    </div>
                  </div>
                </div>
              </div>
        <?php
            } while ($my_record_course = mysqli_fetch_array($my_query_course));
          }
        }
        ?>
      </div>
    </div>
  </section>