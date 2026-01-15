<?php

## This script is designed to be called by an xslt stylesheet and retrieve the most current version of a term 
## from the Authorities database for inclusion in xml/EAD document

##call database connection
include "../../mgt_config/sql.php";

$geogdir = "/home/archives/catalogue_source_docs/authorities/xml/pers";

 ?>
 
 
<p>Biogs</p>
 
 <?php
 

 	 $sql_str="SELECT * FROM isaar";
	 
	 $perssearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 	 
	 	

 	
 
?>