<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
    
if(!isset($_SESSION['premission']) == "Admin" or !isset($_SESSION['premission']) == "Member")
{
    session_destroy();
    header("location: ../index.php");
}
include '../server.php';
$personal = $_SESSION['personal'];

?>
<?php if (isset($_GET['id']))
	$pid = $_GET['id'];
	$id = base64_decode( substr($pid,4));
?>
<?php 
    $Header =mysqli_query($con,"SELECT * FROM paper_details ");
    $hd = mysqli_fetch_array($Header);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $hd['header']?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/icon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">


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

    <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap"
        rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<style>
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

/*status */
@import url('https://fonts.googleapis.com/css?family=Lato:400,700|Space+Mono:700');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}



* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


html,
body {
    height: 100%;
    font-size: 16px;
    font-weight: 400;
}

body {
    padding: 0.5rem !important;
}

html,
body,
button,
input[type="text"] {
    font-family: font-txt;
}

.center-wrapper {
    padding: 0.5rem;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    min-height: 100%;
}

.content {
    margin: 0 auto;
    max-width: 800px;
    border: 1px solid yellow;
    background: white;
}

nav,
.top-bar,
.bag,
.bag-total,
.help {
    padding: 0.5rem 1rem;
}

nav,
a,
.btn-go-checkout {
    color: white;
}

nav {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-flow: row nowrap;
    flex-flow: row nowrap;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;

}

a {
    padding: 0.2rem 0.5rem;
    border: 2px solid white;
    text-decoration: none;
}

.logo {
    font-family: font-head;
}

.logo,
button {
    text-transform: uppercase;
}

.fa-search,
.fa-arrow-left,
.fa-lock {
    margin-right: 1rem;
}

.top-bar,
.bag-head::after,
.bag-total::before {
    background: whitesmoke;
}

.bag-head::after,
.bag-total::before,
.btn-remove {
    display: block;
}

.bag-head::after,
.bag-total::before,
.description-text,
.promo-checkbox {
    margin: 0.5rem 0;
}

.bag-head::after,
.bag-total::before {
    content: "";
    width: 100%;
    height: 3px;
}

.muted {
    color: grey;
}

.change-delivery,
::placeholder,
.product-code,
.help {
    font-size: small;
}

h1 {
    font-size: 1.6rem;
}

h2 {
    font-size: 1.4rem;
}

.image {
    width: 40%;

}

.description {
    padding-right: 1rem;
    width: 60%;
}

select {
    padding: 0.3rem;
    width: 60px;
}

select,
button,
input[type="text"] {
    height: 40px;
}

button {
    cursor: pointer;
    width: 100px;
    background: none;

    border-radius: 4px;
}



.quantity-wrapper {
    -webkit-box-align: start;
    -ms-flex-align: start;
    align-items: flex-start;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-flow: row wrap;
    flex-flow: row wrap;
    margin: 1rem 0 0.5rem;
}

select {
    width: 50px;
    margin-right: 1rem;
}

.bag-product,
.quantity-wrapper,
.subtotal,
.delivery,
.total,
.promo-code {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
}

.subtotal,
.delivery,
input[type="checkbox"],
.help {
    margin-bottom: 0.5rem;
}

.total {
    margin-bottom: 1rem;
}

button,



input[type="text"],
.btn-go-checkout {
    font-size: 1rem;
}

input[type="text"] {
    width: calc(100% - 100px - 1rem);
    padding: 0.5rem;
}

.btn-go-checkout {
    margin-top: 1rem;
    width: 90%;
    height: 40px;
    background: violet;
    box-shadow: 0 3px 6px 2px darken(whitesmoke, 10%);
    display: block;
    margin: auto;
}

.btnbank {

    height: 40px;
    background: red;
    box-shadow: 0 3px 6px 2px darken(whitesmoke, 10%);
    display: block;
    margin: auto;
}

.help {
    text-align: center;
}

html {
    background: repeating-linear-gradient(-45deg,
            yellow,
            yellow 10px,
            darken(yellow, 10%) 10px,
            darken(yellow, 10%) 20px,
        );
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

    document.ondragstart = function() {
        return false;
    };
    </script>
    <!-- ======= end script ======= -->

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="../homepage_log.php">ธัญทิพย์ อพาร์ทเม้นท์</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="" href="../homepage_log.php">หน้าหลัก</a></li>
                    <li class="dropdown"><a href="#"><span>จองห้องพัก</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="roomDay_log.php" class="dropdown-item">รายวัน</a></li>
                            <li><a href="roomMonth_log.php" class="dropdown-item">รายเดือน</a></li>
                        </ul>
                    </li>

                    <?php if (!isset($_SESSION['personal'])) : ?>
                    <li><a class="getstarted scrollto" href="login.php">Login</a></li>
                    <?php endif ?>

                    <?php if (isset($_SESSION['personal'])) : ?>

                    <li class="nav-item dropdown"><a href="#" class="nav-link scrollto active"><i
                                class="bi bi-person"></i> <?php echo $_SESSION['fname']; ?>( ผู้ใช้ )<i
                                class="bi bi-chevron-down"></i></a></a>
                        <ul>
                            <li><a class="dropdown-item" href="profile1.php">ข้อมูลส่วนตัว</a></li>
                            <li><a href="myreservation.php" class="nav-link scrollto active">การจองของฉัน</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a href="../logout.php" class="dropdown-item"
                                    onclick="return confirm('ยืนยันการออกจากระบบ')">ออกจากระบบ</a></li>
                        </ul>
                    </li>
                    <?php endif ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>

            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <br>
    <br>
    <br>
    <?php
    $qry = $con->query("SELECT reserve.reservation_id, reserve.prefix_name,reserve.fname,reserve.lname,reserve.phone,
    reserve.day_reserve,reserve.time_reserve,reserve.day_checkin,reserve.day_checkout,reserve.reservation_id,room_type.name 
    AS tname,room_category.name AS cname,room_picture.room_picture,reserve.proof_of_transfer,reserve.nodays,reserve.reserve_status
    ,reserve.proof_of_transfer,room_details.reservation,bed_type.name AS bname,bed_type.detal,room_details.price,reserve.car
    ,reserve.color,reserve.license_plate,reserve.reservation_money, room_details.other, reserve.reason, reserve.refund,
     reserve.pay, room_details.minimum ,reserve.bank, reserve.nobank, reserve.namebank,reserve.room_count,reserve.time_reserve FROM reserve INNER JOIN room_details 
     ON(reserve.room_type = room_details.id) INNER JOIN room_type ON(room_details.type = room_type.id) INNER JOIN bed_type 
     ON(room_details.bed = bed_type.id) INNER JOIN room_category ON(room_details.reservation = room_category.id) 
     INNER JOIN picture_details ON(room_details.id = picture_details.id_type) INNER JOIN room_picture 
     ON(picture_details.picture = room_picture.id) WHERE reserve.reservation_id = '$id' GROUP BY room_details.id");
    while ($row = $qry->fetch_assoc()) :
        $fname = $row['fname'];
        $lname = $row['lname'];

        $reservation_id = $row['reservation_id'];
        $time_reserve = $row['time_reserve'];
        $sqlbank = "SELECT * FROM bank";
        $result = $con->query($sqlbank);

        $sqlbank2 = "SELECT * FROM bank ";
        $result2 = $con->query($sqlbank2);

        $sqlp = "SELECT * FROM `paper_details` WHERE 1";
        $sqp = mysqli_query($con, $sqlp);
        $rowp = mysqli_fetch_array($sqp);
        $check_in_time = $rowp['check_in_time'];
        $check_out_time = $rowp['check_out_time'];

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

	$strDate = $row['day_reserve'];
?>
    <div class="center-wrapper">
        <div class="content">
            <div class="top-bar">
                <span><label>สถานะการจอง :</label>
                    <?php if($row['reserve_status'] == "ชำระแล้ว"): ?>
                    <div class="" style="float: right;">
                        <span class="" style="color:#4E944F"><i class="bi bi-check-circle"></i> จองเรียบร้อย</span>
                    </div>
                    <?php endif; ?>
                    <?php if($row['reserve_status'] == "รออนุมัติ"): ?>
                    <div class="" style="float: right;">
                        <span class="" style="color:#4B7BE5"><i class="bi bi-hourglass-split"></i>
                            รอตรวจสอบจำนวนเงินที่ชำระ</span>
                    </div>
                    <?php endif; ?>
                    <?php if($row['reserve_status'] == "รอชำระเงิน"): ?>
                    <div class="" style="float: right;">
                        <a href="payment.php?payid=<?php echo $payid = 'abcd'.base64_encode($reservation_id); ?>"><span
                                class="" style="color:#DC143C"><i class="bi bi-cash-coin"></i> รอชำระเงิน</span></a>
                    </div>
                    <?php endif; ?>
                    <?php if($row['reserve_status'] == "การจองผิดพลาด"): ?>
                    <div class="" style="float: right;">
                        <span class="" style="color:#DC143C"><i class="bi bi-exclamation-circle-fill"></i> การจองผิดพลาด
                            เพราะ: <?php echo $row['reason'] ?></span>
                    </div>
                    <?php endif; ?>
                </span>
            </div>
            <div class="bag">
                <p class="bag-head"><span style="text-transform: uppercase">จองเมื่อ</span>
                    <?php echo DateThai($strDate) ?>  <?php echo $time_reserve ?> </p>
                    
            </div>
            <div class="bag-product">
                <div class="image">
                    <img src="../assets/img/<?php echo $row['room_picture'] ?>" class="product-image"
                        style="width: 90%; height: 200px;">
                </div>
                <div class="description">
                    <p class="product-code small muted">รหัสการจอง: <?php echo $id ?></p>
                    <h1>ห้อง<?php echo $row['cname'] ?></h1>
                    <p><?php echo $row['tname'] ?></p>
                    <p class="description-text"><?php echo $row['bname'] ?></p>
                    <p style="margin-bottom: 0.5rem;"><?php echo $row['detal'] ?></p>
                    <?php if($row['reservation'] == 1): ?>
                    <h2><?php echo $row['price'] ?> บาท ต่อวัน</h2>
                    <?php endif ?>
                    <?php if($row['reservation'] == 2): ?>
                    <h2><?php echo $row['price'] ?> บาท ต่อเดือน</h2>
                    <?php endif ?>

                </div>
            </div>
            <div class="bag-total">
                <div class="subtotal">
                    <p class="small">ชื่อผู้จอง:</p>
                    <p class="small"><?php echo $row['prefix_name'].''.$row['fname']?> <?php echo $row['lname'] ?></p>
                </div>
                <div class="subtotal">
                    <p class="small">เบอร์โทร:</p>
                    <p class="small"><?php echo $row['phone']?></p>
                </div>
                <div class="subtotal">
                    <p class="small">ยานพาหนะ:</p>
                    <p class="small">
                        <?php 
                            if($row['car'] == null){
                                echo "ไม่มี";
                            }
                            else echo $row['car']." ".$row['color']." ".$row['license_plate']
                        ?>
                    </p>

                </div>
                <div class="subtotal">
                    <p class="small">วันที่เช็คอิน:</p>
                    <p class="small"><?php echo DateThai($row['day_checkin']) ?> เช็คอินได้ตั้งแต่
                        <?php echo $check_in_time ?> น. </p>
                </div>

                <?php if($row['reservation'] == 1): ?>
                <div class="subtotal">
                    <p class="small">วันที่เช็คเอาท์:</p>
                    <p class="small"><?php echo DateThai($row['day_checkout'])?> เช็คเอาท์ได้ก่อน
                        <?php echo $check_out_time ?> น. </p>
                </div>
                <div class="subtotal">
                    <p class="small">จำนวนวันที่จอง:</p>
                    <p class="small"><?php echo $row['nodays'] ?> คืน</p>
                </div>
                <div class="subtotal">
                    <p class="small">จำนวนห้อง:</p>
                    <p class="small"><?php echo $row['room_count'] ?> ห้อง</p>
                </div>
                <div class="subtotal">
                    <p class="small">ค่าห้อง: <?php echo $row['price']*$row['room_count'] ?>x<?php echo $row['nodays'] ?> คืน</p>
                    <p class="small"><?php echo ($row['price']*$row['nodays']) *$row['room_count']?> บาท</p>
                </div>
                <div class="subtotal">
                    <p class="small">เงินประกัน:</p>
                    <p class="small"><?php echo $row['other'] ?> บาท</p>
                </div>
                <div class="total">
                    <p>รวม:</p>
                    <p><?php echo $row['reservation_money'] ?> บาท</p>
                </div>
                <?php endif; ?>

                <?php if($row['reservation'] == 2): ?>
                <div class="subtotal">
                    <p class="small">ค่าห้อง:</p>
                    <p class="small"><?php echo $row['price'] ?> บาท</p>
                </div>
                <div class="subtotal">
                    <p class="small">เงินประกัน:</p>
                    <p class="small"><?php echo $row['other'] ?> บาท</p>
                </div>
                <div class="total">
                    <p class="small">รวม:</p>
                    <p class="small"><?php echo $row['reservation_money'] ?> บาท</p>
                </div>
                <?php endif; ?>

                <div class="subtotal">
                    <p class="small">ชำระขั้นต่ำ:</p>
                    <p class="small"><?php echo  $sum = $row['room_count'] * $row['minimum'] ?> บาท</p>
                </div>

                <div class="subtotal">
                    <p class="small">จำนวนเงินที่โอน:</p>
                    <p class="small"><?php echo $row['pay'] ?> บาท</p>
                </div>

                <div class="subtotal">
                    <p class="small">ชำระหน้าเคาน์เตอร์อีก:</p>
                    <p class="small"><?php echo $row['reservation_money']-$row['pay'] ?> บาท</p>
                </div>

                <?php if($row['bank'] != NULL): ?>
                <div class="subtotal">
                    <p class="small">ธนาคาร:</p>
                    <p class="small"><?php echo $row['bank'] ?></p>
                    <!-- <p class="small"><?php echo $row['nobank']?></p>
                    <p class="small"><?php echo $row['namebank']?></p>
                    <button>แก้ไข</button> -->
                </div>

                <div class="subtotal">
                    <p class="small">เลขบัญชี:</p>
                    <!-- <p class="small">ธนาคาร <?php echo $row['bank'] ?></p> -->
                    <p class="small"><?php echo $row['nobank']?></p>
                    <!-- <p class="small"><?php echo $row['namebank']?></p>
                    <button>แก้ไข</button> -->
                </div>

                <div class="subtotal">
                    <p class="small">ชื่อบัญชี:</p>
                    <p class="small"><?php echo $row['namebank']?></p>

                </div>
                <center>
                    <button class="btn btn-info" style="width :auto" data-toggle="modal"
                        data-target="#exampleModal">แก้ไขข้อมูลบัญชีธนาคาร</button>
                </center>

                <?php endif ?>

                <?php if($row['bank'] == NULL): ?>
               
                <center>
                    <button class="btn btn-info" style="width :auto" data-toggle="modal"
                        data-target="#exampleModal">เพิ่มข้อมูลบัญชีธนาคาร</button>
                </center>

                <?php endif ?>

                <br>
                <br>

                <?php if($row['reserve_status'] != "รอชำระเงิน") : ?>
                <div class="">
                    <label>หลักฐานการโอนเงินของคุณ:</label>
                </div>
                <br>
                <div style="max-width: 300px;display: block;margin: auto;">
                    <img src="../assets/img/reservation/<?php echo $row['proof_of_transfer'] ?>" class="product-image"
                        style="width: 100%">
                </div>
                <?php endif; ?>

                <?php if($row['reserve_status'] == "การจองผิดพลาด") : ?>
                <div class="">
                    <label>หลักฐานการโอนเงินคืน:</label>
                </div>
                <br>
                <div style="max-width: 300px;display: block;margin: auto;">
                    <img src="../assets/img/refund/<?php echo $row['refund'] ?>" class="product-image"
                        style="width: 100%">
                </div>
			<a href="print.php?rid=<?php echo $payid = 'abcd'.base64_encode($reservation_id); ?>'">
                    <button class="btn-go-checkout">
                        <i class="bi bi-wallet-fill"></i>
                        <span>พิมพ์ใบเสร็จ
                    </button>
                </a>
                <?php endif; ?>

                <br>

                <?php if($row['reserve_status'] == "ชำระแล้ว"): ?>
                <a href="print.php?rid=<?php echo $payid = 'abcd'.base64_encode($reservation_id); ?>'">
                    <button class="btn-go-checkout">
                        <i class="bi bi-wallet-fill"></i>
                        <span>พิมพ์ใบเสร็จ
                    </button>
                </a>
                <?php endif; ?>

                <?php if($row['reserve_status'] == "รอชำระเงิน"): ?>
                <a href="payment.php?payid=<?php echo $payid = 'abcd'.base64_encode($id); ?> ">
                    <button class="btn-go-checkout">
                        <i class="bi bi-wallet-fill"></i>
                        <span>ชำระเงิน
                    </button>
                </a>
                <?php endif; ?>

            </div>
            <div class="help">
                <?php 
                    $sql = "SELECT * FROM `paper_details` WHERE 1";
                    $call = $con->query($sql);

                    while ($row = $call->fetch_assoc()):
                ?>
                <p>ติดต่อสอบถามโทร <?php echo $row['phone_lessor'] ?></p>
                <?php endwhile ?>
            </div>
        </div>
    </div>




    <?php endwhile; ?>



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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</body>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลบัญชี</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label for="recipient-name">ธนาคาร :</label>
                        <select name="bank" class="form-control" required>
                            <option value="" selected></option>
                            <?php while ($rowbank2 = $result2->fetch_assoc()) : ?>
                            <option value="<?php echo $rowbank2['bname'] ?>"><?php echo $rowbank2['bname'] ?></option>
                            <?php endwhile ?>
                        </select>

                    </div>
                    <br>
                    <div class="form-group">
                        <label>เลขบัญชี :</label>
                        <input class="form-control" name="numbank"
                            onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" maxlength="15"
                            required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>ชื่อบัญชี :</label>
                        <input class="form-control" name="namebank" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button class="btn btn-primary" name="Seve">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>

<?php
          date_default_timezone_set('asia/bangkok');
          $date = date("Y-m-d");
          $time = date("H:i:s");

if (isset($_POST['Seve'])){
    $newUser1 = "UPDATE reserve SET bank='$_POST[bank]', nobank = '$_POST[numbank]', namebank = '$_POST[namebank]' WHERE reservation_id = '$id'";
    if (mysqli_query($con, $newUser1)) {

        $sqlie = "INSERT INTO event_log (personal,date,time,event) 
        VALUES ('" . $_SESSION['personal'] . "','$date','$time','" . $_SESSION['fname'] . " " . $_SESSION['lname'] . " แก้ไขข้อมูลบัญชีตนเอง รหัสการจอง $id  ')";
        mysqli_query($con, $sqlie);
        

        echo "<script type='text/javascript'> alert('แก้ไขข้อมูลเสร็จสิ้น')</script>";
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=r_status.php?id=$pid\">";
    }
}

?>