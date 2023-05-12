<?php ini_set('display_errors', false); ?>
<?php  
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 }  
include 'db.php';
include 'date.php';
if(!isset($_SESSION['premission']) == "Admin")
{
    session_destroy();
    header("location:/dormitory/homepage_log.php");
}
?> 
<?php if(isset($_GET['edit_lease']))

$id = $_GET['edit_lease'];
$tsql = "SELECT * from user WHERE personal = '$id'";
$tre = mysqli_query($con,$tsql);
$user = mysqli_fetch_array($tre);

$room = $user['room'];
$name = array("".$user['prefix_name']." ".$user['fname']." ".$user['lname']."");


$d = date("d");// เก็บวันที่สมัคร และเปลี่ยนปีเป็น พ.ศ
$m = date("m");
$y = date("Y");

$dob = $user['dob'];
list($year, $month, $day) = explode('-', $dob);

$age = $y - $year;
$phone = $user['phone'];
$address = $user['districts'];

if($user['rental_start_date'] != null or $user['rental_end_date'] != '0000-00-00'){
    list($y_start1,$m_start1,$d_start1) = explode('-', $user['rental_start_date']);
    $y_start1 = $y_start1+543;
}


$ssqlr = "SELECT districts.name_th as nameD, amphures.name_th as nameA,provinces.name_th as nameP,districts.zip_code as zip
FROM districts INNER JOIN amphures ON(districts.amphure_id = amphures.id) INNER JOIN provinces ON(amphures.province_id = provinces.id)
INNER JOIN user on(user.districts = districts.id)
WHERE user.districts = $address AND user.personal = '$id'";
$disc = mysqli_query($con,$ssqlr);
$provin = mysqli_fetch_array($disc);

$ttsql = "SELECT room_details.price as price,
paper_details.header as header,
paper_details.address as address,
paper_details.phone_lessor as L_phone,
room_details.other as other
FROM USER 
INNER JOIN room ON(user.room = room.room) 
INNER JOIN room_details ON(room.type = room_details.id) 
INNER JOIN  bed_type ON(room_details.bed = bed_type.id)
INNER JOIN paper_details on(room.paper = paper_details.id) 
WHERE room.room = $room";
$ttre = mysqli_query($con,$ttsql);
$type = mysqli_fetch_array($ttre);

?>
<?php
$thai_day_arr=array(" อาทิตย์ "," จันทร์ "," อังคาร "," พุธ "," พฤหัสบดี "," ศุกร์ "," เสาร์ ");
$thai_month_arr=array(
    "0"=>"",
    "1"=>"มกราคม",
    "2"=>"กุมภาพันธ์",
    "3"=>"มีนาคม",
    "4"=>"เมษายน",
    "5"=>"พฤษภาคม",
    "6"=>"มิถุนายน", 
    "7"=>"กรกฎาคม",
    "8"=>"สิงหาคม",
    "9"=>"กันยายน",
    "10"=>"ตุลาคม",
    "11"=>"พฤศจิกายน",
    "12"=>"ธันวาคม"                 
);
function thai_date($time){
    global $thai_day_arr,$thai_month_arr;
    $thai_date_return="วัน".$thai_day_arr[date("w",$time)];
    $thai_date_return.= "ที่ ".date("j",$time);
    $thai_date_return.=" เดือน ".$thai_month_arr[date("n",$time)];
    $year_new = date("Y")+543;
    $thai_date_return.= " พ.ศ. ".date("$year_new",$time);
    return $thai_date_return;
}
?>
<?php
  $sql = "SELECT * FROM provinces" ;
  $query_address = mysqli_query($con, $sql);
  
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">

     <!-- Template Main CSS File -->
    <script src="/dormitory/assets/jquery.min.js"></script>
    <script src="/dormitory/assets/script.js"></script>
  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการหอพัก</title>
	<!-- Bootstrap Styles-->

   
  
</head>
<style>
*{
    font-size: 14px ;
    padding: 3.81px;
    font-family: "itim";
    margin:0 auto;
}
  @media print {
    body {-webkit-print-color-adjust: exact;} /* กำหนดให้สีในหน้าเว็บสามารถพิมพ์ได้อย่างถูกต้อง*/
    .hideWhenPrint { /* เนื้อหาในคลาส hideWhenPrint จะถูกปิดตาทิ้งไปเมื่อพิมพ์บนกระดาษ*/
      display: none;
    }
  } 
  .button {
      background-color: #4CAF50; /* Green */
      border: 1px solid green;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      font-size: 18px;
      cursor: pointer;
  }

  .button:hover {
      background-color: #3e8e41;
  }
  .edit{
    background-color: red; /* Green */
      border: 1px solid black;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      font-size: 18px;
      cursor: pointer;
  }

  .edit:hover {
      opacity: 0.2;
  }
    .bnnc{
        background-color: green;
        color:white;
        padding:5px;
        border-radius: 5px;
        border: 1px solid;
        font-size: 20px;
    }
    .bnnt{
        background-color:#DCDCDC;
        color:green;
        padding:5px;
        border-radius: 5px;
        border: 1px solid;
    }
    .bnnc:hover,.bnnt:hover{
        background-color: red;
        color:white;
    }
    .tbs{
        padding:0px 5px;
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
        input{
            background-color: black;
            border: 1px solid black;
            color:white;
        }
        select{
            background-color: black;
            border: 1px solid black;
            color:white;
        }
        textarea{
            background-color: black;
            border: 1px solid black;
            color:white;
        }
    .save{
        background-color: green; /* Green */
        color: white;
        font-size: 18px;
        cursor: pointer;
        margin:10px;
    }.save:hover {
        color:black;
        opacity: 0.2;
        
    }
    .delete{
        background-color: red; /* Green */
      border: 1px solid black;
      color: white;
      text-align: center;
      text-decoration: none;
      font-size: 18px;
      cursor: pointer;
      float:right;
  }

  .delete:hover {
      opacity: 0.2;
  }
  body { box-sizing: border-box; height: 11in; margin: 0 auto;  padding: 0.5in; width: 8.5in; }
</style>
<body style="padding: 0px 50px">
<center>
<form method="post" name="frmMain" onSubmit="JavaScript:return fncSubmit();">
<table  style="border:1px solid black"  width="100%">
  <tr>
    <!-- <td colspan="3"><div style="float:right">ห้องพักหมายเลข 
    <select name="room_edit"></select>
    <?php
        $ddb = "SELECT * FROM room";
        $ddt = mysqli_query($con, $ddb);
        while($rrm = mysqli_fetch_array($ddt)){
            echo "<option value='".$rrm['room']."'>".$rrm['room']."</option>";
        }
    ?>
    </select>
    </td> -->
    <td colspan="3"><div style="float:right">ห้องพักหมายเลข <abbr title=""><?php  if(empty($room)){echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";}else{echo $room;} ?></abbr></div></td>
  </tr>
  <tr>
    <td colspan="3"><center>
        <div>
            <b style="font-size:20px">สัญญาเช่าห้องพัก 
                <span class='input-wrap'>
                    <span style="font-size:20px" class='width-machine' aria-hidden='true' name='header_edit'><?php echo $type['header']?></span>
                    <input style="font-size:20px" class='input' value='<?php echo $type['header']?>' type='text' name='header_edit'  required>
                </span> </div>
            </b>
        </div>
        <div>   <span class='input-wrap'>
                    <span class='width-machine' aria-hidden='true' name='address_edit'><?php echo $type['address']?></span>
                    <input class='input' value='<?php echo $type['address']?>' type='text' name='address_edit'  required>
                </span> </div>
        <div>โทร.   
            <span class='input-wrap'>
                <span class='width-machine' aria-hidden='true' name='phone_own'><?php echo $type['L_phone']?></span>
                <input class='input' value='<?php echo $type['L_phone']?>' type='text' name='phone_own'  required>
            </span> </div></div>
    </td></center>
    <tr>
        <td colspan="3"><lable style="float:right"><abbr title=""><?php echo  thai_date($eng_date)?></abbr></lable></td>
    </tr>
    <tr>
        <td colspan="3">ข้าพเจ้า <labke><abbr  title="">&nbsp<?php echo $name[0]?>&nbsp</abbr></labke>
        อายุ <lable><abbr  title="">&nbsp<?php echo $age?>&nbsp</lable>
        โทร <lable><abbr  title="">&nbsp<?php echo $phone?>&nbsp</lable></td>
    </tr>
    <tr>
        <td colspan="3">ที่อยู่ <abbr  title="">&nbsp&nbsp&nbsp ตำบล.<?php echo $provin['nameD']?>&nbsp&nbsp&nbsp
        <abbr  title="">&nbsp อำเภอ.<?php echo $provin['nameA']?>&nbsp
        <abbr  title="">&nbsp จังหวัด.<?php echo $provin['nameP']?>&nbsp
        <abbr  title="">&nbsp <?php echo $provin['zip']?>&nbsp
        </td>
    </tr>
    <tr>
    <td colspan="3">
<lable>แก้ไขที่อยู่</lable>
            <select name="province_id" id="province" class="form-control">
                <option value="" class="fontcity">กรุณาเลือก จังหวัด</option>
                <?php while($result = mysqli_fetch_assoc($query_address)): ?>
                    <option value="<?=$result['id']?>"><?= $result['name_th'] ?></option>
                <?php endwhile; ?>
            </select>


            <select name="amphure_id" id="amphure" class="form-control" >
                <option value="" class="fontcity">กรุณาเลือก อำเภอ</option>
            </select>

            <select name="district_id" id="district" class="form-control" >
                <option value="" class="fontcity">กรุณาเลือก ตำบล</option>
            </select>
        </td>
    </tr>
        <tr>
            <td colspan="3">เลขที่บัตรประชาชน <abbr  title="">&nbsp&nbsp&nbsp<?php echo base64_decode($id)?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>
          </td>
        </tr>

        
    <tr>
        <td colspan="3"><blockquote cite="ChillChillJapan : https://chillchilljapan.com/">  โดยข้าพเจ้าและผู้ร่วมอาศัยยินยอมปฏิบัติตามกฏระเบียบดังนี้</blockquote></td>
    </tr>
  </tr>
  <tr>
      <td colspan="3">
                

         <?php
             $sql = "SELECT * FROM `rule` WHERE type = 2";
             $sqlA = mysqli_query($con,$sql);
             $i = 1;
             while ($row = mysqli_fetch_array($sqlA)){
                    $data = $row['data'];
                    $rule_id = $row['id'];
                    echo $i.'.';
                    echo '<textarea name="rule[ ]"  style="width:100%" >'.$data.'</textarea>';
                    echo '<input type="hidden"  name="data[ ]" value="'.$rule_id.'">';
                    echo '<button name="delete[ ]" value="'.$rule_id.'" class="delete" onclick="return confirm(\'คุณต้องการลบกฏข้อ '.$i.' ใช่หรือไม่?\')">ลบ</button>';
                    echo "<br>";
                    $i ++ ;
             }
             
         ?>
       
            <table width="100%" border="1" id="tbExp">
            <tr>
                <td><div align="center">เพิ่มกฏ</div></td>
            </tr>
            </table>
            <input type="hidden" name="hdnMaxLine" value="0" >
            <input name="btnAdd" type="button" id="btnAdd" value="+" onClick="CreateNewRow();">
            <input name="btnDel" type="button" id="btnDel" value="-" onClick="RemoveRow();">
            <button class="save" name="save_rule" onclick="return confirm('ยืนยันการเพิ่งกฏใหม่ใช่หรือไม่?')">บันทึก กฏ ใหม่</button>
        
      </td>
  </tr>
  <tr>
    <td colspan="3" > 
    

        <br><blockquote cite="ChillChillJapan : https://chillchilljapan.com/">หากข้าพเจ้าประพฤติผิดสัญญาอย่างใดอย่างหนึ่ง ข้าพเจ้ายินยอมให้ตักเตือนและจะปฏิบัติตามให้ถูกต้อง ตามสัญญาทันทีอย่างเคร่งครัด รวมทั้งในกรณีผู้ให้เช่าไม่สามารถยอมรับในการกระทำกรณีนั้น ๆ ได้ ผู้เช่ายินยอมให้ ผู้ให้เช่าบอกเลิกสัญญาได้ทันที และยินยอมที่จะย้ายออกภายใน 5 วันหลังจากบอกเลิกสัญญา และในกรณีที่ไม่สามารถ ย้ายออกได้ตามกำหนด ข้าพเจ้ายินยอมให้ขนทรัพย์ออกจากห้องพักมาไว้บริเวณใต้ที่พัก โดยผู้เช่าจะดูแลทรัพย์สินหลังจากขนย้ายออกจากห้องพักเอง ซึ่งผู้ให้เช่าไม่ต้องรับผิดชอบความเสียหายของทรัพย์สินภายในห้องและที่ขนออกจากห้อง</blockquote>
        <br><blockquote cite="ChillChillJapan : https://chillchilljapan.com/">สัญญานี้ได้ทำเอาไว้เป็นหลักฐาน 2 ฉบับ โดยให้ผู้เช่าและผู้ให้เช่าเก็บไว้ฝ่ายละ 1 ฉบับ เพื่อเป็นหลักฐานในการเช่า ข้าพเจ้าได้อ่ายและเข้าใจข้อความนี้ดีแล้วและได้ลงชื่อไว้เป็นหลักฐาน ทั้งนี้ได้แนบสำเนาบัตรประชาชนของข้าพเจ้าและผู้ร่วมอาศัยประกอบในสัญญาด้วย โดยข้าพเจ้าได้ตรวจดูแล้วว่าสภาพห้องพักดังกล่าวอยู่ในสภาพสะอาดเรียบร้อยดี</blockquote>

    </td>
  </tr>
  <tr>
      <td>ลงชื่อ .......................................... ผู้เช่า</td>
      <td colspan="2" align="right">ลงชื่อ .......................................... ผู้เช่า</td>
  </tr>
  <tr>
      <td>(<abbr title="">&nbsp&nbsp&nbsp&nbsp<?php echo $name[0]?>&nbsp&nbsp&nbsp&nbsp</abbr>)</td>
      <td colspan="2" align="right">(<abbr title="">&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $name[0]?>&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>)</td>
  </tr>
  <tr>
      <td></td>
      <td colspan="2" align="right"><br>ลงชื่อ ...................................... ผู้ให้เช่า</td>
  </tr>
  <tr>
      <td></td>
      <td colspan="2" align="right">(<abbr title="">&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $_SESSION['prefix_name_A']." ".$_SESSION['fname_A']." ".$_SESSION['lname_A']  ;?>&nbsp&nbsp&nbsp&nbsp&nbsp</abbr>)</td>
  </tr>
  <tr>
      <td></td>
      <td colspan="2" align="right"><br>ลงชื่อ ......................................... พยาน</td>
  </tr>
  <tr>
      <td></td>
      <td colspan="2" align="right">(.........................................................)</td>
  </tr>
</table>
<button style="margin-top:30px;" class="hideWhenPrint edit" name="save_lease" onclick="return confirm('คุณต้องการบันทึกการเปลี่ยนแปลง ใช่หรือไม่?')">บันทึกการแก้ไข</button></a>
</form>
<a href="/dormitory/admin/lease.php?lease=<?php echo $id?>"><button class="button"  >กลับหน้าเก่า</button></a>


</body>
</html>
<?php
    if(isset($_POST['save_lease'])){

        $sqq = "SELECT * FROM `room`";
        $ssq = mysqli_query($con,$sqq);
        
        while($rowsq = mysqli_fetch_array($ssq)){
            $head_in = $rowsq['header'];
            $address_in = $rowsq['address'];
            $phone_in = $rowsq['phone_lessor'];
        }


        $header = $_POST['header_edit'];
        $address = $_POST['address_edit'];
        $phone_own = $_POST['phone_own'];


        $district = $_POST['district_id'];

        $rule = $_POST['rule'] ;  
   

            echo"<br>";
            echo $header;
            echo"<br>";
            echo $address;
            echo"<br>";
            echo $phone_own;
            echo"<br>";
            echo $age;
            echo"<br>";
            echo $phone;
            echo"<br>";
            echo $district;
            echo"<br>";
            echo $head_in;
            echo"<br>";
            echo $address_in;
            echo"<br>";
            echo $phone_in;
            echo"<br>";
            $data = array($_POST['data']);

            $count=sizeof($data[0]);
            echo $count.'<br>';
            foreach( $rule as $i => $rule_inv ) {
                if(!empty($rule_inv)){
                     $data_inv = $_POST['data'][$i];

                    echo $data_inv.'.'.$rule_inv;
                    echo "<br>";
                    mysqli_query ($con,"UPDATE `rule` SET `data`='$rule_inv' WHERE id = $data_inv");
                }
               
            }

            if(!empty($header)){
                mysqli_query ($con,"UPDATE `paper_details` SET `header`='$header',`address`='$address',`phone_lessor`='$phone_own' 
                WHERE header = '$head_in'");
               
            }
                       
            if(!empty($district)){
                mysqli_query ($con," UPDATE `user` SET `districts`='$district'WHERE personal = '$id'");
                echo "<script type='text/javascript'> alert('แก้ไขข้อมูล ที่อยู่สำเร็จ')</script>"; 
             }
            echo "<script type='text/javascript'> window.location='edit_lease.php?edit_lease=$id'</script>";


        
}

if(isset($_POST['save_rule'])){
   if(!empty($_POST['Column'])){
        $rule_add = $_POST['Column'];
        foreach( $rule_add  as $sum ) {
                                                   
            
            echo $sum;
            $sqli = "INSERT INTO `rule`(`type`, `data`) VALUES ('2','$sum')";
            mysqli_query($con,$sqli);              

    
        }
        foreach ($rule_add as $sum) {  

            $sqlie = "INSERT INTO event_log (personal,date,time,event) 
            VALUES ('".$_SESSION['personal_admin']."', '$date','$time','".$_SESSION['fname_A']." ".$_SESSION['lname_A']." เพิ่มกฏ $sum ')";
            mysqli_query($con,$sqlie);
            echo "<script type='text/javascript'> window.location='edit_lease.php?edit_lease=$id'</script>";
        }

    }
       

}

if(isset($_POST['delete'])){

    $del_rule = $_POST['delete'];
   
        foreach( $del_rule  as $sum ) {
          
            echo $sum;
            $sql = "DELETE FROM `rule` WHERE id = '$sum'";
            $con->query($sql);

            $sqlie = "INSERT INTO event_log (personal,date,time,event) 
            VALUES ('".$_SESSION['personal_admin']."', '$date','$time','".$_SESSION['fname_A']." ".$_SESSION['lname_A']." ลบกฏข้อที่ $sum ')";
            mysqli_query($con,$sqlie);
         

        }
        echo "<script type='text/javascript'> window.location='edit_lease.php?edit_lease=$id'</script>";
        // foreach ($del_rule as $sum) {  

        //     $sqlie = "INSERT INTO event_log (personal,date,time,event) 
        //     VALUES ('".$_SESSION['personal']."', '$date','$time','".$_SESSION['fname']." ".$_SESSION['lname']." ลบกฏข้อที่ $sum ')";
        //     mysqli_query($con,$sqlie);
        //     echo "<script type='text/javascript'> window.location='edit_lease.php?edit_lease=$id'</script>";
        // }
}
?>


<script language="javascript">
	function CreateNewRow()
	{
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
	
	function RemoveRow()
	{
		intLine = parseInt(document.frmMain.hdnMaxLine.value);
		if(parseInt(intLine) > 0)
		{
				theTable = (document.all) ? document.all.tbExp : 
				document.getElementById("tbExp")
				theTableBody = theTable.tBodies[0];
				theTableBody.deleteRow(intLine);
				intLine--;
				document.frmMain.hdnMaxLine.value = intLine;
		}	
	}	
</script>
