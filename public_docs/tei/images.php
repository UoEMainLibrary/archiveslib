<?php  
$node = $_GET['node'];

if (!isset($node)) {
$node = str_replace(".xml", "", $source);
}



   $xslDoc = new DOMDocument();
   $xslDoc->load("images.xsl");
	
   $xmlDoc = new DOMDocument();
   $xmlDoc->load("images.xml");
	 

   $proc = new XSLTProcessor();
   $proc->importStylesheet($xslDoc);
	 $proc->setParameter('', 'node', $node);
   echo $proc->transformToXML($xmlDoc);


?>

