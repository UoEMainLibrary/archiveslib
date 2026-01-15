<?php include "../../mgt_config/sql.php";

	header('Content-Type: text/xml');
	
?>
<?xml version="1.0" encoding="utf-8"?>
<ead>
	<eadheader>
		<eadid countrycode="GB" mainagencycode="237">EUA-Misc-Photos</eadid>
		<filedesc>
			<titlestmt>
				<titleproper>Misc Photos</titleproper>
			</titlestmt>
		</filedesc>
	</eadheader>
	<archdesc level="fonds">
		<did>
			<unitid encodinganalog="isadg(2)311" label="Reference code">EUA-Misc-Photos</unitid>
			<unittitle encodinganalog="isadg(2)312">Misc Uncatalogued Photos</unittitle>
			<unitdate encodinganalog="isadg(2)313" type="bulk">20th century</unitdate>
			<physdesc label="Extent and Medium of the Unit of Description"
				encodinganalog="isadg(2)315">
				<extent type="linear" unit="metre">1 unit</extent>
			</physdesc>
			<langmaterial>
				<language langcode="eng">English</language>
			</langmaterial></did>

<?php

 $sql_str="SELECT * FROM eua_photographs WHERE Location <>'Quatercentenary' AND Location <>'Athletic Club Albums' ORDER BY DateFrom ASC";
 
##  $sql_str="SELECT * FROM eua_photographs WHERE Location LIKE 'Quatercentenary'";


$photsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");



echo "<dsc>";

	 
	 while ($results = mysql_fetch_array($photsearch)):
	 
	 if ($results['staff'] == 'y') { $staff = "<subject>University of Edinburgh: staff</subject>";} else {$staff = "";}
	 if ($results['students'] == 'y') { $students = "<subject>University of Edinburgh: students</subject>";} else {$students = "";}
	 if ($results['campus'] == 'y') { $campus = "<subject>University of Edinburgh: campus</subject>";} else {$campus = "";}
	 
	 if ($results['dateTo'] =='') {$date = $results['dateFrom']; } else {$date = $results['dateFrom']."-".$results['dateTo']; }
	 
	 
	 $controlaccess = "<controlaccess><genreform>photograph</genreform>".$staff.$students.$campus."</controlaccess>";
	 
	 if ($controlaccess <> "<controlaccess></controlaccess>") {
	 
	 
	 
	 echo "<c><did><unittitle>".utf8_encode(htmlspecialchars($results['Description']))."</unittitle>";
	 
	 if ($date <>'') {
	 echo "<unitdate>".$date."</unitdate>";
	 }
	 
	 echo "<unitid>".$results['Prefix'].$results['Number']."</unitid><container type='OpenShelf'>".$results['Location']."</container></did>".$controlaccess."</c>";
	 }
	 endwhile;
	 

echo "</dsc>";

	 
?>
	</archdesc>
</ead>