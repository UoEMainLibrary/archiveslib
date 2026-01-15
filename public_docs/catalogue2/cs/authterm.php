<?php

## This script is designed to be called by an xslt stylesheet and retrieve the most current version of a term 
## from the Authorities database for inclusion in xml/EAD document

##call database connection
include "../../../mgt_config/sql.php";

## set output as xml
header("Content-Type: text/xml"); 


## define variables
$table = $_GET['table'];
$authfilenumber = $_GET['authfilenumber'];

if ($table == "cms_auth_subj") {

 	 $sql_str="SELECT * FROM cms_auth_subj WHERE id LIKE '$authfilenumber'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch); ?>
     
     <subject authfilenumber='<?php echo $results['id'] ?>'><?php echo $results['term'] ?></subject>
     
     <?
	 
 }
 
 elseif ($table == "cms_auth_geog") {

 	 $sql_str="SELECT * FROM cms_auth_geog WHERE id LIKE '$authfilenumber'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch); ?>
     
     <geogname authfilenumber='<?php echo $results['id'] ?>'><?php echo $results['term'] ?></geogname>
     
     <?
	 
 }
?>

  

     


