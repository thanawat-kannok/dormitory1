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

    * {
        font-size: 14px;
    }

    .bnnc {
        background-color: green;
        color: white;
        padding: 5px;
        border-radius: 5px;
        border: 1px solid;
        font-size: 20px;
    }

    .bnnt {
        background-color: #DCDCDC;
        color: green;
        padding: 5px;
        border-radius: 5px;
        border: 1px solid;
    }

    .bnnc:hover,
    .bnnt:hover {
        background-color: red;
        color: white;
    }

    .tbs {
        padding: 0px 5px;
    }

    .input,
    .textarea {
        border: 1px solid #ccc;
        font-family: inherit;
        font-size: inherit;
        padding: 1px 6px;
    }

    .input-wrap {
        position: relative;
    }

    .input-wrap .input {
        position: absolute;
        width: 100%;
        left: 0;
    }

    .width-machine {
        /*   Sort of a magic number to add extra space for number spinner */
        padding: 0 0.6rem;
    }

    .btr {
        background-color: green;
        color: white;
    }

    .bte:hover,
    .bta:hover,
    .btr:hover {
        opacity: 0.8;
        color: white;
    }

    .btn-edit {
        background-color: #FFFF00;
        color: black;
        border: 1px solid black;
    }

    .btn-edit:hover {
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
                        <a class="active-menu" href="user.php"><i class="fa fa-user-circle"></i> จัดการผู้ใช้</a>
                    </li>
                    <ul class="nav" id="main-menu">
                   
                        <li>
                            <a  href="user.php" ><i class="fa fa-user-plus"></i> ผู้ใช้ที่ มีห้องพัก   <?php echo "<lable style='color:#FFFF99' ><i class='fa fa-user'></i>  ".$y."</lable>" ?></a>
                        </li>
                        <li>
                            <a href="usernt.php" ><i class="fa fa-user-times"></i> ผู้ใช้ที่ ไม่มีห้องพัก   <?php echo "<lable style='color:#FFFF99' ><i class='fa fa-user'></i>  ".$x."</lable>" ?></a>
                        </li>
                        <li>
                            <a class="active-menu" href="userall.php" ><i class="fa fa-users"></i> ผู้ใช้ ทั้งหมด   <?php echo "<lable style='color:#FFFF99' ><i class='fa fa-user'></i>  ".$z."</lable>" ?></a>
                        </li>
                    </ul>
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
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1>
                            จัดการสมาชิก (ทั้งหมด)
                        </h1>
                    </div>
                </div>
                <br>
                <!-- /. ROW  -->
                <button data-toggle="modal" data-target="#myModal" class='btn btn-primary' style="margin-bottom:5px"><i class="fa fa-plus-circle"></i> สร้างผู้ใช้</button>
                <br>
                <!-- <a href="user.php"><button class='bnnt'> ลูกค้าที่มีห้องพัก</button></a>
                <a href="usernt.php"><button class='bnnt'>ลูกค้าที่ไม่มีห้องพัก</button></a>
                <a href="userall.php"><button class='bnnc'><i class="fa fa-map-marker"></i>ลูกค้าทั้งหมด</button></a> -->
                <form method="post">
                    <button class='btn btn-danger' name="delall" style="margin:0px 5pxt" onclick="return confirm('คุณต้องการ[ลบ]ข้อมูลที่เลือก ใช่หรือไม่?')">ลบที่เลือก</button>


                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">

                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                            <thead>
                                                <tr>
                                                    <th>
                                                    <center>All</center>
                                                    <center><input type="checkbox" class="checkmark" name="css_all_check" id="css_all_check" />
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

                                                    <th><center>รหัสบัตรประชาชน</th>
                                                    <th><center>ชื่อ</th>
                                                    <th><center>เพศ</th>
                                                    <th><center>เบอร์โทร</th>
                                                    <th><center>เลขห้อง</th>
                                                    <th><center>สถานะ</th>
                                                    <th><center>แก้ไข</th>
                                                    <th><center>ลบ</th>
                                                    <th><center>สัญญาเช่า</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $j = 0;
                                                while ($trow = mysqli_fetch_array($user_all)) {


                                                    $room = $trow['room'];


                                                    $id = $trow['personal'];
                                                    echo "<tr>
                                                            <th><center><input type='checkbox' name='chkl[ ]' class='checkmark'value='" . $trow['personal'] . "'></center></th>
                                                            <th>
                                                            <lable>" . base64_decode($trow['personal']) . "</lable>
                                                            </th>
                                                            <th>
                                                            <lable>" . $trow['prefix_name'] . " " . $trow['fname'] . " " . $trow['lname'] . "</lalbe>
                                                            </th>

                                                            <th>";
                                                    if ($trow['sex'] != "ชาย") {
                                                        echo "<lable>หญิง</lable>";
                                                    } else {
                                                        echo "<lable>ชาย</lable>";
                                                    }
                                                    echo "
                                                        <th><lable>" . $trow['phone'] . "</lable>
                                                        </th>
                                        
                                                        <th>
                                                        <lable><center>";
                                                    if ($trow['room'] == null) {
                                                        echo "<lable style='color:red'>ไม่มี</lable>";
                                                    } else {
                                                        echo "" . $trow['room'] . "";
                                                    }
                                                    echo "</lable>      
                                                        </th>
                                                        <th>";
                                                    if ($trow['premission'] == "Admin") {
                                                        echo "<lable>Admin</lable>";
                                                    } else {
                                                        echo "<lable>Member</lable>";
                                                    }
                                                    echo "
                                                        </th>";
                                                    echo '
                                                        <td><a href=editU.php?eid_U=' . $id . ' <button  class="btn btn-edit"><i class="fa fa-pencil"></i> แก้ไข</button></td>
                                                        <td><a href=delR.php?delU=' . $id . ' onclick="return confirm(\'คุณต้องการลบผู้ใช้ชื่อ ' . $trow['prefix_name'] . ' ' . $trow['fname'] . ' ' . $trow['fname'] . ' ใช่หรือไม่\')" 
                                                        <button class="btn btn-danger" style="border:1px solid black;"> <i class="fa fa-times-circle" ></i> ลบ</button></a></td>
                                                        <td>';
                                                    if ($room == null) {
                                                        echo '<button class="btn btn-edit" style="background-color:green;color:white" disabled> <i class="fa fa-edit" ></i> ออกสัญญา</button>';
                                                    } else {
                                                        echo '<a href=lease.php?lease=' . $id . ' <button class="btn btn-edit" style="background-color:green;color:white"> <i class="fa fa-edit" ></i> ออกสัญญา</button></a>';
                                                    }
                                                    echo '</td>

                                                        </tr>';
                                                    $j++;
                                                }
                                                ?>
                                            </tbody>
                </form>
                </table>

            </div>


            <!-- /. ROW  -->
        </div>
    </div>

    </div>

    <script>
        // Dealing with Input width
        let el = document.querySelector(".input-wrap .input");
        let widthMachine = document.querySelector(".input-wrap .width-machine");
        el.addEventListener("keyup", () => {
            widthMachine.innerHTML = el.value;
        });

        // Dealing with Textarea Height
        function calcHeight(value) {
            let numberOfLineBreaks = (value.match(/\n/g) || []).length;
            // min-height + lines x line-height + padding + border
            let newHeight = 20 + numberOfLineBreaks * 20 + 12 + 2;
            return newHeight;
        }

        let textarea = document.querySelector(".resize-ta");
        textarea.addEventListener("keyup", () => {
            textarea.style.height = calcHeight(textarea.value) + "px";
        });
    </script>

    <!-- POPUP สร้างวผุ้ใช้ -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">สร้างผู้ใช้</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <form method="post" name="frm" onSubmit="JavaScript:return fncSubmit();">
                            <table width="100%" border="0">
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class="text">ชื่อ<lable style="color:red">*</lable>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text">นามสกุล<lable style="color:red">*</lable>
                                        </div>
                                    </td>
                                    <tr>
                                    <td>
                                        <lable style="color:red">*</lable>
                                        <select name="prefix_name" style="width:90%" id="myList" onchange="ck_null(this)" required>
                                            <option name=""  value="" >คำหน้าชื่อ</option>
                                            <option name="นาย"  value="นาย">นาย</option>
                                            <option name="นาง"  value="นาง">นาง</option>
                                            <option name="นางสาว"  value="นางสาว">นางสาว</option>
                                        </select>
                                    </td>
                                    <td class="tbs"><input type="text" name="fname" class="form-control" minlength="2" maxlength="20" placeholder="ชื่อ" required></td>
                                    <td class="tbs"><input type="text" name="lname" class="form-control" minlength="2" maxlength="20" placeholder="นามสกุล" required></td>
                                </tr>
                                <tr>
                                    <td style="padding-top:10px;">
                                        
                                        <input type="text" name="sex" id="favourite" readonly class="form-control size" >
                                    </td>
                                    <td style="padding:10px;">
                                        วันเกิด<lable style="color:red">*</lable>
                                        <input type="date" name="date" id="date" onchange="calAge(this);" required>

                                    </td>
                                    <td>
                                        <lable id="sum"></lable>
                                    </td>
                                    <script>
                                        function calAge() {
                                            var date = document.getElementById('date').value;

                                            var date_input = new Date(date);

                                            var day = date_input.getDate();
                                            var month = date_input.getMonth() + 1;
                                            var year = date_input.getFullYear();

                                            var today = new Date();

                                            var d = today.getDate();
                                            var m = today.getMonth() + 1;
                                            var y = today.getFullYear();
                                            var ageYear = y - year;



                                            if (ageYear >= "0" && ageYear < "18") {
                                                document.getElementById("sum").innerHTML = ('<font color="red">อายุของคุณไม่ถึง 18 ปี</font>');
                                                return {
                                                    ageYear
                                                };
                                            } else if (ageYear >= "80") {
                                                document.getElementById("sum").innerHTML = ('<font color="red">อายุของคุณมากเกินไป</font>');
                                                return {
                                                    ageYear
                                                };
                                            } else {
                                                document.getElementById("sum").innerHTML = ('<font color="green">' + " อายุ " + ageYear + "  ปี " + ' </font>');
                                                return {
                                                    ageYear
                                                };
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="tbs">
                                        <label class="text">บัตรประชาชน<lable style="color:red">*</lable></label>
                                        <input type="text" name="personal" id="personal" class="form-control" maxlength="13" minlength="13" required onKeyUp="JavaScript:refreshh(this)" placeholder="เลขบัตรประชาชน">
                                        <script type="text/javascript">
                                            function refreshh() {
                                                var a1 = document.getElementById("personal").value;
                                                document.getElementById('FrameID').contentWindow.location = "checkuser.php?uid=" + a1;
                                            }
                                        </script>
                                        <script>
                                            $(function() {
                                                var $select = $("#18-100");
                                                for (i = 18; i <= 100; i++) {
                                                    $select.append($('<option></option>').val(i).html(i))
                                                }
                                            });


                                            $(document).ready(function() {
                                                $('#personal').on('keyup', function() {
                                                    if ($.trim($(this).val()) != '' && $(this).val().length == 13) {
                                                        id = $(this).val().replace(/-/g, "");
                                                        var result = Script_checkID(id);

                                                        if (result === false) {
                                                            document.getElementById("error").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> เลขบัตรประชาชนผิด</font>');
                                                            return result;
                                                        } else {
                                                            document.getElementById("error").innerHTML = ('<font color="green"><i class="fa fa-check-circle" ></i> เลขบัตรประชาชนถูกต้อง</font>');
                                                            return result;
                                                        }
                                                    } else {
                                                        $('span.error').removeClass('true').text('');
                                                        return result;
                                                    }
                                                })
                                            });

                                            function Script_checkID(id) {
                                                if (!IsNumeric(id)) return false;
                                                if (id.substring(0, 1) == 0) return false;
                                                if (id.length != 13) return false;
                                                for (i = 0, sum = 0; i < 12; i++)
                                                    sum += parseFloat(id.charAt(i)) * (13 - i);
                                                if ((11 - sum % 11) % 10 != parseFloat(id.charAt(12))) return false;
                                                return true;
                                            }

                                            function IsNumeric(input) {
                                                var RE = /^-?(0|INF|(0[1-7][0-7]*)|(0x[0-9a-fA-F]+)|((0|[1-9][0-9]*|(?=[\.,]))([\.,][0-9]+)?([eE]-?\d+)?))$/;
                                                return (RE.test(input));
                                            }
                                        </script>
                                    </td>
                                    <td class="tbs">
                                        <div class="text">เบอร์โทรศัพท์<lable style="color:red">*</lable>
                                        </div>
                                        <input type="text" name="telephone_number" class="form-control" maxlength="10" minlength="10" onkeypress="return CharacterFormat(this,event,1);" placeholder="088***6565" required>
                                    </td>
                                    <td class="tbs">
                                        <div class="text">Line</div>
                                        <input type="text" name="line" class="form-control" placeholder="@ID Line" maxlength="40" name="line">
                                    </td class="tbs">
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <lable class="error" id="error"></lable>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <iframe width="300" height="50" name="FrameID" id="FrameID" style="border:0px;float:left;"></iframe>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tbs">
                                        <div class="text">รหัสผ่าน<lable style="color:red">*</lable>
                                        </div>
                                        <input type="password" id="pass1" name="psw1" class="form-control" minlength="4" maxlength="30" placeholder="รหัสผ่าน" onchange="return pass(this)" required>
                                    </td>
                                    <td class="tbs">
                                        <div class="text">ยืนยันรหัสผ่าน<lable style="color:red">*</lable>
                                        </div>
                                        <input type="password" id="pass2" name="psw2" class="form-control" minlength="4" maxlength="30" placeholder="ยืนยันรหัสผ่าน" onchange="return pass(this)" required>
                                    </td>
                                    <td class="tbs">
                                        <div id="pass" class="Warning"></div>
                                        <div id="pass_limit" class="Warning"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tbs">
                                        <label for="province" class="fontcity text" required>จังหวัด<lable style="color:red">*</lable></label>
                                        <select name="province_id" id="province" class="form-control" style="width:100%">
                                            <option value="" class="fontcity">กรุณาเลือก จังหวัด</option>
                                            <?php while ($result = mysqli_fetch_assoc($query_address)) : ?>
                                                <option value="<?= $result['id'] ?>"><?= $result['name_th'] ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </td>
                                    <td class="tbs">
                                        <label for="amphure" class="fontcity text" required>อำเภอ/เขต<lable style="color:red">*</lable></label><br>
                                        <select name="amphure_id" id="amphure" class="form-control" style="width:100%">
                                            <option value="" class="fontcity">กรุณาเลือก อำเภอ</option>
                                        </select>
                                    </td>
                                    <td class="tbs">
                                        <label for="district" class="fontcity text" required>แขวง/ตำบล<lable style="color:red">*</lable></label><br>
                                        <select name="district_id" id="district" class="form-control" style="width:100%">
                                            <option value="" class="fontcity">กรุณาเลือก ตำบล</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tbs">
                                        <label class="text" required>บ้านเลขที่<lable style="color:red">*</lable></label>
                                        <input type="text" name="home_number" class="form-control" maxlength="50" placeholder="บ้านเลขที่">
                                    </td>
                                    <td class="tbs">
                                        <label class="text">ถนน</label>
                                        <input type="text" name="road" class="form-control" maxlength="50" placeholder="ถนน">
                                    </td>
                                    <td class="tbs">
                                        <label class="text">หมู่ที่</label>
                                        <input type="text" name="village" class="form-control" maxlength="50" placeholder="" ">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class=" tbs">
                                        <div class="text">ห้อง</div>
                                        <select name="room_inv">
                                            <option value=''>ไม่มีห้อง</option>
                                            <?php
                                            while ($rrm = mysqli_fetch_array($room_all)) {
                                                $cnn = mysqli_query($con, "SELECT COUNT(room) as limitz FROM `user` WHERE user.room = " . $rrm['room'] . "");
                                                $limitz = mysqli_fetch_array($cnn);

                                                if ($limitz['limitz'] <= '0') {
                                                    echo '<option style="color:green" value="' . $rrm['room'] . '">' . $rrm['room'] . ' </option>';
                                                } else {
                                                    echo '<option style="color:red" value="' . $rrm['room'] . '">' . $rrm['room'] . ' (' . $limitz['limitz'] . ' คน) </option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td class="tbs">
                                        <div class="text">สถานะ</div>
                                        <select class="" name="premiss">
                                            <option value="Member">Member</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="checkbox" id="myCheck" onclick="myFunction()" class="rule" required>

                                        <label for="myCheck">ยอมรับข้อตกลงในการใช้บริการ<a href="#" onclick="open_popup('../rule.php')">อ่านกฏของหอพัก</a></label>
                                        <lable id="text" style="display:none;color:green" class="rule_text">ยอมรับข้อตกลง</lable>
                                        <script>
                                            function open_popup(url) {
                                                window.open(url, null, "height=700,width=500,status=yes,toolbar=no,menubar=no,location=no");
                                            }
                                        </script>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit" name="adddata" class="btn btn-primary" id="reg_user">สมัครสมาชิก</button>
                                        <button type="reset" class="btn btn-default">ยกเลิก</button>
                                    </td>
                                </tr>

                                </tr>
                            </table>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- END POPUP สร้างผู้ใช้ -->
    <!-- POPUP รับค่าสร้างผู้ใช้ -->
    <?php
    $errors = array();
    if (isset($_POST['adddata'])) {
        // $d = $_POST['day'];
        // $m = $_POST['month'];
        // $y = $_POST['year'];
        // $dob = $y.'-'.$m.'-'.$d;
        $dob = $_POST['date'];
        $personal = mysqli_real_escape_string($con, $_POST['personal']);

        $personal = base64_encode($personal);

        $prefix_name = mysqli_real_escape_string($con, $_POST['prefix_name']);
        $fname = mysqli_real_escape_string($con, $_POST['fname']);
        $lname = mysqli_real_escape_string($con, $_POST['lname']);
        $sex = mysqli_real_escape_string($con, $_POST['sex']);
        $line = mysqli_real_escape_string($con, $_POST['line']);
        $phone = mysqli_real_escape_string($con, $_POST['telephone_number']);

        $districts = mysqli_real_escape_string($con, $_POST['district_id']);
        $road = mysqli_real_escape_string($con, $_POST['road']);
        $home_number = mysqli_real_escape_string($con, $_POST['home_number']);
        $village = mysqli_real_escape_string($con, $_POST['village']);

        $psw1 = mysqli_real_escape_string($con, $_POST['psw1']);
        $psw2 = mysqli_real_escape_string($con, $_POST['psw2']);

        $room_inv = mysqli_real_escape_string($con, $_POST['room_inv']);
        $premiss = mysqli_real_escape_string($con, $_POST['premiss']);

        if ($psw1 != $psw2) {
            array_push($errors, "Username is Full");
            echo "<script type='text/javascript'> alert('รหัสผ่านไม่ตรงกัน')</script>";
            echo "<script type='text/javascript'> window.location='userall.php'</script>";
        } else echo "Error psw";

        $user_check_query = "SELECT * FROM user WHERE personal = '$personal'";
        $query = mysqli_query($con, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) {
            if ($result['personal'] === $personal) {
                array_push($errors, "Username is Full");
                echo "<script type='text/javascript'> alert('รหัสบัตรประชาชนนี้มีผู้ใช้งานแล้ว')</script>";
                echo "<script type='text/javascript'> window.location='userall.php'</script>";
            }
        } else echo "Error result";

        if (count($errors) == 0) {
            $password = md5($psw1);

            if ($room_inv != '') {

                $sql = "INSERT INTO user (personal,prefix_name,fname,lname,
                                    sex,dob,phone,line,room,districts,road,home_number,village,premission,password) 
                                    VALUES ('$personal', '$prefix_name','$fname','$lname','$sex','$dob',
                                    '$phone','$line','$room_inv','$districts',
                                    '$road','$home_number','$village','$premiss','$password')";
                mysqli_query($con, $sql);

                mysqli_query($con, " UPDATE `room` SET `room_status`='ไม่ว่าง' WHERE room.room = '$room_inv'");
            } else if ($room_inv == '') {

                $sql = "INSERT INTO user (personal,prefix_name,fname,lname,
                                    sex,dob,phone,line,districts,road,home_number,village,premission,password) 
                                    VALUES ('$personal', '$prefix_name','$fname','$lname','$sex','$dob',
                                    '$phone','$line','$districts',
                                    '$road','$home_number','$village','$premiss','$password')";
                mysqli_query($con, $sql);
            } else {
                echo "<script type='text/javascript'> alert('ล้มเหลว')</script>";
            }
            echo "<script type='text/javascript'> alert('สร้างผู้ใช้งานเรียบร้อย')</script>";
            echo "<script type='text/javascript'> window.location='userall.php'</script>";
        }
    }

    ?>
    <!-- END POPUP รับค่าสร้างผู้ใช้ -->

    <!-- CONTENT ลบที่เลือก -->
    <?php

    if (isset($_POST['delall'])) {
        if (empty($_POST['delall'])) {
            if ($_POST['chkl'] == true) {
                $checkbox1 = $_POST['chkl'];

                foreach ($checkbox1 as $id_check) {

                    $sql = "DELETE FROM user WHERE personal = '" . $id_check . "'";
                    $con->query($sql);
                }
                foreach ($checkbox1 as $id_log) {
                    $id_log = base64_decode($id_log);
                    $sqlie = "INSERT INTO event_log (personal,date,time,event) 
                                                VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " ลบผู้ใช้ รหัสบัตรประชาชน $id_log ')";
                    mysqli_query($con, $sqlie);
                    echo "<script type='text/javascript'> window.location='userall.php'</script>";
                }
            } else {
                echo "<script type='text/javascript'> alert('กรุณากดเลือกห้องที่ต้องการลบก่อน')</script>";
                echo "<script type='text/javascript'> window.location='userall.php'</script>";
            }
        }
    }
    ?>
    <!-- END CONTENT -->

    </div>
    <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <script src="assets/jquery.min.js"></script>
    <script src="assets/script.js"></script>
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
<script>
    function pass() {
        var pass1 = document.getElementById('pass1').value;
        var pass2 = document.getElementById('pass2').value;

        if (pass1 !== pass2) {
            document.getElementById("pass").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> รหัสผ่านไม่ตรงกัน</font>');
            return false;
        }
        if (pass1 === pass2) {
            document.getElementById("pass").innerHTML = ('<font color="green"><i class="fa fa-check-circle"></i> รหัสผ่านตรงกัน</font>');
        }
        if (pass1 == "" && pass2 == "") {
            document.getElementById("pass").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาใส่รหัสผ่าน</font>');
        }
        if (pass1.length < "8" && pass2.length < "8") {

            document.getElementById("pass_limit").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> มากกว่า 8 ตัวอักษร</font>');
        } else {
            document.getElementById("pass_limit").innerHTML = ('<font color="green"><i class="fa fa-check-circle"></i> ขนาดมากว่า 8 ตัว </font>');
        }
    }
</script>
<script>
  function ck_null(){
    var mylist = document.getElementById("myList").value;

    if(mylist == 'นาย'){
        document.getElementById("favourite").value = "ชาย";
    }

    if(mylist == 'นาง' || mylist == 'นางสาว'){
        document.getElementById("favourite").value = "หญิง";
    }
    
    if(mylist == null || mylist == ''){
      document.getElementById("pref-null").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบ คำนำหน้าชื่อ</font>');
    }else{
      document.getElementById("pref-null").innerHTML = ('');
    }

  }
  function ckh_null(){
    var home_number = document.getElementById('home_number').value;
    if(home_number == null || home_number == ''){
      document.getElementById("home_number-null").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบ บ้านเลขที่</font>');
    }else{
      document.getElementById("home_number-null").innerHTML = ('');
    }
  }
</script>