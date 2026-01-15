<?php		$sql_str2="SELECT * FROM eua_medstud_students WHERE surname LIKE '%$surname%' AND forename LIKE '%$forename%' ORDER BY surname ASC";
	 
	 $medstud_search = mysql_db_query($dbname, $sql_str2, $id_link) or die("Search Failed!");
	 
	 $hits = mysql_num_rows($medstud_search);
	
	echo "<h1>Students of Medicine, 1833-1846 (sample)</h1>";

echo "<p>".$hits." results</p>";
	 
	 echo "<table cellpadding='5' align='center' width='500'>";
	 
	 while ($medstud_results = mysql_fetch_array($medstud_search)){
	 
	 echo "<tr><td width='350'><a href='".$_SERVER['PHP_SELF']."?view=individual2&amp;id=".$medstud_results['id']."'>".$medstud_results['surname'].", ".$medstud_results['forename']."</a></td><td> ".$medstud_results['fea']."</td></tr>";
	 
	 }
	 
	 echo "</table>";
	 
	 echo "<hr />";
	 
	 include "info/2.php"; ?>