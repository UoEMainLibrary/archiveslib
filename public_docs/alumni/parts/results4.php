<?php		$sql_str3="SELECT * FROM eua_students_newcoll WHERE surname LIKE '%$surname%' ORDER BY surname ASC";
	 
	 $ncstud_search = mysql_db_query($dbname, $sql_str3, $id_link) or die("Search Failed!");
	 
	 $hits = mysql_num_rows($ncstud_search);
	
	echo "<h1>".$datatitle4."</h1>";

echo "<p>".$hits." results</p>";

 include "info/dp.php";
	 
	 echo "<table cellpadding='5' align='center' width='500'>";
	 
	 while ($ncstud_results = mysql_fetch_array($ncstud_search)){
	 
	 if ($ncstud_results['matric_year']<($validyear-4)) {
echo "<tr><td width='350'><a href='".$_SERVER['PHP_SELF']."?view=individual4&amp;id=".$ncstud_results['id']."'>".$ncstud_results['surname'].", ".$ncstud_results['forename']."</a></td><td> ".$ncstud_results['matric_year']."</td></tr>";
}
elseif ($ncstud_results['deceased']=='y') {
echo "<tr><td width='350'><a href='".$_SERVER['PHP_SELF']."?view=individual4&amp;id=".$ncstud_results['id']."'>".$ncstud_results['surname'].", ".$ncstud_results['forename']."</a></td><td> ".$ncstud_results['matric_year']."</td></tr>";
}
else {
echo "<tr><td>".$ncstud_results['surname']." [Restricted record]</td><td>".$ncstud_results['matric_year']."</td></tr>";
}
	 
	 }
	 
	 echo "</table>";
	 
	 echo "<hr />";
	 
	 include "info/4.php"; ?>