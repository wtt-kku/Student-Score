<?php
session_start();
$msg = "";

function GetScore() //ดึงคะแนนเก่า
{
	$id = $_SESSION['ID'];
	include "dbcon.php";
	$sql2 = "SELECT * FROM tb_score WHERE s_id = $id";
	$query2 = mysqli_query($link,$sql2);
	$result2 = mysqli_fetch_array($query2);
	if($result2){
		$score = $result2['s_score'];
	}
	return $score;
}

function SumScore(){ //เพิ่มคะแนน
	$sum = GetScore()+$_SESSION['point'];
	return $sum;
}

function UpdateScore(){ //อัพเดตคะแนน
		$id = $_SESSION['ID'];
		include "dbcon.php";
		$newScore = SumScore();
		$s = "UPDATE tb_score set s_score = $newScore WHERE s_id = $id";
    $q = mysqli_query($link,$s);
}

function EditStatusCard(){ //แก้สถานะบัตร
	$code =$_POST['cardcode'];
	include "dbcon.php";
	$s2 = "UPDATE tb_card set c_used = 'yes' WHERE c_code = '$code'";
	$q2 = mysqli_query($link,$s2);
}

function UpdateHistory(){ //เพิ่มข้อมูลลงประวัติ
		include "dbcon.php";
		$detail = $_SESSION['detail'];
		$point =  "+".$_SESSION['point'];
		$rid = $_SESSION['rule_id'];
		$id = $_SESSION['ID'];

		$sql = "INSERT INTO tb_history (r_id, s_id) VALUES('$rid','$id')";
	 	$result = mysqli_query($link,$sql);

}


if($_SESSION['TypeUser']==""){
	echo "<br><br><center><font size=\"4\" color=\"red\" > กรุณาลงชื่อเข้าใช้ </font> <br><a href=\"index.php\"> คลิ๊กที่นี่ </a> </center>";
	exit;
}
else if($_SESSION['TypeUser']!="student"){
	echo "<br><br><center><font size=\"4\" color=\"red\" > คุณไม่มีสิทธิ์ใช้งานหน้านี้ </font> <br><a href=\"logout.php\"> ออกจากระบบ </a> </center>";
	exit;
}

if($_POST){
	$code =$_POST['cardcode'];
	include "dbcon.php";
	$sql = "SELECT * FROM tb_card JOIN tb_rule ON tb_card.r_id = tb_rule.r_id WHERE tb_card.c_code = '$code'";
	$query = mysqli_query($link,$sql);
	$result = mysqli_fetch_array($query);
			if($result){
					if($result['c_used']=="no"){
					$msg = "yes";
					$_SESSION['point'] = $result['r_score'];
					$_SESSION['detail'] = $result['r_name'];
					$_SESSION['rule_id'] = $result['r_id'];
					UpdateScore();
					EditStatusCard();
					UpdateHistory();
					}
					else if($result['c_used']=="yes"){
						$msg = "used";
					}

			}
			else {
				$msg = "no";
			}

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
			input[type="text"] {
                text-align: center;
			}

			.condition{
				font-size: 13px;
			}

    </style>
  </head>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <body><br><br>
		<font  size="5"><span class="glyphicon glyphicon-plus-sign" style="color:#2980b9"></span> ใช้บัตรเพิ่มคะแนน</font> <br><hr>
		<center><table width="90%" border="0" bordercolor="red" height="55%">
				<tr align="center" valign="top">
						<td>
								<center><br>
									<form action="usecard.php" method="post">
									<img src="images/std1.png" width="150px"><br><br>
									<font size="4">กรอกรหัสบัตรเพิ่มคะแนน</font><br><br>

									<input type="text" name="cardcode" maxlength="14" required placeholder="XXXX-XXXX-XXXX">
									<button type="submit" class="btn btn-warning" > ยืนยัน</button>
								</form><br>
								<?php
										if($msg=="yes"){
											echo "<font color=\"#228B22\"> รหัสบัตรถูกต้อง </font>\n";
											echo "+".$_SESSION['point'];
											echo "<font color=\"#228B22\"> คะแนน </font>";
										}
										else if($msg=="no"){
											echo "<font color=\"#FF0000\"> ไม่พบรหัสบัตร </font>\n";
										}
										else if($msg=="used"){
											echo "<font color=\"#FF8C00\"> รหัสบัตร</font>\n";
											echo $code;
											echo "<font color=\"#FF8C00\"> ถูกใช้งานไปแล้ว</font>";
										}
										else{
											echo "";
										}
								?>
								</center>
						</td>
				</tr>
		</table></center>
		<center><table width="100%" border="0" bordercolor="red" height="30%" style="background-color:#D6E3EB">
				<tr align="center" valign="top">
						<td align="left">
								<br><p>&nbsp;&nbsp;<font size="5"><span class="glyphicon glyphicon-info-sign" style="color:#2980b9"></span> เงื่อนไขการใช้บัตรเพิ่มคะแนน </font><br></p>
									<nav class="condition">
										<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;• &nbsp;กรอกรหัสบัตรเพิ่มคะแนนให้ครบทั้ง 14 หลัก (รวมเครื่องหมาย ขีด - ด้วย) ตัวอย่างเช่น <b>xxxx-xxxx-xxxx</b></font></p>
										<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;• &nbsp;บัตรเพิ่มคะแนนแต่ละบัตร <b>สามารถใช้ได้เพียงแค่หนึ่งครั้งเท่านั้น</b></p>
										<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;• &nbsp;หากบัตรเพิ่มคะแนนมีปัญหา สามารถแจ้งได้ที่ครูผู้แจกจ่ายบัตร</p>
									</nav>
						</td>
				</tr>
		</table></center>
		<br><br>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
