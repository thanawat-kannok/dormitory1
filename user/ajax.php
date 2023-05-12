<?php
function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strMonthThai $strYear ";
}

function DateThai2($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear ";
}

if (!isset($_SESSION)) {
    session_start();
}
include_once '../server.php';
$personal = $_SESSION['personal'];
$urd1 = mysqli_query($con, "SELECT room_details.reservation, user.room FROM user INNER JOIN room ON(user.room = room.room) 
INNER JOIN room_details ON(room.type = room_details.id) WHERE personal = '$personal' AND room_details.reservation = '2'");
$user2 = mysqli_fetch_array($urd1);
$room = $user2['room'];

$urd2 = mysqli_query($con, "SELECT * FROM room INNER JOIN unit ON(room.room = unit.room) INNER JOIN 
receipt ON(unit.room = receipt.room AND unit.date = receipt.date) INNER JOIN room_details ON(room.type = room_details.id) 
INNER JOIN user ON(user.room = receipt.room)  WHERE room.room = '$room' AND 
receipt.date > user.rental_start_date  ORDER BY receipt.pay_id DESC LIMIT 1");
$user3 = mysqli_fetch_array($urd2);

// Include the database config file 
if (isset($_GET['y'])) {
    $y = $_GET['y'];
    // ประวัติใบเสร็จ
    $query = "SELECT * FROM room INNER JOIN unit ON(room.room = unit.room) INNER JOIN receipt ON(unit.date = receipt.date) 
    INNER JOIN room_details ON(room.type = room_details.id) INNER JOIN user ON(room.room = user.room) WHERE room.room = '$room' 
    AND receipt.date LIKE '%$y%' AND receipt.date > user.rental_start_date AND receipt.date NOT IN ('$user3[date]') GROUP BY receipt.date 
    ORDER BY receipt.pay_id DESC ";
    $result = mysqli_query($con, $query);

    // Generate HTML of state options list 
    if ($result->num_rows > 0) {
        echo '<option value="">เลือกเดือน</option>';
        while ($row10 = $result->fetch_assoc()) {
            echo '<option value="' . $row10['date'] . '">' . ' เดือน' . DateThai($row10['date']) . '</option>';
        }
    } else {
        echo '<option value="">ไม่มีประวัติใบเสร็จ</option>';
    }
} elseif (isset($_GET['q'])) {

    // Fetch state data based on the specific country 
    $s1 = $_GET['q'];
    $findit = "    SELECT * FROM room INNER JOIN unit ON(room.room = unit.room) INNER JOIN 
    receipt ON(unit.room = receipt.room AND unit.date = receipt.date) INNER JOIN room_details ON(room.type = room_details.id) 
    INNER JOIN user ON(user.room = receipt.room)  WHERE room.room = '$room' AND receipt.date LIKE '%$s1%'  ORDER BY receipt.pay_id DESC ";
    $find = mysqli_query($con, $findit);
}

$re = mysqli_query($con, "SELECT * FROM `paper_details`");

while ($row = mysqli_fetch_array($re)) {
    $header = $row['header'];
    $address = $row['address'];
    $phone_own = $row['phone_lessor'];
}


?>

<?php while ($findtoo = $find->fetch_assoc()) :


    $his1 = mysqli_query($con, " SELECT * FROM room INNER JOIN unit ON(room.room = unit.room) INNER JOIN receipt ON(unit.room = receipt.room 
                                                AND unit.date = receipt.date) INNER JOIN room_details ON(room.type = room_details.id) INNER JOIN user ON(user.room = receipt.room)  WHERE room.room = '$room' AND  receipt.pay_id < 
                                                 ('$findtoo[pay_id]') GROUP BY receipt.date ORDER BY receipt.date DESC LIMIT 1 ");
    $history = mysqli_fetch_array($his1);

    $ot = mysqli_query($con, " SELECT  receipt.pay_id,unit.other FROM room INNER JOIN unit ON(room.room = unit.room) INNER JOIN receipt ON(unit.room = receipt.room 
                                                AND unit.date = receipt.date) INNER JOIN room_details ON(room.type = room_details.id) INNER JOIN user ON(user.room = receipt.room)  WHERE room.room = '$room' AND  unit.date IN 
                                                 ('$findtoo[date]') GROUP BY receipt.date ORDER BY receipt.date DESC LIMIT 1 ");
    $other23 = mysqli_fetch_array($ot);

?>
<table border="1" width="100%">
    <tr>
        <td width="70%" colspan="3">
            <h2><?php echo $header; ?></h2>
            ที่อยู่. <lable><?php echo $address ?></lable><br>
            โทร. <lable><?php echo $phone_own; ?></lable>
        </td>

        <td colspan="2">
            <h3>ใบแจ้งค่าเช่า/ใบเสร็จ</h3>
            <div>เลขใบเสร็จ(Doc No.): <?php echo $findtoo['pay_id']; ?></div>
            <lable>วันที่ออกใบเสร็จ(Date):
                <?php list($yr, $mr, $dr) = explode('-', $findtoo['date']);
                    echo $dr . '-' . $mr . '-' . date($yr + 543);; ?>
            </lable>
            <div>ช่วงวันที่จดมิตเตอร์:
                <?php list($yo,$mo,$do) = explode('-', $history['date']); echo $do . '/' . $mo . '/' . date($yo+543);?>
                ถึง
                <?php list($yf,$mf,$df) = explode('-', $findtoo['date']); echo $df . '/' . $mf . '/' . date($yf+543);?>
            </div>
        </td>

    </tr>
    <tr>
        <td colspan="3">
            <?php
                $userid = mysqli_query($con, "SELECT * FROM user INNER JOIN room on(user.room = room.room) INNER JOIN room_details on(room_details.id = room.type) WHERE room.room = '$room' ");
                while ($user = mysqli_fetch_array($userid)) {
                    echo "<div>ชื่อ-สกุล: " . $user['prefix_name'] . " " . $user['fname'] . " " . $user['lname'] . "</div>";
                }
                ?>
        </td>
        <td colspan="2">
            <h5>ห้อง(Room No.): <lable style="float:right">
                    <?php echo $room; ?></lable>
            </h5>
        </td>
    </tr>
    <tr>
        <th width="5%" style="text-align:center;">ลำดับ</th>
        <th style="text-align:center;">รายการ</th>
        <th style="text-align:center;"><span>จำนวนหน่วย</span></th>
        <th style="text-align:center;"><span>ราคาต่อหน่วย</span></th>
        <th style="text-align:center;"><span>จำนวนเงิน</span></th>
    </tr>
    <tr>
        <td>1</td>
        <td>ค่าเช่าห้องพัก(Room Rate)</td>
        <td></td>
        <td style="text-align: right">
            <?php echo number_format($findtoo['price'], 2)  ?></td>
        <td style="text-align: right">
            <?php echo number_format($findtoo['price'], 2) ?></td>
    </tr>
    <tr>
        <td>2</td>
        <td>ค่ากระแสไฟฟ้า(Electrictiy Charge)</td>
        <td style="text-align: right">
            <?php echo number_format($findtoo['last_unit_electricity'] - $history['last_unit_electricity'], 2) ?>
        </td>
        <td style="text-align: right">
            <?php echo number_format($findtoo['unitPerElectricity'], 2)  ?></td>
        <td style="text-align: right"><?php $sumElectricity = ($findtoo['last_unit_electricity'] - $history['last_unit_electricity']) * $findtoo['unitPerWater'];
                                            echo number_format($sumElectricity, 2) ?></td>
    </tr>
    <tr>
        <td></td>
        <td>&nbsp&nbsp&nbsp เลขมิเตอร์เก่า(Pervious Charge)</td>
        <td style="text-align: left">
            <?php echo number_format($history['last_unit_electricity'], 2)  ?>
        </td>
        <td><?php ?></td>
        <td><?php  ?></td>
    </tr>
    <tr>
        <td></td>
        <td>&nbsp&nbsp&nbsp เลขมิเตอร์ใหม่(Current Charge)</td>
        <td style="text-align: left">
            <?php echo number_format($findtoo['last_unit_electricity'], 2)  ?>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>3</td>
        <td>ค่าน้ำประปา (Tab Water Charge)</td>
        <td style="text-align: right">
            <?php echo number_format($findtoo['last_unit_water'] - $history['last_unit_water'], 2)  ?>
        </td>
        <td style="text-align: right">
            <?php echo number_format($findtoo['unitPerWater'], 2) ?></td>
        <td style="text-align: right"><?php $sumWater = ($findtoo['last_unit_water'] - $history['last_unit_water']) * $findtoo['unitPerWater'];
                                            echo number_format($sumWater, 2) ?></td>
    </tr>
    <tr>
        <td></td>
        <td>&nbsp&nbsp&nbsp เลขมิเตอร์เก่า(Pervious Charge)</td>
        <td style="text-align: left">
            <?php echo number_format($history['last_unit_water'], 2)  ?>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>&nbsp&nbsp&nbsp เลขมิเตอร์ใหม่(Current Charge)</td>
        <td style="text-align: left">
            <?php echo number_format($findtoo['last_unit_water'], 2)  ?>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>4</td>
        <td>ค่าอื่นๆ (Other Charge)</td>
        <td></td>

        <?php $other = $other23['other']; ?>
        <td style="text-align:right;">
            <?php echo number_format($other23['other'], 2); ?></td>
        <td style="text-align:right;"><?php echo number_format($other, 2); ?>
        </td>

    </tr>
    <!-- <tr>
                                                <td>5</td>
                                                <td>ค่าปรับ (Charge)</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> -->
    <tr>
        <td colspan="3"></td>
        <td>ยอดรวมทั้งสิ้น</td>
        <td style="text-align: right"><?php $sum = $findtoo['price'] + $sumElectricity + $sumWater;
                                            echo number_format($sum, 2) ?></td>
    </tr>
</table>
<br>
<table border="0">
    <tr>
        <td>ลงนาม…..........................................(ผู้จ่ายเงิน)</td>
        <td style="text-align:right">ลงนาม…….......................................(ผู้รับเงิน)</td>
    </tr>
    <tr>
        <td colspan="2">หมายเหตุ กรุณาชำระเงินก่อนวันที่ 5 ของทุกเดือน ครับ/ค่ะ</td>
    </tr>
</table>
<center>
    <button style="margin:20px auto;" class="hideWhenPrint print" onclick="window.print()">พิมพ์ PDF</button>
</center>

<?php endwhile ?>


<?php if (mysqli_num_rows($find) == 0) : ?>
<h1 style="margin-top: 80px; color:#DC143C;text-align: center;">
    ยังไม่มีใบเสร็จค่าเช่า<i class="bi bi-receipt"></i>
</h1>
<?php endif ?>


</div>

</div>
</div>