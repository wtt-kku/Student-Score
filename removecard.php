<?php

$codeonlink = $_GET['code'];
include "dbcon.php";
$sql = "DELETE FROM tb_card WHERE c_code ='".$codeonlink."'";
$result = mysqli_query($link,$sql);
header( "Location: cardmanage.php" );
 ?>
