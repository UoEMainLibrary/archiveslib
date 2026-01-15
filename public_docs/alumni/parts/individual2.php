<?php $sql_str="SELECT * FROM eua_medstud_students WHERE id LIKE '$id'";
	 
	 $studentsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	echo "<h1>".$pagetitle."</h1>";
	 
	 echo "<table cellpadding='5' align='center' width='600' border='1'>";
	 
	 $results = mysql_fetch_array($studentsearch);
	 
	 $forename = ucwords(strtolower($results['forename']));
	 $thesistitle = ucwords(strtolower($results['thesistitle']));
	 
	 echo "<tr><td class='label' width='100'>Surname</td><td>".$results['surname']."</td></tr>";	 
	 echo "<tr><td class='label'>Forename</td><td>".$forename."</td></tr>";	 
	 echo "<tr><td class='label'>Enrolled?</td><td>".$results['fea']."</td></tr>";	 
	 echo "<tr><td class='label'>Date of Degree</td><td>".$results['degreedate']."</td></tr>";	 
	 echo "<tr><td class='label'>Birthplace</td><td>".$results['birthplace']." ".$results['birthcountry']."</td></tr>";	 
	 echo "<tr><td class='label'>Address</td><td>".$results['address']."</td></tr>";	 
	 echo "<tr><td class='label'>Thesis title</td><td>".$thesistitle."</td></tr>";	 
	 echo "<tr><td class='label'>Notes</td><td>".$results['notes']."</td></tr>";
	 
	 
	 echo "</table>";
	 
	 	echo "<hr />";
	 
	 	include "info/2.php"; ?>