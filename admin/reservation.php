<?php 
    // Include the database config file 
    include_once 'db.php'; 
     
   
    $query = "SELECT * FROM room_category "; 
    $result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ระบบจัดการหอพัก</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 


<script type="text/javascript">
    $(function () {
        $("#roomg").change(function () {
            if ($(this).val() == "2") {
                $("#Check-Out").hide();
            } else {
                $("#Check-Out").show();
            }
        });
    });
</script>

</head>
<body >
    <div id="wrapper">
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a  href="../homepage.php"><i class="fa fa-home"></i> Homepage</a>
                    </li>
                    
					</ul>

            </div>

        </nav>
       
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            การจองห้องพัก <small></small>
                        </h1>
                    </div>
                </div> 
                 
                                 
            <div class="row">
                
                <div class="col-md-5 col-sm-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            ข้อมูลส่วนบุคคล
                        </div>
                        <div class="panel-body">
						<form name="form" method="post">
                            <div class="form-group">
                                            <label>คำนำหน้าชื่อ*</label>
                                            <select name="prefix_name" class="form-control" required >
												<option value selected ></option>
                                                <option value="นาย">นาย</option>
                                                <option value="นาง">นาง</option>
                                                <option value="นางสาว">นางสาว</option>
                                                
                                            </select>
                              </div>
							  <div class="form-group">
                                            <label>ชื่อ</label>
                                            <input name="fname" class="form-control" required>
                                            
                               </div>
							   <div class="form-group">
                                            <label>นามสกุล</label>
                                            <input name="lname" class="form-control" required>
                                            
                               </div>

								<div class="form-group">
                                            <label>เบอร์โทร</label>
                                            <input name="phone" type ="text" class="form-control" required>
                                            
                            </div>
							   
                        </div>
                        
                    </div>
                </div>
                
                  
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            ข้อมูลการจอง
                        </div>
                        <div class="panel-body">
                              
                                <div class="form-group">
                                            <label>ประเภทการจอง *</label>
                                            <select id ="roomg" name="day_month"  class="form-control" required >
                                                <option value selected ></option>
                                                <option value="1">รายวัน</option>
                                                <option value="2">รายเดือน</option>
                                            </select>
                                </div>
                               
								<div class="form-group">
                                            <label>ประเภทห้อง *</label>
                                            <select id = "roomt" name="room_type"  class="form-control" required>
                                            <option value selected ></option>
                                            </select>
                              </div>              
                            

                              
                                        <?php   
                                            $day = date("d")+1;
                                        ?>
							  <div class="form-group">
                                            <label>Check-In</label>
                                            <input name="day_checkin" type ="date" class="form-control" min="<?php echo date('Y-m-d');?>">
                                            
                               </div>
							   <div class="form-group" id="Check-Out">
                                            <label>Check-Out</label>

                                            <input id="day_checkout" name="day_checkout" type ="date" class="form-control" min="<?php echo date('Y-m-'.$day.'');?>">
                                            
                               </div>
                       </div>
                        
                    </div>
                </div>
				
				
                <div class="col-md-12 col-sm-12">
                    <div class="well">
                        <h4>การตรวจสอบความเป็นมนุษย์</h4>
                        <p>พิมพ์โค้ดนี้ใส่ในช่องด้านล่าง <?php $Random_code=rand(); echo$Random_code; ?> </p><br />
						
							<input  type="text" name="code1" title="random code" />
							<input type="hidden" name="code" value="<?php echo $Random_code; ?>" />
						<input type="submit" name="submit" class="btn btn-primary">
						<?php
                        
							if(isset($_POST['submit']))
							{
							$code1=$_POST['code1'];
							$code=$_POST['code']; 
							if($code1!="$code")
							{
							$msg="Invalide code"; 
							}
							else
							{
                                
									$con=mysqli_connect("localhost","root","","dormitory");
									$check="SELECT * FROM reserve WHERE phone = '$_POST[phone]'";

										$new ="รอตรวจสอบ";
										$newUser="INSERT INTO `reserve` (`prefix_name`, `fname`, `lname`, `phone`, `day_checkin`, `day_checkout`, `room_type`,`room_status`,`day_month`) 
                                        VALUES ('$_POST[prefix_name]','$_POST[fname]','$_POST[lname]','$_POST[phone]','$_POST[day_checkin]','$_POST[day_checkout]','$_POST[room_type]','$new','$_POST[day_month]')";
										if (mysqli_query($con,$newUser))
										{
											echo "<script type='text/javascript'> alert('จองเรียบร้อยแล้ว')</script>";
											
										}
										else
										{
											echo "<script type='text/javascript'> alert('เกิดข้อผิดพลาดในการจอง')</script>";
											
										}
									}

							$msg="Your code is correct";
							}
							
							?>
						</form>
							
                    </div>
                </div>
            </div>
           
                
                </div>
                    
            
				
					</div>
			 <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
   
</body>



</html>
