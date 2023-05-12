<?php 
  if(!isset($_SESSION)) 
     { 
         session_start(); 
     }
?>
<?php
include('server.php');
$sql = "SELECT * FROM provinces ORDER BY name_th ASC";
$query = mysqli_query($con, $sql);

$Header =mysqli_query($con,"SELECT * FROM paper_details ");
$hd = mysqli_fetch_array($Header);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $hd['header']?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/register.css" rel="stylesheet">
    <link href="css/style_home.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: OnePage - v4.3.0
    * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
    <html xmlns="http://www.w3.org/1999/xhtml">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <!-- font -->
 <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap" rel="stylesheet">  

  </head>
<style>
  body{
    font-size:17px;
    font-family: 'Prompt', sans-serif;
  }
   @media screen and (max-width:550px){

  .left{
    width:100%;
    height:auto;
  }
  .right{
    width:100%;
    height:auto;
  }
  .respon{
    width:100%;
  }
  .hold{
  height:800px;
  } 


}
.Warning{
  font-size:15px;
}
.hold{
  height:600px;
}
.logo{
  font-family: 'supermarket';
}
.size{
  font-size:15px;
}
</style>
<body style="background-color:#708090;">
  <!-- ======= Script ห้ามคลุมดำ Ctrl A,C ======= -->
  <script language="JavaScript1.2">
  function disableselect(e){
    return false
  }
  function reEnable(){
    return true
  }
  //if IE4+
  document.onselectstart=new Function ("return false")
  //if NS6
  if (window.sidebar){
    document.onmousedown=disableselect
    document.onclick=reEnable
  }
  </script>
  <!-- ======= end script ======= -->

   <!-- ======= Header ======= -->
   <header id="header" class="fixed-top" style="background-color:white">
    <div class="container d-flex align-items-center justify-content-between" >

      <h1 class="logo" style="font-family: supermarket"><a href="index.php"><?php echo $hd['header']?></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      <nav id="navbar" class="navbar" >
        <ul>
        <li><a class="getstarted scrollto"  href="index.php" >หน้าหลัก</a></li>
          <li><div style="font-size:20px;color:red;margin-left:30px" >สมัครสมาชิก</div></li>
          <li><a class="bi bi-person-fill" href="login.php" style="font-size:20px">เข้าสู่ระบบ</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
<p style="margin-top:100px"></p>
<form action="register_db.php" method="post" name="frm" onSubmit="JavaScript:return fncSubmit();">
<div class="container my-5" >
<div class="card">
<center><h2>สมัครสมาชิก</h2></center>
</div>
  <?php if(isset($_SESSION['error'])):?>
        <div class="errors">
          <h3>
            <?php
              echo "<center>".$_SESSION['error'];
              unset($_SESSION['error']);
            ?>
          </h3>
        </div>
    <?php endif ?>
  <div class="card left hold">
    <div class="card-body">
    <div class="form-row">
    <table width="100%" >
                 <tr>
                  <td></td>
                  <td> <div class="text">ชื่อ<lable style="color:red">*</lable></div></td>
                  <td><div class="text">นามสกุล<lable style="color:red">*</lable></div></td>
                 </tr>
                  <tr>
                    <td width="20%">
                    <select name="prefix_name" style="width:90%" id="myList" onchange="ck_null(this)" required>
                        <option name=""  value="" >คำหน้าชื่อ</option>
                        <option name="นาย"  value="นาย">นาย</option>
                        <option name="นาง"  value="นาง">นาง</option>
                        <option name="นางสาว"  value="นางสาว">นางสาว</option>
                    </select>
                    </td>
                    <td width="40%">
                      <input type="text" id="fname" name="fname" class="form-control size" required minlength="2" maxlength="20" placeholder="ชื่อ" >
                    </td>
                    <td width="40%">
                      <input type="text" id="lname" name="lname" class="form-control size" required minlength="2" maxlength="20" placeholder="นามสกุล">
                    </td>
                  </tr>
                <tr>
                  <td colspan="2" width="100%"> 
                  
                  <lable class="text" >วันเกิด<lable style="color:red">*</lable></lable>
                    <input type="date" name="date" id="date" class="form-control size" onchange="calAge(this);" required>
                </td>

                <td>

                <lable class="text" >เพศ</lable><lable style="color:red">*</lable>
                
                <input type="text" name="sex" id="favourite" readonly class="form-control size">
              
                </td>
                </tr>
                <tr>
                  <td colspan="3"><div id="sum" class="Warning"></div></td>
                </tr>
                </table>
                <label class="text">บัตรประชาชน<lable style="color:red">*</lable></label>
                <input type="text" name="personal" id="personal" class="form-control size"  maxlength="13" minlength="13" required onkeypress="return CharacterFormat(this,event,1);"placeholder="เลขบัตรประชาชน">
              
                <div class="Warning" id="error" ></div>
              
                <label class="text">เบอร์โทรศัพท์<lable style="color:red" id="phone">*</lable></label>
                  <input type="text" name="telephone_number" class="form-control size"  required maxlength="10" minlength="10" onkeypress="return CharacterFormat(this,event,1);" placeholder="088***6565">
                  
                <label class="text">ไอดีไลน์</label>
                <input type="text" name="line" class="form-control size" placeholder="@ID Line" maxlength="40" name="line" >
                
                <label class="text">รหัสผ่าน<lable style="color:red">*</lable></label>
                <input type="password" id="pass1" name="psw1" class="form-control size" required  min="8" placeholder="รหัสผ่าน อย่างน้อย 8 ตัว" onkeyup="return pass(event)"  pattern="[A-Za-z0-9]+">
                <input type="password" id="pass2" name="psw2" class="form-control size" required  min="8" placeholder="ยืนยันรหัสผ่าน" style="margin-Top:10px" onkeyup="return pass(event)"  pattern="[A-Za-z0-9]+">
                <div id="pass" class="Warning"></div>
                <div id="pass_limit" class="Warning"></div>
            </div>
          </div>
      </div>
 
    <div class="card right hold">
        <div class="card-body">
         
                <div class="form-row">
                  
                      <label for="province">จังหวัด</label><lable style="color:red">*</lable>
                        <select name="province_id" id="province" class="form-control size"  style="width:100%"required>
                            <option value="">เลือกจังหวัด</option>
                            <?php while($result = mysqli_fetch_assoc($query)): ?>
                                <option value="<?=$result['id']?>"><?=$result['name_th']?></option>
                            <?php endwhile; ?>
                        </select>
                    
                    
                      <label for="amphure">อำเภอ/เขต</label><lable style="color:red">*</lable>
                        <select name="amphure_id" id="amphure" class="form-control size" >
                            <option value="">เลือกอำเภอ</option>
                        </select>
                   
                    
                      <label for="district">แขวง/ตำบล</label><lable style="color:red">*</lable>
                        <select name="district_id" id="district" class="form-control size" >
                            <option value="">เลือกตำบล</option>
                        </select>
                    
                      <label class="text">ถนน</label>
                        <input type="text" name="road" class="form-control size"  maxlength="50" placeholder="ถนน">
                        
                      <label class="text">บ้านเลขที่</label><lable style="color:red">*</lable>
                        <input id="home_number" type="text" name="home_number" class="form-control size"  required maxlength="50" placeholder="บ้านเลขที่" required onchange="ckh_null()">
                
                      <label class="text">หมู่ที่</label>
                        <input type="text" name="village" class="form-control size"   maxlength="50" >
                
                        <input type="checkbox" id="myCheck"  onclick="myFunction()" class="rule" required>

                      <label for="myCheck" >ยอมรับข้อตกลงในการใช้บริการ<a href="#"onclick="open_popup('rule.php')"> อ่านกฏของหอพัก</a></label>
                      <lable id="text" style="display:none;color:green" class="rule_text" ><i class="fa fa-check-circle"></i> ยอมรับข้อตกลง</lable>
                        <script>
                          function open_popup(url){
                            window.open(url,null,"height=700,width=500,status=yes,toolbar=no,menubar=no,location=no");
                          }
                        </script>
                        <br>
                        <div id="pref-null" class="Warning"></div>
                        <div id="fname-null" class="Warning"></div>
                        <div id="lname-null" class="Warning"></div>
                        <div id="sex-null" class="Warning"></div>
                        <div id="home_number-null" class="Warning"></div>
                      <button type="submit" name="reg_user" class="btn btn-primary" id="reg_user">สมัครสมาชิก</button>
                      <button type="reset" class="btn btn-default">ยกเลิก</button>
                      

                </div>                
        
        </div>
    </div>

</div>
</from>

<script src="assets/jquery.min.js"></script>
<script src="assets/script.js"></script>
  <!-- Template Main JS File -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script src="assets/js/check_number.js" type="text/javascript"></script><!--เช็คพิมพ์เลขไม่รวมตัวอักษร -->
<script src="assets/js/check_box.js" type="text/javascript"></script><!--เช็คการกดคลิ๊กที่ radio -->

</body>
</html>
<script>
  $(function() {
    var $select = $("#18-100");
    for (i=18;i<=100;i++) {
         $select.append($('<option></option>').val(i).html(i))
    }
});

  
$(document).ready(function(){
    $('#personal').on('keyup',function(){
      if($.trim($(this).val()) != '' && $(this).val().length == 13){
        id = $(this).val().replace(/-/g,"");
        var result = Script_checkID(id);
  
        if(result === false){
          document.getElementById("error").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> เลขบัตรประชาชนผิด</font>');
          return result;
        }else{
          document.getElementById("error").innerHTML = ('<font color="green"><i class="fa fa-check-circle"></i> เลขบัตรประชาชนถูกต้อง</font>');
          return result;
        }
      }else{
        $('span.error').removeClass('true').text('');
        return result;
      }
    })
  });
  
  function Script_checkID(id){
      if(! IsNumeric(id)) return false;
      if(id.substring(0,1)== 0) return false;
      if(id.length != 13) return false;
      for(i=0, sum=0; i < 12; i++)
          sum += parseFloat(id.charAt(i))*(13-i);
      if((11-sum%11)%10!=parseFloat(id.charAt(12))) return false;
      return true;
  }
  function IsNumeric(input){
      var RE = /^-?(0|INF|(0[1-7][0-7]*)|(0x[0-9a-fA-F]+)|((0|[1-9][0-9]*|(?=[\.,]))([\.,][0-9]+)?([eE]-?\d+)?))$/;
      return (RE.test(input));
  }
  function calAge() {
  var date = document.getElementById('date').value;

  var date_input = new Date(date);

  var day = date_input.getDate();
  var month = date_input.getMonth() + 1;
  var year = date_input.getFullYear();

  var today = new Date();


  var d = today.getDate();
  var m = today.getMonth() + 1;
  var y = today.getFullYear();
  var ageYear = y - year;


  if (ageYear >= "0" && ageYear < "18") {
      document.getElementById("sum").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> อายุของคุณไม่ถึง 18 ปี</font>');
      return {
          ageYear
      };
  } else if (ageYear < '0' || ageYear >= "80") {
      document.getElementById("sum").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> อายุของคุณมากกว่าที่กำหนด</font>');
      return {
          ageYear
      };
  } else if (ageYear == "" || ageYear == " " || ageYear == null) {
      document.getElementById("sum").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบวันเกิด</font>');
      return {
          ageYear
      };
  } else {
      document.getElementById("sum").innerHTML = ('<font color="green"><i class="fa fa-check-circle"></i> ' + " อายุ " + ageYear + "  ปี " + ' </font>');
      return {
          ageYear
      };
  }
}


function fncSubmit(ageYear,result)
{

 var age = calAge(ageYear);
 var result = Script_checkID(id);
   if (age.ageYear >= "0" && age.ageYear < "18" ) {
     alert('อายุคุณน้อยกว่า 18 ปี กรุณาเลือกปีเกิดใหม่');
     return false;
   }else if(age.ageYear < "0" || age.ageYear >= "80") {
     alert('อายุของคุณมากเกินไป กรุณาเลือกปีเกิดใหม่');
     return false;
   }

   if(result === true && age.ageYear >= "18" && age.ageYear < "80" ){
   document.getElementById("error").innerHTML = ('<font color="green"><i class="fa fa-times-circle"></i>เลขบัตรประชาชนถูกต้อง</font>');
   }
 if(result === false) {
     alert("เลขบัตรประชาชนผิด")
       return result;
   }
   
 
}
</script>
<script>
  function pass(evt){

    if (window.event) k = window.event.keyCode; //  IE
  	else if (evt) k = evt.which; //  Firefox ,google,ฯลฯ
		if (k==32 ){ 
			alert('กรุณางดใช้ปุ่ม Spacebar หรือ ช่องว่าง');
			document.getElementById("pass1").value='';
      document.getElementById("pass2").value='';
			return false;
		}

  var pass1 = document.getElementById('pass1').value;
  var pass2 = document.getElementById('pass2').value;



if(pass1 !== pass2)
{
  document.getElementById("pass").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> รหัสผ่านไม่ตรงกัน</font>');
  return false;
}	
if(pass1 === pass2)
{
  document.getElementById("pass").innerHTML = ('<font color="green"><i class="fa fa-check-circle"></i> รหัสผ่านตรงกัน</font>');
}	
if(pass1 == "" && pass2 == ""){
  document.getElementById("pass").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาใส่รหัสผ่าน</font>');
}

if(pass1.length < "8" || pass2.length < "8"){
  document.getElementById("pass_limit").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาใส่รหัสผ่านมากกว่า 8 ตัวอักษร</font>');
}else{
  document.getElementById("pass_limit").innerHTML = ('<font color="green"><i class="fa fa-check-circle"></i> รหัสผ่านมีขนาดมากว่า 8 ตัว </font>');
}
}
</script>
<script>
  function ck_null(){
    var mylist = document.getElementById("myList").value;

    if(mylist == 'นาย'){
        document.getElementById("favourite").value = "ชาย";
    }

    if(mylist == 'นาง' || mylist == 'นางสาว'){
        document.getElementById("favourite").value = "หญิง";
    }

    if(mylist == null || mylist == ''){
      document.getElementById("pref-null").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบ คำนำหน้าชื่อ</font>');
    }else{
      document.getElementById("pref-null").innerHTML = ('');
    }

  }
  function ckh_null(){
    var home_number = document.getElementById('home_number').value;
    if(home_number == null || home_number == ''){
      document.getElementById("home_number-null").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบ บ้านเลขที่</font>');
    }else{
      document.getElementById("home_number-null").innerHTML = ('');
    }
  }
</script>
<script type="text/javascript">
function isThaichar(str,obj){
    var fname = document.getElementById('fname').value;
    var lname = document.getElementById('lname').value;

    if(fname == null || fname == ''){
      document.getElementById("fname-null").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบ ชื่อต้น</font>');
    }else{
      document.getElementById("fname-null").innerHTML = ('');
    }

    if(lname == null || lname == ''){
      document.getElementById("lname-null").innerHTML = ('<font color="red"><i class="fa fa-times-circle"></i> กรุณาระบุบ นามสกุล</font>');
    }else{
      document.getElementById("lname-null").innerHTML = ('');
    }

    var orgi_text="ๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวงผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦ";
    var str_length=str.length;
    var str_length_end=str_length-1;
    var isThai=true;
    var Char_At="";
    for(i=0;i<str_length;i++){
        Char_At=str.charAt(i);
        if(orgi_text.indexOf(Char_At)==-1){
            isThai=false;
        }   
    }
    if(str_length>=1){
        if(isThai==false){
            obj.value=str.substr(0,str_length_end);
        }
    }
    return isThai; // ถ้าเป็น true แสดงว่าเป็นภาษาไทยทั้งหมด
}
</script>