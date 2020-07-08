<?php
$idonlink = $_GET['id'];
include "dbcon.php";
$sql = "DELETE FROM tb_login WHERE login_user ='".$idonlink."'";
$result = mysqli_query($link,$sql);
header( "Location: stdmanage.php" );
 ?>
