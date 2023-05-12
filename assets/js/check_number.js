

function getiever()
{
var rv = -1; // Return value assumes failure.
if(navigator.appName == 'Microsoft Internet Explorer')
{
  var ua = navigator.userAgent;
  var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
if(re.exec(ua) != null)
  rv = parseFloat( RegExp.$1 );
}
return rv;
}

function checkIE()
{
var msg = "";
var ver = getiever();
if( ver> -1 )
{
if( ver>= 8.0 )
  msg = "8";
else if( ver == 7.0 )
  msg = "7";
else if( ver == 6.0 )
  msg = "6";
else
  msg = "<6";
}
return msg;
}

function CharacterFormat(fld,e,format)
{
  var ie = checkIE();
if( format == 1 )
  var strCheck = '0123456789';
else if( format == 2 )
  var strCheck = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
else if( format == 3 )
  var strCheck = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890._-';
else if( format == 4 )
  var strCheck = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890._-@';

  var len = 0;
if( ie == 8 )
  var whichCode = e.keyCode;
else
  var whichCode = (window.Event) ? e.which : e.keyCode;

  key = String.fromCharCode(whichCode);

if( whichCode == 8 || whichCode == 0 || whichCode == 13) {

}else{

  key = String.fromCharCode(whichCode);

if(strCheck.indexOf(key) == -1) return false;
}
}