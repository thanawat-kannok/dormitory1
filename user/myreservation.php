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
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];


?>
<?php 
    $Header =mysqli_query($con,"SELECT * FROM paper_details ");
    $hd = mysqli_fetch_array($Header);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $hd['header']?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/icon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap"
        rel="stylesheet">

</head>

<style>
* {
    box-sizing: border-box;
    font-family: 'Prompt', sans-serif;
    font-weight: bold;
}

/*
!!!!
This pen is being refactored
!!!!
*/

/*
=====
DEPENDENCES
=====

*/


.r-title {
    margin-top: var(--rTitleMarginTop, 0) !important;
    margin-bottom: var(--rTitleMarginBottom, 0) !important;
}


p:not([class]) {
    line-height: var(--cssTypographyLineHeight, 1.78);
    margin-top: var(--cssTypographyBasicMargin, 1em);
    margin-bottom: 0;
}

p:not([class]):first-child {
    margin-top: 0;
}

/*
text component
*/

.text {
    display: var(--textDisplay, inline-flex);
    font-size: var(--textFontSize, 1rem);
}

/*
time component
*/

/*
core styles
*/

.time {
    display: var(--timeDisplay, inline-flex);
}

/*
extensions
*/

.time__month {
    margin-left: var(--timelineMounthMarginLeft, .25em);
}

/*
skin
*/

.time {
    padding: var(--timePadding, .25rem 1.25rem .25rem);
    background-color: var(--timeBackgroundColor, #f0f0f0);

    font-size: var(--timeFontSize, .75rem);
    font-weight: var(--timeFontWeight, 700);
    text-transform: var(--timeTextTransform, uppercase);
    color: var(--timeColor, currentColor);
}

/*
card component
*/

/*
core styles
*/

.card {
    padding: var(--timelineCardPadding, 1.5rem 1.5rem 1.25rem);
}

.card__content {
    margin-top: var(--cardContentMarginTop, .5rem);
}

/*
skin
*/

.card {
    border-radius: var(--timelineCardBorderRadius, 2px);
    border-left: var(--timelineCardBorderLeftWidth, 3px) solid var(--timelineCardBorderLeftColor, var(--uiTimelineMainColor));
    box-shadow: var(--timelineCardBoxShadow, 0 1px 3px 0 rgba(0, 0, 0, .12), 0 1px 2px 0 rgba(0, 0, 0, .24));
    background-color: var(--timelineCardBackgroundColor, #fff);
}

/*
extensions
*/

.card__title {
    --rTitleMarginTop: var(--cardTitleMarginTop, 1rem);
    font-size: var(--cardTitleFontSize, 1.25rem);
}

/*
=====
CORE STYLES
=====
*/

.timeline {
    display: var(--timelineDisplay, grid);
    grid-row-gap: var(--timelineGroupsGap, 2rem);
}

/*
1. If timeline__year isn't displaed the gap between it and timeline__cards isn't displayed too
*/

.timeline__year {
    margin-bottom: 1.25rem;
    /* 1 */
}

.timeline__cards {
    display: var(--timeloneCardsDisplay, grid);
    grid-row-gap: var(--timeloneCardsGap, 1.5rem);
}


/*
=====
SKIN
=====
*/

.timeline {
    --uiTimelineMainColor: var(--timelineMainColor, #222);
    --uiTimelineSecondaryColor: var(--timelineSecondaryColor, #fff);

    border-left: var(--timelineLineWidth, 3px) solid var(--timelineLineBackgroundColor, var(--uiTimelineMainColor));
    padding-top: 1rem;
    padding-bottom: 1.5rem;
}

.timeline__year {
    --timePadding: var(--timelineYearPadding, .5rem 1.5rem);
    --timeColor: var(--uiTimelineSecondaryColor);
    --timeBackgroundColor: var(--uiTimelineMainColor);
    --timeFontWeight: var(--timelineYearFontWeight, 400);
}

.timeline__card {
    position: relative;
    margin-left: var(--timelineCardLineGap, 1rem);
}

/*
1. Stoping cut box shadow
*/

.timeline__cards {
    overflow: hidden;
    padding-top: .25rem;
    /* 1 */
    padding-bottom: .25rem;
    /* 1 */
}

.timeline__card::before {
    content: "";
    width: 100%;
    height: var(--timelineCardLineWidth, 2px);
    background-color: var(--timelineCardLineBackgroundColor, var(--uiTimelineMainColor));

    position: absolute;
    top: var(--timelineCardLineTop, 1rem);
    left: -50%;
    z-index: -1;
}

/*
=====
SETTINGS
=====
*/
/**/
.timeline {
    --timelineMainColor: #4557bb;
}

/*
=====
DEMO
=====
*/

body {
    font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Open Sans, Ubuntu, Fira Sans, Helvetica Neue, sans-serif;
    color: #222;

    background-color: #f0f0f0;
    margin: 0;
    display: flex;
    flex-direction: column;
}

p {
    margin-top: 0;
    margin-bottom: 1rem;
    line-height: 1.5;
}

p:last-child {
    margin-bottom: 0;
}

.page {
    max-width: 60rem;
    padding: 5rem 2rem 3rem;
    margin-left: auto;
    margin-right: auto;
}


.substack {
    border: 1px solid #EEE;
    background-color: #fff;
    width: 100%;
    max-width: 480px;
    height: 280px;
    margin: 1rem auto;
    ;
}


.linktr {
    display: flex;
    justify-content: flex-end;
    padding: 2rem;
    text-align: center;
}

.linktr__goal {
    background-color: rgb(209, 246, 255);
    color: rgb(8, 49, 112);
    box-shadow: rgb(8 49 112 / 24%) 0px 2px 8px 0px;
    border-radius: 2rem;
    padding: .75rem 1.5rem;
}

.r-link {
    --uirLinkDisplay: var(--rLinkDisplay, inline-flex);
    --uirLinkTextColor: var(--rLinkTextColor);
    --uirLinkTextDecoration: var(--rLinkTextDecoration, none);

    display: var(--uirLinkDisplay) !important;
    color: var(--uirLinkTextColor) !important;
    text-decoration: var(--uirLinkTextDecoration) !important;
}

/*กล่องข้างใน*/

@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Bree+Serif&family=EB+Garamond:ital,wght@0,500;1,800&display=swap');




#container {
    box-shadow: 0 15px 30px 1px grey;
    background: rgba(255, 255, 255, 0.90);
    text-align: center;
    border-radius: 5px;
    overflow: hidden;
    margin: 1em auto;
    height: 100%;
    width: 100%;

}

.product-details {
    position: relative;
    text-align: left;
    overflow: hidden;
    padding: 20px;
    height: 100%;
    float: right;
    width: 40%;
    margin-right: 55px;
}

#container .product-details h1 {
    font-family: 'Bebas Neue', cursive;
    display: inline-block;
    position: relative;
    font-size: 30px;
    color: #344055;
    margin: 0;

}

#container .product-details h1:before {
    position: absolute;
    content: '';
    right: 0%;
    top: 0%;
    transform: translate(25px, -15px);
    font-family: 'Bree Serif', serif;
    display: inline-block;
    background: #ffe6e6;
    border-radius: 5px;
    font-size: 14px;
    padding: 5px;
    color: white;
    margin: 0;
    animation: chan-sh 6s ease infinite;

}

.hint-star {
    display: inline-block;
    margin-left: 0.5em;
    color: gold;
    width: 50%;
}


#container .product-details>p {
    font-family: 'EB Garamond', serif;
    text-align: center;
    font-size: 18px;
    color: #7d7d7d;

}

.control {
    position: absolute;
    bottom: 20%;
    left: 22.8%;

}

.btn {

    transform: translateY(0px);
    transition: 0.3s linear;
    background: #809fff;
    border-radius: 5px;
    position: relative;
    overflow: hidden;
    cursor: pointer;
    outline: none;
    border: none;
    color: #eee;
    padding: 0;
    margin: 0;

}

.btn:hover {
    transform: translateY(-6px);
    background: #1a66ff;
}

.btn span {
    font-family: 'Farsan', cursive;
    transition: transform 0.3s;
    display: inline-block;
    padding: 10px 20px;
    font-size: 1.2em;
    margin: 0;

}

.btn .price,
.shopping-cart {
    background: #333;
    border: 0;
    margin: 0;
}

.btn .price {
    transform: translateX(-10%);
    padding-right: 15px;
}

.btn .shopping-cart {
    transform: translateX(-100%);
    position: absolute;
    background: #333;
    z-index: 1;
    left: 0;
    top: 0;
}

.btn .buy {
    z-index: 3;
    font-weight: bolder;
}

.btn:hover .price {
    transform: translateX(-110%);
}

.btn:hover .shopping-cart {
    transform: translateX(0%);
}



.product-image {
    transition: all 0.3s ease-out;
    display: inline-block;
    position: relative;
    overflow: hidden;
    height: 250px;
    float: left;
    width: 40%;
    margin-top: 1.5rem;

}

#container img {
    width: 100%;
    height: 100%;
}

.info {
    background: rgba(27, 26, 26, 0.9);
    font-family: 'Bree Serif', serif;
    transition: all 0.3s ease-out;
    transform: translateX(-100%);
    position: absolute;
    line-height: 1.8;
    text-align: left;
    font-size: 105%;
    cursor: no-drop;
    color: #FFF;
    height: 100%;
    width: 100%;
    left: 0;
    top: 0;
}

.info h2 {
    text-align: center
}

.product-image:hover .info {
    transform: translateX(0);
}

.info ul li {
    transition: 0.3s ease;
}

.info ul li:hover {
    transform: translateX(50px) scale(1.3);
}

.product-image:hover img {
    transition: all 0.3s ease-out;
}

.product-image:hover img {
    transform: scale(1.2, 1.2);
}
</style>
</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="../homepage_log.php"><?php echo $hd['header']?></a></h1>
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
                            <li><a href="profile1.php">ข้อมูลส่วนตัว</a></li>
                            <li><a href="myreservation.php" class="nav-link scrollto active">การจองของฉัน</a></li>
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
    </header><!-- End Header -->

    <div class="page">
        <?php
        $qry = $con->query("SELECT room_type.name AS tname, room_category.name AS cname, reserve.reserve_status, 
        room_picture.room_picture, reserve.reservation_id, reserve.day_checkin, reserve.day_checkout,reserve.reservation_id, 
        reserve.day_reserve, room_details.reservation, bed_type.detal, bed_type.name AS bname, bed_type.size, 
        room_details.price, reserve.reason FROM reserve INNER JOIN room_details ON(reserve.room_type = room_details.id) 
        INNER JOIN room_type ON(room_details.type = room_type.id) INNER JOIN picture_details 
        ON(room_details.id = picture_details.id_type) INNER JOIN room_picture ON(picture_details.picture = room_picture.id) 
        INNER JOIN room_category ON(room_details.reservation = room_category.id) INNER JOIN bed_type
         ON(room_details.bed = bed_type.id) INNER JOIN user ON(reserve.fname = user.fname AND reserve.lname = user.lname) 
          WHERE reserve.fname = '$fname' AND reserve.lname = '$lname' AND user.personal = '$personal'
          GROUP BY reserve.reservation_id ORDER BY reserve.reservation_id DESC ");
        if (mysqli_num_rows($qry) > 0) :

        ?>

        <?php
            while ($row = $qry->fetch_assoc()) :
                $datestart = $row['day_reserve'];
                $reservation_id = $row['reservation_id'];
                $dateend = date('d-m-Y');

                $calculate = strtotime("$dateend") - strtotime("$datestart");
                $summary = floor($calculate / 86400); // 86400 มาจาก 24*360 (1วัน = 24 ชม.)
            ?>

        <div class="timeline">
            <div class="timeline__group">
                <?php if ($summary > 0) : ?>
                <span class="timeline__year time" aria-hidden="true"><?php echo $summary ?> วันก่อน</span>
                <?php endif ?>
                <?php if ($summary <= 0) : ?>
                <span class="timeline__year time" aria-hidden="true">วันนี้</span>
                <?php endif ?>
                <div class="timeline__cards">
                    <div class="timeline__card card">
                        <header class="card__header">
                            <time class="time" datetime="2008-02-02">
                                <span class="time__day">จองวันที่</span>
                                <span class="time__month"><?php list($y, $m, $d) = explode('-', $row['day_reserve']);
                                                                    echo $d . '/' . $m . '/' . date($y+543)  ?></span>
                            </time>
                            <time class="" datetime="2008-02-02" style="float: right;">
                                <span class="time__day">สถานะการจอง</span>
                                <?php if ($row['reserve_status'] == "รออนุมัติ") : ?>
                                <span class="time__month" style="color:#4B7BE5"><i class="bi bi-hourglass-split"></i>
                                    <?php echo $row['reserve_status'] ?></span>
                                <?php endif ?>
                                <?php if ($row['reserve_status'] == "ชำระแล้ว") : ?>
                                <a href="print.php?rid=<?php echo $payid = 'abcd'.base64_encode($reservation_id); ?>"><span
                                        class="time__month" style="color:#4E944F"><i class="bi bi-check-circle"></i>
                                        <?php echo $row['reserve_status'] ?></span></a>
                                <?php endif ?>
                                <?php if ($row['reserve_status'] == "รอชำระเงิน") : ?>
                                <a
                                    href="payment.php?payid=<?php echo $payid = 'abcd'.base64_encode($reservation_id); ?>"><span
                                        class="time__month" style="color:#DC143C"><i class="bi bi-cash-coin"></i>
                                        <?php echo $row['reserve_status'] ?></span></a>
                                <?php endif ?>
                                <?php if ($row['reserve_status'] == "การจองผิดพลาด") : ?>
                                <span class="time__month" style="color:#DC143C"><i
                                        class="bi bi-exclamation-circle-fill"></i>
                                    <?php echo $row['reserve_status'] . " : " . $row['reason'] ?></span>
                                <?php endif ?>
                            </time>

                        </header>
                        <div id="container" class="container">
                            <div class="product-details" style="text-align: center;">
                                <div style="width: 100%;">
                                    <h2 style="font-family: supermarket"><?php echo $row['tname'] ?></h2>
                                    <h3 style="font-family: supermarket">เช็คอิน <?php list($y, $m, $d) = explode('-', $row['day_checkin']);
                                                        echo $d . '/' . $m . '/' .  date($y+543) ?></h3>
                                    <?php if ($row['reservation'] == 1) : ?>
                                    <h3 style="font-family: supermarket">เช็คเอาท์ <?php list($y, $m, $d) = explode('-', $row['day_checkout']);
                                                                echo $d . '/' . $m . '/' . date($y+543) ?></h3>
                                    <?php endif ?>
                                    <p class="information" style="font-family: supermarket"><?php echo $row['detal'] ?>
                                    </p>
                                    <div class="detail">
                                        <a
                                            href=r_status.php?id=<?php echo $payid = 'abcd' . base64_encode($row['reservation_id']); ?>>
                                            <button class="btn">
                                                <span class="buy">รายละเอียด</span>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-image">
                                <div style="width: 100%;height: 100%;">
                                    <img src="../assets/img/<?php echo $row['room_picture'] ?>" alt="">
                                </div>

                                <div class="info">
                                    <h2> ห้อง <?php echo $row['cname'] ?></h2>
                                    <ul>
                                        <li><strong>เตียง : </strong><?php echo $row['bname'] ?></li>
                                        <li><strong>ขนาด : </strong><?php echo $row['size'] ?></li>
                                        <?php if ($row['reservation'] == 1) : ?>
                                        <li><strong>ราคา: </strong><?php echo $row['price'] ?>/วัน</li>
                                        <?php endif ?>
                                        <?php if ($row['reservation'] == 2) : ?>
                                        <li><strong>ราคา: </strong><?php echo $row['price'] ?>/เดือน</li>
                                        <?php endif ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php endwhile; ?>
        <?php endif ?>
        <?php if (mysqli_num_rows($qry) == 0) : ?>
        <h1 style="margin-top: 80px; color:#DC143C">ไม่มีข้อมูลการจอง<i class="bi bi-calendar-x"></i></h1>
        <?php endif ?>



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