<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
include ('db.php');

$id=$_GET['eid'];
if($id=="")
{
echo '<script>alert("Sorry ! Wrong Entry") </script>' ;
		header("Location: messages.php");


}

else{
	$year = date("Y")+543;
	$date_reg = date("d/m/$year");// เก็บวันที่สมัคร และเปลี่ยนปีเป็น พ.ศ

	date_default_timezone_set('asia/bangkok');//เวลา
    $date = date('H:i:s');


	$view="DELETE FROM `reserve` WHERE reservation_id ='$id' ";
	if($re = mysqli_query($con,$view))
	{
		$sql = "SELECT * FROM `reserve` WHERE reservation_id ='$id'";
		$resultg = $con->query($sql);
		$data = $resultg->fetch_assoc();
	
		$pname = $data['prefix_name'];
		$fname = $data['fname'];
		$lname = $data['lname'];

		$sql = "INSERT INTO event_log (personal,date,time,event) 
		VALUES ('".$_SESSION['personal']."', '$date_reg','$date','".$_SESSION['fname']." ".$_SESSION['lname']." ลบข้อมูลการจองของ $pname $fname $lname รหัสใบเสร็จที่ $id')";
		
		mysqli_query($con,$sql);

		echo '<script>alert("ลบข้อมูลเรียนร้อยแล้ว") </script>' ;
		header("Location: messages.php");
	}else {
		echo "Error";
	}


}







?>