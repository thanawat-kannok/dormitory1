function pass(){
    var pass1 = document.getElementById('pass1').value;
    var pass2 = document.getElementById('pass2').value;
    alert(size);
  if(pass1 !== pass2)
	{
    document.getElementById("pass").innerHTML = ('<font color="red"><i class="fa fa-time-circle"></i> รหัสผ่านไม่ตรงกัน</font>');
		return false;
	}	
  if(pass1 === pass2)
	{
    document.getElementById("pass").innerHTML = ('<font color="green"><i class="fa fa-check-circle"></i> รหัสผ่านตรงกัน</font>');
	}	
  if(pass1 == "" && pass2 == ""){
    document.getElementById("pass").innerHTML = ('<font color="red"><i class="fa fa-time-circle"></i> กรุณาใส่รหัสผ่าน</font>');
  }
  if(pass1.length < "8" && pass2.length < "8"){

    document.getElementById("pass_limit").innerHTML = ('<font color="red"><i class="fa fa-time-circle"></i> กรุณาใส่รหัสผ่านมากกว่า 8 ตัวอักษร</font>');
  }else{
    document.getElementById("pass_limit").innerHTML = ('<font color="green"><i class="fa fa-check-circle"></i> รหัสผ่านมีตัวอักษรมากว่า 8 ตัว </font>');
  }
}