<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include 'server.php';

?>
<?php
$prefix_name = $_GET['prefix_name'];
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$phone = $_GET['phone'];
$rid = $_GET['rid'];
$category = $_GET['category'];
$rtype = $_GET['rtype'];
$CheckIn = $_GET['Check-In'];

$room_count = $_GET['room_count'];

$bname = $_GET['bname'];
$tcar = $_GET['tcar'];
$ccar = $_GET['ccar'];
$license_plate = $_GET['license_plate'];
?>
<?php 
    $Header =mysqli_query($con,"SELECT * FROM paper_details ");
    $hd = mysqli_fetch_array($Header);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $hd['header']?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/icon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="css/style.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>

    <!-- =======================================================
  * Template Name: OnePage - v4.3.0
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap"
        rel="stylesheet">

</head>

<style>
@media screen and (max-width:550px) {
    div {
        font-size: 13px;
    }

    .font {
        font-size: 15px;
    }
}

* {
    box-sizing: border-box;
    font-family: 'Prompt', sans-serif;
    font-weight: bold;
}

.row>.column {
    padding: 0 8px;
}

.row:after {
    content: "";
    display: table;
    clear: both;
}

.column {
    float: left;
    width: 25%;
}

/* The Modal (background) */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: black;
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    width: 90%;
    max-width: 1200px;
}

/* The Close Button */
.close {
    color: white;
    position: absolute;
    top: 10px;
    right: 25px;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #999;
    text-decoration: none;
    cursor: pointer;
}

.mySlides {
    display: none;
}

.cursor {
    cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    padding: 16px;
    margin-top: -50px;
    color: white;
    font-weight: bold;
    font-size: 20px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
    -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
    right: 0;
    border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
    color: #f2f2f2;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    top: 0;
}

img {
    margin-bottom: -4px;
}

.caption-container {
    text-align: center;
    background-color: black;
    padding: 2px 16px;
    color: white;
}

.demo {
    opacity: 0.6;
}

.active,
.demo:hover {
    opacity: 1;
}

img.hover-shadow {
    transition: 0.3s;
}

.hover-shadow:hover {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.font1 {
    font-family: supermarket;
}

/* style จอง */
.form-style-10 {
    width: 60%;
    padding: 30px;
    margin: 40px auto;
    background: #FFF;
    border-radius: 10px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
    -moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
    -webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
}

.form-style-10 .inner-wrap {
    padding: 30px;
    background: #F8F8F8;
    border-radius: 6px;
    margin-bottom: 15px;
}

.form-style-10 h1 {
    background: #2A88AD;
    padding: 20px 30px 15px 30px;
    margin: -30px -30px 30px -30px;
    border-radius: 10px 10px 0 0;
    -webkit-border-radius: 10px 10px 0 0;
    -moz-border-radius: 10px 10px 0 0;
    color: #fff;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.12);
    font: normal 30px 'Bitter', serif;
    -moz-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
    -webkit-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
    box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
    border: 1px solid #257C9E;
}

.form-style-10 h1>span {
    display: block;
    margin-top: 2px;
    font: 13px Arial, Helvetica, sans-serif;
}

.form-style-10 label {
    display: block;
    font: 13px Arial, Helvetica, sans-serif;
    color: #888;
    margin-bottom: 15px;
}

.form-style-10 input[type="text"],
.form-style-10 input[type="date"],
.form-style-10 input[type="datetime"],
.form-style-10 input[type="email"],
.form-style-10 input[type="number"],
.form-style-10 input[type="search"],
.form-style-10 input[type="time"],
.form-style-10 input[type="url"],
.form-style-10 input[type="password"],
.form-style-10 textarea,
.form-style-10 select {
    display: block;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    width: 100%;
    padding: 8px;
    border-radius: 6px;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border: 2px solid #fff;
    box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.33);
    -moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.33);
    -webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.33);
}

.form-style-10 .section {
    font: normal 20px 'Bitter', serif;
    color: #2A88AD;
    margin-bottom: 5px;
}

.form-style-10 .section span {
    background: #2A88AD;
    padding: 5px 10px 5px 10px;
    position: absolute;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border: 4px solid #fff;
    font-size: 14px;
    margin-left: -45px;
    color: #fff;
    margin-top: -3px;
}

.form-style-10 input[type="button"],
.form-style-10 input[type="submit"] {
    background: #2A88AD;
    padding: 8px 20px 8px 20px;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    color: #fff;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.12);
    font: normal 30px 'Bitter', serif;
    -moz-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
    -webkit-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
    box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
    border: 1px solid #257C9E;
    font-size: 15px;
}

.form-style-10 input[type="button"]:hover,
.form-style-10 input[type="submit"]:hover {
    background: #2A6881;
    -moz-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.28);
    -webkit-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.28);
    box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.28);
}

.form-style-10 .privacy-policy {
    float: right;
    width: 250px;
    font: 12px Arial, Helvetica, sans-serif;
    color: #4D4D4D;
    margin-top: 10px;
    text-align: right;
}

.font {
    font-family: 'Prompt', sans-serif;
    font-weight: bold;
    border-radius: 5px;
    border: 1px solid black;
    background-color: #DCDCDC;
    padding: 3px 15px;
}
</style>

<body style="background-color:#708090;">

    <!-- ======= Script ห้ามคลุมดำ Ctrl A,C ======= -->
    <script language="JavaScript1.2">
    function disableselect(e) {
        return false
    }

    function reEnable() {
        return true
    }
    //if IE4+
    document.onselectstart = new Function("return false")
    //if NS6
    if (window.sidebar) {
        document.onmousedown = disableselect
        document.onclick = reEnable
    }

    //  Script ห้ามลากรูปภาพ 
    document.ondragstart = function() {
        return false;
    };
    </script>
    <!-- ======= end script ======= -->


    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="index.php"><?php echo $hd['header']?></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="index.php">หน้าหลัก</a></li>
                    <li class="dropdown"><a href="#"><span>จองห้องพัก</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="roomDay.php" class="dropdown-item">รายวัน</a></li>
                            <li><a href="roomMonth.php" class="dropdown-item">รายเดือน</a></li>
                        </ul>
                    </li>

                    <?php if (!isset($_SESSION['personal'])) : ?>
                    <li><a class="getstarted scrollto" href="login.php">เข้าสู่ระบบ</a></li>
                    <li><a class="getstarted scrollto" href="register.php">สมัครสมาชิก</a></li>
                    <?php endif ?>

                    <?php if (isset($_SESSION['personal'])) : ?>

                    <li class="nav-item dropdown"><a href="#" class="nav-link scrollto active"><i
                                class="bi bi-person"></i><?php echo $_SESSION['fname']; ?>( ผู้ใช้ )<i
                                class="bi bi-chevron-down"></i></a></a>
                        <ul>
                            <li><a class="dropdown-item" href="profile1.php">ข้อมูลส่วนตัว</a></li>
                            <li><a href="myreservation.php">การจองของฉัน</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a href="logout.php" class="dropdown-item"
                                    onclick="return confirm('ยืนยันการออกจากระบบ')">ออกจากระบบ</a></li>
                        </ul>
                    </li>
                    <?php endif ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>

            </nav><!-- .navbar -->
            <!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <br>

    <div class="form-style-10 w-75 ">
        <h1>ยืนยันจองห้อง <?php echo $category; ?><span></span></h1>
        <form method="post">
            <?php


            $sqlp = "SELECT * FROM `paper_details` WHERE 1";
            $sqp = mysqli_query($con, $sqlp);
            $rowp = mysqli_fetch_array($sqp);
            $check_in_time = $rowp['check_in_time'];
            $check_out_time = $rowp['check_out_time'];

            $qry = $con->query("SELECT room_details.id,room_details.floor,room_details.price,room_type.name 
            AS type_name,bed_type.name AS bname,bed_type.size,bed_type.detal,room_picture.room_picture,room_category.name
            AS cname,room_details.reservation,room_category.id AS cid,room_details.other FROM room_type INNER JOIN room_details
             ON(room_type.id = room_details.type) INNER JOIN bed_type ON(room_details.bed = bed_type.id) 
             INNER JOIN picture_details ON(room_details.id = picture_details.id_type) INNER JOIN room_picture
              ON(picture_details.picture = room_picture.id)INNER JOIN room_category ON(room_details.reservation = room_category.id) 
              WHERE room_details.id = '$rid' GROUP BY room_details.id");
            while ($row = $qry->fetch_assoc()) :
                $cid = $row['cid'];
                $other = $row['other'];

                if($row['reservation'] == 1) {
                        $CheckOut = $_GET['Check-Out'];
                        $calculate = strtotime("$CheckOut") - strtotime("$CheckIn");
                        $sumdate = floor($calculate / 86400);
                    
                } 
            ?>
            <?php
                function DateThai($strDate)
                {
                    $strYear = date("Y",strtotime($strDate))+543;
                    $strMonth= date("n",strtotime($strDate));
                    $strDay= date("j",strtotime($strDate));
                    $strHour= date("H",strtotime($strDate));
                    $strMinute= date("i",strtotime($strDate));
                    $strSeconds= date("s",strtotime($strDate));
                    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                    $strMonthThai=$strMonthCut[$strMonth];
                    return "$strDay $strMonthThai $strYear ";
                }

                function DateThai2($strDate)
                {
                    $strYear = date("Y",strtotime($strDate))+543;
                    $strMonth= date("n",strtotime($strDate));
                    $strDay= date("j",strtotime($strDate));
                    $strHour= date("H",strtotime($strDate));
                    $strMinute= date("i",strtotime($strDate));
                    $strSeconds= date("s",strtotime($strDate));
                    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                    $strMonthThai=$strMonthCut[$strMonth];
                    return "$strDay $strMonthThai $strYear $strHour $strMinute $strSeconds";
                }
                
            ?>

            <div class="panel-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td width="20%"></td>
                                <td width="60%"></td>

                            </tr>
                        </thead>
                        <tr>
                            <th>
                                <h4 class="font">คำอธิบาย</h4>
                            </th>
                            <th>
                                <h4 class="font">ข้อมูล</h4>
                            </th>

                        </tr>
                        <tr>
                            <th>ชื่อ</th>
                            <th><?php echo $prefix_name . $fname ?> <?php echo $lname; ?> </th>

                        </tr>
                        <tr>
                            <th>เบอร์โทร </th>
                            <th><?php echo $phone; ?></th>

                        </tr>
                        <tr>
                            <th>ยานพาหนะ </th>
                            <th>
                                <?php 
                                    if($tcar == null){
                                        echo "ไม่มี";
                                    }
                                    else echo $tcar." ".$ccar." ".$license_plate
                                    ?>
                            </th>

                        </tr>
                        <tr>
                            <th>ประเภทการจอง </th>
                            <th><?php echo $category; ?></th>

                        </tr>
                        <tr>
                            <th>รูป </th>
                            <th>
                                <img style="width: 50%;height: 50%;" class="img-fluid"
                                    src="assets/img/<?php echo $row['room_picture'] ?>" alt="">
                            </th>

                        </tr>
                        <tr>
                            <th>ประเภทห้อง </th>
                            <th><?php echo $rtype; ?></th>

                        </tr>
                        <tr>
                            <th>เตียง </th>
                            <th><?php echo $bname; ?></th>
                                   
                        </tr>
                        <?php if($row['reservation'] == 2): ?>
                        <tr>
                            <th>วันที่ เข้าอยู่ </th>
                            <th><?php echo DateThai($CheckIn) ; ?>
                            </th>

                        </tr>
                        <?php endif;?>
                        <?php if($row['reservation'] == 1): 
                                 
                                $sqlt ="SELECT room_details.price FROM room_type INNER JOIN room_details ON(room_type.id = room_details.type) INNER JOIN bed_type ON(room_details.bed = bed_type.id) INNER JOIN picture_details ON(room_details.id = picture_details.id_type) INNER JOIN room_picture ON(picture_details.picture = room_picture.id)INNER JOIN room_category ON(room_details.reservation = room_category.id) WHERE room_details.id = '$rid'";
                                $typet = mysqli_query($con,$sqlt);
                                $row1 = mysqli_fetch_array($typet); 
                                $price = $row1['price'];     
                                ?>
                        <tr>
                            <th>วันที่ เช็คอิน</th>
                            <th><?php echo DateThai($CheckIn) ; ?> เช็คอินได้ตั้งแต่ <?php echo $check_in_time ?> น.
                            </th>

                        </tr>
                        <tr>
                            <th>วันที่ เช็คเอาท์</th>
                            <th><?php echo DateThai($CheckOut); ?> เช็คเอาท์ได้ก่อน <?php echo $check_out_time ?> น.
                            </th>

                        </tr>
                        <tr>
                            <th>ราคา/คืน</th>
                            <th><?php echo number_format($price); ?> บาท</th>

                        </tr>
                        <tr>
                            <th>จำนวนคืน</th>
                            <th><?php echo $sumdate; ?> คืน</th>

                        </tr>
                        <tr>
                            <th>จำนวนห้อง</th>
                            <th><?php echo $room_count?> ห้อง</th>
                        </tr>
                        <tr>
                            <th>ค่าห้อง</th>
                            <th><?php $sum = $sumdate * $row['price']; echo number_format($sum*$room_count) ?> บาท</th>
                            <?php $sum_total = $sum*$room_count?>

                        </tr>
                        <tr>
                            <th>เงินประกัน</th>
                            <?php $sum_other = $other*$room_count?>
                            <th><?php echo number_format($sum_other) ?> บาท</th>

                        </tr>
                        <tr>
                            <th>รวม</th>
                            <th><?php $total = $sum_total+$sum_other; echo number_format($total) ?> บาท</th>
                        </tr>
                        <?php endif ?>
                        <?php if($row['reservation'] == 2): ?>
                        <tr>
                            <th>ราคา</th>
                            <th><?php $sum = $row['price']; echo number_format($sum) ?> บาท</th>
                        </tr>
                        <tr>
                            <th>เงินประกัน</th>
                            <th><?php echo number_format($other) ?> บาท</th>

                        </tr>
                        <tr>
                            <th>รวม</th>
                            <th><?php $total = $sum+$other; echo number_format($total) ?> บาท</th>
                        </tr>

                        <?php endif ?>
                        <?php
                            date_default_timezone_set('asia/bangkok');
                            $date = date("Y-m-d");
                            $time = date("H:i:s");

                            ?>
                    </table>
                    <div>

                        <label for="myCheck"><input type="checkbox" id="myCheck" onclick="myFunction()" class="rule"
                                required> ยอมรับข้อตกลงในการใช้บริการ<a href="#"
                                onclick="open_popup('rule.php')">อ่านกฏของหอพัก</a></label>

                        <lable id="text" style="display:none;color:green" class="rule_text">ยอมรับข้อตกลง</lable>
                        <script>
                        function open_popup(url) {
                            window.open(url, null, "height=700,width=500,status=yes,toolbar=no,menubar=no,location=no");
                        }
                        </script>
                    </div>
                </div>

            </div>
            <?php endwhile; ?>
            <div class="button-section" align="center">
                <input type="submit" name="submit" value="ยืนยันการจอง"
                    onClick="javascript:return confirm('ยืนยันการจองห้อง');" />
            </div>

        </form>

    </div>


    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/purecounter/purecounter.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script src="assets/js/check_box.js" type="text/javascript"></script>

</body>

</html>
<?php



if (isset($_POST['submit'])) {

    $sqlp22 = "SELECT room_details.id,room_details.floor,room_details.price,room_type.name 
    AS type_name,bed_type.name AS bname,bed_type.size,bed_type.detal,room_picture.room_picture,room_category.name 
    AS cname,room_details.reservation,room_category.id AS cid,room_details.other FROM room_type INNER JOIN 
    room_details ON(room_type.id = room_details.type) INNER JOIN bed_type ON(room_details.bed = bed_type.id)
     INNER JOIN picture_details ON(room_details.id = picture_details.id_type) INNER JOIN room_picture 
     ON(picture_details.picture = room_picture.id)INNER JOIN room_category ON(room_details.reservation = room_category.id)
      WHERE room_details.id = '$rid' GROUP BY room_details.id";
    $query11 = mysqli_query($con, $sqlp22);
    $resultre = mysqli_fetch_assoc($query11);

    
    list($d, $m, $y) = explode('-', $CheckIn);
    $check_in_re = $y . '-' . $m . '-' . $d ;
    
    list($d, $m, $y) = explode('-', $CheckOut);
    $check_out_re = $y . '-' . $m . '-' . $d ;

    $new = "รอชำระเงิน";
    if($resultre['reservation'] == "1"){

    $newUser = "INSERT INTO `reserve` (`prefix_name`,
     `fname`, `lname`, `phone`,`day_reserve`,
     `time_reserve`, `day_checkin`, `day_checkout`,
     `room_type`,`room_count`,`nodays`,`reserve_status`,`reservation_money`,`car`,`color`,`license_plate`,`pay`) 
    VALUES ('$prefix_name','$fname','$lname','$phone',
    '$date','$time','$check_in_re','$check_out_re',
    '$rid','$room_count', '$sumdate','$new','$total', '$tcar','$ccar','$license_plate','0')"; 
    }

    if($resultre['reservation'] == "2"){

        $newUser = "INSERT INTO `reserve` (`prefix_name`,
         `fname`, `lname`, `phone`,`day_reserve`,
         `time_reserve`, `day_checkin`,
         `room_type`,`room_count`,`reserve_status`,`reservation_money`,`car`,`color`,`license_plate`,`pay`) 
        VALUES ('$prefix_name','$fname','$lname','$phone',
        '$date','$time','$check_in_re',
        '$rid','1','$new','$total', '$tcar','$ccar','$license_plate','0')"; 
        }


    if (mysqli_query($con, $newUser)) {
        $pid = mysqli_insert_id($con);
        $payid = 'abcd'.base64_encode($pid);
        echo "<script type='text/javascript'> alert('การจองจะสำเร็จก็ต่อเมื่อท่านส่งสลิปการโอนมายังระบบ')</script>";
        echo "<script>window.location = 'payment.php?payid=".$payid."'</script>";

    } else {
        echo "<script type='text/javascript'> alert('เกิดข้อผิดพลาดในการจอง')</script>";
    }
}


$msg = "Your code is correct";


?>