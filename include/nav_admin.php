<form action="?logout" method="POST">
<nav class="navbar navbar-inverse navbar-fixed-top" stlye="margin:0px; padding:0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="main.php"><img style="width:40px;" src="assets/img/ic.png"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">

        <ul class="nav navbar-nav navbar-right">
        <li><a href="../main.php" style="color:whitesmoke;">HOME</a></li>
        <li><a href="../alltopic.php" style="color:whitesmoke;">ALL TOPIC</a></li>
        <li><a href="../mytopic.php" style="color:whitesmoke;">MY TOPIC</a></li>
        <li><a href="../manage.php" style="color:whitesmoke;">MANAGE WEBSITE</a></li>
        <li><a href="../dashboard.php" style="color:whitesmoke;">DASHBOARD</a></li>
        
        <li><a href="#" style="color:whitesmoke;">ADMIN : <?php echo $user_record['u_name']; ?></a></li>
        
      <button type="submit" name="submit" value="logout" style="width:5%; margin:15px; justify-items: center; color:red;"> LOGOUT</button>
      </ul>
    </div>
  </div>
</nav>
</form>