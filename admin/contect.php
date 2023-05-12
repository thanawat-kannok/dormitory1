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
<style>
    .outerDivFull {
        margin: 50px;
    }

    .switchToggle input[type=checkbox] {
        height: 0;
        width: 0;
        visibility: hidden;
        position: absolute;
    }

    .switchToggle label {
        cursor: pointer;
        text-indent: -9999px;
        width: 70px;
        max-width: 70px;
        height: 30px;
        background: #d1d1d1;
        display: block;
        border-radius: 100px;
        position: relative;
    }

    .switchToggle label:after {
        content: '';
        position: absolute;
        top: 2px;
        left: 2px;
        width: 26px;
        height: 26px;
        background: #fff;
        border-radius: 90px;
        transition: 0.3s;
    }

    .switchToggle input:checked+label,
    .switchToggle input:checked+input+label {
        background: #3e98d3;
    }

    .switchToggle input+label:before,
    .switchToggle input+input+label:before {
        content: 'No';
        position: absolute;
        top: 5px;
        left: 35px;
        width: 26px;
        height: 26px;
        border-radius: 90px;
        transition: 0.3s;
        text-indent: 0;
        color: #fff;
    }

    .switchToggle input:checked+label:before,
    .switchToggle input:checked+input+label:before {
        content: 'Yes';
        position: absolute;
        top: 5px;
        left: 10px;
        width: 26px;
        height: 26px;
        border-radius: 90px;
        transition: 0.3s;
        text-indent: 0;
        color: #fff;
    }

    .switchToggle input:checked+label:after,
    .switchToggle input:checked+input+label:after {
        left: calc(100% - 2px);
        transform: translateX(-100%);
    }

    .switchToggle label:active:after {
        width: 60px;
    }

    .toggle-switchArea {
        margin: 10px 0 10px 0;
    }
</style>

<!------ Include the above in your HEAD tag ---------->

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
<?php
$room_B = mysqli_fetch_array($category_A);
$room_A = mysqli_fetch_array($category_B);
?>
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
        width: 120px;
        height: auto;
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

    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: black;
        float: right;
        font-size: 28px;
        font-weight: bold;

    }

    .close:hover,
    .close:focus {
        color: red;
        text-decoration: none;
        cursor: pointer;
    }

    .delete {
        background-color: red;
        /* Green */
        border: 1px solid black;
        color: white;
        text-align: center;
        text-decoration: none;
        font-size: 18px;
        cursor: pointer;
        float: right;
    }

    .delete:hover {
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
                <a class="navbar-brand" href="home.php" style="width:300px"> <?php echo $hd['header'] ?></lable>
                    <?php //if ($room_A['status'] == '1'){echo ' <lable style="color:green;background-color:white;border-radius:10px;margin:0px 10px">ห้องว่าง</lable>';}
                    // else{echo ' <lable style="color:red;background-color:white;border-radius:10px;margin:0px 10px">ห้องเต็ม</lable>';}
                    ?>
                </a>
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
                        <a href="price.php"><i class="fa fa-address-book"></i> ประวัติการชำระเงิน รายเดือน</a>
                    </li>
                    <li>
                        <div style="background-color:#FF9900;color:black;font-size:20px;" align="center">จัดการอื่นๆ</div>
                    </li>
                    <li>
                        <a href="profit.php"><i class="fa fa-line-chart"></i> รายรับ</a>
                    </li>
                    <li>
                        <a class="active-menu" href="contect.php"><i class="fa fa-edit"></i> การจัดการเว็บไซน์</a>
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
                            จัดการหน้าเว็บไซน์
                        </h1>
                    </div>
            
                        <table border="1" width="100%" style="text-align:center;">
                        <form method="post" name="form02" id="form02">
                            <tr>
                                <td>
                                    <lable>ชื่อหอพัก</lable>
                                </td>
                                <td>
                                    <lable>ที่อยู่หอพัก</lable>
                                </td>
                                <td>
                                    <lable>เบอร์โทรติดต่อ</lable>
                                </td>
                                <td>
                                    <lable>แก้ไข</lable>
                                </td>
                            </tr>
                            <tr>
                                <?php
                                echo ' 
                                <td><input class="form-control ttd" name="header" value="' . $hd['header'] . '"></td>
                                <td><input class="form-control ttd" name="address"  value="' . $hd['address'] . '"></td>
                                <td><input class="form-control ttd" name="phone"  value="' . $hd['phone_lessor'] . '"></td>';
                                ?>
                                <td><button class='btn btn-edit' onclick="return confirm('ยืนยันการแก้ไข ใช่หรือไม่?')" name="contect"><i class='fa fa-pencil'></i> แก้ไข</button></td>
                            </tr>

                            <tr>
                                <td width="70%" colspan="3">รายการ</td>
                                <td>ปุ่มควบคุม</td>
                            </tr>
                            <tr>
                                <td colspan="3">เปิด/ปิด การจองห้องพัก รายเดือน</td>
                                <td style="padding:10px">
                                    <center>
                                        <div class="switchToggle">
                                            <input type="checkbox" id="switch1" name="status1" 
                                            <?php if ($room_A['status'] == '1') {
                                                echo 'checked="checked"';
                                            } ?>>
                                            <input type='hidden' id='check_status1' ">
                                    <label for="switch1">Toggle</label>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">เปิด/ปิด การจองห้องพัก รายวัน</td>
                                <td style="padding:10px">
                                    <center>
                                        <div class="switchToggle">
                                            <input type="checkbox" id="switch2" name="status2" 
                                            <?php if ($room_B['status'] == '1') {
                                                echo 'checked="checked"';
                                            } ?>>
                                            <input type='hidden' id='check_status2' ">
                                    <label for="switch2">Toggle</label>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                            </form>

                            
                            <tr>
                                <form method="post">
                                    <td >กำหนดวันที่<font color="red">ปิด</font>รับการจองห้อง</td>
                                    <td >วันที่ <input type="date" min="<?php echo $date?>" name="date_clost" required ></td>
                                    <td ><input name="clost_reservation" type="submit" value="บันทึก" onclick="return confirm('ยืนยันการ ปิดการจองห้องตามที่ระบุ ใช่หรือไม่?')"></input></td>
                                    <td>
                                </form>
                                <button id="myBtn1" class="form-control btn-primary"><i class="fa fa-calendar-times-o"></i> ดูข้อมูลวันที่<font color="red"><strong> ปิด </strong></font>การจอง</button>
                                    <div id="myModal1" class="modal">
                                        <!-- Modal content -->
                                        <div class="modal-content">
                                            <span class="close1" style="float:right">&times;</span>
                                            
                                                <?php 
                                                    $sate = mysqli_query($con,"SELECT * FROM `clost_reservation` ORDER BY date_clost ASC");
                                                    echo "วันที่ปัจจุบัน : $d_now-$m_now-$y_ks";
                                                    while($date_clost_list = mysqli_fetch_array($sate)){
                                                        list($y_ex,$m_ex,$d_ex) = explode("-",$date_clost_list['date_clost']);
                                                        $y_ex = $y_ex+543;
                                                        $date_clost_list_ex = "$d_ex-$m_ex-$y_ex";
                                                       if($date_clost_list['date_clost'] >= $date){
                                                        echo '<form method="post">';
                                                        echo "<input hidden name='cancel_date_clost' value='".$date_clost_list['date_clost']."'>";
                                                        echo $date_clost_list_ex;
                                                        echo '    <input name="cancel" type="submit" value="ยกเลิก" onclick="return confirm(\'ยืนยันการ ยกเลิกปิดการจองวันที่ '.$date_clost_list_ex.' ใช่หรือไม่?\')"></input>';
                                                        echo "<br>";
                                                        echo '</form>';
                                                       }
                                                    }
                                                   
                                                ?>
                                            
                                        </div>    
                                    </div>
                                </td>
                            </tr>
                           
                        </table>
                        <hr>
                </div>
                
                <button id="myBtn" class="form-control btn-edit"><i class="fa fa-cog from-control"></i> แก้ไขกฏห้องพัก รายวัน/รายเดือน</button>
                <br>
                <div class="form-group"></div>
                 
                <!-- The Modal -->
                <div id="myModal" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close">&times;</span>

                        <form method="post" name="frmMain">
                            <dvi>กฏห้องพักรายเดือน</dvi>
                            <table width="100%">


                                <?php
                                $sql = "SELECT * FROM `rule` WHERE type = 2";
                                $sqlA = mysqli_query($con, $sql);
                                $i = 1;
                                while ($row = mysqli_fetch_array($sqlA)) {
                                    $data = $row['data'];
                                    $rule_id = $row['id'];
                                    echo "<tr>";
                                    echo "<td>" . $i . ".</td>";
                                    echo '<td><textarea name="rule[ ]"  style="width:100%" >' . $data . '</textarea></td>';
                                    echo '<input type="hidden"  name="data[ ]" value="' . $rule_id . '">';
                                    echo '<td><button name="delete[ ]" value="' . $rule_id . '" class="delete" onclick="return confirm(\'คุณต้องการลบกฏรายเดือนข้อ ' . $i . ' ใช่หรือไม่?\')">ลบ</button></td>';
                                    echo "</tr>";
                                    $i++;
                                }

                                ?>

                            </table>

                            <table width="100%" border="1" id="tbExp">
                                <tr>
                                    <td>
                                        <div align="center">เพิ่มกฏ</div>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="hdnMaxLine" value="0">
                            <input name="btnAdd" type="button" id="btnAdd" value="+" onClick="CreateNewRow();">
                            <input name="btnDel" type="button" id="btnDel" value="-" onClick="RemoveRow();">
                            <button class="save" name="save_rule" onclick="return confirm('ยืนยันการเพิ่มกฏรายเดือนใหม่ใช่หรือไม่?')"><i class="fa fa-plus-square"></i> บันทึก กฏ ใหม่รายเดือน</button>
                            <br><br>
                            <dvi>กฏห้องพักรายวัน</dvi>
                            <table width="100%">


                                <?php
                                $sql = "SELECT * FROM `rule` WHERE type = 1";
                                $sqlB = mysqli_query($con, $sql);
                                $j = 1;
                                while ($row2 = mysqli_fetch_array($sqlB)) {
                                    $data2 = $row2['data'];
                                    $rule_id2 = $row2['id'];
                                    echo "<tr>";
                                    echo "<td>" . $j . ".</td>";
                                    echo '<td><textarea name="rule2[ ]"  style="width:100%" >' . $data2 . '</textarea></td>';
                                    echo '<input type="hidden"  name="data2[ ]" value="' . $rule_id2 . '">';
                                    echo '<td><button name="delete2[ ]" value="' . $rule_id2 . '" class="delete" onclick="return confirm(\'คุณต้องการลบกฏรายวันข้อ ' . $i . ' ใช่หรือไม่?\')">ลบ</button></td>';
                                    echo "</tr>";
                                    $j++;
                                }

                                ?>

                            </table>

                            <table width="100%" border="1" id="tbExp2">
                                <tr>
                                    <td>
                                        <div align="center">เพิ่มกฏ</div>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="hdnMaxLine2" value="0">
                            <input name="btnAdd2" type="button" id="btnAdd2" value="+" onClick="CreateNewRow2();">
                            <input name="btnDel2" type="button" id="btnDel2" value="-" onClick="RemoveRow2();">
                            <button class="save" name="save_rule2" onclick="return confirm('ยืนยันการเพิ่มกฏรายวันใหม่ใช่หรือไม่?')"><i class="fa fa-plus-square"></i> บันทึก กฏ ใหม่รายวัน</button>
                            <br>
                            <button style="margin-top:30px;" class="hideWhenPrint edit" name="save_lease" onclick="return confirm('คุณต้องการบันทึกการเปลี่ยนแปลง ใช่หรือไม่?')"><i class="fa fa-upload"></i> บันทึกการแก้ไข</button></a>
                        </form>

                    </div>
                                
                </div>
                <script>
                    // Get the modal
                    var modal = document.getElementById("myModal");
                    // Get the button that opens the modal
                    var btn = document.getElementById("myBtn");
                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close")[0];
                    // When the user clicks the button, open the modal
                    btn.onclick = function() {
                        modal.style.display = "block";
                    }
                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function() {
                        modal.style.display = "none";
                    }
                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                </script>
                <script>
                    // Get the modal
                    var modal1 = document.getElementById("myModal1");
                    // Get the button that opens the modal
                    var btn1 = document.getElementById("myBtn1");
                    // Get the <span> element that closes the modal
                    var span1 = document.getElementsByClassName("close1")[0];
                    // When the user clicks the button, open the modal
                    btn1.onclick = function() {
                        modal1.style.display = "block";
                    }
                    // When the user clicks on <span> (x), close the modal
                    span1.onclick = function() {
                        modal1.style.display = "none";
                    }
                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                        if (event.target == modal1) {
                            modal1.style.display = "none";
                        }
                    }
                </script>
                <script language="javascript">
                    function CreateNewRow() {
                        var intLine = parseInt(document.frmMain.hdnMaxLine.value);
                        intLine++;
                        var theTable = document.all.tbExp
                        var newRow = theTable.insertRow(theTable.rows.length)
                        newRow.id = newRow.uniqueID

                        var item1 = 1
                        var newCell

                        //*** Column 1 ***//
                        newCell = newRow.insertCell(0)
                        newCell.id = newCell.uniqueID
                        newCell.setAttribute("className", "css-name");
                        newCell.innerHTML = "<center><textarea  style=\"width:100%\" name=\"Column[ ]\" required></textarea></center>"

                        document.frmMain.hdnMaxLine.value = intLine;

                    }

                    function RemoveRow() {
                        intLine = parseInt(document.frmMain.hdnMaxLine.value);
                        if (parseInt(intLine) > 0) {
                            theTable = (document.all) ? document.all.tbExp :
                                document.getElementById("tbExp")
                            theTableBody = theTable.tBodies[0];
                            theTableBody.deleteRow(intLine);
                            intLine--;
                            document.frmMain.hdnMaxLine.value = intLine;
                        }
                    }

                    function CreateNewRow2() {
                        var intLine2 = parseInt(document.frmMain.hdnMaxLine2.value);
                        intLine2++;

                        var theTable2 = document.all.tbExp2
                        var newRow2 = theTable2.insertRow(theTable2.rows.length)
                        newRow2.id = newRow2.uniqueID

                        var item2 = 1
                        var newCell2

                        //*** Column 2 ***//
                        newCell2 = newRow2.insertCell(0)
                        newCell2.id = newCell2.uniqueID
                        newCell2.setAttribute("className", "css-name");
                        newCell2.innerHTML = "<center><textarea  style=\"width:100%\" name=\"Column2[ ]\" required></textarea></center>"

                        document.frmMain.hdnMaxLine2.value = intLine2;
                    }

                    function RemoveRow2() {
                        intLine2 = parseInt(document.frmMain.hdnMaxLine2.value);
                        if (parseInt(intLine2) > 0) {
                            theTable2 = (document.all) ? document.all.tbExp2 :
                                document.getElementById("tbExp2")
                            theTableBody2 = theTable2.tBodies[0];
                            theTableBody2.deleteRow(intLine2);
                            intLine2--;
                            document.frmMain.hdnMaxLine2.value = intLine2;
                        }
                    }
                </script>
            </div>


</body>

</html>
<!-- jQuery Js -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- Bootstrap Js -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Metis Menu Js -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- DATA TABLE SCRIPTS -->
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Js -->
<script src="assets/js/custom-scripts.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>   
<script type="text/javascript">
    $(function() {
        // ถ้า checkbox ที่มีชื่อขึ้นต้นด้วย status ถูกคลิก
        $(":checkbox[name^='status1']").on("click", function() {

            // สร้างตัวแปรเก็บค่าว่า checkbox นั้นถูกติ้กเลือกหรือ ต้ิกออก ถ้าต้้กออกค่าเป็น false
            var iCheck = $(this).prop("checked");

            $.ajax({
                type: "POST",
                url: "contect.php",
                data: {
                    checkS: iCheck
                },
                success: function(msg) {
                    console.log(data['iCheck']);
                },
                error: function() {
                    alert("failure");
                }
            });

        });



    });

    $(function() {
        // ถ้า checkbox ที่มีชื่อขึ้นต้นด้วย status ถูกคลิก
        $(":checkbox[name^='status2']").on("click", function() {

            // สร้างตัวแปรเก็บค่าว่า checkbox นั้นถูกติ้กเลือกหรือ ต้ิกออก ถ้าต้้กออกค่าเป็น false
            var iCheck1 = $(this).prop("checked");

            $.ajax({
                type: "POST",
                url: "contect.php",
                data: {
                    checkS1: iCheck1
                },
                success: function(msg) {
                    console.log(data['iCheck1']);
                },
                error: function() {
                    alert("failure");
                }
            });

        });


    });
</script>
<?php
if (isset($_POST['save_lease'])) {

    $rule = $_POST['rule'];
    $rule2 = $_POST['rule2'];

    $data = array($_POST['data']);
    $data2 = array($_POST['data2']);

    $count = sizeof($data[0]);
    $count2 = sizeof($data2[0]);
    echo $count . '<br>';
    echo $count2 . '<br>';

    foreach ($rule as $i => $rule_inv) {
        if (!empty($rule_inv)) {
            $data_inv = $_POST['data'][$i];

            echo $data_inv . '.' . $rule_inv . "<br>";
            echo "<br>";
            mysqli_query($con, "UPDATE `rule` SET `data`='$rule_inv' WHERE id = $data_inv");
        }
    }

    foreach ($rule2 as $j => $rule_inv2) {
        if (!empty($rule_inv)) {
            $data_inv2 = $_POST['data2'][$j];

            echo $data_inv2 . '.' . $rule_inv2 . "<br>";
            echo "<br>";
            mysqli_query($con, "UPDATE `rule` SET `data`='$rule_inv2' WHERE id = $data_inv2");
        }
    }
}
?>
<?php
if (isset($_POST['delete'])) {

    $del_rule = $_POST['delete'];

    foreach ($del_rule  as $sum) {

        echo $sum;
        $sql = "DELETE FROM `rule` WHERE id = '$sum'";
        $con->query($sql);

        $sqlie = "INSERT INTO event_log (personal,date,time,event) 
            VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " ลบกฏรายเดือนข้อที่ $sum ')";
        mysqli_query($con, $sqlie);
    }
    echo "<script type='text/javascript'> window.location='contect.php'</script>";
}
if (isset($_POST['delete2'])) {

    $del_rule2 = $_POST['delete2'];

    foreach ($del_rule2  as $sum2) {

        echo $sum2;
        $sql = "DELETE FROM `rule` WHERE id = '$sum2'";
        $con->query($sql);

        $sqlie = "INSERT INTO event_log (personal,date,time,event) 
            VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " ลบกฏรายวันข้อที่ $sum2 ')";
        mysqli_query($con, $sqlie);
    }
    echo "<script type='text/javascript'> window.location='contect.php'</script>";
}
?>
<?php
if (isset($_POST['save_rule'])) {
    if (!empty($_POST['Column'])) {
        $rule_add = $_POST['Column'];
        foreach ($rule_add  as $sum) {


            echo $sum;
            $sqli = "INSERT INTO `rule`(`type`, `data`) VALUES ('2','$sum')";
            mysqli_query($con, $sqli);
        }
        foreach ($rule_add as $sum) {

            $sqlie = "INSERT INTO event_log (personal,date,time,event) 
             VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " เพิ่มกฏรายเดือน $sum ')";
            mysqli_query($con, $sqlie);
            echo "<script type='text/javascript'> window.location='contect.php'</script>";
        }
    } else {

        echo "<script type='text/javascript'> alert('กรุณาเพิ่มกฏก่อนกดบันทึก')</script>";
    }
}

if (isset($_POST['save_rule2'])) {
    if (!empty($_POST['Column2'])) {
        $rule_add = $_POST['Column2'];
        foreach ($rule_add  as $sum) {


            echo $sum;
            $sqli = "INSERT INTO `rule`(`type`, `data`) VALUES ('1','$sum')";
            mysqli_query($con, $sqli);
        }
        foreach ($rule_add as $sum) {

            $sqlie = "INSERT INTO event_log (personal,date,time,event) 
             VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " เพิ่มกฏรายวัน $sum ')";
            mysqli_query($con, $sqlie);
            echo "<script type='text/javascript'> window.location='contect.php'</script>";
        }
    } else {

        echo "<script type='text/javascript'> alert('กรุณาเพิ่มกฏก่อนกดบันทึก')</script>";
    }
}
?>
<?php
if (isset($_POST['checkS'])) {
    $status = $_POST['checkS'];

    switch ($status) {
        case 'false':
            mysqli_query($con, "UPDATE `room_category` 
                    SET `status`='0' WHERE id = '2'");
            break;

        case 'true':
            mysqli_query($con, "UPDATE `room_category` 
                    SET `status`='1' WHERE id = '2'");
            break;
    }
};

if (isset($_POST['checkS1'])) {
    $status1 = $_POST['checkS1'];
    switch ($status1) {
        case 'false':
            mysqli_query($con, "UPDATE `room_category` 
                    SET `status`='0' WHERE id = '1'");
            break;

        case 'true':
            mysqli_query($con, "UPDATE `room_category` 
                    SET `status`='1' WHERE id = '1'");
            break;
    }
};
?>
<?php if (isset($_POST['contect'])) : ?>

    <?php
    $herader = $_POST['header'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    mysqli_query($con, "UPDATE `paper_details` SET 
    `header`='$herader',
    `address`='$address',
    `phone_lessor`='$phone' ");

    $sqlie = "INSERT INTO event_log (personal,date,time,event) 
    VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " แก้ไขข้อมูล ชื่อหอพัก ที่อยู่ และเบอร์โทรศัพน์ ')";
    mysqli_query($con, $sqlie);

    echo "<script type='text/javascript'> alert('แก้ไขข้อมูล เรียบร้อย')</script>";
    echo "<script type='text/javascript'> window.location='contect.php'</script>";
    ?>
<?php endif; ?>
<?php
    if(isset($_POST['clost_reservation'])){
        $date_clost = $_POST['date_clost'];

        $sate = mysqli_query($con,"SELECT * FROM `clost_reservation` WHERE '$date_clost' = date_clost");
        $date_clost_list = mysqli_fetch_assoc($sate);

            if($date_clost_list['date_clost'] === $date_clost){
                echo "<script type='text/javascript'> alert('มีวันที่ $date_clost ในการปิดจองห้องแล้ว')</script>";
            }else{
                if($date_clost != null){
                    mysqli_query($con,"INSERT INTO `clost_reservation`(`date_clost`) VALUES ('$date_clost')");
                    echo "<script type='text/javascript'> alert('ปิดการจองวันที่ $date_clost เรียบร้อย')</script>";
                    echo "<script type='text/javascript'> window.location='contect.php'</script>";

                    $sqlie = "INSERT INTO event_log (personal,date,time,event) 
                    VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " ปิดการจองวันที่ $date_clost ')";
                    mysqli_query($con, $sqlie);
                }
            }
        
    }
?>
<?php
    if(isset($_POST['cancel'])){
        echo $cancel_date_clost = $_POST['cancel_date_clost'];
        mysqli_query($con,"DELETE FROM `clost_reservation` WHERE `date_clost` = '$cancel_date_clost'");
        echo "<script type='text/javascript'> window.location='contect.php'</script>";
        $sqlie = "INSERT INTO event_log (personal,date,time,event) 
                    VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " ยกเลิก ปิดการจองวันที่ $cancel_date_clost ')";
                    mysqli_query($con, $sqlie);
    }
?>
