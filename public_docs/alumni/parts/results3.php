<?php		$sql_str3="SELECT * FROM eua_students_vetgrad WHERE surname LIKE '%$surname%' ORDER BY surname ASC";
	 
	 $vetstud_search = mysql_db_query($dbname, $sql_str3, $id_link) or die("Search Failed!");
	 
	 $hits = mysql_num_rows($vetstud_search);
	
	echo "<h1>".$datatitle3."</h1>";

echo "<p>".$hits." results</p>";

include "info/dp.php";
	 
	 echo "<table cellpadding='5' align='center' width='500'>";
	 
	 while ($vetstud_results = mysql_fetch_array($vetstud_search)){
	 
	 if ($vetstud_results['year']<$validyear) {
echo "<tr><td width='350'><a href='".$_SERVER['PHP_SELF']."?view=individual3&amp;id=".$vetstud_results['id']."'>".$vetstud_results['surname'].", ".$vetstud_results['forename']."</a></td><td> ".$vetstud_results['year']."</td></tr>";
}
elseif ($vetstud_results['notes']=='%died%') {
echo "<tr><td width='350'><a href='".$_SERVER['PHP_SELF']."?view=individual3&amp;id=".$vetstud_results['id']."'>".$vetstud_results['surname'].", ".$vetstud_results['forename']."</a></td><td> ".$vetstud_results['year']."</td></tr>";
}
else {
echo "<tr><td>[Restricted information]</td><td>".$vetstud_results['year']."</td></tr>";
}
	 
	 }
	 
	 echo "</table>";
	 
	 echo "<hr />";
	 
	 include "info/3.php"; ?>