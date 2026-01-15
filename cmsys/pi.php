<? 

$mode = $_GET['mode'];
$iid = $_GET['iid'];


if ($mode=="ind") {

$sql_str="SELECT * FROM dtf_photill_survey WHERE pin='$iid' ORDER BY pin ASC";
	 $search = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
     
	 
     echo "<table border='1' cellpadding='2' cellspacing='5'>";
	 echo "<tr><td>No.</td><td>(suffix)</td><td>Bay</td><td>Shelf</td><td>Description</td><td>Note</td></tr>";
	 while ($results = mysql_fetch_array($search)): 
	 
	 echo "<tr><td valign='top'>Phot.Ill.".$results['pin']."&nbsp;</td><td valign='top'>".$results['psfx']."&nbsp;</td><td valign='top'>".$results['bay']."&nbsp;</td><td valign='top'>".$results['shelf']."&nbsp;</td><td valign='top'>";
	 $pin = $results['pin'];
	 $sql_str2 = "SELECT description FROM dtf_photill WHERE prefix LIKE 'Phot.Ill.' AND number='$pin'";
	 $search2 = mysql_db_query($dbname, $sql_str2, $id_link) or die("Search Failed!");
	 
	 while ($results2 = mysql_fetch_array($search2)):
	 
	 echo "<p>".$results2['description']."</p>";
	 
	 endwhile;
	 
	 echo "&nbsp;</td><td>".$results['note']."&nbsp;</td></tr>";
	 
	 endwhile;
	 
	 echo "</table>";
	 
}

elseif ($mode=="all") {

$sql_str="SELECT * FROM dtf_photill_survey WHERE pin>0 AND bay<>0 ORDER BY pin ASC";
	 $search = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
     
	 
     echo "<table border='1' cellpadding='2' cellspacing='5'>";
	 echo "<tr><td>No.</td><td>(suffix)</td><td>Bay</td><td>Shelf</td><td>Description</td><td>Note</td></tr>";
	 while ($results = mysql_fetch_array($search)): 
	 
	 echo "<tr><td valign='top'>Phot.Ill.".$results['pin']."&nbsp;</td><td valign='top'>".$results['psfx']."&nbsp;</td><td valign='top'>".$results['bay']."&nbsp;</td><td valign='top'>".$results['shelf']."&nbsp;</td><td valign='top'>";
	 $pin = $results['pin'];
	 $sql_str2 = "SELECT description FROM dtf_photill WHERE prefix LIKE 'Phot.Ill.' AND number='$pin'";
	 $search2 = mysql_db_query($dbname, $sql_str2, $id_link) or die("Search Failed!");
	 
	 while ($results2 = mysql_fetch_array($search2)):
	 
	 echo "<p>".$results2['description']."</p>";
	 
	 endwhile;
	 
	 echo "&nbsp;</td><td>".$results['note']."&nbsp;</td></tr>";
	 
	 endwhile;
	 
	 echo "</table>";
	 
}
elseif ($mode=="dups") {

$sql_str="SELECT pin, count(pin) FROM dtf_photill_survey GROUP BY pin having count(pin)>1";
	 $search = mysql_db_query($dbname, $sql_str, $id_link) or die("Search for dups Failed!");
     
	 
     echo "<table border='1' cellpadding='2' cellspacing='5'>";
	 while ($results = mysql_fetch_array($search)): 
	## echo "<tr><td valign='top'>".$results['pin']."</td></tr>";	 
	  
	 echo "<tr><td valign='top'><a href='".$_GET['PHP_SELF']."?func=pi&amp;mode=ind&amp;iid=".$results['pin']."'>Phot.Ill.".$results['pin']."</a></td></tr>";
endwhile;
echo "</table>";	 

}
else {

echo "<p>Items bearing Phot.Ill. shelfmarks will normally be in either 5.24 or 5.05 (depending on their size).</p>";

echo "<ul><li><a href='".$_GET['PHP_SELF']."?func=pi&amp;mode=all'>Complete list</a></li></ul>";

}
 ?>
