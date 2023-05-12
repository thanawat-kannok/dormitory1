<?php
include('server.php');
$sql = "SELECT * FROM districts WHERE amphure_id={$_GET['amphure_id']} ORDER BY name_th ASC";
$query = mysqli_query($con, $sql);

$json = array();
while($result = mysqli_fetch_assoc($query)) {    
    array_push($json, $result);
}
echo json_encode($json);