<?php

## This script is designed to be called by an xslt stylesheet and retrieve the most current version of a title 
## from the Collections database for inclusion in xml/EAD document

##call database connection
include "../../mgt_config/sql.php";

## set output as xml
 header("Content-Type: text/xml"); 


## define variables

$id = $_GET['id'];

if (substr($id,0,10) == 'GB-237-EUA') {

$id2 = substr($id,7);

$term = str_replace("-", " ", $id2);

$sql_str="SELECT * FROM cms_collections WHERE alt LIKE '$term'";
	 
	 $titlesearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($titlesearch);
	 
	 $coll = $results['coll'];


} else {


$coll = substr($id, 12);

}


$sql_str="SELECT * FROM cms_collections WHERE coll LIKE '$coll'";
	 
	 $titlesearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($titlesearch);
	 
	 echo "<unittitle encodinganalog=\"isadg(2)312\">".utf8_encode(htmlspecialchars($results['title'], ENT_QUOTES))."</unittitle>";
	  ?>