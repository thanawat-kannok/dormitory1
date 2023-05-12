<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    include '../server.php';
    include 'date.php';


    if(isset($_GET['id'])){
        $id = $_GET['id'];
        

        $event = "INSERT INTO event_log (personal,date,time,event) 
        VALUES ('" . $_SESSION['personal_admin'] . "', '$date','$time','" . $_SESSION['fname_A'] . " " . $_SESSION['lname_A'] . " ลบรหัสการจอง $id ')";
        mysqli_query($con,$event);

        $sql = "DELETE FROM reserve WHERE reservation_id = $id";
        $con->query($sql);
	
        
        if($con->query($sql) == true){
    
            echo "<script type='text/javascript'> alert('ลบการจองรียบร้อยแล้ว $id')</script>";
            echo "<script type='text/javascript'> window.location='home.php'</script>";
            
        }else{
            "Error Isset";
        }
    }else  echo "error";
?>