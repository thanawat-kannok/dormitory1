<?php include 'server.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap" rel="stylesheet">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
        body{

        font-family: 'Prompt', sans-serif;
        background-color: #DCDCDC;
        }
        .com{
            border:1px solid black;
            border-radius:5px;
            padding:2px 5px;
            background-color:red;
            color:white;
            margin-bottom:10px;
        }
</style>
<body>
    <h5>
        <lable class="com"><i class="fa fa-warning"></i> กฏห้องพัก รายเดือน <i class="fa fa-warning"></i></lable><br> <br>
        <?php 
            $dkub = mysqli_query($con,"SELECT * FROM `rule` WHERE type = 2"); 
            $i = 1;
        ?>

        <?php 
            while($rule = mysqli_fetch_array($dkub)){
                echo $i.". ".$rule['data']."<br>";
                $i++;
            }

        ?>
        <br>
        <hr>
        <br><lable class='com'><i class="fa fa-warning"></i> กฏห้องพัก รายวัน <i class="fa fa-warning"></i></lable><br> <br>
        <?php 
            $dkub = mysqli_query($con,"SELECT * FROM `rule` WHERE type = 1"); 
            $i = 1;
        ?>

        <?php 
            while($rule = mysqli_fetch_array($dkub)){
                echo $i.". ".$rule['data']."<br>";
                $i++;
            }

        ?>
    </h5>
</body>
</html>