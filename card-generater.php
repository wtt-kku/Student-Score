<!DOCTYPE html>
<?php
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
    } //ฟังก์ชั่นสุ่มเลข
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h2> สร้างบัตรคะแนน </h2>
    <form  action="card-generater.php" method="post">
      จำนวนคะแนน :  <select name="score">
                      <option value="5">เพิ่ม  5 คะแนน</option>
                      <option value="10">เพิ่ม 10 คะแนน</option>
                      <option value="15">เพิ่ม 15 คะแนน</option>
                    </select> <br>
      จำนวนบัตร : <input type="number" name="num" min="1" max="10" maxlength="2"><br>
      <input type="submit" value="สร้างบัตรคะแนน">
    </form>
    <?php
      if($_POST){
        for ($i = 0; $i < $_POST['num']; $i++) {
            $code[$i] = RandomCode();
            echo $code[$i]."<br>";

        }
      }
    ?>
  </body>
</html>
