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

<?php
	include 'db.php';
	if(isset($_GET['uid'])){
		
		$errors = array();

		$id = $_GET['uid'];
        
        $id = base64_encode($id);

		$user_check_query = "SELECT * FROM user WHERE personal = '$id'";
        $query = mysqli_query($con, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if($id == ""){
            echo "<lable style='color:red;font-size:14px'><i class='fa fa-times-circle' ></i> กรุณาระบุบข้อมูลในช่องว่าง</lable>";
        }else if($result){
            if($result['personal'] === $id){
				echo "<lable style='color:red;font-size:14px'><i class='fa fa-times-circle' ></i> มีผู้ใช้นี้อยู่ในระบบแล้ว</lable>";
            }
        }else echo"<lable style='color:green;font-size:14px'><i class='fa fa-check-circle' ></i> สามารถใช้งานได้</lable>";
	}
    if(isset($_GET['rid'])){
  
		$errors = array();

		$id = $_GET['rid'];

		$user_check_query = "SELECT * FROM room WHERE room = '$id'";
        $query = mysqli_query($con, $user_check_query);
        $result = mysqli_fetch_assoc($query);
        if($id == null or $id == ''){
            echo "<lable style='color:red;font-size:14px'><i class='fa fa-times-circle' ></i> กรุณาระบุบข้อมูลในช่องว่าง</lable>";
        }
		else if($result){
            if($result['room'] === $id){
				echo "<lable style='color:red;font-size:14px'><i class='fa fa-times-circle' ></i> มีห้องนี้แล้ว</lable>";
            }

        }else echo"<lable style='color:green;font-size:14px'><i class='fa fa-check-circle' ></i> สามารถใช้งานได้</lable>";
	}
?>