<?php

##call database connection
include "../../mgt_config/sql.php";
$atype = $_GET['atype'];
if ($_GET['atype'] == "EUA") {
$prefix1 = "EUA";
$prefix2 = "Acc";
} elseif ($_GET['atype'] == "MS") {
$prefix1 = "AMS";
$prefix2 = "E";
} elseif ($_GET['atype'] == "RBP") {
$prefix1 = "RBP";
$prefix2 = "";
}

## set output as xml
 header("Content-Type: text/xml"); 
	echo "<?xml version='1.0' encoding='utf-8'?>";



$sql_str="SELECT * FROM cms_accessions WHERE acc_type LIKE '$atype' ORDER BY year, accession";
	 
	 $acc_search = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 echo "<accessionRecords>";
	 
	 
	 while ($results = mysql_fetch_array($acc_search)):
	 echo "<record>";
	 echo "<accessionNumber>";
	 echo "<part1>".$prefix1."</part1>";
	 echo "<part2>".$prefix2."</part2>";
	 echo "<part3>".$results['year']."</part3>";
	 echo "<part4>".sprintf("%03d",$results['accession'])."</part4>";
	 
	 echo "</accessionNumber>";
	 if ($results['date'] > '0') {
	 echo "<accessionDate>".substr($results['date'], 0, 4)."-".substr($results['date'], 4, 2)."-".substr($results['date'], 6, 2)."</accessionDate>";
	 } else {
	 echo "<accessionDate>".$results['year']."</accessionDate>";
	 }
	 echo "<acquisitionType>".$results['type']."</acquisitionType>";
	 if ($results['restrictions']<>'') {
	 echo "<accessRestrictions>true</accessRestrictions>";
	 echo "<accessRestrictionsNote>".utf8_encode(htmlspecialchars($results['restrictions']))."</accessRestrictionsNote>";
	 }
	 echo "<title>".utf8_encode(htmlspecialchars($results['description']))."</title>";
	 echo "<description>CREATOR: ".utf8_encode(htmlspecialchars($results['creator']))."</description>";
	 echo "<generalAccessionNote>".utf8_encode(htmlspecialchars($results['comments']))."</generalAccessionNote>";
	 echo "<containerSummary>".utf8_encode(htmlspecialchars($results['extent']))."</containerSummary>";
	 echo "<userDefinedString1>ACCESSIONED BY: ".utf8_encode(htmlspecialchars($results['acc_by']))."</userDefinedString1>";
	 echo "<userDefinedString2>ACCESSION DATE: ".$results['acc_date']."</userDefinedString2>";
	 echo "<userDefinedString3>";
	 if ($results['loc_more'] <>''){
	 echo "INITIAL LOCATION: ".utf8_encode(htmlspecialchars($results['loc_more']))." ";
	 }
	 if ($results['shelfmark'] <>''){
	 echo"SHELFMARK: ".utf8_encode(htmlspecialchars($results['shelfmark']));
	 }
	 echo "</userDefinedString3>";
	 echo "<userDefinedText1>DEPOSITOR: ".utf8_encode(htmlspecialchars($results['depositor']))."</userDefinedText1>";
	 echo "<userDefinedText2>CONDITIONS: ".utf8_encode(htmlspecialchars($results['conditions']))."</userDefinedText2>";
	 echo "<userDefinedText3>DOCUMENTATION: ".utf8_encode(htmlspecialchars($results['documentation']))."</userDefinedText3>";
	 echo "<userDefinedText4>ORIGINAL NOTE: ".utf8_encode(htmlspecialchars($results['comments']))." ".utf8_encode(htmlspecialchars($results['comments2']))."</userDefinedText4>";
	 
	 
    
	 echo "</record>";
	 endwhile;
	  echo "</accessionRecords>";
	 

	  ?>