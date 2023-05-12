<?php
if (!isset($_SESSION)) {
    session_start();
}

    
if(!isset($_SESSION['premission']) == "Admin" or !isset($_SESSION['premission']) == "Member")
{
    session_destroy();
    header("location: ../index.php");
}
include '../server.php';
$personal = $_SESSION['personal'];

/*ผู้ใช้ */
$urd1 = mysqli_query($con, "SELECT room_details.reservation, user.room FROM user INNER JOIN room ON(user.room = room.room) INNER JOIN room_details ON(room.type = room_details.id) WHERE personal = '$personal' AND room_details.reservation = '2'");
$user2 = mysqli_fetch_array($urd1);

    $Header =mysqli_query($con,"SELECT * FROM paper_details ");
    $hd = mysqli_fetch_array($Header);

    $head = $hd['header']
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo $hd['header']?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">


    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../css/style.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap"
        rel="stylesheet">

</head>
<style>
@import url("https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap");

* {
    box-sizing: border-box;
    font-family: 'Prompt', sans-serif;
    font-weight: bold;
}

body {
    background: #f9f9f9;
    font-family: "Roboto", sans-serif;
}

.shadow {
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
}

.profile-tab-nav {
    min-width: 250px;
}

.tab-content {
    flex: 1;
}

.form-group {
    margin-bottom: 1.5rem;
}





@import url("https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap");

body {
    background: #f9f9f9;
    font-family: "Roboto", sans-serif;
}

.shadow {
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
}

.profile-tab-nav {
    min-width: 250px;
}

.tab-content {
    flex: 1;
}

.form-group {
    margin-bottom: 1.5rem;
}

.nav-pills a.nav-link {
    padding: 15px 20px;
    border-bottom: 1px solid #ddd;
    border-radius: 0;
    color: #333;
}

.nav-pills a.nav-link i {
    width: 20px;
}

.img-circle img {
    height: 100px;
    width: 100px;
    border-radius: 100%;
    border: 5px solid #fff;
}

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
    border-width: 1px;
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
}


@page {
    margin: 0;
}
</style>


<body style="background-color: #DCDCDC;">
    <header id="header" class="fixed-top hideWhenPrint print">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="../homepage_log.php"><?php echo $head ?></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="" href="../homepage_log.php">หน้าหลัก</a></li>
                    <li class="dropdown"><a href="#"><span>จองห้องพัก</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="roomDay_log.php">รายวัน</a></li>
                            <li><a href="roomMonth_log.php">รายเดือน</a></li>
                        </ul>
                    </li>


                    <?php if (!isset($_SESSION['personal'])) : ?>
                    <li><a class="getstarted scrollto" href="login.php">Login</a></li>
                    <?php endif ?>

                    <?php if (isset($_SESSION['personal'])) : ?>

                    <li class="dropdown"><a href="#" class="nav-link scrollto active"><i
                                class="bi bi-person"></i><?php echo $_SESSION['fname']; ?>( ผู้ใช้ )<i
                                class="bi bi-chevron-down"></i></a></a>
                        <ul>
                            <li><a href="profile1.php" class="nav-link scrollto active">ข้อมูลส่วนตัว</a></li>
                            <li><a href="myreservation.php">การจองของฉัน</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a href="../logout.php" onclick="return confirm('ยืนยันการออกจากระบบ')">ออกจากระบบ</a>
                            </li>
                        </ul>
                    </li>
                    <?php endif ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>

            </nav><!-- .navbar -->

        </div>
    </header>
    <section class="py-5 my-5">

        <?php

        $qry = $con->query("SELECT * FROM user INNER JOIN districts ON(user.districts = districts.id) INNER JOIN amphures ON(districts.amphure_id = amphures.id) INNER JOIN provinces ON(amphures.province_id = provinces.id) WHERE user.personal =  '$personal'");
        while ($row = $qry->fetch_assoc()) :
            
            $sql = "SELECT districts.name_th AS dname, amphures.name_th AS aname, provinces.name_th AS pname FROM user INNER JOIN districts ON(user.districts = districts.id) INNER JOIN amphures ON(districts.amphure_id = amphures.id) INNER JOIN provinces ON(amphures.province_id = provinces.id) WHERE user.personal =  '$personal'";
            $type = mysqli_query($con, $sql);
            $rowc = mysqli_fetch_array($type);
            /*ค้นหาห้อง */
            $sql1 = "SELECT room_type.name AS tname,room_category.name AS cname,room_picture.room_picture,room_details.reservation,bed_type.name AS bname,bed_type.detal,room_details.price, user.room FROM user INNER JOIN room ON(user.room = room.room) INNER JOIN room_details ON(room.type = room_details.id) INNER JOIN room_type ON(room_details.type = room_type.id) INNER JOIN bed_type ON(room_details.bed = bed_type.id) INNER JOIN picture_details ON(room_type.id = picture_details.id_type) INNER JOIN room_picture ON(picture_details.picture = room_picture.id) INNER JOIN room_category ON(room_details.reservation = room_category.id) WHERE user.personal = '$personal';";
            $type1 = mysqli_query($con, $sql1);
            $rowr = mysqli_fetch_array($type1);
            
            list($y, $m, $d) = explode('-', $row['dob']);

            $personal2 = mysqli_real_escape_string($con, $personal);

            $personal3 = base64_encode($personal);
        ?>
        <div class="container">
            <div class="bg-white shadow rounded-lg d-block d-sm-flex">
                <div class="profile-tab-nav border-right hideWhenPrint print">
                    <div class="p-4">
                        <div class="img-circle text-center mb-3">
                            <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" alt="Image" class="shadow">
                        </div>
                        <h5 class="text-center">
                            <?php echo $row['prefix_name'] . "" . $row['fname'] . " " . $row['lname'] ?></h5>
                    </div>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab"
                            aria-controls="account" aria-selected="true">
                            <i class="bi bi-house-door-fill text-center mr-1"></i>
                            บัญชี
                        </a>
                        <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab"
                            aria-controls="password" aria-selected="false">
                            <i class="i bi-key-fill text-center mr-1"></i>
                            รหัสผ่าน
                        </a>
                        <?php if (isset($user2['reservation']) != NULL) : ?>
                        <a class="nav-link" id="security-tab" data-toggle="pill" href="#security" role="tab"
                            aria-controls="security" aria-selected="false">
                            <i class="bi bi-receipt text-center mr-1"></i>
                            ใบเสร็จค่าเช่าล่าสุด
                        </a>

                        <a class="nav-link" id="application-tab" data-toggle="pill" href="#application" role="tab"
                            aria-controls="application" aria-selected="false">
                            <i class="bi bi-clock-fill text-center mr-1"></i>
                            ประวัติใบเสร็จค่าเช่าห้อง
                        </a>
                        <a class="nav-link" href="lease.php">
                            <i class="bi bi-journal-text text-center mr-1"></i>
                            สัญญาเช่า
                        </a>
                        <?php endif ?>
                    </div>
                </div>
                <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">

                    <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                        <form method="post">
                            <h3 class="mb-4">ข้อมูลส่วนตัว</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ชื่อ-นามสกุล</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="<?php echo $row['prefix_name'] . "" . $row['fname'] . " " . $row['lname'] ?>"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>เพศ</label>
                                        <input type="text" class="form-control" name="sex" id="sex"
                                            value="<?php echo $row['sex'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ห้อง</label>
                                        <?php if ($row['room'] == NULL) : ?>
                                        <input type="text" class="form-control" name="room" id="room" value="ไม่มี"
                                            disabled>
                                        <?php endif ?>
                                        <?php if ($row['room'] != NULL) : ?>
                                        <input type="text" class="form-control" name="room" id="room"
                                            value="<?php echo $row['room'] ?>" disabled>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>วันเกิด</label>
                                        <input type="text" class="form-control" name="dob" id="dob"
                                            value="<?php echo $d . '/' . $m . '/' .date($y+543) ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>เบอร์โทร</label>
                                        <input type="text" class="form-control" name="phone1" id="phone"
                                            value="<?php echo $row['phone'] ?>" maxlength=10 minlength=10>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ไลน์</label>
                                        <input type="text" class="form-control" name="line1" id="line"
                                            value="<?php echo $row['line'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ที่อยู่</label>
                                        <input type="text" class="form-control" name="address" id="address"
                                            value="บ้านเลขที่ <?php echo $row['home_number'] ?> หมู่ที่ <?php echo $row['village'] ?> ถนน  <?php echo $row['road'] ?>"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ตําบล/แขวง</label>
                                        <input type="text" class="form-control" name="districts" id="districts"
                                            value="<?php echo $rowc['dname'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>อําเภอ/เขต</label>
                                        <input type="text" class="form-control" name="amphures" id="amphures"
                                            value="<?php echo $rowc['aname'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>จังหวัด</label>
                                        <input type="text" class="form-control" name="provinces" id="provinces"
                                            value="<?php echo $rowc['pname'] ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit" name="submit1">บันทึก</button>
                                <button class="btn btn-light" type="reset">ยกเลิก</button>
                            </div>
                    </div>
                    </form>
                    <?php endwhile ?>

                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                        <form method="POST">
                            <h3 class="mb-4">แก้ไขรหัสผ่าน</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>รหัสผ่านเดิม</label>
                                        <input type="password" class="form-control" id="oldpassword" name="oldpassword"
                                            required minlength="8" maxlength="30">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>รหัสผ่านใหม่</label>
                                        <input type="password" class="form-control" id="newpassword1"
                                            name="newpassword1" required minlength="8" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ยืนยันรหัสผ่านใหม่</label>
                                        <input type="password" class="form-control" id="newpassword2"
                                            name="newpassword2" required minlength="8" maxlength="30">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary" name="Seve">บันทึก</button>
                                <button class="btn btn-light" type="reset">ยกเลิก</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                        <?php
                        /*ผู้ใช้ */
                        $urd1 = mysqli_query($con, "SELECT * FROM user INNER JOIN room ON(user.room = room.room) INNER JOIN room_details ON(room.type = room_details.id) WHERE personal = '$personal' AND room_details.reservation = '2'");
                        $user2 = mysqli_fetch_array($urd1);
                        $room = $user2['room'];
                        $reservation = $user2['reservation'];

                        function DateThai($strDate)
                        {
                            $strYear = date("Y", strtotime($strDate)) + 543;
                            $strMonth = date("n", strtotime($strDate));
                            $strDay = date("j", strtotime($strDate));
                            $strHour = date("H", strtotime($strDate));
                            $strMinute = date("i", strtotime($strDate));
                            $strSeconds = date("s", strtotime($strDate));
                            $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
                            $strMonthThai = $strMonthCut[$strMonth];
                            return "$strMonthThai $strYear ";
                        }

                        function DateThai2($strDate)
                        {
                            $strYear = date("Y", strtotime($strDate)) + 543;
                            $strMonth = date("n", strtotime($strDate));
                            $strDay = date("j", strtotime($strDate));
                            $strHour = date("H", strtotime($strDate));
                            $strMinute = date("i", strtotime($strDate));
                            $strSeconds = date("s", strtotime($strDate));
                            $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
                            $strMonthThai = $strMonthCut[$strMonth];
                            return "$strDay $strMonthThai $strYear ";
                        }

                        ob_start();

                        /*unit*/
                        $un = mysqli_query($con, "SELECT * FROM room INNER JOIN unit ON(room.room = unit.room) INNER JOIN receipt ON(room.room = receipt.room)  WHERE room.room = '$room' ORDER BY receipt.pay_id DESC LIMIT 1");
                        $unit = mysqli_fetch_array($un);


                        $rec = mysqli_query($con, "SELECT *  FROM receipt WHERE room = '$room' ORDER BY receipt.pay_id DESC LIMIT 1");
                        while ($receipt = mysqli_fetch_array($rec)) {
                            $date = $receipt['date'];
                            $pay_id = $receipt['pay_id'];

                            $datep = date('Y-m-d');
                        }

                        $re = mysqli_query($con, "SELECT * FROM `paper_details`");

                        while ($row = mysqli_fetch_array($re)) {
                            $header = $row['header'];
                            $address = $row['address'];
                            $phone_own = $row['phone_lessor'];
                        }


                        $findit = "SELECT * FROM room INNER JOIN unit ON(room.room = unit.room) INNER JOIN 
                        receipt ON(unit.room = receipt.room AND unit.date = receipt.date) INNER JOIN room_details ON(room.type = room_details.id) 
                        INNER JOIN user ON(user.room = receipt.room)  WHERE room.room = '$room' AND 
                        receipt.date > user.rental_start_date  ORDER BY receipt.pay_id DESC LIMIT 1";
                        $find = $con->query($findit);

    

                        function DateDiff($strDate1, $strDate2)
                        {
                            return (strtotime($strDate2) - strtotime($strDate1)) /  (60 * 60 * 24);  // 1 day = 60*60*24
                        }
                        function TimeDiff($strTime1, $strTime2)
                        {
                            return (strtotime($strTime2) - strtotime($strTime1)) /  (60 * 60); // 1 Hour =  60*60
                        }
                        function DateTimeDiff($strDateTime1, $strDateTime2)
                        {
                            return (strtotime($strDateTime2) - strtotime($strDateTime1)) /  (60 * 60); // 1 Hour =  60*60
                        }

                        ?>

                        <div class="timeline ">

                            <div class="timeline__group ">
                                <div class="timeline__cards ">
                                    <div class="timeline__card card ">
                                        <?php if (mysqli_num_rows($find) != 0) : ?>
                                        <?php while ($findtoo = $find->fetch_assoc()) : 
                                                $his1 = mysqli_query($con, " SELECT * FROM room INNER JOIN unit ON(room.room = unit.room) INNER JOIN receipt ON(unit.room = receipt.room 
                                                AND unit.date = receipt.date) INNER JOIN room_details ON(room.type = room_details.id) INNER JOIN user ON(user.room = receipt.room)  WHERE room.room = '$room' AND  unit.date NOT IN 
                                                 ('$findtoo[date]') GROUP BY receipt.date ORDER BY receipt.date DESC LIMIT 1 ");
                                                $history = mysqli_fetch_array($his1);

                                                $ot = mysqli_query($con, " SELECT  receipt.pay_id,unit.other FROM room INNER JOIN unit ON(room.room = unit.room) INNER JOIN receipt ON(unit.room = receipt.room 
                                                AND unit.date = receipt.date) INNER JOIN room_details ON(room.type = room_details.id) INNER JOIN user ON(user.room = receipt.room)  WHERE room.room = '$room' AND  unit.date IN 
                                                 ('$findtoo[date]') GROUP BY receipt.date ORDER BY receipt.date DESC LIMIT 1 ");
                                                $other23 = mysqli_fetch_array($ot);

                                            ?>
                                        <table border="1" width="100%">
                                            <tr>
                                                <td width="70%" colspan="3">
                                                    <h2><?php echo $header; ?></h2>
                                                    ที่อยู่. <lable><?php echo $address ?></lable><br>
                                                    โทร. <lable><?php echo $phone_own; ?></lable>
                                                </td>

                                                <td colspan="2">
                                                    <h3>ใบแจ้งหนี้/ใบเสร็จ</h3>
                                                    <div>เลขใบเสร็จ(Doc No.): <?php echo $findtoo['pay_id']; ?></div>
                                                    <lable>วันที่ออกใบเสร็จ(Date):
                                                        <?php list($yr,$mr,$dr) = explode('-', $findtoo['date']); echo $dr . '/' . $mr . '/' . date($yr+543);?>
                                                    </lable>
                                                    <div>ช่วงวันที่จดมิตเตอร์:
                                                        <?php list($yo,$mo,$do) = explode('-', $history['date']); echo $do . '/' . $mo . '/' . date($yo+543);?>
                                                        ถึง
                                                        <?php list($yf,$mf,$df) = explode('-', $findtoo['date']); echo $df . '/' . $mf . '/' . date($yf+543);?>
                                                    </div>
                                                    <div>สถานะการชำระเงิน:
                                                        <?php if($findtoo['payRent'] == '1' ) :?>
                                                        ชำระแล้ว
                                                        <?php endif ?>
                                                        <?php if($findtoo['payRent'] == '0' ) :?>
                                                        ยังไม่ชำระ
                                                        <?php endif ?>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <?php
                                                            $userid = mysqli_query($con, "SELECT * FROM user INNER JOIN room on(user.room = room.room) INNER JOIN room_details on(room_details.id = room.type) WHERE room.room = '$room' ");
                                                            while ($user = mysqli_fetch_array($userid)) {
                                                                echo "<div>ชื่อ-สกุล: " . $user['prefix_name'] . " " . $user['fname'] . " " . $user['lname'] . "</div>";
                                                            }
                                                            ?>
                                                </td>
                                                <td colspan="2">
                                                    <h5>ห้อง(Room No.): <lable style="float:right">
                                                            <?php echo $room; ?></lable>
                                                    </h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="5%" style="text-align:center;">ลำดับ</th>
                                                <th style="text-align:center;">รายการ</th>
                                                <th style="text-align:center;"><span>จำนวนหน่วย</span></th>
                                                <th style="text-align:center;"><span>ราคาต่อหน่วย</span></th>
                                                <th style="text-align:center;"><span>จำนวนเงิน</span></th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>ค่าเช่าห้องพัก(Room Rate)</td>
                                                <td></td>
                                                <td style="text-align: right">
                                                    <?php echo number_format($findtoo['price'], 2)  ?></td>
                                                <td style="text-align: right">
                                                    <?php echo number_format($findtoo['price'], 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>ค่ากระแสไฟฟ้า(Electrictiy Charge)</td>
                                                <td style="text-align: right">
                                                    <?php echo number_format($findtoo['last_unit_electricity'] - $history['last_unit_electricity'], 2) ?>
                                                </td>
                                                <td style="text-align: right">
                                                    <?php echo number_format($findtoo['unitPerElectricity'], 2)  ?></td>
                                                <td style="text-align: right"><?php $sumElectricity = ($findtoo['last_unit_electricity'] - $history['last_unit_electricity']) * $findtoo['unitPerElectricity'];
                                                            echo number_format($sumElectricity, 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>&nbsp&nbsp&nbsp เลขมิเตอร์เก่า(Pervious Charge)</td>
                                                <td style="text-align: left">
                                                    <?php echo number_format($history['last_unit_electricity'], 2)  ?>
                                                </td>
                                                <td><?php ?></td>
                                                <td><?php  ?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>&nbsp&nbsp&nbsp เลขมิเตอร์ใหม่(Current Charge)</td>
                                                <td style="text-align: left">
                                                    <?php echo number_format($findtoo['last_unit_electricity'], 2)  ?>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>ค่าน้ำประปา (Tab Water Charge)</td>
                                                <td style="text-align: right">
                                                    <?php echo number_format($findtoo['last_unit_water'] - $history['last_unit_water'], 2)  ?>
                                                </td>
                                                <td style="text-align: right">
                                                    <?php echo number_format($findtoo['unitPerWater'], 2) ?></td>
                                                <td style="text-align: right"><?php $sumWater = ($findtoo['last_unit_water'] - $history['last_unit_water']) * $findtoo['unitPerWater'];
                                                            echo number_format($sumWater, 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>&nbsp&nbsp&nbsp เลขมิเตอร์เก่า(Pervious Charge)</td>
                                                <td style="text-align: left">
                                                    <?php echo number_format($history['last_unit_water'], 2)  ?>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>&nbsp&nbsp&nbsp เลขมิเตอร์ใหม่(Current Charge)</td>
                                                <td style="text-align: left">
                                                    <?php echo number_format($findtoo['last_unit_water'], 2)  ?>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>ค่าอื่นๆ (Other Charge)</td>
                                                <td></td>

                                                <?php $other = $other23['other'];?>
                                                <td style="text-align:right;">
                                                    <?php echo number_format( $other23['other'] , 2 );?></td>
                                                <td style="text-align:right;"><?php echo number_format( $other , 2 );?>
                                                </td>

                                            </tr>
                                            <!-- <tr>
                                                <td>5</td>
                                                <td>ค่าปรับ (Charge)</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> -->
                                            <tr>
                                                <td colspan="3"></td>
                                                <td>ยอดรวมทั้งสิ้น</td>
                                                <td style="text-align: right"><?php $sum = $findtoo['price'] + $sumElectricity + $sumWater;
                                                            echo number_format($sum, 2) ?></td>
                                            </tr>
                                        </table>
                                        <br>
                                        <table border="0">
                                            <tr>
                                                <td>ลงนาม…..........................................(ผู้จ่ายเงิน)</td>
                                                <td style="text-align:right">
                                                    ลงนาม…….......................................(ผู้รับเงิน)</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="color:red"><?php echo $findtoo['note']  ?>
                                                </td>
                                            </tr>
                                        </table>
                                        <button style="margin:20px auto;float:right" class="hideWhenPrint print"
                                            onclick="window.print()">พิมพ์ PDF</button>
                                        <?php endwhile ?>
                                        <?php endif ?>

                                        <?php if (mysqli_num_rows($find) == 0) : ?>
                                        <h1 style="margin-top: 80px; color:#DC143C;text-align: center;">
                                            ยังไม่มีใบเสร็จค่าเช่า<i class="bi bi-receipt"></i>
                                        </h1>
                                        <?php endif ?>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="tab-pane fade" id="application" role="tabpanel" aria-labelledby="application-tab">
                        <div>

                            <?php  $his = mysqli_query($con, "SELECT * FROM receipt INNER JOIN user
                             ON(receipt.room = user.room) WHERE user.room = '$room' 
                             AND pay_id NOT IN ( SELECT MAX(pay_id) FROM receipt WHERE room = '$room' )
                             AND receipt.date > user.rental_start_date 
                             GROUP BY EXTRACT(year FROM date);");    
                            ?>


                            <select name='sY1' id='sY1' class="hideWhenPrint print">
                                <option value="vang">-เลือกปี-</option>

                                <?php
                                while ($rec = $his->fetch_assoc()) : 
                                    list($y,$m,$d) = explode('-', $rec['date']);
                                ?>
                                <option value="<?php echo $y ?>">ปี<?php echo date($y+543) ?>
                                </option>

                                <?php endwhile ?>
                            </select>

                            <select id="reid" style="display: none;" class="hideWhenPrint print">

                            </select>

                            <div id="txtHint">

                            </div>



                        </div>
                    </div>

    </section>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
    // function showy(str) {
    //     var xhttp;
    //     if (str == "") {
    //         document.getElementById("reid").innerHTML = "";
    //         return;
    //     }
    //     xhttp = new XMLHttpRequest();
    //     xhttp.onreadystatechange = function() {
    //         if (this.readyState == 4 && this.status == 200) {
    //             document.getElementById("reid").innerHTML = this.responseText;
    //         }
    //     };
    //     xhttp.open("GET", "ajax.php?y=" + str, true);
    //     xhttp.send();
    // }

    // function showCustomer(str) {
    //     var xhttp;
    //     if (str == "") {
    //         document.getElementById("txtHint").innerHTML = "";
    //         return;
    //     }
    //     xhttp = new XMLHttpRequest();
    //     xhttp.onreadystatechange = function() {
    //         if (this.readyState == 4 && this.status == 200) {
    //             document.getElementById("txtHint").innerHTML = this.responseText;
    //         }
    //     };
    //     xhttp.open("GET", "ajax.php?q=" + str, true);
    //     xhttp.send();
    // }

    $(function() {
        var year = $('#sY1');
        var month = $('#reid');
        var districtObject = $('#district');

        year.on('change', function() {
            var year = $(this).val();

            month.html('<option value="">เลือกเดือน</option>');

            $.get('ajaxYear.php?year=' + year, function(data) {
                var result = JSON.parse(data);

                $.each(result, function(index, item) {
                    var date = (item.date).split("-");
                    month.append(
                        $('<option>เลือกเดือน</option>').val(item
                            .date).html(date[1])
                    );
                });
            });
        });
    });

    $(function() {
        $("#sY1").change(function() {
            if ($(this).val() == "vang") {
                $("#reid").hide();

            } else {
                $("#reid").show();

            }
        });
    });
    // function showyear(str) {
    //     var xhttp2;
    //     if (str == "") {
    //         document.getElementById("reid").innerHTML = "";
    //         return;
    //     }
    //     xhttp2 = new XMLHttpRequest();
    //     xhttp2.onreadystatechange = function() {
    //         if (this.readyState == 4 && this.status == 200) {
    //             document.getElementById("reid").innerHTML = this.responseText;
    //         }
    //     };
    //     xhttp2.open("GET", "ajax.php?y=" + str, true);
    //     xhttp2.send();
    // }


    $(document).ready(function() {
        $('#reid').on('change', function() {
            var reid = $(this).val();
            if (reid) {
                $.ajax({
                    type: 'GET',
                    url: 'ajaxMonth.php',
                    data: 'reid=' + reid,
                    success: function(html) {
                        $('#txtHint').html(html);

                    }
                });
            } else {
                $('#txtHint').html('<div></div>');
            }
        });
    });
    </script>

</body>

</html>

<!-- Vendor JS Files -->
<script src="../assets/vendor/aos/aos.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>
<script src="../assets/vendor/purecounter/purecounter.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>
<script src="../assets/jquery.min.js"></script>
<script src="../assets/script.js"></script>
<?php


date_default_timezone_set('asia/bangkok');
$datelog = date("Y-m-d");
$timelog = date("H:i:s");



if (isset($_POST['Seve'])) {

    $passwordold = md5($_POST['oldpassword']);
    $passwordnew1 = md5($_POST['newpassword1']);
    $passwordnew2 = md5($_POST['newpassword2']);


    $sql12 = $con->query("SELECT * from user where personal='$personal'");
    while ($pass = $sql12->fetch_assoc()) {
        $psold = $pass['password'];
    }

    if ($psold != $passwordold)
        die("<script>
                    alert('รหัสผ่านเดิมไม่ถูกต้อง');
                    history.back();
                 </script>");

    // 2.2 password = repassword
    if ($passwordnew1 != $passwordnew2)
        die("<script>
                    alert('รหัสผ่านใหม่ไม่ตรงกัน');
                    history.back();
                 </script>");

    $newUser = "UPDATE user SET password ='$passwordnew1' WHERE personal = '$personal'";
    if (mysqli_query($con, $newUser)) {

        $sqlie = "INSERT INTO event_log (personal,date,time,event) 
        VALUES ('" . $_SESSION['personal'] . "','$datelog','$timelog','" . $_SESSION['fname'] . " " . $_SESSION['lname'] . " แก้ไขรหัสผ่านตนเอง ')";
        mysqli_query($con, $sqlie);

        echo "<script type='text/javascript'> alert('แก้ไขรหัสผ่านเสร็จสิ้น')</script>";
        echo "<script>window.location = '../login.php'</script>";
    } else {
    }
} else if (isset($_POST['submit1'])) {

    $newUser1 = "UPDATE user SET phone='$_POST[phone1]', line = '$_POST[line1]' WHERE personal = '$personal'";
    if (mysqli_query($con, $newUser1)) {

        
        $sqlie = "INSERT INTO event_log (personal,date,time,event) 
        VALUES ('" . $_SESSION['personal'] . "','$datelog','$timelog','" . $_SESSION['fname'] . " " . $_SESSION['lname'] . " แก้ไขเบอร์โทร หรือ ไลน์ ')";
        mysqli_query($con, $sqlie);
        
    

        echo "<script type='text/javascript'> alert('แก้ไขข้อมูลเสร็จสิ้น')</script>";
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=profile1.php\">";
    }
}

?>