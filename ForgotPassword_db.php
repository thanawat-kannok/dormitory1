<?php
    include("server.php");
    $errors = array();
    if(!isset($_SESSION)) 
     { 
         session_start(); 
     }
?>

<?php
    if(isset($_POST['check_plass'])){
        $personal = $_POST['personal'];
        $personal = base64_encode($personal);
        $decode = base64_decode($personal);
        $_SESSION['decode'] = $decode;
        $_SESSION['personal'] = $personal;
        $line = $_POST['line'];
        $phone = $_POST['telephone_number'];

        $dob = $_POST['date'];

        list($d, $m, $y) = explode('/', $dob);
        $dobcheak = $y-543 . '-' . $m . '-' . $d ;
            // $d = $_POST['day'];
            // $m = $_POST['month'];
            // $y = $_POST['year'];
            // $dob = $d.'/'.$m.'/'.$y;

	    $user_check_query = "SELECT * FROM user WHERE personal = '$personal' ";
        $query = mysqli_query($con, $user_check_query);
        $result = mysqli_fetch_assoc($query);

            if($result['personal'] !== $personal){
                array_push($errors,"Errors");
                $_SESSION['error']= "ไม่มีชื่อผู้ใข้ในระบบ";
                header('location: ForgotPassword.php');

            }
            if($result['line'] !== $line){
                array_push($errors,"Errors");
                $_SESSION['error2']= "ไม่มีIDไลน์นี้ในระบบ";
                header('location: ForgotPassword.php');
            }

            if($result['phone'] !== $phone){
                array_push($errors,"Errors");
                $_SESSION['error3']= "เบอร์โทร์ไม่มีในระบบ";
                header('location: ForgotPassword.php');
            }

            if($result['dob'] !== $dobcheak){
                array_push($errors,"Errors");
                $_SESSION['error4']= "วันเกิดไม่ตรงตามข้อมูล";
                header('location: ForgotPassword.php');
            }
        }
            if(isset($_POST['edit'])){
            $date = date("Y-m-d");// เก็บวันที่สมัคร และเปลี่ยนปีเป็น พ.ศ
        
            date_default_timezone_set('asia/bangkok');//เวลา
            $time = date('H:i:s');

                $psw1 = mysqli_real_escape_string($con, $_POST['password_new']);
                $psw2 = mysqli_real_escape_string($con, $_POST['password_new_confrime']);

                $check_pws = "SELECT * FROM user WHERE password = '$psw1'";
                $query = mysqli_query($con, $check_pws);
                $result = mysqli_fetch_assoc($query);

                if($psw1 != $psw2){
                    echo "<script>
                            alert('รหัสผ่านไม่ตรงกัน');
                        </script>";
                }

                if($psw1 == $psw2){
                    
                    $password= md5($psw1);
                    $sql = "UPDATE user SET
                            password = '".md5($_POST["password_new"])."'
                            WHERE personal = '".$_SESSION['personal']."' ";
            
            
                    if($con->query($sql) === TRUE){

                        $sql = "INSERT INTO event_log (personal,date,time,event) 
                        VALUES ('".$_SESSION['personal']."', '$date','$time','".$_SESSION['decode']." เปลี่ยนแปลงรหัสผ่าน')";
                        mysqli_query($con,$sql);
                
                        echo "<script>
                            alert('เปลี่ยนแปลงรหัสผ่านสำเร็จ'+ '".$_SESSION['decode']." ');
                            window.location='login.php';
                        </script>";
                    }
                    }
            }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="assets/js/check_plass.js" type="text/javascript"></script>
    <!--เช็ครหัสผ่านซํ้า -->
</head>
<style>
.container {
    width: 80%;
    background-color: #778899;
    margin: 100px 50px 10px 150px;
    box-shadow: 15px 15px 90px;
    height: 400px;
    font-family: supermarket;
    padding-top: 50px;
    border-radius: 10px;
}

* {
    font-size: 25px;
}

input {
    border-radius: 10px;
}

.rule {
    margin: 0;
    padding: 1rem;
    width: 19px;
    height: 19px;
    vertical-align: middle;
}

.btn {
    background-color: #04AA6D;
    color: #ffffff;
    border: none;
    border: 1px solid black;
    font-size: 20px;
    font-family: Raleway;
    cursor: pointer;
    margin: 10px;
    width: 20%;
    height: 50px;
}

.btn:hover {
    opacity: 0.5;
}
</style>

<body>
    <center>
        <form action="ForgotPassword_db.php" method="post">
            <div class="container">

                <div>รหัสผ่านใหม่</div>
                <input id="pass1" type="password" minlength="4" maxlength="25" name="password_new"
                    onchange="return pass(this)" required>

                <div>ยืนยันรหัสผ่านใหม่</div>
                <input id="pass2" type="password" minlength="4" maxlength="25" name="password_new_confrime"
                    onchange="return pass(this)" required>
                <br>
                <input type="checkbox" class="rule" onclick="myFunction()">
                <label for="myCheck">Show Password&nbsp</label>
                <lable class="fa fa-low-vision"></lable>
                <div style="margin-bottom:10px;font-size:20px;border:1px solid black;background-color:white;width:90%"
                    id="pass"></div>
                <br>
                <input type="submit" name="edit" class="btn" value="เปลี่ยนรหัสผ่าน">
            </div>
            <script>
            function myFunction() {
                var x = document.getElementById("pass1");
                var y = document.getElementById("pass2");
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
        </form>
    </center>
</body>

</html>