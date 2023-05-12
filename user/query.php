<?php
    include '../server.php';

    //select ข้อมูลเฉพราะห้องรายเดือน
    $check_room_M = mysqli_query($con,"SELECT room.room as room FROM `room` 
    INNER JOIN room_details on(room.type = room_details.id) 
    WHERE room_details.reservation = '2'");

    //select ข้อมูลตาราง room กับ room_details และเรียงลำดับ ชั้นที่อยู่ห้องห้องและชนิดห้อง จากน้อยไปมาก
    $R_details = mysqli_query($con,"SELECT room_type.name as tname, 
    bed_type.name as bname, 
    room_category.name as cname, 
    room.room as room, 
    room.room_detal as room_detal,
    room.room_status as room_status,
    room_details.price as price,
    room.unitPerWater as unitPerWater,
    room.unitPerElectricity as unitPerElectricity,
    room_details.floor as floor,
    room_category.name as reservation,
    room_details.other as other

    FROM room 
    
    INNER JOIN room_details on(room.type  = room_details.id) 
    INNER JOIN bed_type ON(room_details.bed = bed_type.id) 
    INNER JOIN room_type ON(room_type.id = room_details.type) 
    INNER JOIN room_category ON(room_details.reservation = room_category.id)
    INNER JOIN receipt ON(receipt.room = room.room)
    -- WHERE room.room = receipt.room and receipt.date = '2022-07-09'
    ORDER BY  `room`.`room`,`room_details`.`reservation` , `room_details`.`floor` ASC
    ");

     $check_room_M = mysqli_query($con,"SELECT room.room as room FROM `room` 
    INNER JOIN room_details on(room.type = room_details.id) 
    WHERE room_details.reservation = '2'");


    //ดึงข้อมูล ห้อง และ join ตารราง room_details
    $R_join_details = mysqli_query($con,"SELECT room_type.name as tname, 
    bed_type.name as bname, 
    room_category.name as cname, 
    room.room as room, 
    room.room_detal as room_detal,
    room.room_status as room_status,
    room_details.price as price,
    room.unitPerWater as unitPerWater,
    room.unitPerElectricity as unitPerElectricity,
    room_details.floor as floor,
    room_category.name as reservation,
    room_details.other as other

    FROM room 
    
    INNER JOIN room_details on(room.type  = room_details.id) 
    INNER JOIN bed_type ON(room_details.bed = bed_type.id) 
    INNER JOIN room_type ON(room_type.id = room_details.type) 
    INNER JOIN room_category ON(room_details.reservation = room_category.id)
    ORDER BY  `room`.`room`,`room_details`.`reservation` , `room_details`.`floor` ASC
    ");

    //เช็คข้อมูลตาราง room ให้เลขห้องตรงกับ receipt
    $check_R_r = mysqli_query($con,"SELECT room_type.name as tname, 
    bed_type.name as bname, 
    room_category.name as cname, 
    room.room as room, 
    room.room_detal as room_detal,
    room.room_status as room_status,
    room_details.price as price,
    room.unitPerWater as unitPerWater,
    room.unitPerElectricity as unitPerElectricity,
    room_details.floor as floor,
    room_category.name as reservation,
    room_details.other as other
    FROM receipt,room,room_details,room_category,bed_type,room_type 
    WHERE receipt.room = room.room 
    and room.type = room_details.id 
    and room_category.id = room_details.reservation 
    and bed_type.id = room_details.bed 
    and room_type.id = room_details.type
    ORDER BY  `room`.`room`,`room_details`.`reservation` , `room_details`.`floor` ASC
    ");


    

    // นับจำนวนการจองห้องที่จองเข้ามา
    $sql = "SELECT * FROM reserve";
    $re = mysqli_query($con,$sql);
    $c =0;
    while($row=mysqli_fetch_array($re) )
    {
            $new = $row['reserve_status'];
            if($new=="รออนุมัติ" or $new == "รอชำระเงิน")
            {
                $c = $c + 1;
            }
    }

    
    $sql = "SELECT * FROM user";
    $re = mysqli_query($con,$sql);
    $x =0;
    $y =0;
    $z =0;
    while($row=mysqli_fetch_array($re) )
    {
        //นับจำนวนผู้ใช้งาน ไม่มีห้อง
            $new_x = $row['room'];
            if($new_x == null or $new_x == "")
            {
                $x = $x + 1;
            }

        //นับจำนวนผู้ใช้งาน มีห้อง
            if($new_x != null or $new_x != "")
            {
                $y = $y + 1;
            }

        //นับจำนวนผู้ใช้งาน มีห้อง
            $z = $z + 1;

    }

    //แสดงข้อมูลชื่อหอพัก
    $Header =mysqli_query($con,"SELECT * FROM paper_details");
    $hd = mysqli_fetch_array($Header);
    
    //ดึงข้อมูล จังหวัด
    $query_address = mysqli_query($con, "SELECT * FROM provinces ORDER BY name_th ASC");

    //ดึงข้อมูล ผู้ใช้(user) ทั้งหมด
    $user_all = mysqli_query($con,"SELECT * from user");

    //ดึงข้อมูล ผู้ใช้(user) ทั้งหมด
    $user_all_2 = mysqli_query($con,"SELECT * from user");

    //ดึงข้อมูล ห้อง(room) ทั้งหมด
    $room_all = mysqli_query($con, "SELECT * FROM room");

    //ดึงข้อมูลห้องเฉพราะห้องรายเดือน
    $room_month = mysqli_query($con,"SELECT * FROM room,room_details 
    WHERE room.type = room_details.id 
    and room_details.reservation = '2' ORDER BY room ASC");

    //ดึงข้อมูล room_details ,bed_type ,room_type ,room_category
    $join_details = mysqli_query($con,"SELECT room_details.other as other,
    bed_type.name as Bname,room_category.name as data ,
    room_details.id as id, room_type.name as name ,
    room_details.floor as floor ,room_details.price as price
    FROM  room_details  
    INNER JOIN room_type ON(room_type.id = room_details.type) 
    INNER JOIN bed_type ON(room_details.bed = bed_type.id)
    INNER JOIN room_category ON(room_category.id = room_details.reservation)
    ORDER BY `room_type`.`name` ASC ");

    //ดึงข้อมูลทั้งหมดในตาราง unit
    $unit_all = mysqli_query($con, "SELECT * FROM unit");




    //ดึงข้อมูลตาราง room_category รายวัน
    $category_A = mysqli_query($con, "SELECT * FROM `room_category` WHERE id = '1'");

    //ดึงข้อมูลตาราง room_category รายเดือน
    $category_B = mysqli_query($con, "SELECT * FROM `room_category` WHERE id = '2'");

    //ดึงข้อมูลรูปภาพ
    $picture = mysqli_query($con, "SELECT * FROM room_picture");

    //ดึงข้อมูลตาราง receipt
    $receipt_all = mysqli_query($con, "SELECT * FROM receipt");

    //ดึงข้อมูล วันที่ล่าสุด ตาราง receipt_all
    $last_date_receipt = mysqli_query($con,"SELECT max(date) as date_check FROM `receipt`");
    
    //ดึงข้อมูล วันที่ล่าสุด ตาราง unit
    $last_date_unit = mysqli_query($con,"SELECT max(date) as date_check  FROM `unit`");

    //ดึงข้อมูลทั้งหมด parer
    $paper_all = mysqli_query($con,"SELECT * FROM `paper_details`");

    //ดึงข้อมูล ธนาคาร
    $bank = mysqli_query($con,"SELECT * FROM bank INNER JOIN abank ON(bank.id = abank.b_id)");

?>