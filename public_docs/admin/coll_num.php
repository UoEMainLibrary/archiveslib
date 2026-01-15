<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Numerical list of collections</title>
<style>
body,p,td {font-family:Arial, Helvetica, sans-serif; font-size:8pt; }
</style>
</head>
<body style="padding:5px;">
<p>Numerical list of collections:</p>
<?php include "../../mgt_config/sql.php";

$sql_str="SELECT * FROM cms_collections ORDER BY coll ASC";

$collsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
$hits = mysql_num_rows($collsearch);
$count=0;
echo "<table border=\"1\" width=\"98%\">";

while ($results = mysql_fetch_array($collsearch)):

if ($results['EUA'] == 0) {
$filename = "/data/d4/archives/catalogue_source_docs/isad/Coll-".$results['coll'].".xml";
}
else {
$filename = "/data/d4/archives/catalogue_source_docs/isad/".str_replace(" ", "-", $results['alt']).".xml";
}



##	if (!file_exists($filename)) {

		echo "<tr><td width=\"40\">".$results['coll']."</td><td width=\"100\">".$results['alt']."</td><td>".utf8_encode($results['creator'])."</td><td>".utf8_encode($results['title'])."</td><td>".utf8_encode($results['shelfmarks'])."</td></tr>";
$count ++;
##	}

endwhile;

echo "</table>";

echo "<p>".$count." total</p>";

?>

</body>
</html>