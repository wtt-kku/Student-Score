<?php
session_start();
$all = 0;
$p;

function CountLap($o)
{
	include "dbcon.php";
	$sql2 = "SELECT COUNT(*) as total FROM tb_history WHERE r_id = '$o'";
	$query2 = mysqli_query($link,$sql2);
	$data=mysqli_fetch_assoc($query2);
	$c = $data['total'];
	return $c;
}



function FindN()
{
	include "dbcon.php";
	$all2 = 0;
	$sql = "SELECT * FROM tb_rule";
	$query = mysqli_query($link,$sql);
	while ($r = mysqli_fetch_array($query)) {

		$tmpid = $r['r_id'];
		$numEach = CountLap($tmpid);
		$all2 = $all2 + $numEach;
	}
	return $all2;
}

if($_SESSION['TypeUser']==""){
	echo "<br><br><center><font size=\"4\" color=\"red\" > กรุณาลงชื่อเข้าใช้ </font> <br><a href=\"index.php\"> คลิ๊กที่นี่ </a> </center>";
	exit;
}
else if($_SESSION['TypeUser']!="admin"){
	echo "<br><br><center><font size=\"4\" color=\"red\" > คุณไม่มีสิทธิ์ใช้งานหน้านี้ </font> <br><a href=\"logout.php\"> ออกจากระบบ </a> </center>";
	exit;
}


?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="global.css">
  	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title></title>
    <style>
      @import url('https://fonts.googleapis.com/css?family=Prompt');
        * {
        font-family: 'Prompt', sans-serif;
      }

      .red {
          color: red;
        }
      .or {
        color: #2980b9;
      }
    </style>
  </head>
  <body><br><br>
    &nbsp;&nbsp;<font  size="5"><span class="glyphicon glyphicon-list-alt" style="color:#2980b9"></span> สถิติการทำผิกกฏ</font> <br><hr>
    <center>
			<table width="85%" border="0">
				<tr>
					<td width="90%"></td>
					<td width="10%">

	</td>
				</tr>
			</table><br>
    <table width="85%" border="0">
      <tr>
        <td>
              <table border="1" bordercolor="#EEE9E9" class="table table-striped">
                  <tr>
                      <td width="8%"><center>รหัส</center></td>
                      <td width="55%"><center>กฎระเบียบ</center></td>
                      <td width="20%"><center>จำนวนครั้งที่ทำผิด</center></td>
                      <td width="15%"><center>เปอร์เซนต์</center></td>

                  </tr>
                  <?php
                      include "dbcon.php";
                      $sql = "SELECT * FROM tb_rule WHERE r_type = 'decrease'";
                      $query = mysqli_query($link,$sql);
                      while ($r = mysqli_fetch_array($query)) {

                  ?>
                  <tr>
                      <td width="8%"><center><?php echo $r['r_id']; ?></center></td>
                      <td width="50%"><?php echo $r['r_detail']; ?></td>
                      <td width="20%"><center><?php
																												$tmpid = $r['r_id'];
																												$numEach = CountLap($tmpid);
																												$all = $all + $numEach;
																												echo $numEach;

																							?></center></td>
                      <td width="15%"><center><?php
																					$N = FindN();
																					$res = ($numEach*100)/$N;
																					echo $res; ?></center></td>

                  </tr>
          <?php } ?>
          </table>
					<?php echo "ทำผิดรวมทั้งหมด ".$all." ครั้ง"; ?>
					<br><br>

    </center>
  </body>
</html>
