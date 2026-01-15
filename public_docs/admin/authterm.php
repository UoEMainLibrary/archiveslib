<?php
## This script is designed to be called by an xslt stylesheet and retrieve the most current version of a term 
## from the Authorities database for inclusion in xml/EAD document

##call database connection
include "../../mgt_config/sql.php";
 
  ## define variables
$table = $_GET['table'];
$authfilenumber = $_GET['authfilenumber'];

## set output as xml
## header("Content-Type: text/xml; charset=iso-8859-1");
##header("Content-Type: text/xml; charset: utf-8");
header("Content-Type: text/xml");
##subjects
if ($table == "cms_auth_subj") {

 	 $sql_str="SELECT * FROM cms_auth_subj WHERE id LIKE '$authfilenumber'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch); 
	      
echo "<subject authfilenumber=\"".$results['id'] ."\" source=\"".$results['source']."\">".utf8_encode(htmlspecialchars($results['term']))."</subject>";
         
 }
 
 ##genres
if ($table == "cms_auth_genr") {

 	 $sql_str="SELECT * FROM cms_auth_genr WHERE id LIKE '$authfilenumber'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch); ?>
     
     <genre authfilenumber='<?php echo $results['id'] ?>' source='<?php echo $results['source'] ?>'><?php echo utf8_encode(htmlspecialchars($results['term'])) ?></genre>
     
     <?php
	 
 }
 
 ## places
 elseif ($table == "cms_auth_geog") {

 	 $sql_str="SELECT * FROM cms_auth_geog WHERE id LIKE '$authfilenumber'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch); ?>
     
     <?php if ($results['part_order'] <> '') {

	$parts = explode(",", $results['part_order']);
	$norm_part = $parts[0];
	if ($norm_part == 'area') {$normal = utf8_encode($results['term']); } else { $normal = utf8_encode($results[$norm_part]); }
	
	echo "<geogname authfilenumber=\"".$results['id']."\" normal=\"".$normal."\">";
	foreach ( $parts as $part ) {
		if ($part == "area") { echo utf8_encode(htmlspecialchars($results['term'], ENT_QUOTES))." "; } else { echo utf8_encode(htmlspecialchars($results[$part], ENT_QUOTES))." "; }
	}
	echo "</geogname>";	

}
else {

echo utf8_encode("<geogname authfilenumber='".$results['id']."' normal='".$results['term']."'>".$results['term']." ".$results['island']." ".$results['city']." ".$results['territory']." ".$results['county']." ".$results['country'] ." ".$results['continent']."</geogname>");

} 
	 
 }
 
 ##personal names
if ($table == "cms_auth_pers") {

 	 $sql_str="SELECT * FROM cms_auth_pers WHERE id LIKE '$authfilenumber'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch);
	 
	 if ($results['family_name'] <> '') {	 
	 $family_name = htmlspecialchars($results['family_name'], ENT_QUOTES);	 
	## $family_name = $results['family_name'];
	 } else {	 
	 $family_name = "";	 
	 }
	 
	 if ($results['given_name'] <> '') {	 
	 $given_name = htmlspecialchars($results['given_name'], ENT_QUOTES);	 
	 } else {	 
	 $given_name = "";	 	 
	 }
	 
	 if ($results['terms_of_address'] <> '') {	 
	 $terms_of_address = " | ". htmlspecialchars($results['terms_of_address'], ENT_QUOTES);	 
	 } else {	 
	 $terms_of_address = "";	 	 
	 }
	 
	 if ($results['date'] <> '') {	 
	 $date = " | ".$results['date'];	 
	 } else {	 
	 $date = "";	 	 
	 }
	 
	 if ($results['description'] <> '') {	 
	 $description = " | ". htmlspecialchars($results['description'], ENT_QUOTES);	 
	 } else {	 
	 $description = "";	 	 
	 }
	 
	 if ($results['family_name'] <> '') {	 
	 $name = $family_name." | ".$given_name;	 
	 } else {	 
	 $name = $given_name;	 
	 }
	 
	 if ($results['family_name'] <> '') {	 
	 $normal = utf8_encode($family_name.", ".$given_name);	 
	 } else {	 
	 $normal = utf8_encode($given_name);	 
	 }
	 
	 $term = utf8_encode($name.$terms_of_address.$date.$description);
	 
	  ?>
     
     <persname authfilenumber='<?php echo $results['id'] ?>' normal='<?php echo $normal ?>'><?php echo $term ?></persname>
     
     <?php
	 
 }
 
 ##corporate names
if ($table == "cms_auth_corp") {

 	 $sql_str="SELECT * FROM cms_auth_corp WHERE id LIKE '$authfilenumber'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch);
	 
	 if ($results['primary_name'] <> '') {	 
	 $primary_name = htmlspecialchars($results['primary_name'], ENT_QUOTES);	 
	 } else {	 
	 $primary_name = "";	 
	 }
	 
	 if ($results['secondary_name'] <> '') {	 
	 $secondary_name = htmlspecialchars($results['secondary_name'], ENT_QUOTES);	 
	 } else {	 
	 $secondary_name = "";	 	 
	 }
	 
	 if ($results['date'] <> '') {	 
	 $date = " | ".$results['date'];	 
	 } else {	 
	 $date = "";	 	 
	 }
	 
	 if ($results['description'] <> '') {	 
	 $description = " | ".htmlspecialchars($results['description'], ENT_QUOTES);	 
	 } else {	 
	 $description = "";	 	 
	 }
	 
	 if ($results['location'] <> '') {	 
	 $location = " | ".htmlspecialchars($results['location'], ENT_QUOTES);	 
	 } else {	 
	 $location = "";	 	 
	 }
	 
	 if ($results['primary_name'] <> '') {	
	 $name = $primary_name." | ".$secondary_name;	 
	 } else {	 
	 $name = $secondary_name;	 
	 }
	 
	 if ($results['primary_name'] <> '') {	 
	 $normal = $primary_name." ".$secondary_name;	 
	 } else {	 
	 $normal = utf8_encode($secondary_name);	 
	 }
	 
	 $term = utf8_encode($name.$date.$description.$location);
	 
	  ?>
     
     <corpname authfilenumber="<?php echo $results['id'] ?>" normal="<?php echo $normal ?>"><?php echo $term ?></corpname>
     
     <?php
	 
 }
 
 ##family names
if ($table == "cms_auth_fam") {

 	 $sql_str="SELECT * FROM cms_auth_fam WHERE id LIKE '$authfilenumber'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch);
	 
	 if ($results['family_name'] <> '') {	 
	 $family_name = htmlspecialchars($results['family_name'], ENT_QUOTES);	 
	 } else {	 
	 $family_name = "";	 
	 }
	 
	 if ($results['title'] <> '') {	 
	 $title = " | ". htmlspecialchars($results['title'], ENT_QUOTES);	 
	 $title_normal = ", ". htmlspecialchars($results['title'], ENT_QUOTES);	 
	 } else {	 
	 $title = "";	 	 
	 }
	 
	 if ($results['territorial_distinction'] <> '') {	 
	 $territorial_distinction = " | ". htmlspecialchars($results['territorial_distinction'], ENT_QUOTES);	 
	 $territorial_distinction_normal = ", ". htmlspecialchars($results['territorial_distinction'], ENT_QUOTES);	 
	 } else {	 
	 $territorial_distinction = "";	 	 
	 }
	 	 
	  
	 
	 $term = utf8_encode($family_name.$title.$territorial_distinction);		 
	 
	 $normal = utf8_encode($family_name.$title_normal.$territorial_distinction_normal);	
	 
	 
	  ?>
     
     <famname authfilenumber='<?php echo $results['id'] ?>' normal='<?php echo $normal ?>'><?php echo $term ?></famname>
     
     <?php
	 
 }

?>

  

     


