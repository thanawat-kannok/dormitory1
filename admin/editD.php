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

<?php if (isset($_GET['eid_note'])) {
    $id = $_GET['eid_note'];
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

        img {
            width: 120px;
            height: 220px;
        }

        .image_rep {
            width: 100px;
            height: 100px;
        }

        .modal-content {
            width: 80%;
            height: 80%;
        }
    }

    .font {
        font-size: 22px;


    }

    .resize {
        box-shadow: 2px 2px 20px black;
        border: 5px solid #E6E6FA;
        border-radius: 10px;
    }
</style>

<body onload="myFunction()">

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
                            <a href="editR.php?addDR"><i class="fa fa-pencil"></i> จัดการชนิดห้องพัก</a>
                        </li>
                        <ul class="nav" id="main-menu">
                            <li>
                                <a class="active-menu" href="editD.php?eid_note=<?php echo $id ?>" style="font-size:12px"><i class="fa fa-pencil"></i> แก้ไขชนิดห้องพัก</a>
                            </li>
                        </ul>
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
            <script>
                function chk_pic() {
                    let i = 1;

                    var file = document.upfile.fileupload.value;
                    console.log(i + file);
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
                        </div>
                    </div>
                    <!-- /. ROW  -->

                    <div class="row">
                        <div class="col-md-12">

                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card font">
                                        <h1><b>รหัสชนิดห้องพัก <?php echo $id ?></b></h1>
                                    </div>
                                </div>
                            </div>
                            <?php


                            $r_d = mysqli_query($con, "SELECT room_category.name as name_c, 
                                room_type.name as name_t,bed_type.name as name_b,
                                room_details.floor as floor, room_details.price as price, 
                                room_details.other as other,
                                room_details.minimum as minimum,
                                bed_type.id as id_b,
                                room_type.id as id_t,
                                bed_type.size as size,
                                room_category.id as id_c
                                FROM room_details
                                INNER JOIN bed_type on(bed_type.id = room_details.bed) 
                                INNER JOIN room_type on(room_type.id = room_details.type)
                                INNER JOIN room_category on(room_category.id = room_details.reservation)
                                WHERE room_details.id = $id");

                            $room_D = mysqli_fetch_array($r_d);
                            $floor = $room_D['floor'];
                            $name_t = $room_D['name_t'];
                            $t_id = $room_D['id_t'];
                            $bed_n = $room_D['name_b'];
                            $bed_size = $room_D['size'];
                            $bed_id = $room_D['id_b'];
                            $price = $room_D['price'];
                            $name_c = $room_D['name_c'];
                            $c_id = $room_D['id_c'];
                            $other = $room_D['other'];
                            $minimum = $room_D['minimum'];

                            $r_p = mysqli_query($con, "SELECT * FROM picture_details 
                                INNER JOIN room_picture on(picture_details.picture = room_picture.id) 
                                WHERE id_type = $id");
                            $room_P = mysqli_fetch_array($r_p);

                            $r_unit = mysqli_query($con, "SELECT * FROM `room_details`,`room` 
                            WHERE room.type = room_details.id and room.type = $id");

                            if($R_unit_update = mysqli_fetch_array($r_unit)){
                                $unit_per_W = $R_unit_update['unitPerWater'];
                                $unit_per_E = $R_unit_update['unitPerElectricity'];
                                
                            }
                                
                                $plase_unit = "ไม่มีข้อมูลในห้องพัก";
                            

                            $count = mysqli_query($con, "SELECT COUNT(picture) as count_p FROM `picture_details` WHERE id_type = $id");
                            $count_p = mysqli_fetch_array($count);
                            ?><br>
                            <table border="0" width="100%">
                                <tr>
                                    <th rowspan="12" width="40%">
                                        <img src='../assets/img/<?php echo $room_P['room_picture']; ?>' class='resize' width='350px' height='350px'>
                                    </th>
                                    </form>
                                </tr>
                                <form method="post">
                                    <tr>
                                        <td>ชนิดห้อง</td>
                                        <td colspan="2">
                                            <?php
                                            $ssqlii = "SELECT * FROM room_type ";
                                            $ttbe = mysqli_query($con, $ssqlii);

                                            echo "<select name='name_t' class='form-control'>";
                                            echo "<option value='$t_id' >$name_t *ปัจจุบัน</option>";
                                            while ($ttb = mysqli_fetch_array($ttbe)) {
                                                $tid = $ttb['id'];
                                                $tname = $ttb['name'];

                                                echo "<option value='$tid' >$tname</option>";
                                            }
                                            echo "</select>";
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ประเภทห้อง</td>
                                        <td colspan="2">
                                            <?php
                                            $ssql = "SELECT * FROM room_category ";
                                            $cbe = mysqli_query($con, $ssql);

                                            echo "<select name='name_c' class='form-control' id='conf' required onchange=\"return checkWoE(this)\">";

                                            echo "<option value='$c_id'>$name_c *ปัจจุบัน</option>";
                                            while ($cbed = mysqli_fetch_array($cbe)) {
                                                $cid = $cbed['id'];
                                                $cname = $cbed['name'];


                                                echo "<option value='$cid' >$cname </option>";
                                            }
                                            echo "</select>";
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ประเภทเตียง</td>
                                        <td colspan="2">
                                            <?php
                                            $ssql = "SELECT * FROM bed_type ORDER BY name ASC";
                                            $tbe = mysqli_query($con, $ssql);

                                            echo "<select name='tbed' class='form-control'>";
                                            echo "<option value='$bed_id'>$bed_n ขนาดเตียง $bed_size *ปัจจุบัน</option>";
                                            while ($tbed = mysqli_fetch_array($tbe)) {
                                                $bid = $tbed['id'];
                                                $bname = $tbed['name'];
                                                $tbede = $tbed['size'];


                                                echo "<option value='$bid' >$bname ขนาดเตียง $tbede </option>";
                                            }
                                            echo "</select>";
                                            ?>
                                        </td>
                                    </tr>
                                    

                                        <tr id="because" style="display:none;">

                                            <td>หน่วยน้ำ : </td>
                                            <td colspan="2">
                                                <lable class="form-group">

                                                    <input type="number" min="0" pattern="[0-9]+" class="form-control" value="<?php if($name_c == "รายเดือน"){echo $unit_per_W;}; ?>" name="unit_W" id="unitW" onkeyup="return checkWoE(this)" placeholder="<?php echo $plase_unit;?>">

                                                    <div id="unitW_danger"></div>

                                                </lable>
                                            </td>

                                        </tr>
                                        <tr id="because1" style="display:none;">

                                            <td>หน่วยไฟ : </td>
                                            <td colspan="2">
                                                <lable class="form-group">

                                                    <input type="number" min="0" pattern="[0-9]+" class="form-control" value="<?php if($name_c == "รายเดือน"){echo $unit_per_E;}; ?>" name="unit_E" id="unitE" onkeyup="return checkWoE(this)" placeholder="<?php echo $plase_unit;?>">

                                                    <div id="unitE_danger"></div>
                                                </lable>
                                            </td>

                                        </tr>
                                    
                                    <script>
                                        function myFunction() {
                                            var option = document.getElementById('conf').value;
                                            if (option == '2') {
                                                $("#because").show();
                                                $("#because1").show();
                                                if (unitW == '' || unitW == null) {
                                                    document.getElementById("unitW_danger").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบหน่วยค่านํ้า</font>');
                                                } else {
                                                    document.getElementById("unitW_danger").innerHTML = ('');
                                                }

                                                if (unitE == '' || unitE == null) {
                                                    document.getElementById("unitE_danger").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบหน่วยค่าไฟ</font>');
                                                } else {
                                                    document.getElementById("unitE_danger").innerHTML = ('');
                                                }
                                            } else {
                                                $("#because").hide();
                                                $("#because1").hide();
                                                document.getElementById("unitW_danger").innerHTML = ('');
                                                document.getElementById("unitE_danger").innerHTML = ('');
                                            }
                                        }
                                    </script>
                                    <script>
                                        function checkWoE() {
                                            var option = document.getElementById('conf').value;
                                            var unitW = document.getElementById('unitW').value;
                                            var unitE = document.getElementById('unitE').value;
                                            if (option == '' || option == null) {
                                                alert('Please select')
                                            } else {
                                                if (option == '2') {
                                                    $("#because").show();
                                                    $("#because1").show();
                                                    if (unitW == '' || unitW == null) {
                                                        document.getElementById("unitW_danger").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบหน่วยค่านํ้า</font>');
                                                    } else {
                                                        document.getElementById("unitW_danger").innerHTML = ('');
                                                    }

                                                    if (unitE == '' || unitE == null) {
                                                        document.getElementById("unitE_danger").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบหน่วยค่าไฟ</font>');
                                                    } else {
                                                        document.getElementById("unitE_danger").innerHTML = ('');
                                                    }
                                                } else {
                                                    $("#because").hide();
                                                    $("#because1").hide();
                                                    document.getElementById("unitW_danger").innerHTML = ('');
                                                    document.getElementById("unitE_danger").innerHTML = ('');
                                                }
                                            }
                                        }
                                    </script>
                                    <tr>
                                        <td>ชั้น</td>
                                        <td colspan="2"><input type="number" name="floor" class="form-control" value="<?php echo $floor ?>" min="1"></td>
                                    </tr>
                                    <tr>
                                        <td>ราคาห้อง</td>
                                        <td colspan="2"><input type="number" name="price" class="form-control" value="<?php echo $price ?>" min="1"></td>
                                    </tr>
                                    <tr>
                                        <td>ประกันห้อง</td>
                                        <td colspan="2"><input type="number" name="other" class="form-control" value="<?php echo $other ?>" min="1"></td>
                                    </tr>
                                    <tr>
                                        <td>เงินขั้นต่ำในการจอง</td>
                                        <td colspan="2"><input type="number" name="min" class="form-control" value="<?php echo $minimum ?>" min="1"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2"><button class="btn btn-primary" name="save_data" onclick="return confirm('ยืนยันการบันทึกข้อมูล')"><i class="fa fa-plus-circle"></i> บันทึกการเปลี่ยนแปลง</button></td>
                                    </tr>
                            </table>
                            <div class="card">
                                <div class="right">


                                </div>
                                <div class="right" style="margin:20px;">

                                </div>
                            </div>
                        </div>
                        </form>
                        <table class="table table-striped table-" border="1" width="100%">
                            <tr>
                                <th width="5%">ลำดับ</th>
                                <th>รูป</th>
                                <th>ลบ</th>
                                <!-- <th>เลือกนามสกุลไฟล์ jpg และ png เท่านั้น</th>
                                <th>แก้ไข</th> -->
                            </tr>

                            <?php
                            $r_G = mysqli_query($con, "SELECT * FROM picture_details 
                                    INNER JOIN room_picture on(picture_details.picture = room_picture.id) 
                                    WHERE id_type = $id ORDER BY picture ASC");
                            $i = 1;
                            echo "<from method='post'>";
                            while ($room_G = mysqli_fetch_array($r_G)) {
                                // echo '<form method="post" enctype="multipart/form-data" name="upfile'.$i.'" id="upfile'.$i.'" onSubmit="return chk_pic()" >';
                                echo "<tr>";

                                echo "<td>$i</td>";

                                echo "<td>";
                                echo "<center>";
                                echo '<div style="cursor:pointer"><img class="image_rep" id=' . $i . ' src="../assets/img/' . $room_G['room_picture'] . '"  width="100px" height="100px">';
                                echo '<div id="myModal" class="modal" style="backdrop-filter:blur(10px);background-color:rgba(255,255,255,0.4);" >';
                                echo '<center><img class="modal-content" id="img01" style="margin:120px auto" width="38%" ></center>';
                                echo '</div>';
                                echo "</center>";
                                echo "</td>";

                                echo "<td>";
                                if ($room_G['room_picture'] == 'default.png' and $count_p['count_p'] <= '1') {
                                    echo '<button class="btn btn-danger" style="border:1px solid black;" disabled> <i class="fa fa-times-circle" ></i> ลบ</button>';
                                } else {
                                    echo '<a href=delR.php?delD_image=' . $id . '/' . $room_G['id'] . '/' . $room_G['room_picture'] . ' onclick="return confirm(\'คุณต้องการลบรูป [' . $i . '] ใช่หรือไม่\')" 
                                                <button class="btn btn-danger" style="border:1px solid black;"> <i class="fa fa-times-circle" ></i> ลบ</button></a>';
                                }

                                echo "</td>";

                                echo "</tr>";
                                echo "</form>";
                                $i++;
                            }

                            ?>

                            <tr>

                                <form action="editD.php?eid_note=<?php echo $id; ?>" method="post" enctype="multipart/form-data" name="upfile" id="upfile" onSubmit="return chk_pic()">
                                    <td colspan="2"><input class="form-control" type="file" name="fileupload[]" accept="image/png, image/gif, image/jpeg" multiple required></td>
                                    <td colspan="2"><button class="btn btn-success form-control" name="addphoto" onclick="return confirm('ยืนยันการเพิ่มรูปภาพ?')">เพิ่ม</button></td>
                                </form>

                            </tr>
                        </table>
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

    <!-- END EDIT ROOM -->

    <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
<?php endif; ?>

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
<script>
    // Get the modal

    var modal = document.getElementById('myModal');

    // Get the image and insert it inside the modal - use its "alt" text as a caption

    for (let i = 1; i <= 1000000000;) {

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

<?php
if (isset($_POST['addphoto'])) {

    isset($_FILES['fileupload']['tmp_name']) ? $image_tmp_name = $_FILES['fileupload']['tmp_name'] : $image_tmp_name = "";
    isset($_FILES['fileupload']['name']) ? $image_name = $_FILES['fileupload']['name'] : $image_name = "";

    date_default_timezone_set('Asia/Bangkok');
    $date_in = date("Ymd");
    //ฟังก์ชั่นสุ่มตัวเลข
    $numrand = (mt_rand());

    if (!empty($image_tmp_name) && !empty($image_name)) {

        for ($i = 0; $i < count($image_tmp_name); $i++) {

            $path = "../assets/img/";
            $type = strrchr($image_name[$i], ".");

            $newname = $numrand . '_' . $date_in . '_' . $i . $type;
            $newname_saveflie = $path . $numrand . '_' . $date_in . '_' . $i . $type;
            $numrand + '20';
            $date_in + '30';
            // echo $newname;
            //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
            if(move_uploaded_file($image_tmp_name[$i], $newname_saveflie)){

            mysqli_query($con, "INSERT INTO `room_picture`(`room_picture`) VALUES ('$newname')");
            $picid = mysqli_insert_id($con);

            mysqli_query($con, "INSERT INTO `picture_details`( `id_type`, `picture`) VALUES ('$id','$picid')");
            } 
        }
    } else {
        echo "<script type='text/javascript'> alert('กรุณาใส่รูปภาพ')</script>";
    }
    echo "<script type='text/javascript'> alert('เพิ่มรูปภาพ เรียบร้อย')</script>";
    echo "<script type='text/javascript'> window.location='editD.php?eid_note=$id'</script>";
}
?>
<?php
if (isset($_POST['save_data'])) {

    echo $id_type = $_POST['name_t'];
    echo $id_category = $_POST['name_c'];
    echo $tbed = $_POST['tbed'];
    echo $floor = $_POST['floor'];
    echo $price = $_POST['price'];
    echo $other = $_POST['other'];
    echo $min = $_POST['min'];
    if($id_category == '2'){
        $unit_W = $_POST['unit_W'];
        $unit_E = $_POST['unit_E'];
    }else{
        $group = mysqli_query($con,"SELECT * FROM `room` GROUP BY `unitPerWater` and `unitPerElectricity`");
        $group_unit = mysqli_fetch_array($group);
        $unit_day_W = $group_unit['unitPerWater'];
        $unit_day_E = $group_unit['unitPerElectricity'];
    }
    

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

    echo $name_th_price = Convert($price);
    echo $name_th_other = Convert($other);

    $update_d = "UPDATE `room_details` SET `floor`='$floor',
    `type`='$id_type',`bed`='$tbed',`price`='$price',
    `name_th_price`='$name_th_price',`other`='$other',
    `name_th_other`='$name_th_other',`reservation`='$id_category',
    `minimum`='$min' WHERE id = '$id'";

    if($id_category == '2'){
        mysqli_query($con,"UPDATE `room` SET `unitPerWater`='$unit_W',`unitPerElectricity`='$unit_E' WHERE type = $id");
    }else{
        mysqli_query($con,"UPDATE `room` SET `unitPerWater`='$unit_day_W',`unitPerElectricity`='$unit_day_E' WHERE type = $id");
    }
    if (mysqli_query($con, $update_d)) {

        $personal = $_SESSION['personal_admin'];

        $event = "INSERT INTO event_log (personal,date,time,event) 
        VALUES ('$personal','$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " แก้ไขชนิดห้อง รหัส $id ')";
        mysqli_query($con, $event);

        echo "<script type='text/javascript'> alert('แก้ไขรายละเอียดเรียบร้อย')</script>";
        echo "<script type='text/javascript'> window.location='editD.php?eid_note=$id'</script>";
    } else {
        echo "<script type='text/javascript'> alert('การแก้ไขผิดพลาด')</script>";
    }
}
?>