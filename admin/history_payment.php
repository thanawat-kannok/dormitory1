<?php
if(!isset($_SESSION)) 
{ 
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

<!------ Include the above in your HEAD tag ---------->
<?php if (isset($_GET['overdue'])) : ?>
    <?php
    $room = $_GET['overdue'];
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

        <!-- Template Main CSS File -->
        <script src="/dormitory/assets/jquery.min.js"></script>
        <script src="/dormitory/assets/script.js"></script>

        <!-- Custom Styles-->
        <link href="assets/css/custom-styles.css" rel="stylesheet" />
        <!-- Google Fonts-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <!-- TABLE STYLES-->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
            background-color: #DCDCDC;
        }

        table {
            margin: 0px 10px;
        }

        .picture {
            width: 300px;
            height: 250px;
        }

        @media screen and (max-width:550px) {
            table {
                width: 100%;
                margin: 0px;

            }

            .picture {
                width: 100%;
                height: 100%;
            }
        }

        .btn-edit {
            background-color: #FFFF00;
            color: black;
            border: 1px solid black;
        }

        .btn-edit:hover {
            opacity: 0.2;
        }

        .ttd {
            background-color: #DCDCDC;
            color: red;
        }

        .con {
            background-color: #D3D3D3;
            color: black;
            border: 1px solid black;
        }

        .con:hover {
            opacity: 0.2;
        }
    </style>

    <body>

        <div id="wrapper">

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
                        <a href="receipt.php"><i class="fa fa-qrcode"></i> จัดการค่าเช่า รายเดือน </a>
                    </li>
                    <li>
                        <a class="active-menu" href="price.php"><i class="fa fa-address-book"></i> ประวัติการชำระเงิน รายเดือน</a>
                    </li>
                    <ul class="nav" id="main-menu">
                        <li>
                            <a class="active-menu" href="history_payment.php?overdue=<?php echo $room; ?>"><i class="fa fa-history"></i> เรียกดูประวัติการชำระ ห้อง <?php echo $room; ?></a>
                        </li>
                    </ul>
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
                    <a href="/dormitory/logout.php"  onclick="return confirm('ยืนยันการออกจากระบบ')"><i class="fa fa-sign-out fa-fw" ></i> ออกจากระบบ</a>
                    </li> -->




                </div>

            </nav>

            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">

                        <div class="col-md-12">
                            <h1 class="page-header">
                                ประวัติการจ่ายเงิน/ค้างชำระ ห้อง <?php echo $room; ?>
                            </h1>
                        </div>
                        <?php    
                            //ดึงข้อมูลตาราง receipt group by date
                            $receipt_g_date1 = mysqli_query($con, "SELECT * FROM receipt WHERE room = $room GROUP BY date ORDER BY date DESC");
                        ?>

                            <form method="POST">
                                <div class="row">
                                    <button name="receipt" class="btn con" onclick="return confirm('ยินยันการบันทึก สถานะ การจ่ายเงิน')"><i class="fa fa-hourglass-2"></i> ยืนยันสถานะการจ่ายเงินค่าห้อง</button>
                                    <div class="col-md-3">
                                    <select class="form-control" name="search1">
                                            <option value="">กรุณาเลือกวันที่ ที่ต้องการค้นหาประวัติ</option>
                                            <?php while ($receipt_history1 = $receipt_g_date1->fetch_assoc()) : ?>
                                                <?php  
                                                    list($y_543,$m_543,$d_543) = explode("-",$receipt_history1['date']);
                                                    $y_543 = $y_543+543;
                                                ?>
                                                <?php
                                                switch ($receipt_history1['payRent']) {
                                                    case '0':
                                                        echo ' <option style="color:red"value="' . $receipt_history1['date'] . '">';
                                                        echo "".$d_543."-".$m_543."-".$y_543."<lable style='color:red'>   (ยังไม่ได้ชำระเงิน)</lable>";
                                                        break;
                                                    case '1':
                                                        echo ' <option style="color:green"value="' . $receipt_history1['date'] . '">';
                                                        echo "".$d_543."-".$m_543."-".$y_543."<lable style='color:green'>   (ชำระเงินแล้ว)</lable>";
                                                        break;
                                                }; ?>
                                                </option>
                                            <?php endwhile ?>
                                        </select>

                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" name="search" class="btn btn-primary">ค้นหา</button>
                                    </div>

                                </div>


                                <br>
                                    <?php
                                    if (isset($_POST['search1'])) :

                                        $search = $_POST['search1'];

                                        if($search == '' or $search == ' '){
                                             //ดึงข้อมูลตาราง receipt group by date
                                            $receipt_g_date = mysqli_query($con, "SELECT * FROM room,receipt WHERE receipt.room = $room GROUP BY receipt.date ORDER BY date DESC");
                                        }else{
                                            //ดึงข้อมูลตาราง receipt group by date
                                            $receipt_g_date = mysqli_query($con, "SELECT * FROM room,receipt WHERE receipt.room = $room and room.room = $room and date = '$search'");
                                        }

                                    ?>
                                      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <tr>
                                        <td>วันที่</td>
                                        <td>หน่วยน้ำ</td>
                                        <td>หน่วยน้ำรวม</td>

                                        <td>หน่วยไฟ</td>
                                        <td>หน่วยไฟรวม</td>

                                        <td>ยอดรวมทั้งหมด</td>
                                        <td>ชื่อผู้รับเงิน</td>
                                        <td>การค้างชำระ</td>

                                    </tr>

                                    <?php

                                    while (
                                        $receipt_history = $receipt_g_date->fetch_assoc()
                                    ) : ?>
                                    <?php  
                                        list($y,$m,$d) = explode("-",$receipt_history['date']);
                                        $y = $y+543;
                                    ?>
                                        <tr>
                                            <td><?php echo "".$d."-".$m."-".$y.""; ?></td>

                                            <td><?php echo $receipt_history['unitPerWater']; ?></td>
                                            <td><?php echo $receipt_history['totalWater']; ?></td>

                                            <td><?php echo $receipt_history['unitPerElectricity']; ?></td>
                                            <td><?php echo $receipt_history['totalElectricity']; ?></td>

                                            <td><?php echo number_format($receipt_history['receipt_total'], 2); ?> บาท</td>
                                            <td><?php
                                                switch ($receipt_history['name_admin']) {
                                                    case '':
                                                        echo "<lable style='color:red'>ไม่มีผู้รับเงิน</lable>";
                                                        break;
                                                    default:
                                                        echo $receipt_history['name_admin'];
                                                        break;
                                                }; ?></td>
                                            <input type="hidden" name="date_cck[ ]" value="<?php echo $receipt_history['date']; ?>">
                                            <input type="hidden" name="pay[ ]" value="<?php echo $receipt_history['pay_id']; ?>">
                                            <td>
                                                <select name="pay_receipt[ ]" class="form-control">
                                                    <?php
                                                    switch ($receipt_history['payRent']) {
                                                        case '0':
                                                            echo "<option value='0'>ยังไม่จ่าย</option>";
                                                            echo "<option value='1'>จ่ายแล้ว</option>";
                                                            break;
                                                        case '1':
                                                            echo "<option value='1'>จ่ายแล้ว</option>";
                                                            echo "<option value='0'>ยังไม่จ่าย</option>";
                                                            break;
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php endwhile ?>

                                </table>


                                    <?php else : ?>
                                        <?php
                                    
                                        //ดึงข้อมูลตาราง receipt group by date
                                        $receipt_g_date = mysqli_query($con, "SELECT * FROM room,receipt WHERE receipt.room = $room GROUP BY receipt.date ORDER BY date DESC");

                                        ?>

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <tr>
                                        <td>วันที่</td>
                                        <td>หน่วยน้ำ</td>
                                        <td>หน่วยน้ำรวม</td>

                                        <td>หน่วยไฟ</td>
                                        <td>หน่วยไฟรวม</td>

                                        <td>ยอดรวมทั้งหมด</td>
                                        <td>ชื่อผู้รับเงิน</td>
                                        <td>การค้างชำระ</td>

                                    </tr>

                                    <?php

                                    while (
                                        $receipt_history = $receipt_g_date->fetch_assoc()
                                    ) : ?>
                                    <?php  
                                        list($y,$m,$d) = explode("-",$receipt_history['date']);
                                        $y = $y+543;
                                    ?>
                                        <tr>
                                            <td><?php echo "".$d."-".$m."-".$y.""; ?></td>

                                            <td><?php echo $receipt_history['unitPerWater']; ?></td>
                                            <td><?php echo $receipt_history['totalWater']; ?></td>

                                            <td><?php echo $receipt_history['unitPerElectricity']; ?></td>
                                            <td><?php echo $receipt_history['totalElectricity']; ?></td>

                                            <td><?php echo number_format($receipt_history['receipt_total'], 2); ?> บาท</td>
                                            <td><?php
                                                switch ($receipt_history['name_admin']) {
                                                    case '':
                                                        echo "<lable style='color:red'>ไม่มีผู้รับเงิน</lable>";
                                                        break;
                                                    default:
                                                        echo $receipt_history['name_admin'];
                                                        break;
                                                }; ?></td>
                                            <input type="hidden" name="date_cck[ ]" value="<?php echo $receipt_history['date']; ?>">
                                            <input type="hidden" name="pay[ ]" value="<?php echo $receipt_history['pay_id']; ?>">
                                            <td>
                                                
                                                    <?php
                                                    switch ($receipt_history['payRent']) {
                                                        case '0':
                                                            echo '<select name="pay_receipt[ ]" class="form-control" style="color:red">';
                                                            echo "<option value='0'>ยังไม่จ่าย</option>";
                                                            echo "<option value='1'>จ่ายแล้ว</option>";
                                                            break;
                                                        case '1':
                                                            echo '<select name="pay_receipt[ ]" class="form-control" style="color:green">';
                                                            echo "<option value='1'>จ่ายแล้ว</option>";
                                                            echo "<option value='0'>ยังไม่จ่าย</option>";
                                                            break;
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php endwhile ?>

                                </table>
                                <?php
                                if (isset($_POST['search'])) {

                                    $s1 = $_POST['search1'];

                                    echo "<script type='text/javascript'> alert('$s1')</script>";
                                }
                                ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            </form>

        </div>
    </body>

    </html>
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
    if (isset($_POST['receipt'])) {
        $name_A = array("" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . "");

        $status_receipt = array(); //สถานะการจ่าบเงิน
        $date_check_value = array(); //วันที่
        $pay_i = array(); //รหัสใบเสร็จ

        $cone = $_POST['pay_receipt'];
        $date_cck = $_POST['date_cck'];
        $pay = $_POST['pay'];

        $i = 0;

        foreach ($date_cck as $key) {
            array_push($date_check_value, "$key");
        }
        foreach ($pay as $key) {
            array_push($pay_i, "$key");
        }
        
        foreach ($cone as $key) {
            array_push($status_receipt, "$key");
            $cc = mysqli_query($con, "SELECT * FROM receipt WHERE pay_id = '$pay_i[$i]'");
            $row_check = mysqli_fetch_array($cc);

            if ($status_receipt[$i] == '0') {
                mysqli_query($con, "UPDATE `receipt` SET `payRent` = '$status_receipt[$i]',
                `name_admin`= null  WHERE room = '$room' and date = '$date_cck[$i]'");
            } else if ($status_receipt[$i] == '1') {
                if ($row_check['name_admin'] != null and $row_check['name_admin'] != "") {
                    mysqli_query($con, "UPDATE `receipt` SET `payRent` = '$status_receipt[$i]',
                    `name_admin`='" . $row_check['name_admin'] . "'  WHERE room = '$room' 
                    and date = '$date_cck[$i]'");
                } else {
                    mysqli_query($con, "UPDATE `receipt` SET `payRent` = '$status_receipt[$i]',
                    `name_admin`='" . $name_A[0] . "'  WHERE room = '$room' and date = '$date_cck[$i]'");
                }
            }
            $i++;
        }

        $sqlie = "INSERT INTO event_log (personal,date,time,event) 
        VALUES ('".$_SESSION['personal_admin']."', '$date','$time','$name_A[0] แก้ไขประวัติการรับเงิน ห้อง $room')";
        mysqli_query($con,$sqlie);

        echo "<script type='text/javascript'> alert('บันทึก สถานะการจ่ายเงิน สำเร็จ!!')</script>";
        echo "<script type='text/javascript'> window.location='history_payment.php?overdue=$room'</script>";
    }
    ?>
<?php endif; ?>
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