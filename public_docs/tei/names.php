<?php include "../../mgt_config/sql.php";

$name_id =$_GET['id'];

$name_type = $_GET['type'];


echo "FUNCTIONALITY NOT YET PROPERLY DEVELOPED.<br/><br/>ID: ".$name_id." (".$name_type.").<br/><br/>";

if ($name_type == "person") {


 	 $sql_str="SELECT * FROM cms_auth_pers WHERE id LIKE '$name_id'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch); 
	 
	 $term = utf8_encode(htmlspecialchars($results['family_name'], ENT_QUOTES))." | ".utf8_encode(htmlspecialchars($results['given_name'], ENT_QUOTES))." | ". htmlspecialchars($results['terms_of_address'], ENT_QUOTES)." | ".utf8_encode(htmlspecialchars($results['date'], ENT_QUOTES))." | ". utf8_encode(htmlspecialchars($results['description'], ENT_QUOTES));	 
	 
	 echo $term."<br/><br/>";
	## echo "p".$name_id."<br/><br/>";
     


include "eac.php";
## echo $eac_file;


}
elseif ($name_type == "place") {

 	 $sql_str="SELECT * FROM cms_auth_geog WHERE id LIKE '$name_id'";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($termsearch); 
     
      if ($results['part_order'] <> '') {

	$parts = explode(",", $results['part_order']);
	$norm_part = $parts[0];
	if ($norm_part == 'area') {$normal = utf8_encode($results['term']); } else { $normal = utf8_encode($results[$norm_part]); }
	
	echo "<geogname authfilenumber=\"geo_".$results['id']."\" normal=\"".$normal."\">";
	foreach ( $parts as $part ) {
		if ($part == "area") { echo utf8_encode(htmlspecialchars($results['term'], ENT_QUOTES))." "; } else { echo utf8_encode(htmlspecialchars($results[$part], ENT_QUOTES))." "; }
	}
	echo "</geogname>";	

}
else {

echo utf8_encode("<geogname authfilenumber='geo_".$results['id']."' normal='".$results['term']."'>".$results['term']." ".$results['island']." ".$results['city']." ".$results['territory']." ".$results['county']." ".$results['country'] ." ".$results['continent']."</geogname>");

} 
	 
 }

?>