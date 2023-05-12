<?php
if (!isset($_SESSION)) {
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
    $(function() {
        $("#room").change(function() {
            if ($(this).val() == "2") {
                $("#floorbox").show();
            } else {
                $("#floorbox").hide();
            }
        });
    });
    </script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap"
        rel="stylesheet">


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Add jQuery library -->
    <script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>

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
}

.status2 {
    border: 1px solid black;
    background-color: red;
    color: white;
    border-radius: 5px;
}

.status3 {
    border: 1px solid;
    background-color: light;
    color: black;
    border-radius: 5px;
}

.status4 {
    border: 1px solid;
    background-color: #00FFFF;
    color: black;
    border-radius: 5px;  
}

.errors {
    color: white;
    background-color: #CD5C5C;
    margin: 10px 0px;
    width: 70%;
    border-radius: 10px;
    padding: 10px;
}
.new{
    color:green;
    background-color:#DCDCDC;
    padding:0px 5px;
    border:1px solid black;
    border-radius:5px;
    font-size:12px;
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
                <a class="navbar-brand" href="home.php" style="width:300px"> <?php echo $hd['header'] ?></lable> </a>
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
                        <li><a href="../logout.php" style="color:red"
                                onclick="return confirm('ยืนยันการออกจากระบบ')"><i class="fa fa-sign-out fa-fw"></i>
                                ออกจากระบบ</a>
                        </li>
                    </ul>
            </ul>
            <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
            </ul>
        </nav>

        <?php

        $sql = "SELECT * FROM reserve";
        $re = mysqli_query($con, $sql);
        $c = 0;

        $sqlbank = "SELECT reserve_status FROM reserve GROUP BY reserve_status";
        $result = $con->query($sqlbank);

        ?>
        <?php

        // if($y_now == $y_p and $m_now == $m_p){
        //     $total_date = $d_now - $d_p;
        //     // echo $total_date."<br>";
        // }else if($y_now == $y_p and $m_now > $m_p){

        //     $date = date('d-m-Y');
        //     $dod = date("t", strtotime($date));                                                                                 
        //             $total_date = $dod - $d_p;
        //             $total_date  += $d_now;
        //     // echo $total_date."<br>";
            
        // }


        $sqlee = "SELECT * FROM reserve WHERE day_reserve = '$date'";
        $re = mysqli_query($con, $sqlee);
        $g = 0;
        while ($row1 = mysqli_fetch_array($re)) {


        // list($y_p, $m_p, $d_p) = explode('-', $last_date_reserve['day_reserve']);
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
                    <!-- <li>
                        <a href="messages.php"><i class="fa fa-desktop" ></i> ประวัติการจองห้องพัก</a>
                    </li> -->
                    <li>
                        <div style="background-color:#FF9900;color:black;font-size:20px" align="center">
                            จัดการห้องพักและผู้ใช้งาน</div>
                    </li>
                    <li>
                        <a href="month.php"><i class="fa fa-calendar-check-o"></i> การจัดการห้องพัก</a>
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
                            รายงาน<small>การจองห้อง </small>
                            <?php if (isset($_SESSION['reserve'])) : ?>
                            <center>
                                <div class="errors">
                                    <h3>
                                        <?php
                                            echo "<center>" . $_SESSION['reserve'];
                                            unset($_SESSION['reserve']);
                                            ?>
                                    </h3>
                                </div>
                            </center>
                            <?php endif ?>
                        </h1>

                    </div>
                </div>
                <!-- /. ROW  -->
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">
                                    <div class="panel">
                                        <? /*panel-primary */ ?>
                                        <div class="" style="float:left">
                                            <a href="roombook_insert.php"><button type="submit" name="search"
                                                    for="search1" class="btn btn-primary" style="float: right;">+
                                                    เพิ่มการจอง</button></a>
                                        </div>


                                        <form action="" method="post">
                                            <button class='btn btn-danger' name="delall"
                                                style="float:left;margin-left:20px;"
                                                onclick="return confirm('คุณต้องการ[ลบ]ข้อมูลที่เลือก ใช่หรือไม่?')">ลบที่เลือก</button>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!-- Advanced Tables -->
        
                                                            <div class="table-responsive">
                                                                <br>
                                                                <table
                                                                    class="table table-striped table-bordered table-hover"
                                                                    id="dataTables-example">

                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                <center>ทั้งหมด</center>
                                                                                <input type="checkbox" class="checkmark"
                                                                                    name="css_all_check"
                                                                                    id="css_all_check" />
                                                                            </th>
                                                                            <script
                                                                                src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">
                                                                            </script>
                                                                            <script type="text/javascript">
                                                                            $(function() {
                                                                                $("#css_all_check").click(
                                                                                    function() { // เมื่อคลิกที่ checkbox ตัวควบคุม
                                                                                        if ($(this).prop(
                                                                                                "checked"
                                                                                            )) { // ตรวจสอบค่า ว่ามีการคลิกเลือก
                                                                                            $(".checkmark")
                                                                                                .prop(
                                                                                                    "checked",
                                                                                                    true
                                                                                                ); // กำหนดให้ เลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด 
                                                                                        } else { // ถ้าไม่มีการ ยกเลิกการเลือก
                                                                                            $(".checkmark")
                                                                                                .prop(
                                                                                                    "checked",
                                                                                                    false
                                                                                                ); // กำหนดให้ ยกเลิกการเลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด 
                                                                                        }
                                                                                    });
                                                                            });
                                                                            </script>
                                                                            <th><center>ลำดับ</center></th>
                                                                            <th><center>ชื่อ-นามสกุล</th>
                                                                            <th><center>วันที่เข้าอยู่<br>วันที่ออก</th>
                                                                            <th><center>จำนวนห้อง</center></th>
                                                                            <th><center>ประเภท</th>
                                                                            <th><center>ชนิด</th>
                                                                            <th><center>ยานพาหนะ</th>
                                                                            <th><center>เงินโอน/ที่ต้องชำระ</th>
                                                                            <th><center>คงเหลือ</th>
                                                                            <th><center>สถานะ</th>
                                                                            <th><center>รายละเอียด</th>
                                                                            <th><center>ลบ</th>
                                                                            <th><center>แก้ไข</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php


                                                                        
                                                                        
                                                                            $tsql = "SELECT reserve.car as car,reserve.pay as pay,reserve.reservation_id,room_type.name as name, reserve.reserve_status, 
                                                                            reserve.reservation_money,reserve.proof_of_transfer,reserve.prefix_name, reserve.fname, 
                                                                            reserve.lname, reserve.phone, room_category.name AS cname, room_details.floor, reserve.prefix_name,
                                                                            reserve.fname, reserve.lname, reserve.phone, reserve.day_reserve,bed_type.name as bname, reserve.day_checkin ,reserve.day_checkout as day_checkout,
                                                                            reserve.room_count as room_count
                                                                            FROM `reserve` INNER JOIN room_details on(reserve.room_type = room_details.id)INNER JOIN room_type
                                                                            on(room_details.type = room_type.id) INNER JOIN bed_type on(room_details.bed = bed_type.id) 
                                                                            INNER JOIN room_category ON(room_details.reservation = room_category.id) ORDER BY reserve.reservation_id DESC";

                                                                            $rower = mysqli_query($con, $tsql);



                                                                            $i = 1;
                                                                            

                                                                            while ($trow = $rower->fetch_assoc()) {
                                                                                $datestart = $trow['day_checkin'];
                                                                                $dateend = date('d-m-Y');

                                                                                $calculate = strtotime("$dateend") - strtotime("$datestart");
                                                                                $summary = floor($calculate / 86400); // 86400 มาจาก 24*360 (1วัน = 24 ชม.)


                                                                                if ($summary <= 20) {

                                                                                    list($y, $m, $d) = explode('-', $trow['day_checkin']);

                                                                                    if($trow['day_checkout'] != null or $trow['day_checkout'] != ''){
                                                                                    list($y_out, $m_out, $d_out) = explode('-', $trow['day_checkout']);
                                                                                    }
                                                                                    list($y_p, $m_p, $d_p) = explode('-', $trow['day_reserve']);

                                                                                    $co = $trow['reserve_status'];

                                                                                    date_default_timezone_set('asia/bangkok'); //เวลา
                                                                                    $date = date('d-m-Y H:i');

                                                                                    $d_now = date('d');
                                                                                    $m_now = date('m');
                                                                                    $y_now = date('Y');

                                                                                   
                                                                                    if($y_now == $y_p and $m_now == $m_p){
                                                                                        $total_date = $d_now - $d_p;
                                                                                        // echo $total_date."<br>";
                                                                                    }else if($y_now == $y_p and $m_now > $m_p){

                                                                                        $date = date('d-m-Y');
                                                                                        $dod = date("t", strtotime($date));                                                                                 
                                                                                                $total_date = $dod - $d_p;
                                                                                                $total_date  += $d_now;
                                                                                        // echo $total_date."<br>";
                                                                                        
                                                                                    }
                                                                                   
                                                                                    echo "<tr>
                                                                                    <th> <input type='checkbox' name='chkl[ ]' class='checkmark'value='" . $trow['reservation_id'] . "'></th>
                                                                                    "; 
                                                                                    if($total_date == '0'){
                                                                                        $i;
                                                                                        echo "<th>
                                                                                        <lable class='new'> ใหม่</lable>
                                                                                        </th>";
                                                                                    }else{
                                                                                        echo "<th>" . $i . " <span class='fa fa-caret-down' style='color:red'></span></th>";
                                                                                    }
                                                                                    echo"
                                                                                    
                                                                                    <th>" . $trow['prefix_name'] . " " . $trow['fname'] . " " . $trow['lname'] . "</th>
                                                                                    <th><lable style='color:green'>" . $d . '/' . $m . '/' .date($y+543)  . "</lable><br>"; if($trow['day_checkout'] != null or $trow['day_checkout'] != '' ){echo "<lable style='color:red'>" . $d_out . '/' . $m_out . '/' .date($y_out+543) ."</lable>";} echo "</th>

                                                                                    <th><center>"; if($trow['room_count'] > 1){echo "<lable style='color:red'>" . $trow['room_count'] . "</lable>";}else{echo $trow['room_count'];}echo"</center></th>
                                                                                    <th>" . $trow['cname'] . "</th>
                                                                                    
                                                                                    <th>" . $trow['name'] . "</th>
                                                                                    ";
                                                                                    if($trow['car'] == '' or $trow['car'] == 'ไม่มี'){
                                                                                        echo "<th style='color:red'>ไม่มี</th>";
                                                                                    }else{
                                                                                        echo "<th style='color:green'>" . $trow['car'] . "</th>";
                                                                                    }

                                                                                    echo "<th>" . number_format($trow['pay']) . " / " . number_format($trow['reservation_money']) . "</th>";
                                                                                    if($trow['reserve_status'] == 'ชำระแล้ว'){
                                                                                        $sum_total = $trow['reservation_money'] - $trow['pay'];
                                                                                        echo "<td style='color:green'>".number_format($sum_total)."</td>";
                                                                                    }else{
                                                                                        echo "<td style='color:red'>-</td>";
                                                                                    }
                                                                                    if ($co == "รออนุมัติ") {


                                                                                        echo "	
            
                                                                                        <th ><button class='btn status' disabled>" . $trow['reserve_status'] . "</button></th>
                                                                                        
                                                                                        <th><a href='roombook.php?rid=" . $trow['reservation_id'] . " ' class='btn btn-primary' style='background-color:green' >ยืนยันสถานะ</a></th>
                                                                                        <th><a href='roombook_delete.php?id=" . $trow['reservation_id'] . " ' class='btn btn-danger'  onclick=\"return confirm('ต้องการลบข้อมูลการจองนี้หรือไม่')\">ลบ</a></th>
                                                                                        <th><a href='roombook_edit.php?id=" . $trow['reservation_id'] . " ' class='btn btn-warning'; disabled>แก้ไข</a></th>
                                                                                        </tr>";
                                                                                        $i++;
                                                                                    }
                                                                                    if ($co == "รอชำระเงิน") {

                                                                                        echo "	
                
                                                                                        <th ><button class='btn status4' disabled>" . $trow['reserve_status'] . "</button></th>
                                                                                        
                                                                                        <th><a href='roombook.php?rid=" . $trow['reservation_id'] . " ' class='btn btn-primary' style='background-color:green' disabled>ยืนยันสถานะ</a></th>
                                                                                        <th><a href='roombook_delete.php?id=" . $trow['reservation_id'] . " ' class='btn btn-danger' onclick=\"return confirm('ต้องการลบข้อมูลการจองนี้หรือไม่')\">ลบ</a></th>
                                                                                        <th><a href='roombook_edit.php?id=" . $trow['reservation_id'] . " ' class='btn btn-warning'; >แก้ไข</a></th>
                                                                                        </tr>";
                                                                                        $i++;
                                                                                    }
                                                                                    if ($co == "การจองผิดพลาด") {

                                                                                        echo "	
                
                                                                                        <th ><button class='btn status2' disabled>" . $trow['reserve_status'] . "</button></th>
                                                                                        
                                                                                        <th><a href='#' onclick=\"open_popup('show.php?rid=" . $trow['reservation_id'] . "')\" class='btn btn-primary' style='background-color:red'>ดูรายละเอียด</a></th>
                                                                                        <th><a href='roombook_delete?id=" . $trow['reservation_id'] . " ' class='btn btn-danger' onclick=\"return confirm('ต้องการลบข้อมูลการจองนี้หรือไม่')\">ลบ</a></th>
                                                                                        <th><a href='roombook_edit.php?id=" . $trow['reservation_id'] . " ' class='btn btn-warning'; disabled>แก้ไข</a></th>
                                                                                        </tr>";
                                                                                        $i++;
                                                                                    }
                                                                                    if ($co == "ชำระแล้ว") {

                                                                                        echo "	
                
                                                                                        <th ><button class='btn status3' disabled>" . $trow['reserve_status'] . "</button></th>
                                                                                        
                                                                                        <th><a href='#' onclick=\"open_popup('show.php?rid=" . $trow['reservation_id'] . "')\" class='btn btn-primary' style='background-color:green'>ดูรายละเอียด</a></th>
                                                                                        <th><a href='roombook_delete.php?id=" . $trow['reservation_id'] . " ' class='btn btn-danger' onclick=\"return confirm('ต้องการลบข้อมูลการจองนี้หรือไม่')\">ลบ</a></th>
                                                                                        <th><a href='roombook_edit.php?id=" . $trow['reservation_id'] . " ' class='btn btn-warning'; disabled>แก้ไข</a></th>
                                                                                        </tr>";
                                                                                        $i++;
                                                                                    }
                                                                                }
                                                                            }
                                                                        

                                                                        ?>
                                                                    </tbody >

                                        </form>
                                        </table>
                                    </div>
                                </div>


                            </div>


                            <!-- /. ROW  -->
                        </div>
                    </div>

                </div>

                <script>
                function open_popup(url){
                    window.open(url,null,"height=1980px,width=1080px,status=yes,toolbar=no,menubar=no,location=no");
                }
                </script>



                <!-- /. ROW  -->

            </div>


            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- JS Scripts-->
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



    <?php
            $sqlt = "SELECT * FROM room_category";
            $ret = $con->query($sqlt);
            ?>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ปฏิทินการจองห้อง</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">ห้อง:</label>
                        <select class="form-control" id="room" name="room">
                            <option selected></option>
                            <?php while ($rowt = $ret->fetch_assoc()) : ?>
                            <option value="<?php echo $rowt['id'] ?>"><?php echo $rowt['name'] ?></option>
                            <?php endwhile ?>
                        </select>
                    </div>
                    <div class="form-group" id="floorbox">
                        <label for="message-text" class="col-form-label">ชั้น:</label>
                        <select class="form-control" id="floor" name="floor"></select>

                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">ประเภท:</label>
                        <select class="form-control" id="troom" name="troom"></select>

                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">เตียง:</label>
                        <select class="form-control" id="broom" name="broom">

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">ราคา:</label>
                        <input type="text" class="form-control" id="" name="" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">เช็คอิน:</label>
                        <input type="date" class="form-control" id="chenkin" name="chenkin" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">เช็คเอาท์:</label>
                        <input type="date" class="form-control" id="chenkout" name="chenkout" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">จำนวนวัน:</label>
                        <input type="text" class="form-control" id="nodays" name="nodays" disabled>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">ชื่อต้น:</label>
                        <input type="text" class="form-control" id="prefix_name" name="prefix_name" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">ชื่อ:</label>
                        <input type="text" class="form-control" id="fname" name="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">นามสกุล:</label>
                        <input type="text" class="form-control" id="lname" name="lname" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">เบอร์:</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="Seve" class="btn btn-primary" name="Seve">บันทึกข้อมูล</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- END CONTENT -->

    </div>
    <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
    <!-- /. WRAPPER  -->

</body>

</html>




<!-- CONTENT ลบที่เลือก -->
<?php
$eng_date = time(); // เวลา
$time = date("h:i:s");

date_default_timezone_set('asia/bangkok'); //แสดงวันที่ปัจจุบัน
$date = date('H:i:s');

if (isset($_POST['delall'])) {
    if (empty($_POST['delall'])) {
        if ($_POST['chkl'] == true) {
            $checkbox1 = $_POST['chkl'];

            foreach ($checkbox1 as $id_check) {

                $sql = "DELETE FROM reserve WHERE reservation_id = '$id_check'";
                $con->query($sql);
                echo "<script type='text/javascript'> alert('ลบจองการเรียบร้อยแล้ว')</script>";
                echo "<script type='text/javascript'> window.location='home.php'</script>";
            }
        } else {
            echo "<script type='text/javascript'> alert('กรุณากดเลือกการจองที่ต้องการลบก่อน')</script>";
            echo "<script type='text/javascript'> window.location='home.php'</script>";
        }
    }
}
?>
<!-- END CONTENT -->