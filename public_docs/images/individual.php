<?php $image = $_GET['image']; 

$imgstr = "http://www.archives.lib.ed.ac.uk/images/full/".$image.".jpg";
	
	list($width, $height, $type, $attr) = getimagesize($imgstr);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>

<title>Full-sized image</title>
<META HTTP-EQUIV="imagetoolbar" CONTENT="no"> 
<SCRIPT language="JavaScript">
<!--
var message="Right-clicking has been disabled for this page.";
function click(e) {
if (document.all) {
if (event.button==2||event.button==3) {
alert(message);
return false;
}
}
if (document.layers) {
if (e.which == 3) {
alert(message);
return false;
}
}
}
if (document.layers) {
document.captureEvents(Event.MOUSEDOWN);
}
document.onmousedown=click;
// -->
</SCRIPT>
<script language="JavaScript1.2">

//Image zoom in/out script- by javascriptkit.com
//Visit JavaScript Kit (http://www.javascriptkit.com) for script
//Credit must stay intact for use

var zoomfactor=0.05 //Enter factor (0.05=5%)

function zoomhelper(){
if (parseInt(whatcache.style.width)>10&&parseInt(whatcache.style.height)>10){
whatcache.style.width=parseInt(whatcache.style.width)+parseInt(whatcache.style.width)*zoomfactor*prefix
whatcache.style.height=parseInt(whatcache.style.height)+parseInt(whatcache.style.height)*zoomfactor*prefix
}
}

function zoom(originalW, originalH, what, state){
if (!document.all&&!document.getElementById)
return
whatcache=eval("document.images."+what)
prefix=(state=="in")? 1 : -1
if (whatcache.style.width==""||state=="restore"){
whatcache.style.width=originalW
whatcache.style.height=originalH
if (state=="restore")
return
}
else{
zoomhelper()
}
beginzoom=setInterval("zoomhelper()",100)
}

function clearzoom(){
if (window.beginzoom)
clearInterval(beginzoom)
}

</script>
</head>
<body style="font-family: arial;">
<a href="#" onmouseover="zoom(<?php echo $width ?>,<?php echo $height ?>,'myimage','in')" onmouseout="clearzoom()">Zoom In</a> | <a href="#" onmouseover="zoom(<?php echo $width ?>,<?php echo $height ?>,'myimage','restore')">Normal</a> | <a href="#" onmouseover="zoom(120,60,'myimage','out')" onmouseout="clearzoom()">Zoom Out</a>
<div style="position:relative;width:99;height:100"><div style="position:absolute">
<img name="myimage" src="<?php echo $imgstr ?>">
</div></div>

<!-- <img alt="" src="/images/full/<?php echo $image;  ?>.jpg" /> -->

</body>
</html>

