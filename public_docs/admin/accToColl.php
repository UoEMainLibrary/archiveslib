<?php include "../../mgt_config/sql.php";

$sql_str="SELECT * FROM cms_accessions WHERE year > 2003 AND year < 2010 AND acc_type LIKE 'MS' ORDER BY year,accession";
$acc_search = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");

echo "<table border='1'>";

while ($results = mysql_fetch_array($acc_search)):
echo "<tr><td>".$results['year']."</td><td>".$results['accession']."</td><td>".$results['comments']."</td></tr>";
endwhile;

echo "</table>";





?>