<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "luna";


if (!isset($_GET['span'])) { $span=10; } else { $span = $_GET['span']; }

if (!isset($_GET['start'])) { $start=0; } else { $start = $_GET['start']; }

				$id_link = mysqli_connect($servername, $username, $password, $dbname);  


$query1 = mysqli_query($id_link, "SELECT * FROM luna_core LIMIT $start,$span"); 

echo "<table border='1' width= '100%'>";

echo "<tr><td width='200'>Shelfmark</td><td width='200'>Catalogue Number</td><td>Title [Repro Title] <i>Description</i></td><td>OAI Link</td></tr>";

while ($results = mysqli_fetch_array($query1)):

$base_url = "https://images.is.ed.ac.uk/luna/servlet/oai?verb=GetRecord&metadataPrefix=oai_dc&identifier=oai:N/A:";

$luna_oai = str_replace("https://images.is.ed.ac.uk//luna/servlet/detail/", "https://images.is.ed.ac.uk/luna/servlet/oai?verb=GetRecord&metadataPrefix=oai_dc&identifier=oai:N/A:", $results['url']);

$uv_iiif = "image.php?view=iiif&manifest=".str_replace("https://images.is.ed.ac.uk//luna/servlet/detail/", "https://images.is.ed.ac.uk/luna/servlet/iiif/m/", $results['url'])."/manifest";


echo "<tr><td>".$results['shelfmark']."</td><td>".$results['cat_no']."</td>";



   $xslDoc = new DOMDocument();
   $xslDoc->load("luna1.xsl");

   $xmlDoc = new DOMDocument();
   $xmlDoc->load($luna_oai);

   $proc = new XSLTProcessor();
   $proc->importStylesheet($xslDoc);
	 
	 if ($proc->transformToXML($xmlDoc) <> ''){
   echo "<td>".$proc->transformToXML($xmlDoc)."</td><td width='100'><a target='_blank' href='".$luna_oai."'>OAI</a> | <a target='_blank' href='".$uv_iiif."'>IIIF</a></td>";
	 } else {
	 echo "<td colspan='2'>Not online</td>";
	 }
	
		 

echo "</tr>";
endwhile;

echo "</table>";


?>  