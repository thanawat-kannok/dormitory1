<?php
	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}
	ob_start();	
	include ('../server.php');
    if(!isset($_SESSION['premission']) == "Admin")
    {
        session_destroy();
        header("location: ../index.php");
    }
?>
<html>

<head>
    <meta charset="utf-8">
    <title>ระบบจัดการหอพัก</title>
    <link rel="stylesheet" href="../css/image.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap" rel="stylesheet">
    <style>
    /* reset */
    * {
        
        box-sizing: content-box;
        color: inherit;
        font-family: inherit;
        font-size: inherit;
        font-style: inherit;
        font-weight: inherit;
        line-height: inherit;
        list-style: none;
        margin: 0;
        padding: 0;
        text-decoration: none;
        vertical-align: top;
    }

    .status {
        border: 1px solid black;
        background-color: green;
        color: white;
        border-radius: 5px;
        padding:0px 10px;
    }

    .statusred {
        border: 1px solid black;
        background-color: red;
        color: white;
        border-radius: 5px;
        padding:0px 10px;
    }

    /* content editable */

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

    /* heading */

    h1 {
        font: bold 100% sans-serif;
        letter-spacing: 0.5em;
        text-align: center;
        text-transform: uppercase;
    }

    /* table */

    table {
        font-size: 75%;
        table-layout: fixed;
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
        font-family: 'Prompt', sans-serif;
        font-weight: bold;
        box-sizing: border-box;
        height: 11in;
        margin: 0 auto;
        overflow: hidden;
        padding: 0.5in;
        width: 8.5in;
    }

    body {
        background: #FFF;
        border-radius: 1px;
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
    }

    /* header */

    header {
        margin: 0 0 3em;
    }

    header:after {
        clear: both;
        content: "";
        display: table;
    }

    header h1 {
        background: #000;
        border-radius: 0.25em;
        color: #FFF;
        margin: 0 0 1em;
        padding: 0.5em 0;
    }

    header address {
        float: left;
        font-size: 75%;
        font-style: normal;
        line-height: 1.25;
        margin: 0 1em 1em 0;
    }

    header address p {
        margin: 0 0 0.25em;
    }

    header span,
    header img {
        display: block;
        float: right;
    }

    header span {
        margin: 0 0 1em 1em;
        max-height: 25%;
        max-width: 60%;
        position: relative;
    }

    header img {
        max-height: 100%;
        max-width: 100%;
    }

    header input {
        cursor: pointer;
        --ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        height: 100%;
        left: 0;
        opacity: 0;
        position: absolute;
        top: 0;
        width: 100%;
    }

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
    .size{
        font-size:20px;
    }
    .btn{
        margin:30px 0px;
        padding:5px 10px;
    }
    </style>

</head>

<body>



    <?php

	$pid = $_GET['rid'];

	$sql ="SELECT reserve.reservation_id as reservation_id, room_type.name as name ,
	room_details.price as price ,reserve.prefix_name as prefix_name,reserve.fname as fname,
	reserve.lname as lname , reserve.phone as phone , reserve.day_reserve as day_reserve ,
	reserve.time_reserve as time_reserve,
	room_type.name as name ,reserve.day_checkin as day_checkin ,
	reserve.day_checkout as day_checkout , reserve.reserve_status as reserve_status , 
	reserve.proof_of_transfer as proof_of_transfer,reserve.reservation_money as reservation_money, room_details.reservation as dreserva,
	room_category.name AS cname,room_type.name AS 
	tname,bed_type.name AS bname,reserve.nodays,room_details.price, room_details.other, 
	reserve.refund,reserve.reason,reserve.room_count as room_count,
    reserve.car as car,reserve.color as color,reserve.license_plate as license_plate
	FROM `reserve` INNER JOIN room_details on(reserve.room_type = room_details.id)
	INNER JOIN room_category ON(room_details.reservation = room_category.id)
	INNER JOIN room_type on(room_details.type = room_type.id) 
	INNER JOIN bed_type on(room_details.bed = bed_type.id) 
	WHERE reserve.reservation_id = '$pid' ";
	
	$re = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($re))
	{
		$id = $row['reservation_id'];
		$title =  $row['prefix_name'];
		$Fname = $row['fname'];
		$lname = $row['lname'];
		$phone = $row['phone'];
		$room_type = $row['name'];
		$price_day = $row['price'];
		$reservation = $row['dreserva'];
		//$Noof_room = $row['Nroom'];
        $time_reserve = $row['time_reserve'];
		$cname = $row['cname'];
		$tname = $row['tname'];
		$bname = $row['bname'];

        $car = $row['car'];
		$color =  $row['color'];
		$license_plate = $row['license_plate'];
		
		$cin_date = $row['day_checkin'];    
		if($reservation == "1"){
			$cout_date = $row['day_checkout'];
		}
	

		$nodays = $row['nodays'];
        $room_count = $row['room_count'];
		$day_reserve = $row['day_reserve'];
		$status = $row['reserve_status'];
	
		$reservation_money = $row['reservation_money'];

		$price = $row['price'];
		$other = $row['other'];
		$refund = $row['refund'];
        $reason = $row['reason'];
		$proof_of_transfer = $row["proof_of_transfer"];

		$pap = "SELECT * FROM `paper_details`";
		$papa = mysqli_query($con,$pap);
		$rowp = mysqli_fetch_array($papa);
	}
				
	?>


    <table>
        <th style="font-size:22px"><center><b>ใบเสร็จการจองห้องพัก</b></center></th>
    </table>
    <br>
            <p style='font-size:19px'><?php echo $rowp['header'] ?></p>
            <p><?php echo $rowp['address'] ?><br>
                วันที่ทำการจอง : <?php list($y,$m,$d)=explode('-',$day_reserve); echo $d.'/'.$m.'/'.date($y+543) ." เวลา $time_reserve น.";?> <br>
                <br>
                สถานะการชำระเงิน : <?php if($status == "ชำระแล้ว"): ?><lable style="color:green"><?php echo $status;?></lable>
                <br>
                <?php endif ?>
                <?php if($status == "การจองผิดพลาด"): ?>
                <lable style="color:red">
                    <?php echo $status;?>
                </lable>
                <br>
                <br>
                <lable>
                    เหตุผล : <lable class="statusred"><?php echo $reason ?></lable>
                </lable>
                <?php endif ?>
            </p>
            <br>
            <table>
                <tr>
                    <th width="70%" colspan="2">
                        <address>
                            
                            <p class="size">ชื่อผู้จองsห้องพัก : <?php echo $title.$Fname." ".$lname;?><br></p>
                        </address>
                    </th>
                </tr>
                <tr>
                    <th><span>รหัสการจอง</span></th>
                    <td><span><?php echo $id; ?></span></td>
                </tr>
                <tr>
                    <th><span>วันที่เช็คอิน</span></th>
                    <td><span><?php list($y,$m,$d)=explode('-',$cin_date); echo$d.'/'.$m.'/'.date($y+543);?></span></td>
                </tr>
                <?php if($reservation == "1"): ?>
                <tr>
                    <th><span>วันที่เช็คเอาท์</span></th>
                    <td><span><?php list($y,$m,$d)=explode('-',$cout_date); echo$d.'/'.$m.'/'.date($y+543); ?> </span></td>
                </tr>
               
                <tr>
                    <th><span>เบอร์โทร์ลูกค้า </span></th>
                    <td><span><?php echo substr($phone,0,3)."-".substr($phone,3) ; ?> </span></td>
                </tr>
                <?php endif ?>

            </table>
            <table class="inventory">
            <thead>
                <tr>
                    <th colspan="2"><span>รายการ</span></th>
                    <th><span>จำนวน</span></th>
                    <th><span>ราคา</span></th>

                </tr>
            </thead>
            <tbody>

                <tr>

                    <td colspan="2"><span>ห้อง <?php echo $cname." ".$tname." ".$bname; ?></span></td>
                    <td><span
                            style="float: right;"><?php if($reservation == 1){ echo $nodays." วัน ";} else if($reservation == 2){echo "รายเดือน";} ?>
                        </span></td>
                    <td><span><?php echo $price; ?> บาท/วัน</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span>จำนวนห้อง </span></td>
                    <td><span style="float: right;"><?php echo $room_count." ห้อง";?></span></td>
                    
                    <?php if($reservation == 1):?>
                        <td><span><?php echo "($room_count * ($price * $nodays)) ". number_format($room_count*($price*$nodays));?> บาท</span></td>
                    <?php else:?>
                        <td><span><?php echo "($room_count * $price) ". number_format($room_count*$price);?> บาท</span></td>
                    <?php endif;?>
                </tr>
                <tr>
                    <td colspan="2"><span>ประกันห้อง </span></td>
                    <td><span style="float: right;"><?php echo $room_count." ห้อง";?></span></td>

                    <td><span><?php echo "($room_count * $other) ". number_format($other*$room_count); ?> บาท</span></td>
                    

                    <?php $sum_other = $room_count*$other?>
                </tr>
                <?php if($reservation == 1):?>
                    <?php $sum = $room_count*($price*$nodays)+$sum_other?>
                <?php else: ?>
                    <?php $sum = $room_count*$price+$sum_other?>
                <?php endif;?>
                <tr>
                    <td colspan="2"><span>ยานพาหนะ </span></td>
                    <td><span style="float: right;"><?php if($car == 'ไม่มี' or $car == ''){
                        echo "ไม่มี";
                    }else{
                        echo $car." สีรถ : ".$color." ทะเบียน : ".$license_plate;
                    }?></span></td>
                    <td><span>-</span></td>
                </tr>
                <tr>
                    <th colspan="3"><span>รวมทั้งสิ้น </span></th>
                    <td><span style="float: right;"><?php echo number_format($sum); ?> บาท</span></td>
                </tr>

                <?php if($status != "การจองผิดพลาด"): ?>
                <tr>

                    <td colspan="4"><span class="status">หลักฐานการโอนเงิน</span><br>
                            <center>
                                <img id="1" src="../assets/img/reservation/<?php echo $proof_of_transfer?>"
                                    class="resize" width="300px" height="300px">
                            </center>
                        
                        <div id="myModal" class="modal">
                            <center>
                                <img class="modal-content" id="img01" width="38%">
                            </center>
                        </div>

                    </td>

                </tr>

                <?php endif ?>
                <?php if($status == "การจองผิดพลาด"): ?>
                <tr>
                    <td colspan="2"><span class="status">หลักฐานการโอนเงิน</span>
                    <br><br>
                            <center>
                                <img id="1" src="../assets/img/reservation/<?php echo $proof_of_transfer?>"
                                    class="resize" width="300px" height="300px">
                            </center>
                        
                        <div id="myModal" class="modal">
                            <center>
                                <img class="modal-content" id="img01" width="38%">
                            </center>
                        </div>

                    </td>

                    <td colspan="2">
                        <span class="statusred">หลักฐานการโอนเงินคืน</span>
                        <br><br>
                            <center>
                                <img id="1" src="../assets/img/refund/<?php echo $refund?>" class="resize"
                                    width="300px" height="300px">
                            </center>
                        
                        <div id="myModal" class="modal">
                            <center>
                                <img class="modal-content" id="img01" width="38%">
                            </center>
                        </div>
                    </td>
                </tr>
                <?php endif ?>
                </tbody>
                </table>

                </article>
                <aside>
                <table>
                    <th style="font-size:22px"><center>ติดต่อเรา <p align="center"> โทร : <?php echo $rowp['phone_lessor'] ?> </p></center></th>
                </table>
                </aside>
                <a href="home.php" ><button class="hideWhenPrint btn">กลับหน้าหลัก</button></a>	
            <button  class="hideWhenPrint print btn" onclick="window.print()">พิมพ์ PDF</button>
</body>      
</html>
    <script>
        var modal = document.getElementById('myModal');
            {

            var img = document.getElementById('1');
            
            var modalImg = document.getElementById("img01");

            
            img.onclick = function() {
                modal.style.display = "block";
                modalImg.src = this.src;
                modalImg.alt = this.alt;

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
        // consloe.log(modal);
        var modal2 = document.getElementById('myModal2');
       
            {
            var img2 = document.getElementById('2');
            console.log(modal2);
            var modalImg = document.getElementById("img01");
                consloe.log(img);
            
            img2.onclick = function() {
                modal.style.display = "block";
                modalImg.src = this.src;
                modalImg.alt = this.alt;

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

ob_end_flush();

?>
