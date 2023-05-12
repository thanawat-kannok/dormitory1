<?php
include 'server.php';
$sql = "SELECT * FROM `paper_details` WHERE 1";
$type = mysqli_query($con, $sql);
$row = mysqli_fetch_array($type);
?>
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3 style="font-family: supermarket"><?php echo $row['header'] ?></h3>
                    <p style="font-family: supermarket">
                        <?php echo $row['address'] ?><br>

                        <strong>Phone:</strong> <?php echo $row['phone_lessor'] ?><br>
                        <!-- <strong>Line</strong> Bankecho<br> -->
                    </p>
                </div>

            </div>
        </div>
    </div>


</footer><!-- End Footer -->