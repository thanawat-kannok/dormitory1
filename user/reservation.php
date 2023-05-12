<?php
if (!isset($_SESSION)) {
    session_start();
}
    
if(!isset($_SESSION['premission']) == "Admin" or !isset($_SESSION['premission']) == "Member")
{
    session_destroy();
    header("location:../index.php");
}
include '../server.php';
$personal = $_SESSION['personal'];

?>
<?php if (isset($_GET['id']))

    $id = $_GET['id'];

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

    <!-- =======================================================
  * Template Name: OnePage - v4.3.0
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
        rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap" rel="stylesheet">

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
    </script>
    <!-- ======= end script ======= -->

    <!-- ======= Script ห้ามลากรูปภาพ ======= -->
    <script type='text/javascript'>
    document.ondragstart = function() {
        return false;
    };
    </script>
    <!-- ======= ยานพาหนะ ======= -->
    <script type="text/javascript">
    function ShowHideDiv(car) {
        var car = document.getElementById("car");
        car.style.display = vehicle1.checked ? "block" : "none";
    }
    </script>


    <!-- ======= คำนวณวัน ======= -->
    <script>
    $(document).ready(function() {

        // $(function() {
        //     $("#my_date_picker1").datepicker({
        //         minDate: +0,
        //         maxDate: +15,
        //         dateFormat: "yy-mm-dd",
        //     });

        // });

        // $(function() {
        //     $("#my_date_picker2").datepicker({
        //         dateFormat: "yy-mm-dd",
        //     });
        // });

        $('#my_date_picker1').change(function() {
            startDate = $(this).datepicker('getDate');
            $("#my_date_picker2").datepicker("option", "minDate", startDate);
        })

        $('#my_date_picker2').change(function() {
            endDate = $(this).datepicker('getDate');
            $("#my_date_picker1").datepicker("option", "maxDate", endDate);

        })
    })

    $(function() {
        $("#tcar").change(function() {
            if ($(this).val() == "ไม่มี") {
                $("#ccar").hide();
                $("#license_plate").hide();
            } else {
                $("#ccar").show();
                $("#license_plate").show();
            }
        });
    });

    function TimeDriff() {
        var diff;
        var start = new Array(3);
        var end = new Array(3);
        var st = document.getElementById('my_date_picker1').value;
        var en = document.getElementById('my_date_picker2').value;

        //Thai DateFormat 15/08/2552 - DD/MM/YYYY  YYYY/MM/DD

        //Split Start -> Date/Month/Year
        start[0] = st.substr(0, 2);
        start[1] = st.substr(3, 2);
        start[2] = st.substr(6, 4);

        //Split End -> Date/Month/Year
        end[0] = en.substr(0, 2);
        end[1] = en.substr(3, 2);
        end[2] = en.substr(6, 4);

        end[1] -= 1;
        start[1] -= 1;

        end[2] -= 543;
        start[2] -= 543;

        StratDate = new Date();
        EndDate = new Date();

        StratDate.setDate(start[0]);
        StratDate.setMonth(start[1]);
        StratDate.setFullYear(start[2]);

        EndDate.setDate(end[0]);
        EndDate.setMonth(end[1]);
        EndDate.setFullYear(end[2])

        if (StratDate.getTime() < EndDate.getTime()) {
            diff = EndDate.getTime() - StratDate.getTime();
            diff = Math.floor(diff / (1000 * 60 * 60 * 24));
        } else if (EndDate.getTime() < StratDate.getTime()) {
            diff = "0";
        } else if (EndDate.getTime() == StratDate.getTime()) {
            diff = "0";
        }

        if (diff == undefined)
            document.getElementById("tmdiff").value = "";
        else
            document.getElementById("tmdiff").value = diff + " " + "คืน";
    }

    $(document).ready(function() {
        $('#tmdiff').on('change', function() {
            var tmdiff = $(this).val();
            if (tmdiff <= 0) {
                alert("Hello! I am an alert box!!");
            }
        });
    });
    </script>


    <!-- ======= end script ======= -->

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="../homepage_log.php"><?php echo $hd['header']?></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="../homepage_log.php">หน้าหลัก</a></li>
                    <li class="dropdown"><a href="#" class="nav-link scrollto active"><span>จองห้องพัก</span> <i
                                class="bi bi-chevron-down"></i></a>

                        <ul>
                            <li><a href="roomDay_log.php" class=" dropdown-item">รายวัน</a></li>
                            <li><a href="roomMonth_log.php" class="dropdown-item">รายเดือน</a></li>
                        </ul>

                    </li>

                    <?php if (!isset($_SESSION['personal'])) : ?>
                    <li><a class="getstarted scrollto" href="login.php">Login</a></li>
                    <?php endif ?>

                    <?php if (isset($_SESSION['personal'])) : ?>

                    <li class="nav-item dropdown"><a href="#" class="dropdown"><i
                                class="bi bi-person"></i><?php echo $_SESSION['fname']; ?>( ผู้ใช้ )<i
                                class="bi bi-chevron-down"></i></a></a>
                        <ul>
                            <li><a class="dropdown-item" href="profile1.php">ข้อมูลส่วนตัว</a></li>
                            <li><a href="myreservation.php">การจองของฉัน</a></li>
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
            <!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <br>
    <?php

    $qry = $con->query("SELECT * FROM user where personal = '$personal'");
    while ($row = $qry->fetch_assoc()) :

        //รายวันรายเดือน
        $sql = "SELECT room_details.id,room_details.floor,room_details.price,room_type.name AS type_name,bed_type.name AS bname,bed_type.size,bed_type.detal,room_picture.room_picture,room_category.name AS cname,room_details.reservation FROM room_type INNER JOIN room_details ON(room_type.id = room_details.type) INNER JOIN bed_type ON(room_details.bed = bed_type.id) INNER JOIN picture_details ON(room_details.id = picture_details.id_type) INNER JOIN room_picture ON(picture_details.picture = room_picture.id)INNER JOIN room_category ON(room_details.reservation = room_category.id) WHERE room_details.id = '$id' ";
        $type = mysqli_query($con, $sql);
        $rowc = mysqli_fetch_array($type);

        $sq = date('Y-m-d');
        $sqtime = date('Y-m-d', strtotime($sq . "+1 days"));
        $sqtime10 = date('Y-m-d', strtotime($sq . "+10 days"));

    ?>
    <div class="form-style-10 w-75">
        <h1>ยืนยันจองห้อง <?php echo $rowc['cname'] ?><span></span></h1>
        <form action="booking_notification.php" method="get">
            <div class="section"><span>1</span>ห้องที่จอง</div>
            <div class="inner-wrap">
                <label>ประเภทการจอง * <input type="text" name="category" value="<?php echo $rowc['cname'] ?>"
                        readonly /></label>
                <label style="display:none">รหัสประเภทห้อง * <input type="text" name="rid"
                        value="<?php echo $rowc['id'] ?>" readonly /></label>
                <label>ประเภทห้อง *<input type="text" name="rtype" value="<?php echo $rowc['type_name'] ?>"
                        readonly /></label>
                <label>เตียง *<input type="text" name="bname" value="<?php echo $rowc['bname'] ?>" readonly /></label>
                <?php
                    if ($rowc['reservation'] == 1) :
                    ?>
                    <script>
                $(document).ready(function() {
                    $('#my_date_picker1').on('change', function() {
                        var date_in = $(this).val();
                        $('#my_date_picker2').on('change', function() {
                            var date_out = $(this).val();

                            if (date_in) {
                                
                                $.ajax({
                                    type: 'GET',
                                    url: 'check_room.php',
                                    data: 'date_check=' + date_in+"/"+date_out,
                                    
                                    success: function(html) {

                                        $('#troom').html(html);
                                        var st = document.getElementById('my_date_picker1').value;
                                        var en = document.getElementById('my_date_picker2').value;
        
                                    }
                                });
                            } else {
                                $('#troom').html('<option value="">กรุณาเลือกประเภทการจองก่อน</option>');
                            }

                          
                        });
                    });
                });

                </script>
                <label>เช็คอิน<input type="text" id="my_date_picker1" name="Check-In" min='<?php echo $sq ?>'
                        onChange="TimeDriff()" required /></label>
                <label>เช็คเอาท์<input type="text" id="my_date_picker2" name="Check-Out" min='<?php echo $sq ?>'
                        onChange="TimeDriff()" required /></label>
                <label>จำนวนคืน<input type="text" id="tmdiff" name="diff" disabled /></label>

                <label>จำนวนห้อง <select class="form-control" id="troom" name="room_count" required></select></label>
                <?php endif ?>
                <?php
                    if ($rowc['reservation'] == 2) :
                    ?>

                <label>เช็คอิน<input type="text" id="my_date_picker3" name="Check-In" required /></label>
                <label style="color:red">หมายเหตุ :
                    รายเดือนสามารถเข้าอยู่ได้เฉพาะวันที่ 1-5 ของทุกเดือนเท่านั้น</label>
                <?php endif ?>
            </div>

            <div class="section"><span>2</span>ข้อมูลผู้จอง</div>
            <div class="inner-wrap">
                <label>ชื่อต้น <input type="text" name="prefix_name" value="<?php echo $row['prefix_name'] ?>"
                        readonly /></label>
                <label>ชื่อ <input type="text" name="fname" value="<?php echo $row['fname'] ?>" readonly /></label>
                <label>นามสกุล <input type="text" name="lname" value="<?php echo $row['lname'] ?>" readonly /></label>
                <label>เบอร์โทร <input type="text" name="phone" value="<?php echo $row['phone'] ?>" readonly /></label>
            </div>
            <div class="section"><span>3</span>ยานพาหนะ</div>
            <div class="inner-wrap" id="car">
                <label>เลือกประเภท
                    <select name="tcar" id="tcar">
                        <option value="" selected></option>
                        <option value="ไม่มี">ไม่มี</option>
                        <option value="รถปิคอัพ">รถปิคอัพ</option>
                        <option value="รถเก๋ง">รถเก๋ง</option>
                        <option value="จักรยานยนต์">จักรยานยนต์</option>

                    </select>
                </label>
                <label id="ccar">สีรถ <input type="text" name="ccar" /></label>
                <label id="license_plate">ป้ายทะเบียน <input type="text" name="license_plate" /></label>
            </div>
            <div class="button-section" align="center">
                <input type="submit" name="submit" value="จองห้อง" />
            </div>
        </form>

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

</body>

</html>

<script>
$(function() {
    $("#my_date_picker1").datepicker({
        minDate: 0,
        dateFormat: 'dd-mm-yy'
    });
    $("#my_date_picker2").attr("disabled", "disabled");
    $("#my_date_picker2").datepicker({
        minDate: 0,
        dateFormat: 'dd-mm-yy'
    });

    $("#my_date_picker1").on("change", function() {
        onCheckin();

    });

    $('#my_date_picker3').datepicker({
        numberOfMonths: 3,
        showCurrentAtPos: 0,
        minDate: "0",
        dateFormat: 'dd-mm-yy',
        beforeShowDay: available
    });

    function available(date) {
        var day = date.getDate(),
            last = (new Date(date.getFullYear(), date.getMonth() + 1, 0, 23, 59, 59)).getDate();
        if (day == 1 || day == 2 || day == 3 || day == 4 || day == 5) {
            return [true, "", "Available"];
        } else {
            return [false, "", "unAvailable"];
        }
    }

});

function onCheckin() {
    if ($("#my_date_picker1").val() !== "") {
        $("#my_date_picker2").removeAttr("disabled");
        var dateMin = $('#my_date_picker1').datepicker("getDate");
        var rMin = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + 1);

        $("#my_date_picker2").datepicker('option', 'minDate', new Date(rMin));
    } else {
        $("#my_date_picker2").val("");
        $("#my_date_picker2").attr("disabled", "disabled");
    }
}
</script>