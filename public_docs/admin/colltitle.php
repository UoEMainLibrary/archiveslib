<?php

## This script is designed to be called by an xslt stylesheet and retrieve the most current version of a title 
## from the Collections database for inclusion in xml/EAD document

##call database connection
include "../../mgt_config/sql.php";




## define variables

$id = $_GET['id'];


$sql_str="SELECT * FROM cms_collections WHERE coll = $id";
	 
	 $titlesearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($titlesearch);
	 
	 echo utf8_encode(htmlspecialchars($results['title'], ENT_QUOTES));
	  ?>