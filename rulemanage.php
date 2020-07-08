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
    &nbsp;&nbsp;<font  size="5"><span class="glyphicon glyphicon-list-alt" style="color:#2980b9"></span> จัดการกฎระเบียบนักเรียน</font> <br><hr>
    <center>
			<table width="85%" border="0">
				<tr>
					<td width="90%"></td>
					<td width="10%">
						<a href="addrule.php" class="btn btn-success btn">
							<span class="glyphicon glyphicon-plus"></span> เพิ่มกฏระเบียบ
						</a>
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
                      <td width="15%"><center>ประเภทกฎระเบียบ</center></td>
                      <td width="10%"><center>คะแนน</center></td>
                      <td width="6%"><center>แก้ไข</center></td>
                      <td width="6%"><center>ลบ</center></td>
                  </tr>
                  <?php
                      include "dbcon.php";
                      $sql = "SELECT * FROM tb_rule";
                      $query = mysqli_query($link,$sql);
                      while ($r = mysqli_fetch_array($query)) {
                  ?>
                  <tr>
                      <td width="8%"><center><?php echo $r['r_id']; ?></center></td>
                      <td width="55%"><?php echo $r['r_detail']; ?></td>
                      <td width="15%"><center><?php
                            if($r['r_type'] == "increase") { ?>
                                <font><?php echo "เพิ่มคะแนน";?></font> <?php
                            }
                            else if($r['r_type'] == "decrease"){ ?>
                                <font> <?php echo "ตัดคะแนน"; ?> </font> <?php
                            }
                            ?></center></td>

                      <td width="10%"><center><?php echo $r['r_score'] ?></center></td>
                      <td width="6%"><center><a href="editrule.php?id=<?php echo $r['r_id'];?>"><span class="glyphicon glyphicon-edit or"></a></center></td>
                      <td width="6%"><center><a href="removerule.php?id=<?php echo $r['r_id'];?>" onclick="return confirm('ยืนยันการลบ?')"><span class="glyphicon glyphicon-remove red"></a></center></td>
                  </tr>
          <?php } ?>
          </table>


    </center>
  </body>
</html>
