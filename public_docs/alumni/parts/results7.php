<?php		$sql_str7="SELECT * FROM eua_early_women WHERE surname LIKE '%$surname%' AND forename LIKE '%$forename%' ORDER BY surname ASC, forename ASC";
	 
	 $ewstud_search = mysql_db_query($dbname, $sql_str7, $id_link) or die("Search Failed!");
	 
	 $hits = mysql_num_rows($ewstud_search);
	
	echo "<h1>Awards to Women students, 1876-1894</h1>";

echo "<p>".$hits." results</p>";
	 
	 echo "<table cellpadding='5' align='center' width='500'>";
	 
	 while ($ew_results = mysql_fetch_array($ewstud_search)){
	 
	 echo "<tr><td width='350'><a href='".$_SERVER['PHP_SELF']."?view=individual7&amp;id=".$ew_results['id']."'>".$ew_results['surname'].", ".$ew_results['forename']."</a></td><td> ".$ew_results['date']."</td></tr>";
	 
	 }
	 
	 echo "</table>";
	 
	 echo "<hr />";
	 
	 include "info/7.php"; ?>