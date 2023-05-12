<?php
include('server.php');
if (!isset($_SESSION)) {
  session_start();
}
$Header = mysqli_query($con, "SELECT * FROM paper_details ");
$hd = mysqli_fetch_array($Header);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
    <link href="css/style_home.css" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/datepicker-th.js"></script>

<body>
    <header id="header" class="fixed-top" style="background-color:white">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo" style="font-family: supermarket"><a href="index.php"><?php echo $hd['header'] ?></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="getstarted scrollto" href="index.php">หน้าหลัก</a></li>

                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <style>
    body {
        font-size: 19px;
        font-family: 'Prompt', sans-serif;
        margin: 70px auto;
    }

    @media screen and (max-width:550px) {}

    .btn {
        background-color: #04AA6D;
        color: #ffffff;
        border: none;
        border: 1px solid black;
        font-size: 20px;
        font-family: Raleway;
        cursor: pointer;
    }

    .btn:hover {
        opacity: 0.5;
    }

    .wall {
        margin: 5px 15px;
        border: 5px solid black;
        padding: 20px 15px;
    }

    hr {
        border: 5px solid black;
    }
    </style>
    <form action="ForgotPassword_db.php" method="post">
        <div class="container">
            <center>
                <h1>กรุณาระบุบข้อมูลให้ครบทุกช่อง</h1>
                <?php if (isset($_SESSION['error'])) : ?>
                <div class="errors">
                    <h3>
                        <?php
              echo "<center>" . $_SESSION['error'];
              unset($_SESSION['error']);
              ?>
                    </h3>
                </div>
                <?php endif ?>
                <?php if (isset($_SESSION['error2'])) : ?>
                <div class="errors">
                    <h3>
                        <?php
              echo "<center>" . $_SESSION['error2'];
              unset($_SESSION['error2']);
              ?>
                    </h3>
                </div>
                <?php endif ?>
                <?php if (isset($_SESSION['error3'])) : ?>
                <div class="errors">
                    <h3>
                        <?php
              echo "<center>" . $_SESSION['error3'];
              unset($_SESSION['error3']);
              ?>
                    </h3>
                </div>
                <?php endif ?>
                <?php if (isset($_SESSION['error4'])) : ?>
                <div class="errors">
                    <h3>
                        <?php
              echo "<center>" . $_SESSION['error4'];
              unset($_SESSION['error4']);
              ?>
                    </h3>
                </div>
                <?php endif ?>
            </center>
            <div class="card wall">

                <label class="text">บัตรประชาชน <lable style="color:red">*</lable></label>
                <input name="personal" id="personal" class="form-control" onchange="return personal(this)"
                    maxlength="13" minlength="13" required placeholder="เลขบัตรประชาชน">
                <div class="error" id="error"></div>
                <hr>
                <label>วันเกิด <lable style="color:red">*</lable></label>
                <input name="date" type="text" id="date" onchange="calAge(this);" required>
                <hr id="level">
                <label class="text">ไอดี ไลน์</label>
                <input name="line" class="form-control" placeholder="ID Line">
                <hr id="level">
                <div class="error" id="error"></div>
                <label class="text">เบอร์โทรศัพท์ <lable style="color:red">*</lable></label>
                <input name="telephone_number" class="form-control" required maxlength="10" minlength="10"
                    onkeypress="return CharacterFormat(this,event,1);" placeholder="088***6565">
                <hr id="level">
            </div>
            <center>
                <input type="submit" name="check_plass" class="btn" value="เปลี่ยนรหัสผ่าน">
            </center>
        </div>
    </form>
</body>

</html>

<script>
$.datepicker.setDefaults($.datepicker.regional["th"]);

// Birth date
$("#date").datepicker({
    changeMonth: true,
    changeYear: true,
    yearRange: '+443:+543',
    dateFormat: 'dd/mm/yy',
    dayNamesMin: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
    monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.',
        'ธ.ค.'
    ],
    onSelect: function(date) {
        $("#edit-date-of-birth").addClass('filled');
    }
});
$('#date').datepicker("setDate", currentDate);
</script>