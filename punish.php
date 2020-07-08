<?php
session_start();

function GetScore($o) //ดึงคะแนนเก่า
{
	include "dbcon.php";
	$sql2 = "SELECT * FROM tb_score WHERE s_id = $o";
	$query2 = mysqli_query($link,$sql2);
	$result2 = mysqli_fetch_array($query2);
	if($result2){
		$score = $result2['s_score'];
	}
	return $score;
}

function Sumscore($rid,$oldscore) //ดึงคะแนนเก่า
{
	include "dbcon.php";
	$sql3 = "SELECT * FROM tb_rule WHERE r_id = '$rid'";
	$query3 = mysqli_query($link,$sql3);
	$result3 = mysqli_fetch_array($query3);
			if($result3){
			$score = $result3['r_score'];
	}
	$sum = $oldscore - $score;
	return $sum;
}

function UpdateScore($newscore,$o){ //อัพเดตคะแนน
		include "dbcon.php";
		$s = "UPDATE tb_score set s_score = $newscore WHERE s_id = $o";
    $q = mysqli_query($link,$s);
}

function UpdateHistory($_r,$_s){ //เพิ่มข้อมูลลงประวัติ
		include "dbcon.php";
		$sql = "INSERT INTO tb_history (r_id, s_id) VALUES('$_r','$_s')";
	 	$result = mysqli_query($link,$sql);

}

if($_SESSION['TypeUser']==""){
	echo "<br><br><center><font size=\"4\" color=\"red\" > กรุณาลงชื่อเข้าใช้ </font> <br><a href=\"index.php\"> คลิ๊กที่นี่ </a> </center>";
	exit;
}
else if($_SESSION['TypeUser']!="teacher"&&$_SESSION['TypeUser']!="admin"){
	echo "<br><br><center><font size=\"4\" color=\"red\" > คุณไม่มีสิทธิ์ใช้งานหน้านี้ </font> <br><a href=\"logout.php\"> ออกจากระบบ </a> </center>";
	exit;
}

function alert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

if($_POST){
	$ruleid =  $_POST['ruleid']; //หมายเลขกฏ
	$stdall =  $_POST['stdcode']; //รหัสนศ.ทั้งหมดที่ทำผิดกฏ
	$std_id_arr = explode (",", $stdall); //แยกแต่ละรหัสเก็บใส่ array
	$numstd = sizeof($std_id_arr); //จำนวนนักเรียนที่ทำผิดกฏ

	for ($x = 0; $x < $numstd; $x++) {

				include "dbcon.php";
				 $sql = "SELECT * FROM tb_student WHERE s_id='".$std_id_arr[$x]."' ";
				 $q = mysqli_query($link,$sql);
				 $r = mysqli_fetch_array($q);
					 if($r){
						 $sid = $r['s_id'];
						 $old_s = GetScore($sid);
						 $new_s = Sumscore($ruleid,$old_s);
						 UpdateScore($new_s,$sid);
						 UpdateHistory($ruleid,$sid);
						 alert("รหัสนักเรียน ".$r['s_id']."  ".$r['s_name']."  ถูกหักคะแนนเรียบร้อยแล้ว!! ");

					 }else{
						 alert(" !! ไม่พบรหัสนักเรียน ".$std_id_arr[$x]." ในระบบ");
					 }

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



    </style>
  </head>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <body><br><br>
		 &nbsp;&nbsp;<font  size="5"><span class="glyphicon glyphicon-scissors" style="color:#2980b9"></span> ตัดคะแนนนักเรียน</font> <br><hr>
		<center><table width="90%" border="0" bordercolor="red" height="55%">
				<tr align="center" valign="top">
						<td>
								<center><br>
									<form action="punish.php" method="post">
									<img src="images/cut-icon.png" width="110px"><br><br>
									<font size="4">เลือกกฏที่ทำผิด &nbsp;&nbsp;</font>
									<select name="ruleid">
									<?php
										include "dbcon.php";
										$sql = "SELECT * FROM tb_rule WHERE r_type = 'decrease'";
										$q = mysqli_query($link,$sql);
          					while($r = mysqli_fetch_array($q)) {
									?>
									<option  value="<?php echo $r['r_id'];?>"> <?php echo "[".$r['r_id']."] ".$r['r_name'];?> </option>
								<?php
									}
									?>
								</select><br><br>
									<font size="4">กรอกรหัสนักเรียน&nbsp;</font>
 										<input size="26" type="text" name="stdcode"  required> 
									<br>
									<font size="2">*หากนักเรียนมีมากกว่า 1 คน กรุณาใช้เครื่องหมายคอมม่า (,) คั่น และ<u>ห้ามมีช่องว่าง</u></font>
									<br><br>
									<button type="submit" class="btn btn-warning" > &nbsp;&nbsp;&nbsp;ยืนยัน &nbsp;&nbsp;</button>
								</form><br>

								</center>
						</td>
				</tr>
		</table></center>



		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
