<?php		$sql_str5="SELECT * FROM eua_firstmatrics WHERE surname LIKE '%$surname%' AND forename LIKE '%$forename%' AND gender LIKE '$gender%' ORDER BY surname ASC, forename ASC";
	 
	 $fmstud_search = mysql_db_query($dbname, $sql_str5, $id_link) or die("Search Failed!");
	 
	 $hits = mysql_num_rows($fmstud_search);
	
	echo "<h1>First Matriculations (1890-1899)</h1>";

echo "<p>".$hits." results</p>";
	 
	 echo "<table cellpadding='5' align='center' width='500'>";
	 
	 while ($fm_results = mysql_fetch_array($fmstud_search)){
	 
	 echo "<tr><td width='350'><a href='".$_SERVER['PHP_SELF']."?view=individual5&amp;id=".$fm_results['id']."'>".$fm_results['surname'].", ".$fm_results['forename']."</a></td><td> ".$fm_results['year']."</td></tr>";
	 
	 }
	 
	 echo "</table>";
	 
	 echo "<hr />";
	 
	 include "info/5.php"; ?>