<?php $sql_str="SELECT * FROM eua_students_newcoll WHERE id LIKE '$id'";
	 
	 $studentsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	echo "<h1>".$pagetitle."</h1>";
	 
	 echo "<table cellpadding='5' align='center' width='600' border='1'>";
	 
	 $results = mysql_fetch_array($studentsearch);
	 
	 echo "<tr><td class='label' width='150'>Surname</td><td>".$results['surname']."</td></tr>";	 
	 echo "<tr><td class='label'>Forename</td><td>".$results['forename']."</td></tr>";	 
	 echo "<tr><td class='label'>Matriculation No.</td><td>".$results['matric_no']."</td></tr>"; 
	 echo "<tr><td class='label'>Matriculated</td><td>".$results['matric_year']."</td></tr>"; 
	 if ($results['origin'] <>'') {	
	 echo "<tr><td class='label'>Place of origin</td><td>".$results['origin']."</td></tr>";
}
	 if ($results['education'] <>'') {	 
  	 echo "<tr><td class='label'>Other Education</td><td>".$results['education']."</td></tr>";
}
	 if ($results['biography'] <>'') {	 
	 echo "<tr><td class='label'>Biographical</td><td>".$results['biography']."</td></tr>";
	 }
	 if ($results['notes'] <>'') {	 
	 echo "<tr><td class='label'>Notes</td><td>".$results['notes']."</td></tr>";
	 }
	 
	 echo "</table>";
	 
	 echo "<h2>Abbreviations used in this database</h2>";
	 
	 echo "<p>A.C.B. Assembly's College Belfast; Coll. College; E.U. Edinburgh University; G. U. Glasgow University; Ire. Ireland; Miss. Missionary; P.T.S. Princeton Theological Seminary, USA; Presby. Presbyterian; Q.C.B. Queen's College Belfast; R.U.I Royal University Ireland; T.C.D. Trinity College Dublin; b. born; d. died; ed. Educated; ord. ordained; T.S. Theological Seminary; U. University</p>";
	 
	 	echo "<hr />";
	 
	 	include "info/4.php";
 ?> 