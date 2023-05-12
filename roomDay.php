<?php ini_set('display_errors', false); ?>
   <?php 
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        ?>
    <?php include 'server.php'; ?>
    <?php 
        $Header =mysqli_query($con,"SELECT * FROM paper_details ");
        $hd = mysqli_fetch_array($Header);
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title><?php echo $hd['header']?></title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="assets/img/icon.png" rel="icon">
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
        <link href='https://css.gg/search.css' rel='stylesheet'>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
        </script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap" rel="stylesheet">
        <!-- =======================================================
    * Template Name: OnePage - v4.3.0
    * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->

    </head>

    <style>
        @media screen and (max-width:550px){
            .respon{
                width:500px;
                height:auto;
            }
        .card-body {
            display: block;
            margin: auto;
            width: 80%;
            height: 20%;
        }
    }
    .respon{
        width:400px;
        height:300px;
    }
    * {
        box-sizing: border-box;
        font-family: 'Prompt', sans-serif;
        font-weight: bold;  
    }

    body {
        background-color: #f1f1f1;
        padding: 20px;
        font-family: Arial;
    }

    /* Center website */
    .main {
        max-width: 1000px;
        margin: auto;
    }

    h1 {
        font-size: 50px;
        word-break: break-all;
    }

    .row {
        margin: 10px -16px;
    }

    /* Add padding BETWEEN each column */
    .row,
    .row>.column {
        padding: 8px;
    }

    /* Create three equal columns that floats next to each other */
    .column {
        float: left;
        width: 33.33%;
        display: none;
        /* Hide all elements by default */
    }

    /* Clear floats after rows */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Content */
    .content {
        background-color: white;
        padding: 10px;
    }

    /* The "show" class is added to the filtered elements */
    .show {
        display: block;
    }

    /* Style the buttons */
    .btn {
        border: none;
        outline: none;
        padding: 12px 16px;
        background-color: white;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #ddd;
    }

    .btn.active {
        background-color: #666;
        color: white;
    }

    .buttons {
        border: none;
        outline: 0;
        display: inline-block;
        padding: 8px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
    }

    .buttons:hover {
        background-color: #555;
    }



    .img-fluid {
        padding: 20px;
        width: 100%;
    }

    .bg-light {
        margin: 20px;
    }

    .portfolio {
        margin-top: 10px;
    }

    .btn-primary {
        background-color: blue;
        float: right;
    }

    .project-category {
        padding: 20px;
    }

    .img {
        display: none;
    }

    .mySlides {
        display: none;
    }

    * {
        box-sizing: border-box;
    }

    .row>.column {
        padding: 0 8px;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .column {
        float: left;
        width: 25%;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: black;
    }

    /* Modal Content */
    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        width: 90%;
        max-width: 1200px;
    }

    /* The Close Button */
    .close {
        color: white;
        position: absolute;
        top: 10px;
        right: 25px;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #999;
        text-decoration: none;
        cursor: pointer;
    }

    .mySlides {
        display: none;
    }

    .cursor {
        cursor: pointer;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    img {
        margin-bottom: -4px;
    }

    .caption-container {
        text-align: center;
        background-color: black;
        padding: 2px 16px;
        color: white;
    }

    .demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }

    img.hover-shadow {
        transition: 0.3s;
    }

    .hover-shadow:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .font1 {
        font-family: supermarket;
    }

    .MultiCarousel {
        float: left;
        overflow: hidden;
        padding: 15px;
        width: 100%;
        position: relative;
    }

    .MultiCarousel .MultiCarousel-inner {
        transition: 1s ease all;
        float: left;
    }

    .MultiCarousel .MultiCarousel-inner .item {
        float: left;
    }

    .MultiCarousel .MultiCarousel-inner .item>div {
        text-align: center;
        padding: 10px;
        margin: 10px;
        background: #f1f1f1;
        color: #666;
    }

    .MultiCarousel .leftLst,
    .MultiCarousel .rightLst {
        position: absolute;
        border-radius: 50%;
        top: calc(50% - 20px);
    }

    .MultiCarousel .leftLst {
        left: 0;
    }

    .MultiCarousel .rightLst {
        right: 0;
    }

    .MultiCarousel .leftLst.over,
    .MultiCarousel .rightLst.over {
        pointer-events: none;
        background: #ccc;
    }
    .hd{
        background-color:#DCDCDC;
        color:green;
        padding:0px 10px;
        border-radius:10px;
    }
    .hc{
        background-color:#FFE4B5;
        color:green;
        padding:15px 10px;
        border-radius:10px;
    }
    .he{
        background-color:#DCDCDC;
        color:black;
        padding:15px 10px;
        border-radius:10px;
    }
    .ht{
        background-color:green;
        color:white;
        padding:0px 10px;
        border-radius:10px;
    }
    </style>
    <script language="JavaScript1.2">
    function disableselect(e) {
        return false
    }

    function reEnable() {
        return true
    }
    //if IE4+
    document.onselectstart = new Function("return false")
    //if NS6
    if (window.sidebar) {
        document.onmousedown = disableselect
        document.onclick = reEnable
    }


    $(document).ready(function() {
        var itemsMainDiv = ('.MultiCarousel');
        var itemsDiv = ('.MultiCarousel-inner');
        var itemWidth = "";

        $('.leftLst, .rightLst').click(function() {
            var condition = $(this).hasClass("leftLst");
            if (condition)
                click(0, this);
            else
                click(1, this)
        });

        ResCarouselSize();




        $(window).resize(function() {
            ResCarouselSize();
        });

        //this function define the size of the items
        function ResCarouselSize() {
            var incno = 0;
            var dataItems = ("data-items");
            var itemClass = ('.item');
            var id = 0;
            var btnParentSb = '';
            var itemsSplit = '';
            var sampwidth = $(itemsMainDiv).width();
            var bodyWidth = $('body').width();
            $(itemsDiv).each(function() {
                id = id + 1;
                var itemNumbers = $(this).find(itemClass).length;
                btnParentSb = $(this).parent().attr(dataItems);
                itemsSplit = btnParentSb.split(',');
                $(this).parent().attr("id", "MultiCarousel" + id);


                if (bodyWidth >= 1200) {
                    incno = itemsSplit[3];
                    itemWidth = sampwidth / incno;
                } else if (bodyWidth >= 992) {
                    incno = itemsSplit[2];
                    itemWidth = sampwidth / incno;
                } else if (bodyWidth >= 768) {
                    incno = itemsSplit[1];
                    itemWidth = sampwidth / incno;
                } else {
                    incno = itemsSplit[0];
                    itemWidth = sampwidth / incno;
                }
                $(this).css({
                    'transform': 'translateX(0px)',
                    'width': itemWidth * itemNumbers
                });
                $(this).find(itemClass).each(function() {
                    $(this).outerWidth(itemWidth);
                });

                $(".leftLst").addClass("over");
                $(".rightLst").removeClass("over");

            });
        }


        //this function used to move the items
        function ResCarousel(e, el, s) {
            var leftBtn = ('.leftLst');
            var rightBtn = ('.rightLst');
            var translateXval = '';
            var divStyle = $(el + ' ' + itemsDiv).css('transform');
            var values = divStyle.match(/-?[\d\.]+/g);
            var xds = Math.abs(values[4]);
            if (e == 0) {
                translateXval = parseInt(xds) - parseInt(itemWidth * s);
                $(el + ' ' + rightBtn).removeClass("over");

                if (translateXval <= itemWidth / 2) {
                    translateXval = 0;
                    $(el + ' ' + leftBtn).addClass("over");
                }
            } else if (e == 1) {
                var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                translateXval = parseInt(xds) + parseInt(itemWidth * s);
                $(el + ' ' + leftBtn).removeClass("over");

                if (translateXval >= itemsCondition - itemWidth / 2) {
                    translateXval = itemsCondition;
                    $(el + ' ' + rightBtn).addClass("over");
                }
            }
            $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
        }

        //It is used to get some elements from btn
        function click(ell, ee) {
            var Parent = "#" + $(ee).parent().attr("id");
            var slide = $(Parent).attr("data-slide");
            ResCarousel(ell, Parent, slide);
        }

    });
    </script>

    <body style="background-color:#708090;">


        <header id="header" class="fixed-top">
            <div class="container d-flex align-items-center justify-content-between">

                <h1 class="logo"><a href="index.php"><?php echo $hd['header']?></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a href="index.php">หน้าหลัก</a></li>
                        <li class="dropdown"><a href="#" class="nav-link scrollto active"><span>จองห้องพัก</span> <i
                                    class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="roomDay.php" class="nav-link scrollto active">รายวัน</a></li>
                                <li><a href="roomMonth.php">รายเดือน</a></li>
                            </ul>
                        </li>

                        <?php if (!isset($_SESSION['personal'])) : ?>
                        <li><a class="getstarted scrollto" href="login.php">เข้าสู่ระบบ</a></li>
                        <li><a class="getstarted scrollto" href="register.php">สมัครสมาชิก</a></li>
                        <?php endif ?>
                        <?php if (isset($_SESSION['personal'])) : ?>
                        <li><a href="user/index.php" class="getstarted scrollto"><?php echo $_SESSION['fname']; ?></a></li>
                        <li><a href="logout.php" class="getstarted scrollto">ออกจากระบบ</a></li>
                        <?php endif ?>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->
            </div>
        </header><!-- End Header -->

        <div class="card" style=" margin-top: 60px;">
            <div class="container">

                <?php
        
                $qry = $con->query("SELECT room_details.id,room_details.floor,room_details.price,room_type.name 
                AS type_name,bed_type.name AS bname,bed_type.size,bed_type.detal,room_picture.room_picture,room_category.name
                AS cname,room_category.status FROM room_type INNER JOIN room_details ON(room_type.id = room_details.type)
                    INNER JOIN bed_type ON(room_details.bed = bed_type.id) INNER JOIN room_category ON(room_details.reservation = room_category.id)
                    INNER JOIN picture_details ON(room_details.id = picture_details.id_type) INNER JOIN 
                    room_picture ON(picture_details.picture = room_picture.id)  WHERE room_details.reservation = 1 AND room_type.name = 'ห้องแอร์'
                    GROUP BY bed_type.id");
                while ($row = $qry->fetch_assoc()) :

                    $roomid = $row['id'];

                    $urd1 = mysqli_query($con, "SELECT room_details.id, COUNT(*) AS countroom FROM room INNER JOIN room_details ON(room.type = room_details.id) WHERE room_status = 'ว่าง' AND room_details.id = '$roomid' ");
                    $countroom = mysqli_fetch_array($urd1);
                    $date_now = date('Y-m-d');
                    $sate = mysqli_query($con,"SELECT * FROM `clost_reservation` WHERE '$date_now' = date_clost");
                    $date_clost_list = mysqli_fetch_assoc($sate);
                       
                ?>

                <div class="row">

                    <div class="col-md-5">
                        <div class="MultiCarousel" data-items="1,-1,0,1,2" data-slide="1" id="MultiCarousel"
                            data-interval="1000">

                            <div class="MultiCarousel-inner">
                                <?php

                                    $rd = $con->query("SELECT room_picture.room_picture FROM  picture_details  INNER JOIN room_picture 
                                    ON (picture_details.picture = room_picture.id) WHERE picture_details.id_type = '$roomid' ORDER BY room_picture.id ASC");
                                while ($rowrd = $rd->fetch_assoc()) :
                                ?>
                                <div class="item">
                                    <div class="pad15">
                                        <img src="assets/img/<?php echo $rowrd['room_picture'] ?>"
                                            onclick="openModal();currentSlide(1)"
                                            class="hover-shadow cursor respon">
                                    </div>
                                </div>
                                <?php endwhile ?>
                            </div>

                            <button class="btn btn-primary leftLst">
                            < </button>

                                    <button class="btn btn-primary rightLst">></button>
                        </div>
                    </div>
                    <div class="col-md-5" height="100%">

                        <div class="project-name" name="name">
                            <h3 style="font-family: supermarket"><lable class='hd'>ห้อง <?php echo $row['cname'] ?></lable></h3>

                        </div>
                        
                        <div class="project-name hc" name="name">
                            <h4 style="font-family: supermarket">เตียง <?php echo $row['bname'] ?> ขนาด
                                <?php echo $row['size'] ?></h4>
                        </div>
                        <hr>
                        <div class="project-name he" name="name">
                            <h6 style="font-family: supermarket"><?php echo $row['detal'] ?></h6>
                        </div>
                        

                        <h3><b>
                                <div class="project-category text-white-30" style="font-family: supermarket">
                                    <?php echo "<lable class='ht'>฿ " . number_format($row['price'], 2)."</lable>" ?> /วัน</div>
                                <?php /*<div class="project-category text-white-30"><?php echo "฿ ".number_format($row['price_month'],2) ?>
                                /ต่อเดือน
                    </div>
                    </h3> */ ?>
                    <?php if($countroom['countroom'] == "0" && $row['status'] == "0" && "$date_clost_list[date_clost]" === "$date_now"): ?>
                    <p style="color: red;">ห้องไม่ว่าง</p>
                    <div class="align-self-end mt-5">
                        <a href=reservation.php?id=<?php echo $row['id'] ?> style="font-family: supermarket"> <button
                                class="btn btn-primary float-right" style="background-color: #008CBA" disabled> <i
                                    class="fa fa-edit"></i> จองห้องพัก</button></a>
                    </div>

                    <?php endif ?>

                    <?php if($countroom['countroom'] == "0" && $row['status'] == "1" && "$date_clost_list[date_clost]" === "$date_now"): ?>
                    <p style="color: red;">ห้องไม่ว่าง</p>
                    <div class="align-self-end mt-5">
                        <a href=reservation.php?id=<?php echo $row['id'] ?> style="font-family: supermarket"> <button
                                class="btn btn-primary float-right" style="background-color: #008CBA" disabled> <i
                                    class="fa fa-edit"></i> จองห้องพัก</button></a>
                    </div>

                    <?php endif ?>

                   

                    <?php if($countroom['countroom'] > "0" && $row['status'] == "1" && "$date_clost_list[date_clost]" != "$date_now"): ?>
                    <div class="align-self-end mt-5">
                        <a href=reservation.php?id=<?php echo $row['id'] ?> style="font-family: supermarket"> <button
                                class="btn btn-primary float-right" style="background-color: #008CBA"> <i
                                    class="fa fa-edit"></i> จองห้องพัก</button></a>
                    </div>

                    <?php endif ?>

                    <?php if($countroom['countroom'] > "0" && $row['status'] == "0" || "$date_clost_list[date_clost]" === "$date_now"): ?>
                    <p style="color: red;">ห้องไม่ว่าง</p>
                    <div class="align-self-end mt-5">
                        <a href=reservation.php?id=<?php echo $row['id'] ?> style="font-family: supermarket"> <button
                                class="btn btn-primary float-right" style="background-color: #008CBA" disabled> <i
                                    class="fa fa-edit"></i> จองห้องพัก</button></a>
                    </div>

                    <?php endif ?>


                </div>
                <hr style='border:3px solid black'>
            </div>

            <?php endwhile; ?>

        </div>




        <!-- Vendor JS Files -->
        <script src="assets/vendor/aos/aos.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>
        <script src="assets/vendor/purecounter/purecounter.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script>
        function showCustomer(str) {
            var xhttp;
            if (str == "") {
                document.getElementById("modalbody").innerHTML = "";
                return;
            }
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("modalbody").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "ajax.php?q=" + str, true);
            xhttp.send();
        }
        </script>

    </body>

    </html>