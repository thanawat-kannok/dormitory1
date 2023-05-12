function getAge()
{
   var day = document.frm.day;
   var month = document.frm.month;
   var year = document.frm.year;
   var d = "";
   var m = "";
   var y = "";
   var nowdt = new Date();
   var nd = parseInt(nowdt.getDate());
   var nm = parseInt(nowdt.getMonth());
   var ny = parseInt(nowdt.getFullYear());
   // var age = document.frm.age;
   var ageYear = 0;
   var ageMonth = 0;
   

   for(i=0;i<day.options.length;i++)
   {
       if(day.options[i].selected){
           d = day.options[i].value;
       }	
   }
   
   for(i=0;i<month.options.length;i++)
   {
       if(month.options[i].selected){
           m = month.options[i].value;
       }	
   }
   
   for(i=0;i<year.options.length;i++)
   {
       if(year.options[i].selected){
           y = year.options[i].value;
       }	
   }
   
   if(d != "" && m != "" && y != "")
   {
       s = new Date(y, parseInt(m)-1, d);
       d = parseInt(s.getDate()); 
       m = parseInt(s.getMonth()); 
       y = parseInt(s.getFullYear());
   
       ageYear = ny - y; 
       if(nm > m)
       {
           ageMonth = nm - m;
       }else if(nm == m){
           if(nd >= d)
           {
               ageMonth = 0;	
           }else{
               ageMonth = 11;
               ageYear = ageYear - 1;
           }
       }else{
           ageMonth = m - nm;
           ageYear = ageYear - 1;
       }
       // age.value = ageYear + "ปี " + ageMonth + "เดือน";	

   }else{
       // age.value = "";
   }
 var dob = d +'/'+(m+1)+'/'+y;

 if (ageYear >= "0" && ageYear < "18" ) {
       document.getElementById("sum").innerHTML = ('<font color="red">อายุของคุณไม่ถึง 18 ปี</font>');
       return {ageYear};
     }else if(ageYear >= "80"){
       document.getElementById("sum").innerHTML = ('<font color="red">อายุของคุณมากเกินไป</font>');
       return {ageYear};
     }else {
         document.getElementById("sum").innerHTML = ('<font color="green">'+" อายุ " + ageYear + "  ปี "+ageMonth+' เดือน</font>');
         return {ageYear};
     }
}
function fncSubmit(ageYear,result)
{
   
 
 var age = getAge(ageYear);
//  alert('dob :'+age.dob);
//  alert('year:'+age.ageYear);
 var result = Script_checkID(id);
 //  alert('result :'+result);
   if(document.getElementById('day').value  == ""  )
   {
     var day = document.getElementById('day').value  == "";
       alert('กรุณาระบุบ วันที่');
       return false;
   }else if(document.getElementById('month').value  == ""){
     var month = document.getElementById('month').value;
     alert('กรุณาระบุบ เดือน');
       return false;
   }else if(document.getElementById('year').value  == ""){
     var year = document.getElementById('year').value  == "";
     alert('กรุณาระบุบ ปี พ.ศ');
       return false;
   }
   
   if (age.ageYear >= "0" && age.ageYear < "18" ) {
     alert('อายุคุณน้อยกว่า 18 ปี กรุณาเลือกปีเกิดใหม่');
     return false;
   }else if(age.ageYear >= "80") {
     alert('อายุของคุณมากเกินไป กรุณาเลือกปีเกิดใหม่');
     return false;
   }

   if(result === true && age.ageYear >= "18" && age.ageYear < "80" ){
   document.getElementById("error").innerHTML = ('<font color="green">เลขบัตรประชาชนถูกต้อง</font>');
   }
 if(result === false) {
     alert("เลขบัตรประชาชนผิด")
       return result;
   }
   
 
}