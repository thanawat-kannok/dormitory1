<?php  
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 } 
include 'db.php';
include 'query.php';
if(!isset($_SESSION['premission']) == "Admin")
{
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
     <!-- Morris Chart Styles-->
   
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
</style>
<div id="wrapper">
<link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <a href="profit.php"><i class="fa fa-line-chart"></i> รายรับ</a>
                    </li>
                    <li>
                        <a href="contect.php"><i class="fa fa-edit"></i> การจัดการเว็บไซน์</a>
                    </li>
                    <li>
                        <a class="active-menu" href="log.php"><i class="fa fa-bug"></i> บันทึกประวัติ</a>
                    </li>
                    <!-- <li>
                    <a href="/dormitory/logout.php"  onclick="return confirm('ยืนยันการออกจากระบบ')"><i class="fa fa-sign-out fa-fw" ></i> ออกจากระบบ</a>
                    </li> -->

                    
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
   <!-- /. NAV SIDE  -->
   <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            บันทึกกิจกรรม
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
                            <form method='post' action=''>
                            <select class="form-control" style="width:100%" id="search" name="search45" onchange="form.submit()">
                                <option value="">--เลือกค้นหาสถานะ ผู้ใช้งาน--</option>
                                <option value="all">ทั้งหมด</option>
                                <option value="Admin">Admin</option>
                                <option value="Member">Member</option>
                            </select><br>
                            </form>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                   
                                <thead>
                                    <tr>
                                        
                                <th>#</th>
                                <th>วันที่</th>
                                <th>เวลา</th>
                                <th>กิจกรรมการกระทำ</th>
                                <th>สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $m=(int)date('m')-1;
                                $y=(int)date('Y');
                                $d=(int)date('d');
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
                                $date_check =  "$y-$m-$d";



                               

                            $i = 1;
                            if (isset($_POST['search45'])) {
                                $type_value = $_POST['search45'];
                                switch ($type_value) {
                                    case "Admin" :
                                        $sql1 = "SELECT U.premission as premission,E.personal as personal ,E.date as date, E.time as time,E.event as event
                                        FROM user as U,(SELECT * FROM event_log WHERE date >= '$date_check')as E WHERE U.personal = E.personal 
                                        and  U.premission = 'Admin'
                                        ORDER BY U.premission,E.id DESC";
                                        $row1 = mysqli_query($con,$sql1);
                                        while ($rower1 = mysqli_fetch_array($row1)){
                                    
                                            $date = $rower1['date'];
                                            list($y_543,$m_543,$d_543) = explode("-",$date);
                                            $y_543 = $y_543+543;
            
                                            $time = $rower1['time'];
                                            $event = $rower1['event'];
                                            $premission = $rower1['premission'];
                                            $personal = base64_decode($rower1['personal']);
                                
                                            echo "<tr>";
                                                echo   '<th>'.$i.'</th>
                                                        <th>'.$d_543."-".$m_543."-".$y_543.'</th>
                                                        <th>'.$time.'</th>
                                                        <th>'.$event.'</th>
                                                        <th>'.$premission.'</th>
                                            ';
                                            echo "</tr>";
                                            $i++;
                                            
                                        }  
                                    break;
                                    case "Member" :
                                        $sql1 = "SELECT U.premission as premission,E.personal as personal ,E.date as date, E.time as time,E.event as event
                                        FROM user as U,(SELECT * FROM event_log WHERE date >= '$date_check')as E WHERE U.personal = E.personal 
                                        and  U.premission = 'Member'
                                        ORDER BY U.premission,E.id DESC";
                                        $row1 = mysqli_query($con,$sql1);
                                        while ($rower1 = mysqli_fetch_array($row1)){
                                    
                                            $date = $rower1['date'];
                                            list($y_543,$m_543,$d_543) = explode("-",$date);
                                            $y_543 = $y_543+543;
            
                                            $time = $rower1['time'];
                                            $event = $rower1['event'];
                                            $premission = $rower1['premission'];
                                            $personal = base64_decode($rower1['personal']);
                                
                                            echo "<tr>";
                                                echo   '<th>'.$i.'</th>
                                                        <th>'.$d_543."-".$m_543."-".$y_543.'</th>
                                                        <th>'.$time.'</th>
                                                        <th>'.$event.'</th>
                                                        <th>'.$premission.'</th>
                                            ';
                                            echo "</tr>";
                                            $i++;
                                            
                                        }  
                                    break;
                                    case "all" :
                                        $sql1 = "SELECT U.premission as premission,E.personal as personal ,E.date as date, E.time as time,E.event as event
                                        FROM user as U,(SELECT * FROM event_log WHERE date >= '$date_check')as E WHERE U.personal = E.personal 
                                        ORDER BY U.premission,E.id DESC";
                                        $row1 = mysqli_query($con,$sql1);
                                        while ($rower1 = mysqli_fetch_array($row1)){
                                    
                                            $date = $rower1['date'];
                                            list($y_543,$m_543,$d_543) = explode("-",$date);
                                            $y_543 = $y_543+543;
            
                                            $time = $rower1['time'];
                                            $event = $rower1['event'];
                                            $premission = $rower1['premission'];
                                            $personal = base64_decode($rower1['personal']);
                                
                                            echo "<tr>";
                                                echo   '<th>'.$i.'</th>
                                                        <th>'.$d_543."-".$m_543."-".$y_543.'</th>
                                                        <th>'.$time.'</th>
                                                        <th>'.$event.'</th>
                                                        <th>'.$premission.'</th>
                                            ';
                                            echo "</tr>";
                                            $i++;
                                            
                                        }  
                                    break;
                                }
                            }else{
                                $sql1 = "SELECT U.premission as premission,E.personal as personal ,E.date as date, E.time as time,E.event as event
                                        FROM user as U,(SELECT * FROM event_log WHERE date >= '$date_check')as E WHERE U.personal = E.personal 
                                        ORDER BY U.premission,E.id DESC";
                                        $row1 = mysqli_query($con,$sql1);
                                        while ($rower1 = mysqli_fetch_array($row1)){
                                    
                                            $date = $rower1['date'];
                                            list($y_543,$m_543,$d_543) = explode("-",$date);
                                            $y_543 = $y_543+543;
            
                                            $time = $rower1['time'];
                                            $event = $rower1['event'];
                                            $premission = $rower1['premission'];
                                            $personal = base64_decode($rower1['personal']);
                                
                                            echo "<tr>";
                                                echo   '<th>'.$i.'</th>
                                                        <th>'.$d_543."-".$m_543."-".$y_543.'</th>
                                                        <th>'.$time.'</th>
                                                        <th>'.$event.'</th>
                                                        <th>'.$premission.'</th>
                                            ';
                                            echo "</tr>";
                                            $i++;
                                            
                                        }  
                            }
                            
                            ?>
                        </tbody>
                                </table>
                            </div>
                        </div>
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
