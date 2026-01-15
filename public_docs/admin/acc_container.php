<?php include "../../mgt_config/sql.php";

$sql_str="SELECT * FROM cms_clx WHERE deleted <>'y' AND type <>'other'";
$acc_search = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");

echo "<table border='1'>";

while ($results = mysql_fetch_array($acc_search)):
echo "<tr><td>".$results['year']."</td><td>".$results['number']."</td><td>CLX-".$results['type']."-".$results['numb']."</td></tr>";
endwhile;

echo "</table>";





?>