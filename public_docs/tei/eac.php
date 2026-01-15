<?php $eac_file = "eacxml/p".$name_id.".xml";

if (file_exists($eac_file)) {
    echo "<div>EAC file exists</div>";


   $xslDoc = new DOMDocument();
   $xslDoc->load("eac.xsl");
	
   $xmlDoc = new DOMDocument();
   $xmlDoc->load($eac_file);

	 

   $proc = new XSLTProcessor();
   $proc->importStylesheet($xslDoc);
	 $proc->setParameter('', 'node', $node);
   echo $proc->transformToXML($xmlDoc);
	 
	 } else {
	 
	 echo "<div>No EAC file</div>";
	 }
	 
	 ?>