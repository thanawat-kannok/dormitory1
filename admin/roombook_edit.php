<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'query.php';
if (!isset($_SESSION['premission']) == "Admin") {
    header("location: ../index.php");
}
?>

<?php
if (!isset($_GET["id"])) {
    $_SESSION['reserve'] = "กรุณาตรวจสอบสถาณะการจองห้องพักก่อน";
    header("location:home.php");
} else {
    $year = date("Y") + 543;
    $date = date("d/m/$year"); // เก็บวันที่สมัคร และเปลี่ยนปีเป็น พ.ศ

    include('db.php');
    $id = $_GET['id'];


    $sql = "SELECT room_type.name as name , room_details.price as price ,reserve.prefix_name as prefix_name,reserve.fname as fname,
	reserve.lname as lname , reserve.phone as phone , reserve.day_reserve as day_reserve , reserve.time_reserve as time_reserve,
	room_type.name as name ,reserve.day_checkin as day_checkin , reserve.day_checkout as day_checkout , reserve.reserve_status as reserve_status ,
	reserve.proof_of_transfer as proof_of_transfer ,reserve.nodays as noday, reserve.reservation_money as reservation_money , reserve.car as car ,
	reserve.color as color, reserve.license_plate as license_plate,reserve.nodays, room_details.other, room_details.reservation,  reserve.bank, reserve.nobank, reserve.namebank, room_category.name AS cname, bed_type.name AS bname, reserve.pay, room_details.minimum
	FROM `reserve` INNER JOIN room_details on(reserve.room_type = room_details.id)INNER JOIN room_type on(room_details.type = room_type.id) INNER JOIN bed_type on(room_details.bed = bed_type.id) INNER JOIN room_category ON(room_details.reservation = room_category.id) WHERE reserve.reservation_id = '$id'";
    $re = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($re)) {

        $title = $row['prefix_name'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $phone = $row['phone'];
        $reservation = $row['reservation'];
        $cname = $row['cname'];
        $day_reserve = $row['day_reserve'];
        $time_reserve = $row['time_reserve'];
        $troom = $row['name'];
        $price = $row['price'];
        $bname = $row['bname'];
        $money = $row['reservation_money'];
        $car = $row['car'];
        $pay = $row['pay'];
        $ccin = $row['day_checkin'];
        $minimum = $row['minimum'];

        if ($reservation == "1") {
            $ccout = $row['day_checkout'];
        }



        $noday = $row['noday'];
        $sta = $row['reserve_status'];
        $pot = $row['proof_of_transfer'];

        $color = $row['color'];
        $pad = $row['license_plate'];

        $nodays = $row['nodays'];

        $other = $row['other'];


        $bank = $row['bank'];
        $nobank = $row['nobank'];
        $namebank = $row['namebank'];

        /*เวลากำหนดชำระ */

        date_default_timezone_set('asia/bangkok'); //เวลา
        $date = date('d-m-' . $year . ' H:i');
    }
}

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ระบบจัดการหอพัก</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap"
        rel="stylesheet">

</head>
<style>
body {

    font-family: 'Prompt', sans-serif;
    font-weight: bold;
}

.status {
    border: 1px solid;
    background-color: green;
    color: white;
    border-radius: 5px;
    padding: 5px;
    margin: 10px 0px;
}

.status2 {
    border: 1px solid;
    background-color: red;
    color: black;
    border-radius: 5px;
    padding: 5px;
    margin: 10px 0px;
}

.status3 {
    border: 1px solid;
    background-color: red;
    color: black;
    border-radius: 5px;
    padding: 5px;
    margin: 10px 0px;
}

.status4 {
    border: 1px solid;
    background-color: #00FFFF;
    color: black;
    border-radius: 5px;
    padding: 5px;
    margin: 10px 0px;
}

.text {
    color: red;
    padding: 0px 5px;
}

.page {
    text-align: center;
    display: inline-block;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#room').on('change', function() {
        var room = $(this).val();
        if (room) {
            $.ajax({
                type: 'POST',
                url: 'ajaxData.php',
                data: 'room=' + room,
                success: function(html) {
                    $('#troom').html(html);

                }
            });
        } else {
            $('#troom').html('<option value="">กรุณาเลือกประเภทการจองก่อน</option>');
        }
    });
});
$(document).ready(function() {
    $('#troom').on('change', function() {
        var troom = $(this).val();
        if (troom) {
            $.ajax({
                type: 'POST',
                url: 'ajaxData.php',
                data: 'troom=' + troom,
                success: function(html) {
                    $('#broom').html(html);

                }
            });
        } else {
            $('#broom').html('<option value="">กรุณาเลือกประเภทห้องก่อน</option>');
        }
    });
});
$(document).ready(function() {
    $('#broom').on('change', function() {
        var broom = $(this).val();
        if (broom) {
            $.ajax({
                type: 'POST',
                url: 'ajaxData.php',
                data: 'broom=' + broom,
                success: function(html) {
                    $('#floor').html(html);

                }
            });
        } else {
            $('#floor').html('<option value="">กรุณาเลือกประเภทเตียงก่อน</option>');
        }
    });
});
$(function() {
    $("#conf").change(function() {
        $("#because").hide();
        if ($(this).val() != "ผิดพลาด") {
            $("#because").hide();
        } else {
            $("#because").show();
        }
    });
});
$(document).ready(function() {

    $(function() {
        $("#ccin").datepicker({
            minDate: +0,
            maxDate: +15,
            dateFormat: "yy-mm-dd",
        });

    });

    $(function() {
        $("#ccin").datepicker({
            dateFormat: "yy-mm-dd",
        });
    });

    $('#ccin').change(function() {
        startDate = $(this).datepicker('getDate');
        $("#ccout").datepicker("option", "minDate", startDate);
    })

    $('#ccout').change(function() {
        endDate = $(this).datepicker('getDate');
        $("#ccin").datepicker("option", "maxDate", endDate);

    })
})

$(function() {
    $("#tcar").change(function() {

        if ($(this).val() != "ไม่มี") {
            $("#ccar").show();
            $("#license_plate").show();

        } else {
            $("#ccar").hide();
            $("#license_plate").hide();
        }
    });
});
$(function() {
    $("#conf").change(function() {
        $("#because").hide();
        if ($(this).val() != "การจองผิดพลาด") {
            $("#because").hide();
        } else {
            $("#because").show();
        }
    });
});

function TimeDriff() {
    var diff;
    var start = new Array(3);
    var end = new Array(3);
    var st = document.getElementById('ccin').value;
    var en = document.getElementById('ccout').value;
    var nodays = document.getElementById('nodays').value;
    var other = document.getElementById('other').value;
    var price = document.getElementById('price').value;
    var tprice = document.getElementById('tprice').value;
    var pay = document.getElementById('pay').value;

    //Thai DateFormat 15/08/2552 - DD/MM/YYYY  YYYY/MM/DD

    //Split Start -> Date/Month/Year
    start[0] = st.substr(0, 4);
    start[1] = st.substr(5, 2);
    start[2] = st.substr(8, 2);

    //Split End -> Date/Month/Year
    end[0] = en.substr(0, 4);
    end[1] = en.substr(5, 2);
    end[2] = en.substr(8, 2);

    end[1] -= 1;
    start[1] -= 1;

    end[0] -= 543;
    start[0] -= 543;

    StratDate = new Date();
    EndDate = new Date();

    StratDate.setDate(start[2]);
    StratDate.setMonth(start[1]);
    StratDate.setFullYear(start[0]);

    EndDate.setDate(end[2]);
    EndDate.setMonth(end[1]);
    EndDate.setFullYear(end[0])

    if (StratDate.getTime() < EndDate.getTime()) {
        diff = EndDate.getTime() - StratDate.getTime();
        diff = Math.floor(diff / (1000 * 60 * 60 * 24));
    } else if (EndDate.getTime() < StratDate.getTime()) {
        diff = "0";
    } else if (EndDate.getTime() == StratDate.getTime()) {
        diff = "0";
    }

    if (diff == undefined)
        document.getElementById("nodays").value = "";
    else

        document.getElementById("nodays").value = diff + " " + "วัน";
    document.getElementById("tprice").value = diff * price;
    document.getElementById("money").value = (diff * price + parseInt(other));
    document.getElementById("pay_more").value = (diff * price + parseInt(other) - parseInt(pay));
    document.getElementById("pay_more2").value = (price + parseInt(other) - parseInt(pay));
}

function chk_pic() {
    var file = document.upfile.fileupload.value;
    var patt = /(.jpg|.png)/;
    var result = patt.test(file);
    if (!result) {
        alert('การจองผิดพลาด (รูปหลักฐานการโอน นามสกุล jpg,png,gif เท่านั้น)');
    }
    return result;
}



$(function() {
    $("#paybook").change(function() {

        if ($(this).val() == "ชำระเงิน") {
            $("#payuser").show();
            $("#img").show();
            $("#pass").show();
        } else {
            $("#payuser").hide();
            $("#img").hide();
            $("#pass").hide();
        }
    });
});
</script>

<body>
    <div id="wrapper">
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php" style="width:1000px"> <?php echo $hd['header'] ?></lable> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i><?php echo $_SESSION["fname_A"]; ?>&nbsp <lable>
                            <?php echo $_SESSION["lname_A"]; ?> <i class="fa fa-caret-down"></i>
                            <span class="badge"
                                style="background-color:red"><?php echo $_SESSION["premission_A"]; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="../logout.php" style="color:red" onclick="return confirm('ยืนยันการออกจากระบบ')"><i
                                    class="fa fa-sign-out fa-fw"></i> ออกจากระบบ</a>
                        </li>
                    </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">


                    <li>
                        <div style="background-color:#FF9900;color:black;font-size:20px" align="center">
                            จัดการการจองห้องพัก</div>
                    </li>
                    <li>
                        <a class="active-menu" href="home.php"><i class="fa fa-dashboard"></i> การจองห้อง <lable
                                style="color:red">ใหม่ </lable><span class="badge"><?php echo $c; ?></span></a>
                    </li>
                    <ul class="nav" id="main-menu">
                        <li>
                            <a class="active-menu" href="roombook_edit.php?id=<?php echo $id ?>"><i
                                    class="fa fa-pencil-square-o"></i> แก้ไขใบจองเลข <?php echo $id ?></a>
                        </li>
                    </ul>
                    <!-- <li>
                        <a href="messages.php"><i class="fa fa-desktop" ></i> ประวัติการจองห้องพัก</a>
                    </li> -->
                    <li>
                        <div style="background-color:#FF9900;color:black;font-size:20px" align="center">
                            จัดการห้องพักและผู้ใช้งาน</div>
                    </li>
                    <li>
                        <a href="month.php"><i class="fa fa-calendar-check-o"></i> การจัดการห้องพัก <lable
                                style="font-size:12px;color:#7FFF00"> แก้ไข</lable></a>
                    </li>
                    <li>
                        <a href="user.php"><i class="fa fa-user-circle"></i> จัดการผู้ใช้</a>
                    </li>
                    <li>
                        <a href="receipt.php"><i class="fa fa-qrcode"></i> จัดการค่าเช่า รายเดือน </a>
                    </li>
                    <li>
                        <a href="price.php"><i class="fa fa-address-book"></i> ประวัติการชำระเงิน รายเดือน</a>
                    </li>
                    <li>
                        <div style="background-color:#FF9900;color:black;font-size:20px;" align="center">จัดการอื่นๆ
                        </div>
                    </li>
                    <li>
                        <a href="profit.php"><i class="fa fa-line-chart"></i> รายรับ</a>
                    </li>
                    <li>
                        <a href="contect.php"><i class="fa fa-edit"></i> การจัดการเว็บไซน์</a>
                    </li>
                    <li>
                        <a href="log.php"><i class="fa fa-bug"></i> บันทึกประวัติ</a>
                    </li>

            </div>
        </nav>
        <!-- /. NAV SIDE  -->




        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            แก้ไขการจองห้องพัก<small> <?php echo  $date; ?> </small>
                        </h1>
                    </div>

                    <?php
                    /*ประเภทห้อง */
                    $sqlt = "SELECT * FROM room_category WHERE id != '$reservation'";
                    $ret = $con->query($sqlt);
                    ?>

                    <div class="col-md-8 col-sm-8">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Booking Conformation <span style="float: right;">รหัสการจอง : <?php echo $id ?></span>
                            </div>
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <form method="post" enctype="multipart/form-data" name="upfile" id="upfile"
                                        onSubmit="return chk_pic();">

                                        <table class="table">
                                            <td width="30%"></td>
                                            <td width="30%"></td>
                                            <tr>
                                                <th>DESCRIPTION</th>
                                                <th>INFORMATION</th>

                                            </tr>
                                            <tr>
                                                <th>ชื่อ</th>
                                                <th>
                                                    <input name="title" class="form-control"
                                                        value="<?php echo $title . "" . $fname . " " . $lname ?>"
                                                        disabled>

                                                </th>

                                            </tr>
                                            <tr>
                                                <th>เบอร์โทรศัพท์ </th>
                                                <th><input name="phone" class="form-control"
                                                        value="<?php echo $phone; ?>" maxlength="10" minlength="10">
                                                </th>

                                            </tr>
                                            <tr>
                                                <th>วันที่จอง </th>
                                                <th><input type="date" name="day_reserve" class="form-control"
                                                        value="<?php echo $day_reserve; ?>" disabled></th>

                                            </tr>
                                            <tr>
                                                <th>เวลาที่จอง </th>
                                                <th><input name="time_reserve" class="form-control"
                                                        value="<?php echo $time_reserve . " " . "น."; ?>" disabled></th>

                                            </tr>

                                            <tr>
                                                <th>ห้อง </th>
                                                <th><select class="form-control" id="room" name="room"
                                                        onChange="price_room()" disabled>
                                                        <option value="<?php echo $reservation ?>"><?php echo $cname ?>
                                                        </option>
                                                        <?php while ($rowt = $ret->fetch_assoc()) : ?>
                                                        <option value="<?php echo $rowt['id'] ?>">
                                                            <?php echo $rowt['name'] ?></option>
                                                        <?php endwhile ?></th>

                                            </tr>

                                            <tr>
                                                <th>ประเภทห้อง </th>
                                                <th><select class="form-control" id="troom" name="troom"
                                                        onChange="price_room()" disabled>
                                                        <option value="<?php echo $reservation ?>"><?php echo $troom ?>
                                                        </option>
                                                    </select>
                                                </th>

                                            </tr>

                                            <tr>
                                                <th>เตียง </th>
                                                <th><select class="form-control" id="broom" name="broom"
                                                        onChange="price_room()" disabled>
                                                        <option value="<?php echo $reservation ?>"><?php echo $bname ?>
                                                        </option>
                                                    </select>
                                                </th>

                                            </tr>

                                            <?php if ($reservation == 2) : ?>
                                            <tr>
                                                <th>ราคาห้อง/เดือน </th>
                                                <th><input type="text" name="price" id="price" class="form-control"
                                                        value="<?php echo $price ?>" disabled></th>
                                            </tr>
                                            <?php endif ?>

                                            <?php if ($reservation == 1) : ?>
                                            <tr>

                                                <th>ราคาห้อง/วัน </th>
                                                <th><input type="text" name="price" id="price" class="form-control"
                                                        value="<?php echo $price ?>" onChange="TimeDriff()" disabled>
                                                </th>

                                            </tr>
                                            <?php endif ?>

                                            <tr>
                                                <th>วันที่เช็คอิน </th>
                                                <th><input type="date" name="ccin" id="ccin" class="form-control"
                                                        value="<?php echo $ccin; ?>" onChange="TimeDriff()"></th>

                                            </tr>
                                            <?php if ($reservation == "1") : ?>
                                            <tr>
                                                <th>วันที่เช็คเอาท์</th>
                                                <th><input type="date" name="ccout" id="ccout" class="form-control"
                                                        value="<?php echo $ccout; ?>" onChange="TimeDriff()"></th>
                                            </tr>
                                            <?php endif ?>

                                            <?php if ($reservation == 1) : ?>

                                            <tr>
                                                <th>จำนวนวันที่จอง</th>
                                                <th><input type="text" name="nodays" id="nodays" class="form-control"
                                                        value="<?php echo $nodays ?>" disabled> </th>
                                            </tr>
                                            <tr>
                                                <th>ราคาห้อง</th>
                                                <th><input type="text" name="tprice" id="tprice" class="form-control"
                                                        value="<?php echo $price * $noday ?>" disabled> </th>

                                            </tr>
                                            <?php endif ?>
                                            <tr>
                                                <th>เงินประกัน</th>
                                                <th><input type="text" name="other" id="other" class="form-control"
                                                        value="<?php echo $other ?>" disabled></th>

                                            </tr>
                                            <tr>
                                                <th>รถคนเข้าพัก</th>
                                                <th>
                                                    <div class="inner-wrap">
                                                        <label>ประเภทรถ
                                                            <select name="tcar" id="tcar" class="form-control">
                                                                <?php if ($car == null) : ?>
                                                                <option value="ไม่มี">ไม่มี</option>
                                                                <option value="รถปิคอัพ">รถปิคอัพ</option>
                                                                <option value="รถเก๋ง">รถเก๋ง</option>
                                                                <option value="จักรยานยนต์">จักรยานยนต์</option>
                                                                <option value="จักรยาน">จักรยาน</option>
                                                                <?php endif ?>
                                                                <?php if ($car == "ไม่มี") : ?>
                                                                <option value="<?php echo $car ?>" selected>
                                                                    <?php echo $car ?></option>
                                                                <option value="รถปิคอัพ">รถปิคอัพ</option>
                                                                <option value="รถเก๋ง">รถเก๋ง</option>
                                                                <option value="จักรยานยนต์">จักรยานยนต์</option>
                                                                <option value="จักรยาน">จักรยาน</option>
                                                                <?php endif ?>
                                                                <?php if ($car == "รถปิคอัพ") : ?>
                                                                <option value="ไม่มี">ไม่มี</option>
                                                                <option value="<?php echo $car ?>" selected>
                                                                    <?php echo $car ?></option>
                                                                <option value="รถเก๋ง">รถเก๋ง</option>
                                                                <option value="จักรยานยนต์">จักรยานยนต์</option>
                                                                <option value="จักรยาน">จักรยาน</option>
                                                                <?php endif ?>
                                                                <?php if ($car == "รถเก๋ง") : ?>
                                                                <option value="ไม่มี">ไม่มี</option>
                                                                <option value="รถปิคอัพ">รถปิคอัพ</option>
                                                                <option value="<?php echo $car ?>" selected>
                                                                    <?php echo $car ?></option>
                                                                <option value="จักรยานยนต์">จักรยานยนต์</option>
                                                                <option value="จักรยาน">จักรยาน</option>
                                                                <?php endif ?>
                                                                <?php if ($car == "จักรยานยนต์") : ?>
                                                                <option value="ไม่มี">ไม่มี</option>
                                                                <option value="รถปิคอัพ">รถปิคอัพ</option>
                                                                <option value="รถเก๋ง">รถเก๋ง</option>
                                                                <option value="<?php echo $car ?>" selected>
                                                                    <?php echo $car ?></option>
                                                                <option value="จักรยาน">จักรยาน</option>
                                                                <?php endif ?>
                                                                <?php if ($car == "จักรยาน") : ?>
                                                                <option value="ไม่มี">ไม่มี</option>
                                                                <option value="รถปิคอัพ">รถปิคอัพ</option>
                                                                <option value="รถเก๋ง">รถเก๋ง</option>
                                                                <option value="จักรยานยนต์">จักรยานยนต์</option>
                                                                <option value="<?php echo $car ?>" selected>
                                                                    <?php echo $car ?></option>
                                                                <?php endif ?>

                                                            </select>
                                                        </label>
                                                        <br>
                                                        <?php if ($car == "ไม่มี") : ?>
                                                        <label id="ccar" style="display:none">สีรถ <input type="text"
                                                                name="ccar" class="form-control"
                                                                value="<?php echo $color ?>" /></label>
                                                        <br>
                                                        <label id="license_plate" style="display:none">ป้ายทะเบียน
                                                            <input type="text" name="license_plate" class="form-control"
                                                                value="<?php echo $pad ?>" /></label>
                                                        <?php endif ?>
                                                        <?php if ($car != "ไม่มี") : ?>
                                                        <label id="ccar">สีรถ <input type="text" name="ccar"
                                                                class="form-control"
                                                                value="<?php echo $color ?>" /></label>
                                                        <br>
                                                        <label id="license_plate">ป้ายทะเบียน <input type="text"
                                                                name="license_plate" class="form-control"
                                                                value="<?php echo $pad ?>" /></label>
                                                        <?php endif ?>
                                                    </div>
                                                </th>

                                            </tr>

                                            <tr>
                                                <th>สถานะการจอง</th>
                                                <?php if ($sta == "จองห้องแล้ว") : ?>
                                                <th>
                                                    <lable class="status"><?php echo $sta; ?></lable>
                                                </th>
                                                <?php endif ?>
                                                <?php if ($sta == "รออนุมัติ") : ?>
                                                <th>
                                                    <lable class="status"><?php echo $sta; ?></lable>
                                                </th>
                                                <?php endif ?>
                                                <?php if ($sta == "รอชำระเงิน") : ?>
                                                <th>
                                                    <lable class="status4"><?php echo $sta; ?></lable>
                                                </th>

                                                <?php endif ?>

                                            </tr>
                                            <?php if ($sta != "รอชำระเงิน") : ?>
                                            <tr>
                                                <th>รูปภาพใบเสร็จ</th>
                                                <th><img id='.$i.' src="../assets/img/reservation/<?php echo $pot; ?>"
                                                        class="resize" width="500px"></th>

                                            </tr>
                                            <tr>
                                                <th>บัญชีที่โอนเงิน</th>
                                                <th>ธนาคาร: <?php echo $bank ?> <br> เลขบัญชี: <?php echo $nobank ?><br>
                                                    ชื่อบัญชี: <?php echo $namebank ?></th>
                                            </tr>
                                            <?php endif ?>
                                            <tr>
                                                <th>จำนวนเงินที่ต้องจ่ายทั้งหมด</th>
                                                <th><input type="text" name="money" id="money" class="form-control"
                                                        value="<?php echo $money ?>" disabled> </th>

                                            </tr>

                                            <tr>
                                                <th>จำนวนเงินที่ต้องชำระขั้นต่ำ</th>
                                                <th><input type="text" name="minimum" id="minimum" class="form-control"
                                                        value="<?php echo $minimum ?>" disabled></th>

                                            </tr>
                                            <tr>
                                                <th>ชำระเงิน</th>
                                                <th>
                                                    <select name="paybook" id="paybook" class="form-control">
                                                        <option value selected> ยังไม่ชำระ</option>
                                                        <option value="ชำระเงิน">ชำระเงิน</option>
                                                        <!-- <option value="การจองผิดพลาด">ไม่ผ่าน</option> -->
                                                    </select>
                                                </th>
                                            </tr>
                                            <tr id="payuser" style="display: none;">
                                                <th>จำนวนเงินที่ลูกค้าโอน</th>
                                                <th><input type="text" name="pay" id="pay" class="form-control"
                                                        value="<?php echo $pay ?>" onChange="TimeDriff()" required></th>

                                            </tr>

                                            <!-- <?php if ($reservation == 1) : ?>
											<tr>
												<th>ยอดที่ต้องชำระเพิ่ม</th>
												<th><input type="text" name="pay_more" id="pay_more" class="form-control" value="<?php echo $money - $pay ?>" disabled> </th>

											</tr>
											<?php endif ?>
											<?php if ($reservation == 2) : ?>
												<tr>
													<th>ยอดที่ต้องชำระเพิ่ม</th>
													<th><input type="text" name="pay_more" id="pay_more2" class="form-control" value="<?php echo $money - $pay ?>" disabled> </th>

												</tr>
											<?php endif ?> -->

                                            <tr id="img" style="display: none;">
                                                <th>หลักฐานการโอน</th>
                                                <th><input type="file" id="imgpay" name="fileupload"
                                                        class="form-control" accept="image/png, image/gif, image/jpeg">
                                                </th>
                                            </tr>

                                            <tr id="pass" style="display: none;">
                                                <th>ยืนยันสถานะการจองห้องพัก</th>
                                                <th>
                                                    <select name="conf" id="conf" class="form-control">
                                                        <option value selected> </option>
                                                        <option value="ชำระแล้ว">ผ่าน</option>
                                                        <!-- <option value="การจองผิดพลาด">ไม่ผ่าน</option> -->
                                                    </select>
                                                </th>
                                            </tr>
                                            <tr id="because" style="display:none">
                                                <th>เหตุผล</th>
                                                <th><input type="text" name="reason" id="reason" class="form-control">
                                                </th>
                                            </tr>
                                            <tr id="refund" style="display:none">
                                                <th>หลักฐานการคืนเงิน</th>
                                                <th><input type="file" name="refund" id="refund2" class="form-control"
                                                        accept="image/png, image/gif, image/jpeg">
                                                </th>
                                            </tr>

                                        </table>
                                        <input type="submit" name="co" value="ยืนยัน"
                                            onclick="return confirm('คุณต้องการ ยืนยันสถานะการจองห้องพัก หรือไม่?')"
                                            class="btn btn-success">
                                    </form>
                                </div>
                            </div>


                            <script>
                            function chk_pic() {
                                var option = document.getElementById('conf').value;
                                var check = document.getElementById('reason').value;
                                var refund = document.getElementById('refund2').value;
                                var paybook = document.getElementById("paybook").value
                                var pay = document.getElementById("pay").value;
                                var imgpay = document.getElementById("imgpay").value;
                                var conf = document.getElementById("conf").value;
                                switch (option) {
                                    case 'การจองผิดพลาด':
                                        if (check == "" || refund == "") {
                                            alert('กรุณาระบุบเหตุผลหรือหลักฐานการโอนเงินคืน');
                                            return false;
                                        }
                                        break;
                                }

                                switch (paybook) {
                                    case 'ชำระเงิน':
                                        if (pay == "" || imgpay == "" || conf == "") {
                                            alert('กรุณากรอกข้อมูลการชำระให้ครบ');
                                            return false;
                                        }
                                        break;
                                }
                            }
                            </script>


                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->

            </div>
            <!-- /. ROW  -->

        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->

    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>

</body>

</html>

<?php


if (isset($_POST['co'])) {

    $fileupload = $_POST['fileupload']; //รับค่าไฟล์จากฟอร์ม	

    //ฟังก์ชั่นวันที่
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Ymd");
    //ฟังก์ชั่นสุ่มตัวเลข
    $numrand = (mt_rand());

    //เพิ่มไฟล์
    $upload = $_FILES['fileupload'];

    if ($upload <> '') {   //not select file
        //โฟลเดอร์ที่จะ upload file เข้าไป 
        $path = "../assets/img/reservation/";
        //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
        $type = strrchr($_FILES['fileupload']['name'], ".");

        //ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
        $newname = $date . $numrand . $type;
        $path_copy = $path . $newname;
        $path_link = "fileupload/" . $newname;

        //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
        move_uploaded_file($_FILES['fileupload']['tmp_name'], $path_copy);
    }

    if ($_POST['conf'] != "ชำระแล้ว") {
        $conf = 'รอชำระเงิน';
    } else {
        $conf = 'ชำระแล้ว';
    }
    $reason = $_POST['reason'];
    $refund = $_POST['refund'];


    if ($reservation == '1') {
        $CheckOut = $_POST['ccout'];
        $calculate = strtotime("$CheckOut") - strtotime("$_POST[ccin]");
        $sumdate = floor($calculate / 86400);
        $all = $price * $sumdate;

        $rpsql = "UPDATE `reserve` SET `phone`='$_POST[phone]',`day_checkin`='$_POST[ccin]',
        `day_checkout`='$_POST[ccout]',`nodays`='$sumdate',`pay`='$_POST[pay]',
        `proof_of_transfer`='$newname',`reserve_status`='$conf',`car`='$_POST[tcar]',
        `color`='$_POST[ccar]',`license_plate`='$_POST[license_plate]' WHERE reservation_id ='$id' ";
    }

    if ($reservation == '2') {

        $rpsql = "UPDATE `reserve` SET `phone`='$_POST[phone]',`day_checkin`='$_POST[ccin]',
        `day_checkout`='$_POST[ccout]',`pay`='$_POST[pay]',
        `proof_of_transfer`='$newname',`reserve_status`='$conf',`car`='$_POST[tcar]',
        `color`='$_POST[ccar]',`license_plate`='$_POST[license_plate]' WHERE reservation_id ='$id' ";
    }

 



    if (mysqli_query($con, $rpsql)) {

        $date = date("Y-m-d"); // เก็บวันที่สมัคร และเปลี่ยนปีเป็น พ.ศ

        date_default_timezone_set('asia/bangkok'); //เวลา
        $time = date('H:i:s');

        $sqlie = "INSERT INTO event_log (personal,date,time,event) 
        VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " แก้ไขการจองห้อง รหัสการจอง $id ')";
        mysqli_query($con, $sqlie);
        echo "<script type='text/javascript'> alert('แก้ไขการจองแล้ว')</script>";
        echo "<script type='text/javascript'> window.location='home.php'</script>";
    }
}

?>
<script>



</script>