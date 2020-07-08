<?php
session_start();
if($_SESSION['TypeUser']==""){
	echo "<br><br><center><font size=\"4\" color=\"red\" > กรุณาลงชื่อเข้าใช้ </font> <br><a href=\"index.php\"> คลิ๊กที่นี่ </a> </center>";
	exit;
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
      @import url('https://fonts.googleapis.com/css?family=Prompt');
        * {
        font-family: 'Prompt', sans-serif;
      }
    </style>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body><br><br>
    <font  size="5"><span class="glyphicon glyphicon-list-alt" style="color:#2980b9"></span> กฎระเบียบและเกณฑ์การตัดคะแนน</font>
    <br><hr><br>
    <center>
    <table width="80%" border="0">
      <tr>
        <td>
              <table border="1" bordercolor="#EEE9E9" class="table table-striped">
                  <tr>
                      <td width="85%"><center>กฎระเบียบ</center></td>
                      <td width="15%"><center>คะแนนที่หัก</center></td>
                  </tr>
                  <?php
                    include "dbcon.php";
                    $sql = "SELECT * FROM tb_rule";
                    $query = mysqli_query($link,$sql);
                    while ($r = mysqli_fetch_array($query)) {
                        if($r['r_type']=="decrease"){
                  ?>
                    <tr>
                        <td><left> <?php echo $r['r_detail']; ?></left></td>
                        <td><b><font color="red"><center> <?php echo $r['r_score'];  ?></center></font> </b></font></td>
                    </tr>
                  <?php }
                }?>
              </table>
        </td>
    </table>
  </center>

    <br><br>

    <font  size="5"><span class="glyphicon glyphicon-ok-sign" style="color:#2980b9"></span> กิจกรรมเสริมเพิ่มคะแนน</font>
    <br><hr><br>
    <center>
    <table width="80%" border="0">
      <tr>
        <td>
              <table border="1" bordercolor="#EEE9E9" class="table table-striped">
                  <tr>
                      <td width="85%"><center>ชื่อกิจกรรม</center></td>
                      <td width="15%"><center>คะแนนที่เพิ่ม</center></td>
                  </tr>
                  <?php
                    include "dbcon.php";
                    $sql = "SELECT * FROM tb_rule";
                    $query = mysqli_query($link,$sql);
                    while ($r = mysqli_fetch_array($query)) {
                        if($r['r_type']=="increase"){
                  ?>
                    <tr>
                        <td><left> <?php echo $r['r_detail']; ?></left></td>
                        <td><b><font color="green"><center> <?php echo $r['r_score'];  ?></center> </font></b></td>
                    </tr>
                  <?php }
                }?>
              </table>
        </td>
    </table>
  </center>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
