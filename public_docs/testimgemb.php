<?php $img_file = $_GET['img'];
$luna_coll = $_GET['luna'];

$Work_Record_ID = substr($img_file, 0, -5);



 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<img align="right" src="http://lac-live1.is.ed.ac.uk:8081/MediaManager/srvr?mediafile=/Size1/UoEgal-5-NA/1025/<?php echo $img_file ?>" border="5" />

<iframe id="widgetPreview" frameBorder="0"  width="400px"  height="500px"  border="0px" style="border:0px solid white"  src="http://images.is.ed.ac.uk/luna/servlet/view/search?embedded=true&q=Work_Record_ID=&quot;<?php echo $Work_Record_ID ?>&quot;&res=1&pgs=50&widgetFormat=javascript&widgetType=thumbnail&controls=0&nsip=0" ></iframe>

<a href="http://images.is.ed.ac.uk/luna/servlet/view/search?q=Work_Record_ID=&quot;<?php echo $Work_Record_ID ?>&quot;"> View <?php echo $Work_Record_ID ?></a><br/>



</body>
</html>
