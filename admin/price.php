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
</style>
<body>
<?php
    $sqlqq =mysqli_query($con,"SELECT * FROM paper_details");
    $hd = mysqli_fetch_array($sqlqq);
?>
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
                        <a href="user.php"><i class="fa fa-user-circle"></i> จัดการผู้ใช้</a>
                    </li>
                    <li>
                        <a href="receipt.php"><i class="fa fa-qrcode"></i> จัดการค่าเช่า รายเดือน </a>
                    </li>
                    <li>
                        <a class="active-menu" href="price.php"><i class="fa fa-address-book"></i> ประวัติการชำระเงิน รายเดือน</a>
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

            <div id="page-wrapper" >
                <div id="page-inner">
                <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-header">
                            ประวัติการจ่ายเงิน รายเดือน
                            </h1>
                        </div>
                    </div> 
                    <center>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example" >
                                   
                                   <thead>
                                       <tr>
                                   <th class="cn">ชั้นที่</th>
                                   <th class="cn">หมายเลขห้อง</th>
                                   <th class="cn">วันที่</th>
                                   <th class="cn">สถานะห้อง</th>
                                   <th class="cn">ประเภทห้อง</th>
                                   <th class="cn">ประเภทเตียง</th>
                                   <th class="cn">ราคาห้อง</th>
                                   <th class="cn">ประกัน</th>
                                   <th width="7%">ชนิดห้อง</th>
                                   <th class="cn">การค้างชำระ</th>
                                   <th class="cn">ประวัติการจ่ายเงิน/ค้างชำระ</th>
                               </tr>
                               
                           </thead>
                           
                           <tbody>
                           <?php
                           $check_query = mysqli_query($con,"SELECT * FROM `receipt` GROUP BY room ORDER BY room ASC");
                           while($check_date_room = mysqli_fetch_array($check_query)){
                            $date_check = array(); 
                            $ec = mysqli_query($con,"SELECT max(date) as date_check_room  FROM `receipt` WHERE room = ".$check_date_room['room']." ORDER BY room ASC");
                                $ccv = mysqli_fetch_array($ec);
                                array_push($date_check,$ccv['date_check_room']);
          

                           $drd = mysqli_query($con,"SELECT * FROM room 
                           INNER JOIN `receipt`on(room.room = receipt.room) 
                           WHERE receipt.date = '".$date_check[0]."' ");   
                        
                         $check_R_recipt = mysqli_query($con,"SELECT room_type.name as tname, 
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
                         FROM receipt,room,room_details,room_category,bed_type,room_type 
                         WHERE receipt.room = room.room 
                         and room.type = room_details.id 
                         and room_category.id = room_details.reservation 
                         and bed_type.id = room_details.bed 
                         and room_type.id = room_details.type
                         and receipt.date = '$date_check[0]'
                         and room.room = receipt.room
                         and receipt.room = ".$check_date_room['room']."
                         ORDER BY  `room`.`room`,`room_details`.`reservation` , `room_details`.`floor` ASC
                         ");
                           
                           $trow=mysqli_fetch_array($check_R_recipt);
                           
                                $room = $trow['room'];

                                switch($trow['reservation']){
                                    case 'รายเดือน':

                               //นับจำนวน การจ่ายเงินในตาราง receipt
                                $count_receipt = mysqli_query($con,"SELECT count(*)as count 
                                FROM `receipt` 
                                WHERE room = $room and payRent = '0' ");
                                                 
                                $eccp = mysqli_fetch_array($drd);
                               
                                $ea = mysqli_fetch_array($count_receipt);
                               
                                list($y,$m,$d) = explode("-",$eccp['date']);
                                $y = $y+543;

                                echo"<tr>
                                
                           
                                        
                                <th>".$trow['floor']."</th>
                                <th>".$trow['room']."</th>  
                                <th>".$d."-".$m."-".$y."</th>  
                                <input type='hidden' name='rroom[ ]' value='".$trow['room']."'>
                                <input type='hidden' name='rroom1[ ]' value='".$trow['room']."'>
                                <th>"; if($trow['room_status'] == "ว่าง"){echo "<lable style='color:green;'>".$trow['room_status']."</lable>";}else{echo "<lable style='color:red;'>".$trow['room_status']."</lable>"; }echo "</th>
                                <th>".$trow['tname']."</th>
                                <th>".$trow['bname']."</th>";
    
    
                                echo " <th>".number_format($trow['price'],0)." บาท</th>
                                <th>".number_format($trow['other'],0)." บาท</th>
                                <th>".$trow['reservation']."</th>
                                
                    
    
                                <td>";
                                if(isset($eccp['payRent'])){
                                   
                                    if($ea['count'] > "0"){echo "<lable style='color:red'>ค้างชำระ ".$ea['count']." งวด</lable>";}
                                    else if($ea['count']== "0"){echo "<label style='color:green'>ไม่มีการค้างชำระ</label>";}
                                    echo '<td><a href="history_payment.php?overdue='.$room.'" <button  class="btn btn-success"><i class="fa fa-clock-o"></i> ประวัติการจ่ายเงิน/ค้างชำระ</button></td>';
                                }
                                break;
                            }
                        }
                               
             
                        
                       ?>
                           <thead >
                               <tr>
                                   <th>
                                       
                                    </form>
                                   </th>
                               </tr>
                           </thead>
                           
                           </tbody>
   
                           </table>
                           </center>
                </div>
            </div>
    </div>
</body>
</html>
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
