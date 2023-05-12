<?php
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 } 
include 'db.php';
include 'date.php';
include 'query.php';
if (!isset($_SESSION['premission']) == "Admin") {
	header("location: ../homepage_log.php");
}
?>

<?php
if (!isset($_GET["rid"])) {
	$_SESSION['reserve'] = "กรุณาตรวจสอบสถาณะการจองห้องพักก่อน";
	header("location:home.php");
} else {



	$id = $_GET['rid'];


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
		$minimum = $row['minimum'];

		/*เวลากำหนดชำระ */

		date_default_timezone_set('asia/bangkok');//เวลา
		$date = date('d-m-Y H:i');


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
<script type="text/javascript">
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
                <a class="navbar-brand" href="home.php" style="width:1000px"> <?php echo $hd['header']?></lable> </a>
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
                        <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/dormitory/logout.php" onclick="return confirm('ยืนยันการออกจากระบบ')"><i
                                    class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                        <div style="background-color:#FF9900;color:black;font-size:20px" align="center">
                            จัดการการจองห้องพัก</div>
                    </li>
                    <li>
                        <a class="active-menu" href="home.php"><i class="fa fa-dashboard"></i> การจองห้อง <lable
                                style="color:red">ใหม่ </lable><span class="badge"><?php echo $c; ?></span></a>
                    </li>
                    <ul class="nav" id="main-menu">
                        <li>
                            <a class="active-menu" href="roombook.php?rid=<?php echo $id?>"><i
                                    class="fa fa-folder-open"></i> ข้อมูลการจองห้องพัก เลข <?php echo $id?></a>
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
                            ข้อมูลการจองห้องพัก<small> <?php echo  $date; ?> </small>
                        </h1>
                    </div>


                    <div class="col-md-8 col-sm-8">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Booking Conformation <span style="float: right;">รหัสการจอง : <?php echo $id ?></span>
                            </div>
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>DESCRIPTION</th>
                                            <th>INFORMATION</th>

                                        </tr>
                                        <tr>
                                            <th>ชื่อ</th>
                                            <th><?php echo $title . " " . $fname . " " . $lname; ?> </th>

                                        </tr>
                                        <tr>
                                            <th>เบอร์โทรศัพท์ </th>
                                            <th><?php echo $phone; ?></th>

                                        </tr>
                                        <tr>
                                            <th>วันที่จอง </th>
                                            <th><?php list($y, $m, $d) = explode('-', $day_reserve); echo $d . '/' . $m . '/' . date($y+543) ;   ?>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>เวลาที่จอง </th>
                                            <th><?php  echo $time_reserve; ?> น.</th>

                                        </tr>

                                        <tr>
                                            <th>ประเภทห้อง </th>
                                            <th><?php echo $troom; ?></th>

                                        </tr>

                                        <tr>
                                            <th>ห้อง </th>
                                            <th><?php echo $cname; ?></th>

                                        </tr>

                                        <tr>
                                            <th>เตียง </th>
                                            <th><?php echo $bname; ?></th>

                                        </tr>

                                        <tr>
                                            <th>วันที่เช็คอิน </th>
                                            <th><?php list($y, $m, $d) = explode('-', $ccin); echo $d . '/' . $m . '/' . date($y+543) ; ?>
                                            </th>

                                        </tr>
                                        <?php if ($reservation == "1") : ?>
                                        <tr>
                                            <th>วันที่เช็คเอาท์</th>
                                            <th><?php list($y, $m, $d) = explode('-', $ccout); echo $d . '/' . $m . '/' . date($y+543) ; ?>
                                            </th>
                                        </tr>
                                        <?php endif ?>
                                        <tr>
                                            <th>รถคนเข้าพัก</th>
                                            <th><?php if (empty($car)) {
													echo "ไม่มีรถ";
												} else {
													echo "ประเภทรถยนต์ <lable class='text'>" . $car . " </lable>  สี<lable class='text'> " . $color . " </lable>ป้ายทะเบียน<lable class='text'> " . $pad;
												} ?></lable>
                                            </th>

                                        </tr>

                                        <?php if ($reservation == 2) : ?>
                                        <tr>
                                            <th>ราคาห้อง </th>
                                            <th><?php echo $price; ?> บาท/เดือน</th>
                                        </tr>
                                        <?php endif ?>
                                        <?php if ($reservation == 1) : ?>
                                        <tr>
                                            <th>ราคาห้อง </th>
                                            <th><?php echo $price; ?> บาท/วัน</th>
                                        </tr>
                                        <tr>
                                            <th>จำนวนวันที่จอง</th>
                                            <th><?php echo $noday ?> วัน</th>
                                        </tr>
                                        <tr>
                                            <th>ราคา</th>
                                            <th><?php echo $price * $noday ?> บาท</th>

                                        </tr>
                                        <?php endif ?>
                                        <tr>
                                            <th>เงินประกัน</th>
                                            <th><?php echo $other ?> บาท</th>

                                        </tr>


                                        <tr>
                                            <th>สถานะการจอง</th>
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
                                            <th><?php echo $money ?> บาท</th>

                                        </tr>

                                        <tr>
                                            <th>จำนวนเงินที่ต้องชำระขั้นต่ำ</th>
                                            <th><?php echo $minimum ?> บาท</th>

                                        </tr>

                                        <tr>
                                            <th>จำนวนเงินที่ลูกค้าโอน</th>
                                            <th><?php echo $pay ?> บาท</th>

                                        </tr>

                                        <tr>
                                            <th>ยอดที่ต้องชำระเพิ่ม</th>
                                            <th><?php echo $money-$pay ?> บาท</th>

                                        </tr>
                                    </table>
                                </div>



                            </div>
                            <?php if ($sta != "รอชำระเงิน") : ?>
                            <div class="panel-footer">
                                <form method="post" enctype="multipart/form-data" name="upfile" id="upfile"
                                    onSubmit="return chk_pic();">
                                    <div class="form-group">
                                        <label>ยืนยันสถานะการจองห้องพัก</label>
                                        <select name="conf" id="conf" class="form-control" required>
                                            <option value selected> </option>
                                            <option value="ชำระแล้ว">ผ่าน</option>
                                            <option value="การจองผิดพลาด">ไม่ผ่าน</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="because" style="display:none;">
                                        <div>
                                            <label>เหตุผล</label>
                                            <input type="text" name="reason" id="text" class="form-control">
                                        </div>
                                        <br>
                                        <div>
                                            <label>หลักฐานการคืนเงิน</label>
                                            <input type="file" name="fileupload" id="img" class="form-control">
                                        </div>
                                    </div>
                                    <br>
                                    <input type="submit" name="co" value="ยืนยัน"
                                        onclick="return confirm('คุณต้องการ ยืนยันสถานะการจองห้องพัก หรือไม่?')"
                                        class="btn btn-success">

                                </form>

                                <script>
                                function chk_pic() {
                                    var option = document.getElementById('conf').value;
                                    var check = document.getElementById('text').value;
                                    var img = document.getElementById('img').value;
                                    switch (option) {
                                        case 'การจองผิดพลาด':
                                            if (check == "") {
                                                alert('กรุณาระบุบเหตุผล');
                                                return false;
                                            }
                                            break;
                                    }
                                }
                                </script>
                            </div>
                            <?php endif ?>
                            <?php if ($sta == "รอชำระเงิน") : ?>
                            <div class="panel-footer">
                                <form method="post">
                                    <input type="submit" name="co1" value="ยกเลิกการจอง" class="btn btn-danger"
                                        onClick="javascript:return confirm('คุณต้องการลบข้อมูลใช่หรือไม่');">
                                </form>
                            </div>
                            <?php endif ?>
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
$year = date("Y") + 543;
$date_reg = date("d/m/$year"); // เก็บวันที่สมัคร และเปลี่ยนปีเป็น พ.ศ

date_default_timezone_set('asia/bangkok'); //เวลา
$date = date('H:i:s');

if (isset($_POST['co'])) {

	$st = $_POST['conf'];

	if ($st == "การจองผิดพลาด") {

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
			$path = "../assets/img/refund/";

			//เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
			$type = strrchr($_FILES['fileupload']['name'], ".");

			//ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
			$newname = $date . $numrand . $type;
			$path_copy = $path . $newname;
			$path_link = "fileupload/" . $newname;

			//คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
			move_uploaded_file($_FILES['fileupload']['tmp_name'], $path_copy);
		}


		$rpsql = "UPDATE `reserve` SET `reserve_status`='การจองผิดพลาด',`reason`='$_POST[reason]',`refund`='$newname',`name_admin`='" . $_SESSION['fname'] . "  " . $_SESSION['lname'] . "' WHERE `reservation_id`='$id' ";

		$sqli = "INSERT INTO event_log (personal,date,time,event) 
							VALUES ('" . $_SESSION['personal'] . "', '$date_reg','$date','ยืนยันการจองห้องผิดพลาด รหัสใบเสร็จ $id ชื่อ $fname นามสกุล $lname')";
		mysqli_query($con, $sqli);
		if (mysqli_query($con, $rpsql)) {
			echo "<script type='text/javascript'> alert('ยืนยันการตั้งสถานะการจองห้องพัก')</script>";
			echo "<script type='text/javascript'> window.location='home.php'</script>";
		}
	}

	if ($st == "ชำระแล้ว") {


		$rpsql = "UPDATE `reserve` SET `reserve_status`='ชำระแล้ว',`name_admin`='" . $_SESSION['fname'] . "  " . $_SESSION['lname'] . "' WHERE `reservation_id`='$id' ";

		$sqli = "INSERT INTO event_log (personal,date,time,event) 
							VALUES ('" . $_SESSION['personal'] . "', '$date_reg','$date','ยืนยันการจองห้อง รหัสใบเสร็จ $id ชื่อ $fname นามสกุล $lname')";
		mysqli_query($con, $sqli);
		if (mysqli_query($con, $rpsql)) {
			echo "<script type='text/javascript'> alert('ยืนยันการตั้งสถานะการจองห้องพัก')</script>";
			echo "<script type='text/javascript'> window.location='home.php'</script>";
		}
	}
}

if (isset($_POST['co1'])) {
	$rpsql = "DELETE FROM `reserve` WHERE `reservation_id`='$id' ";
	if (mysqli_query($con, $rpsql)) {
		echo "<script type='text/javascript'> alert('ยกเลิกการจองเรียบร้อย')</script>";
		echo "<script type='text/javascript'> window.location='home.php'</script>";
	}
}

?>