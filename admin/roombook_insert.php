<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include 'db.php';
include 'query.php';
include 'date.php';

if (!isset($_SESSION['premission']) == "Admin") {
    header("location: ../index.php");
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการหอพัก</title>
    <link href="css/register.css" rel="stylesheet">
    <link rel="stylesheet" href="/dormitory/css/image.css">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

    <script type="text/javascript">
    var chenkin;
    var chenkout;
    var diff;
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

                        document.getElementById("price").value = 0;
                        document.getElementById("other").value = 0;
                        document.getElementById("tprice").value = 0;

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
                        document.getElementById("price").value = 0;
                        document.getElementById("other").value = 0;
                        document.getElementById("tprice").value = 0;
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
                        document.getElementById("price").value = 0;
                        document.getElementById("other").value = 0;
                        document.getElementById("tprice").value = 0;
                    }
                });
            } else {
                $('#floor').html('<option value="">กรุณาเลือกประเภทเตียงก่อน</option>');
            }
        });
    });




    $(function() {
        $("#room").change(function() {
            if ($(this).val() == "2") {

                $("#chenkout1").hide();
                $("#night").hide();
                // $("#floorbox").show();

            } else {
                // $("#floorbox").hide();
                $("#night").show();
                $("#chenkout1").show();

            }
        });
    });

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

        var start = new Array(3);
        var end = new Array(3);
        var st = document.getElementById('chenkin').value;
        var en = document.getElementById('chenkout').value;
        var price = document.getElementById('price').value;
        var other = document.getElementById('other').value;
        var room = document.getElementById('room').value;


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
        else {

            document.getElementById("nodays").value = diff + " คืน";
            if (room == 1) {
                document.getElementById("tprice").value = (diff * price) + parseInt(other);
            }

        }
    }

    function ShowHideDiv(car) {
        var car = document.getElementById("car");
        car.style.display = vehicle1.checked ? "block" : "none";
    }


    function chk_pic() {
        var room = document.getElementById('room').value;
        var chenkout = document.getElementById('chenkout').value;

        switch (room) {
            case '1':
                if (chenkout == "") {
                    lert('กรุณาระบุบวันที่เช็คเอาท์');
                    return false;
                }
                break;
        }
    }

    function submit() {
        let room = $("#room").val();
        $.ajax({
            type: "POST",
            url: "ajaxData.php",
            data: {
                room: room
            },
            success: function(data) {
                $("#price").html(data);
            }
        });
    }


    function getvaluedate() {
        var chenkin = document.getElementById('chenkin').value;
        var chenkout = document.getElementById('chenkout').value;

        return chenkin, chenkout;
    }

    $(document).ready(function() {
        $('#floor').on('change', function() {
            var room = document.getElementById('room').value;
            var troom = document.getElementById('troom').value;
            var broom = document.getElementById('broom').value;
            var nodays = document.getElementById('nodays').value;
            var floor = $(this).val();

            if (floor) {
                $.ajax({
                    type: 'POST',
                    url: 'ajaxData.php',
                    data: {
                        room: room,
                        troom: troom,
                        broom: broom,
                        floor: floor,
                    },
                    success: function(html) {

                        const text = html.split(",");

                        if (room == 1) {
                            document.getElementById("price").value = text[0];
                            document.getElementById("other").value = text[1];

                            return text[0], text[1];
                            // document.getElementById("tprice").value = ((diff * parseInt(text[0])) + parseInt(text[1]));
                        } else if (room == 2) {
                            document.getElementById("price").value = text[0] + " / เดือน";
                            document.getElementById("other").value = text[1];
                            document.getElementById("tprice").value = (parseInt(text[0]) +
                                parseInt(text[1]));
                        }

                    }
                });
            } else {
                $('#price').html('<input type="text" class="form-control" value = "ไม่มีราคา">');
            }
        });
    });
    </script>
    <!-- font -->
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

img {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
    display: block;
    margin-left: auto;
    margin-right: auto
}

img:hover {
    opacity: 0.7;
}

.status {
    border: 1px solid;
    background-color: yellow;
    color: black;
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
    background-color: #228B22;
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

.errors {
    color: white;
    background-color: #CD5C5C;
    margin: 10px 0px;
    width: 70%;
    border-radius: 10px;
    padding: 10px;
}

.mark {
    color: #CD5C5C;
}
</style>

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
                <a class="navbar-brand" href="home.php" style="width:1000px"> <?php echo $hd['header']?></lable> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="fa fa-user fa-fw"></i><?php echo $_SESSION["fname_A"]; ?>&nbsp <lable><?php echo $_SESSION["lname_A"]; ?> <i class="fa fa-caret-down"></i>
                            <span class="badge" style="background-color:red"><?php echo $_SESSION["premission_A"]; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                            <li><a href="../logout.php" style="color:red" onclick="return confirm('ยืนยันการออกจากระบบ')"><i class="fa fa-sign-out fa-fw" ></i> ออกจากระบบ</a>
                            </li>
                    </ul>
        </nav>

        <?php
        $sqlee = "SELECT * FROM reserve WHERE day_reserve = '$date'";
        $re = mysqli_query($con, $sqlee);
        $g = 0;
        while ($row1 = mysqli_fetch_array($re)) {
            $new = $row1['reserve_status'];
            if ($new == "รออนุมัติ" or $new == "รอชำระเงิน") {
                $g = $g + 1;
            }
        }
        ?>
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
                                style="color:red">ใหม่ </lable><span class="badge"><?php echo $g; ?></span></a>
                    </li>
                    <ul class="nav" id="main-menu">
                        <li>
                            <a class="active-menu" href="roombook_insert.php"><i class="fa fa-plus"></i>
                                จองห้องพัก</a>
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
                <?php
                include('db.php');
                $sql = "SELECT * FROM reserve";
                $re = mysqli_query($con, $sql);
                $c = 0;

                $sqlbank = "SELECT reserve_status FROM reserve GROUP BY reserve_status";
                $result = $con->query($sqlbank);

                while ($row = mysqli_fetch_array($re)) {
                    $new = $row['reserve_status'];
                    $cin = $row['day_checkin'];
                    $id = $row['reservation_id'];
                    $c = $c + 1;
                    /*if ($new == "รออนุมัติ" or $new == "รอชำระเงิน") {
                        $c = $c + 1;
                    }*/
                }


                ?>
                <?php
                $sqlt = "SELECT * FROM room_category";
                $ret = $con->query($sqlt);

                $sq = date('Y-m-d');
                $sqtime = date('Y-m-d',strtotime($sq . "+1 days"));
                $sqtime10 = date('Y-m-d',strtotime($sq . "+10 days"));
                ?>

                <div class="row">
                    <div class="col-md-6 col-sm-5">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                ข้อมูลห้อง
                            </div>
                            <div class="panel-body">
                                <form name="form" method="post" onSubmit="return chk_pic();">
                                    <div class="form-group">
                                        <label>ห้อง<label class="mark">*</label></label>
                                        <select class="form-control" id="room" name="room" required>
                                            <option selected></option>
                                            <?php while ($rowt = $ret->fetch_assoc()) : ?>
                                            <option value="<?php echo $rowt['id'] ?>"><?php echo $rowt['name'] ?>
                                            </option>
                                            <?php endwhile ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">ประเภท<label
                                                class="mark">*</label></label>
                                        <select class="form-control" id="troom" name="troom" required></select>

                                    </div>
                                    <div class="form-group">
                                        <label>เตียง<label class="mark">*</label></label>
                                        <select class="form-control" id="broom" name="broom" required></select>

                                    </div>
                                    <div class="form-group" id="floorbox">
                                        <label>ชั้น<label class="mark">*</label></label>
                                        <select class="form-control" id="floor" name="floor"></select>

                                    </div>

                                    <div class="form-group">
                                        <label>ราคา</label>

                                        <input type="text" class="form-control" id="price" name="price" disabled>

                                    </div>
                                    <div class="form-group">
                                        <label>ประกัน</label>
                                        <input type="text" class="form-control" id="other" name="ohter" value=""
                                            disabled>
                                    </div>


                                    <div class="form-group" id="ci1">
                                        <label>เช็คอิน<label class="mark">*</label></label>
                                        <input type="date" class="form-control" id="chenkin" name="chenkin"
                                            min='<?php echo $sq ?>' onChange="TimeDriff()" required>
                                    </div>


                                    <div class="form-group" id="chenkout1">
                                        <label for="message-text" class="col-form-label">เช็คเอาท์<label
                                                class="mark">*</label></label>
                                        <input type="date" class="form-control" id="chenkout" name="chenkout"
                                            min='<?php echo $sq ?>' onChange="TimeDriff();getvaluedate()">
                                    </div>
                                    <div class="form-group" id="night">
                                        <label>จำนวนคืน</label>
                                        <input type="text" class="form-control" id="nodays" name="nodays" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>ราคา</label>
                                        <input type="text" class="form-control" id="tprice" name="tprice" disabled>
                                    </div>

                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5 col-sm-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    ข้อมูลผู้จอง
                                </div>
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label>คำนำหน้าชื่อ<label class="mark">*</label></label>
                                        <select name="prefix_name" class="form-control" required>
                                            <option value="" selected></option>
                                            <option value="นาย">นาย</option>
                                            <option value="นาง">นาง</option>
                                            <option value="นางสาว">นางสาว</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>ชื่อ<label class="mark">*</label></label>
                                        <input type="text" class="form-control" id="fname" name="fname" required>
                                    </div>
                                    <div class="form-group">
                                        <label>นามสกุล<label class="mark">*</label></label>
                                        <input type="text" class="form-control" id="lname" name="lname" required>
                                    </div>
                                    <div class="form-group">
                                        <label>เบอร์โทร<label class="mark">*</label></label>
                                        <input type="text" class="form-control" id="phone" name="phone" required
                                            maxlength="10" minlength="10">
                                    </div>

                                    <div class="form-group">
                                        <label>รถ</label>
                                        <select name="tcar" id="tcar" class="form-control" required>
                                            <option value="" selected></option>
                                            <option value="ไม่มี">ไม่มี</option>
                                            <option value="รถปิคอัพ">รถปิคอัพ</option>
                                            <option value="รถเก๋ง">รถเก๋ง</option>
                                            <option value="จักรยานยนต์">จักรยานยนต์</option>
                                            <option value="จักรยาน">จักรยาน</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="ccar">
                                        <label>สีรถ</label>
                                        <input type="text" name="ccar" id="ccar" class="form-control" />

                                    </div>
                                    <div class="form-group" id="license_plate">
                                        <label>ป้ายทะเบียน</label>
                                        <input type="text" name="license_plate" class="form-control" />

                                    </div>
                                    <?php
                                    date_default_timezone_set('asia/bangkok');
                                    $date = date("Y-m-d");
                                    $time = date("H:i:s");
                                    ?>
                                </div>


                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="">
                                <center><input type="submit" name="submit" class="btn btn-primary" value="จองห้อง">
                                </center>
                                <?php

                                if (isset($_POST['submit'])) {
                                    $sql = "SELECT * FROM room_details WHERE reservation = '$_POST[room]' AND type = '$_POST[troom]' AND bed = '$_POST[broom]' AND floor = '$_POST[floor]'";
                                    $type = mysqli_query($con, $sql);
                                    $rowc = mysqli_fetch_array($type);
                                    if (empty($rowc)){
                                        echo "<script type='text/javascript'> alert('การจองผิดพลาด ห้องที่เลือกไม่มีข้อมูลในระบบ')</script>";
                                    }
                                    else {
                                        
                                        
                                        if($_POST['room'] == 1){
                                            $chenkin = $_POST['chenkin'];
                                            $chenkout = $_POST['chenkout'];
                                            $calculate = strtotime("$chenkout") - strtotime("$chenkin");
                                            $sumdate = floor($calculate / 86400);
                    
                                            $reservation_money = ($rowc['price']*$sumdate) + $rowc['other'];
                                            $reserve_status = "รอชำระเงิน";
                                            if($sumdate > 0 ){
                                                $new_reserve = "INSERT INTO `reserve`(`prefix_name`, `fname`, `lname`, `phone`, `day_reserve`, `time_reserve`,
                                                `day_checkin`, `day_checkout`, `room_type`, `reserve_status`, `car`, `color`,`license_plate`,`nodays`,
                                                `reservation_money`) VALUES ('$_POST[prefix_name]','$_POST[fname]','$_POST[lname]','$_POST[phone]',
                                                '$date','$time','$_POST[chenkin]','$_POST[chenkout]','$rowc[id]','$reserve_status','$_POST[tcar]',
                                                '$_POST[ccar]','$_POST[license_plate]','$sumdate', '$reservation_money')";
                                               if (mysqli_query($con, $new_reserve)) {
                                                   $pid = mysqli_insert_id($con);
   
                                                   $sqlie = "INSERT INTO event_log (personal,date,time,event) 
                                                   VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " จองห้อง รหัสการจอง $pid ')";
                                                   mysqli_query($con, $sqlie);
                                                   
                                                   echo "<script type='text/javascript'> alert('จองห้องเรียบร้อย')</script>";
                                                   echo "<script type='text/javascript'> window.location='home.php'</script>";
                                               } else {
                                                   echo "<script type='text/javascript'> alert('การจองผิดพลาด')</script>";
                                               }
                                            }
                                            else {
                                                echo "<script type='text/javascript'> alert('กรุณาเลือกวันที่เช็คอินเช็คเอาท์ใหม่')</script>";
                                            }
    
                                           
                                        }
                                        else if($_POST['room'] == '2'){
                                            $reservation_money = $rowc['price'] + $rowc['other'];
                                            $reserve_status = "รอชำระเงิน";
                                            
                                            $new_reserve = "INSERT INTO `reserve`(`prefix_name`, `fname`, `lname`, `phone`, `day_reserve`, `time_reserve`,
                                             `day_checkin`, `day_checkout`, `room_type`, `reserve_status`, `car`, `color`,`license_plate`,
                                             `reservation_money`) VALUES ('$_POST[prefix_name]','$_POST[fname]','$_POST[lname]','$_POST[phone]',
                                             '$date','$time','$_POST[chenkin]','$_POST[chenkout]','$rowc[id]','$reserve_status','$_POST[tcar]',
                                             '$_POST[ccar]','$_POST[license_plate]', '$reservation_money')";

                                            if (mysqli_query($con, $new_reserve)) {
                                                $pid = mysqli_insert_id($con);

                                                $sqlie = "INSERT INTO event_log (personal,date,time,event) 
                                                VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " จองห้อง รหัสการจอง $pid ')";
                                                mysqli_query($con, $sqlie);
                                                
                                                echo "<script type='text/javascript'> alert('จองห้องเรียบร้อย')</script>";
                                                echo "<script type='text/javascript'> window.location='home.php'</script>";
                                            } else {
                                                echo "<script type='text/javascript'> alert('การจองผิดพลาด')</script>";
                                            }

                                        }
        
                                       

                                    }
                                    
                                    
                                }
                                    
                                    
                                
                                ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /. ROW  -->

    </div>
    <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
    </div>
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
        if ($("#chenkin").val() !== "") {
            $("#chenkout").removeAttr("disabled");
            var dateMin = $('#chenkin').datepicker("getDate");
            var rMin = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + 1);

            $("#chenkout").datepicker('option', 'minDate', new Date(rMin));
        } else {
            $("#chenkout").val("");
            $("#chenkout").attr("disabled", "disabled");
        }
    }
    </script>

</body>


</html>