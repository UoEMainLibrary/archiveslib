<?php

## This script is designed to be called by an xslt stylesheet and retrieve the most current version of a term 
## from the Authorities database for inclusion in xml/EAD document

##call database connection
include "../../mgt_config/sql.php";

$geogdir = "/home/archives/catalogue_source_docs/authorities/html/geog";

 ?>
 
 
<p>Geogs</p>
 
 <?php function EmptyDir($dir) {
$handle=opendir($dir);

while (($file = readdir($handle))!==false) {
echo "$file deleted<br>";
@unlink($dir.'/'.$file);
}

closedir($handle);
}

EmptyDir($geogdir);
 

 	 $sql_str="SELECT * FROM cms_auth_geog";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 
	 
	 while ($results = mysql_fetch_array($termsearch)): 
	 
	 if ($results['locator'] <> '') {
	 
	 if ($results['country'] == 'Scotland') {
	 
	 $filename = $geogdir."/".$results['id'].".shtml";
	 
	 echo $results['id']." created | ";
	 
	 $locators  = $results['locator'];
	 $locator = explode(";", $locators);
		echo $locator[0]." | "; // piece1
		echo $locator[1]."<br/>"; // piece2
		echo "<br/><br/>";
	 
	 $FileHandle = fopen($filename, 'w') or die("can't open file");
	 
	 $FileContent = "<iframe width='550' height='350' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='http://nls.tileserver.com/?lat=".$locator[0]."&lng=".$locator[1]."&zoom=12'></iframe><br/>Currently showing maps for Scottish locations which have been geo-referenced only.";
	 
	## $FileContent = "Geo term ".$results['id']." has locators ".$results['locator'].". Embedded map will show here in due course."; 
	 
	 
	 fwrite($FileHandle, $FileContent); 

	 fclose($FileHandle);
	 
	 }   
	 } 
     endwhile;	

 	
 
?>

  

     


