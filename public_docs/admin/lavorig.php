<?php
## This script is designed to be called by an xslt stylesheet and retrieve the most current version of a term 
## from the Authorities database for inclusion in xml/EAD document

##call database connection
include "../../mgt_config/sql.php";

## set output as xml
## header("Content-Type: text/xml; charset=utf-8");
## header("Content-Type: text/xml; charset=iso-8859-1");
 header("Content-Type: text/xml");
 
  ## define variables

$con = $_GET['con'];



$indivs = explode(";", $con);

echo "<origination>";

foreach ($indivs as $indiv) {



$name_parts = explode(" | ", $indiv);


$surname = end(split(' ',$name_parts[0]));

$rest_of_name = str_replace($surname, "", $name_parts[0]);

echo "<persname>";

echo $surname." | ".$rest_of_name." | ";

echo $name_parts[1];
 
echo "</persname>";

}

echo "</origination>";

?>

  

     


