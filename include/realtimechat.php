<?php 
 include('user_record.php');
 include('head.php');
 include('connect.php');
  
 
    $allmessageSQL = "SELECT * FROM worldmessage ORDER BY id DESC";
    $allmessage_query = mysqli_query($conn,$allmessageSQL);
    $allmessage_record = mysqli_fetch_array($allmessage_query);
   
?>
<div class = "col-sm-12" style="display:block; text-align:left; width:100%; word-wrap:break-word;">
<?php 
      $sql = "SELECT * FROM worldmessage ORDER BY id DESC LIMIT 20";
      $query = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_array($query)){
        $msg = $row['msgtext'];
        $who = $row['whosend'];

        $selectimg = "SELECT * FROM user_profile WHERE u_nickname = '".$who."' ";
        $selectimg_query = mysqli_query($conn,$selectimg);
        $selectimg_record = mysqli_fetch_array($selectimg_query);
           
?>

<img style="width:25px; height:25px;" src="<?php if(empty($selectimg_record['user_img'])){echo 'assets/img/TIMG/user.png';}else{echo $selectimg_record['user_img'];}?>">
<?php echo $who. ' :'; ?><br>
<?php echo $msg; ?><br><hr>
<?php } ?>
</div>