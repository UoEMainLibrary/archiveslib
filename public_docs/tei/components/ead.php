<?php  $job = $_GET['job'];

if ($job == "load") {


$ead = file_get_contents('http://lac-archives-live.is.ed.ac.uk:8082/?verb=GetRecord&metadataPrefix=oai_ead&identifier=oai:archivesspace//repositories/2/resources/86763');


$fp = fopen('Coll-97_rem.xml', 'w');
fwrite($fp, $ead);

}

$xslDoc = new DOMDocument();
   $xslDoc->load("components/ead.xsl");
	
   $xmlDoc = new DOMDocument();
   $xmlDoc->load("Coll-97_rem.xml");

	 

   $proc = new XSLTProcessor();
   $proc->importStylesheet($xslDoc);
	 $proc->setParameter('', 'node', $node);
   echo $proc->transformToXML($xmlDoc);

?>

