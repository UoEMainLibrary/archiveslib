<?php
## This script is designed to be called by an xslt stylesheet and retrieve the most current version of a term 
## from the Authorities database for inclusion in xml/EAD document

##call database connection
include "../../mgt_config/sql.php";
 
  ## define variables

$searchterm = $_GET['searchterm'];



 	 $sql_str="SELECT * FROM eua_photos_e WHERE Description LIKE '%$searchterm%' ORDER BY Year, Number";
	 
	 $photosearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 echo mysql_num_rows($photosearch)."<br />";
	 echo "<table cellpadding=\"5\" width=\"100%\">";
	 echo "<tr><td width=\"20\">ID</td><td>Accession</td><td>Description</td></tr>";
	 while ($results = mysql_fetch_array($photosearch)):
	 
	 echo "<tr><td>".$results['ID']."</td><td>E.".$results['Year'].".".$results['Number']."</td><td>".$results['Description']."</td><td>".$results['Type']."</td></tr>";
	 endwhile; 
	 echo "</table>";
?>

  

     


