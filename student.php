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

$id = $_SESSION['ID'];
include "dbcon.php";
//$sql = "SELECT * FROM tb_student  WHERE s_id = $id";
$sql = "SELECT * FROM tb_student JOIN tb_score ON tb_student.s_id =tb_score.s_id WHERE tb_student.s_id = $id";
$query = mysqli_query($link,$sql);
$result = mysqli_fetch_array($query);
		if($result){
				$_SESSION['name'] = $result['s_name'];
			  $_SESSION['score'] = $result['s_score'];
				$_SESSION['class'] = $result['s_class'];
				$_SESSION['dob'] = $result['s_dob'];
		}

?>
<html>
	<head>
	<meta charset="utf-8">

	<title>หน้าหลัก</title>
		<style>
			@import url('https://fonts.googleapis.com/css?family=Prompt');
  			* {
				font-family: 'Prompt', sans-serif;
			}
			body {

				margin: -20px;
				padding: 0px;
				box-sizing: border-box;
				background-image: url(images/bg.jpg);
			}

			.header {
				width: 110%;
				position: fixed;

			}
			.menu .menubar {
				height: 45px;
				text-align: center;
				box-shadow: 1px 2px 4px grey;
				background: #2980b9;

			}
			.menubar li {
				list-style-type: none;
				display: inline-block;
				padding: 8px;
				margin: 5px 10px;
				font-size: 15px;
				cursor: pointer;
				font-weight: bolder;

			}
			.menubar li a {
				color: white;
				text-decoration: none;
			}
			.menubar li:hover {
				background: #3498db;
				color: white;
				text-decoration: none;
			}
			.username {
				color: #65e8ff;
				font-size: 15px;
			}
			a1 {
				font-weight: bold;
				font-size: 15px;
				color: white;
			}
			.btn-logout {
				border-radius: 10px 10px 10px 10px;
				font-size: 18px;
				font-weight: bold;
			}
			.content {
				width: 70%;
				height: auto;
				text-align: center;
				align-content: center;
				margin: auto;
				background-color: white;
			}
			.footer {
				padding: 8px;
   				left: 0;
   				bottom: 0;
   				width: 100%;
   				background-color: #2980b9;
   				color: white;
   				text-align: center;
					font-size: 15px;
					position: fixed;
			}

		</style>
		<body>

		<nav class="header">
			<nav class="menu">
				<ul class="menubar">
				  <li><a href="info.php" onClick="window.location.reload()" target="monitor">ข้อมูลส่วนตัวนักเรียน</a></li>
					<li><a href="rule.php" target="monitor">รายละเอียดกฎระเบียบ</a></li>
					<li><a href="usecard.php" target="monitor">ใช้รหัสบัตรเพิ่มคะแนน</a></li>

					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

					<a1>User : </a1><a class="username"><?php echo $_SESSION['name']; ?></a>

					&nbsp;&nbsp;&nbsp;

					<a href="logout.php" class="btn btn-info btn-sm">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>

				</ul>

			</nav>
		</nav>
		<br><br>

	<div class="container" style="background-color :white " >

			<center><iframe name="monitor" frameBorder="0" width="100%" height="93%" src="info.php"></iframe></center>
		</div>

		<footer class="footer">Create by Withan CIS @KKU</footer>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</body>
	</head>
</html>
