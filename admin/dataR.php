<?php  
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include 'db.php';
include 'query.php';
if(!isset($_SESSION['premission']) == "Admin")
{
    session_destroy();
    header("location: ../index.php");
}
?> 
<?php if(isset($_GET['dataR']))

$id = $_GET['dataR'];

    
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ระบบจัดการหอพัก</title>
    <link href="css/register.css" rel="stylesheet">
  <link rel="stylesheet" href="/dormitory/css/image.css">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap" rel="stylesheet">  

</head>
<style>
        body{

        font-family: 'Prompt', sans-serif;
        font-weight: bold;
        }
    b{
        color:#339900;
    }
    .th{
        background-color:#DCDCDC;
    }
    .td{
        background-color:#5F9EA0;
        color:white;
    }
    .text{
        color:white;
        text-align:left;
    }
</style>
<script>
function chk_pic() {
    var file = document.upfile.fileupload.value;
    var patt = /(.jpg|.png)/;
    var result = patt.test(file);
    if (!result) {
        alert('เพิ่มรูปผิดพลาด (เพิ่มรูปภาพ นามสกุล png,jpg เท่านั้น)');
    }
    return result;        
}
</script>
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
                <a class="navbar-brand" href="home.php" style="width:300px"> <?php echo $hd['header']?></lable> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i><?php echo $_SESSION["fname_A"]; ?>&nbsp <lable><?php echo $_SESSION["lname_A"]; ?> <i class="fa fa-caret-down"></i>
                        <span class="badge" style="background-color:red"><?php echo $_SESSION["premission_A"]; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                    <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../logout.php"  onclick="return confirm('ยืนยันการออกจากระบบ')"><i class="fa fa-sign-out fa-fw" ></i> Logout</a>
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
                        <a class="active-menu" href="month.php"><i class="fa fa-calendar-check-o"></i> การจัดการห้องพัก <lable style="font-size:12px;color:#7FFF00"> ข้อมูลห้อง</lable></a>
                    </li>
                    <ul class="nav" id="main-menu">
                        <li>
                            <a class="active-menu" href="dataR.php?dataR=<?php echo $id;?>" ><i class="fa fa-user-plus"></i> ข้อมูลห้องพัก ห้อง <?php echo $id?> </a>
                        </li>
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
        <?php
        
        $tsql = "SELECT * from user WHERE room = $id ";
        $tre = mysqli_query($con,$tsql);

        $cck = "SELECT * from user WHERE room = $id ";
        $tck = mysqli_query($con,$cck);
        

        ?>
        <div id="page-wrapper" >
            <div id="page-inner" >
			 <div class="row" style="background-color:#DCDCDC">
                <div class="col-md-12">
                        <h1 class="page-header">
                        ข้อมูลห้อง
                        </h1>
                    </div>

        
					<div class="col-md-12 col-sm-12">
                    </div>

                    <div class="col-md-12 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" name="upfile" id="upfile" onSubmit="return chk_pic()" >
						<table width="100%">
                            <tr>
                                <th class="th">เลขห้อง</th>
                                <th class="th">ชั้นที่</th>
                                <th class="th">สถานะห้อง</th>
                                <th class="th">รายละเอียดห้อง</th>
                                <th class="th">ประเภทห้อง</th>
                                <th class="th">ราคาห้อง </th>
                                <th class="th">ประกัน </th>
                                <th class="th">หน่วยค่านํ้า</th>
                                <th class="th">หน่วยค่าไฟ</th>
                            </tr>
                                <?php
                                                            
                                    $sqli4 = "SELECT 
                                    room_details.floor as floor,
                                    room_details.price as price,
                                    room_details.other as other,
                                    room_category.name as name,
                                    room.room_status as room_status,
                                    room.room_detal as room_detal,
                                    room.unitPerWater as unitPerWater,
                                    room_details.reservation as reserve,
                                    room.unitPerElectricity as unitPerElectricity FROM `room` 
                    
                                    INNER JOIN room_details on(room_details.id = room.type)
                                    INNER JOIN bed_type on(room_details.bed = bed_type.id)   
                                    INNER JOIN room_category on(room_details.reservation = room_category.id) 
                                    WHERE room.room = $id";
                                    $rowe4 = mysqli_query($con,$sqli4);
                                    $rower4 = mysqli_fetch_array($rowe4);
                                    
                                    

                                    echo "
                                    <tr>
                                    <td class='td'>".$id."</td>

                                    <td class='td'>".$rower4['floor']."</td>
                                    <td class='td'>".$rower4['room_status']."</td>

                                    <td class='td'>".$rower4['room_detal']."</td>

                                    <td class='td'>".$rower4['name']."</td>
                                    <td class='td'>".$rower4['price']." บาท</td>
                                    <td class='td'>".$rower4['other']." บาท</td>
                                    ";switch($rower4['reserve']){
                                        case '2':
                                        echo "
                                       
                                        <td class='td'>".$rower4['unitPerWater']." บาท</td>
                                        <td class='td'>".$rower4['unitPerElectricity']." บาท</td>";
                                        break;
                                        case '1';
                                    echo "
                                    <td class='td'>ไม่มี</td>
                                    <td class='td'>ไม่มี</td>";
                                        break;
                                    }
                                    echo "</tr>";
                                    
                                ?>
                            
                        </table>
                        </div>
					</div>
                    </div>
            
                    <div class="panel panel-info">
                        <div class="panel-body">
							
							<div class="table-responsive">
                                <table class="table">
                                    <tr>
                                            <th>เลขห้อง</th>
                                            <th  colspan="2" style="background-color:green;color:white;text-align:center"><?php echo$id;?></th>
                                    </tr>
                                    <tr>
                                            <th>ข้อมูลผู้เช่าห้อง</th>
                                            <td>
                                                <table width="100%" ">
                                                    
                                                <?php   

                                                    
                                                
                                                    $date = date("d/m/Y");// เก็บวันที่สมัคร และเปลี่ยนปีเป็น พ.ศ
                                                    $year_l = date("Y");
                                                    $i = 0;
                                                    $rowe1 = mysqli_fetch_array($tck);
                                                    if(isset($rowe1['room']) == null){
                                                        echo "<th>ไม่มีผู้เช่า</th>";
                                                    }else{
                                                        while($rowe = mysqli_fetch_array($tre)){
                                                            $personal = $rowe['personal'];

                                                            $disc = mysqli_query($con,"SELECT districts.name_th as nameD, amphures.name_th as nameA,provinces.name_th as nameP,districts.zip_code as zip
                                                            FROM districts INNER JOIN amphures ON(districts.amphure_id = amphures.id) INNER JOIN provinces ON(amphures.province_id = provinces.id)
                                                            INNER JOIN user on(user.districts = districts.id)
                                                            WHERE  user.personal = '$personal'");
                                                            $provin = mysqli_fetch_array($disc);
                                                            $fullname = array($rowe['prefix_name'] ."   ".$rowe['fname'] ."   ".$rowe['lname']);
                                                            $dob = $rowe['dob'];
                                                            list($year, $month, $day) = explode('-', $dob);
                                                            $year_M = $year_l - $year;

                                                        echo "<tr>";
                                                        echo "<td width='50%'>";
                                                        echo "ชื่อ <b>".$rowe['prefix_name'] ."   ".$rowe['fname'] ."   ".$rowe['lname']."</b>";
                                                        echo "</td>";
                                                        echo "<td width='25%'>";
                                                        echo "อายุ <b>".$year_M ."</b><br>";
                                                        echo "</td>";
                                                        echo "</td>";
                                                        echo "<td width='25%'>";
                                                        echo "สถานะ<lable style='color:#CD5C5C'><strong> ".$rowe['premission'] ."</strong></lable><br>";
                                                        echo "</td>";
                                                        echo "</tr>";

                                                        echo "<tr>";
                                                        echo "<td>เบอร์โทรศัพทร์ <b>".$rowe['phone']."</b>";
                                                        echo "</td>";
                                                        echo "<td>ไอดีไลน์ <b>".$rowe['line']."</b>";
                                                        echo "</td>";

                                                        echo "<tr><th>ที่อยู่</th></tr>";

                                                        echo "<tr>";
                                                        echo "<td colspan='3'><b>ตำบล ".$provin['nameD']."";
                                                        echo " อำเภอ ".$provin['nameP']."";
                                                        echo " จังหวัด ".$provin['nameA']."";
                                                        echo "  ".$provin['zip']."";
                                                        echo "</b></td>";
                                                        echo "</tr>";

                                                        echo "<tr>";
                                                        echo "<td colspan='3'><b>ถนน ".$rowe['road']."";
                                                        echo " บ้านเลขที่ ".$rowe['home_number']."";
                                                        echo " หมู่ที่ ".$rowe['village']."";
                                                        echo "</td>";
                                                        echo "</tr>";

                                                        echo "<tr><th>ภาพบัตรประชาชน</th></tr>";
                                                        
                                                        echo "<tr>";
                                                        echo "<td colspan='1.5'>";
                                                        if(isset($rowe["idcard_picture"])!= null){
                                                        echo 'ภาพถ่าย<br><img id='.$i.' src="../imge/personal_photo/'.$rowe["idcard_picture"].'"  class="resize" width="200px" height="200px">';
                                                        echo '<center style="margin:5px 0px"><a href=delR.php?del_photoD='.$personal .' onclick="return confirm(\'คุณต้องการลบรูป บัตรประชาชน ผู้ใช้ '.$fullname[0].' ใช่หรือไม่\')" 
                                                        <button class="btn btn-danger" style="border:1px solid black;margin: 0px 5px;"> <i class="fa fa-times-circle" ></i> ลบ</button></a></center>';
                                                        echo ' <div id="myModal" class="modal">';
                                                        echo ' <img class="modal-content" id="img01" width="38%" ></th>';
                                                        echo "</td>";
                                                        echo "<td colspan='1.5'>";
                                                        $i ++;
                                                        }else{
                                                            echo "<tr>";
                                                            echo "<td>";
                                                            echo "ภาพถ่าย";
                                                            echo "<br>";
                                                            echo "<lable style='color:red'>ไม่มีข้อมูลรูปภาพบัตร</lable>";
                                                            echo "<br>";

                                                            echo '  <div class="button-section" >
                                                                    <input class="form-control" type="file" name="fileupload" style="width:70%">
                                                                    </div>';
                                                            echo '<div><input type="submit" class="btn btn-success" style="margin: 5px auto" name="addphoto" value="เพิ่มรูป" onclick="return confirm(\'ยืนยันการเพิ่มรูป บัตรประชาชน ผู้ใช้\')"></div>';
                                                           
                                                            echo "</td>";
                                                            echo "</tr>";
                                                            }

                                                        
                                                        echo "<tr>
                                                        <td colspan='3'>
                                                        <hr style='border:1px solid' width='100%'>
                                                        </td>
                                                        </tr>";
                                                        
                                                    }
                                                }
                                                ?>
                                               
                                                </table>
                                                
                                            </td>
                                    </tr>
                                        
                                        
                                    
                                </table>
                            </form>

             </div>
             
            </div>


                   
            </div>
             </div>
        <script>
        // Get the modal

        var modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption

        for (let i = 0; i <= 1000000000; ) {

        var img = document.getElementById(i);
        i++;
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");

        img.onclick = function(){
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
                
                //ฟังก์ชั่นวันที่
                date_default_timezone_set('Asia/Bangkok');
                $date_in = date("Ymd");
                //ฟังก์ชั่นสุ่มตัวเลข
                $numrand = (mt_rand());
                //เพิ่มไฟล์
                $upload = $_FILES['fileupload'];
                if ($upload <> '') {   //not select file
                    //โฟลเดอร์ที่จะ upload file เข้าไป
                    $path = "../imge/personal_photo/";
                
                    //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
                    $type = strrchr($_FILES['fileupload']['name'], ".");

                    //ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
                    $newname = $date_in . $numrand . $type;
                    $path_copy = $path . $newname;
                    $path_link = "fileupload/" . $newname;

                    //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
                    move_uploaded_file($_FILES['fileupload']['tmp_name'], $path_copy);
                }
                mysqli_query($con,"UPDATE `user` SET `idcard_picture`='$newname' WHERE personal = '$personal'");

                echo "<script type='text/javascript'> alert('เพิ่มรูป $fullname[0] เรียบร้อย')</script>";
                echo "<script type='text/javascript'> window.location='dataR.php?dataR=$id'</script>";
                }
            ?>

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
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>

</body>
</html>
