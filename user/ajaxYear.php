<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../server.php';
$personal = $_SESSION['personal'];
$urd1 = mysqli_query($con, "SELECT room_details.reservation, user.room FROM user INNER JOIN 
room ON(user.room = room.room) INNER JOIN room_details ON(room.type = room_details.id)
 WHERE personal = '$personal' AND room_details.reservation = '2'");
$user2 = mysqli_fetch_array($urd1);
$room = $user2['room'];

$urd2 = mysqli_query($con, "SELECT * FROM room INNER JOIN unit ON(room.room = unit.room) 
INNER JOIN receipt ON(unit.room = receipt.room AND unit.date = receipt.date) INNER JOIN
 room_details ON(room.type = room_details.id) 
INNER JOIN user ON(user.room = receipt.room)  WHERE room.room = '$room' AND 
receipt.date > user.rental_start_date  ORDER BY receipt.pay_id DESC LIMIT 1");
$user3 = mysqli_fetch_array($urd2);

// Include the database config file 
if (isset($_GET['year'])) {
    $y = $_GET['year'];
    // ประวัติใบเสร็จ
    $query = "SELECT * FROM room INNER JOIN unit ON(room.room = unit.room) 
    INNER JOIN receipt ON(unit.date = receipt.date) 
    INNER JOIN room_details ON(room.type = room_details.id) INNER JOIN user
     ON(room.room = user.room) WHERE room.room = '$room' 
    AND receipt.date LIKE '%$y%' AND receipt.date > user.rental_start_date
     AND receipt.date NOT IN ('$user3[date]') GROUP BY receipt.date 
    ORDER BY receipt.pay_id DESC ";
    $result1 = mysqli_query($con, $query);
    // Generate HTML of state options list 
    $json = array();
while($result = mysqli_fetch_assoc($result1)) {   
    $dateshow = $result['date']; 
    array_push($json, $result);
}
echo json_encode($json);
} 