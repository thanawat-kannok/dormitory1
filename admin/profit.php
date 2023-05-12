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
                        <a href="price.php"><i class="fa fa-address-book"></i> ประวัติการชำระเงิน รายเดือน</a>
                    </li>
                    <li>
                        <div style="background-color:#FF9900;color:black;font-size:20px;" align="center">จัดการอื่นๆ</div>
                    </li>
                    <li>
                        <a class="active-menu" href="profit.php"><i class="fa fa-line-chart"></i> รายรับ</a>
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
        <?php
        
        $date_check1 = array(); 
        
        $eas = mysqli_query($con,"SELECT max(date) as date_check  FROM `receipt`");
        while($ccv = mysqli_fetch_array($eas)){

                array_push($date_check1,$ccv['date_check']);
        
        }
        


        $sume = mysqli_query($con,"SELECT SUM(`receipt_total`) as sum FROM receipt WHERE  date = '$date_check1[0]'");
        $sum = mysqli_fetch_array($sume);

        $avge = mysqli_query($con,"SELECT AVG(`receipt_total`) as avg FROM receipt WHERE  date = '$date_check1[0]'");
        $avg = mysqli_fetch_array($avge);

        $r_in_d = mysqli_query($con,"SELECT COUNT(room) as room FROM receipt WHERE  date = '$date_check1[0]' and payRent = '1'");
        $r_in_date = mysqli_fetch_array($r_in_d);

        list($y, $m, $d) = explode("-", $date_check1[0]);
                            
        $m = $m - 1;
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

        $date_check_month =  "$y-$m-$d";

        $qli = mysqli_query($con, "SELECT * FROM unit 
        WHERE MONTH(date) >= '$m' 
        and MONTH(date) < '$m_now' 
        and YEAR(date) >= '$y'"); 
        $dck = mysqli_fetch_array($qli);

        $r_in_d_l = mysqli_query($con,"SELECT COUNT(room) as room_lost FROM receipt WHERE  date = '$date_check1[0]' and payRent = '0'");
        $r_in_date_lost = mysqli_fetch_array($r_in_d_l);
        // $receipter = mysqli_query($con,"SELECT * FROM receipt WHERE  date = '$date_check1[0]' ORDER BY `receipt_total` ASC LIMIT 0,3");
        
        $count_R = mysqli_query($con,"SELECT COUNT(room) as count_r FROM room ");
        $count_R_fan = mysqli_query($con,"SELECT COUNT(room) as count_r_fan FROM room,room_details WHERE  room_details.id = room.type and room_details.type = '8'");
        $count_R_air = mysqli_query($con,"SELECT COUNT(room) as count_r_air FROM room,room_details WHERE  room_details.id = room.type and room_details.type = '17'");

        $count_R_fan_day = mysqli_query($con,"SELECT COUNT(room) as count_r_fan_day FROM room,room_details WHERE  room_details.id = room.type and room_details.reservation = '1' and room_details.type = '8'");
        $count_R_air_day = mysqli_query($con,"SELECT COUNT(room) as count_r_air_day FROM room,room_details WHERE  room_details.id = room.type and room_details.reservation = '1' and room_details.type = '17'");

        $count_R_fan_month = mysqli_query($con,"SELECT COUNT(room) as count_r_fan_month FROM room,room_details WHERE  room_details.id = room.type and room_details.reservation = '2' and room_details.type = '8'");
        $count_R_air_month = mysqli_query($con,"SELECT COUNT(room) as count_r_air_month FROM room,room_details WHERE  room_details.id = room.type and room_details.reservation = '2' and room_details.type = '17'");

        list($check_y,$check_m,$check_d) = explode("-",$date_check1[0]);
        $check_y = $check_y+543;

        ?>
            <div id="page-wrapper" >
                <div id="page-inner">
                <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-header">
                            ผลประกอบการ <small> <?php echo $check_d."/".$check_m."/".$check_y;?></small>
                            </h1>
                        </div>
                    </div> 
                    <div class="container">
                       <div class='row justify' style="background-color:#DCDCDC;padding:0px 15px">
                       <hr>
                        รายได้ทั้งหมด ของเดือน : <?php echo number_format($sum['sum']);?> บาท <br>
                        รายได้เฉลี่ย ต่อห้อง : <?php echo number_format($avg['avg']);?> บาท <br>
                        ห้องในเดือนนี้ ที่ทำการชำระเงินแล้ว : <?php echo $r_in_date['room'];?> ห้อง | เหลือค้างชำระ : <?php echo $r_in_date_lost['room_lost'];?> ห้อง<br>
                        <table  width="100%">
                            <tr>
                                <th colspan="3">จำนวนห้องทั้งหมด : <?php $count_room = mysqli_fetch_array($count_R); echo  $count_room['count_r']." ห้อง";?></th>
                            </tr>
                            <tr>
                                <td>ห้องพัดลม : <?php $count_room_fan = mysqli_fetch_array($count_R_fan); echo  $count_room_fan['count_r_fan']." ห้อง";?></td>
                                <td>ห้องพัดลมรายเดือน : <?php $count_room_fan_month = mysqli_fetch_array($count_R_fan_month); echo $count_room_fan_month['count_r_fan_month']." ห้อง";?></td>
                                <td>ห้องพัดลมรายวัน : <?php $count_room_fan_day = mysqli_fetch_array($count_R_fan_day); echo $count_room_fan_day['count_r_fan_day']." ห้อง";?></td>
                            </tr>
                            <tr>
                                <td>ห้องแอร์ : <?php $count_room_air = mysqli_fetch_array($count_R_air); echo  $count_room_air['count_r_air']." ห้อง";?></td>
                                <td>ห้องแอร์รายเดือน : <?php $count_room_air_month = mysqli_fetch_array($count_R_air_month); echo  $count_room_air_month['count_r_air_month']." ห้อง";?></td>
                                <td>ห้องแอร์รายวัน : <?php $count_room_air_day = mysqli_fetch_array($count_R_air_day); echo  $count_room_air_day['count_r_air_day']." ห้อง";?></td>
                            </tr>
                        </table>
                        <hr>
                        <!-- ห้องที่ทำรายได้สูงสูด 3 ลำดับแรก : <br>
                        <?php while($r_max_3 = mysqli_fetch_array($receipter)):?>
                        ห้อง : <?php echo $r_max_3['room']." รายได้ : ".number_format($r_max_3['receipt_total']);?> บาท <br>
                        <?php endwhile; ?> -->
                       </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">   
                                    <thead>
                                        <tr>
                                            <th>ชั้น</th>
                                            <th>เลขห้อง</th>
                                            <th>ประเภทห้อง</th>
                                            <th>รายได้เดือนล่าสุด </th>
                                            <th>ดูกราฟ</th>
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



                                        //เช็คข้อมูลตาราง room ให้เลขห้องตรงกับ receipt เรียงลำดับ น้อยไปมาก
                                        $receipt_J_room = mysqli_query($con,"SELECT room_type.name as tname, 
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
                                        room_details.other as other,
                                        receipt.receipt_total as receipt_total
                                        FROM receipt,room,room_details,room_category,bed_type,room_type 
                                        WHERE receipt.room = room.room and receipt.date = '$date_check[0]'
                                        and room.type = room_details.id 
                                        and room_category.id = room_details.reservation 
                                        and bed_type.id = room_details.bed 
                                        and room_type.id = room_details.type
                                        and receipt.room = '".$check_date_room['room']."'
                                        ORDER BY  `room`.`room`,`room_details`.`reservation` , `room_details`.`floor` ASC
                                        ");

                                                $room_R = mysqli_fetch_array($receipt_J_room);
                                                    echo "<tr>";
                                                    echo "<td>".$room_R['floor']."</td>";
                                                    echo "<td>".$room_R['room']."</td>";              
                                                    echo "<td>".$room_R['cname']."</td>";
                                                    echo "<td>".number_format($room_R['receipt_total'],2)." บาท</td>";
                                                    echo '<td>
                                                        <a href="#" <button  class="btn btn-danger" disabled>
                                                        <i class="fa fa-bar-chart-o"></i> coming soon..</button>
                                                        </a>
                                                        </td>';
                                                    echo "</tr>";
                                                }
                                            ?>
                                      
                                    </tbody>
                                </table>
                            </div>
                        <!-- /. ROW  -->
                        </div>
                    </div>  
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
    