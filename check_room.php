<?php
// Include the database config file 
include_once 'server.php';

if (isset($_GET['date_check'])) {
    $date_check = $_GET['date_check'];
    list($date_in,$date_out) = explode('/', $date_check);

    list($d_in,$m_in,$y_in) = explode('-', $date_in);
    list($d_out,$m_out,$y_out) = explode('-', $date_out);

    $date_in = $y_in.'-'.$m_in.'-'.$d_in;
    $date_out = $y_out.'-'.$m_out.'-'.$d_out;
    
    $date_now = date('Y-m-d');
    // $date_out = $_GET['date_check_out'];
    // echo '<option value="">'.$date_now.'/'.$date_in.'/'.$date_out.'</option>';
    
    $see_c_d = mysqli_query($con,"SELECT  SUM(`room_count`) as count FROM `reserve` 
    WHERE `reserve_status` = 'ชำระแล้ว' AND day_checkin BETWEEN '$date_now' AND '$date_in'
    AND day_checkout BETWEEN '$date_now' AND '$date_out'");

    $count_r = mysqli_query($con,"SELECT COUNT(room) as count FROM `room`,`room_details` 
    WHERE room.type = room_details.id and room_details.reservation = 1");
    
    $cout_reserve = mysqli_fetch_array($see_c_d);
    $count_room = mysqli_fetch_array($count_r);
    $c_reserve = $cout_reserve['count'];
    $c_room = $count_room['count'];
    
    $check_count_room_not_null = $c_room - $c_reserve;

        $i = 1;
        $z = $check_count_room_not_null; 
    if($z >= 1){
        while($i <= $z){
            echo '<option value="'.$i.'">'.$i.' ห้อง</option>';
            $i++;
        }
    }else{
            echo '<option  value="">ห้องพักไม่ว่าง ระหว่างวันที่ '.$d_in.'-'.$m_in.'-'.$y_in.' ถึง '.$d_out.'-'.$m_out.'-'.$y_out.' </option>';
    }
  
}
?>