<?php  
$source = $_GET['source'];
$page = $_GET['page'];


   $xslDoc = new DOMDocument();
   $xslDoc->load("images_full.xsl");
	
   $xmlDoc = new DOMDocument();
   $xmlDoc->load("images.xml");
	 

   $proc = new XSLTProcessor();
   $proc->importStylesheet($xslDoc);
	 $proc->setParameter('', 'source', $source);
	 $proc->setParameter('', 'page', $page);
   echo $proc->transformToXML($xmlDoc);


?>

