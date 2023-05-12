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
<?php if (isset($_GET['payid']))
    $pid = $_GET['payid'];
$id = base64_decode(substr($pid, 4));


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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap"
        rel="stylesheet">

</head>

<style>
@media screen and (max-width:550px) {
    div {
        font-size: 13px;
    }
}

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
    width: 750px;
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

    // Script ห้ามลากรูปภาพ
    document.ondragstart = function() {
        return false;
    };

    function chk_pic() {
        var file = document.upfile.fileupload.value;
        var patt = /(.jpg|.png|.jpeg|.AVIF)/;
        var result = patt.test(file);
        if (!result) {
            alert('การจองผิดพลาด (รูปหลักฐานการโอน นามสกุล jpg,png,jpeg,AVIF เท่านั้น)');
        }
        return result;
    }
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
                    <li><a class="" href="../homepage_log.php">หน้าหลัก</a></li>
                    <li class="dropdown"><a href="#" class="nav-link scrollto active"><span>จองห้องพัก</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="roomDay_log.php" class="dropdown-item">รายวัน</a></li>
                            <li><a href="roomMonth_log.php" class="dropdown-item">รายเดือน</a></li>
                        </ul>
                    </li>


                    <?php if (!isset($_SESSION['personal'])) : ?>
                    <li><a class="getstarted scrollto" href="login.php">Login</a></li>
                    <?php endif ?>

                    <?php if (isset($_SESSION['personal'])) : ?>

                    <li class="nav-item dropdown"><a href="#"><i
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

    <br>
    <?php

    $qry = $con->query("SELECT * FROM reserve INNER JOIN room_details ON(reserve.room_type = room_details.id)WHERE reservation_id = '$id'");
    while ($row = $qry->fetch_assoc()) :



        $sqlbank1 = "SELECT * FROM bank INNER JOIN abank ON(bank.id = abank.b_id)";
        $result1 = $con->query($sqlbank1);

        $sqlbank2 = "SELECT * FROM bank ";
        $result2 = $con->query($sqlbank2);

      
    ?>
    <div class="form-style-10 w-75">
        <h1>กรุณาชำระเงิน<span>รหัสการจอง: <?php echo $id; ?></span> </h1>
        <form action="" method="post" enctype="multipart/form-data" name="upfile" id="upfile"
            onSubmit="return chk_pic()">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">

                        <thead>
                            <tr>
                                <td width="20%"></td>
                                <td width="40%"></td>
                                <td width="40%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($rowbank = $result1->fetch_assoc()) : ?>
                            <tr>
                                <td><img class="img-fluid" src="../assets/img/bank/<?php echo $rowbank['img'] ?>" alt=""
                                        style="width:100%"></td>
                                <td class="name">
                                    <?php echo $rowbank['bname']; ?> <br>
                                    <?php echo $rowbank['uname']; ?>
                                </td>
                                <td><?php echo $rowbank['bnumber']; ?></td>
                            </tr>
                            <?php endwhile ?>
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="panel-footer">

                <div class="form-group">
                    <label>จำนวนเงินทั้งหมดที่ต้องชำระ</label>
                    <input type="text" name="reservation_money" class="text"
                        value="<?php echo $row['reservation_money'] ?>" disabled>
                    <br>
                    <label>ชำระขั้นต่ำ</label>
                    <?php $sum = $row['room_count'] * $row['minimum']?>
                    <input type="text" name="" class="text" value="<?php echo number_format($sum) ?>" disabled>
                    <lable style='font-size:12px;color:red'>ค่าห้อง ห้องละ <?php  echo $row['minimum']?> จำนวน <?php  echo $row['room_count']?> รวม <?php  echo number_format($sum)?></lable>
                    <br>
                    <label>จำนวนเงินที่ชำระ <lable style="color:red;font-size:25px">*</lable></label>
                    <input type="text" name="pay" id="pay" class="text"
                        onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required>
                    <br>
                    <div>
                        <label>หลักฐานการโอน</label>
                        <input class="form-control" type="file" name="fileupload" accept="image/png, image/jpeg, image/jpg" required>
                    </div>
                    <br>
                    <div>
                        <label>ชื่อธนาคารของคุณ</label>
                        <select name="bank" >
                            <option value="" selected></option>
                            <?php while ($rowbank2 = $result2->fetch_assoc()) : ?>
                            <option value="<?php echo $rowbank2['bname'] ?>"><?php echo $rowbank2['bname'] ?></option>
                            <?php endwhile ?>
                        </select>

                    </div>
                    <br>

                    <div>
                        <label>เลขบัญชี</label>
                        <input class="form-control" type="text" name="nobank" maxlength="15" 
                            onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}">
                    </div>
                    <br>
                    <div>
                        <label>ชื่อบัญชี</label>
                        <input class="form-control" type="text" name="namebank" >
                    </div>
                    <br>
                    <div>
                        <label style="color:red">หมายเหตุ :
                            จองห้องพักรบกวนโอนเงินจองห้องไว้ล่วงหน้า(หากไม่มีการโอนเงินจองไว้การจองถือเป็นโมฆะ)</label>
                    </div>
                </div>
                <div class="button-section" align="center">
                    <input type="submit" name="submit" class="btn btn-success" />
                </div>

            </div>
        </form>


        <?php 
                  
                  date_default_timezone_set('asia/bangkok');
                  $date = date("Y-m-d");
                  $time = date("H:i:s");



if (isset($_POST['submit'])) {

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
   $bank = $_POST['bank'];
   $nobank = $_POST['nobank'];
   $namebank = $_POST['namebank'];
   $pay = $_POST['pay'];

   $status = "รออนุมัติ";
   $payid = 'abcd' . base64_encode($id);
   $rpsql = "UPDATE `reserve` SET `proof_of_transfer`='$newname',`reserve_status` = '$status',`bank` = '$bank',`nobank` = '$nobank',`namebank` = '$namebank',`pay` = '$pay'  where reservation_id = '$id'";
   if (mysqli_query($con, $rpsql)) {
       
       $sqlie = "INSERT INTO event_log (personal,date,time,event) 
       VALUES ('" . $_SESSION['personal'] . "','$date','$time','" . $row['fname'] . " " . $row['lname']. " ชำระเงินการจอง รหัสการจอง $id ')";
       mysqli_query($con, $sqlie);
       

       echo "<script type='text/javascript'> alert('ชำระเรียบร้อย')</script>";
       echo "<script type='text/javascript'> window.location ='r_status.php?id=" . $payid . "'</script>";
   }
}
        ?>
        <?php endwhile; ?>

    </div>

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
function isNumberKey(txt, evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode == 46) {
        //Check if the text already contains the . character
        if (txt.value.indexOf('.') === -1) {
            return true;
        } else {
            return false;
        }
    } else {
        if (charCode > 31 &&
            (charCode < 48 || charCode > 57))
            return false;
    }
    return true;
}
</script>