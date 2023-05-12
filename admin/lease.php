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
    FROM user 
    INNER JOIN room ON(user.room = room.room) 
    INNER JOIN room_details ON(room.type = room_details.id) 
    INNER JOIN bed_type ON(room_details.bed = bed_type.id)
    INNER JOIN paper_details on(room.paper = paper_details.id) 
    WHERE room.room = $room";
    $ttre = mysqli_query($con, $ttsql);
    $type = mysqli_fetch_array($ttre);


?>
<?php

function ThDate()
{
//วันภาษาไทย
$ThDay = array ( "อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์" );
//เดือนภาษาไทย
$ThMonth = array ( "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน","พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม","กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม" );
 
//กำหนดคุณสมบัติ
$week = date( "w" ); // ค่าวันในสัปดาห์ (0-6)
$months = date( "m" )-1; // ค่าเดือน (1-12)
$day = date( "d" ); // ค่าวันที่(1-31)
$years = date( "Y" )+543; // ค่า ค.ศ.บวก 543 ทำให้เป็น ค.ศ.
 
return "วัน$ThDay[$week] 
		ที่ $day  
		เดือน $ThMonth[$months] 
		พ.ศ. $years";
}


function toDateThai( $d ) {
    $m = array(
        "",
        "มกราคม",
        "กุมภาพันธ์",
        "มีนาคม",
        "เมษายน",
        "พฤษภาคม",
        "กรกฎาคม",
        "สิงหาคม",
        "กันยายน",
        "ตุลาคม",
        "พฤศจิกายน",
        "ธันวาคม"
    );
    $e = explode("/", $d);
    $r = $e[0]." ".$m[(int)$e[1]]." ".($e[2]);        
    return $r;
}
// echo "จาก {$date_today} เป็น วันที่ ".toDateThai( $date_today );
?>
<!--นับจำนวนคนในห้อง-->
<?php

$tre = mysqli_query($con, "SELECT * FROM user WHERE room = $room");
$user = mysqli_fetch_assoc($tre);


$rowcount = mysqli_num_rows($tre);


?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/dormitory/css/image.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap" rel="stylesheet">
    <style>
        /* reset */

        *[contenteditable] {
            border-radius: 0.25em;
            min-width: 1em;
            outline: 0;
        }

        *[contenteditable] {
            cursor: pointer;
        }

        *[contenteditable]:hover,
        *[contenteditable]:focus,
        td:hover *[contenteditable],
        td:focus *[contenteditable],
        img.hover {
            background: #DEF;
            box-shadow: 0 0 1em 0.5em #DEF;
        }

        span[contenteditable] {
            display: inline-block;
        }


        table {
            font-size: 75%;
            width: 100%;
        }

        table {
            border-collapse: separate;
            border-spacing: 2px;
        }

        th,
        td {
            border-width: 0px;
            padding: 0.5em;
            position: relative;
            text-align: left;
        }

        th,
        td {
            border-radius: 0.25em;
            border-style: solid;
        }

        th {
            background: #EEE;
            border-color: #BBB;
        }

        td {
            border-color: #DDD;
        }

        /* page */

        html {
            font: 16px/1 'Open Sans', sans-serif;
            overflow: auto;
            padding: 0.5in;
        }

        html {
            background: #999;
            cursor: default;
        }

        body {
            box-sizing: border-box;
            height: auto;
            margin: 0 auto;
            overflow: hidden;
            padding: 0.2in;
            width: 8.5in;
        }

        body {
            background: #FFF;
            border-radius: 1px;
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);

        }

        .font {
            font-family: 'Prompt', sans-serif;
            font-weight: bold;
        }

        /* header */





        /* article */

        article,
        article address,
        table.meta,
        table.inventory {
            margin: 0 0 3em;
        }

        article:after {
            clear: both;
            content: "";
            display: table;
        }

        article h1 {
            clip: rect(0 0 0 0);
            position: absolute;
        }

        article address {
            float: left;
            font-size: 125%;
            font-weight: bold;
        }

        /* table meta & balance */

        table.meta,
        table.balance {
            float: right;
            width: 36%;
        }

        table.meta:after,
        table.balance:after {
            clear: both;
            content: "";
            display: table;
        }

        /* table meta */

        table.meta th {
            width: 40%;
        }

        table.meta td {
            width: 60%;
        }

        /* table items */

        table.inventory {
            clear: both;
            width: 100%;
        }

        table.inventory th {
            font-weight: bold;
            text-align: center;
        }

        table.inventory td:nth-child(1) {
            width: 26%;
        }

        table.inventory td:nth-child(2) {
            width: 38%;
        }

        table.inventory td:nth-child(3) {
            text-align: right;
            width: 12%;
        }

        table.inventory td:nth-child(4) {
            text-align: right;
            width: 12%;
        }

        table.inventory td:nth-child(5) {
            text-align: right;
            width: 12%;
        }

        /* table balance */

        table.balance th,
        table.balance td {
            width: 50%;
        }

        table.balance td {
            text-align: right;
        }

        /* aside */

        aside h1 {
            border: none;
            border-width: 0 0 1px;
            margin: 0 0 1em;
        }

        aside h1 {
            border-color: #999;
            border-bottom-style: solid;
        }

        /* javascript */

        .add,
        .cut {
            border-width: 1px;
            display: block;
            font-size: .8rem;
            padding: 0.25em 0.5em;
            float: left;
            text-align: center;
            width: 0.6em;
        }

        .add,
        .cut {
            background: #9AF;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
            background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
            border-radius: 0.5em;
            border-color: #0076A3;
            color: #FFF;
            cursor: pointer;
            font-weight: bold;
            text-shadow: 0 -1px 2px rgba(0, 0, 0, 0.333);
        }

        .add {
            margin: -2.5em 0 0;
        }

        .add:hover {
            background: #00ADEE;
        }

        .cut {
            opacity: 0;
            position: absolute;
            top: 0;
            left: -1.5em;
        }

        .cut {
            --webkit-transition: opacity 100ms ease-in;
        }

        tr:hover .cut {
            opacity: 1;
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }

            html {
                background: none;
                padding: 0;
            }

            body {
                box-shadow: none;
                margin: 0;
            }

            span:empty {
                display: none;
            }

            .add,
            .cut {
                display: none;
            }

            body {
                -webkit-print-color-adjust: exact;
            }

            /* กำหนดให้สีในหน้าเว็บสามารถพิมพ์ได้อย่างถูกต้อง*/
            .hideWhenPrint {
                /* เนื้อหาในคลาส hideWhenPrint จะถูกปิดตาทิ้งไปเมื่อพิมพ์บนกระดาษ*/
                display: none;
            }
        }

        @page {
            margin: 0;
        }
    </style>
</head>

<body>
    <table border="0" cellpadding="" style="background-color:white">
        <tr>
            <td>
                <table style="border:0px solid black;background-color:white;padding: 3.81px;" width="100%">
                    <tr>
                        <td colspan="3">
                            <div style="float:right" class="font">ห้องพักหมายเลข <abbr title="">
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
                            <lable style="float:right" class="font"><abbr title=""><?php if ($user['rental_start_date'] == null or $user['rental_start_date'] == '0000-00-00') {
                                    echo ThDate();
                                } else {
                                    // echo thai_date($date)."<br>";
                                    $date_today = $d_start1 . "/" . $m_start1 . "/" . $y_start1;
                                    echo "วันที่ ".toDateThai( $date_today );
                                    
                                }; ?>&nbsp&nbsp&nbsp</abbr></lable>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">ข้าพเจ้า <abbr title="">&nbsp&nbsp&nbsp<?php echo $name[0] ?>&nbsp&nbsp&nbsp</abbr>
                            อายุ <abbr title="">&nbsp&nbsp&nbsp<?php echo $age ?>&nbsp&nbsp&nbsp</abbr>
                            โทร <abbr title="">&nbsp&nbsp&nbsp<?php echo $phone ?>&nbsp&nbsp&nbsp</abbr></td>
                    </tr>
                    <tr>
                        <td colspan="3">ที่อยู่ <abbr title="">&nbsp&nbsp&nbsp ตำบล.<?php echo $provin['nameD'] ?>&nbsp&nbsp&nbsp
                                <abbr title="">&nbsp อำเภอ. <?php echo $provin['nameA'] ?>&nbsp
                                    <abbr title="">&nbsp จังหวัด. <?php echo $provin['nameP'] ?>&nbsp
                                        <abbr title="">&nbsp รหัสไปรษณีย์. <?php echo $provin['zip'] ?>&nbsp&nbsp&nbsp&nbsp
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">เลขที่บัตรประชาชน <abbr title="">&nbsp&nbsp&nbsp<?php echo base64_decode($id); ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>
                            สถาที่(ทำงาน/เรียน) .............................................................................................................</td>
                    </tr>
                    <tr>
                        <td colspan="3">เบอร์โทร ญาติที่ติดต่อได้
                            <?php if ($user['Parents_phone'] != null and $user['Parents_phone'] != "") {
                                echo "<abbr title=''>&nbsp&nbsp&nbsp" . $user['Parents_phone'] . "&nbsp&nbsp&nbsp</abbr>";
                            } else echo "........................................."; ?>
                            มีความสัมพันธ์เป็น ............................
                            ชื่อ-สกุล .......................................................</td>
                    </tr>
                    <tr>
                        <td colspan="3">ตกลงทำสัญญาขอเช่าห้องพักหมายเลข <abbr title="">&nbsp&nbsp&nbsp<?php echo $room ?>&nbsp&nbsp&nbsp</abbr>
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
                <td colspan="3">ข้าพเจ้า <abbr title="">&nbsp&nbsp&nbsp<?php echo $nameB[0] ?>&nbsp&nbsp&nbsp</abbr>
                    อายุ <abbr title="">&nbsp&nbsp&nbsp<?php echo $age_array ?>&nbsp&nbsp&nbsp</abbr>
                    โทร <abbr title="">&nbsp&nbsp&nbsp<?php echo $phone2 ?>&nbsp&nbsp&nbsp</abbr></td>
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
                <td colspan="3">เลขที่บัตรประชาชน <abbr title="">&nbsp&nbsp&nbsp<?php echo base64_decode($id2); ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>
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
                <td>(<abbr title="">&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $nameB[0] ?>&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>)</td>
                <td colspan="2" style="float:right">(<abbr title="">&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $name[0] ?>&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>)</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="float:right"><br>ลงชื่อ......................................ผู้ให้เช่า</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="float:right">(<abbr title="">&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $_SESSION['prefix_name_A'] . " " . $_SESSION['fname_A'] . " " . $_SESSION['lname_A']; ?>&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>)</td>
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
                <td colspan="2" style="float:right">(<abbr title="">&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $name[0] ?>&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>)</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="float:right"><br>ลงชื่อ......................................ผู้ให้เช่า</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="float:right">(<abbr title="">&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $_SESSION['prefix_name_A'] . " " . $_SESSION['fname_A'] . " " . $_SESSION['lname_A']; ?>&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>)</td>
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
    <a href="user.php"><button class="hideWhenPrint button">กลับหน้าหลัก</button></a>
    <a href="print.php?lease=<?php echo $id ?>"><button class="hideWhenPrint print2">ดาวน์โหลด Word</button></a>
    <button style="margin:30px;" class="hideWhenPrint print" onclick="window.print()">พิมพ์ PDF</button>

</body>

</html>

<?php

ob_end_flush();

?>