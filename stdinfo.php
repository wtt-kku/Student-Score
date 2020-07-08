<?php
session_start();
if($_SESSION['TypeUser']==""){
	echo "<br><br><center><font size=\"4\" color=\"red\" > กรุณาลงชื่อเข้าใช้ </font> <br><a href=\"index.php\"> คลิ๊กที่นี่ </a> </center>";
	exit;
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
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body><br><br>

		<?php
		include "dbcon.php";
		$ids = $_GET['sid'];
		$sql = "SELECT * FROM tb_student WHERE s_id = '$ids'";
		$q = mysqli_query($link,$sql);
		$r = mysqli_fetch_array($q);
		if($r){
				$name = $r['s_name'];
				$dob = $r['s_dob'];
				$class = $r['s_class'];
		}
		?>

    <center><font  size="5">ประวัติพฤติกรรมของ <?php echo $name." (".$ids.")<br>"; ?></font> </center><br>
    <center>
      <table width="90%" border="0">
        <tr>
          <td>
                <table border="1" bordercolor="#EEE9E9" class="table table-striped">
                    <tr>
                        <td width="20%"><center>วันที่-เวลา</center></td>
                        <td width="70%"><center>รายละเอียด</center></td>
                        <td width="10%"><center>คะแนน</center></td>
                    </tr>
                    <?php
                      include "dbcon.php";
                      $ids = $_GET['sid'];
                      $sql = "SELECT * FROM tb_history JOIN tb_rule ON tb_history.r_id = tb_rule.r_id WHERE tb_history.s_id = '$ids'";
                      $query = mysqli_query($link,$sql);
                      while ($r = mysqli_fetch_array($query)) {
                        ?>
                          <tr>
                              <td><center> <?php echo $r['h_date']; ?> </center></td>
                              <td> <?php echo $r['r_name']; ?> </td>
                              <td><center> <?php
                              if($r['r_type']=="decrease"){
                                ?><font color="red"> <?php
                                 echo "-".$r['r_score'];  ?> </font> <?php
                               }
                               else{
                                 ?><font color="green"> <?php
                                  echo "+".$r['r_score'];  ?> </font> <?php
                               }

                                 ?> </center></td>
                            </tr>
                      <?php } ?>

                </table>
        </td>
      </tr>
    </table>
	</center><br><br>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
