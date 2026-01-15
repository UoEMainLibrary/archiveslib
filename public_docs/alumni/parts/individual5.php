<?php $sql_str="SELECT * FROM eua_firstmatrics WHERE id LIKE '$id'";
	 
	 $studentsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	echo "<h1>".$pagetitle."</h1>";
	 
	 echo "<table cellpadding='5' align='center' width='600' border='1'>";
	 
	 $results = mysql_fetch_array($studentsearch);
	 
	 echo "<tr><td class='label' width='200'>Surname</td><td>".$results['surname']."</td></tr>";	 
	 echo "<tr><td class='label'>Forename</td><td>".$results['forename']."</td></tr>";	
	  
	 echo "<tr><td class='label'>Gender</td><td>".$results['gender']."</td></tr>";
	 	 
	 echo "<tr><td class='label'>Age</td><td>".$results['age']."&nbsp;</td></tr>";
	 	 
	 echo "<tr><td class='label'>Year</td><td>".$results['year']."</td></tr>";
	 	 
	 echo "<tr><td class='label'>Birthplace</td><td>".$results['birthplace']."</td></tr>";
	 if ($results['country'] <>'') {		 
	 echo "<tr><td class='label'>Country</td><td>".$results['country']."</td></tr>";
	 }	 
	 echo "<tr><td class='label'>Faculty</td><td>".$results['faculty']."</td></tr>";
	 if ($results['school'] <>'') {	 
	 echo "<tr><td class='label'>School</td><td>".$results['school']."</td></tr>";
	 }
	 if ($results['prevmed'] <>'') {		 
	 echo "<tr><td class='label'>Previous Medical Education</td><td>".$results['prevmed']."</td></tr>";
	 }
	 if ($results['prevuni'] <>'') {		 
	 echo "<tr><td class='label'>Previous University</td><td>".$results['prevuni']."</td></tr>";
	 }
	 
	 echo "</table>";
	 
	 	echo "<hr />";
	 
	 	include "info/5.php"; ?> 