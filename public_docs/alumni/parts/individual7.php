<?php $sql_str="SELECT * FROM eua_early_women WHERE id LIKE '$id'";
	 
	 $studentsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	echo "<h1>".$pagetitle."</h1>";
	 
	 echo "<table cellpadding='5' align='center' width='600' border='1'>";
	 
	 $results = mysql_fetch_array($studentsearch);
	 
	 echo "<tr><td class='label' width='200'>Surname</td><td>".$results['surname']."</td></tr>";	 
	 echo "<tr><td class='label'>Forename</td><td>".$results['forename']."</td></tr>";
	 	 
	 echo "<tr><td class='label'>Award</td><td>".$results['award']."&nbsp;</td></tr>";
	 	 
	 echo "<tr><td class='label'>Source</td><td>".$results['source']."</td></tr>";
	 
	 if ($results['notes'] <>'') {		 
	 echo "<tr><td class='label'>Notes</td><td>".$results['notes']."</td></tr>";
	 }
	 echo "</table>";
	 
	 	echo "<hr />";
	 
	 	include "info/7.php"; ?> 