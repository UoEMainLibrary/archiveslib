<?php include "../../mgt_config/sql.php"; ?>

<html>
<head>
<?php	echo "<title>Archives and Manuscripts: Inglis collection</title>";
	
	$id = $_GET['id'];
	
	if ($id == "1") {$caption = "Old Buildings"; }
	elseif ($id == "2") {$caption = ""; }
	elseif ($id == "3") {$caption = ""; }
	elseif ($id == "4") {$caption = ""; }
	elseif ($id == "5") {$caption = ""; }
	elseif ($id == "6") {$caption = ""; }
	elseif ($id == "7") {$caption = ""; }
	elseif ($id == "8") {$caption = ""; }
	elseif ($id == "9") {$caption = ""; }
	elseif ($id == "10") {$caption = ""; }
	elseif ($id == "11") {$caption = ""; }
	elseif ($id == "12") {$caption = ""; }
	elseif ($id == "13") {$caption = ""; }
	elseif ($id == "14") {$caption = ""; }
	elseif ($id == "15") {$caption = ""; }
	elseif ($id == "16") {$caption = ""; }
	elseif ($id == "17") {$caption = ""; }
	else {$caption = "";}

$filter = mysql_real_escape_string($_GET['filter']);
	 ?>
	


 <style>

 td {
 vertical-align:top;
 border-bottom:thin;
 border-bottom-color:#333366;
 border-bottom-style:groove;
 }
 td.toplabel, td.label{
 font-weight:bold;
 }
 </style>
</head>
<body>

<table width="100%" border="0">

<tr>
<td width="500">
<h1>Inglis collection</h1>
<p>Alexander Inglis was an Edinburgh photographer who was based at Rock Cottage, Calton Hill. This collection of photographs of University of Edinburgh buildings was made c1900.</p>

<p>These have been digitised quickly for reference purposes in order that they might be used to answer enquiries. It is hoped to replace these poor-quality images with decent ones in due course and make them available through the main images service.</p>


<?php $counter = 0;
while($counter < 17)
{
  $counter++;
  
   echo "<a href='".$_SERVER['PHP_SELF']."?id=".$counter."'><img src='inglis/".$counter."_t.jpg' width='70' border='0' /></a> ";
}

?>
</td>
<td>
<img src="inglis/<?php echo $id ?>.JPG" width="776" />
<?php echo $caption; ?>
</td>
</tr>
</table>

</body>
</html>
