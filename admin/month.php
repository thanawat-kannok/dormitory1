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
<?php
$Header = mysqli_query($con, "SELECT * FROM paper_details ");
$hd = mysqli_fetch_array($Header);
?>


<?php if (isset($_POST['print_all'])) : ?>
    <?php if (empty($_POST['print_all'])) : ?>

        <?php if ($_POST['chkl'] == true) : ?>
            
            <?php
            $checkbox1 = $_POST['chkl'];
            $i = 0;

            $ccv = mysqli_fetch_array($last_date_unit);

            list($y, $m, $d) = explode("-", $ccv['date_check']);

            $m = $m - 1;
            // $m=(int)date('m')-1;
            // $y=(int)date('Y');
            // $d=(int)date('d');
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

            $row = mysqli_fetch_array($paper_all);
            $header = $row['header'];
            $address = $row['address'];
            $phone_own = $row['phone_lessor'];

            $e = 1;
            ?>

            <?php foreach ($checkbox1 as $id_check) : ?>
                <html>
                <head>
                    <meta charset="utf-8">
                    <link rel="stylesheet" href="../css/image.css">
                    <style>
                        /* reset */

                        *[contenteditable] {
                            border-radius: 0.25em;
                            min-width: 1em;
                            outline: 0;
                        }

                        *[contenteditable] {
                            cursor: pointer;
                        }

                        *[contenteditable]:hover,
                        *[contenteditable]:focus,
                        td:hover *[contenteditable],
                        td:focus *[contenteditable],
                        img.hover {
                            background: #DEF;
                            box-shadow: 0 0 1em 0.5em #DEF;
                        }

                        span[contenteditable] {
                            display: inline-block;
                        }


                        table {
                            font-size: 75%;
                            width: 100%;
                        }

                        table {
                            border-collapse: separate;
                            border-spacing: 2px;
                        }

                        th,
                        td {
                            border-width: 1px;
                            padding: 0.5em;
                            position: relative;
                            text-align: left;
                        }

                        th,
                        td {
                            border-radius: 0.25em;
                            border-style: solid;
                        }

                        th {
                            background: #EEE;
                            border-color: #BBB;
                        }

                        td {
                            border-color: #DDD;
                        }

                        /* page */

                        html {
                            font: 16px/1 'Open Sans', sans-serif;
                            overflow: auto;
                            padding: 0.5in;
                        }

                        html {
                            background: #999;
                            cursor: default;
                        }

                        body {
                            box-sizing: border-box;
                            height: auto;
                            margin: 0 auto;
                            overflow: hidden;
                            padding: 0.2in;
                            width: 8.5in;
                        }

                        body {
                            background: #FFF;
                            border-radius: 1px;
                            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
                        }

                        /* header */





                        /* article */

                        article,
                        article address,
                        table.meta,
                        table.inventory {
                            margin: 0 0 3em;
                        }

                        article:after {
                            clear: both;
                            content: "";
                            display: table;
                        }

                        article h1 {
                            clip: rect(0 0 0 0);
                            position: absolute;
                        }

                        article address {
                            float: left;
                            font-size: 125%;
                            font-weight: bold;
                        }

                        /* table meta & balance */

                        table.meta,
                        table.balance {
                            float: right;
                            width: 36%;
                        }

                        table.meta:after,
                        table.balance:after {
                            clear: both;
                            content: "";
                            display: table;
                        }

                        /* table meta */

                        table.meta th {
                            width: 40%;
                        }

                        table.meta td {
                            width: 60%;
                        }

                        /* table items */

                        table.inventory {
                            clear: both;
                            width: 100%;
                        }

                        table.inventory th {
                            font-weight: bold;
                            text-align: center;
                        }

                        table.inventory td:nth-child(1) {
                            width: 26%;
                        }

                        table.inventory td:nth-child(2) {
                            width: 38%;
                        }

                        table.inventory td:nth-child(3) {
                            text-align: right;
                            width: 12%;
                        }

                        table.inventory td:nth-child(4) {
                            text-align: right;
                            width: 12%;
                        }

                        table.inventory td:nth-child(5) {
                            text-align: right;
                            width: 12%;
                        }

                        /* table balance */

                        table.balance th,
                        table.balance td {
                            width: 50%;
                        }

                        table.balance td {
                            text-align: right;
                        }

                        /* aside */

                        aside h1 {
                            border: none;
                            border-width: 0 0 1px;
                            margin: 0 0 1em;
                        }

                        aside h1 {
                            border-color: #999;
                            border-bottom-style: solid;
                        }

                        /* javascript */

                        .add,
                        .cut {
                            border-width: 1px;
                            display: block;
                            font-size: .8rem;
                            padding: 0.25em 0.5em;
                            float: left;
                            text-align: center;
                            width: 0.6em;
                        }

                        .add,
                        .cut {
                            background: #9AF;
                            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
                            background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
                            background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
                            border-radius: 0.5em;
                            border-color: #0076A3;
                            color: #FFF;
                            cursor: pointer;
                            font-weight: bold;
                            text-shadow: 0 -1px 2px rgba(0, 0, 0, 0.333);
                        }

                        .add {
                            margin: -2.5em 0 0;
                        }

                        .add:hover {
                            background: #00ADEE;
                        }

                        .cut {
                            opacity: 0;
                            position: absolute;
                            top: 0;
                            left: -1.5em;
                        }

                        .cut {
                            --webkit-transition: opacity 100ms ease-in;
                        }

                        tr:hover .cut {
                            opacity: 1;
                        }

                        @media print {
                            * {
                                -webkit-print-color-adjust: exact;
                            }

                            html {
                                background: none;
                                padding: 0;
                            }

                            body {
                                box-shadow: none;
                                margin: 0;
                            }

                            span:empty {
                                display: none;
                            }

                            .add,
                            .cut {
                                display: none;
                            }

                            body {
                                -webkit-print-color-adjust: exact;
                            }

                            /* กำหนดให้สีในหน้าเว็บสามารถพิมพ์ได้อย่างถูกต้อง*/
                            .hideWhenPrint {
                                /* เนื้อหาในคลาส hideWhenPrint จะถูกปิดตาทิ้งไปเมื่อพิมพ์บนกระดาษ*/
                                display: none;
                            }
                        }

                        @page {
                            margin: 0;
                        }

                        /* The Modal (background) */
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
                            color: #aaaaaa;
                            float: right;
                            font-size: 28px;
                            font-weight: bold;
                        }

                        .close:hover,
                        .close:focus {
                            color: #000;
                            text-decoration: none;
                            cursor: pointer;
                        }
                    </style>


                    <?php
                    ob_start();

                    $date_check_month =  "$y-$m-$d";

                    $qli = mysqli_query($con, "SELECT * FROM unit WHERE MONTH(date) >= '$m' and MONTH(date) < '$m_now' and YEAR(date) >= '$y' and room = '$checkbox1[$i]'");
                    $dck = mysqli_fetch_array($qli);

                    $urd = mysqli_query($con, "SELECT * FROM user INNER JOIN room on(user.room = room.room) 
                    INNER JOIN room_details on(room_details.id = room.type) WHERE room.room = '$checkbox1[$i]'");
                    if($user1 = mysqli_fetch_array($urd)){
                        $urd = mysqli_query($con, "SELECT * FROM user INNER JOIN room on(user.room = room.room) 
                        INNER JOIN room_details on(room_details.id = room.type) WHERE room.room = '$checkbox1[$i]'");
                        $user1 = mysqli_fetch_array($urd);
                    }else{
                        $urd = mysqli_query($con, "SELECT * FROM room 
                        INNER JOIN room_details on(room_details.id = room.type) WHERE room.room = '$checkbox1[$i]'");
                        $user1 = mysqli_fetch_array($urd);
                    }

                    $check_unit = mysqli_query($con, "SELECT * FROM unit WHERE room = '$checkbox1[$i]'");
                    $num = mysqli_num_rows($check_unit);
                    if ($num == 0) {
                        echo "<script type='text/javascript'> alert('กรุณาเพิ่มข้อมูล ค่าน้ำ/ไฟ ก่อนจะพิมพ์ใบเสร็จ')</script>";
                        echo "<script type='text/javascript'> window.location='month.php'</script>";
                    }
                    // if($unit_check['room'] == $pid){
                    //    
                    // }elseif($unit_check['room'] != $pid){

                    //     echo "<script type='text/javascript'> alert('กรุณาเพิ่มข้อมูล ค่าน้ำ/ไฟ ให้ถูกต้อง')</script>";
                    // }

                    ?>
                    <?php if (isset($user1['reservation'])) : ?>
                        <?php if(isset($checkbox1[$i])){
                            $eer = mysqli_query($con,"SELECT room_category.name as name
                            FROM  room 
                            INNER JOIN room_details on(room_details.id = room.type)
                            INNER JOIN room_category on(room_category.id = room_details.reservation)
                            WHERE room.room = '$checkbox1[$i]' GROUP BY room_category.name");
                                
                            $check = mysqli_fetch_array($eer);
                            $check_room = $check['name'];
                        }
                        ?>
                        <?php else:?>
                            <?php if(isset($checkbox1[$i])){
                            // $eer = mysqli_query($con,"SELECT room_category.name as name
                            // FROM  room 
                            // INNER JOIN room_details on(room_details.id = room.type)
                            // INNER JOIN room_category on(room_category.id = room_details.reservation)
                            // WHERE room.room = '$checkbox1[$i]' GROUP BY room_category.name");
                                
                            // $check = mysqli_fetch_array($eer);
                            // $check_room = $check['name'];
                        }
                        ?>
                    <?php endif; ?>

                    <?php


                    $drd = mysqli_query($con, "SELECT * FROM `unit` WHERE date = '" . $ccv['date_check'] . "' AND room = '$checkbox1[$i]' ");
                    $trow = mysqli_fetch_array($drd);

                    $userid2 = mysqli_query($con, "SELECT * FROM room WHERE room = '$checkbox1[$i]'");
                    $user2 = mysqli_fetch_array($userid2);

                    $receiptId = mysqli_query($con, "SELECT * FROM `receipt` WHERE date = '" . $ccv['date_check'] . "' AND room = '$checkbox1[$i]'");
                    $receipt = mysqli_fetch_array($receiptId);

                    ?>

                    <?php if (isset($check_room) != 'รายวัน') {
                        echo '<center>';
                        echo '<h1>กรุณาเลือกเฉพราะห้อง  "รายเดือน" </h1>';
                        echo '<h1>ห้องที่มี "ผู้พักอาศัย"</h1>';
                        echo '<h1>และห้องที่มี "การกำหนดค่าน้ำ/ไฟ แล้ว"</h1>';
                        echo '</center>';
                    }

                    ?>

                    <?php list($y_max, $m_max, $d_max) = explode("-", $ccv['date_check']); ?>

                    <?php if (isset($check_room) == 'รายเดือน') : ?>
                </head>
               
                <body>
                    <div style="height:138mm;width:100%">
                        <table border="1" width="100%">
                            <tr>
                                <td width="65%" colspan="3">
                                    <h2><?php echo $header; ?></h2>
                                    ที่อยู่. <lable><?php echo $address; ?></lable><br>
                                    โทร. <lable><?php echo $phone_own; ?></lable>
                                </td>
                                <td colspan="2">
                                    <h3>ใบแจ้งหนี้/ใบเสร็จ</h3>
                                    <div>เลขใบเสร็จ(Doc No.): <?php echo $receipt['pay_id']; ?></div>
                                    <lable>วันที่ออกใบเสร็จ(Date): <?php echo $d_now . "/" . $m_now . '/' . ($y_now + 543); ?></lable>
                                    <div>ช่วงวันที่จดมิตเตอร์: <?php echo $d . '/' . $m . '/' . ($y + 543); ?> ถึง <?php echo $d_max . '/' . $m_max . '/' . ($y_max + 543); ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                <?php
                                    //ชื่อนามสกุล
                                    $userid3 = mysqli_query($con,"SELECT * FROM user WHERE room = $checkbox1[$i]"); 
                                    $userid = mysqli_query($con,"SELECT * FROM user WHERE room = $checkbox1[$i]"); 

                                    if($usere = mysqli_fetch_array($userid3)){ //เช็คว่ามีผู้ใช้ในห้องจริงไหม
                                        while($user = mysqli_fetch_array($userid)){ //ถ้ามีให้วง loop user คนนั้น
                                            if($user['fname']){
                                                echo "<div>ชื่อ-สกุล: ".$user['prefix_name']." ".$user['fname']." ".$user['lname']."</div>";
                                            }else{
                                                echo "<div>ชื่อ-สกุล: -</div>";
                                            }
                                        }
                                    }else{
                                        
                                        echo "<div>ชื่อ-สกุล: -</div>";
                                    }
                                    
                                ?>
                                </td>
                                <td colspan="2">
                                    <h4>ห้อง(Room No.): <lable style="float:right"><?php echo $checkbox1[$i]; ?></lable>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <th width="5%" style="text-align:center;">ลำดับ</th>
                                <th style="text-align:center;">รายการ</th>
                                <th style="text-align:center;"><span>จำนวนหน่วย</span></th>
                                <th style="text-align:center;"><span>ราคาต่อหน่วย</span></th>
                                <th style="text-align:center;"><span>จำนวนเงิน</span></th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>ค่าเช่าห้องพัก(Room Rate)</td>
                                <td></td>
                                <?php $price = $user1['price'] ?>
                                <td style="text-align:right;"><?php echo  number_format($price, 2); ?></td>
                                <td style="text-align:right;"><?php echo  number_format($price, 2); ?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>ค่ากระแสไฟฟ้า(Electrictiy Charge)</td>
                                <?php $unit_totalE = $trow['last_unit_electricity'] - $dck['last_unit_electricity']; ?>
                                <?php $sumE = $unit_totalE * $user2['unitPerElectricity']; ?>
                                <td style="text-align:right;"><?php echo number_format($unit_totalE, 2); ?></td>
                                <td style="text-align:right;"><?php echo number_format($user2['unitPerElectricity'], 2); ?></td>
                                <td style="text-align:right;"><?php echo  number_format($sumE, 2); ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>&nbsp&nbsp&nbsp เลขอ่านครั้งก่อน(Pervious Charge)</td>
                                <td><?php echo number_format($dck['last_unit_electricity'], 2); ?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>&nbsp&nbsp&nbsp เลขอ่านครั้งหลัง(Current Charge)</td>
                                <td><?php echo number_format($trow['last_unit_electricity'], 2); ?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>ค่าน้ำประปา (Tab Water Charge)</td>
                                <?php $unit_totalW = $trow['last_unit_water'] - $dck['last_unit_water']; ?>
                                <?php $sumW = $unit_totalW * $user2['unitPerWater']; ?>
                                <td style="text-align:right;"><?php echo  number_format($unit_totalW, 2); ?></td>
                                <td style="text-align:right;"><?php echo number_format($user2['unitPerWater'], 2); ?></td>
                                <td style="text-align:right;"><?php echo  number_format($sumW, 2); ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>&nbsp&nbsp&nbsp เลขอ่านครั้งก่อน(Pervious Charge)</td>
                                <td><?php echo number_format($dck['last_unit_water'], 2); ?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>&nbsp&nbsp&nbsp เลขอ่านครั้งหลัง(Current Charge)</td>
                                <td><?php echo number_format($trow['last_unit_water'], 2); ?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>ค่าอื่นๆ (Other Charge)</td>
                                <td></td>
                                <?php $other = $trow['other']; ?>
                                <td style="text-align:right;"><?php echo number_format($trow['other'], 2); ?></td>
                                <td style="text-align:right;"><?php echo number_format($other, 2); ?></td>
                            </tr>
                            <!-- <tr>
                                        <td>5</td>
                                        <td>ค่าปรับ (Charge)</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr> -->
                            <tr>
                                <td colspan="3"></td>
                                <td>ยอดรวมทั้งสิ้น</td>
                                <?php $sum = $price + $sumE + $sumW + $other ?>
                                <td style="text-align:right;"><?php echo  number_format($sum, 2); ?></td>
                            </tr>
                        </table>
                        <br>
                        <table border="0">
                            <tr>
                                <td><br> ลงนาม..................................................(ผู้จ่ายเงิน)</td>
                                <td style="text-align:right"><br> ลงนาม..................................................(ผู้รับเงิน)</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <lable style="color:red">หมายเหตุ <?php echo $user2['note'] ?>
                                </td>
                            </tr>
                        </table>

                        <!-- <button class="hideWhenPrint button" id="<?php echo $e; ?>" onclick="return edit_comment(this)">แก้ไขหมายเหตุ</button>
                        <div id="myModal<?php echo $e; ?>" class="modal"> -->
                            <!-- Modal content -->
                            <!-- <div class="modal-content">
                                <span class="close<?php echo $e; ?>">&times;</span>
                                <form method="post">
                                    <div>รหัส ใบแจ้งหนี้/ใบเสร็จ : <?php echo $receipt['pay_id']; ?></div>
                                    <lable style="color:red">ข้อความเก่า หมายเหตุ : <?php echo $receipt['note'] ?> </lable>
                                    <div><br>
                                        <input type="hidden" name="room_up[ ]" value="<?php echo $checkbox1[$i] ?>">
                                        <input type="hidden" name="id_pay" value="<?php echo $e; ?> ">
                                        <input type="hidden" name="pay_id[ ]" value="<?php echo $receipt['pay_id']; ?> ">
                                        <textarea style="width:100%" name="text_value[ ]" required><?php echo $receipt['note'] ?></textarea>
                                        <input type="submit" name="update_note" value="แก้ไข" class="btn btn-primary" onclick="return confirm('ยืนยันการแก้ไข')">
                                    </div>
                            </div>
                            </form> -->
                            
                        </div>
                    </div>


                <?php endif; ?>

                </body>

                </html>

                <?php

                ob_end_flush();
                $e = $e + 1;
                $i = $i + 1;
                ?>
                <br><br><br>
            <?php endforeach; ?>

            <a href="month.php"><button class="hideWhenPrint button" style="margin-right:20px">กลับหน้าหลัก</button></a>
            <button style="margin:20px auto;" class="hideWhenPrint print" onclick="window.print()">พิมพ์ PDF</button>

            <?php
                            
            if (isset($_POST['update_note'])) {
            //     $text = array(); //comment แก้ไข
            //     $pay = array(); //pay id
            //     $room = array(); //ห้อง
                
            //     $text_value = $_POST['text_value'];
            //     $pay_id = $_POST['pay_id'];
            //     $pid = $_POST['room_up'];

            //     echo $id_pay = $_POST['id_pay']; // รหัส 0-9

            //     foreach ($text_value as $id) {
            //         array_push($text, "$id");
                
            //     }
            //     foreach ($pay_id as $id) {
            //         array_push($pay, "$id");
            //     }
            //     foreach ($pid as $id) {
            //         array_push($room, "$id");
            //     }

            //     echo $text[$id_pay];
            //     echo $pay[$id_pay];
            //     echo $room[$id_pay];
            //     echo "<script type='text/javascript'> alert('$text[$id_pay]  $pay[$id_pay]  $room[$id_pay]')</script>";
            //     if ($text[$id_pay] != null) {
            //         mysqli_query($con, "UPDATE `receipt` SET `note`='$text[$id_pay]' WHERE pay_id = $pay[$id_pay]");
            //         echo "<script type='text/javascript'> window.location='month.php'</script>";

            //         $sqlie = "INSERT INTO event_log (personal,date,time,event) 
            // VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " แก้ไขข้อมูล หมายเหตุ ใบเสร็จ เลขห้อง $room[$id_pay]')";
            //         mysqli_query($con, $sqlie);

            //         echo "<script type='text/javascript'> alert('แก้ไขสำเร็จ')</script>";
            //     } else {
            //         echo "<script type='text/javascript'> alert('กรุณาใส่ข้อมูลในช่องว่าง')</script>";
            //     }
            }
            ?>

            <script>
                // Get the modal
                function edit_comment(trigger_element) {
                    var clicked_element = trigger_element
                    var id = clicked_element.id;
                    var value = document.getElementById(id).value;
                    var modal = document.getElementById("myModal" + id);
                    // Get the button that opens the modal
                    var btn = document.getElementById(id);
                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close" + id)[0];
                    // }
                    //     i++;
                    // }
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
                }
            </script>

        <?php else : ?>
            <?php
            echo "<script type='text/javascript'> alert('กรุณาเลือกห้องที่ต้องการทำการ พิมพ์ใบเสร็จก่อน')</script>";
            echo "<script type='text/javascript'> window.location='month.php'</script>"; ?>
        <?php endif; ?>

    <?php endif; ?>

<?php else : ?>

    <script type="text/javascript">
        $(function() {
            $("#room").change(function() {
                $("#because").hide();
                if ($(this).val() == "1") {
                    $("#because").hide();
                    $("#because2").show();
                } else {
                    $("#because").show();
                    $("#because2").hide();

                }
                if ($(this).val() == "") {
                    $("#because").hide();
                    $("#because2").hide();
                }

            });
        });
    </script>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    </head>
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            font-weight: bold;
        }

        .checkmark {
            height: 20px;
            width: 20px;

        }

        .bte {
            background-color: green;
            color: white;
            margin: 5px;
        }

        .bta {
            background-color: green;
            color: white;
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

        .focus {
            color: red;
        }

        * {
            font-size: 14px;
        }

        .btn-edit {
            background-color: #FFFF00;
            color: black;
            border: 1px solid black;
        }

        .btn-edit:hover {
            opacity: 0.2;
        }

        .con {
            background-color: #D3D3D3;
            color: black;
            border: 1px solid black;
        }

        .con:hover {
            opacity: 0.2;
        }

        .btn-clk {

            background-color: #000080;
            color: white;
        }

        .btn-clk:hover {
            background-color: #DCDCDC;
            color: red;
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
                            <a class="active-menu" href="month.php"><i class="fa fa-calendar-check-o"></i> การจัดการห้องพัก</a>
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
                            <h1 class="page-header">
                                การจัดการห้องพัก <small>รายเดือน/รายวัน</small>
                            </h1>
                        </div>
                    </div>

                    <!-- /. ROW  -->

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">

                                        <a href="editR.php?addDR"><button class='btn btn-clk' style="margin:5px auto 5px"> เพิ่มชนิดห้องพักรายวัน/รายเดือน</button></a>
                                        <button data-toggle="modal" data-target="#myModal" class='btn bta'><i class="fa fa-plus-circle"></i> เพิ่มห้อง</button>
                                        <form method='post' action=''>

                                            <!-- <button class='btn btn-danger' style="margin:5px" name="delall" onclick="return confirm('คุณต้องการลบข้อมูลห้องที่เลือกหรือไม่')" style="border:1px solid black;"><i class="fa fa-times-circle"></i> ลบห้องที่เลือก</button> -->
                                            <button class='btn btn-primary' name="print_all" onclick="return confirm('คุณต้องการพิพม์ใบเสร็จห้องที่เลือกหรือไม่')" style="border:1px solid black;"><i class="fa fa-file-pdf-o"></i> พิพม์ใบเสร็จทั้งหมด</button>
                                            <button style="margin:5px 0px" name="receipt" class="btn con" onclick="return confirm('ยินยันการบันทึก สถานะ การจ่ายเงิน')"><i class="fa fa-hourglass-2"></i> ยืนยันสถานะการจ่ายเงินค่าห้อง</button>
                                            <br /><br />
                                            <select class="form-control" style="width:100%" id="search" name="search45" onchange="form.submit()">
                                                <option value="">--เลือกดูชนิดห้อง--</option>
                                                <option value="รายเดือน">รายเดือน</option>
                                                <option value="รายวัน">รายวัน</option>
                                            </select>
                                            <p>
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <center>All</center><input type="checkbox" class="checkmark" name="css_all_check" id="css_all_check" />
                                                        </th>

                                                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
                                                        <script type="text/javascript">
                                                            $(function() {
                                                                $("#css_all_check").click(function() { // เมื่อคลิกที่ checkbox ตัวควบคุม
                                                                    if ($(this).prop("checked")) { // ตรวจสอบค่า ว่ามีการคลิกเลือก
                                                                        $(".checkmark").prop("checked", true); // กำหนดให้ เลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด 
                                                                    } else { // ถ้าไม่มีการ ยกเลิกการเลือก
                                                                        $(".checkmark").prop("checked", false); // กำหนดให้ ยกเลิกการเลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด 
                                                                    }
                                                                });
                                                            });
                                                        </script>

                                                        <th>ชั้นที่</th>
                                                        <th>หมายเลขห้อง</th>
                                                        <th>สถานะห้อง</th>
                                                        <th>ประเภทห้อง</th>
                                                        <th>ประเภทเตียง</th>
                                                        <th>ราคาห้อง(บาท)</th>
                                                        <th>ประกัน(บาท)</th>
                                                        <th width="7%">ชนิดห้อง</th>
                                                        <th>แก้ไข</th>
                                                        <th>ลบ</th>
                                                        <th>พิมพ์ใบเสร็จ</th>
                                                        <th>ข้อมูลห้อง</th>
                                                        <th>สถานะจ่ายเงิน</th>

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                    <?php

                                                    $date_check = array();

                                                    $ccv = mysqli_fetch_array($last_date_receipt);



                                                    if (isset($_POST['search45'])) {
                                                        $type_value = $_POST['search45'];
                                                        switch ($type_value) {

                                                            case 'รายเดือน':
                                                                $check_query = mysqli_query($con, "SELECT * FROM `receipt` GROUP BY room ORDER BY room ASC");
                                                                while ($check_date_room = mysqli_fetch_array($check_query)) {

                                                                    $date_check = array();
                                                                    $ec = mysqli_query($con, "SELECT max(date) as date_check_room  FROM `receipt` WHERE room = " . $check_date_room['room'] . " ORDER BY room ASC");
                                                                    $ccve = mysqli_fetch_array($ec);
                                                                    array_push($date_check, $ccve['date_check_room']);
                                                                    // echo $check_date_room['room']."<br>";
                                                                    $R_details_check_date = mysqli_query($con, "SELECT room_type.name as tname, 
                                                                bed_type.name as bname, 
                                                                room_category.name as cname, 
                                                                room.room as room, 
                                                                room.room_detal as room_detal,
                                                                room.room_status as room_status,
                                                                room_details.price as price,
                                                                room.unitPerWater as unitPerWater,
                                                                room.unitPerElectricity as unitPerElectricity,
                                                                room_details.floor as floor,
                                                                room_category.name as reservation,
                                                                room_details.other as other
                
                                                                FROM room 
                                                                
                                                                INNER JOIN room_details on(room.type  = room_details.id) 
                                                                INNER JOIN bed_type ON(room_details.bed = bed_type.id) 
                                                                INNER JOIN room_type ON(room_type.id = room_details.type) 
                                                                INNER JOIN room_category ON(room_details.reservation = room_category.id)
                                                                INNER JOIN receipt ON(receipt.room = room.room)
                                                                WHERE room.room = receipt.room and room_details.reservation = '2' and receipt.date = '" . $date_check[0] . "'  
                                                                and receipt.room ='" . $check_date_room['room'] . "'
                                                                ORDER BY  `room`.`room`,`room_details`.`reservation` , `room_details`.`floor` ASC
                                                                ");
                                                                    // echo $ccv['date_check'];
                                                                    $drd = mysqli_query($con, "SELECT * FROM room 
                                                                INNER JOIN `receipt`on(room.room = receipt.room) 
                                                                WHERE  receipt.room and receipt.date = '" . $date_check[0] . "' and receipt.room ='" . $check_date_room['room'] . "' ");

                                                                    $trow = mysqli_fetch_array($R_details_check_date);
                                                                    $eccp = mysqli_fetch_array($drd);

                                                                    $id = $trow['room'];
                                                                    // echo $id." / $date_check[0]<br>";
                                                                    $query = mysqli_query($con, "SELECT * FROM user WHERE user.room = $id");
                                                                    $result = mysqli_fetch_assoc($query);

                                                                    if ($result) {
                                                                        $user_have_room = 'Not Null';
                                                                    } else {
                                                                        $user_have_room = 'Null';
                                                                    };
                                                                    echo "<tr>
                                                                
                                                                <th>
                                                                    <center>";
                                                                    $cc_r_l2 = mysqli_query($con, "SELECT * FROM `receipt` WHERE room = $id and date = '" . $ccv['date_check'] . "'");
                                                                    if ($trow['reservation'] == 'รายเดือน' and $trow['room_status'] == 'ไม่ว่าง' and $user_have_room == 'Not Null' and mysqli_fetch_array($cc_r_l2)) {
                                                                        echo "<input type='checkbox' name='chkl[ ]' class='checkmark'value='" . $trow['room'] . "'>";
                                                                    } else
                                                                        echo "<input type='checkbox' name='chkl[ ]' class='checkmark'value='" . $trow['room'] . "' disabled>";
                                                                    echo "</center>
                                                                </th>

                                                                <th>" . $trow['floor'] . "</th>
                                                                <th><lable><center>" . $trow['room'] . "</center></lable></th>
                                                                ";
                                                                    if ($trow['reservation'] == "รายวัน") {
                                                                        echo "<input type='hidden' name='rroom[ ]' value='" . $eccp['room'] . "' disabled>";
                                                                    } else {
                                                                        echo "<input type='hidden' name='rroom[ ]' value='" . $trow['room'] . "'>";
                                                                    }
                                                                    echo "<input type='hidden' name='rroom1[ ]' value='" . $trow['room'] . "'>
                                                                <th>";
                                                                    if ($trow['room_status'] == "ว่าง") {
                                                                        echo "<lable style='color:green;'>" . $trow['room_status'] . "</lable>";
                                                                    } else {
                                                                        echo "<lable style='color:red;'>" . $trow['room_status'] . "</lable>";
                                                                    }
                                                                    echo "</th>
                                                                <th>" . $trow['tname'] . "</th>
                                                                <th>" . $trow['bname'] . "</th>";


                                                                    echo " <th>" . number_format($trow['price'], 0) . "</th>
                                                                <th>" . number_format($trow['other'], 0) . " </th>
                                                                <th>" . $trow['reservation'] . "</th>
                                                                
                                                    

                                                                <td><a href=editR.php?eid=" . $id . " <button  class='btn btn-edit'><i class='fa fa-pencil'></i> แก้ไข</button></td>";
                                                                    echo '<td><a href=delR.php?delR=' . $id . ' onclick="return confirm(\'คุณต้องการลบห้อง ' . $trow['room'] . ' ใช่หรือไม่\')" 
                                                                <button class="btn btn-danger" style="border:1px solid black;"> <i class="fa fa-times-circle" ></i> ลบ</button></a></td>
                                                                <td>';
                                                                    $cc_r_l = mysqli_query($con, "SELECT * FROM `receipt` WHERE room = $id and date = '" . $ccv['date_check'] . "'");
                                                                    if ($trow['reservation'] == 'รายเดือน' and $trow['room_status'] == 'ไม่ว่าง' and mysqli_fetch_array($cc_r_l)) {
                                                                        echo '<a href=bills.php?bills=' . $id . ' <button class="btn btn-primary" style="border:1px solid black;"><i class="fa fa-file-pdf-o" ></i> พิมพ์ใบเสร็จ</button> </a>';
                                                                    } else {
                                                                        echo '<button class="btn btn-primary" disabled><i class="fa fa-file-pdf-o" ></i> พิมพ์ใบเสร็จ</button>';
                                                                    }
                                                                    echo '</td>
                                                                <td><a href=dataR.php?dataR=' . $id . ' <button class="btn btr" style="background-color:#000000;color:white;"> <i class="fa fa-edit" ></i> ข้อมูล</button></a></td>
                                                                <td>';

                                                                    // if($trow['reservation'] == 'รายวัน'){
                                                                    //     echo "เฉพราะห้องรายเดือน</td></tr>";
                                                                    // }
                                                                    // echo $eccp['room'];
                                                                    if ($trow['room_status'] == 'ว่าง' and $eccp['receipt_total'] == null) {
                                                                        echo '<input type="hidden" name="pay[ ]" value="' . $eccp['pay_id'] . '">';
                                                                        echo '<select name="pay_receipt[ ]" style="background-color:#DCDCDC" class="form-control" style="width:100%">';
                                                                        echo "<option value='0'>กำหนด ค่าน้ำ/ไฟ</option>";
                                                                    } else if ($trow['room_status'] == 'ว่าง' and $eccp['receipt_total'] != null) {
                                                                        echo '<input type="hidden" name="pay[ ]" value="' . $eccp['pay_id'] . '">';
                                                                        echo '<select name="pay_receipt[ ]" style="background-color:#DCDCDC;width:100%" class="form-control" >';
                                                                        echo "<option value='0'>สถานะห้องต้องไม่ว่าง</option>";
                                                                    } else if ($trow['room_status'] == 'ไม่ว่าง' and $eccp['receipt_total'] != null) {

                                                                        echo '<input type="hidden" name="pay[ ]" value="' . $eccp['pay_id'] . '">';


                                                                        if ($eccp['payRent'] == '0') {
                                                                            echo '<select name="pay_receipt[ ]" class="form-control" style="width:100%;color:red">';
                                                                            echo "
                                                                            <option value='0'>ยังไม่จ่ายเงิน </option>
                                                                            <option value='1'>จ่ายแล้ว</option>
                                                                            ";
                                                                            echo '</select></td></tr>';
                                                                        } else if ($eccp['payRent'] == '1') {
                                                                            echo '<select name="pay_receipt[ ]" class="form-control" style="width:100%;color:green">';
                                                                            echo "
                                                                            <option value='1'>จ่ายแล้ว</option>
                                                                            <option value='0'>ยังไม่จ่ายเงิน</option>
                                                                            ";
                                                                            echo '</select></td></tr>';
                                                                        } else if (empty($eccp['payRent'])) {
                                                                            echo '<select name="pay_receipt[ ]" class="form-control" style="width:100%;color:red">';
                                                                            echo "<option value='1'>กำหนด น้ำ/ไฟ</option>";
                                                                            echo '</select></td></tr>';
                                                                        }
                                                                    } else if ($trow['room_status'] == 'ไม่ว่าง' and $eccp['receipt_total'] == null) {
                                                                        echo '<input type="hidden" name="pay[ ]" value="' . $eccp['pay_id'] . '">';
                                                                        echo '<select name="pay_receipt[ ]" style="background-color:#DCDCDC" class="form-control" style="width:100%;color:red">';
                                                                        echo "<option value='0'>กำหนด ค่าน้ำ/ไฟ</option>";
                                                                    }
                                                                }

                                                                break;
                                                            case 'รายวัน';
                                                                $R_details_check_type = mysqli_query($con, "SELECT room_type.name as tname, 
                                                                bed_type.name as bname, 
                                                                room_category.name as cname, 
                                                                room.room as room, 
                                                                room.room_detal as room_detal,
                                                                room.room_status as room_status,
                                                                room_details.price as price,
                                                                room.unitPerWater as unitPerWater,
                                                                room.unitPerElectricity as unitPerElectricity,
                                                                room_details.floor as floor,
                                                                room_category.name as reservation,
                                                                room_details.other as other
                
                                                                FROM room 
                                                                
                                                                INNER JOIN room_details on(room.type  = room_details.id) 
                                                                INNER JOIN bed_type ON(room_details.bed = bed_type.id) 
                                                                INNER JOIN room_type ON(room_type.id = room_details.type) 
                                                                INNER JOIN room_category ON(room_details.reservation = room_category.id)
                                                                -- INNER JOIN receipt ON(receipt.room = room.room)
                                                                WHERE room_details.reservation = '1'
                                                                ORDER BY  `room`.`room`,`room_details`.`reservation` , `room_details`.`floor` ASC
                                                                ");



                                                                while ($trow = mysqli_fetch_array($R_details_check_type)) {

                                                                    $id = $trow['room'];
                                                                    $query = mysqli_query($con, "SELECT * FROM user WHERE user.room = $id");
                                                                    $result = mysqli_fetch_assoc($query);

                                                                    if ($result) {
                                                                        $user_have_room = 'Not Null';
                                                                    } else {
                                                                        $user_have_room = 'Null';
                                                                    };
                                                                    echo "<tr>
                                                                
                                                                <th>
                                                                    <center>";
                                                                    $cc_r_l3 = mysqli_query($con, "SELECT * FROM `receipt` WHERE room = $id and date = '" . $ccv['date_check'] . "'");
                                                                    if ($trow['reservation'] == 'รายเดือน' and $trow['room_status'] == 'ไม่ว่าง' and $user_have_room == 'Not Null' and mysqli_fetch_array($cc_r_l3)) {
                                                                        echo "<input type='checkbox' name='chkl[ ]' class='checkmark'value='" . $trow['room'] . "'>";
                                                                    } else
                                                                        echo "<input type='checkbox' name='chkl[ ]' class='checkmark'value='" . $trow['room'] . "' disabled>";
                                                                    echo "</center>
                                                                </th>

                                                                <th>" . $trow['floor'] . "</th>
                                                                <th><lable><center>" . $trow['room'] . "</center></lable></th>
                                                            
                                                                <th>";
                                                                    if ($trow['room_status'] == "ว่าง") {
                                                                        echo "<lable style='color:green;'>" . $trow['room_status'] . "</lable>";
                                                                    } else {
                                                                        echo "<lable style='color:red;'>" . $trow['room_status'] . "</lable>";
                                                                    }
                                                                    echo "</th>
                                                                <th>" . $trow['tname'] . "</th>
                                                                <th>" . $trow['bname'] . "</th>";


                                                                    echo " <th>" . number_format($trow['price'], 0) . "</th>
                                                                <th>" . number_format($trow['other'], 0) . " </th>
                                                                <th>" . $trow['reservation'] . "</th>
                                                                
                                                    

                                                                <td><a href=editR.php?eid=" . $id . " <button  class='btn btn-edit'><i class='fa fa-pencil'></i> แก้ไข</button></td>";
                                                                    echo '<td><a href=delR.php?delR=' . $id . ' onclick="return confirm(\'คุณต้องการลบห้อง ' . $trow['room'] . ' ใช่หรือไม่\')" 
                                                                <button class="btn btn-danger" style="border:1px solid black;"> <i class="fa fa-times-circle" ></i> ลบ</button></a></td>
                                                                <td>';

                                                                    $cc_r_l = mysqli_query($con, "SELECT * FROM `receipt` WHERE room = $id and date = '" . $ccv['date_check'] . "'");
                                                                    if ($trow['reservation'] == 'รายเดือน' and $trow['room_status'] == 'ไม่ว่าง'  and mysqli_fetch_array($cc_r_l)) {
                                                                        echo '<a href=bills.php?bills=' . $id . ' <button class="btn btn-primary" style="border:1px solid black;"><i class="fa fa-file-pdf-o" ></i> พิมพ์ใบเสร็จ</button> </a>';
                                                                    } else {
                                                                        echo '<button class="btn btn-primary" disabled><i class="fa fa-file-pdf-o" ></i> พิมพ์ใบเสร็จ</button>';
                                                                    }
                                                                    echo '</td>
                                                                <td><a href=dataR.php?dataR=' . $id . ' <button class="btn btr" style="background-color:#000000;color:white;"> <i class="fa fa-edit" ></i> ข้อมูล</button></a></td>
                                                                <td><div style="color:red">เฉพราะห้องรายเดือน</div></td></tr>';
                                                                }

                                                                break;
                                                        }
                                                    } else {
                                                        $R_details_check_date = mysqli_query($con, "SELECT room_type.name as tname, 
                                                            bed_type.name as bname, 
                                                            room_category.name as cname, 
                                                            room.room as room, 
                                                            room.room_detal as room_detal,
                                                            room.room_status as room_status,
                                                            room_details.price as price,
                                                            room.unitPerWater as unitPerWater,
                                                            room.unitPerElectricity as unitPerElectricity,
                                                            room_details.floor as floor,
                                                            room_category.name as reservation,
                                                            room_details.other as other
            
                                                            FROM room 
                                                            
                                                            INNER JOIN room_details on(room.type  = room_details.id) 
                                                            INNER JOIN bed_type ON(room_details.bed = bed_type.id) 
                                                            INNER JOIN room_type ON(room_type.id = room_details.type) 
                                                            INNER JOIN room_category ON(room_details.reservation = room_category.id)

                                                            ORDER BY  `room`.`room`,`room_details`.`reservation` , `room_details`.`floor` ASC
                                                            ");

                                                        while ($trow = mysqli_fetch_array($R_details_check_date)) {

                                                            $id = $trow['room'];
                                                            //ดึงข้อมูลผู้ใช้ที่มีห้องพัก

                                                            $query = mysqli_query($con, "SELECT * FROM user WHERE user.room = $id");
                                                            $result = mysqli_fetch_assoc($query);

                                                            if ($result) {
                                                                $user_have_room = 'Not Null';
                                                            } else {
                                                                $user_have_room = 'Null';
                                                            };

                                                            echo "<tr>

                                                            <th>
                                                                <center>";
                                                            $cc_r_l4 = mysqli_query($con, "SELECT * FROM `receipt` WHERE room = $id and date = '" . $ccv['date_check'] . "'");
                                                            if ($trow['reservation'] == 'รายเดือน' and $trow['room_status'] == 'ไม่ว่าง' and mysqli_fetch_array($cc_r_l4)) {
                                                                echo "<input type='checkbox' name='chkl[ ]' class='checkmark'value='" . $trow['room'] . "'>";
                                                            } else
                                                                echo "<input type='checkbox' name='chkl[ ]' class='checkmark'value='" . $trow['room'] . "' disabled>";
                                                            echo "</center>
                                                            </th>


                                                            <th>" . $trow['floor'] . "</th>
                                                            <th><lable><center>" . $trow['room'] . "</center></lable></th>

                                                            <th>";
                                                            if ($trow['room_status'] == "ว่าง") {
                                                                echo "<lable style='color:green;'>" . $trow['room_status'] . "</lable>";
                                                            } else {
                                                                echo "<lable style='color:red;'>" . $trow['room_status'] . "</lable>";
                                                            }
                                                            echo "</th>
                                                            <th>" . $trow['tname'] . "</th>
                                                            <th>" . $trow['bname'] . "</th>";


                                                            echo " <th>" . number_format($trow['price'], 0) . "</th>
                                                            <th>" . number_format($trow['other'], 0) . " </th>
                                                            <th>" . $trow['reservation'] . "</th>



                                                            <td><a href=editR.php?eid=" . $id . " <button  class='btn btn-edit'><i class='fa fa-pencil'></i> แก้ไข</button></td>";
                                                            echo '<td><a href=delR.php?delR=' . $id . ' onclick="return confirm(\'คุณต้องการลบห้อง ' . $trow['room'] . ' ใช่หรือไม่\')" 
                                                            <button class="btn btn-danger" style="border:1px solid black;"> <i class="fa fa-times-circle" ></i> ลบ</button></a></td>
                                                            <td>';

                                                            $cc_r_l = mysqli_query($con, "SELECT * FROM `receipt` WHERE room = $id and date = '" . $ccv['date_check'] . "'");
                                                            if ($trow['reservation'] == 'รายเดือน' and $trow['room_status'] == 'ไม่ว่าง' and mysqli_fetch_array($cc_r_l)) {
                                                                echo '<a href=bills.php?bills=' . $id . ' <button class="btn btn-primary" style="border:1px solid black;"><i class="fa fa-file-pdf-o" ></i> พิมพ์ใบเสร็จ</button> </a>';
                                                            } else {
                                                                echo '<button class="btn btn-primary" disabled><i class="fa fa-file-pdf-o" ></i> พิมพ์ใบเสร็จ</button>';
                                                            }
                                                            echo '</td>
                                                            <td><a href=dataR.php?dataR=' . $id . ' <button class="btn btr" style="background-color:#000000;color:white;"> <i class="fa fa-edit" ></i> ข้อมูล</button></a></td>
                                                            <td><div style="color:red">กรุณาเลือกชนิดห้องในการจัดการข้อมูล</div></td></tr>';
                                                        }
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
                                    </div>

                                    <?php
                                    // if (isset($_POST['delall'])) {
                                    //     if (empty($_POST['delall'])) {
                                    //         if ($_POST['chkl'] == true) {
                                    //             $checkbox1 = $_POST['chkl'];

                                    //             foreach ($checkbox1 as $id_check) {

                                    //                 $sqli = mysqli_query($con,"DELETE FROM receipt WHERE room = " . $id_check . "");

                                    //                 $sqle = mysqli_query($con,"DELETE FROM unit WHERE room = " . $id_check . "");

                                    //                 $sqll = mysqli_query($con,"UPDATE `user` SET `room`= null WHERE room = $id");

                                    //                 $sql = "DELETE FROM room WHERE room = " . $id_check . "";
                                    //                 $con->query($sql);
                                    //             }
                                    //             foreach ($checkbox1 as $id_log) {

                                    //                 $sqlie = "INSERT INTO event_log (personal,date,time,event) 
                                    //                 VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " ลบห้อง $id_log ')";
                                    //                 mysqli_query($con, $sqlie);
                                    //                 echo "<script type='text/javascript'> window.location='month.php'</script>";
                                    //             }
                                    //         } else {
                                    //             echo "<script type='text/javascript'> alert('กรุณากดเลือกห้องที่ต้องการลบก่อน')</script>";
                                    //             echo "<script type='text/javascript'> window.location='month.php'</script>";
                                    //         }
                                    //     }
                                    // }
                                    ?>
                                    <?php
                                    if (isset($_POST['receipt'])) {
                                        if ($_POST['pay_receipt'] != null) {

                                            $status_receipt = array();
                                            $room_check = array();
                                            $pay_i = array();

                                            $cone = $_POST['pay_receipt'];
                                            $conff = $_POST['rroom'];
                                            $pay = $_POST['pay'];
                                            $name_A = array("" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . "");


                                            foreach ($pay as $key) {
                                                array_push($pay_i, "$key");
                                            }

                                            foreach ($cone as $key) {
                                                array_push($status_receipt, "$key");
                                            }
                                            $i = 0;


                                            foreach ($conff as $key) {

                                                array_push($room_check, "$key");

                                                $cc = mysqli_query($con, "SELECT * FROM receipt WHERE pay_id = '$pay_i[$i]'");
                                                $row_check = mysqli_fetch_array($cc);

                                                // if ($status_receipt[$i] == '0') {
                                                //     mysqli_query($con, "UPDATE `receipt` SET `payRent` = '$status_receipt[$i]',`name_admin`= null  WHERE room = '$room_check[$i]' and date = '" . $ccv['date_check'] . "'");
                                                // } else if ($status_receipt[$i] == '1') {
                                                //     mysqli_query($con, "UPDATE `receipt` SET `payRent` = '$status_receipt[$i]',`name_admin`='$name_A[0]'  WHERE room = '$room_check[$i]' and date = '" . $ccv['date_check'] . "'");
                                                // }

                                                if ($status_receipt[$i] == '0') {
                                                    mysqli_query($con, "UPDATE `receipt` SET `payRent` = '$status_receipt[$i]',`name_admin`= null  WHERE room = '$room_check[$i]' and date = '" . $ccv['date_check'] . "'");
                                                } else if ($status_receipt[$i] == '1') {
                                                    if ($row_check['name_admin'] != null and $row_check['name_admin'] != "") {
                                                        mysqli_query($con, "UPDATE `receipt` SET `payRent` = '$status_receipt[$i]',
                                                            `name_admin`='" . $row_check['name_admin'] . "'  WHERE room = '$room_check[$i]' 
                                                            and date = '" . $ccv['date_check'] . "'");
                                                    } else {
                                                        mysqli_query($con, "UPDATE `receipt` SET `payRent` = '$status_receipt[$i]',
                                                            `name_admin`='" . $name_A[0] . "'  WHERE room = '$room_check[$i]' 
                                                            and date = '" . $ccv['date_check'] . "'");
                                                    }
                                                }

                                                $i++;
                                            }

                                            $sqlie = "INSERT INTO event_log (personal,date,time,event) 
                                                VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','$name_A[0] แก้ไขสถานะการจ่ายเงิน')";
                                            mysqli_query($con, $sqlie);

                                            echo "<script type='text/javascript'> alert('บันทึก สถานะการจ่ายเงิน สำเร็จ!!')</script>";
                                            echo "<script type='text/javascript'> window.location='month.php'</script>";
                                        } else {
                                            echo "<script type='text/javascript'> alert('กรุณาจัดการที่หน้าห้อง รายดือน')</script>";
                                            echo "<script type='text/javascript'> window.location='month.php'</script>";
                                        }
                                    }



                                    ?>
                                    <!-- /. ROW  -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- POPUP เพิ่มห้อง -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">เพิ่มห้อง</h4>
                        </div>
                        <form method="post" action='editR.php?addDR' name="frm" onSubmit="JavaScript:return confrm();">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>หมายเลขห้อง</label>
                                    <input type="number" name="room" id="roomA" class="form-control" placeholder="หมายเลขห้อง" onKeyUp="JavaScript:refresh(this)">
                                    <script type="text/javascript">
                                        function refresh() {
                                            var a1 = document.getElementById("roomA").value;

                                            document.getElementById('FrameIDE').contentWindow.location = "checkuser.php?rid=" + a1;
                                        }
                                    </script>
                                    <iframe width="100%" height="50" name="FrameIDE" id="FrameIDE" style="border:0px;"></iframe>

                                    <label>รายละเอียดห้อง</label>
                                    <input name="room_detel" class="form-control" placeholder="ข้อมูลภายในห้อง" id="comment">

                                    <script>
                                        function confrm() {
                                            var room = document.getElementById("roomA").value;
                                            var comment = document.getElementById("comment").value;

                                            if (room == null || room == '') {
                                                // alert('กรุณากรอกข้อมูลหมายเลขห้อง');
                                                // return false;
                                                // document.getElementById("room_danger").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุหมายเลขห้อง</font>');
                                            } else if (comment == null || comment == '') {
                                                // alert('กรุณากรอกข้อมูลรายละเอียดห้อง');
                                                // return false;
                                                // document.getElementById("comment_danger").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุรายละเอียดห้อง</font>');
                                            }

                                        }
                                    </script>
                                    <?php
                                    $sqlt = "SELECT * FROM room_category";
                                    $ret = $con->query($sqlt);
                                    ?>
                                    <script>
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
                                                    $("#because").show();
                                                    if (unitW == '' || unitW == null) {
                                                        document.getElementById("unitW_danger").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุหน่วยค่านํ้า</font>');
                                                    } else {
                                                        document.getElementById("unitW_danger").innerHTML = ('');
                                                    }

                                                    if (unitE == '' || unitE == null) {
                                                        document.getElementById("unitE_danger").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุหน่วยค่าไฟ</font>');
                                                    } else {
                                                        document.getElementById("unitE_danger").innerHTML = ('');
                                                    }
                                                } else {
                                                    $("#because").hide();
                                                    document.getElementById("unitW_danger").innerHTML = ('');
                                                    document.getElementById("unitE_danger").innerHTML = ('');
                                                }
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
                                            else
                                                document.getElementById("nodays").value = diff + " คืน";
                                            document.getElementById("tprice").value = (diff * price) + parseInt(other);
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
                                                                var price = document.getElementById("price").value = text[0];
                                                                var other = document.getElementById("other").value = text[1];

                                                                if (other == 'ไม่มีข้อมูลในระบบ') {

                                                                    document.getElementById("error_other").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาเพิ่มชนิดห้องพัก หรือ คลิกปุ่ม <button type="submit" class="btn btn-clk" style="margin:5px auto 5px" name="log_details"> เพิ่มชนิดห้องพักรายวัน/รายเดือน</button></font>');
                                                                } else {
                                                                    document.getElementById("error_other").innerHTML = ('');
                                                                }
                                                                return text[0], text[1];
                                                                // document.getElementById("tprice").value = ((diff * parseInt(text[0])) + parseInt(text[1]));
                                                            } else if (room == 2) {
                                                                var price = document.getElementById("price").value = text[0];
                                                                var other = document.getElementById("other").value = text[1];

                                                                if (other == 'ไม่มีข้อมูลในระบบ') {

                                                                    document.getElementById("error_other").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาเพิ่มชนิดห้องพัก หรือ คลิกปุ่ม <button type="submit" class="btn btn-clk" style="margin:5px auto 5px" name="log_details"> เพิ่มชนิดห้องพักรายวัน/รายเดือน</button></font>');
                                                                } else {
                                                                    document.getElementById("error_other").innerHTML = ('');
                                                                }

                                                                document.getElementById("tprice").value = (parseInt(text[0]) + parseInt(text[1]));
                                                            }

                                                        }
                                                    });
                                                } else {
                                                    $('#price').html('<input type="text" class="form-control" value = "ไม่มีราคา">');
                                                }
                                            });
                                        });
                                    </script>

                                    <label>ชนิดห้อง<label class="mark"></label></label>
                                    <select class="form-control" id="room" name="type_id" required>
                                        <option selected></option>
                                        <?php while ($rowt = $ret->fetch_assoc()) : ?>
                                            <option value="<?php echo $rowt['id'] ?>"><?php echo $rowt['name'] ?></option>
                                        <?php endwhile ?>
                                    </select>


                                    <label for="message-text" class="col-form-label">ประเภท<label class="mark"></label></label>
                                    <select class="form-control" id="troom" name="troom" required></select>



                                    <label>เตียง<label class="mark"></label></label>
                                    <select class="form-control" id="broom" name="broom" required></select>


                                    <div class="form-group" id="floorbox">
                                        <label>ชั้น<label class="mark"></label></label>
                                        <select class="form-control" id="floor" name="floor"></select>

                                    </div>

                                    <label>ราคา</label>
                                    <input type="text" class="form-control" id="price" name="" disabled>


                                    <label>ประกัน</label>
                                    <input type="text" class="form-control" id="other" name="" disabled>
                                    <div id="error_other"></div>
                                </div>
                                <div class="form-group" id="because" style="display:none;">

                                    <?php

                                    $rowee = mysqli_fetch_array($room_all);
                                    if (isset($rowee['unitPerWater']) != null) {
                                        $wather1 = $rowee['unitPerWater'];
                                        $elec1 = $rowee['unitPerElectricity'];
                                    }
                                    if (isset($rowee['unitPerWater']) == null) {
                                        $_SESSION['error'] = "กรุณาระบุหน่วยค่านํ้าค่าไฟก่อน";
                                    }
                                    ?>
                                    </select>

                                    <hr>


                                    <label>หน่วยค่านํ้า</label>
                                    <input type="number" value="<?php echo $wather1 ?>" name="wather_p" class="form-control" maxlength="4" placeholder="ค่านํ้าต่อหน่อย" required>
                                    <label>หน่วยค่าไฟ</label>
                                    <input type="number" value="<?php echo $elec1 ?>" name="elec_p" class="form-control" maxlength="4" placeholder="ค่าไฟต่อหน่อย" required>


                                    <div class="form-group">
                                        <p>สถานะห้อง</p>
                                        <select name="status">
                                            <option value="ว่าง">ว่าง</option>
                                            <option value="ไม่ว่าง">ไม่ว่าง</option>
                                        </select>
                                    </div>


                                </div>
                            </div>
                            <script>

                            </script>




                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>

                                <input type="submit" name="log_insert" value="ยืนยัน" class="btn btn-primary" onclick="return confirm('ยืนยันการเพิ่มห้อง')">
                            </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
        </div>
        <!-- END POPUP เพิ่มห้อง -->


        </div>
        <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
        <!-- /. WRAPPER  -->
        <!-- JS Scripts-->
        <!-- Morris Chart Js -->
        <script src="assets/js/morris/raphael-2.1.0.min.js"></script>

        <script src="assets/js/morris/morris.js"></script>
        <!-- Custom Js -->
        <script src="assets/js/custom-scripts.js"></script>

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




<?php endif; ?>