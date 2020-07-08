<?php
session_start();
if($_SESSION['TypeUser']==""){
	echo "<br><br><center><font size=\"4\" color=\"red\" > กรุณาลงชื่อเข้าใช้ </font> <br><a href=\"index.php\"> คลิ๊กที่นี่ </a> </center>";
	exit;
}
else if($_SESSION['TypeUser']!="student"){
	echo "<br><br><center><font size=\"4\" color=\"red\" > คุณไม่มีสิทธิ์ใช้งานหน้านี้ </font> <br><a href=\"logout.php\"> ออกจากระบบ </a> </center>";
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
		<font  size="5"><span class="glyphicon glyphicon-user" style="color:#2980b9"></span> ประวัติส่วนตัว</font> <br><hr>
		<table border="0" width="100%">
			<tr>
				<td style="vertical-align:top;" width="40%"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font  size="3"> ชื่อ-นามสกุล :  </font><font color="#009900" size="4">  <?php echo $_SESSION['name']."<br>"; ?> </font>
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font  size="3"> รหัสนักเรียน :  </font><font  size="3">  <?php echo $_SESSION['ID']."<br>"; ?> </font>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font  size="3"> วัน-เดือน-ปี เกิด   :  </font><font  size="3">  <?php echo $_SESSION['dob']."<br>"; ?> </font>
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font  size="3"> ห้องเรียน   :  ม.</font><font  size="3">  <?php echo $_SESSION['class']."<br>"; ?> </font>
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font  size="3"> คะแนนพฤติกรรม :  <b> <font color="#000000" size="3"> <?php
		      if($_SESSION['score'] < 50) {
		        ?><font color="red"> <?php
		        echo $_SESSION['score'];  ?> </font></b> คะแนน</font> <br><?php
		      }
		      else{
		        ?><font color="#009900"> <?php
		        echo $_SESSION['score'];  ?> </font></b> คะแนน</font> <br><?php
		      } ?>
				</td>
				<td width="35%"></td>
			<!--<td align="right" width="20%"><img width="140px" src="images/tor.jpg"></td> -->
				<td width="10%"></td>
			</tr>
		</table>
    <br><br><br><br>


    <font  size="5"><span class="glyphicon glyphicon-edit" style="color:#2980b9"></span> ประวัติคะแนนพฤติกรรม</font> <br><hr><br>
    <center>
      <table width="90%" border="0">
        <tr>
          <td>
                <table border="1" bordercolor="#EEE9E9" class="table table-striped">
                    <tr>
                        <td width="20%"><center>วันที่-เวลา</center></td>
                        <td width="70%"><center>รายละเอียด</center></td>
                        <td width="10%"><center>คะแนน</center></td>
                    </tr>
                    <?php
                      include "dbcon.php";
                      $ids = $_SESSION['ID'];
                      $sql = "SELECT * FROM tb_history JOIN tb_rule ON tb_history.r_id = tb_rule.r_id WHERE tb_history.s_id = '$ids'";
                      $query = mysqli_query($link,$sql);
                      while ($r = mysqli_fetch_array($query)) {
                        ?>
                          <tr>
                              <td><center> <?php echo $r['h_date']; ?> </center></td>
                              <td> <?php echo $r['r_name']; ?> </td>
                              <td><center> <?php
                              if($r['r_type']=="decrease"){
                                ?><font color="red"> <?php
                                 echo "-".$r['r_score'];  ?> </font> <?php
                               }
                               else{
                                 ?><font color="green"> <?php
                                  echo "+".$r['r_score'];  ?> </font> <?php
                               }

                                 ?> </center></td>
                            </tr>
                      <?php } ?>

                </table>
        </td>
      </tr>
    </table>
	</center><br><br>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
