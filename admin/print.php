<?php
  header("Content-type: application/vnd.ms-word");
  header("Content-Disposition: attachment;Filename=document_name.doc");    
  echo "<meta charset=\"UTF-8\">";
?>
<?php ini_set('display_errors', false); ?>
<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'db.php';
include 'date.php';
include 'query.php';
if (!isset($_SESSION['premission']) == "Admin") {
    session_destroy();
    header("location: ../index.php");
}
?>
<?php if (isset($_GET['lease']))

    $id = $_GET['lease'];
$tsql = "SELECT * from user WHERE personal = '$id'";
$tre = mysqli_query($con, $tsql);
$user = mysqli_fetch_array($tre);

$room = $user['room'];
$name = array("" . $user['prefix_name'] . " " . $user['fname'] . " " . $user['lname'] . "");



$d = date("d"); // เก็บวันที่สมัคร และเปลี่ยนปีเป็น พ.ศ
$m = date("m");
$y = date("Y");

$dob = $user['dob'];
list($year, $month, $day) = explode('-', $dob);

$age = $y - $year;
$phone = $user['phone'];
$address = $user['districts'];

if ($user['rental_start_date'] != null or $user['rental_end_date'] != '0000-00-00') {
    list($y_start1, $m_start1, $d_start1) = explode('-', $user['rental_start_date']);
    $y_start1 = $y_start1 + 543;
}

$ssqlr = "SELECT districts.name_th as nameD, amphures.name_th as nameA,provinces.name_th as nameP,districts.zip_code as zip
FROM districts INNER JOIN amphures ON(districts.amphure_id = amphures.id) INNER JOIN provinces ON(amphures.province_id = provinces.id)
INNER JOIN user on(user.districts = districts.id)
WHERE user.districts = $address AND user.personal = '$id'";
$disc = mysqli_query($con, $ssqlr);
$provin = mysqli_fetch_array($disc);


    $ttsql = "SELECT room_details.price as price,
    room_details.other as other,
    paper_details.header as header,
    paper_details.address as address,
    paper_details.phone_lessor as L_phone,
    room_details.name_th_price as name_th_price,
    room_details.name_th_other as name_th_other
    FROM USER 
    INNER JOIN room ON(user.room = room.room) 
    INNER JOIN room_details ON(room.type = room_details.id) 
    INNER JOIN  bed_type ON(room_details.bed = bed_type.id)
    INNER JOIN paper_details on(room.paper = paper_details.id) 
    WHERE room.room = '$room'";
    $ttre = mysqli_query($con, $ttsql);
    $type = mysqli_fetch_array($ttre);



    $emtt = "SELECT room_details.price as price,
    paper_details.header as header,
    paper_details.address as address,
    paper_details.phone_lessor as L_phone  FROM `room` INNER JOIN paper_details ON (room.paper = paper_details.id) GROUP BY (`header`and `address`and`phone_lessor`)";
    $ent = mysqli_query($con, $emtt);
    $em = mysqli_fetch_assoc($ent);




?>
<?php
$thai_day_arr = array(" อาทิตย์ ", " จันทร์ ", " อังคาร ", " พุธ ", " พฤหัสบดี ", " ศุกร์ ", " เสาร์ ");
$thai_month_arr = array(
    "0" => "",
    "1" => "มกราคม",
    "2" => "กุมภาพันธ์",
    "3" => "มีนาคม",
    "4" => "เมษายน",
    "5" => "พฤษภาคม",
    "6" => "มิถุนายน",
    "7" => "กรกฎาคม",
    "8" => "สิงหาคม",
    "9" => "กันยายน",
    "10" => "ตุลาคม",
    "11" => "พฤศจิกายน",
    "12" => "ธันวาคม"
);
function thai_date($time)
{
    global $thai_day_arr, $thai_month_arr;
    $thai_date_return = "วัน" . $thai_day_arr[date("w", $time)];
    $thai_date_return .= "ที่ " . date("j", $time);
    $thai_date_return .= " เดือน " . $thai_month_arr[date("n", $time)];
    $year_new = date("Y") + 543;
    $thai_date_return .= " พ.ศ. " . date("$year_new", $time);
    return $thai_date_return;
}

?>
<!--นับจำนวนคนในห้อง-->
<?php

$tre = mysqli_query($con, "SELECT * FROM user WHERE room = '$room'");
$user = mysqli_fetch_assoc($tre);


$rowcount = mysqli_num_rows($tre);


?>
<html>

<head>
    <meta charset="utf-8">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap" rel="stylesheet">
 
</head>

<body>
    <table border="0" cellpadding="" style="background-color:white">
        <tr>
            <td>
                <table style="background-color:white;padding: 3.81px;" width="100%">
                    <tr>
                        <td colspan="3">
                            <div style="float:right">ห้องพักหมายเลข <abbr title="">
                                    <?php if (empty($room)) {
                                        echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                    } else {
                                        echo $room;
                                    } ?></abbr></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="font">
                            <center>
                            <div><b style="font-size:20px">
                                สัญญาเช่าห้องพัก <?php echo $hd['header'];?></b></div>
                                <div>ที่อยู่. <?php echo $hd['address'];?></div>
                                <div>โทร. <?php echo $hd['phone_lessor'];?></div>
                        </td>
                        </center>
                    <tr>
                        <td colspan="3">
                            <lable style="float:right"><abbr title=""><?php echo  thai_date($eng_date) ?></abbr></lable>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">ข้าพเจ้า <abbr title="">&nbsp&nbsp&nbsp <?php echo $name[0] ?> &nbsp&nbsp&nbsp</abbr>
                            อายุ <abbr title="">&nbsp&nbsp&nbsp <?php echo $age ?> &nbsp&nbsp&nbsp</abbr>
                            โทร <abbr title="">&nbsp&nbsp&nbsp <?php echo $phone ?> &nbsp&nbsp&nbsp</abbr></td>
                    </tr>
                    <tr>
                        <td colspan="3">ที่อยู่ <abbr title="">&nbsp&nbsp&nbsp ตำบล.<?php echo $provin['nameD'] ?> &nbsp&nbsp&nbsp
                                <abbr title="">&nbsp อำเภอ. <?php echo $provin['nameA'] ?> &nbsp
                                    <abbr title="">&nbsp จังหวัด. <?php echo $provin['nameP'] ?> &nbsp
                                        <abbr title="">&nbsp รหัสไปรษณีย์. <?php echo $provin['zip'] ?> &nbsp&nbsp&nbsp&nbsp
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">เลขที่บัตรประชาชน <abbr title="">&nbsp&nbsp&nbsp <?php echo base64_decode($id); ?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>
                            สถาที่(ทำงาน/เรียน) .............................................................................................................</td>
                    </tr>
                    <tr>
                        <td colspan="3">เบอร์โทร ญาติที่ติดต่อได้
                            <?php if ($user['Parents_phone'] != null and $user['Parents_phone'] != "") {
                                echo "<abbr title=''>&nbsp&nbsp&nbsp " . $user['Parents_phone'] . " &nbsp&nbsp&nbsp</abbr>";
                            } else echo "........................................."; ?>
                            มีความสัมพันธ์เป็น ............................
                            ชื่อ-สกุล .......................................................</td>
                    </tr>
                    <tr>
                        <td colspan="3">ตกลงทำสัญญาขอเช่าห้องพักหมายเลข <abbr title="">&nbsp&nbsp&nbsp <?php echo $room ?> &nbsp&nbsp&nbsp</abbr>
                            โดยไม่มีกำหนดเวลาการเช่า แต่ไม่น้อยกว่า ............................... เดือน</td>
                    </tr>

                    <tr>
                        <td colspan="3">เริ่มการเช่าตั้งแต่ วันที่<abbr title="">&nbsp&nbsp&nbsp
                                <?php if ($user['rental_start_date'] == null or $user['rental_start_date'] == '0000-00-00') {
                                    echo $d . "/" . $m . "/" . $y_ks;
                                } else {
                                    echo $d_start1 . "/" . $m_start1 . "/" . $y_start1;
                                }; ?>&nbsp&nbsp&nbsp</abbr> เป็นต้นไป
                            โดยตกลงจ่ายค่าเช่าเป็นรายเดือนเดือนละ <abbr title="">
                                <?php 
                                    echo number_format($type['price']);
                                 ?></abbr> บาท
                            <abbr title="">(&nbsp&nbsp&nbsp&nbsp <?php echo $type['name_th_price']; ?> &nbsp&nbsp&nbsp&nbsp)&nbsp </abbr>
                    </tr>
                    <tr>
                        <td colspan="3"> และค่าประกันจำนวนเงิน <abbr title="">
                                <?php 
                                    echo number_format($type['other']);
                                 ?></abbr> บาท
                            <abbr title="">(&nbsp&nbsp&nbsp&nbsp <?php echo $type['name_th_other']; ?> &nbsp&nbsp&nbsp&nbsp)&nbsp </abbr>
                        </td>
            </td>
        </tr>
        <?php if ($rowcount > '1') : ?>
            <tr>
                <td colspan="3">โดยมีผู้ร่วมทำสัญญา ...............2............. คน ดังรายการต่อไปนี้</td>
            </tr>
            <?php

            $cnnt = mysqli_query($con, "SELECT * FROM user INNER JOIN room on(user.room = room.room) WHERE room.room = '$room'");
            while ($pow_pe = mysqli_fetch_array($cnnt)) {
                if ($pow_pe['personal'] != $id) {
                    $id2 = $pow_pe['personal'];
                    $districts2 = $pow_pe['districts'];
                    $phone2 = $pow_pe['phone'];
                    $Parents = $pow_pe['Parents_phone'];
                    $nameB = array($pow_pe['prefix_name'] . " " . $pow_pe['fname'] . " " . $pow_pe['lname']);

                    $dob2 = $pow_pe['dob'];
                    list($year_array, $month_array, $day_array) = explode('-', $dob2);

                    $age_array = $y - $year_array;
                }
            }

            $disc_ar = mysqli_query($con, "SELECT districts.name_th as nameD, amphures.name_th as nameA,provinces.name_th as nameP,districts.zip_code as zip
            FROM districts INNER JOIN amphures ON(districts.amphure_id = amphures.id) INNER JOIN provinces ON(amphures.province_id = provinces.id)
            INNER JOIN user on(user.districts = districts.id)
            WHERE  user.room = $room and user.personal = '$id2'");
            $provin_array = mysqli_fetch_array($disc_ar);
            $districts2 = $provin_array['nameD'];
            $amphures2 = $provin_array['nameA'];
            $provinces2 = $provin_array['nameP'];
            $zip2 = $provin_array['zip'];


            ?>
            <tr>
                <td colspan="3">ข้าพเจ้า <abbr title="">&nbsp&nbsp&nbsp <?php echo $nameB[0] ?>&nbsp&nbsp&nbsp</abbr>
                    อายุ <abbr title="">&nbsp&nbsp&nbsp <?php echo $age_array ?>&nbsp&nbsp&nbsp</abbr>
                    โทร <abbr title="">&nbsp&nbsp&nbsp <?php echo $phone2 ?>&nbsp&nbsp&nbsp</abbr></td>
            </tr>
            <tr>
                <td colspan="3">ที่อยู่
                    ที่อยู่ <abbr title="">&nbsp&nbsp&nbsp ตำบล.<?php echo $provinces2 ?>&nbsp&nbsp&nbsp
                        <abbr title="">&nbsp อำเภอ. <?php echo $amphures2 ?>&nbsp
                            <abbr title="">&nbsp จังหวัด. <?php echo $districts2 ?>&nbsp
                                <abbr title="">&nbsp รหัสไปรษณีย์. <?php echo $zip2 ?>&nbsp&nbsp&nbsp&nbsp
                </td>
            </tr>
            <tr>
                <td colspan="3">เลขที่บัตรประชาชน <abbr title="">&nbsp&nbsp&nbsp <?php echo base64_decode($id2); ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>
                    สถาที่(ทำงาน/เรียน) .............................................................................................................</td>
            </tr>
            <tr>
                <td colspan="3">เบอร์โทร ญาติที่ติดต่อได้
                    <?php
                    if ($Parents != null and $Parents != "") {
                        echo "<abbr title=''>&nbsp&nbsp&nbsp" . $Parents . "&nbsp&nbsp&nbsp</abbr>";
                    } else echo ".........................................";
                    ?>
                    มีความสัมพันธ์เป็น ............................
                    ชื่อ-สกุล ...................................................................</td>
            </tr>
        <?php endif; ?>
        <tr>
            <td colspan="3">
                <b>โดยข้าพเจ้าและผู้ร่วมอาศัยยินยอมปฏิบัติตามกฏระเบียบดังนี้</b>
            </td>
        </tr>
        </tr>
        <tr>
            <td colspan="3">

                <?php
                $sql = "SELECT * FROM `rule` WHERE type = 2";
                $sqlA = mysqli_query($con, $sql);
                $i = 1;
                while ($row = mysqli_fetch_array($sqlA)) {
                    $data = $row['data'];
                    echo '<div align="justify">';
                    echo $i . ". ";

                    echo $data;
                    echo '</div>';

                    $i++;
                }

                ?>

                <br>

                <lable class="backspace">หากข้าพเจ้าประพฤติผิดสัญญาอย่างใดอย่างหนึ่ง
                    ข้าพเจ้ายินยอมให้ตักเตือนและจะปฏิบัติตามให้ถูกต้อง
                    ตามสัญญาทันทีอย่างเคร่งครัด
                    รวมทั้งในกรณีผู้ให้เช่าไม่สามารถยอมรับในการกระทำกรณีนั้น ๆ ได้
                    ผู้เช่ายินยอมให้ ผู้ให้เช่าบอกเลิกสัญญาได้ทันที และยินยอมที่จะย้ายออกภายใน 5
                    วันหลังจากบอกเลิกสัญญา และในกรณีที่ไม่สามารถ ย้ายออกได้ตามกำหนด
                    ข้าพเจ้ายินยอมให้ขนทรัพย์ออกจากห้องพักมาไว้บริเวณใต้ที่พัก โดยผู้เช่าจะดูแลทรัพย์สินหลังจากขนย้ายออกจากห้องพักเอง ซึ่งผู้ให้เช่าไม่ต้องรับผิดชอบความเสียหายของทรัพย์สินภายในห้องและที่ขนออกจากห้อง
                </lable>
                </div>
                <br>
                <blockquote cite="ChillChillJapan : https://chillchilljapan.com/">
                    <div align="justify">
                        <lable class="backspace">สัญญานี้ได้ทำเอาไว้เป็นหลักฐาน 2 ฉบับ โดยให้ผู้เช่าและผู้ให้เช่าเก็บไว้ฝ่ายละ 1 ฉบับ
                            เพื่อเป็นหลักฐานในการเช่า ข้าพเจ้าได้อ่ายและเข้าใจข้อความนี้ดีแล้วและได้ลงชื่อไว้เป็นหลักฐาน
                            ทั้งนี้ได้แนบสำเนาบัตรประชาชนของข้าพเจ้าและผู้ร่วมอาศัยประกอบในสัญญาด้วย
                            โดยข้าพเจ้าได้ตรวจดูแล้วว่าสภาพห้องพักดังกล่าวอยู่ในสภาพสะอาดเรียบร้อยดี</lable>
                    </div>
                </blockquote>

            </td>
        </tr>
        <?php if ($rowcount > '1') : ?>
            <tr>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td>ลงชื่อ..........................................ผู้เช่า</td>
                <td colspan="2" style="float:right">ลงชื่อ..........................................ผู้เช่า</td>
            </tr>
            <tr>
                <td>(<abbr title="">&nbsp&nbsp&nbsp&nbsp&nbsp <?php echo $nameB[0] ?> &nbsp&nbsp&nbsp&nbsp&nbsp</abbr>)</td>
                <td colspan="2" style="float:right">(<abbr title="">&nbsp&nbsp&nbsp&nbsp&nbsp <?php echo $name[0] ?>&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>)</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="float:right"><br>ลงชื่อ......................................ผู้ให้เช่า</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="float:right">(<abbr title="">&nbsp&nbsp&nbsp&nbsp&nbsp <?php echo $_SESSION['prefix_name_A'] . " " . $_SESSION['fname_A'] . " " . $_SESSION['lname_A']; ?>&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>)</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="float:right"><br>ลงชื่อ.........................................พยาน</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="float:right">(......................................................)</td>
            </tr>
        <?php else : ?>
            <tr>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="float:right">ลงชื่อ..........................................ผู้เช่า</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="float:right">(<abbr title="">&nbsp&nbsp&nbsp&nbsp&nbsp <?php echo $name[0] ?>&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>)</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="float:right"><br>ลงชื่อ......................................ผู้ให้เช่า</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="float:right">(<abbr title="">&nbsp&nbsp&nbsp&nbsp&nbsp <?php echo $_SESSION['prefix_name_A'] . " " . $_SESSION['fname_A'] . " " . $_SESSION['lname_A']; ?>&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>)</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="float:right"><br>ลงชื่อ.........................................พยาน</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="float:right">(......................................................)</td>
            </tr>
        <?php endif; ?>

    </table>

    </td>
    </tr>
    </table>

</body>

</html>



