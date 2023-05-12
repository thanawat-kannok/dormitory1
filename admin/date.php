<?php 
    $eng_date=time(); // เวลา
    $date = date("Y-m-d");// เก็บวันที่สมัคร และเปลี่ยนปีเป็น พ.ศ

    date_default_timezone_set('asia/bangkok');//เวลา
    $time = date('H:i:s');

    list($y_now, $m_now, $d_now) = explode('-', $date);

    $y_ks = date('Y')+543;
?>