<?php
session_start();
$count = 1;
$code = array(); //ตัวแปรรอรับโค้ดที่สุ่ม
function RandomCode($length = 12) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
    if($i==4||$i==8){
      $randomString.= "-";
    }
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function alert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

if($_SESSION['TypeUser']==""){
	echo "<br><br><center><font size=\"4\" color=\"red\" > กรุณาลงชื่อเข้าใช้ </font> <br><a href=\"index.php\"> คลิ๊กที่นี่ </a> </center>";
	exit;
}
else if($_SESSION['TypeUser']!="teacher"){
	echo "<br><br><center><font size=\"4\" color=\"red\" > คุณไม่มีสิทธิ์ใช้งานหน้านี้ </font> <br><a href=\"logout.php\"> ออกจากระบบ </a> </center>";
	exit;
}

if($_POST){
  $rule = $_POST['ruleid'];
  $tid = $_SESSION['ID'];
  for ($i = 0; $i < $_POST['num']; $i++) {
      $code[$i] = RandomCode();
}
    for ($i = 0; $i < $_POST['num']; $i++) {
    include "dbcon.php";
    $sql = "INSERT INTO tb_card (c_code,r_id,t_id)VALUES('".$code[$i]."','$rule','$tid')";
    $result = mysqli_query($link,$sql);
    //alert("สร้างบัตรคะแนนสำเร็จ  Code : $code[$i]");
}
    $_SESSION['ALLCODE'] = $code;
    echo "<script>window.open('print.php');</script>";
    //header( "Location: print.php" );
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
      .red {
          color: red;
        }
    </style>
  </head>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <body><br><br>
		 &nbsp;&nbsp;<font  size="5"><span class="glyphicon glyphicon-tags" style="color:#2980b9"></span>&nbsp; สร้างบัตรเพิ่มคะแนน</font> <br><hr>
		<center><table width="90%" border="0" bordercolor="red" >
				<tr align="center" valign="top">
						<td>
								<center><br>
									<form action="cardmanage.php" method="post">

									<font size="4">เลือกกฏระเบียบเพิ่มคะแนน &nbsp;&nbsp;</font><br><br>
									<select name="ruleid">
									<?php
										include "dbcon.php";
										$sql = "SELECT * FROM tb_rule WHERE r_type = 'increase'";
										$q = mysqli_query($link,$sql);
          					while($r = mysqli_fetch_array($q)) {

									?>
									<option  value="<?php echo $r['r_id'];?>"> <?php echo " [+".$r['r_score']." คะแนน] ".$r['r_name'];?> </option>
								<?php
									}
									?>
								</select><br><br>
									จำนวนบัตร : <input type="number" name="num" min="1" max="5" maxlength="1" required>
									<button type="submit" class="btn btn-success" > &nbsp; สร้างบัตรเพิ่มคะแนน &nbsp;</button>
								</form><br><br><br>
								</center>
						</td>
				</tr>
		</table></center>
    &nbsp;&nbsp;<font  size="5"><span class="glyphicon glyphicon-tags" style="color:#2980b9"></span>&nbsp; บัตรคะแนนที่กำลังใช้งาน</font> <br><hr>
<center>
    <table width="60%" border="0">
      <tr>
        <td>
              <table border="1" bordercolor="#EEE9E9" class="table table-striped">
                  <tr>
                      <td width="10%"><center>ลำดับที่</center></td>
                      <td width="30%"><center>วันที่สร้าง</center></td>
                      <td width="30%"><center>รหัสบัตร</center></td>
                      <td width="25%"><center>สถานะ</center></td>
                      <td width="5%"><center>ลบ</center></td>
                  </tr>
                  <?php
                    include "dbcon.php";
                    $idt = $_SESSION['ID'];
                    $sql = "SELECT * FROM tb_card WHERE t_id = '".$idt."' ORDER BY c_date_create ASC";
                    $query = mysqli_query($link,$sql);
                    while ($r = mysqli_fetch_array($query)) {
                      ?>
                        <tr>
                            <td><center><?php echo $count;?></center></td>
                            <td><center><?php echo $r['c_date_create'];?></center></td>
                            <td><center><?php echo $r['c_code']; ?></center></td>
                            <td> <center><?php
                                    if ($r['c_used'] >= "yes"){
                                      ?> <font color="#009900"><?php echo "ถูกใช้งานแล้ว";?></font> <?php
                                    }
                                    else{
                                      ?> <font color="red"> <?php echo "ยังไม่ถูกใช้งาน"; ?> </font> <?php
                                    }

                             ?></center> </td>
                             <td><center><a href="removecard.php?code=<?php echo $r['c_code'];?>" onclick="return confirm('ยืนยันการลบ?')" ><span class="glyphicon glyphicon-remove red"></a></span></center></td>

                           </td>
                          </tr>
                    <?php $count = $count+1; } ?>

              </table>
      </td>
    </tr>
  </table>
</center>

<br><br>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
