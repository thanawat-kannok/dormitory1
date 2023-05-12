<?php
$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
$thai_month_arr=array(
    "0"=>"",
    "1"=>"มกราคม",
    "2"=>"กุมภาพันธ์",
    "3"=>"มีนาคม",
    "4"=>"เมษายน",
    "5"=>"พฤษภาคม",
    "6"=>"มิถุนายน", 
    "7"=>"กรกฎาคม",
    "8"=>"สิงหาคม",
    "9"=>"กันยายน",
    "10"=>"ตุลาคม",
    "11"=>"พฤศจิกายน",
    "12"=>"ธันวาคม"                 
);
function thai_date($time){
    global $thai_day_arr,$thai_month_arr;
    $thai_date_return="วัน".$thai_day_arr[date("w",$time)];
    $thai_date_return.= "ที่ ".date("j",$time);
    $thai_date_return.=" เดือน".$thai_month_arr[date("n",$time)];
    $thai_date_return.= " พ.ศ.".date("Y",$time)+543;
    return $thai_date_return;
}

?>
<?php if(!isset($_SESSION)) 
     { 
         session_start(); 
     } ?>
<?php
    include("server.php");
    $errors = array();

    if(isset($_POST['reg_user'])){
        $d = $_POST['day'];
        $m = $_POST['month'];
        $y = $_POST['year'];
        //$dob = $y.'-'.$m.'-'.$d;
        $dob = $_POST['date'];
        $personal = mysqli_real_escape_string($con, $_POST['personal']);

        $personal = base64_encode($personal);
        
        $prefix_name = mysqli_real_escape_string($con, $_POST['prefix_name']);
        $fname = mysqli_real_escape_string($con, $_POST['fname']);
        $lname = mysqli_real_escape_string($con, $_POST['lname']);
        $sex = mysqli_real_escape_string($con, $_POST['sex']);
        $line = mysqli_real_escape_string($con, $_POST['line']);
        $phone = mysqli_real_escape_string($con, $_POST['telephone_number']);

        $districts = mysqli_real_escape_string($con,$_POST['district_id']);
        $road = mysqli_real_escape_string($con,$_POST['road']);
        $home_number = mysqli_real_escape_string($con, $_POST['home_number']);
        $village = mysqli_real_escape_string($con, $_POST['village']);
        
        $psw1 = mysqli_real_escape_string($con, $_POST['psw1']);
        $psw2 = mysqli_real_escape_string($con, $_POST['psw2']);


        if($psw1 != $psw2){
            array_push($errors,"Password is requried");
            $_SESSION['error']= "รหัสผ่านไม่ตรงกัน";
            header('location: ../dormitory/register.php');
        }else echo"Error psw";

        $user_check_query = "SELECT * FROM user WHERE personal = '$personal'";
        $query = mysqli_query($con, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if($result){
            if($result['personal'] === $personal){
                array_push($errors,"Username is Full");
                $_SESSION['error']= " รหัสบัตรประชาชนหมายเลขนี้มีผู้ใช้งานแล้ว ";
                header('location: ../dormitory/register.php');

            }
        }else echo"Error result";

        if(count($errors)==0){



            $password= md5($psw1);
            $year = date("Y")+543;
            $date_reg = date("d/m/$year");// เก็บวันที่สมัคร และเปลี่ยนปีเป็น พ.ศ

            $eng_date=time(); // แสดงวันที่ปัจจุบัน
            $time = date("h:i:s");
        
            date_default_timezone_set('asia/bangkok');//เวลา
            $date = date('H:i:s');

            $sql = "INSERT INTO user (personal,prefix_name,fname,lname,
            sex,dob,phone,line,districts,road,home_number,village,premission,password,rental_start_date) 
            VALUES ('$personal', '$prefix_name','$fname','$lname','$sex','$dob',
            '$phone','$line','$districts',
            '$road','$home_number','$village','Member','$password',null)";
            mysqli_query($con,$sql);

            // $sql = "INSERT INTO Time_log (personal,date_in,Time_in) 
            // VALUES ('$personal','".thai_date($eng_date)."','$date')";
            // mysqli_query($con,$sql);

            // $sql = "INSERT INTO address_db (personal,provinces,amphures,districts,full_address) 
            // VALUES ('$personal','$provinces1','$amphures1','$districts1','$Full_address')";
            // mysqli_query($con,$sql);

            $_SESSION['username'] =  $personal;
            $_SESSION['success'] = "สมัครสมาชิก เรียบร้อยแล้ว";
            header('location: ../dormitory/login.php');
        }
    }else{
        echo"Error";
    }
?>
