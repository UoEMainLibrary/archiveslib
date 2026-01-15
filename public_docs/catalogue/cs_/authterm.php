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


##subjects
if ($table == "cms_auth_subj") {

 	 $sql_str="SELECT * FROM cms_auth_subj WHERE id LIKE '$authfilenumber'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch); ?>
     
     <subject authfilenumber='<?php echo $results['id'] ?>' source='<?php echo $results['source'] ?>'><?php echo htmlentities($results['term'], ENT_QUOTES) ?></subject>
     
     <?
	 
 }
 
 ##genres
if ($table == "cms_auth_genr") {

 	 $sql_str="SELECT * FROM cms_auth_genr WHERE id LIKE '$authfilenumber'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch); ?>
     
     <genre authfilenumber='<?php echo $results['id'] ?>' source='<?php echo $results['source'] ?>'><?php echo htmlentities($results['term'], ENT_QUOTES) ?></genre>
     
     <?
	 
 }
 
 ## places
 elseif ($table == "cms_auth_geog") {

 	 $sql_str="SELECT * FROM cms_auth_geog WHERE id LIKE '$authfilenumber'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch); ?>
     
     <geogname authfilenumber='<?php echo $results['id'] ?>'><?php if ($results['part_order'] <> '') {

	$parts = explode(",", $results['part_order']);
	foreach ( $parts as $part ) {
		if ($part == "area") { echo $results['term']." "; } else { echo $results[$part]." "; }
		
	}
echo "\n";
}
else {

echo $results['term']." ".$results['island']." ".$results['city']." ".$results['territory']." ".$results['county']." ".$results['country'] ." ".$results['continent']."\n";

} ?></geogname>
     
     <?
	 
 }
 
 ##personal names
if ($table == "cms_auth_pers") {

 	 $sql_str="SELECT * FROM cms_auth_pers WHERE id LIKE '$authfilenumber'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch);
	 
	 if ($results['family_name'] <> '') {	 
	 $family_name = htmlentities($results['family_name'], ENT_QUOTES);	 
	 } else {	 
	 $family_name = "";	 
	 }
	 
	 if ($results['given_name'] <> '') {	 
	 $given_name = htmlentities($results['given_name'], ENT_QUOTES);	 
	 } else {	 
	 $given_name = "";	 	 
	 }
	 
	 if ($results['terms_of_address'] <> '') {	 
	 $terms_of_address = " | ". htmlentities($results['terms_of_address'], ENT_QUOTES);	 
	 } else {	 
	 $terms_of_address = "";	 	 
	 }
	 
	 if ($results['date'] <> '') {	 
	 $date = " | ".$results['date'];	 
	 } else {	 
	 $date = "";	 	 
	 }
	 
	 if ($results['description'] <> '') {	 
	 $description = " | ". htmlentities($results['description'], ENT_QUOTES);	 
	 } else {	 
	 $description = "";	 	 
	 }
	 
	 if ($results['family_name'] <> '') {	 
	 $name = $family_name." | ".$given_name;	 
	 } else {	 
	 $name = $given_name;	 
	 }
	 
	 if ($results['family_name'] <> '') {	 
	 $normal = $family_name.", ".$given_name;	 
	 } else {	 
	 $normal = $given_name;	 
	 }
	 
	 $term = $name.$terms_of_address.$date.$description;
	 
	  ?>
     
     <persname authfilenumber='<?php echo $results['id'] ?>' normal='<?php echo $normal ?>'><?php echo $term ?></persname>
     
     <?
	 
 }
 
 ##corporate names
if ($table == "cms_auth_corp") {

 	 $sql_str="SELECT * FROM cms_auth_corp WHERE id LIKE '$authfilenumber'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch);
	 
	 if ($results['primary_name'] <> '') {	 
	 $primary_name = htmlentities($results['primary_name'], ENT_QUOTES);	 
	 } else {	 
	 $primary_name = "";	 
	 }
	 
	 if ($results['secondary_name'] <> '') {	 
	 $secondary_name = htmlentities($results['secondary_name'], ENT_QUOTES);	 
	 } else {	 
	 $secondary_name = "";	 	 
	 }
	 
	 if ($results['date'] <> '') {	 
	 $date = " | ".$results['date'];	 
	 } else {	 
	 $date = "";	 	 
	 }
	 
	 if ($results['description'] <> '') {	 
	 $description = " | ".htmlentities($results['description'], ENT_QUOTES);	 
	 } else {	 
	 $description = "";	 	 
	 }
	 
	 if ($results['location'] <> '') {	 
	 $location = " | ".htmlentities($results['location'], ENT_QUOTES);	 
	 } else {	 
	 $location = "";	 	 
	 }
	 
	 if ($results['primary_name'] <> '') {	
	 $name = $primary_name." | ".$secondary_name;	 
	 } else {	 
	 $name = $secondary_name;	 
	 }
	 
	 if ($results['primary_name'] <> '') {	 
	 $normal = $primary_name.", ".$secondary_name;	 
	 } else {	 
	 $normal = $secondary_name;	 
	 }
	 
	 $term = $name.$date.$description.$location;
	 
	  ?>
     
     <corpname authfilenumber='<?php echo $results['id'] ?>' normal='<?php echo $normal ?>'><?php echo $term ?></corpname>
     
     <?
	 
 }
 
 ##family names
if ($table == "cms_auth_fam") {

 	 $sql_str="SELECT * FROM cms_auth_fam WHERE id LIKE '$authfilenumber'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch);
	 
	 if ($results['family_name'] <> '') {	 
	 $family_name = htmlentities($results['family_name'], ENT_QUOTES);	 
	 } else {	 
	 $family_name = "";	 
	 }
	 
	 if ($results['title'] <> '') {	 
	 $title = " | ". htmlentities($results['title'], ENT_QUOTES);	 
	 $title_normal = ", ". htmlentities($results['title'], ENT_QUOTES);	 
	 } else {	 
	 $title = "";	 	 
	 }
	 
	 if ($results['territorial_distinction'] <> '') {	 
	 $territorial_distinction = " | ". htmlentities($results['territorial_distinction'], ENT_QUOTES);	 
	 $territorial_distinction_normal = ", ". htmlentities($results['territorial_distinction'], ENT_QUOTES);	 
	 } else {	 
	 $territorial_distinction = "";	 	 
	 }
	 	 
	  
	 
	 $term = $family_name.$title.$territorial_distinction;		 
	 
	 $normal = $family_name.$title_normal.$territorial_distinction_normal;	
	 
	 
	  ?>
     
     <famname authfilenumber='<?php echo $results['id'] ?>' normal='<?php echo $normal ?>'><?php echo $term ?></famname>
     
     <?
	 
 }
?>

  

     


