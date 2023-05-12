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
?>
<?php if(isset($_GET['eid'])){
    $id = $_GET['eid'];
    
    $tre = mysqli_query($con,"SELECT room.room_detal as room_detal,
    room_details.other as other_me_B,
    room_category.name as data , room_details.id as id,
    room_type.name as name , room_details.floor as floor ,
    room_details.price as price,
    bed_type.id as id_B,
    bed_type.name as name_B,
    bed_type.size as size_B,
    bed_type.detal as detal_B
    FROM room INNER JOIN room_details on(room_details.id = room.type) 
    INNER JOIN bed_type on(room_details.bed = bed_type.id)
    INNER JOIN room_type on(room_details.type = room_type.id) 
    INNER JOIN room_category on(room_category.id = room_details.reservation) 
    WHERE room.room = '$id'");
    $room1 = mysqli_fetch_array($tre);


    $Bid = $room1['id_B'];
    $Bname = $room1['name_B'];
    $Bsize = $room1['size_B'];
    $Bdetal = $room1['detal_B'];
    $other_me = $room1['other_me_B'];
    
    $name_me = $room1['name'];
    $id_me = $room1['id'];
    $floor_me = $room1['floor'];
    $price_me = $room1['price'];
    $data_me = $room1['data'];
    $detail = $room1['room_detal'];
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

     <!-- Template Main CSS File -->
    <script src="assets/jquery.min.js"></script>
    <script src="assets/script.js"></script>
   
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
    .td{
        background-color: #DCDCDC;
    }   
  table{
    margin: 0px 10px;
  }
  @media screen and (max-width:550px){
    table{
    width: 100%;
    margin: 0px;
  }
  }
  .forget{
    width:20px;
    height:20px;
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
                <a class="navbar-brand" href="home.php" style="width:300px"> <?php echo $hd['header']?></lable> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i><?php echo $_SESSION["fname_A"]; ?>&nbsp <lable><?php echo $_SESSION["lname_A"]; ?> <i class="fa fa-caret-down"></i>
                        <span class="badge" style="background-color:red"><?php echo $_SESSION["premission_A"]; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                   
                        <li class="divider"></li>
                        <li><a href="../logout.php" style="color:red" onclick="return confirm('ยืนยันการออกจากระบบ')"><i class="fa fa-sign-out fa-fw" ></i> ออกจากระบบ</a>
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
                        <a class="active-menu" href="user.php"><i class="fa fa-user-circle"></i> จัดการผู้ใช้ <lable style="font-size:12px;color:#7FFF00"> แก้ไข</lable></a>
                    </li>
                    <ul class="nav" id="main-menu">
                   
                        <li>
                            <a  href="user.php" ><i class="fa fa-user-plus"></i> ผู้ใช้ที่ มีห้องพัก   <?php echo "<lable style='color:#FFFF99' ><i class='fa fa-user'></i>  ".$y."</lable>" ?></a>
                        </li>
                        <li>
                            <a href="usernt.php" ><i class="fa fa-user-times"></i> ผู้ใช้ที่ ไม่มีห้องพัก   <?php echo "<lable style='color:#FFFF99' ><i class='fa fa-user'></i>  ".$x."</lable>" ?></a>
                        </li>
                        <li>
                            <a  href="userall.php" ><i class="fa fa-users"></i> ผู้ใช้ ทั้งหมด   <?php echo "<lable style='color:#FFFF99' ><i class='fa fa-user'></i>  ".$z."</lable>" ?></a>
                        </li>

                        <ul class="nav" id="main-menu">
                   
                        <li>
                            <a class="active-menu" href="#"><i class="fa fa-pencil-square-o"></i> แก้ไขช้อมูลผู้ใช้</a>
                        </li>
                        
                    </ul>
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
                  
                    


                    
            </div>

        </nav>

        <?php if(isset($_GET['eid_U'])):?>
            <?php $id = $_GET['eid_U']; ?>            
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
            <div id="page-wrapper" >
                <div id="page-inner">
                <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-header">
                            แก้ไขข้อมูลผู้ใช้
                            </h1>
                        </div>
                    </div> 
                    
                    <table width="45%" style="float:left" border="0">
                        <tr><td>
                    <?php 
                       

                        $u = mysqli_query($con,"SELECT * FROM user WHERE personal = '$id'");
                        $user = mysqli_fetch_array($u);

                        
                        $fullname = array($user['prefix_name'].' '.$user['fname'].' '.$user['lname']);
                        $i = 0;
                        if(isset($user["idcard_picture"])== null){
                            echo "<tr>";
                            echo "<td>";
                            echo "ภาพถ่าย";
                            echo "<br>";
                            echo "<lable style='color:red'>ไม่มีข้อมูลรูปภาพบัตร</lable>";
                            echo "<br>";
                            echo '<form method="post" enctype="multipart/form-data" name="upfile" id="upfile" onSubmit="return chk_pic()" >';
                            echo '  <div class="button-section" >
                                    <input class="form-control" type="file" name="fileupload" style="width:70%" accept="image/png, image/jpeg, image/jpg">
                                    </div>';
                            echo '<div><input type="submit" class="btn btn-success" style="margin: 5px auto" name="addphoto" value="เพิ่มรูป" onclick="return confirm(\'ยืนยันการเพิ่มรูป บัตรประชาชน ผู้ใช้\')"></div>';
                            echo '</form>';
                            echo '<form method="post">';
                            echo "</td>";
                            echo "<td>";
                            echo '<lable>คำนำหน้าชื่อ</lable>';
                            echo '<select name="prefix_name"  class="form-control"  required>' ;
                            echo '<option value="'.$user['prefix_name'].'">'.$user['prefix_name'].'</option>';
                            echo '<option name="นาย" value="นาย">นาย</option>';
                            echo '<option name="นาง" value="นาง">นาง</option>';
                            echo '<option name="นางสาว" value="นางสาว">นางสาว</option>';

                            echo '</select>';
                            echo '<lable>ชื่อ</lable>';
                            echo '<input class="form-control" name="fname" value="'.$user['fname'].'" required></input>';
                            echo '<lable>นามสกุล</lable>';
                            echo '<input class="form-control" name="lname" value="'.$user['lname'].'" required></input>';
                            echo '<lable>เพศ</lable>';
                            echo '<select class="form-control" name="sex">';
                            echo '<option value="'.$user['sex'].'">'.$user['sex'].'</option>';
                                        if($user['sex'] == "ชาย"){echo '<option value="หญิง">หญิง</option>';}
                                        else{echo '<option value="ชาย">ชาย</option>';}
                            echo '</select>';
                            echo "</td>";
                            echo "</tr>";
                            }else{
                                echo '<form method="post">';
                                echo "<tr>";
                                echo "<td>";
                                echo 'ภาพถ่าย';
                                echo '<div style="cursor:pointer"><img id='.$i.' src="../imge/personal_photo/'.$user["idcard_picture"].'"  class="resize" width="200px" height="200px" >';
                                echo '<a href=delR.php?del_photo='.$id .' onclick="return confirm(\'คุณต้องการลบรูป บัตรประชาชน ผู้ใช้ '.$fullname[0].' ใช่หรือไม่\')" 
                                      <button class="btn btn-danger" style="border:1px solid black;margin: 0px 5px;"> <i class="fa fa-times-circle" ></i> ลบ</button></a>';
                                echo '<div id="myModal" class="modal" style="backdrop-filter:blur(10px);
                                background-color:rgba(255,255,255,0.4);" >';
                                echo '<center><img class="modal-content" id="img01" width="38%" ></center>';
                                echo '</div>';
                                echo "</td>";

                                echo "<td>";
                                echo '<lable>คำนำหน้าชื่อ</lable>';
                                echo '<select name="prefix_name"  class="form-control"  required>' ;
                                echo '<option value="'.$user['prefix_name'].'">'.$user['prefix_name'].'</option>';
                                echo '<option name="นาย" value="นาย">นาย</option>';
                                echo '<option name="นาง" value="นาง">นาง</option>';
                                echo '<option name="นางสาว" value="นางสาว">นางสาว</option>';
                                echo '</select>';
                                echo '<lable>ชื่อ</lable>';
                                echo '<input class="form-control" name="fname" value="'.$user['fname'].'" required></input>';
                                echo '<lable>นามสกุล</lable>';
                                echo '<input class="form-control" name="lname" value="'.$user['lname'].'" required></input>';
                                echo '<lable>เพศ</lable>';
                                echo '<select class="form-control" name="sex">';
                                echo '<option value="'.$user['sex'].'">'.$user['sex'].'</option>';
                                            if($user['sex'] == "ชาย"){echo '<option value="หญิง">หญิง</option>';}
                                            else{echo '<option value="ชาย">ชาย</option>';}
                                echo '</select>';
                                echo "</td>";
                                echo "</tr>";
                         
                                $i ++;
                        }
                        echo '<tr>';
                        echo "<td colspan='2'>";
                        echo '<lable>เบอร์โทร</lable>';
                        echo '<input type="number" maxlength="10" class="form-control" name="phone" value="'.$user['phone'].'" required></input>';
                        echo '<lable>เบอร์โทร ญาติที่ติดต่อได้</lable>';
                        echo '<input type="number" maxlength="10" class="form-control" name="Parents_phone" value="'.$user['Parents_phone'].'" ></input>';
                        
                        echo '<lable>วันเกิด</lable>';
                        echo '<input type="date" class="form-control" name="dob" value="'.$user['dob'].'" required></input>';
                        echo '<lable>ไอดีไลน์</lable>';
                        echo '<input class="form-control" name="line" value="'.$user['line'].'" ></input>';
                        echo '<lable>บ้านเลขที่</lable>';
                        echo '<input class="form-control" name="home_number" value="'.$user['home_number'].'" required></input>';
                        echo '<lable>หมู่</lable>';
                        echo '<input class="form-control" name="village" value="'.$user['village'].'"></input>';
                        
                        if($_SESSION['fname_A'] == $user['fname'])
                            {
                                echo '<lable id="text" style="display:none;color:green" class="rule_text" >';
                                echo '<hr style="border:1px solid black">';
                                echo 'รหัสผ่านเก่า : ';
                                echo '<input class="form-control" type="password" id="pass" name="old_plassword" onchange="return pass(this)"  placeholder="รหัสผ่านเก่า" >';
                                echo 'รหัสใหม่ : ';
                                echo '<input class="form-control" type="password" id="pass1" name="conf_psw1" onchange="return pass(this)" placeholder="รหัสผ่าน อย่างน้อย 8 ตัว"  min="8">';
                                echo 'รหัสยืนยันรหัสผ่านใหม่ : ';
                                echo '<input class="form-control" type="password" id="pass2" name="conf_psw2" onchange="return pass(this)" placeholder="ยืนยันรหัสผ่าน"  min="8">';
                                echo '<input type="checkbox"  class="rule" onclick="myFunction()" >
                                <label for="myCheck">Show Password&nbsp</label><lable class="fa fa-low-vision"></lable>
                                
                                <br>
                                <input type="submit" name="edit" class="btn btn-primary" value="เปลี่ยนรหัสผ่าน">
                                </div>';
                                echo '<hr style="border:1px solid black">';
                                echo '</lable>';
                            }
                                echo "</td>";
                                echo "</tr>";
                        ?>  
                     </td></tr>
                   </table >
                   <?php if(isset($_POST['edit'])){
                        $errors = array();
                        
                        $old_plassword = $_POST['old_plassword'];
                        $conf_psw1 = $_POST['conf_psw1'];
                        $conf_psw2 = $_POST['conf_psw2'];

                        $user_check_query = "SELECT * FROM user WHERE personal = '".$_SESSION['personal_admin']."'";
                        $query = mysqli_query($con, $user_check_query);
                        $result = mysqli_fetch_assoc($query);

                        $password = md5($old_plassword);
                        if($result){
                            $result['password'];

                            if($result['password'] != $password){
                                array_push($errors,"password not me");
                                echo "<script type='text/javascript'> alert('รหัสผ่านเก่า ไม่ถูกต้อง!!')</script>";
                            }else{
                                if($conf_psw1 ===  $conf_psw2){
                                    if(count($errors)==0){
                                        $password_new = md5($conf_psw1);

                                        mysqli_query($con,"UPDATE `user` SET `password`='$password_new' WHERE `personal` = '".$_SESSION['personal_admin']."'");
                                        
                                        $sqlie = "INSERT INTO event_log (personal,date,time,event) 
                                        VALUES ('".$_SESSION['personal_admin']."', '$date','$time','".$_SESSION['fname_A']." ".$_SESSION['lname_A']." แก้ไขข้อมูลรหัสผ่าน ของตัวเอง ')";
                                        mysqli_query($con,$sqlie);


                                        echo "<script type='text/javascript'> alert('แก้ไขรหัสผ่านเรียบร้อย')</script>";
                                        echo "<script type='text/javascript'> window.location='editU.php?eid_U=$id'</script>";


                                    }
                                }else{
                                    echo "<script type='text/javascript'> alert('รหัสไม่ตรงกัน')</script>";
                                }
                            }
                        }
                        
                   }?>  

                        <script>
                            function myFunction() {
                                var e = document.getElementById("pass");
                                var x = document.getElementById("pass1");
                                var y = document.getElementById("pass2");

                                    if (e.type === "password") {
                                        e.type = "text";
                                    } else {
                                        e.type = "password";
                                    }

                                    if (x.type === "password") {
                                        x.type = "text";
                                    } else {
                                        x.type = "password";
                                    }

                                    if (y.type === "password") {
                                        y.type = "text";
                                    } else {
                                        y.type = "password";
                                    }
                            }
                        </script>
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
                        mysqli_query($con,"UPDATE `user` SET `idcard_picture` = '$newname' WHERE personal = '$id'");
                        echo "<script type='text/javascript'> alert('เพิ่มรูป $fullname[0] เรียบร้อย')</script>";
                        echo "<script type='text/javascript'> window.location='editU.php?eid_U=$id'</script>";
                    }
                   ?>
                   <table width="50%" style="float:right">
                        <tr><td>
                    <?php 
                        

                        $u = mysqli_query($con,"SELECT * FROM user WHERE personal = '$id'");
                        $user = mysqli_fetch_array($u);
                        
                        $address = $user['districts'];

                        $ssqlr = "SELECT districts.id as dis_id,districts.name_th as nameD, amphures.name_th as nameA,provinces.name_th as nameP,districts.zip_code as zip
                        FROM districts INNER JOIN amphures ON(districts.amphure_id = amphures.id) INNER JOIN provinces ON(amphures.province_id = provinces.id)
                        INNER JOIN user on(user.districts = districts.id)
                        WHERE user.districts = $address AND user.personal = '$id'";
                        
                        $disc = mysqli_query($con,$ssqlr);
                        $provin = mysqli_fetch_array($disc);
                        
                    
                        echo '<lable>ถนน</lable>';
                        echo '<input class="form-control" name="road" value="'.$user['road'].'"></input>';    
                        echo 'ที่อยู่ปัจจุบัน';
                        echo '<input style="background-color:#DCDCDC" type="text" class="form-control"  value="จังหวัด '.$provin['nameP'].' อำเภอ. '.$provin['nameA'].' ตำบล. '.$provin['nameD'].'" disabled>';
                        echo '<input type="hidden" name="district_disable" value="'.$provin['dis_id'].'">';
                        echo '<lable>แก้ไขที่อยู่</lable>';
                        echo '<select name="province_id" id="province" class="form-control">';
                        echo '<option value="" class="fontcity">กรุณาเลือก จังหวัด</option>';
                        while($result = mysqli_fetch_assoc($query_address)){
                           echo ' <option value="'.$result['id'].'">'.$result['name_th'].'</option>';
                        }              
                        echo '</select>';
                        echo "<br>";
                        echo '  <select name="amphure_id" id="amphure" class="form-control" >
                                    <option value="" class="fontcity">กรุณาเลือก อำเภอ</option>
                                </select>';
                        echo "<br>";
                        echo '  <select name="district_id" id="district" class="form-control" >
                                    <option value="" class="fontcity">กรุณาเลือก ตำบล</option>
                                </select>';
                        echo "<br>";
                        echo '
                        <lable>วันที่ เริ่มการเช่า </lable>
                        ';
                        if($id){
                            echo '<input type="date" class="form-control" name="start_date" value="'.$user['rental_start_date'].'" >';
                        }else{
                            // echo '<input type="date" class="form-control" name="start_date" value="'.$user['rental_start_date'].'" >';
                        }
                        echo '<label>ประเภทรถ';
                        if($user['tcar'] == null){
                            echo '<select name="tcar" class="form-control">
                                <option value="" selected>ไม่มี</option>
                                <option value="รถปิคอัพ">รถปิคอัพ</option>
                                <option value="รถเก๋ง">รถเก๋ง</option>
                                <option value="จักรยานยนต์">จักรยานยนต์</option>
                            </select>';
                            echo '</label>
                            <label>สีรถ <input type="text" name="ccar" id="ccar" class="form-control" /></label>
                            <label>ป้ายทะเบียน <input type="text" name="license_plate" class="form-control" /></label>';
                            echo "<br>";
                        }else{
                            echo '<select name="tcar" class="form-control">';
                                if($user['tcar'] == null){
                                echo '<option value="" selected>ไม่มี</option>
                                <option value="รถปิคอัพ">รถปิคอัพ</option>
                                <option value="รถเก๋ง">รถเก๋ง</option>
                                <option value="จักรยานยนต์">จักรยานยนต์</option>
                            </select>
                            </label>';
                                }else{
                                    echo '
                                    <option value="'.$user['tcar'].'" selected>'.$user['tcar'].'</option>
                                    <option value="">ไม่มี</option>
                                    <option value="รถปิคอัพ">รถปิคอัพ</option>
                                    <option value="รถเก๋ง">รถเก๋ง</option>
                                    <option value="จักรยานยนต์">จักรยานยนต์</option>
                                </select>
                                </label>';
                                }
                            echo '<label>สีรถ <input type="text" name="ccar" id="ccar" value="'.$user['ccar'].'" class="form-control" ></label>
                            <label>ป้ายทะเบียน <input type="text" name="license_plate" value="'.$user['license_plate'].'" class="form-control" ></label>';
                            echo "<br>";
                        }
                        echo '<lable>สถานะ</lable>';
                        echo ' <select name="premission" class="form-control" >'; 
                        echo '<option value="'.$user['premission'].'">'.$user['premission'].'</option>';
                            if($user['premission'] == "Admin"){echo '<option value="Member">Member</option>';}
                            else{echo '<option value="Admin">Admin</option>';}
                        echo '</select>';
                        echo '<lable>ห้องพัก</lable>';
                        echo ' <select name="room" class="form-control" >'; 

                        $cnn = mysqli_query($con,"SELECT COUNT(room) as limitz FROM `user` WHERE user.room = ".$user['room']."");
                        $limitz = mysqli_fetch_array($cnn);

                        if($user['room'] == null){
                            echo '<option value="">--ไม่มี--</option>';
                        }else{
                            echo '<option value="'.$user['room'].'">'.$user['room'].' ('.$limitz['limitz'].' คน) </option>';
                            echo '<option value="">--ไม่มี--</option>';
                        }
                       
                                while($rrm = mysqli_fetch_array($room_month)){
                                    $cn = mysqli_query($con,"SELECT COUNT(room) as count FROM `user` WHERE user.room = ".$rrm['room']."");
                                    $limit = mysqli_fetch_array($cn);

                                    if($user['room'] != $rrm['room']){
                                        if($limit['count'] > 0){
                                            echo '<option style="color:green" value="'.$rrm['room'].'">'.$rrm['room'].' '; if($limit['count'] != '0'){echo " ( ".$limit['count']." คน)";} echo'</option>'; 
                                        }else{
                                            echo '<option style="color:red" value="'.$rrm['room'].'">'.$rrm['room'].' (ว่าง)</option>'; 
                                        }
                                    }
                                }
                        echo '</select>';
                        echo "<br>";
                        echo '<input type="submit" name="log" value="ยืนยัน" class="btn btn-primary" onclick="return confirm(\'ยืนยันการแก้ไขข้อมูลผู้ใช้\')">';
                        if($_SESSION['fname_A'] == $user['fname'])
                            {
					echo '&nbsp <lable style="border:1px solid black;padding:5px 2px;"><input type="checkbox" id="myCheck"  onclick="showBtn()" class="forget" style="margin:0px 10px"> เปลี่ยนรหัสผ่านใหม่</lable>';
                            }
                        echo '</form>';
                     ?>  
                     </td></tr>
                   </table>
                   <script>
                function showBtn() {
                    var checkBox = document.getElementById("myCheck");
                        var text = document.getElementById("text");
                            if (checkBox.checked == true){
                        text.style.display = "block";
                    } else {
                text.style.display = "none";
                            }
                }
                </script>                  
                  
                
<script type="text/javascript">
        function ShowHideDiv(car) {
            var car = document.getElementById("car");
            car.style.display = vehicle1.checked ? "block" : "none";
        }
    </script>
        
                    <!-- /. ROW  -->


        <?php endif;?>
    <?php
        if(isset($_POST['log'])){
            $prefix_name = $_POST['prefix_name'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $phone = $_POST['phone'];
            $P_phone = $_POST['Parents_phone'];
            
            $sex = $_POST['sex'];
            $dob = $_POST['dob'];
            $start_date = $_POST['start_date'];
            $line = $_POST['line'];
            $district_id = $_POST['district_id'];
            $district_disable = $_POST['district_disable'];

            $tcar = $_POST['tcar'];
            $ccar = $_POST['ccar'];
            $license_plate = $_POST['license_plate'];
            $home_number = $_POST['home_number'];
            $village = $_POST['village'];
            $road = $_POST['road'];
            $room = $_POST['room'];
            $premission = $_POST['premission'];

            echo $prefix_name."<br>";
            echo $fname."<br>";
            echo $lname."<br>";
            echo $phone."<br>";
            echo $sex."<br>";
            echo $dob."<br>";
            echo $line."<br>";
            echo $district_id."<br>";
            echo $tcar."<br>";
            echo $ccar."<br>";
            echo $license_plate."<br>";
            echo $home_number."<br>";
            echo $village."<br>";
            echo $road."<br>";


                // if($tcar == null){
                //     mysqli_query($con,"UPDATE `user` SET 
                //     `prefix_name`='$prefix_name',`fname`='$fname',
                //     `lname`='$lname',`sex`='$sex',
                //     `dob`='$dob',`phone`='$phone',
                //     `line`='$line',`room`='$room',
                //     `districts`='$district_disable',`road`='$road',
                //     `home_number`='$home_number',`village`='$village',
                //     `premission`='$premission',
                //     `tcar`= null,`ccar`= null,`license_plate`= null 
                //     WHERE personal = $id");
                // }
                // if($tcar != null){
                //     mysqli_query($con,"UPDATE `user` SET 
                //     `prefix_name`='$prefix_name',`fname`='$fname',
                //     `lname`='$lname',`sex`='$sex',
                //     `dob`='$dob',`phone`='$phone',
                //     `line`='$line',`room`='$room',
                //     `districts`='$district_disable',`road`='$road',
                //     `home_number`='$home_number',`village`='$village',
                //     `premission`='$premission',
                //     `tcar`= '$tcar',`ccar`= '$ccar',`license_plate`= '$license_plate' 
                //     WHERE personal = $id");
                    
                // }if($room == null){
                //     mysqli_query($con,"UPDATE `user` SET 
                //     `prefix_name`='$prefix_name',`fname`='$fname',
                //     `lname`='$lname',`sex`='$sex',
                //     `dob`='$dob',`phone`='$phone',
                //     `line`='$line',`room`= null,
                //     `districts`='$district_disable',`road`='$road',
                //     `home_number`='$home_number',`village`='$village',
                //     `premission`='$premission',
                //     `tcar`= '$tcar',`ccar`= '$ccar',`license_plate`= '$license_plate' 
                //     WHERE personal = $id");
                    
                // }if($room != null){
                //     mysqli_query($con,"UPDATE `user` SET 
                //     `prefix_name`='$prefix_name',`fname`='$fname',
                //     `lname`='$lname',`sex`='$sex',
                //     `dob`='$dob',`phone`='$phone',
                //     `line`='$line',`room`= '$room',
                //     `districts`='$district_disable',`road`='$road',
                //     `home_number`='$home_number',`village`='$village',
                //     `premission`='$premission',
                //     `tcar`= '$tcar',`ccar`= '$ccar',`license_plate`= '$license_plate' 
                //     WHERE personal = $id");
                    
                // }
                if($tcar != null and $district_id != null and $room != null){
                    mysqli_query($con,"UPDATE `user` SET 
                    `prefix_name`='$prefix_name',`fname`='$fname',
                    `lname`='$lname',`sex`='$sex',
                    `dob`='$dob',`phone`='$phone',
                    `Parents_phone`='$P_phone',
                    `line`='$line',`room`='$room',
                    `districts`='$district_id',`road`='$road',
                    `home_number`='$home_number',`village`='$village',
                    `premission`='$premission',
                    `tcar`= '$tcar',`ccar`= '$ccar',`license_plate`= '$license_plate'
                    WHERE personal = '$id'");

                   
                    mysqli_query($con,"UPDATE `room` SET `room_status`='ไม่ว่าง' WHERE room = $room");

                
                  
                }else if($room == null and $tcar == null and $district_id == null){
                    mysqli_query($con,"UPDATE `user` SET 
                    `prefix_name`='$prefix_name',`fname`='$fname',
                    `lname`='$lname',`sex`='$sex',
                    `dob`='$dob',`phone`='$phone',
                    `Parents_phone`='$P_phone',
                    `line`='$line',`room`= null,
                    `districts`='$district_disable',`road`='$road',
                    `home_number`='$home_number',`village`='$village',
                    `premission`='$premission',
                    `tcar`= null,`ccar`= null,`license_plate`= null
                    WHERE personal = '$id'");

                 
                }else if($room != null and $tcar != null and $district_id == null){
                    mysqli_query($con,"UPDATE `user` SET 
                    `prefix_name`='$prefix_name',`fname`='$fname',
                    `lname`='$lname',`sex`='$sex',
                    `dob`='$dob',`phone`='$phone',
                    `Parents_phone`='$P_phone',
                    `line`='$line',`room`= '$room',
                    `districts`='$district_disable',`road`='$road',
                    `home_number`='$home_number',`village`='$village',
                    `premission`='$premission',
                    `tcar`= '$tcar',`ccar`= '$ccar',`license_plate`= '$license_plate'
                    WHERE personal = '$id'");

                    mysqli_query($con,"UPDATE `room` SET `room_status`='ไม่ว่าง' WHERE room = $room");
                
                }else if($room != null and $tcar == null and $district_id != null){
                    mysqli_query($con,"UPDATE `user` SET 
                    `prefix_name`='$prefix_name',`fname`='$fname',
                    `lname`='$lname',`sex`='$sex',
                    `dob`='$dob',`phone`='$phone',
                    `Parents_phone`='$P_phone',
                    `line`='$line',`room`='$room',
                    `districts`='$district_id',`road`='$road',
                    `home_number`='$home_number',`village`='$village',
                    `premission`='$premission',
                    `tcar`= null,`ccar`= null,`license_plate`= null
                    WHERE personal = '$id'");

                    mysqli_query($con,"UPDATE `room` SET `room_status`='ไม่ว่าง' WHERE room = $room");
                    
                }else if($room == null and $tcar != null and $district_id != null){
                    mysqli_query($con,"UPDATE `user` SET 
                    `prefix_name`='$prefix_name',`fname`='$fname',
                    `lname`='$lname',`sex`='$sex',
                    `dob`='$dob',`phone`='$phone',
                    `Parents_phone`='$P_phone',
                    `line`='$line',`room`= null,
                    `districts`='$district_id',`road`='$road',
                    `home_number`='$home_number',`village`='$village',
                    `premission`='$premission',
                    `tcar`= '$tcar',`ccar`= '$ccar',`license_plate`= '$license_plate' 
                    WHERE personal = '$id'");
                
                } else if($room != null and $tcar == null and $district_id == null){
                    mysqli_query($con,"UPDATE `user` SET 
                    `prefix_name`='$prefix_name',`fname`='$fname',
                    `lname`='$lname',`sex`='$sex',
                    `dob`='$dob',`phone`='$phone',
                    `Parents_phone`='$P_phone',
                    `line`='$line',`room`= '$room',
                    `districts`='$district_disable',`road`='$road',
                    `home_number`='$home_number',`village`='$village',
                    `premission`='$premission',
                    `tcar`= null,`ccar`= null,`license_plate`= null 
                    WHERE personal = '$id'");

                    mysqli_query($con,"UPDATE `room` SET `room_status`='ไม่ว่าง' WHERE room = $room");
                  
                }  

                $sqlie = "INSERT INTO event_log (personal,date,time,event) 
                VALUES ('".$_SESSION['personal_admin']."', '$date','$time','".$_SESSION['fname_A']." ".$_SESSION['lname_A']." แก้ไขข้อมูล ผู้ใช้งานชื่อ $fullname[0] ')";
                mysqli_query($con,$sqlie);

                mysqli_query($con,"UPDATE `user` SET `rental_start_date`='$start_date' WHERE room = $room");
                
                echo "<script type='text/javascript'> alert('บันทึกการแก้ไขข้อมูล $fullname[0] สำเร็จ')</script>";
                echo "<script type='text/javascript'> window.location='editU.php?eid_U=$id'</script>";
                
        }
    ?>
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js" ></script>
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
