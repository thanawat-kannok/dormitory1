<?php
// Include the database config file 
include_once '../server.php';

if ((($_POST['room'] == '2') || ($_POST['room'] == '1'))  && empty($_POST['troom'])) {

    // Fetch state data based on the specific country 
    $query = "SELECT room_type.id AS tid, room_type.name FROM room_details INNER JOIN room_type ON(room_details.type = room_type.id) WHERE room_details.reservation = '$_POST[room]' GROUP BY room_type.id";
    $result = mysqli_query($con, $query);

    // Generate HTML of state options list 
    if ($result->num_rows > 0) {
        echo '<option value="">เลือกประเภทห้อง</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['tid'] . '">' . $row['name'] . '</option>';
        }
    } else {
        echo '<option value="">กรุณาเลือกประเภทการจองก่อน</option>';
    }
} elseif (isset($_POST['troom']) && empty($_POST['broom']) ) {
    // Fetch state data based on the specific country 
   $query1 = "SELECT room_details.bed,bed_type.name,bed_type.size FROM room_details INNER JOIN bed_type ON(room_details.bed = bed_type.id) WHERE room_details.type = '$_POST[troom]' GROUP BY room_details.bed";
    $result1 = mysqli_query($con, $query1);

    // Generate HTML of state options list 
    if ($result1->num_rows > 0) {
        echo '<option value="">เลือกประเภทเตียง</option>';
        while ($row = $result1->fetch_assoc()) {
             echo '<option value="' . $row['bed'] . '">' . $row['name'] . ' ขนาดเตียง ' . $row['size'] . '</option>';
        }
    } else {
        echo '<option value="">กรุณาเลือกประเภทห้องก่อน</option>';
    }
} elseif (isset($_POST['broom']) && empty($_POST['floor'])) {
    // Fetch state data based on the specific country 
    $query2 = "SELECT floor FROM room_details GROUP BY floor";
    $result2 = mysqli_query($con, $query2);

    // Generate HTML of state options list 
    if ($result2->num_rows > 0) {
        echo '<option value="">เลือกชั้น</option>';
        while ($row1 = $result2->fetch_assoc()) {
            echo '<option value="' . $row1['floor'] . '">' . $row1['floor'] . '</option>';
    
        }
    } else {
        echo '<option value="">กรุณาเลือกประเภทห้องก่อน</option>';
    }
} elseif (isset($_POST['floor'])) {
    $room = $_POST['room'];
    $troom = $_POST['troom'];
    $broom = $_POST['broom'];
    $floor = $_POST['floor'];
    // Fetch state data based on the specific country 
    $query2 = "SELECT room_details.price,room_details.other 
    FROM room_details INNER JOIN room_category ON(room_details.reservation = room_category.id) 
    INNER JOIN room_type ON(room_details.type = room_type.id) 
    INNER JOIN bed_type ON(room_details.bed = bed_type.id) 
    WHERE room_details.reservation = '$room' 
    AND room_details.bed = '$broom' 
    AND room_details.floor = '$floor' 
    AND room_details.type = '$troom'";
    
    $result2 = mysqli_query($con, $query2);

    // Generate HTML of state options list 
    if ($result2->num_rows > 0) {

       $row1 = $result2->fetch_assoc();
            echo  $row1['price'].','.$row1['other'];
    
    } else {
        echo "ไม่มีข้อมูลในระบบ,ไม่มีข้อมูลในระบบ";
    }
}
?>