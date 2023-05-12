<?php ini_set('display_errors', false); ?>
<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    include 'db.php';
    include 'date.php';
    include 'query.php';
    if(!isset($_SESSION['premission']) == "Admin")
    {
        session_destroy();
        header("location: ../index.php");
    }
    $ccv = mysqli_fetch_array($last_date_unit);

    list($y,$m,$d) = explode("-",$ccv['date_check']);

    $m = $m-1;
    // $m=(int)date('m')-1;
    // $y=(int)date('Y');
    // $d=(int)date('d');
    if($m == 0){
        $y = $y - 1; 
        $m = 12; 
        
    }
    $d = (string)$d;
    if($d <= 9){
        $d = "0$d";
    }
    if($m <= 9){
        $m = "0$m";
    }

?>

<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/image.css">
		<style>
		/* reset */

*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }


table { font-size: 75%;  width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }

/* page */

html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
html { background: #999; cursor: default; }

body { box-sizing: border-box; height: 6.5in; margin: 0 auto; overflow: hidden; padding: 0.2in; width: 8.5in; }
body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

/* header */





/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }

/* table items */

table.inventory { clear: both; width: 100%; }
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }

/* javascript */

.add, .cut
{
	border-width: 1px;
	display: block;
	font-size: .8rem;
	padding: 0.25em 0.5em;	
	float: left;
	text-align: center;
	width: 0.6em;
}

.add, .cut
{
	background: #9AF;
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
	background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
	border-radius: 0.5em;
	border-color: #0076A3;
	color: #FFF;
	cursor: pointer;
	font-weight: bold;
	text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}

.add { margin: -2.5em 0 0; }

.add:hover { background: #00ADEE; }

.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
.cut { --webkit-transition: opacity 100ms ease-in; }

tr:hover .cut { opacity: 1; }

@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }
    body {-webkit-print-color-adjust: exact;} /* กำหนดให้สีในหน้าเว็บสามารถพิมพ์ได้อย่างถูกต้อง*/
    .hideWhenPrint { /* เนื้อหาในคลาส hideWhenPrint จะถูกปิดตาทิ้งไปเมื่อพิมพ์บนกระดาษ*/
      display: none;
    }
}

@page { margin: 0; }

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
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
		
	</head>
	<body>
	
	
	
	
	<?php
	ob_start();	

	$pid = $_GET['bills'];

    $date_check_month =  "$y-$m-$d";

    $qli = mysqli_query($con,"SELECT * FROM unit WHERE MONTH(date) >= '$m' and MONTH(date) < '$m_now' and YEAR(date) >= '$y' and room = '$pid'");
    $dck = mysqli_fetch_array($qli);

    $urd = mysqli_query($con,"SELECT * FROM user INNER JOIN room on(user.room = room.room) 
    INNER JOIN room_details on(room_details.id = room.type) WHERE room.room = '$pid'");

    if($user1 = mysqli_fetch_array($urd)){

    }else{
        $urd = mysqli_query($con,"SELECT * FROM room 
        INNER JOIN room_details on(room_details.id = room.type) WHERE room.room = '$pid'");
        $user1 = mysqli_fetch_array($urd);
    }
    
    $check_unit = mysqli_query($con,"SELECT * FROM unit WHERE room = '$pid'");
    $num = mysqli_num_rows($check_unit); 
    if($num == 0)   		
    {
        echo "<script type='text/javascript'> alert('กรุณาเพิ่มข้อมูล ค่าน้ำ/ไฟ ก่อนจะพิมพ์ใบเสร็จ')</script>";
        echo "<script type='text/javascript'> window.location='month.php'</script>";
       
       
    }
        // if($unit_check['room'] == $pid){
        //    
        // }elseif($unit_check['room'] != $pid){
            
        //     echo "<script type='text/javascript'> alert('กรุณาเพิ่มข้อมูล ค่าน้ำ/ไฟ ให้ถูกต้อง')</script>";
        // }

   
    
	$row=mysqli_fetch_array($paper_all);
    $header = $row['header'];
    $address = $row['address'];
    $phone_own = $row['phone_lessor'];	
    $user1['reservation'];					
	?>
    
    <?php if(isset($user1['reservation'])):?> 

        <?php if(isset($pid)){
            $eer = mysqli_query($con,"SELECT room_category.name as name
            FROM  room 
            INNER JOIN room_details on(room_details.id = room.type)
            INNER JOIN room_category on(room_category.id = room_details.reservation)
            WHERE room.room = '$pid' GROUP BY room_category.name");
                
            $check = mysqli_fetch_array($eer);
            $check_room = $check['name'];
        }
        ?>
    <?php endif; ?>

    <?php


    $drd = mysqli_query($con,"SELECT * FROM `unit` WHERE date = '".$ccv['date_check']."' AND room = '$pid' ");   
    $trow=mysqli_fetch_array($drd);

    $userid2 = mysqli_query($con,"SELECT * FROM room WHERE room = $pid");
    $user2 = mysqli_fetch_array($userid2);

    $receiptId = mysqli_query($con,"SELECT * FROM `receipt` WHERE date = '".$ccv['date_check']."' AND room = $pid");
    $receipt = mysqli_fetch_array($receiptId);

    ?>

    <?php if(isset($check_room) != 'รายวัน'){
        echo '<center>';
        echo '<h1>กรุณาเลือกเฉพราะห้อง "รายเดือน" </h1>';
        echo '<h1>ห้องที่มี "ผู้พักอาศัย"</h1>';
        echo '<h1>และห้องที่มี "การกำหนดค่าน้ำ/ไฟ แล้ว"</h1>';
        echo '</center>';
    }
    ?>

    <?php list($y_max,$m_max,$d_max) = explode("-",$ccv['date_check']);?>

    <?php if(isset($check_room) == 'รายเดือน'):?>
		<header>
			<table border="1"  width="100%">
                <tr>
                    <td width="65%" colspan="3">
                        <h2><?php echo $header; ?></h2>
                        ที่อยู่. <lable><?php echo $address; ?></lable><br>
                        โทร. <lable><?php echo $phone_own; ?></lable>
                    </td>
                        <td colspan="2">
                            <h3>ใบแจ้งหนี้/ใบเสร็จ</h3>
                            <div>เลขใบเสร็จ(Doc No.): <?php echo $receipt['pay_id']; ?></div>
                            <lable>วันที่ออกใบเสร็จ(Date): <?php echo $d_now."/".$m_now.'/'.($y_now+543);?></lable>
                            <div>ช่วงวันที่จดมิตเตอร์: <?php echo $d.'/'.$m.'/'.($y+543) ;?> ถึง <?php echo $d_max.'/'.$m_max.'/'.($y_max+543);?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php
                            //ชื่อนามสกุล
                            $userid3 = mysqli_query($con,"SELECT * FROM user WHERE room = $pid"); 
                            $userid = mysqli_query($con,"SELECT * FROM user WHERE room = $pid"); 

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
                        <h4>ห้อง(Room No.): <lable style="float:right"><?php echo $pid;?></lable></h4>
                    </td>
                </tr>
                <tr>
                    <th width="5%" style="text-align:center;">ลำดับ</th>
                    <th style="text-align:center;">รายการ</th>
                    <th style="text-align:center;"><span >จำนวนหน่วย</span></th>
                    <th style="text-align:center;"><span >ราคาต่อหน่วย</span></th>
                    <th style="text-align:center;"><span >จำนวนเงิน</span></th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>ค่าเช่าห้องพัก(Room Rate)</td>
                    <td></td>
                    <?php $price=$user1['price']?>
                    <td style="text-align:right;"><?php echo  number_format( $price , 2 );?></td>
                    <td style="text-align:right;"><?php echo  number_format( $price , 2 );?></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>ค่ากระแสไฟฟ้า(Electrictiy Charge)</td>
                    <?php $unit_totalE = $trow['last_unit_electricity'] - $dck['last_unit_electricity']; ?>
                    <?php $sumE = $unit_totalE * $user2['unitPerElectricity'];?>
                    <td style="text-align:right;"><?php echo number_format( $unit_totalE , 2 );?></td>
                    <td style="text-align:right;"><?php echo number_format($user2['unitPerElectricity'],2);?></td>
                    <td style="text-align:right;"><?php echo  number_format( $sumE , 2 );?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp&nbsp&nbsp เลขอ่านครั้งก่อน(Pervious Charge)</td>
                    <td><?php echo number_format($dck['last_unit_electricity'],2);?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp&nbsp&nbsp เลขอ่านครั้งหลัง(Current Charge)</td>
                    <td><?php echo number_format($trow['last_unit_electricity'],2);?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>ค่าน้ำประปา (Tab Water Charge)</td>
                    <?php $unit_totalW = $trow['last_unit_water'] - $dck['last_unit_water']; ?>
                    <?php $sumW = $unit_totalW * $user2['unitPerWater'];?>
                    <td style="text-align:right;"><?php echo  number_format( $unit_totalW , 2 );?></td>
                    <td style="text-align:right;"><?php echo number_format($user2['unitPerWater'],2);?></td>
                    <td style="text-align:right;"><?php echo  number_format( $sumW , 2 );?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp&nbsp&nbsp เลขอ่านครั้งก่อน(Pervious Charge)</td>
                    <td ><?php echo number_format($dck['last_unit_water'],2);?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp&nbsp&nbsp เลขอ่านครั้งหลัง(Current Charge)</td>
                    <td><?php echo number_format($trow['last_unit_water'],2);?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>ค่าอื่นๆ (Other Charge)</td>
                    <td></td>
                    <?php $other = $trow['other'];?>
                    <td style="text-align:right;"><?php echo number_format( $trow['other'] , 2 );?></td>
                    <td style="text-align:right;"><?php echo number_format( $other , 2 );?></td>
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
                    <?php $sum = $price+$sumE+$sumW+$other?>
                    <td style="text-align:right;"><?php echo  number_format( $sum , 2 );?></td>
                </tr>
            </table>
            <br>
            <table border="0">
                <tr>
                    <td><br> ลงนาม..................................................(ผู้จ่ายเงิน)</td>
                    <td style="text-align:right"><br> ลงนาม..................................................(ผู้รับเงิน)</td>
                </tr>
                <tr>
                    <td colspan="2" style="color:red">หมายเหตุ : <?php echo $user2['note']?></td>
                </tr>
            </table>
            
            <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content" >
                <span class="close">&times;</span>
                <form method="post">
                <lable style="color:red">ข้อความเก่า หมายเหตุ : <?php echo $user2['note']?></lable>
                <div><br>
                    <input type="hidden" name="pay_id" value="<?php echo $user2['pay_id']; ?>">
                    <textarea style="width:100%" name="text_value" required><?php echo $user2['note']?></textarea>
                    <input type="submit" name="log" value="แก้ไข" class="btn btn-primary" onclick="return confirm('ยืนยันการแก้ไข')">
                </div>
            </div>
            </form>
            </div>

            <?php endif; ?>	
            <a href="month.php" ><button class="hideWhenPrint button"  style="margin:20px auto;margin-right:20px">กลับหน้าหลัก</button></a>	
            <button style="margin:20px auto;" class="hideWhenPrint print" onclick="window.print()">พิมพ์ PDF</button>
            <button class="hideWhenPrint button"  id="myBtn">แก้ไขหมายเหตุ</button>
	</body>
</html>
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
<?php
 if(isset($_POST['log'])){
    $text_value = $_POST['text_value'];
    $pay_id = $_POST['pay_id'];
    if($text_value != null){
        mysqli_query($con,"UPDATE `room` SET `note`='$text_value' WHERE room = $pid ");
        echo "<script type='text/javascript'> window.location='bills.php?bills=$pid'</script>";

        $sqlie = "INSERT INTO event_log (personal,date,time,event) 
        VALUES ('".$_SESSION['personal_admin']."', '$date','$time','".$_SESSION['fname_A']." ".$_SESSION['lname_A']." แก้ไขข้อมูล หมายเหตุ เลขห้อง $pid')";
        mysqli_query($con,$sqlie);

    }else{
        echo "<script type='text/javascript'> alert('กรุณาใส่ข้อมูลในช่องว่าง')</script>";
    }
 }
?>
<?php 

ob_end_flush();

?>