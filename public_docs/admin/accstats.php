<?php

## This script is designed to be called by an xslt stylesheet and retrieve the most current version of a title 
## from the Collections database for inclusion in xml/EAD document

##call database connection
include "../../mgt_config/sql.php";


## define variables


$sql_str="SELECT * FROM cms_accessions WHERE acc_type LIKE 'EUA' AND year>2006 ORDER by year, accession";
	 
	 $euasearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 echo "<table border='1'>";
	 
	 while ($results = mysql_fetch_array($euasearch)):
	 

	 
	 echo "<tr><td>".$results['year']."/".$results['accession']."</td><td>".$results['description']."</td><td>".utf8_encode(htmlspecialchars($results['extent'], ENT_QUOTES))."</td></tr>";
	 
	 endwhile;
	 echo "</table>";
	  ?>