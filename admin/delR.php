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
        header("location: ../index.php");
    }

    if(isset($_GET['delR'])){
        $id = $_GET['delR'];
        
        $personal = $_SESSION['personal_admin'];

        $event = "INSERT INTO event_log (personal,date,time,event) 
        VALUES ('$personal', '$date','$time','".$_SESSION['fname_A']." ".$_SESSION['lname_A']." ลบห้อง $id ')";
        mysqli_query($con,$event);

        $sqli = mysqli_query($con,"DELETE FROM receipt WHERE room = $id");

        $sqle = mysqli_query($con,"DELETE FROM unit WHERE room = $id");

        $sql = "DELETE FROM room WHERE room = $id";

        $sqll = mysqli_query($con,"UPDATE `user` SET `room`= null WHERE room = '$id'");
        
        $con->query($sql);
        
        if($con->query($sql) == true){

            echo "<script type='text/javascript'> alert('ลบห้อง $id เรียบร้อยแล้ว')</script>";
            echo "<script type='text/javascript'> window.location='month.php'</script>";
        }else{
            "Error Isset";
        }
    }

    if(isset($_GET['delE'])){
        $id = $_GET['delE'];

        $sql = "DELETE FROM room_details WHERE id = $id";
        $detphoto = mysqli_query($con,"DELETE FROM `picture_details` WHERE id_type = '$id'");

        if($con->query($sql) == true){
        
            echo "<script type='text/javascript'> alert('ลบชนิดห้อง $id เรียบร้อยแล้ว')</script>";
            echo "<script type='text/javascript'> window.location='editR.php?addDR'</script>";
        }else{
               echo "<script type='text/javascript'> alert('กรุณาลบห้องออกก่อน')</script>";
            echo "<script type='text/javascript'> window.location='editR.php?addDR'</script>";
        }

    }

    if(isset($_GET['delRU'])){
        $id = $_GET['delRU'];
        $personal = $_SESSION['personal_admin'];

        
        list($id, $room) = explode('/', $id);

        $count = mysqli_query($con,"SELECT COUNT(room) as counting FROM `user` WHERE room = $room");
        $counter = mysqli_fetch_array($count);
        if($counter['counting'] <= '1'){
            mysqli_query($con,"UPDATE `room` SET `room_status`='ว่าง' WHERE room = $room");
        }

        mysqli_query($con,"UPDATE `user` SET `room`= null WHERE personal = '$id'");
        $event = "INSERT INTO event_log (personal,date,time,event) 
        VALUES ('$personal', '$date','$time','".$_SESSION['fname_A']." ".$_SESSION['lname_A']." ลบผู้ใช้ ออกจากห้อง $room')";
        mysqli_query($con,$event);
        echo "<script type='text/javascript'> alert('ลบผู้ใช้ออกจากห้องเรียบร้อย')</script>";
        echo "<script type='text/javascript'> window.location='editR.php?eid=$room'</script>";
    }

    if(isset($_GET['delU'])){
        $id = $_GET['delU'];
        $ddt = mysqli_query($con,"SELECT * FROM user WHERE personal = '$id'");
        $user11 = mysqli_fetch_array($ddt);
        $fullname = array($user11['prefix_name'].' '.$user11['fname'].' '.$user11['lname']);
        $personal = $_SESSION['personal_admin'];
        
        mysqli_query($con,"DELETE FROM `user` WHERE personal = '$id'");
        $event = "INSERT INTO event_log (personal,date,time,event) 
        VALUES ('$personal', '$date','$time','".$_SESSION['fname_A']." ".$_SESSION['lname_A']." ลบผู้ใช้ $fullname[0]')";
        mysqli_query($con,$event);
        echo "<script type='text/javascript'> alert('ลบผู้ใช้ เรียบร้อย')</script>";
        echo "<script type='text/javascript'> window.location='user.php'</script>";
    }

    if(isset($_GET['del_photo'])){
        $id = $_GET['del_photo'];

        $ddt2 = mysqli_query($con,"SELECT * FROM user WHERE personal = '$id'");
        $user12 = mysqli_fetch_array($ddt2);
            $fullname = array($user12['perfix_name']." ".$user12['fname']." ".$user12['lname']);

            @unlink ("../imge/personal_photo/".$user12['idcard_picture']."");
        mysqli_query($con,"UPDATE `user` SET `idcard_picture` = null WHERE personal = '$id'");
        
        $personal = $_SESSION['personal_admin'];

        $event = "INSERT INTO event_log (personal,date,time,event) 
        VALUES ('$personal','$date','$time','".$_SESSION['fname_A']." ".$_SESSION['lname_A']." ลบรูปผู้ใช้ ชื่อ $fullname[0] ')";
        mysqli_query($con,$event);

        echo "<script type='text/javascript'> alert('ลบรูปผู้ใช้ ชื่อ $fullname[0] เรียบร้อย')</script>";
        echo "<script type='text/javascript'> window.location='editU.php?eid_U=$id'</script>";

   
    }
    
    if(isset($_GET['del_photoD'])){
        $id = $_GET['del_photoD'];

        $ddt2 = mysqli_query($con,"SELECT * FROM user WHERE personal = '$id'");
        $user12 = mysqli_fetch_array($ddt2);
        $room = $user12['room'];
            $fullname = array($user12['perfix_name']." ".$user12['fname']." ".$user12['lname']);
            @unlink ("../imge/personal_photo/".$user12['idcard_picture']."");
        mysqli_query($con,"UPDATE `user` SET `idcard_picture` = null WHERE personal = '$id'");
        
        $personal = $_SESSION['personal_admin'];

        $event = "INSERT INTO event_log (personal,date,time,event) 
        VALUES ('$personal','$date','$time','".$_SESSION['fname_A']." ".$_SESSION['lname_A']." ลบรูปผู้ใช้ ชื่อ $fullname[0] ')";
        mysqli_query($con,$event);

        echo "<script type='text/javascript'> alert('ลบรูปผู้ใช้ ชื่อ $fullname[0] เรียบร้อย')</script>";
        echo "<script type='text/javascript'> window.location='dataR.php?dataR=$room'</script>";

   
    }

    if(isset($_GET['delD_image'])){
        $id = $_GET['delD_image'];

        
        list($tid,$pid,$p_data) = explode('/',$id);


        $count = mysqli_query($con,"SELECT COUNT(picture) as count_p FROM `picture_details` WHERE picture  = $pid");
        $count_p = mysqli_fetch_array($count);

        $counc = mysqli_query($con,"SELECT COUNT(picture) as count_c FROM `picture_details` WHERE `id_type` = $tid");
        $count_c = mysqli_fetch_array($counc);

        $default = mysqli_query($con,"SELECT id as default_id FROM `room_picture` WHERE `room_picture`  = 'default.png'");
        $default_type = mysqli_fetch_array($default);

        $personal = $_SESSION['personal_admin'];

        if($count_c['count_c'] <= '1'){

            // echo "<script type='text/javascript'> alert('[loop1]')</script>";

            if($count_p['count_p'] <= '1' and $p_data != "default.png"){
                // echo "<script type='text/javascript'> alert('[A] data $p_data id_type $tid id $pid')</script>";
                @unlink ("../assets/img/".$p_data."");
                mysqli_query($con,"UPDATE `picture_details` SET `picture`='".$default_type['default_id']."' WHERE id_type = '$tid' and picture = $pid");
                mysqli_query($con,"DELETE FROM `room_picture` WHERE id = '$pid'");
            }else{      
                // echo "<script type='text/javascript'> alert('[B] data $p_data id_type $tid id $pid')</script>";
                mysqli_query($con,"UPDATE `picture_details` SET `picture`='".$default_type['default_id']."' WHERE id_type = '$tid' and picture = $pid");
            }
        }else{
            mysqli_query($con,"DELETE FROM `picture_details` WHERE `id_type` = '$tid' and `picture`= '$pid'");
        }

        $event = "INSERT INTO event_log (personal,date,time,event) 
        VALUES ('$personal','$date','$time','".$_SESSION['fname_A']." ".$_SESSION['lname_A']." ลบรูปชนิดห้อง รหัส $tid / $pid')";
        mysqli_query($con,$event);

        echo "<script type='text/javascript'> alert('ลบรูป $pid ชนิดห้อง $tid เรียบร้อย')</script>";
        echo "<script type='text/javascript'> window.location='editD.php?eid_note=$tid'</script>";

    }
?>