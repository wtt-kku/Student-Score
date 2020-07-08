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

function AddtoTBRULE($i,$n,$d,$t,$s){
    include "dbcon.php";
    $sql = "INSERT INTO tb_rule VALUES('$i','$n','$d','$t','$s')";
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
      &nbsp;&nbsp;<font  size="5"><span class="glyphicon glyphicon-list-alt" style="color:#2980b9"></span> เพิ่มกฏระเบียบ</font> <br><hr>
      <center>

      <table width="50%" border="0" class="table table-striped">
        <tr>
          <td>
            <form action="addrule.php" method="post" >
                <table border="0" bordercolor="#EEE9E9" width="30%" class="table">
                    <tr>
                         <td colspan="2"><center>กรอกข้อมูลเพิ่มกฏระเบียบ</td>
                    </tr>
                    <tr>
                        <td width="30%"><center> รหัส </center></td>
                        <td width="70%"> <input type="text" name="rid" size="3" required></td>
                    </tr>
                    <tr>
                        <td width="30%"><center> ชื่อกฏ<br>(แบบย่อ) </center></td>
												<td width="70%"> <input type="text" name="rname" required></td>
										</tr>
										<tr>
                        <td width="30%"><center> รายละเอียดกฏ </center></td>
												<td width="70%"><textarea name="rdetail"  required></textarea></td>
										</tr>
	                   <tr>
											 	<td width="30%"><center> ประเภท </center></td>
                        <td width="70%"><select name="rtype" required>
          								<option value="decrease">ตัดคะแนน</option>
          								<option value="increase">เพิ่มคะแนน</option>
          							</select> </td>
                    </tr>
										<tr>
											 <td width="30%"><center> คะแนน </center></td>
											 <td width="70%"><select name="rscore" required>
												 <option value="5"> 5 คะแนน</option>
												 <option value="10">10 คะแนน</option>
												 <option value="15">15 คะแนน</option>
												 <option value="20">20 คะแนน</option>
												 <option value="25">25 คะแนน</option>
												 <option value="30">30 คะแนน</option>
												 <option value="35">35 คะแนน</option>
												 <option value="40">40 คะแนน</option>
												 <option value="45">45 คะแนน</option>
												 <option value="50">50 คะแนน</option>
											 </select> </td>
									 </tr>
                    <tr>
                         <td colspan="2"><center><button type="submit" class="btn btn-success" > เพิ่มกฏระเบียบ </button></td>
                    </tr>
                  </td>
                </tr>
      </table>
    </form>
    <?php
        if($_POST){
            $rID = $_POST['rid'];
            $rNAME = $_POST['rname'];
            $rDETAIL = $_POST['rdetail'];
            $rTYPE = $_POST['rtype'];
            $rSCORE = $_POST['rscore'];
						AddtoTBRULE($rID,$rNAME,$rDETAIL,$rTYPE,$rSCORE);
            alert("เพิ่มสำเร็จ");
            header( "Location: rulemanage.php" );
        }
    ?>
      </table>
  </body>
</html>
