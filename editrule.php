<?php
session_start();
if($_POST) {
  include "dbcon.php";
	$rid =$_SESSION['id'];
  $newname = $_POST['rname'];
  $newdetail = $_POST['rdetail'];
	$newtype   = $_POST['rtype'];
	$newscore  = $_POST['rscore'];

  $sql2 = "UPDATE tb_rule set r_id = '".$rid."' ,	r_name = '".$newname."' , r_detail = '".$newdetail."' , r_type = '".$newtype."' ,r_score = '".$newscore."'
  WHERE r_id = '".$rid."'";
  $query = mysqli_query($link,$sql2);
  header( "Location: rulemanage.php" );
 }

if($_SESSION['TypeUser']==""){
	echo "<br><br><center><font size=\"4\" color=\"red\" > กรุณาลงชื่อเข้าใช้ </font> <br><a href=\"index.php\"> คลิ๊กที่นี่ </a> </center>";
	exit;
}
else if($_SESSION['TypeUser']!="admin"){
	echo "<br><br><center><font size=\"4\" color=\"red\" > คุณไม่มีสิทธิ์ใช้งานหน้านี้ </font> <br><a href=\"logout.php\"> ออกจากระบบ </a> </center>";
	exit;
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
  <body>
		<?php
      include "dbcon.php";
      $id = $_GET['id'];
      $sql = "SELECT * FROM tb_rule WHERE r_id = '".$id."'";
      $query = mysqli_query($link,$sql);
      $r = mysqli_fetch_array($query);
      $_SESSION['id'] = $r['r_id'];
    ?>

		<br><br>
      &nbsp;&nbsp;<font  size="5"><span class="glyphicon glyphicon-list-alt" style="color:#2980b9"></span> แก้ไขกฏระเบียบ</font> <br><hr>
      <center>

      <table width="50%" border="0" class="table table-striped">
        <tr>
          <td>
            <form action="editrule.php" method="post" >
                <table border="0" bordercolor="#EEE9E9" width="30%" class="table">
                    <tr>
                         <td colspan="2"><center>แก้ไขกฏระเบียบ</td>
                    </tr>
                    <tr>
                        <td width="30%"><center> รหัส </center></td>
                        <td width="70%"> <input type="text" name="rid" size="3" value="<?php echo $r['r_id'];?>" disabled></td>
                    </tr>
                    <tr>
                        <td width="30%"><center> ชื่อกฏ<br>(แบบย่อ) </center></td>
												<td width="70%"> <input type="text" name="rname" value="<?php echo $r['r_name'];?>" required></td>
										</tr>
										<tr>
                        <td width="30%"><center> รายละเอียดกฏ </center></td>
												<td width="70%"><textarea name="rdetail"   required><?php echo $r['r_detail'];?></textarea></td>
										</tr>
	                   <tr>
											 	<td width="30%"><center> ประเภท </center></td>
                        <td width="70%"><select name="rtype" required>
          								<option <?php if($r['r_type']=="decrease"){?>selected=selected="selected" <?php }?> value="decrease">ตัดคะแนน</option>
          								<option <?php if($r['r_type']=="increase"){?>selected=selected="selected" <?php }?> value="increase">เพิ่มคะแนน</option>
          							</select> </td>
                    </tr>
										<tr>
											 <td width="30%"><center> คะแนน </center></td>
											 <td width="70%"><select name="rscore" required>
												 <option <?php if($r['r_score']=="5"){?>selected=selected="selected" <?php }?> value="5"> 5 คะแนน</option>
												 <option <?php if($r['r_score']=="10"){?>selected=selected="selected" <?php }?> value="10">10 คะแนน</option>
												 <option <?php if($r['r_score']=="15"){?>selected=selected="selected" <?php }?> value="15">15 คะแนน</option>
												 <option <?php if($r['r_score']=="20"){?>selected=selected="selected" <?php }?> value="20">20 คะแนน</option>
												 <option <?php if($r['r_score']=="25"){?>selected=selected="selected" <?php }?> value="25">25 คะแนน</option>
												 <option <?php if($r['r_score']=="30"){?>selected=selected="selected" <?php }?> value="30">30 คะแนน</option>
												 <option <?php if($r['r_score']=="35"){?>selected=selected="selected" <?php }?> value="35">35 คะแนน</option>
												 <option <?php if($r['r_score']=="40"){?>selected=selected="selected" <?php }?> value="40">40 คะแนน</option>
												 <option <?php if($r['r_score']=="45"){?>selected=selected="selected" <?php }?> value="45">45 คะแนน</option>
												 <option <?php if($r['r_score']=="50"){?>selected=selected="selected" <?php }?> value="50">50 คะแนน</option>
											 </select> </td>
									 </tr>
                    <tr>
                         <td colspan="2"><center><button type="submit" class="btn btn-success" > แก้ไขกฏระเบียบ </button></td>
                    </tr>
                  </td>
                </tr>
      </table>
    </form>

      </table>
  </body>
</html>
