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