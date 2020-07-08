<?php
session_start();
$_SESSION['TypeUser']="";
error_reporting(0);
$msg;

include "dbcon.php";
if($_POST) {
  $u = mysqli_real_escape_string($link, $_POST['login']);
  $p = mysqli_real_escape_string($link, $_POST['pasw']);

  $sql = "SELECT * FROM tb_login WHERE login_user = '".$u."'
	and login_pass = '".$p."'";



  //$sql = "SELECT * FROM tb_login WHERE login_user = '".mysqli_real_escape_string($link,$_POST['login'])."'
	//and Password = '".mysqli_real_escape_string($link,$_POST['pasw'])."'";
  $query = mysqli_query($link,$sql);
  $result = mysqli_fetch_array($query,MYSQLI_ASSOC);

  if(!$result)
	{
			$msg ="***ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง***";
	}
	else
	{
			$_SESSION['ID'] = $result["login_user"];
			$_SESSION['TypeUser'] = $result["user_level"];

			if($_SESSION['TypeUser'] == "student")
			{
				header("location:student.php");
			}
      else if($_SESSION['TypeUser'] == "teacher")
			{
				header("location:teacher.php");
			}
      else if($_SESSION['TypeUser'] == "admin")
			{
				header("location:admin.php");
			}
			else
			{
				echo "Something Wrong!!";
			}

	}
	mysqli_close($link);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<title>ระบบคะแนนพฤติกรรม</title>
<style>
  @import url('https://fonts.googleapis.com/css?family=Prompt');
  * {
		font-family: 'Prompt', sans-serif;
	}
	body {
    background-image: url("images/bg.jpg");
	}
	div.warn {
		color: red;
		font-size: 18px;
		margin: 10px;
	}
  .login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>

<body><br><br>
<center><img width="500"  src="images/ico.png"></center>

<div class="login-form">
    <form method="post">

        <h3 class="text-center">เข้าสู่ระบบ</h3>
        <div class="form-group">
            <input type="text" name="login" class="form-control" placeholder="รหัสนักเรียน" required="required">
        </div>
        <div class="form-group">
            <input type="password" name="pasw" class="form-control" placeholder="รหัสผ่าน" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>

        </div>
        <font>หมายเหตุ : นักเรียนเข้าสู่ระบบโดยใช้รหัสนักเรียนเป็น <b>Username</b> และ <b>Password</b> เป็นวันเดือนปีเกิด เช่น 01012541</font>
        <br><font color="red"><?php echo $msg;?></font>
    </form>
    <p class="text-center">Create by Withan CIS @KKU</p>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
