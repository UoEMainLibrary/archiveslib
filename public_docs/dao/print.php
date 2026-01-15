<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php if ($_GET['doc'] == "ld") {
$start = "0";
$finish = "254";


while ( ($start<$finish)) {
$start = ($start+1);
echo "<div align='center'><img src='".$start.".jpg'>".$start."</div>";
}
}
?>
<body>
</body>
</html>
