<?php		$sql_str="SELECT * FROM eua_rosner_students WHERE LAST LIKE '$surname%' AND FIRST LIKE '$forename%' AND MDEDIN LIKE '$mdedin%' AND FRCS LIKE '$frcs%' AND ARCS LIKE '$arcs%' AND DRCS LIKE '$drcs%' AND RAMC LIKE '$ramc%' AND RMS LIKE '$rms%' AND IMS LIKE '$ims%' AND AP7 LIKE '$navy%' ORDER BY LAST ASC, FIRST ASC";

// due to a conversion issue from original text database, content of NAVY currently falls in AP7.  The above must be altered when data clean-up has been completed

	$studentsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
	
	echo "<h1>",$pagetitle."</h1>";
	
	$hits = mysql_num_rows($studentsearch);
	
	echo "<p>".$hits." results</p>";
	
	  echo "<table cellpadding='5' align='center' width='500'>";
		
		echo "<thead><th width='350'>Name</th><th>First attended</th></thead>";
		
		while ($results = mysql_fetch_array($studentsearch)):
		
		echo "<tr><td><a href='".$_SERVER['PHP_SELF']."?view=individual1&amp;id=".$results['ID']."'>".$results['LAST'].", ".$results['FIRST']."</a></td><td>".$results['YEAR1']."</td></tr>";
		
		endwhile;
		
		echo "</table>";
		
		echo "<hr />";
	 
	 include "info/1.php"; ?>