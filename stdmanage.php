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
$countall=0;
$countpass=0;
$countfail=0;
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

      .red {
          color: red;
        }
      .blue {
        color: #2980b9;
      }
    </style>
  </head>
  <body><br><br>
      &nbsp;&nbsp;<font  size="5"><span class="glyphicon glyphicon-list-alt" style="color:#2980b9"></span> จัดการรายชื่อนักเรียน</font> <br><hr>
      <center>
				<table width="90%" border="0">
	        <tr>
	          <td width="90%">
							<form action="stdmanage.php" method="post">
							เลือกระดับชั้นที่ต้องการแสดงรายชื่อ : <select name="selectclass">
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
							<button type="submit" class="btn btn-primary btn-sm"> แสดง </button>
						</form>
						</td>
						<td width="10%">
							<a href="addstd.php" class="btn btn-success btn">
      					<span class="glyphicon glyphicon-plus"></span> เพิ่มรายชื่อนักเรียน
    					</a>
		</td>
					</tr>
				</table>

      <table width="90%" border="0">
        <tr>
          <td>
                <table border="1" bordercolor="#EEE9E9" class="table table-striped">
                    <tr>
                        <td width="10%"><center>รหัสนักเรียน</center></td>
                        <td width="25%"><center>ชื่อ - นามสกุล</center></td>
                        <td width="25%"><center>ระดับชั้น</center></td>
												<td width="14%"><center>คะแนนพฤติกรรม</center></td>
												<td width="10%"><center>สถานะ</center></td>
                        <td width="8%"><center>แก้ไข</center></td>
                        <td width="8%"><center>ลบ</center></td>
                    </tr>

                    <?php
                      if($_POST){
                        include "dbcon.php";
                        $iclass = $_POST['selectclass'];
                        $sql = "SELECT * FROM tb_student JOIN tb_score ON tb_student.s_id = tb_score.s_id WHERE tb_student.s_class = '".$iclass."'";
                        $query = mysqli_query($link,$sql);
                        while ($r = mysqli_fetch_array($query)) {
                    ?>

                    <tr>
                        <td width="10%"><center><a  href="stdinfo.php?sid=<?php echo $r['s_id'];?>"> <?php echo $r['s_id']; ?> </a></center></td>
                        <td width="25%"><?php echo $r['s_name'] ?></td>
                        <td width="25%"><center>ชั้นมัธยมศึกษาปีที่ <?php echo $r['s_class'] ?></center></td>
                        <td width="14%"><center><?php echo $r['s_score'] ?></center></td>
                        <td> <center><?php
                                if ($r['s_score'] >= 50){
                                  $countpass = $countpass+1;
                                  $countall = $countall +1;
                                  ?> <font color="#009900"><?php echo "ผ่าน";?></font> <?php
                                }
                                else{
                                  $countfail = $countfail+1;
                                  $countall = $countall +1;
                                  ?> <font color="red"> <?php echo "ไม่ผ่าน"; ?> </font> <?php
                                }
                         ?></center> </td>
                        <td width="8%"><center><a href="editstd.php?id=<?php echo $r['s_id'];?>"><span class="glyphicon glyphicon-edit blue"></a></center></td>
                        <td width="8%"><center><a href="removestd.php?id=<?php echo $r['s_id'];?>" onclick="return confirm('ยืนยันการลบ?')"><span class="glyphicon glyphicon-remove red"></a></span></center></td>
                    </tr>
                  <?php } }?>


      </table>
			<br><br>
  </body>
</html>
