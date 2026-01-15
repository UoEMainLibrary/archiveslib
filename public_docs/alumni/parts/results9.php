<?php		$sql_str9="SELECT * FROM eua_students_extraac WHERE surname LIKE '%$surname%' AND forename LIKE '%$forename%' ORDER BY surname ASC, forename ASC";
	 
	 $eastud_search = mysql_db_query($dbname, $sql_str9, $id_link) or die("Search Failed!");
	 
	 $hits = mysql_num_rows($eastud_search);
	
	echo "<h1>Extra Academical Students, 1825-1865</h1>";

echo "<p>".$hits." results</p>";
	 
	 echo "<table cellpadding='5' align='center' width='500'>";
	 
	 while ($ea_results = mysql_fetch_array($eastud_search)){
	 
	 echo "<tr><td width='350'><a href='".$_SERVER['PHP_SELF']."?view=individual9&amp;id=".$ea_results['ID']."'>".$ea_results['surname'].", ".$ea_results['forename']."</a></td><td> ".$ea_results['AcademicYear']."</td></tr>";
	 
	 }
	 
	 echo "</table>";
	 
	 echo "<hr />";
	 
	 include "info/9.php"; ?>