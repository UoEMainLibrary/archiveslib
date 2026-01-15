<?php		$sql_str8="SELECT * FROM eua_students_vet1 WHERE surname LIKE '%$surname%' AND forename LIKE '%$forename%' ORDER BY surname ASC, forename ASC";
	 
	 $evstud_search = mysql_db_query($dbname, $sql_str8, $id_link) or die("Search Failed!");
	 
	 $hits = mysql_num_rows($evstud_search);
	
	echo "<h1>Early Veterinary Graduates, 1825-1865</h1>";

echo "<p>".$hits." results</p>";
	 
	 echo "<table cellpadding='5' align='center' width='500'>";
	 
	 while ($ev_results = mysql_fetch_array($evstud_search)){
	 
	 echo "<tr><td width='350'><a href='".$_SERVER['PHP_SELF']."?view=individual8&amp;id=".$ev_results['id']."'>".$ev_results['surname'].", ".$ev_results['forename']."</a></td><td> ".$ev_results['year']."</td></tr>";
	 
	 }
	 
	 echo "</table>";
	 
	 echo "<hr />";
	 
	 include "info/8.php"; ?>