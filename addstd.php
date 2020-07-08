<?php
session_start();
if($_SESSION['TypeUser']==""){
	echo "<br><br><center><font size=\"4\" color=\"red\" > กรุณาลงชื่อเข้าใช้ </font> <br><a href=\"index.php\"> คลิ๊กที่นี่ </a> </center>";
	exit;
}
else if($_SESSION['TypeUser']!="admin"){
	echo "<br><br><center><font size=\"4\" color=\"red\" > คุณไม่มีสิทธิ์ใช้งานหน้านี้ </font> <br><a href=\"logout.php\"> ออกจากระบบ </a> </center>";
	exit;
}

function dateToPassword($date){
    $password = "";
    $part = explode ("-", $date);
    $numpart = sizeof($part);
    for($x = 0; $x < $numpart; $x++){
      $password = $password.$part[$x];
    }
    return $password;
}

function AddtoTBLOGIN($u,$p){
    include "dbcon.php";
    $sql = "INSERT INTO tb_login VALUES($u,'$p','student')";
    $result = mysqli_query($link,$sql);
}
function AddtoTBSTUDENT($u,$n,$c,$d){
    include "dbcon.php";
    $sql = "INSERT INTO tb_student VALUES('$u','$n','$d','$c','$u')";
    $result = mysqli_query($link,$sql);
}
function AddtoTBSCORE($u){
    include "dbcon.php";
    $sql = "INSERT INTO tb_score VALUES($u,'100')";
    $result = mysqli_query($link,$sql);
}

function alert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="global.css">
  	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<title>หน้าหลัก</title>
    <style>
			@import url('https://fonts.googleapis.com/css?family=Prompt');
  			* {
				font-family: 'Prompt', sans-serif;
			}

    </style>
  </head>
  <body><br><br>
      &nbsp;&nbsp;<font  size="5"><span class="glyphicon glyphicon-list-alt" style="color:#2980b9"></span> เพิ่มรายชื่อนักเรียน</font> <br><hr>
      <center>

      <table width="50%" border="0" class="table table-striped">
        <tr>
          <td>
            <form action="addstd.php" method="post">
                <table border="0" bordercolor="#EEE9E9" width="30%" class="table">
                    <tr>
                         <td colspan="2"><center>กรอกข้อมูล</td>
                    </tr>
                    <tr>
                        <td width="30%"><center> รหัสนักเรียน </center></td>
                        <td width="70%"> <input type="text" name="newId" required></td>
                    </tr>
                    <tr>
                        <td width="30%"><center> ชื่อ-นามสกุล </center></td>
                     <td width="70%">

												<input type="text" name="newName"></td>
                    </tr>
                    <tr>
                        <td width="30%"><center> วัน-เดือน-ปีเกิด </center></td>
                        <td width="70%"> <input type="text" name="newBOD" size="10" required><br>
                        <font size="2">*กรอกในรูปแบบ วว-ดด-ปป เช่น 01-01-2535</font></td>
                    </tr>
                    <tr>
                        <td width="30%"><center> ระดับชั้น </center></td>
                        <td width="70%"><select name="newClass">
          								<option value="1/1">ชั้นมัธยมศึกษาปีที่ 1/1</option>
          								<option value="1/2">ชั้นมัธยมศึกษาปีที่ 1/2</option>
													<option value="1/3">ชั้นมัธยมศึกษาปีที่ 1/3</option>
													<option value="2/1">ชั้นมัธยมศึกษาปีที่ 2/1</option>
          								<option value="2/2">ชั้นมัธยมศึกษาปีที่ 2/2</option>
													<option value="2/3">ชั้นมัธยมศึกษาปีที่ 2/3</option>
													<option value="3/1">ชั้นมัธยมศึกษาปีที่ 3/1</option>
          								<option value="3/2">ชั้นมัธยมศึกษาปีที่ 3/2</option>
													<option value="3/3">ชั้นมัธยมศึกษาปีที่ 3/3</option>
          							</select>
                        </td>
                    </tr>
                    <tr>
                         <td colspan="2"><center><button type="submit" class="btn btn-success" > เพิ่มข้อมูล </button></td>
                    </tr>
                  </td>
                </tr>
      </table>
    </form>
    <?php
        if($_POST){
            $ID = $_POST['newId'];
            $NAME = $_POST['newName'];
            $CLASS = $_POST['newClass'];
            $DOB = $_POST['newBOD'];
            $PASS = dateToPassword($DOB);
            AddtoTBLOGIN($ID,$PASS);
            AddtoTBSTUDENT($ID,$NAME,$CLASS,$DOB);
            AddtoTBSCORE($ID);
            alert("เพิ่มสำเร็จ");
            //header( "Location: stdmanage.php" );
        }
    ?>
      </table>
  </body>
</html>
