<?php
include 'db.php';
include 'date.php';
include 'query.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['premission']) == "Admin") {
    session_destroy();
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
    <link rel="stylesheet" href="/index/dormitory/css/image.css">
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
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap" rel="stylesheet">

</head>
<style>
    body {

        font-family: 'Prompt', sans-serif;
        font-weight: bold;
    }

    .td {
        width: 100%;
    }

    .ta {
        width: 100%;
        background-color: #FFDAB9;
        color: black;
    }

    .tb {
        width: 100%;
        background-color: #EEDD82;
        color: black;
    }

    .tc {
        background-color: #DCDCDC;
        color: black;
    }

    .tm {
        width: 100%;
        background-color: #CD853F;
        color: white;
    }
</style>

<body>

    <div id="wrapper">
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php" style="width:300px"> <?php echo $hd['header'] ?></lable> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i><?php echo $_SESSION["fname_A"]; ?>&nbsp <lable><?php echo $_SESSION["lname_A"]; ?> <i class="fa fa-caret-down"></i>
                            <span class="badge" style="background-color:red"><?php echo $_SESSION["premission_A"]; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="../logout.php" style="color:red" onclick="return confirm('ยืนยันการออกจากระบบ')"><i class="fa fa-sign-out fa-fw"></i> ออกจากระบบ</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <div style="background-color:#FF9900;color:black;font-size:20px" align="center">จัดการการจองห้องพัก</div>
                    </li>
                    <li>
                        <a href="home.php"><i class="fa fa-dashboard"></i> การจองห้อง <lable style="color:red">ใหม่ </lable><span class="badge"><?php echo $c; ?></span></a>
                    </li>
                    <!-- <li>
                        <a href="messages.php"><i class="fa fa-desktop" ></i> ประวัติการจองห้องพัก</a>
                    </li> -->
                    <li>
                        <div style="background-color:#FF9900;color:black;font-size:20px" align="center">จัดการห้องพักและผู้ใช้งาน</div>
                    </li>
                    <li>
                        <a href="month.php"><i class="fa fa-calendar-check-o"></i> การจัดการห้องพัก</a>
                    </li>
                    <li>
                        <a href="user.php"><i class="fa fa-user-circle"></i> จัดการผู้ใช้</a>
                    </li>
                    <li>
                        <a class="active-menu" href="receipt.php"><i class="fa fa-qrcode"></i> จัดการค่าเช่า รายเดือน </a>
                    </li>
                    <li>
                        <a href="price.php"><i class="fa fa-address-book"></i> ประวัติการชำระเงิน รายเดือน</a>
                    </li>
                    <li>
                        <div style="background-color:#FF9900;color:black;font-size:20px;" align="center">จัดการอื่นๆ</div>
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
                    <!-- <li>
                    <a href="/index/dormitory/logout.php"  onclick="return confirm('ยืนยันการออกจากระบบ')"><i class="fa fa-sign-out fa-fw" ></i> ออกจากระบบ</a>
                    </li> -->






            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <?php
        $date_check = array();

        $sql = "SELECT room.room as room,
        room_details.price as price,
        room.unitPerWater as unitPerWater,
        room.unitPerElectricity as unitPerElectricity 
        FROM `room` INNER JOIN room_details on(room.type = room_details.id)
        INNER JOIN room_type on(room_details.type = room_type.id) 
        WHERE room_details.reservation = '2' and room.room_status = 'ไม่ว่าง'
        ORDER BY room ASC";

        $rower = mysqli_query($con, $sql);

        $cce = mysqli_query($con, "SELECT max(date) as date_check  FROM `unit`");
        $ccv = mysqli_fetch_array($cce);

        array_push($date_check, $ccv['date_check']);

        list($year_c, $month_c, $day_c) = explode('-', $date_check[0]);

        $Year_now = $year_c + 543;
        $i = 0;





        ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            จัดการค่าเช่า รายเดือน
                        </h1>
                        <?php $Y = date('Y') + 543 ?>
                        <div style="color:red">ช่วงวันที่จดมิเตอร์ <?php echo $day_c . "/" . $month_c . "/" . $Year_now ?> ถึง <?php echo $d_now . "/" . $m_now . "/" . $Y ?></div>
                    </div>
                </div>

                <!-- /. ROW  -->

                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <form method='post' action=''>

                                        <button style="margin:5px;background-color:green" name="changedata" class='btn btn-primary' onclick="return confirm('ยืนยันการเปลี่ยนแปลงข้อมูล (หากบันทึกข้อมูล ไม่ถึง 20 วันของเดือนที่แล้ว จะทำการแก้ไข ข้อมูลเก่า)')"> ยืนยันการบันทึกข้อมูล</button>

                                        <p>

                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                            <thead>
                                                <tr>

                                                    
                                                    <th class="te" width="5%"><center>เลขห้อง</th>
                                                    <th class="te"><center>เดือน</th>
                                                    <th class="te" width="8%"><center>ค่าห้อง <input type="checkbox" id="price_r" onclick="EnableDisableTextBox(this)"></center>
                                                    </th>
                                                    <th class="te" width="5%"><center>น้ำหน่วยละ <input type="checkbox" id="W_unit" onclick="EnableDisableTextBox1(this)"></center>
                                                    </th>
                                                    <th class="te" width="8%"><center>จดครั้งก่อน</th>
                                                    <th class="te" width="8%"><center>จดครั้งหลัง</th>
                                                    <th class="te" width="5%"><center>หน่วยน้ำที่ใช้</th>
                                                    <th class="te" width="5%"><center>ค่าน้ำ</th>
                                                    <th class="te" width="5%"><center>ไฟหน่วยละ <input type="checkbox" id="E_unit" onclick="EnableDisableTextBox2(this)"></center>
                                                    </th>
                                                    <th class="te" width="8%"><center>จดครั้งก่อน</th>
                                                    <th class="te" width="8%"><center>จดครั้งหลัง</th>
                                                    <th class="te" width="5%"><center>หน่วยไฟที่ใช้</th>
                                                    <th class="te" width="5%"><center>ค่าไฟ</th>
                                                    <th class="te" width="7%"><center>อื่นๆ</th>
                                                    <th class="te" width="5%"><center>รวม(บาท)</th>
                                                    <th class="te" width="5%"><center>ค้นหาประวัติ</th>
                                                    

                                                </tr>

                                            </thead>

                                            <tbody>
                                                <?php

                                                list($y, $m, $d) = explode("-", $ccv['date_check']);

                                                $m = $m - 1;
                                                if ($m == 0) {
                                                    $y = $y - 1;
                                                    $m = 12;
                                                }
                                                $d = (string)$d;
                                                if ($d <= 9) {
                                                    $d = "0$d";
                                                }
                                                if ($m <= 9) {
                                                    $m = "0$m";
                                                }

                                                $date_check_month =  "$y-$m-$d";

                                                $qli = mysqli_query($con, "SELECT * FROM unit 
                                                WHERE MONTH(date) >= '$m' 
                                                and MONTH(date) < '$m_now' 
                                                and YEAR(date) >= '$y'");
                                                $dck = mysqli_fetch_array($qli);

                                                while ($type = mysqli_fetch_array($rower)) {
                                                    $id = $type['room'];
                                                    $last_date_unit_ = mysqli_query($con, "SELECT max(date) as date_check_room  FROM `unit` WHERE room = $id ");

                                                    while ($last_date_unit_room = mysqli_fetch_array($last_date_unit_)) {
                                                        // echo $m_last_unit." /  $m_now <br>";
                                                        list($y_last_unit, $m_last_unit, $d_last_unit) = explode("-", $last_date_unit_room['date_check_room']);
                                                        // echo $m_last_unit." /  $m_now <br>";
                                                        $sum_date_check_last = $m_now - $m_last_unit;
                                                        $month_drop = $m_now - $m_last_unit;
                                                        if ($sum_date_check_last == "1") {
                                                            // echo "$sum_date_check_last / $id<br>";
                                                            // echo $dck['date'] ."<br>";

                                                            if ($month_drop == '0') {
                                                                // echo $id." 0<br>";
                                                                $drd = mysqli_query($con, "SELECT * FROM `unit` WHERE date = '" .  $date_check[0] . "' and room = $id");
                                                                $date_n = mysqli_fetch_array($drd);
                                                            } else {
                                                                // echo $id." 1<br>";   
                                                                $drd = mysqli_query($con, "SELECT * FROM `unit` WHERE date = '" . $dck['date'] . "' and room = $id");
                                                                if ($date_n = mysqli_fetch_array($drd)) {
                                                                    // echo $id." / $dck[date]<br>";
                                                                    $drd = mysqli_query($con, "SELECT * FROM `unit` WHERE date = '" . $dck['date'] . "' and room = $id");
                                                                    $date_n = mysqli_fetch_array($drd);
                                                                } else {
                                                                    // echo $id." / $date_check[0]<br>";
                                                                    $drd = mysqli_query($con, "SELECT * FROM `unit` WHERE date = '" . $date_check[0] . "' and room = $id");
                                                                    $date_n = mysqli_fetch_array($drd);
                                                                }
                                                            }
                                                        } else {
                                                            // echo "$sum_date_check_last / $id / $date_check[0] <br>";
                                                            $drd = mysqli_query($con, "SELECT * FROM `unit` WHERE date = '" . $date_check[0] . "' and room = $id");
                                                            $date_n = mysqli_fetch_array($drd);
                                                        }
                                                    }
                                                    // $drd = mysqli_query($con, "SELECT * FROM `unit` WHERE date = '" . $date_check[0] . "' and room = $id");
                                                    list($y_last_year, $m_last_month, $d_last_day) = explode("-", $ccv['date_check']);


                                                    echo "
                                                    <tr>
                                                    
                                                
                                                    <input type='hidden' name='chkl[ ]' value='" . $type['room'] . "'>
                                                    
                                                    <th class='tc'>$id</th>
                                                    <th class='tc'>";
                                                    if ($sum_date_check_last == "1") {
                                                        echo '<lable style="color:red">' . $m_last_unit . "/" . $y_last_unit . '</lable>';
                                                    } else {
                                                        if ($m_now - $m_last_month == '0' and $d_last_day < '20') {
                                                            echo '<lable style="color:black">' . $m_last_month . "/" . $y_last_year . '</lable>';
                                                        } else if ($m_now - $m_last_month == '0' and $d_last_day >= '20') {
                                                            echo '<lable style="color:green">' . $m_last_month . "/" . $y_last_year . '</lable>';
                                                        }
                                                    }
                                                    echo "</th>
                                                    <th class='tc'><input type='text' name='price[ ]' id='price$i' value='" . $type['price'] . "' class='td' onchange=\"return checkWoE(this)\" min='0' pattern='[0-9]+' disabled='disabled' ></th>
                                                

                                                    <th class='tc'><input type='number' value=" . $type['unitPerWater'] . " name='unitW[ ]' id='unitW$i' class='ta' onchange=\"return checkWoE(this)\"  min='0' pattern='[0-9]+' disabled='disabled'></th>
                                                    <th class='tc'><input type='number' pattern='[0-9]+' class='ta' name='perW[ ]' id='perW$i' onchange=\"return checkWoE(this)\" value='";
                                                    if ($date_n['last_unit_water'] == null) {
                                                        echo "";
                                                    } else {
                                                        echo $date_n['last_unit_water'];
                                                    }
                                                    echo "'></th>
                                                    <th class='tc'><input type='number' pattern='[0-9]+' class='ta' name='newW[ ]' id='newW$i' onchange=\"return checkWoE(this)\" ></th>
                                                    <th class='tc'>
                                                    <lable name='unitwt' id='unitwt$i'  style='color:red'></lable>
                                                    
                                                    </th>
                                                    <th class='tc'><lable name='sumwt' id='sumwt$i' style='color:red'></lable></th>
                                                
                                                    <th class='tc'><input type='number' pattern='[0-9]+' value=" . $type['unitPerElectricity'] . "  name='unitE[ ]' id='unitE$i' onchange=\"return checkWoE(this)\" class='tb' disabled='disabled'></th>
                                                    <th class='tc'><input type='number' pattern='[0-9]+' class='tb'  name='perE[ ]' id='perE$i' onchange=\"return checkWoE(this)\" value='";
                                                    if ($date_n['last_unit_electricity'] == null) {
                                                        echo "";
                                                    } else {
                                                        echo $date_n['last_unit_electricity'];
                                                    }
                                                    echo "'></th>
                                                    <th class='tc'><input type='number' pattern='[0-9]+' class='tb' name='newE[ ]' id='newE$i' onchange=\"return checkWoE(this)\" ></th>
                                                    <th class='tc'>
                                                    <lable name='unitele' id='unitele$i'  style='color:red'></lable>
                                                    </th>
                                                    <input type='hidden' id='total_unitE$i' name='total_unitE[ ]' onchange=\"return checkWoE(this)\">
                                                    <input type='hidden' id='total_unitW$i' name='total_unitW[ ]' onchange=\"return checkWoE(this)\">
                                                    <th class='tc'><lable name='sume' id='sume$i' style='color:red'></lable></th>

                                                    <th class='tc'><input pattern='[0-9]+' id='other$i' type='number' name='other[ ]'  class='tm' value='";
                                                    if (empty($date_n['other'])) {
                                                        echo "0";
                                                    } else {
                                                        echo $date_n['other'];
                                                    }
                                                    echo "' onchange=\"return checkWoE(this)\"></th>
       
                                                    <th class='tc'>
                                                    <lable id='sumtotal$i'></lable>
                                                    <input type='hidden' id='sumtotala$i' name='sum_total[ ]' onchange=\"return checkWoE(this)\">
                                                    </th>
                                                    <th><a href='history_payment.php?overdue=" . $id . "' <button  class='btn btn-success'><i class='fa fa-clock-o'></i></button></th>
                                                    </tr>
                                                
                                                    ";
                                                    $i++;
                                                }

                                                ?>
                                                <thead>
                                                    <tr>
                                                        <th>

                                    </form>
                                    </th>
                                    </tr>
                                    </thead>

                                    </tbody>

                                    </table>
                                    <lable style='color:red'>*กรุณาบันทึกข้อมูล ทุกวันที่ 20 ของเดือน เป็นต้นไปและไม่เกิน สิ้นเดือน หากทำการบันทึกข้อมูลไม่ถึงวันที่ 20 ของเดือน จะทำการแก้ไขข้อมูลเก่า</lable>
                                    <div style='color:red'>*กรุณาระบุบข้อมูลให้เสร็จสิ้นภายในวันเดียวกัน</div>
                                </div>
                                <!-- /. ROW  -->
                            </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['changedata'])) {
                        $A = array(); //หน่วยนํ้า
                        $B = array(); //หน่วยไฟ
                        $C = array(); //ราคาห้อง
                        $D = array(); //นํ้าหลัง
                        $E = array(); //ไฟหลัง
                        $F = array(); //อื่นๆ
                        $G = array(); //นํ้าก่อน
                        $H = array(); //ไฟก่อน
                        $total_unitE = array();
                        $total_unitW = array();
                        $sum_total = array();
                        $clk = $_POST['chkl']; //ห้อง
                        $perW = $_POST['perW']; //นํ้าก่อน
                        $newW = $_POST['newW']; //นํ้าหลัง
                        $perE = $_POST['perE']; //ไฟก่อน
                        $newE = $_POST['newE']; //ไฟหลัง
                        $pricetype = $_POST['price']; //ราคาห้อง
                        $unitW = $_POST['unitW']; //หน่วยนํ้า
                        $unitE = $_POST['unitE']; //หน่วยไฟ
                        $other = $_POST['other']; //อื่นๆ
                        $total_unitEE = $_POST['total_unitE']; //หน่วยไฟรวม
                        $total_unitWW = $_POST['total_unitW']; //หน่วยนํ้ารวม
                        $sumtotal = $_POST['sum_total'];
                        $j = 0;
                        foreach ($sumtotal as $key) {
                            array_push($sum_total, "$key");
                        }
                        foreach ($total_unitWW as $key) {
                            array_push($total_unitW, "$key");
                        }
                        foreach ($total_unitEE as $key) {
                            array_push($total_unitE, "$key");
                        }
                        foreach ($perE as $key) {
                            array_push($H, "$key");
                        }
                        foreach ($perW as $key) {
                            array_push($G, "$key");
                        }
                        foreach ($other as $key) {
                            array_push($F, "$key");
                        }
                        foreach ($unitE as $key) {
                            array_push($B, "$key");
                        }
                        foreach ($pricetype as $key) {
                            array_push($C, "$key");
                        }
                        foreach ($newW as $key) {
                            array_push($D, "$key");
                        }
                        foreach ($newE as $key) {
                            array_push($E, "$key");
                        }
                        foreach ($unitW as $key) {
                            array_push($A, "$key");
                        }
                        $i = 0;

                        foreach ($clk as $room) {

                            $last_date_unit_t = mysqli_query($con, "SELECT max(date) as date_check_room  FROM `unit` WHERE room = $room ORDER BY room ASC");
                            while ($last_date_unit_room2 = mysqli_fetch_array($last_date_unit_t)) {

                                list($y_last_unit2, $m_last_unit2, $d_last_unit2) = explode("-", $last_date_unit_room2['date_check_room']);
                                // echo $m_last_unit." /  $m_now <br>";
                                $sum_date_check_last2 = $m_now - $m_last_unit2;
                                // echo $sum_date_check_last2."<br>";   
                                if ($sum_date_check_last2 == "1") {
                                    // echo "$sum_date_check_last / $id<br>";
                                    // echo $dck['date'] ."<br>";
                                    if ($month_drop == '0') {
                                        // echo $id." 0<br>";
                                        $check_unit = mysqli_query($con, "SELECT * FROM `unit` 
                                        WHERE date = '$date_check[0]' and room = '$room'");
                                    } else {
                                        // echo $id." 1<br>";
                                        $check_unit = mysqli_query($con, "SELECT * FROM `unit` 
                                        WHERE date = '" . $dck['date'] . "' and room = '$room'");

                                        if ($check_unitN = mysqli_fetch_array($check_unit)) {
                                            $check_unit = mysqli_query($con, "SELECT * FROM `unit` 
                                            WHERE date = '" . $dck['date'] . "' and room = '$room'");
                                        } else {
                                            $check_unit = mysqli_query($con, "SELECT * FROM `unit` 
                                            WHERE date = '" . $date_check[0] . "' and room = '$room'");
                                        }
                                    }
                                } else {
                                    // echo "$sum_date_check_last / $id<br>";
                                    $check_unit = mysqli_query($con, "SELECT * FROM `unit` 
                                    WHERE date = '$date_check[0]' and room = '$room'");
                                }
                            }

                            $check_unitN = mysqli_fetch_array($check_unit);
                            // echo $room."/ $check_unitN[room] <br>";
                            if ($room == $check_unitN['room'] and $check_unitN['last_unit_water'] != null) {

                                if ($d_now >= '20') {
                                    echo "น้ำ : " . $total_unitWW[$i] . '<br>';
                                    echo "ไฟ : " . $total_unitEE[$i] . '<br>';
                                    echo "รวม : " . $sum_total[$i] . '<br>';
                                    // echo "วันที่ : ".$dck['date'].'<br>';

                                    if ($total_unitWW[$i] == null and $total_unitEE[$i] == null and $sum_total[$i] == null) {
                                        echo "<script type='text/javascript'> alert('กรุณากรอกข้อมูลค่าน้ำ-ค่าไฟ ห้อง $room ให้ถูกต้อง')</script>";
                                    } else if ($sum_date_check_last2 == '1') {
                                        echo "ห้อง : $room <br>";
                                        echo "วันที่เก่ากัน(เก่า) <br>";
                                        if ($G[$i] != null and $H[$i] != null and $D[$i] != null and $E[$i] != null) {
                                            echo "น้ำก่อน ไม่ว่าง/ไฟก่อน ไม่ว่าง  และ น้ำหลัง ไม่ว่าง/ไฟหลัง ไม่ว่าง  <br>";
                                            echo $dck['date'];

                                            $ei = mysqli_query($con, "UPDATE `unit` SET`last_unit_water`='$G[$i]',
                                                `last_unit_electricity`='$H[$i]',
                                                `other`='$F[$i]'
                                                WHERE room = $room and date = '$dck[date]'");

                                            $sqlie = "INSERT INTO `unit`
                                                ( `room`, `last_unit_water`, `last_unit_electricity`, `other`, `date`) 
                                                VALUES ('$room','$D[$i]','$E[$i]','$F[$i]','$date')";

                                            mysqli_query($con, "INSERT INTO `receipt`(`room`, `date`,
                                                `totalWater`, `totalElectricity`, `receipt_total`, `payRent`) 
                                                VALUES ('$room',
                                                '$date',
                                                '$total_unitWW[$i]',
                                                '$total_unitEE[$i]',
                                                '$sum_total[$i]',
                                                '0')");
                                            mysqli_query($con, $sqlie);
                                            // echo $room.$date.$total_unitWW[$i].$total_unitEE[$i].$sum_total[$i];

                                        } else if ($G[$i] != null and $H[$i] != null and $D[$i] == null and $E[$i] == null) {

                                            echo "น้ำก่อน ไม่ว่าง/ไฟก่อน ไม่ว่าง  และ น้ำหลัง ว่าง/ไฟหลัง ว่าง  <br>";
                                        } else if ($G[$i] != null and $H[$i] != null and $D[$i] != null and $E[$i] == null) {
                                            echo "น้ำก่อน ไม่ว่าง/ไฟก่อน ไม่ว่าง  และ น้ำหลัง ไม่ว่าง/ไฟหลัง ว่าง  <br>";

                                            mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_water`='$D[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$date_check[0]' and room = '$room'");

                                            mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_water`='$G[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$dck[date]' and room = '$room'");

                                            mysqli_query($con, "UPDATE `receipt` SET
                                                `totalWater`='$total_unitWW[$i]',
                                                `totalElectricity`='$total_unitEE[$i]',
                                                `receipt_total`='$sum_total[$i]' 
                                                WHERE room = $room and date == '$date_check[0]'");
                                        } else if ($G[$i] != null and $H[$i] != null and $D[$i] == null and $E[$i] != null) {
                                            echo "น้ำก่อน ไม่ว่าง/ไฟก่อน ไม่ว่าง  และ น้ำหลัง ว่าง/ไฟหลัง ไม่ว่าง  <br>";
                                            mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_electricity`='$E[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$date_check[0]' and room = '$room'");

                                            mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_electricity`='$H[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$dck[date]' and room = '$room'");

                                            mysqli_query($con, "UPDATE `receipt` SET
                                                `totalWater`='$total_unitWW[$i]',
                                                `totalElectricity`='$total_unitEE[$i]',
                                                `receipt_total`='$sum_total[$i]' 

                                                WHERE room = $room and date == '$date_check[0]'");
                                        }
                                    } else if ($sum_date_check_last2 > '1' or $sum_date_check_last2 < '1') {
                                        echo "ห้อง : $room <br>";
                                        echo "วันที่ไม่เก่ากัน(ใหม่)  <br>";
                                        if ($G[$i] != null and $H[$i] != null and $D[$i] != null and $E[$i] != null) {
                                            echo "น้ำก่อน ไม่ว่าง/ไฟก่อน ไม่ว่าง  และ น้ำหลัง ไม่ว่าง/ไฟหลัง ไม่ว่าง  <br>";
                                            echo $date_check[0];

                                            mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_water`='$D[$i]',
                                                `last_unit_electricity`='$E[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$date_check[0]' and room = '$room'");

                                            mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_water`='$G[$i]',
                                                `last_unit_electricity`='$H[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$dck[date]' and room = '$room'");

                                            mysqli_query($con, "UPDATE `receipt` SET
                                                `totalWater`='$total_unitWW[$i]',
                                                `totalElectricity`='$total_unitEE[$i]',
                                                `receipt_total`='$sum_total[$i]' 
                                                WHERE room = $room and date == '$date_check[0]'");
                                        } else if ($G[$i] != null and $H[$i] != null and $D[$i] == null and $E[$i] == null) {

                                            echo "น้ำก่อน ไม่ว่าง/ไฟก่อน ไม่ว่าง  และ น้ำหลัง ว่าง/ไฟหลัง ว่าง  <br>";
                                        } else if ($G[$i] != null and $H[$i] != null and $D[$i] != null and $E[$i] == null) {
                                            echo "น้ำก่อน ไม่ว่าง/ไฟก่อน ไม่ว่าง  และ น้ำหลัง ไม่ว่าง/ไฟหลัง ว่าง  <br>";

                                            mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_water`='$D[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$date_check[0]' and room = '$room'");

                                            mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_water`='$G[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$dck[date]' and room = '$room'");

                                            mysqli_query($con, "UPDATE `receipt` SET
                                                `totalWater`='$total_unitWW[$i]',
                                                `totalElectricity`='$total_unitEE[$i]',
                                                `receipt_total`='$sum_total[$i]' 
                                                WHERE room = $room and date == '$date_check[0]'");
                                        } else if ($G[$i] != null and $H[$i] != null and $D[$i] == null and $E[$i] != null) {
                                            echo "น้ำก่อน ไม่ว่าง/ไฟก่อน ไม่ว่าง  และ น้ำหลัง ว่าง/ไฟหลัง ไม่ว่าง  <br>";
                                            mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_electricity`='$E[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$date_check[0]' and room = '$room'");

                                            mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_electricity`='$H[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$dck[date]' and room = '$room'");

                                            mysqli_query($con, "UPDATE `receipt` SET
                                                `totalWater`='$total_unitWW[$i]',
                                                `totalElectricity`='$total_unitEE[$i]',
                                                `receipt_total`='$sum_total[$i]' 
                                                WHERE room = $room and date == '$date_check[0]'");
                                        }
                                    } //จบการทำงาน วันที่ไม่เท่ากัน และเท่ากัน
                                } //จบการทำงาน วันที่เกิน 20 วัน

                                else {
                                    if ($G[$i] != null and $H[$i] != null and $D[$i] != null and $E[$i] != null) {
                                        echo "น้ำก่อน ไม่ว่าง/ไฟก่อน ไม่ว่าง  และ น้ำหลัง ไม่ว่าง/ไฟหลัง ไม่ว่าง  <br>";
                                        echo $date_check[0];

                                        mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_water`='$D[$i]',
                                                `last_unit_electricity`='$E[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$date_check[0]' and room = '$room'");

                                        mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_water`='$G[$i]',
                                                `last_unit_electricity`='$H[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$dck[date]' and room = '$room'");

                                        mysqli_query($con, "UPDATE `receipt` SET
                                                `totalWater`='$total_unitWW[$i]',
                                                `totalElectricity`='$total_unitEE[$i]',
                                                `receipt_total`='$sum_total[$i]' 
                                                WHERE room = $room and date == '$date_check[0]'");
                                    } else if ($G[$i] != null and $H[$i] != null and $D[$i] == null and $E[$i] == null) {

                                        echo "น้ำก่อน ไม่ว่าง/ไฟก่อน ไม่ว่าง  และ น้ำหลัง ว่าง/ไฟหลัง ว่าง  <br>";
                                    } else if ($G[$i] != null and $H[$i] != null and $D[$i] != null and $E[$i] == null) {
                                        echo "น้ำก่อน ไม่ว่าง/ไฟก่อน ไม่ว่าง  และ น้ำหลัง ไม่ว่าง/ไฟหลัง ว่าง  <br>";

                                        mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_water`='$D[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$date_check[0]' and room = '$room'");

                                        mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_water`='$G[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$dck[date]' and room = '$room'");

                                        mysqli_query($con, "UPDATE `receipt` SET
                                                `totalWater`='$total_unitWW[$i]',
                                                `totalElectricity`='$total_unitEE[$i]',
                                                `receipt_total`='$sum_total[$i]' 
                                                WHERE room = $room and date == '$date_check[0]'");
                                    } else if ($G[$i] != null and $H[$i] != null and $D[$i] == null and $E[$i] != null) {
                                        echo "น้ำก่อน ไม่ว่าง/ไฟก่อน ไม่ว่าง  และ น้ำหลัง ว่าง/ไฟหลัง ไม่ว่าง  <br>";
                                        mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_electricity`='$E[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$date_check[0]' and room = '$room'");

                                        mysqli_query($con, "UPDATE `unit` SET 
                                                `last_unit_electricity`='$H[$i]',
                                                `other`='$F[$i]' 
                                                WHERE date = '$dck[date]' and room = '$room'");

                                        mysqli_query($con, "UPDATE `receipt` SET
                                                `totalWater`='$total_unitWW[$i]',
                                                `totalElectricity`='$total_unitEE[$i]',
                                                `receipt_total`='$sum_total[$i]' 
                                                WHERE room = $room and date == '$date_check[0]'");
                                    }
                                } //จบการทำงาน วันที่ไม่เข้าเงื่อนไข

                            } else if ($room ==  $check_unitN['room'] and $check_unitN['last_unit_water'] == null) {
                                echo "ห้องใหม่ ห้อง : $room";
                                if ($d_now >= '20') {
                                    echo "F <br>";
                                    if ($G[$i] == null and $H[$i] == null and $D[$i] == null and $E[$i] == null) {
                                        echo "<script type='text/javascript'> alert('กรุณากรอกข้อมูลค่าน้ำ-ค่าไฟ ห้อง $room ให้ถูกต้อง')</script>";
                                    } else {
                                        $ei = mysqli_query($con, "UPDATE `unit` SET 
                                        `last_unit_water`='$D[$i]',
                                        `last_unit_electricity`='$E[$i]',
                                        `other`='$F[$i]' 
                                        WHERE room = '$room'");

                                        // echo "ห้อง : $room <br>";
                                        // echo "น้ำ : $total_unitWW[$i] <br>";
                                        // echo "ไฟ : $total_unitEE[$i] <br>";
                                        // echo "รวม : $sum_total[$i] <br>";

                                        mysqli_query($con, "UPDATE `receipt` 
                                        SET `totalWater`='$total_unitWW[$i]',
                                        `totalElectricity`='$total_unitEE[$i]',
                                        `receipt_total`='$sum_total[$i]' 
                                        WHERE  room = $room ");
                                    }
                                } else {
                                    echo "G <br>";
                                    mysqli_query($con, "UPDATE `unit` SET 
                                    `last_unit_water`='$G[$i]',
                                    `last_unit_electricity`='$H[$i]',
                                    `other`='$F[$i]' 
                                    WHERE date = '$date_check[0]' and room = '$room'");

                                    mysqli_query($con, "UPDATE `receipt` SET
                                    `totalWater`='$total_unitWW[$i]',
                                    `totalElectricity`='$total_unitEE[$i]',
                                    `receipt_total`='$sum_total[$i]' 
                                    WHERE room = $room and date == '$date_check[0]'");
                                }
                            }
                            if($A[$i] != null or $B[$i] != null){
                                mysqli_query($con, "UPDATE `room` SET `unitPerWater`='$A[$i]',`unitPerElectricity`='$B[$i]' 
                                WHERE room = $room");
                            }
                            $i++;
                        }
                        $sqlie = "INSERT INTO event_log (personal,date,time,event) 
                        VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time',
                        '" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " จัดการ ค่านํ้า/ไฟ และค่าใช้จ่ายอื่นๆ')";
                        mysqli_query($con, $sqlie);

                        echo "<script type='text/javascript'> alert('บันทึกการเปลี่ยนแปลงวันที่ $date $A[$i] สำเร็จ')</script>";
                        echo "<script type='text/javascript'> window.location='receipt.php'</script>";
                    }
                    ?>

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

    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable();
        });
    </script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>




</body>

</html>
<div id="total_unitE0"></div>
<script>
    var price = document.getElementById("price_r").checked;
    var W_unit = document.getElementById("W_unit").checked;
    var E_unit = document.getElementById("E_unit").checked;

    function EnableDisableTextBox(price) {
        for (let i = 0; i <= '500'; i++) {
            var price1 = document.getElementById("price" + i);
            price1.disabled = price.checked ? false : true;
            if (!price1.disabled) {
                price1.focus();
            }
        }
    }

    function EnableDisableTextBox1(W_unit) {
        for (let i = 0; i <= '500'; i++) {
            var W_unit1 = document.getElementById("unitW" + i);
            W_unit1.disabled = W_unit.checked ? false : true;
            if (!W_unit1.disabled) {
                W_unit1.focus();
            }
        }
    }
    
    function EnableDisableTextBox2(E_unit) {
        for (let i = 0; i <= '500'; i++) {
            var E_unit1 = document.getElementById("unitE" + i);
            E_unit1.disabled = E_unit.checked ? false : true;
            if (!E_unit1.disabled) {
                E_unit1.focus();
            }
        }
    }
</script>
<script>
    function checkWoE() {
        for (let i = 0; i <= 1000000;) {

            var price = document.getElementById('price' + i).value;
            var perW = document.getElementById('perW' + i).value;
            var newW = document.getElementById('newW' + i).value;
            var unitW = document.getElementById('unitW' + i).value;
            var other = document.getElementById('other' + i).value;
            switch (newW) {
                case '':
                    var sumw = (((perW - perW) * unitW));
                    var unitwt = (perW - perW);
                    break;
                case '0':
                    var sumw = (((perW - perW) * unitW));
                    var unitwt = (perW - perW);
                    break;
                default:
                    var sumw = (((newW - perW) * unitW));
                    var unitwt = (newW - perW);
                    break;
            }



            document.getElementById("sumwt" + i).innerHTML = (sumw);
            document.getElementById("unitwt" + i).innerHTML = (unitwt);

            var perE = document.getElementById('perE' + i).value;
            var newE = document.getElementById('newE' + i).value;
            var unitE = document.getElementById('unitE' + i).value;

            switch (newE) {
                case '':
                    var sume = (((perE - perE) * unitE));
                    var unitele = (perE - perE);
                    break;
                case '0':
                    var sume = (((perE - perE) * unitE));
                    var unitele = (perE - perE);
                    break;
                default:
                    var sume = ((newE - perE) * unitE);
                    var unitele = (newE - perE);
                    break;
            }


            document.getElementById("sume" + i).innerHTML = (sume);
            document.getElementById("unitele" + i).innerHTML = (unitele);


            var total = parseInt(sumw) + parseInt(sume) + parseInt(price) + parseInt(other);

            document.getElementById("sumtotal" + i).innerHTML = (total);
            var monney = document.getElementById("sumtotala" + i).value = total;
            var thaibath = ArabicNumberToText(monney);


            switch (newE) {
                case '':
                    var total_unitE = (perE - perE);
                    break;
                default:
                    var total_unitE = (newE - perE);
                    break;
            }

            switch (newW) {
                case '':
                    var total_unitW = (perW - perW);
                    break;
                default:
                    var total_unitW = (newW - perW);
                    break;
            }


            document.getElementById("total_unitE" + i).value = total_unitE;

            document.getElementById("total_unitW" + i).value = total_unitW;


            i = i + 1;

        }



    }
</script>
<script type="text/javascript">

</script>

<script type="text/javascript">
    // "use strict";

    function ArabicNumberToText(Number) {
        var Number = CheckNumber(Number);
        var NumberArray = new Array("ศูนย์", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า", "สิบ");
        var DigitArray = new Array("", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน", "ล้าน");
        var BahtText = "";
        if (isNaN(Number)) {
            return "ข้อมูลนำเข้าไม่ถูกต้อง";
        } else {
            if ((Number - 0) > 9999999.9999) {
                return "ข้อมูลนำเข้าเกินขอบเขตที่ตั้งไว้";
            } else {
                Number = Number.split(".");
                if (Number[1].length > 0) {
                    Number[1] = Number[1].substring(0, 2);
                }
                var NumberLen = Number[0].length - 0;
                for (var i = 0; i < NumberLen; i++) {
                    var tmp = Number[0].substring(i, i + 1) - 0;
                    if (tmp != 0) {
                        if ((i == (NumberLen - 1)) && (tmp == 1)) {
                            BahtText += "เอ็ด";
                        } else
                        if ((i == (NumberLen - 2)) && (tmp == 2)) {
                            BahtText += "ยี่";
                        } else
                        if ((i == (NumberLen - 2)) && (tmp == 1)) {
                            BahtText += "";
                        } else {
                            BahtText += NumberArray[tmp];
                        }
                        BahtText += DigitArray[NumberLen - i - 1];
                    }
                }
                if (Number[0] == "0") {
                    BahtText += "ศูนย์บาท";
                } else {
                    BahtText += "บาท";
                }
                if ((Number[1] == "0") || (Number[1] == "00")) {
                    BahtText += "ถ้วน";
                } else {
                    DecimalLen = Number[1].length - 0;
                    for (var i = 0; i < DecimalLen; i++) {
                        var tmp = Number[1].substring(i, i + 1) - 0;
                        if (tmp != 0) {
                            if ((i == (DecimalLen - 1)) && (tmp == 1)) {
                                BahtText += "เอ็ด";
                            } else
                            if ((i == (DecimalLen - 2)) && (tmp == 2)) {
                                BahtText += "ยี่";
                            } else
                            if ((i == (DecimalLen - 2)) && (tmp == 1)) {
                                BahtText += "";
                            } else {
                                BahtText += NumberArray[tmp];
                            }
                            BahtText += DigitArray[DecimalLen - i - 1];
                        }
                    }
                    BahtText += "สตางค์";
                }
                return BahtText;
            }
        }
    }

    function CheckNumber(Number) {
        var decimal = false;
        Number = Number.toString();
        Number = Number.replace(/ |,|บาท|฿/gi, '');
        for (var i = 0; i < Number.length; i++) {
            if (Number[i] == '.') {
                decimal = true;
            }
        }
        if (decimal == false) {
            Number = Number + '.00';
        }
        return Number
    }
</script>