<?php include "../../mgt_config/sql.php"; 



echo "Boxes<br>";

$sql_str="SELECT DISTINCT prefix,box FROM eua_box_contents WHERE prefix LIKE 'A' ORDER BY box ASC";
		$search = mysql_db_query($dbname, $sql_str, $id_link);
		
		while ($results = mysql_fetch_array($search)) {	
		
		echo "<b>Box no: EUA-A-".$results['box']."</b><br>";
		$box = $results['box'];
		
		$sql_str2="SELECT * FROM eua_box_contents WHERE prefix LIKE 'A' AND box =$box";
		$search2 = mysql_db_query($dbname, $sql_str2, $id_link);
		echo "<table width='100%' cellpadding='5' border='1'>";
		while ($results2 = mysql_fetch_array($search2)) {
		
		echo "<tr><td width='300' valign='top'>".$results2['unitid']."</td><td valign='top'>".$results2['contents']."</td><td width='250' valign='top'>Old shelfmark: ".$results2['shelfmark']."</td></tr>";
		
		}
		echo "</table>";
		echo "<br>{pagebreak}<br>";
			
		}
		
		
?>

