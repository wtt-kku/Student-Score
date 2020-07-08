<?php
$ruleonlink = $_GET['id'];
include "dbcon.php";
$sql = "DELETE FROM tb_rule WHERE r_id = '$ruleonlink'";
$result = mysqli_query($link,$sql);
header( "Location: rulemanage.php" );
 ?>
