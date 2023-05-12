<?php 
  if(!isset($_SESSION)) 
     { 
         session_start(); 
     } 
     include('server.php');
  $Header =mysqli_query($con,"SELECT * FROM paper_details ");
  $hd = mysqli_fetch_array($Header);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Home</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/register.css" rel="stylesheet">
    <script src="/dormitory/assets/jquery.min.js"></script>
    <script src="/dormitory/assets/script.js"></script>


    <link href="css/style_home.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: OnePage - v4.3.0
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap"
        rel="stylesheet">

</head>
<style>
body {
    font-family: 'Prompt', sans-serif;
}

.rower {
    background-color: #DCDCDC;
    border-radius: 5px;
    margin: 10% auto;
    width: 40%;
}

.text {
    background-color: #778899;
    color: white;
    border: 1px solid black;
    border-radius: 5px;
    padding: 3px 10px;
}


h1 {
    text-align: center;
}

input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
    background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
    display: none;
}

button {
    background-color: #04AA6D;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer;

}

button:hover {
    opacity: 0.8;
}

@media screen and (max-width:550px) {
    .rower {
        width: 80%;
        margin: 20% auto;
        font-size: 14px;
    }
}
</style>

<body style="background-color: rgb(150, 140, 140);">
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top" style="background-color:white">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo" style="font-family: supermarket"><a href="index.php"><?php echo $hd['header']?></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="getstarted scrollto" href="index.php">หน้าหลัก</a></li>
                    <li><a href="register.php" style="font-size:20px;">สมัครสมาชิก</a></li>
                    <li><a class="bi bi-person-fill" style="font-size:20px;color:red">เข้าสู่ระบบ</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <form action="login_db.php" method="post">

        <div class="rower">

            <div class="container">
                <div class="row">
                    <h1 class="text" style="border-radius:5px 5px 0px 0px;">เข้าสู่ระบบหอพัก</h1>

                    <?php if(isset($_SESSION['error'])):?>
                    <div class="error">
                        <h3>
                            <?php
					echo "<center  style='color:red;'>".$_SESSION['error'];
					unset($_SESSION['error']);
					?>
                        </h3>
                    </div>
                    <?php endif ?>
                    <?php if(isset($_SESSION['success'])):?>
                    <div class="error">
                        <h3>
                            <?php
					echo "<center  style='color:green;'>".$_SESSION['success'];
					unset($_SESSION['success']);
					?>
                        </h3>
                    </div>
                    <?php endif ?>
                    <!-- One "tab" for each step in the form: -->
                    <div>รหัสบัตรประชาชน:
                        <p><input maxlength="13" minlength="13" class="form-control" placeholder="รหัสบัตรประชาชน"
                                name="personal" required onkeypress="return CharacterFormat(this,event,1);"></p>
                        <div>รหัสผ่าน:
                            <p><input type="password" class="form-control" placeholder="รหัสผ่าน" name="password"
                                    required></p>

                        </div>
                        <p>
                            <button type="submit" name="homepage" class="button">เข้าสู่ระบบ</button>
    </form>
    <a href="register.php" class="button" style="float:left;margin: 20px;">สมัครสมาชิก</a>
    <a href="assets/manual/คู่มือการใช้งาน.pdf" class="button" style="float:right;margin: 20px;">คู่มือการใช้งาน</a>
    <a href="ForgotPassword.php" class="button" style="float:right;margin: 20px;">ลืมรหัสผ่าน</a>
    </p>
    </div>

    </div>
    </div>
</body>

</html>
<script src="assets/jquery.min.js"></script>
<script src="assets/script.js"></script>
<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "ต่อไป";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false
            valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}
</script>
<script type="text/javascript">
function getiever() {
    var rv = -1; // Return value assumes failure.
    if (navigator.appName == 'Microsoft Internet Explorer') {
        var ua = navigator.userAgent;
        var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
        if (re.exec(ua) != null)
            rv = parseFloat(RegExp.$1);
    }
    return rv;
}

function checkIE() {
    var msg = "";
    var ver = getiever();
    if (ver > -1) {
        if (ver >= 8.0)
            msg = "8";
        else if (ver == 7.0)
            msg = "7";
        else if (ver == 6.0)
            msg = "6";
        else
            msg = "<6";
    }
    return msg;
}

function CharacterFormat(fld, e, format) {
    var ie = checkIE();
    if (format == 1)
        var strCheck = '0123456789';
    else if (format == 2)
        var strCheck = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    else if (format == 3)
        var strCheck = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890._-';
    else if (format == 4)
        var strCheck = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890._-@';

    var len = 0;
    if (ie == 8)
        var whichCode = e.keyCode;
    else
        var whichCode = (window.Event) ? e.which : e.keyCode;

    key = String.fromCharCode(whichCode);

    if (whichCode == 8 || whichCode == 0 || whichCode == 13) {

    } else {

        key = String.fromCharCode(whichCode);

        if (strCheck.indexOf(key) == -1) return false;
    }
}
</script>