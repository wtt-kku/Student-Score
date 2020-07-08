<?php
session_start();
$countall=0;
$countpass=0;
$countfail=0;
$class = $_SESSION['t_class'];
if($_SESSION['TypeUser']==""){
	echo "<br><br><center><font size=\"4\" color=\"red\" > กรุณาลงชื่อเข้าใช้ </font> <br><a href=\"index.php\"> คลิ๊กที่นี่ </a> </center>";
	exit;
}
else if($_SESSION['TypeUser']!="teacher"){
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
    <font  size="5"><span class="glyphicon glyphicon-list-alt" style="color:#2980b9"></span> รายชื่อนักเรียน</font> <br>
<br>
		&nbsp;&nbsp;&nbsp;&nbsp;<font size ="3">* ครูที่ปรึกษาสามาตรวจสอบประวัติพฤติกรรมนักเรียนได้โดยคลิกที่ <u>รหัสนักเรียน</u></font>
    <br><hr><br>

		<center>
			<h2>รายชื่อนักเรียนชั้นมัธยมศึกษาปีที่ <?php echo $class; ?> </h2><br>
<!--<p align="right"><button class="btn btn-primary hidden-print" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> พิมพ์รายงาน</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> -->
      <table width="90%" border="0">
        <tr>
          <td>
                <table border="1" bordercolor="#EEE9E9" class="table table-striped">
                    <tr>
                        <td width="15%"><center>รหัสนักเรียน</center></td>
                        <td width="30%"><center>ชื่อ - นามสกุล</center></td>
                        <td width="25%"><center>ระดับชั้น</center></td>
												<td width="15%"><center>คะแนนพฤติกรรม</center></td>
												<td width="15%"><center>สถานะ</center></td>
                    </tr>
                    <?php
                      include "dbcon.php";
                      $ids = $_SESSION['ID'];
                      $sql = "SELECT * FROM tb_student JOIN tb_score ON tb_student.s_id = tb_score.s_id WHERE tb_student.s_class = '".$class."'";
                      $query = mysqli_query($link,$sql);
                      while ($r = mysqli_fetch_array($query)) {
                        ?>
                          <tr>
                              <td><center><a  href="stdinfo.php?sid=<?php echo $r['s_id'];?>"> <?php echo $r['s_id']; ?> </a></center></td>
                              <td> <?php echo $r['s_name']; ?> </td>
															<td><center> ชั้นมัธยมศึกษาปีที่ <?php echo $r['s_class']; ?> </center></td>
															<td> <center><?php echo $r['s_score']; ?></center> </td>
															<td> <center><?php
																			if ($r['s_score'] >= 50){
																				$countpass = $countpass+1;
																				$countall = $countall +1;
																				?> <font color="#009900"><?php echo "ผ่าน";?></font> <?php
																			}
																			else{
																				$countfail = $countfail+1;
																				$countall = $countall +1;
																				?> <font color="red"> <?php echo "ไม่ผ่าน"; ?> </font> <?php
																			}

															 ?></center> </td>

                             </center></td>
                            </tr>
                      <?php } ?>

                </table>
							 นักเรียนทั้งหมด <b><font><?php echo $countall;?></font></b> คน  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ผ่าน <font color="#009900"><b><?php echo $countpass; ?></b></font> คน  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ไม่ผ่าน
							 <font color="red"><b><?php echo $countfail;?></b></font> คน
        </td>
      </tr>
    </table>
    </center>
		<br><br><br>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
