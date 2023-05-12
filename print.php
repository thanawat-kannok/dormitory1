<?php 
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
include ('server.php');
?>

<?php if (isset($_GET['rid']))

$rrid = $_GET['rid'];
$rid = base64_decode(substr($rrid, 4));

?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap" rel="stylesheet">

<style>
* {
    border: 0;
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
    box-sizing: border-box;
    font-family: 'Prompt', sans-serif;
    font-weight: bold;  
}

.status {
    border: 1px solid black;
    background-color: green;
    color: white;
    border-radius: 5px;
    padding:0px 5px;
}

.status1 {
    border: 1px solid black;
    background-color: red;
    color: white;
    border-radius: 5px;
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
    box-sizing: border-box;
    height: 12in;
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
</style>
<html>

<head>
    <meta charset="utf-8">
    <title>ระบบจัดการหอพัก</title>
    <link rel="stylesheet" href="/index/dormitory/css/image.css">

</head>

<body>

    <?php
	ob_start();	
	
	$sql ="SELECT reservation_id,prefix_name,fname,lname,phone,day_reserve,day_checkin,day_checkout,
	reservation_money,reserve_status,proof_of_transfer,room_category.name AS cname,room_type.name AS 
	tname,bed_type.name AS bname,reserve.pay, reserve.nodays, room_details.price, room_details.other, 
	reserve.refund, room_details.reservation,reserve.car as car,reserve.color as color,reserve.license_plate as license_plate
    FROM reserve INNER JOIN room_details ON(reserve.room_type = room_details.id) 
	INNER JOIN room_category ON(room_details.reservation = room_category.id) INNER JOIN room_type 
	ON(room_details.type = room_type.id) INNER JOIN bed_type ON(room_details.bed = bed_type.id) where reserve.reservation_id = $rid ";
	$re = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($re))
	{
		
		$title =  $row['prefix_name'];
		$Fname = $row['fname'];
		$lname = $row['lname'];
		$phone = $row['phone'];
	
		$cname = $row['cname'];
		$tname = $row['tname'];
		$bname = $row['bname'];

		$day_reserve = $row['day_reserve'];
		$cin_date = $row['day_checkin'];
		$cout_date = $row['day_checkout'];
		$reservation_money = $row['reservation_money'];
		$pay = $row['pay'];
		$status = $row['reserve_status'];
		$nodays = $row['nodays'];
		$proof_of_transfer = $row["proof_of_transfer"];

        $car = $row['car'];
		$color =  $row['color'];
		$license_plate = $row['license_plate'];

		$price = $row['price'];
		$other = $row['other'];
		$refund = $row['refund'];
		$reservation = $row['reservation'];

		$pap = "SELECT * FROM `paper_details` WHERE 1";
		$papa = mysqli_query($con,$pap);
		$rowp = mysqli_fetch_array($papa);
	}
	
									
	?>

    <header>
        <button style="margin:20px auto; background-color:green;color:white;padding:10px;border-radius:5px" class="hideWhenPrint print"
            onclick="window.print()">ดาวน์โหลด PDF</button>
        <h1>ใบเสร็จการจองห้องพัก</h1>
        <address>
            <p><?php echo $rowp['header'] ?></p>
            <p><?php echo $rowp['address'] ?><br>
                วันที่ทำการจอง : <?php list($y,$m,$d)=explode('-',$day_reserve); echo $d.'/'.$m.'/'.date($y+543);?><br>
                สถานะการจอง : <?php if($status == "รออนุมัติ"): ?><lable class="status"><?php echo $status;?></lable>
                <?php endif ?><?php if($status == "การจองผิดพลาด"): ?><lable class="status1"><?php echo $status;?>
                </lable><?php endif ?> </p>
        </address>
    </header>
    <article>
        <address>
            <p>ชื่อผู้จองห้องพัก : <?php echo $title.$Fname." ".$lname;?></p>
        </address>
        <table class="meta">
            <tr>
                <th><span>รหัสการจอง</span></th>
                <td><span><?php echo $rid; ?></span></td>
            </tr>
            <tr>
                <th><span>วันที่เช็คอิน</span></th>
                <td><span><?php list($y,$m,$d)=explode('-',$cin_date); echo$d.'/'.$m.'/'.date($y+543);?></span></td>
            </tr>
            <?php if($reservation == 1): ?>
            <tr>
                <th><span>วันที่เช็คเอาท์</span></th>
                <td><span><?php list($y,$m,$d)=explode('-',$cout_date); echo$d.'/'.$m.'/'.date($y+543); ?> </span></td>
            </tr>
            <?php endif ?>

        </table>
        <table>
            <tr>
                <td>เบอร์โทรผู้จองห้องพัก : - <?php echo $phone; ?> </td>
            </tr>

        </table>


        <table class="inventory">
            <thead>
                <tr>
                    <th><span>รายการ</span></th>
                    <th><span>จำนวน</span></th>
                    <th><span>ราคา</span></th>

                </tr>
            </thead>
            <tbody>

                <tr>
                    <td><span>ห้อง <?php echo $cname." ".$tname." ".$bname; ?></span></td>
                    <td><span><?php if($reservation == 1){ echo $nodays." วัน ";} else if($reservation == 2){echo "รายเดือน";} ?>
                        </span></td>
                    <td><span><?php echo $price; ?> บาท/วัน</span></td>


                </tr>
                <tr>
                    <td><span>ประกันห้อง </span></td>
                    <td><span> -</span></td>
                    <td><span><?php echo $other; ?> บาท</span></td>


                </tr>
                <tr>
                    <td><span>ยานพาหนะ </span></td>
                    <td><span style="float: right;"><?php if($car == 'ไม่มี' or $car == ''){
                        echo "ไม่มี";
                    }else{
                        echo $car." สีรถ : ".$color." ทะเบียน : ".$license_plate;
                    }?></span></td>
                    <td><span>-</span></td>
                </tr>
                <tr>

                    <th colspan="2"><span>รวมทั้งสิ้น </span></th>
                    <td><span style="float: right;"><?php echo $reservation_money; ?> บาท</span></td>

                </tr>
                <center>
                    <?php if($status == "รออนุมัติ"): ?>
                    <td colspan="3"><span class="status">หลักฐานการโอนเงิน</span><br>
                            <center>
                                <img id="myImg" src="assets/img/reservation/<?php echo $proof_of_transfer?>"
                                    class="resize" width="320px" height="320px">
                            </center>
                        
                        <div id="myModal" class="modal" >
                            <center>
                                <img class="modal-content" id="img01" width="38%" >
                            </center>
                        </div>
                    </td>

                    <?php endif ?>
                    <?php if($status == "การจองผิดพลาด"): ?>
                    <td colspan="3"><span class="status">หลักฐานการโอนเงิน<br>
                            <center>
                                <img id="myImg" src="assets/img/reservation/<?php echo $proof_of_transfer?>"
                                    class="resize" width="320px" height="320px">
                            </center>
                        </span>
                        <div id="myModal" class="modal">
                            <center>
                                <img class="modal-content" id="img01" width="38%">
                            </center>
                        </div>
                    </td>
                    <td colspan="3"><span class="status1">หลักฐานการโอนเงินคืน<br>
                            <center>
                                <img id="myImg" src="assets/img/refund/<?php echo $refund?>" class="resize"
                                    width="300px" height="300px">
                            </center>
                        </span>
                        <div id="myModal" class="modal">
                            <center>
                                <img class="modal-content" id="img01" width="38%">
                            </center>
                        </div>
                    </td>
                    <?php endif ?>


                    <script>
                    // Get the modal
                    var modal = document.getElementById('myModal');

                    // Get the image and insert it inside the modal - use its "alt" text as a caption
                    var img = document.getElementById('myImg');
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
                    </script>
                </center>

            </tbody>
        </table>


    </article>
    <aside>
        <h1><span>ติดต่อเรา</span></h1>
        <div>
            <p align="center"> โทร :- <?php echo $rowp['phone_lessor'] ?> </p>
        </div>
    </aside>

</body>

</html>

<?php 

ob_end_flush();

?>