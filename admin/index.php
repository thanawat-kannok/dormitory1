<?php
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  }
  if(!isset($_SESSION['premission']) == "Admin")
  {
   header("location: ../index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ระบบจัดการหอพัก</title>
</head>
<body>
  
</body>
</html>