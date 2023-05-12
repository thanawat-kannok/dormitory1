<?php
if (!isset($_SESSION)) {
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

<?php if (isset($_GET['eid'])) {
    $id = $_GET['eid'];

    $tre = mysqli_query($con, "SELECT room.room_detal as room_detal,
    room_details.other as other_me_B,
    room_category.name as data , room_details.id as id,
    room_type.name as name , room_details.floor as floor ,
    room_details.price as price,
    bed_type.id as id_B,
    bed_type.name as name_B,
    bed_type.size as size_B,
    bed_type.detal as detal_B
    FROM room INNER JOIN room_details on(room_details.id = room.type) 
    INNER JOIN bed_type on(room_details.bed = bed_type.id)
    INNER JOIN room_type on(room_details.type = room_type.id) 
    INNER JOIN room_category on(room_category.id = room_details.reservation) 
    WHERE room.room = $id");
    $room1 = mysqli_fetch_array($tre);


    $Bid = $room1['id_B'];
    $Bname = $room1['name_B'];
    $Bsize = $room1['size_B'];
    $Bdetal = $room1['detal_B'];
    $other_me = $room1['other_me_B'];

    $name_me = $room1['name'];
    $id_me = $room1['id'];
    $floor_me = $room1['floor'];
    $price_me = $room1['price'];
    $data_me = $room1['data'];
    $detail = $room1['room_detal'];
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

    <!-- <link href="css/register.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../css/image.css">

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

    @media screen and (max-width:550px) {
        table {
            width: 100%;
            margin: 0px;
        }
    }
    .btn-clk {

    background-color: yellow;
    color: black;
    border: 1px solid black;
    }

    .btn-clk:hover {
    background-color: red;
    color: white;
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
                        <a class="active-menu" href="month.php"><i class="fa fa-calendar-check-o"></i> การจัดการห้องพัก <lable style="font-size:12px;color:#7FFF00"> แก้ไข</lable></a>
                    </li>
                    <ul class="nav" id="main-menu">
                        <li>
                            <a class="active-menu" href="editR.php?addDR"><i class="fa fa-pencil"></i> จัดการชนิดห้องพัก</a>
                        </li>
                    </ul>
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
        <!-- /. NAV SIDE  -->
        <?php if (isset($id)) : ?>
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-header">
                                แก้ไขข้อมูลห้อง <?php echo $id; ?>
                            </h1>
                        </div>
                    </div>
                    <!-- /. ROW  -->

                    <div class="row">
                        <div class="col-md-12">

                        </div>
                        <form method="post">

                            <table width="50%" style="float:left;">
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label>หมายเลขห้อง</label>
                                            <input type="number" class="form-control" placeholder="หมายเลขห้อง" value="<?php echo $id; ?>" disabled>
                                            <input type="hidden" name="room" value="<?php echo $id; ?>">
                                            <label>รายละเอียดห้อง</label>
                                            <input name="room_detel" class="form-control" placeholder="ข้อมูลภายในห้อง" value="<?php echo $detail ?>" required>
                                            <label>ชนิดห้อง</label><br>
                                            <?php

                                            echo "<select name='type_id' class='form-control' required>";
                                            echo "<option value='$id_me' >ปัจจุบัน: $name_me $Bname $data_me ชั้น $floor_me ราคา $price_me ประกัน $other_me</option>";
                                            while ($rrow2 = mysqli_fetch_array($join_details)) {
                                                $name1 = $rrow2['name'];
                                                $id2 = $rrow2['id'];
                                                $floor = $rrow2['floor'];
                                                $price = $rrow2['price'];
                                                $data = $rrow2['data'];
                                                $Bname1 = $rrow2['Bname'];
                                                $other = $rrow2['other'];

                                                if ($id2 != $id_me) {
                                                    echo "<option value='$id2'>$name1 $Bname1 $data ชั้น $floor ราคา $price ประกัน $other</option>";
                                                }
                                            }

                                            echo "</select>";

                                            ?>
                                            <label>ราคาห้อง</label>
                                            <input type="hidden" value="<?php echo $id_me;?>" name="id_me">
                                            <input type="hidden" value="<?php echo $price_me;?>" name="price_me" >
                                            <input type="number" class="form-control" value="<?php echo $price_me;?>" name="edit_price">
                                            <?php
                                            $room_ck = mysqli_query($con, "SELECT * FROM room WHERE room = $id");
                                            $rowee = mysqli_fetch_array($room_ck);
                                            if (isset($rowee['unitPerWater']) != null) {

                                                $wather1 = $rowee['unitPerWater'];
                                                $elec1 = $rowee['unitPerElectricity'];
                                            }
                                            if (isset($rowee['unitPerWater']) == null) {
                                                $_SESSION['error'] = "กรุณาระบุหน่วยค่านํ้าค่าไฟก่อน";
                                            }
                                            ?>

                                            <?php
                                            $cck = mysqli_query($con, "SELECT * FROM `room` INNER JOIN room_details on(room.type  =room_details.id) INNER JOIN room_category on(room_details.reservation = room_category.id)WHERE room.room = $id");
                                            $cehck = mysqli_fetch_array($cck);
                                            ?>
                                            <?php if ($cehck['name'] == "รายเดือน") : ?>

                                                <label>หน่วยค่านํ้า</label>
                                                <input type="number" value="<?php echo $wather1 ?>" name="wather_p" class="form-control" maxlength="4" placeholder="ค่านํ้าต่อหน่อย" required>
                                                <label>หน่วยค่าไฟ</label>
                                                <input type="number" value="<?php echo $elec1 ?>" name="elec_p" class="form-control" maxlength="4" placeholder="ค่าไฟต่อหน่อย" required>
                                            <?php else:?>
                                                <input type="hidden" value="<?php echo $wather1 ?>" name="wather_p" >
                                                <input type="hidden" value="<?php echo $elec1 ?>" name="elec_p" >
                                                <?php endif; ?>
                                            <p>สถานะห้อง</p>
                                            <?php
                                            $status = "SELECT * FROM room WHERE room = $id";
                                            $status_p = mysqli_query($con, $status);

                                            $st = mysqli_fetch_array($status_p);
                                            $status = $st['room_status'];
                                            echo "<select name='status'>
                                                        <option value='$status'>สถานะปัจจุบัน --$status--</option>
                                                        <option value='ว่าง'>ว่าง</option>
                                                        <option value='ไม่ว่าง'>ไม่ว่าง</option>
                                                    </select>
                                                ";
                                            ?>
                                        </div>

                                        <div class="modal-footer">
                                            <a href="editD.php?eid_note=<?php echo $id_me; ?>" <button class='btn btn-clk' style="float:left"> แก้ไขชนิดห้องพัก</button></a>
                                            <input type="submit" name="log" value="ยืนยัน" class="btn btn-primary" onclick="return confirm('ยืนยันการแก้ไขข้อมูลห้อง')">
                                    </td>
                                </tr>
                            </table>
                            <?php
                            $tck = mysqli_query($con, "SELECT * FROM `user` INNER JOIN room on(user.room = room.room) WHERE room.room = $id");
                            ?>
                            <div class="form-group">
                                <table>
                                    <tr>
                                        <td>
                                            ผู้อยู่อาศัย
                                            <?php
                                            $year_l = date("Y");
                                            while ($rowe1 = mysqli_fetch_array($tck)) {
                                                $personal = $rowe1['personal'];
                                                $disc = mysqli_query($con, "SELECT districts.name_th as nameD, amphures.name_th as nameA,provinces.name_th as nameP,districts.zip_code as zip
                                                        FROM districts INNER JOIN amphures ON(districts.amphure_id = amphures.id) INNER JOIN provinces ON(amphures.province_id = provinces.id)
                                                        INNER JOIN user on(user.districts = districts.id)
                                                        WHERE  user.personal = '$personal'");
                                                $provin = mysqli_fetch_array($disc);

                                                if ($rowe1['room'] == null) {
                                                    echo "<div style='border:1px solid black;padding:5px 10px;'>";
                                                    echo "<lable>ไม่มีผู้เช่า</lable>";
                                                    echo "</div>";
                                                } else {

                                                    $dob = $rowe1['dob'];
                                                    list($year, $month, $day) = explode('-', $dob);
                                                    $year_M = $year_l - $year;

                                                    echo "<div style='border:1px solid black;padding:5px 5px 5px 10px;border-radius:10px;'>";

                                                    echo "ชื่อ <b>" . $rowe1['prefix_name'] . "   " . $rowe1['fname'] . "   " . $rowe1['lname'] . "</b>";
                                                    echo '<lable style="float:right;">
                                                            <a href=delR.php?delRU=' . $personal . '/' . $rowe1['room'] . ' onclick="return confirm(\'คุณต้องการลบผู้ใช้  ' . $rowe1['prefix_name'] . '   ' . $rowe1['fname'] . '   ' . $rowe1['lname'] . ' ออกจากห้อง ' . $rowe1['room'] . ' ใช่หรือไม่\')" 
                                                            <button class="btn btn-danger"> <i class="fa fa-times-circle" ></i> ลบ</button></a></lable>';
                                                    echo "<br>";

                                                    echo "อายุ <b>" . $year_M . "</b>";
                                                    echo "<br>";

                                                    echo "สถานะ<lable style='color:#CD5C5C'><strong> " . $rowe1['premission'] . "</strong></lable><br>";
                                                    echo "<br>";

                                                    echo "เบอร์โทรศัพทร์ <b>" . $rowe1['phone'] . "</b>";
                                                    echo "<br>";
                                                    echo "ไอดีไลน์ <b>" . $rowe1['line'] . "</b>";
                                                    echo "<br>";

                                                    echo "ที่อยู่";

                                                    echo "<br>";
                                                    echo "ตำบล " . $provin['nameD'] . "";
                                                    echo " อำเภอ " . $provin['nameP'] . "";
                                                    echo " จังหวัด " . $provin['nameA'] . "";
                                                    echo "  " . $provin['zip'] . "";
                                                    echo "<br>";


                                                    echo "ถนน " . $rowe1['road'] . "";
                                                    echo "บ้านเลขที่ " . $rowe1['home_number'] . "";
                                                    echo "หมู่ที่ " . $rowe1['village'] . "";
                                                    echo "</div>";
                                                    echo "<br>";
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
    </div>
    </div>


    <!-- /. ROW  -->
    </div>

    </div>

    </div>
    
    <!-- EDIT ROOM -->
    <?php
            if (isset($_POST['log'])) {

                echo $price_me =  $_POST['price_me'];
                echo $edit_price = $_POST['edit_price'];
                echo $room_type = $_POST['type_id'];
                echo $id_me = $_POST['id_me'];
                
                function Convert($amount_number)
                {
                    $amount_number = number_format($amount_number, 2, ".", "");
                    $pt = strpos($amount_number, ".");
                    $number = $fraction = "";
                    if ($pt === false)
                        $number = $amount_number;
                    else {
                        $number = substr($amount_number, 0, $pt);
                        $fraction = substr($amount_number, $pt + 1);
                    }

                    $ret = "";
                    $baht = ReadNumber($number);
                    if ($baht != "") {
                        $ret .= $baht . "บาท";
                    } else if ($baht == "") {
                        $ret .= $baht . "บาท";
                    }

                    $satang = ReadNumber($fraction);
                    if ($satang != "")
                        $ret .=  $satang . "สตางค์";
                    else
                        $ret .= "ถ้วน";
                    return $ret;
                }

                function ReadNumber($number)
                {
                    $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
                    $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
                    $number = $number + 0;
                    $ret = "";
                    if ($number == 0) return $ret;
                    if ($number > 1000000) {
                        $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
                        $number = intval(fmod($number, 1000000));
                    }

                    $divider = 100000;
                    $pos = 0;
                    while ($number > 0) {
                        $d = intval($number / $divider);
                        $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" : ((($divider == 10) && ($d == 1)) ? "" : ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
                        $ret .= ($d ? $position_call[$pos] : "");
                        $number = $number % $divider;
                        $divider = $divider / 10;
                        $pos++;
                    }
                    return $ret;
                }
                ## วิธีใช้งาน

                $name_th_price_eidt = Convert($edit_price);
    
                if($room_type == $id_me){
                    if($price_me != $edit_price){
                        echo "<script type='text/javascript'>alert('*หากทำการแก้ไขราคาห้องพักจะทำการแก้ไขราคาที่ชนิดห้องพักด้วย')</script>";
                        mysqli_query($con,"UPDATE `room_details` SET `price`='$edit_price',`name_th_price`='$name_th_price_eidt' WHERE id = $room_type");
                        
                        $sqli = "INSERT INTO event_log (personal,date,time,event) 
                        VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " แก้ไขราคาห้อง $id ราคาเดิม $price_me ราคาใหม่ $edit_price ')";
                        mysqli_query($con, $sqli);
                    }else{
                        $sqli = "INSERT INTO event_log (personal,date,time,event) 
                        VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " แก้ไขข้อมูลห้องหมายเลข $id ')";
                        mysqli_query($con, $sqli);
                    }
                }
                $detel =  $_POST['room_detel'];
                $room_type = $_POST['type_id'];

                $wather =  $_POST['wather_p'];
                $elec = $_POST['elec_p'];
                $status = $_POST['status'];


                echo $detel . "<br>";
                echo $room_type . "<br>";

                echo $wather . "<br>";
                echo $elec . "<br>";
                echo $status . "<br>";

                if ($id) {

                    mysqli_query($con, "UPDATE `room` SET 
                    `room_status` = '$status', `room_detal`= '$detel',`type` = '$room_type',
                    `unitPerWater` = '$wather',`unitPerElectricity` = '$elec' 
                    WHERE `room`= $id ");

                    if($status == "ว่าง"){
                        mysqli_query($con,"UPDATE `user` SET `room` = null WHERE room = $id");
                    }

                   

                    echo "<script type='text/javascript'> alert('แก้ไขข้อมูล เรียบร้อย')</script>";
                    echo "<script type='text/javascript'> window.location='editR.php?eid=$id'</script>";
                }
                
            }
    ?>
    <!-- END EDIT ROOM -->

    <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
<?php endif; ?>
<?php if (isset($_GET['addDR'])) : ?>
    <style>
        .btn-edit {
            background-color: #FFFF00;
            color: black;
            border: 1px solid black;
        }

        .btn-edit:hover {
            opacity: 0.2;
        }
    </style>
    <script>
        function chk_pic() {
            var file = document.upfile.fileupload.value;
            var patt = /(.jpg|.png)/;
            var result = patt.test(file);
            if (!result) {
                alert('เพิ่มรูปผิดพลาด (เพิ่มรูปภาพ นามสกุล png,jpg เท่านั้น)');
            }
            return result;
        }
    </script>
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">
                        กำหนดชนิดห้องพัก ราคา และชั้น
                    </h1>
                </div>
            </div>
            <!-- /. ROW  -->
            <div class="row">
                <div class="col-md-12">
                    <?php if(isset($_POST['log_details'])):?>
                        <?php
                            $type_id = $_POST['type_id'];
                            // echo ' ชนิดห้อง<br>';
                            $troom = $_POST['troom'];
                            // echo ' ประเภทห้อง<br>';
                            $broom = $_POST['broom'];
                            // echo ' ประเภทเตียง<br>';
                            $floor = $_POST['floor'];
                            // echo ' ชั้น<br>';    
                        ?>
                        <form action="editR.php?addDR" method="post" enctype="multipart/form-data" name="upfile" id="upfile" onSubmit="return chk_pic()">

                        <label>ชนิดห้อง</label>
                        <select class="form-control" name="type">
                            <?php
                            $ssq = mysqli_query($con, "SELECT room_category.id as Cid,
                                room_type.id as Tid,
                                room_type.name as Tname,
                                room_category.name as Cname
                                FROM room_type 
                                INNER JOIN room_details on(room_type.id = room_details.type)
                                INNER JOIN room_category on(room_details.reservation = room_category.id)
                                GROUP BY room_details.reservation, room_details.type
                                ORDER BY `room_type`.`name` ASC");

                            $t_and_c = mysqli_query($con,"SELECT room_category.id as Cid_import,
                            room_type.id as Tid_import,
                            room_type.name as Tname_import,
                            room_category.name as Cname_import FROM `room_details` 
                            INNER JOIN room_type on(room_type.id = room_details.type) 
                            INNER JOIN room_category on(room_category.id = room_details.reservation) 
                            WHERE room_type.id = '$troom' and room_category.id = '$type_id' GROUP BY room_type.id ASC");
                            $in_value_t = mysqli_fetch_array($t_and_c);


                            echo "<option value='$troom/$type_id'>" . $in_value_t['Tname_import'] . " " . $in_value_t['Cname_import'] . " </option>";
                            while ($ssqw = mysqli_fetch_array($ssq)) {
                                $Cid = $ssqw['Cid'];
                                $Tid = $ssqw['Tid'];
                                
                                echo "<option value='$Tid/$Cid'>" . $ssqw['Tname'] . " " . $ssqw['Cname'] . "</option>";
                                
                            }
                            ?>
                        </select>
                        
                        <label>ชั้น</label>
                        <input type="number" name="floor" class="form-control" value="<?php echo $floor; ?>"required>


                        <label>ประเภทเตียง</label><br>
                        <?php
                        $ssql = "SELECT * FROM bed_type ORDER BY name ASC";
                        $tbe = mysqli_query($con, $ssql);
                        $n_and_b = mysqli_query($con,"SELECT * FROM bed_type WHERE id = '$broom'");
                        $bed_import = mysqli_fetch_array($n_and_b);
                        $tid_import = $bed_import['id'];
                        $tname_import = $bed_import['name'];
                        $tsize_import = $bed_import['size'];

                        echo "<select name='tbed' class='form-control'>";
                        echo "<option value='$tid_import' >$tname_import ขนาดเตียง $tsize_import </option>";

                        while ($tbed = mysqli_fetch_array($tbe)) {
                            $tid = $tbed['id'];
                            $tname = $tbed['name'];
                            $tsize = $tbed['size'];
                            echo "<option value='$tid' >$tname ขนาดเตียง $tsize </option>";
                        }

                        echo "</select>";

                        ?>

                        <label>ราคาห้อง</label>
                        <input type="number" name="price" id="price" class="form-control" required min="1" onchange="return NumChk(this)">
                        <div id="price_error"></div>

                        <label>ค่าประกัน</label>
                        <input type="number" name="other" id="other" class="form-control" required min="1" onchange="return NumChk(this)">
                        <div id="other_error"></div>

                        <label>เงินขั้นต่ำในการจองห้อง</label>
                        <input type="number" name="min" id="min" class="form-control" required min="1" onchange="return NumChk(this)">
                        <div id="min_error"></div>
                        <script>
                            function NumChk() {
                                var price = document.getElementById("price").value;
                                var other = document.getElementById("other").value;
                                var min = document.getElementById("min").value;

                                if (price < 0) {
                                    document.getElementById("price_error").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบจำนวนเป็นบวกเท่านั้น</font>');
                                } else {
                                    document.getElementById("price_error").innerHTML = ('');
                                }
                                if (other < 0) {
                                    document.getElementById("other_error").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบจำนวนเป็นบวกเท่านั้น</font>');
                                } else {
                                    document.getElementById("other_error").innerHTML = ('');
                                }
                                if (min < 0) {
                                    document.getElementById("min_error").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบจำนวนเป็นบวกเท่านั้น</font>');
                                } else {
                                    document.getElementById("min_error").innerHTML = ('');
                                }
                            }
                        </script>
                        <label>รูปห้อง</label>
                        <div class="button-section">
                        <input class="form-control" type="file" name="fileupload[]" accept="image/png, image/gif, image/jpeg" multiple required>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                            <input type="submit" name="log" value="ยืนยัน" class="btn btn-primary" onclick="return confirm('ยืนยันการกำหนดชนิดห้องพัก')">
                        </div>

                    </form>
                    <?php else:?>
                    
                    <form action="editR.php?addDR" method="post" enctype="multipart/form-data" name="upfile" id="upfile" onSubmit="return chk_pic()">

                        <label>ชนิดห้อง</label>
                        <select class="form-control" name="type">
                            <?php
                            $ssq = mysqli_query($con, "SELECT room_category.id as Cid,
                                room_type.id as Tid,
                                room_type.name as Tname,
                                room_category.name as Cname
                                FROM room_type 
                                INNER JOIN room_details on(room_type.id = room_details.type)
                                INNER JOIN room_category on(room_details.reservation = room_category.id)
                                GROUP BY room_details.reservation, room_details.type
                                ORDER BY `room_type`.`name` ASC");

                            while ($ssqw = mysqli_fetch_array($ssq)) {
                                $Cid = $ssqw['Cid'];
                                $Tid = $ssqw['Tid'];
                                echo "<option value='$Tid/$Cid'>" . $ssqw['Tname'] . " " . $ssqw['Cname'] . "</option>";
                                
                            }
                            ?>
                        </select>
                        
                        <label>ชั้น</label>
                        <input type="number" name="floor" class="form-control" required>


                        <label>ประเภทเตียง</label><br>
                        <?php
                        $ssql = "SELECT * FROM bed_type ORDER BY name ASC";
                        $tbe = mysqli_query($con, $ssql);



                        echo "<select name='tbed' class='form-control'>";

                        while ($tbed = mysqli_fetch_array($tbe)) {
                            $tid = $tbed['id'];
                            $tname = $tbed['name'];
                            $tsize = $tbed['size'];
                            echo "<option value='$tid' >$tname ขนาดเตียง $tsize </option>";
                        }

                        echo "</select>";

                        ?>

                        <label>ราคาห้อง</label>
                        <input type="number" name="price" id="price" class="form-control" required min="1" onchange="return NumChk(this)">
                        <div id="price_error"></div>

                        <label>ค่าประกัน</label>
                        <input type="number" name="other" id="other" class="form-control" required min="1" onchange="return NumChk(this)">
                        <div id="other_error"></div>

                        <label>เงินขั้นต่ำในการจองห้อง</label>
                        <input type="number" name="min" id="min" class="form-control" required min="1" onchange="return NumChk(this)">
                        <div id="min_error"></div>
                        <script>
                            function NumChk() {
                                var price = document.getElementById("price").value;
                                var other = document.getElementById("other").value;
                                var min = document.getElementById("min").value;

                                if (price < 0) {
                                    document.getElementById("price_error").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบจำนวนเป็นบวกเท่านั้น</font>');
                                } else {
                                    document.getElementById("price_error").innerHTML = ('');
                                }
                                if (other < 0) {
                                    document.getElementById("other_error").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบจำนวนเป็นบวกเท่านั้น</font>');
                                } else {
                                    document.getElementById("other_error").innerHTML = ('');
                                }
                                if (min < 0) {
                                    document.getElementById("min_error").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบจำนวนเป็นบวกเท่านั้น</font>');
                                } else {
                                    document.getElementById("min_error").innerHTML = ('');
                                }
                            }
                        </script>
                        <label>รูปห้อง</label>
                        <div class="button-section">
                        <input class="form-control" type="file" name="fileupload[]" accept="image/png, image/gif, image/jpeg" multiple required>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                            <input type="submit" name="log" value="ยืนยัน" class="btn btn-primary" onclick="return confirm('ยืนยันการกำหนดชนิดห้องพัก')">
                        </div>

                    </form>
                    <?php endif;?>
                </div>
                <?php
                if (isset($_POST['log'])) {
                    $type = $_POST['type'];
                    $floor = $_POST['floor'];
                    $tbed = $_POST['tbed'];
                    $price = $_POST['price'];
                    $other = $_POST['other'];
                    $min = $_POST['min'];

                    list($Tt, $Ct) = explode("/", $type);

                    echo $Ct;
                    echo "<br>";
                    echo $floor;
                    echo "<br>";
                    echo $price;
                    echo "<br>";
                    echo $other;
                    echo "<br>";
                    echo $name_th_price;
                    echo "<br>";

                    function Convert($amount_number)
                    {
                        $amount_number = number_format($amount_number, 2, ".", "");
                        $pt = strpos($amount_number, ".");
                        $number = $fraction = "";
                        if ($pt === false)
                            $number = $amount_number;
                        else {
                            $number = substr($amount_number, 0, $pt);
                            $fraction = substr($amount_number, $pt + 1);
                        }

                        $ret = "";
                        $baht = ReadNumber($number);
                        if ($baht != "") {
                            $ret .= $baht . "บาท";
                        } else if ($baht == "") {
                            $ret .= $baht . "บาท";
                        }

                        $satang = ReadNumber($fraction);
                        if ($satang != "")
                            $ret .=  $satang . "สตางค์";
                        else
                            $ret .= "ถ้วน";
                        return $ret;
                    }

                    function ReadNumber($number)
                    {
                        $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
                        $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
                        $number = $number + 0;
                        $ret = "";
                        if ($number == 0) return $ret;
                        if ($number > 1000000) {
                            $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
                            $number = intval(fmod($number, 1000000));
                        }

                        $divider = 100000;
                        $pos = 0;
                        while ($number > 0) {
                            $d = intval($number / $divider);
                            $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" : ((($divider == 10) && ($d == 1)) ? "" : ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
                            $ret .= ($d ? $position_call[$pos] : "");
                            $number = $number % $divider;
                            $divider = $divider / 10;
                            $pos++;
                        }
                        return $ret;
                    }
                    ## วิธีใช้งาน

                    $name_th_price = Convert($price);
                    $name_th_other = Convert($other);

                    $sqli = "INSERT INTO `room_details`( `floor`, `type`, `bed`, `price`, `name_th_price`, `other`, `name_th_other`, `reservation`, `minimum`) 
                        VALUES ('$floor','$Tt','$tbed','$price','$name_th_price','$other','$name_th_other','$Ct','$min')";
                    mysqli_query($con, $sqli);

                    $tid = mysqli_insert_id($con);
                    //ฟังก์ชั่นวันที่
                    isset( $_FILES['fileupload']['tmp_name'] ) ? $image_tmp_name = $_FILES['fileupload']['tmp_name'] : $image_tmp_name = "";
                    isset( $_FILES['fileupload']['name'] ) ? $image_name = $_FILES['fileupload']['name'] : $image_name = "";
                
                        date_default_timezone_set('Asia/Bangkok');
                        $date_in = date("Ymd");
                        //ฟังก์ชั่นสุ่มตัวเลข
                        $numrand = (mt_rand());
                        
                    if( !empty( $image_tmp_name ) && !empty( $image_name ) ) {
                
                        for( $i=0; $i<count( $image_tmp_name ); $i++ ) {
                            $path = "../assets/img/";
                            $type = strrchr($image_name[$i], ".");
                            
                            $newname = $numrand.'_'.$date_in.'_'.$i.$type;
                            $newname_saveflie = $path.$numrand.'_'.$date_in.'_'.$i.$type;
                            $numrand ++;
                            $date_in ++;
                            // echo $newname;
                            //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
                            if(move_uploaded_file($image_tmp_name[$i], $newname_saveflie)){
                                mysqli_query($con, "INSERT INTO `room_picture`(`room_picture`) VALUES ('$newname')");
                                $pid = mysqli_insert_id($con);
                                mysqli_query($con, "INSERT INTO `picture_details`( `id_type`, `picture`) VALUES ('$tid','$pid')");
                            } 
                        }
                
                
                    }else{
                        echo "<script type='text/javascript'> alert('กรุณาใส่รูปภาพ')</script>";
                    }
                    echo "<script type='text/javascript'> window.location='editR.php?addDR'</script>";
                }
                ?>

                <div></div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <form method="POST">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>
                                        <tr>
                                            <th>รูปห้อง</th>
                                            <th>ชนิดห้อง</th>
                                            <th>ประเภทห้อง</th>
                                            <th>ประเภทเตียง</th>
                                            <th>ชั้นที่</th>
                                            <th>ราคาห้อง (บาท)</th>
                                            <th>ค่าประกัน (บาท)</th>
                                            <th>ลบ/แก้ไข ข้อมูล</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $ssql = mysqli_query($con, "SELECT room_details.id as id,
                                        room_picture.room_picture as  picture,
                                        room_type.name as name,
                                        bed_type.name as data,
                                        room_details.price as price,
                                        room_category.name as Cname,
                                        room_details.other as other,
                                        room_details.floor as floor
                                        FROM room_details 
                                        INNER JOIN picture_details on(picture_details.id_type = room_details.id)
                                        INNER JOIN room_type on(room_type.id = room_details.type) 
                                        INNER JOIN bed_type on(bed_type.id = room_details.bed) 
                                        INNER JOIN room_category on(room_category.id = room_details.reservation) 
                                        INNER JOIN room_picture on(picture_details.picture = room_picture.id)
                                        GROUP BY room_details.id
                                        ORDER BY `room_details`.`floor` ASC");
                                        while ($show = mysqli_fetch_array($ssql)) {
                                            $id = $show['id'];

                                            $counc = mysqli_query($con,"SELECT COUNT(picture) as count_c FROM `picture_details` WHERE `id_type` = $id");
                                            $count_c = mysqli_fetch_array($counc);
                                            echo "<tr>
                                            <td class='td'>
                                                <img id=" . $i . "  src='../assets/img/" . $show['picture'] . "'  class='resize' width='50px' height='50px'>
                                                <center><lable>จำนวนรูป [".$count_c['count_c']."]</lable></center>
                                                <div id='myModal' class='modal'>
                                                <img class='modal-content' id='img01' width='38%' >
                                            </td>
                                            <td class='td'>" . $show['name'] . "</td>
                                            <input type='hidden' name='name_edit' value='" . $show['name'] . "'>
                                            <td class='td'>" . $show['Cname'] . "</td>
                                            <td class='td'>" . $show['data'] . "</td>
                                            <td class='td'><div>" . $show['floor'] . "</div></td>
                                            <td class='td'><div>" . number_format($show['price']) . "</div></td>
                                            <td class='td'><div>" . number_format($show['other']) . "</div></td>";

                                                    echo ' <td class="td"><a href=delR.php?delE=' . $id . ' onclick="return confirm(\'คุณต้องการลบข้อมูล ' . $show['name'] . ' ชั้น ' . $show['floor'] . ' ใช่หรือไม่\')" 
                                            <button class="btn btn-danger"> <i class="fa fa-edit" ></i> ลบ</button></a>
                                            <a href=editD.php?eid_note=' . $id . '  <button class="btn btn-edit"> <i class="fa fa-pencil"></i> แก้ไข</button></a></td>
                                            
                                            </tr>';
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                            </form>
                            </table>

                        </div>


                        <!-- /. ROW  -->
                    </div>
                </div>
        <!-- PHP CODE INSERT ROOM -->
        <?php
            $errors = array();
            if (isset($_POST['log_insert'])) {

                $room = $_POST['room'];
                echo $detail =  $_POST['room_detel'];
                echo ' รายละเอียด<br>';
                $wather =  $_POST['wather_p'];
                $elec = $_POST['elec_p'];
                $status = $_POST['status'];

                echo $type_id = $_POST['type_id'];
                echo ' ชนิดห้อง<br>';
                echo $troom = $_POST['troom'];
                echo ' ประเภทห้อง<br>';
                echo $broom = $_POST['broom'];
                echo ' ประเภทเตียง<br>';
                echo $floor = $_POST['floor'];
                echo ' ชั้น<br>';
                $sql = "SELECT * FROM room_details
                        WHERE reservation = '$_POST[type_id]' 
                        AND type = '$_POST[troom]' AND bed = '$_POST[broom]' 
                        AND floor = '$_POST[floor]'";
                        
                $type = mysqli_query($con, $sql);

                $rowc = mysqli_fetch_array($type);
                
                if ($_POST['floor'] != $rowc['floor']) {
                    echo "<script type='text/javascript'> alert('ไม่มีข้อมูลราคาห้องในชั้นนี้ กรุณาเพิ่มชนิดห้องก่อน')</script>";
                    echo "<script type='text/javascript'> window.location='month.php'</script>";
                }
                $room_type = $rowc['id'];
            
                echo $room;
                echo "<br>";
                echo $detail;
                echo "<br>";
                echo $room_type;
                echo "<br>";

                echo $wather;
                echo "<br>";
                echo $elec;
                echo "<br>";
                echo $status;
                echo "<br>";


                $user_check_query = "SELECT * FROM `room` WHERE room = '$room'";
                $query = mysqli_query($con, $user_check_query);
                $result = mysqli_fetch_assoc($query);
			$ccv = mysqli_fetch_array($last_date_unit);

                echo $ccv['date_check'];
		    $note = 'กรุณาชำระเงินก่อนวันที่ 5 ของทุกเดือน ครับ/ค่ะ';
                switch ($_POST['type_id']){
                    case '1':
                        if($result){
                            if($result['room'] === $room){
                                array_push($errors,"room is Full");
                                echo "<script type='text/javascript'> alert('เลขห้อง $room มีอยู่แล้วกรุณาเปลี่ยนเลขห้องใหม่')</script>";
                                echo "<script type='text/javascript'> window.location='month.php'</script>";
            
                            }
                        }
            
                        if(count($errors)== 0)
                        {
                            $sqli = "INSERT INTO event_log (personal,date,time,event) 
                            VALUES ('".$_SESSION['personal_admin']."', '$date','$time','".$_SESSION['fname_A']." ".$_SESSION['lname_A']." เพิ่มห้อง $room ')";
                            mysqli_query($con,$sqli);
            
                            $sqli = "INSERT INTO room (`room`, `room_status`, `room_detal`, `type`, `paper`,`rule`, `unitPerWater`, `unitPerElectricity`, `note`) 
                            VALUES ('$room','$status','$detail','$room_type','1','2','$wather','$elec','$note')";
                            mysqli_query($con,$sqli);
            
            
                            echo "<script type='text/javascript'> window.location='month.php'</script>";
            
                        }
            
                        break;
                    
                    case '2':

                        if($result){
                            if($result['room'] === $room){
                                array_push($errors,"Username is Full");
                                echo "<script type='text/javascript'> alert('เลขห้อง $room มีอยู่แล้วกรุณาเปลี่ยนเลขห้องใหม่')</script>";
                                echo "<script type='text/javascript'> window.location='month.php'</script>";
            
                            }
                        }
            
                        if(count($errors)== 0)
                        {
                            $sqli = "INSERT INTO event_log (personal,date,time,event) 
                            VALUES ('".$_SESSION['personal_admin']."', '$date','$time','".$_SESSION['fname_A']." ".$_SESSION['lname_A']." เพิ่มห้อง $room ')";
                            mysqli_query($con,$sqli);
            
                            $sqli = "INSERT INTO room (`room`, `room_status`, `room_detal`, `type`, `paper`,`rule`, `unitPerWater`, `unitPerElectricity`, `note`) 
                            VALUES ('$room','$status','$detail','$room_type','1','2','$wather','$elec', '$note')";
                            mysqli_query($con,$sqli);
            
                            
                            $sqli = "INSERT INTO `receipt`(`room`, `date`, `totalWater`, `totalElectricity`, `receipt_total`, `payRent`) 
                            VALUES ('$room','$ccv[date_check]',null,null,null,'0')";
                            mysqli_query($con,$sqli);
            
                            $sqli = "INSERT INTO `unit`(`room`,
                            `last_unit_water`,
                            `last_unit_electricity`, `other`, `date`) 
                            VALUES ('$room',null,null,null,'$ccv[date_check]')";
                            mysqli_query($con,$sqli);
            
                            echo "<script type='text/javascript'> window.location='month.php'</script>";
            
                        }
            
                        break;
                }
            

                
            }
            ?>
            <!-- END CODE INSERT ROOM -->
            <?php endif; ?>
          

            <!-- /. WRAPPER  -->
            <script>
                // Get the modal

                var modal = document.getElementById('myModal');

                // Get the image and insert it inside the modal - use its "alt" text as a caption

                for (let i = 0; i <= 1000;) {
                    var img = document.getElementById(i);
                    i++;
                    var modalImg = document.getElementById("img01");
                    var captionText = document.getElementById("caption");

                    img.onclick = function() {
                        modal.style.display = "block";
                        modalImg.src = this.src;
                        modalImg.alt = this.alt;
                        captionText.innerHTML = this.alt;
                    }


                    // When the user clicks on <span> (x), close the modal
                    modal.onclick = function() {
                        img01.className += " out";
                        setTimeout(function() {
                            modal.style.display = "none";
                            img01.className = "modal-content";
                        }, 400);

                    }

                }
            </script>

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

</body>

</html>
