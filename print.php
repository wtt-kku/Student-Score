<?php
session_start();
$Allcode = $_SESSION['ALLCODE'];
$tname = $_SESSION['Tname'];
$today = date("d/m/Y")
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
      table.dash {
   border: 1px dashed #cccccc;
   border-collapse: collapse;
}
table.dash td {
   border: 1px dashed #cccccc;
}

    </style>
    <script>

    </script>
  </head>
  <body>
    <br><br>

      <center><font size="5">พิมพ์บัตรเพิ่มคะแนน</font></center><br><br>
      <font size="1">ผู้พิมพ์ : <?php echo $tname;?></font><br>
      <font size="1">วันที่พิมพ์ : <?php echo $today;?></font><br><br>

    <table border="1" width="30%" class="dash"> <?php

      for ($index = 0; $index < count($Allcode); $index++){ ?>
         <tr >
           <td  height="65" style="text-align: center"><font size="1">บัตรเพิ่มคะแนน <br>รหัสบัตร : <?php echo $Allcode[$index]; ?></font> </td>
         </tr>
     <?php } ?>

    </table>
    <script type="text/javascript">
 window.onload = function() {
   window.print();
   window.close();}
</script>

  </body>
</html>
