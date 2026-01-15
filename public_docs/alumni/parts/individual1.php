<?php $sql_str="SELECT * FROM eua_rosner_students WHERE ID like '$id'";

	$studentsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
		
		$results = mysql_fetch_array($studentsearch);
	
	echo "<h1>".$pagetitle."</h1>";
	
	  echo "<table cellpadding='5' align='center' width='600' border='1'>";
		
		echo "<tr><td width='200' class='label'>Surname</td><td width='400'>".$results['LAST']."</td></tr>";		
		echo "<tr><td class='label'>Forename</td><td>".$results['FIRST']."</td></tr>";		
		echo "<tr><td class='label'>Years of study</td><td>".$results['YR']."</td></tr>";		
		echo "<tr><td class='label'>First year</td><td>".$results['YEAR1']."</td></tr>";
		if ($results['YEAR2'] >0) {		
		echo "<tr><td class='label'>Second year</td><td>".$results['YEAR2']."</td></tr>";
		}
		if ($results['YEAR3'] >0) {			
		echo "<tr><td class='label'>Third year</td><td>".$results['YEAR3']."</td></tr>";
		}
		if ($results['YEAR4'] >0) {			
		echo "<tr><td class='label'>Fourth year</td><td>".$results['YEAR4']."</td></tr>";
		}
		if ($results['YEAR5'] >0) {			
		echo "<tr><td class='label'>Fifth year</td><td>".$results['YEAR5']."</td></tr>";	
		}
		if ($results['YEAR6'] >0) {		
		echo "<tr><td class='label'>Sixth year</td><td>".$results['YEAR6']."</td></tr>";
		}
		if ($results['YEAR7'] >0) {			
		echo "<tr><td class='label'>Seventh year</td><td>".$results['YEAR7']."</td></tr>";
		}
		echo "<tr><td class='label'>MD (Edin)</td><td>";
		if ($results['YRMDEDIN'] >0) {	
		
		echo $results['YRMDEDIN'];
		
		## find images to link to for this year
		
		$year = $results['YRMDEDIN'];
		
		$link_sql_str="SELECT * FROM eua_students_ld WHERE year LIKE '$year'";

	  $linksearch = mysql_db_query($dbname, $link_sql_str, $id_link) or die("Select Failed!");
		$hits = mysql_num_rows($linksearch);
		if ($hits>0) {
		echo " </td></tr>\n<tr><td class='label' valign='top'>Laureation &amp; Degrees Album</td><td>Relevant page or pages, (one of) which should contain this student's signature, taken at graduation.";
		
		while ($linkresults = mysql_fetch_array($linksearch)) {
	
		echo "<a href='image.php?view=individual&amp;id=".$linkresults['image']."'><img align='right' src='/graphics/view.gif' alt='View page'></a>";

		}
		}
		## end of images
		
		}
		else {
		echo "No";
		}
		echo "</td></tr>";
		if ($results['YRARCS'] >0) {		
		echo "<tr><td class='label'>ARCS</td><td>".$results['YRARCS']."</td></tr>";
		}
		if ($results['YRDRCS'] >0) {		
		echo "<tr><td class='label'>DRCS</td><td>".$results['YRDRCS']."</td></tr>";
		}
		if ($results['YRFRCS'] >0) {		
		echo "<tr><td class='label'>FRCS</td><td>".$results['YRFRCS']."</td></tr>";
		}
		if ($results['YRRAMC'] >0) {				
		echo "<tr><td class='label'>RAMC</td><td>".$results['YRRAMC']."</td></tr>";
		}
		if ($results['YRRMS'] >0) {		
		echo "<tr><td class='label'>RMS</td><td>".$results['YRRMS']."</td></tr>";
		}
		if ($results['YRIMS'] >0) {			
		echo "<tr><td class='label'>IMS</td><td>".$results['YRIMS']."</td></tr>";
		}
		if ($results['YRNAVY'] >0) {									
		echo "<tr><td class='label'>Royal Navy</td><td>".$results['YRNAVY']."</td></tr>";
		}		
		echo "</table>";
	 
	 	echo "<hr />";
	 
	 	include "info/1.php"; ?>