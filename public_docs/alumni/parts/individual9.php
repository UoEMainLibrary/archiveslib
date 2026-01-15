<?php $sql_str="SELECT * FROM eua_students_extraac WHERE id LIKE '$id'";
	 
	 $studentsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	echo "<h1>".$pagetitle."</h1>";
	 
	 echo "<table cellpadding='5' align='center' width='600' border='1'>";
	 
	 $results = mysql_fetch_array($studentsearch);
	 
	 echo "<tr><td class='label' width='200'>Surname</td><td>".$results['surname']."</td></tr>";	 
	 echo "<tr><td class='label'>Forename</td><td>".$results['forename']."</td></tr>";	 
	 echo "<tr><td class='label'>Gender</td><td>".$results['Gender']."</td></tr>";
	 
	 	 
	 echo "<tr><td class='label'>Country</td><td>".$results['Country']."</td></tr>";
	 	 
	 echo "<tr><td class='label'>Class</td><td>".$results['Class']."</td></tr>";
	 	 
	 echo "<tr><td class='label'>Academic Year</td><td>".$results['AcademicYear']."&nbsp;</td></tr>";
	 echo "</table>";
	 
	 	echo "<hr />";
	 
	 	include "info/9.php"; ?> 