<?php
session_start();
if($_POST) {
  include "dbcon.php";

  $newid =  $_SESSION['ids'];
  $newname = $_POST['editsname'];
  $newclass = $_POST['editsclass'];
  $sql2 = "UPDATE tb_student set s_id = '".$newid."' , s_name = '".$newname."' , s_class = '".$newclass."'
  WHERE s_id = '".$newid."'";
  $query = mysqli_query($link,$sql2);
  header( "Location: stdmanage.php" );
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

      .editbtn{
        font-size: 19px;
      }

      .edits {
        text-align: center;
      }
    </style>
  </head>
  <body><br><br>

    <?php
      include "dbcon.php";
      $ids = $_GET['id'];
      $sql = "SELECT * FROM tb_student WHERE s_id = '".$ids."'";
      $query = mysqli_query($link,$sql);
      $r = mysqli_fetch_array($query);
      $_SESSION['ids'] = $r['s_id'];
    ?>
    &nbsp;&nbsp;<font  size="5"><span class="glyphicon glyphicon-list-alt" style="color:#2980b9"></span> แก้ไขข้อมูลนักเรียน</font> <br><hr>
    <center><br>
      <table width="50%" border="0" class="table table-striped">
        <tr>
          <td>
            <form action="editstd.php" method="post">
                <table border="0" bordercolor="#EEE9E9" width="30%" class="table">
                    <tr>
                         <td colspan="2"><center>แก้ไขข้อมูล</td>
                    </tr>
                    <tr>
                        <td width="30%"><center> รหัสนักเรียน </center></td>
                        <td width="70%"> <input type="text" name="editsid" value="<?php echo $r['s_id']; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td width="30%"><center> ชื่อ-นามสกุล </center></td>
                        <td width="70%"> <input type="text" name="editsname" value="<?php echo $r['s_name']; ?>" required></td>
                    </tr>
                    <tr>
                        <td width="30%"><center> ระดับชั้น </center></td>
                        <td width="70%"><select name="editsclass">
          								<option <?php if($r['s_class']=="1/1"){?>selected=selected="selected" <?php }?> value="1/1">ชั้นมัธยมศึกษาปีที่ 1/1</option>
          								<option <?php if($r['s_class']=="1/2"){?>selected=selected="selected" <?php }?> value="1/2">ชั้นมัธยมศึกษาปีที่ 1/2</option>
                          <option <?php if($r['s_class']=="1/3"){?>selected=selected="selected" <?php }?> value="1/3">ชั้นมัธยมศึกษาปีที่ 1/3</option>
                          <option <?php if($r['s_class']=="2/1"){?>selected=selected="selected" <?php }?> value="2/1">ชั้นมัธยมศึกษาปีที่ 2/1</option>
                          <option <?php if($r['s_class']=="2/2"){?>selected=selected="selected" <?php }?> value="2/2">ชั้นมัธยมศึกษาปีที่ 2/2</option>
                          <option <?php if($r['s_class']=="2/3"){?>selected=selected="selected" <?php }?> value="2/3">ชั้นมัธยมศึกษาปีที่ 2/3</option>
                          <option <?php if($r['s_class']=="3/1"){?>selected=selected="selected" <?php }?> value="3/1">ชั้นมัธยมศึกษาปีที่ 3/1</option>
                          <option <?php if($r['s_class']=="3/2"){?>selected=selected="selected" <?php }?> value="3/2">ชั้นมัธยมศึกษาปีที่ 3/2</option>
                          <option <?php if($r['s_class']=="3/3"){?>selected=selected="selected" <?php }?> value="3/3">ชั้นมัธยมศึกษาปีที่ 3/3</option>
          							</select>
                        </td>
                    </tr>
                    <tr>
                         <td colspan="2"><center><button type="submit" class="btn btn-success" > แก้ไขข้อมูล </button></td>
                    </tr>
                  </td>
                </tr>
      </table>
    </form>
  </center>
  </body>
</html>
