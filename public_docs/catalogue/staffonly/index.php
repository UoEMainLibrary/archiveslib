<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php include "../../../mgt_config/sql.php";

$id = $_GET['id'];

if (stristr($id, 'GB-237-EUA')) { 

$cat_id = $id;

$id = str_replace("GB-237-EUA-", "", $id);

$unitid = "EUA ".str_replace("-", "/", $id);

echo "<a href=\"http://www.archives.lib.ed.ac.uk/catalogue/cs/viewcat.pl?id=".$cat_id."\">".$unitid."</a><br><br>";
$unitid2 = $unitid."/";

$sql_str="SELECT * FROM eua_box_contents WHERE unitid LIKE '$unitid' OR unitid LIKE '$unitid2%' ORDER by unitid, contents";
	 
$boxsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");

echo "<table border=\"1\" cellpadding=\"3\">";
	 
while($results = mysql_fetch_array($boxsearch)):

echo "<tr><td>EUA-".$results['prefix']."-".$results['box']."</td><td>".$results['unitid']."</td><td>".$results['contents']."</td></tr>";

endwhile;

$sql_str="SELECT * FROM cms_unboxed WHERE unitid LIKE '$unitid' OR unitid LIKE '$unitid2%' ORDER by unitid, description";
	 
$boxsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");


	 
while($results = mysql_fetch_array($boxsearch)):

echo "<tr><td>".$results['begin']." - ".$results['end']."</td><td>".$results['unitid']."</td><td>".$results['description']."</td></tr>";

endwhile;
	 
echo "</table>";	 

 } 
 
 else { echo "only working for EUA just now"; }


?>
<body>
</body>
</html>
