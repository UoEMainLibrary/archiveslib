<?php		$sql_str="SELECT * FROM eua_rosner_students WHERE LAST LIKE '$surname%' AND FIRST LIKE '$forename%' AND MDEDIN LIKE '$mdedin%' AND FRCS LIKE '$frcs%' AND ARCS LIKE '$arcs%' AND DRCS LIKE '$drcs%' AND RAMC LIKE '$ramc%' AND RMS LIKE '$rms%' AND IMS LIKE '$ims%' AND AP7 LIKE '$navy%' ORDER BY LAST ASC, FIRST ASC";

// due to a conversion issue from original text database, content of NAVY currently falls in AP7.  The above must be altered when data clean-up has been completed

	$studentsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
	

	echo "<h1>".$pagetitle."</h1>";
	
	echo "<table cellpadding='5' align='center' width='700' border='0'>";
	echo "<thead><th>Database</th><th>Results</th><th>&nbsp;</th></thead>";
	
	$hits = mysql_num_rows($studentsearch);
	
	echo "<tr><td>".$datatitle1."</td><td>";
	if ($hits>0) {
	echo "<a href='".$_SERVER['PHP_SELF']."?view=results1&amp;surname=".$surname."&amp;forename=".$forename."&amp;mdedin=".$mdedin."&amp;frcs=".$frcs."&amp;arcs=".$arcs."&amp;drcs=".$drcs."&amp;ramc=".$ramc."&amp;rms=".$rms."&amp;ims=".$ims."&amp;navy=".$navy."'>View [".$hits."]</a>";
  }
	else {
	echo "0";
	}

  echo "</td><td><a href='".$_SERVER['PHP_SELF']."?view=advanced1&amp;surname=".$surname."'>Refine search on this database</a></td></tr>";
	
			$sql_str2="SELECT * FROM eua_medstud_students WHERE surname LIKE '%$surname%' AND forename LIKE '%$forename%' ORDER BY surname ASC";
	 
	 $medstud_search = mysql_db_query($dbname, $sql_str2, $id_link) or die("Search Failed!");
	 
	 $hits = mysql_num_rows($medstud_search);
	
	echo "<tr><td>".$datatitle2."</td><td>";
	if ($hits>0) {
	echo "<a href='".$_SERVER['PHP_SELF']."?view=results2&amp;surname=".$surname."&amp;forename=".$forename."'>View [".$hits."]</a>";
  }
	else {
	echo "0";
	}
echo "</td><td><a href='".$_SERVER['PHP_SELF']."?view=advanced2&amp;surname=".$surname."'>Refine search on this database</a></td></tr>";

		$sql_str2="SELECT * FROM eua_students_vetgrad WHERE surname LIKE '%$surname%' AND forename LIKE '%$forename%' ORDER BY surname ASC";
	 
	 $vetstud_search = mysql_db_query($dbname, $sql_str2, $id_link) or die("Search Failed!");
	 
	 $hits = mysql_num_rows($vetstud_search);
	
	echo "<tr><td>".$datatitle3."</td><td>";
	if ($hits>0) {
	echo "<a href='".$_SERVER['PHP_SELF']."?view=results3&amp;surname=".$surname."&amp;forename=".$forename."'>View [".$hits."]</a>";
  }
	else {
	echo "0";
	}
echo "</td><td><a href='".$_SERVER['PHP_SELF']."?view=advanced3&amp;surname=".$surname."'>Refine search on this database</a></td></tr>";

		$sql_str4="SELECT * FROM eua_students_newcoll WHERE surname LIKE '%$surname%' AND forename LIKE '%$forename%' ORDER BY surname ASC";
	 
	 $ncstud_search = mysql_db_query($dbname, $sql_str4, $id_link) or die("Search Failed!");
	 
	 $hits = mysql_num_rows($ncstud_search);
	
	echo "<tr><td>".$datatitle4."</td><td>";
	if ($hits>0) {
	echo "<a href='".$_SERVER['PHP_SELF']."?view=results4&amp;surname=".$surname."&amp;forename=".$forename."'>View [".$hits."]</a>";
  }
	else {
	echo "0";
	}
echo "</td><td><a href='".$_SERVER['PHP_SELF']."?view=advanced4&amp;surname=".$surname."'>Refine search on this database</a></td></tr>";

		$sql_str5="SELECT * FROM eua_firstmatrics WHERE surname LIKE '%$surname%' AND forename LIKE '%$forename%' ORDER BY surname ASC";
	 
	 $fmstud_search = mysql_db_query($dbname, $sql_str5, $id_link) or die("Search Failed!");
	 
	 $hits = mysql_num_rows($fmstud_search);
	
	echo "<tr><td>".$datatitle5."</td><td>";
	if ($hits>0) {
	echo "<a href='".$_SERVER['PHP_SELF']."?view=results5&amp;surname=".$surname."&amp;forename=".$forename."'>View [".$hits."]</a>";
  }
	else {
	echo "0";
	}
echo "</td><td><a href='".$_SERVER['PHP_SELF']."?view=advanced5&amp;surname=".$surname."'>Refine search on this database</a></td></tr>";

		$sql_str7="SELECT * FROM eua_early_women WHERE surname LIKE '%$surname%' AND forename LIKE '%$forename%' ORDER BY surname ASC";
	 
	 $ewstud_search = mysql_db_query($dbname, $sql_str7, $id_link) or die("Search Failed!");
	 
	 $hits = mysql_num_rows($ewstud_search);
	
	echo "<tr><td>".$datatitle7."</td><td>";
	if ($hits>0) {
	echo "<a href='".$_SERVER['PHP_SELF']."?view=results7&amp;surname=".$surname."&amp;forename=".$forename."'>View [".$hits."]</a>";
  }
	else {
	echo "0";
	}
echo "</td><td><a href='".$_SERVER['PHP_SELF']."?view=advanced7&amp;surname=".$surname."'>Refine search on this database</a></td></tr>";

		$sql_str8="SELECT * FROM eua_students_vet1 WHERE surname LIKE '%$surname%' AND forename LIKE '%$forename%' ORDER BY surname ASC";
	 
	 $evstud_search = mysql_db_query($dbname, $sql_str8, $id_link) or die("Search Failed!");
	 
	 $hits = mysql_num_rows($evstud_search);
	
	echo "<tr><td>".$datatitle8."</td><td>";
	if ($hits>0) {
	echo "<a href='".$_SERVER['PHP_SELF']."?view=results8&amp;surname=".$surname."&amp;forename=".$forename."'>View [".$hits."]</a>";
  }
	else {
	echo "0";
	}
echo "</td><td><a href='".$_SERVER['PHP_SELF']."?view=advanced8&amp;surname=".$surname."'>Refine search on this database</a></td></tr>";


		$sql_str9="SELECT * FROM eua_students_extraac WHERE surname LIKE '%$surname%' AND forename LIKE '%$forename%' ORDER BY surname ASC";
	 
	 $eastud_search = mysql_db_query($dbname, $sql_str9, $id_link) or die("Search Failed!");
	 
	 $hits = mysql_num_rows($eastud_search);
	
	echo "<tr><td>".$datatitle9."</td><td>";
	if ($hits>0) {
	echo "<a href='".$_SERVER['PHP_SELF']."?view=results9&amp;surname=".$surname."&amp;forename=".$forename."'>View [".$hits."]</a>";
  }
	else {
	echo "0";
	}
echo "</td><td><a href='".$_SERVER['PHP_SELF']."?view=advanced9&amp;surname=".$surname."'>Refine search on this database</a></td></tr>";




echo "<tr><td colspan='3'><br />";
include "info/dp.php";
echo "</td></tr>";

echo "</table>";
?>