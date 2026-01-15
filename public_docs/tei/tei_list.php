<?php  




   $xslDoc = new DOMDocument();
   $xslDoc->load("tei_list.xsl");
	
   $xmlDoc = new DOMDocument();
   $xmlDoc->load("Coll-97.xml");
	    ## $xmlDoc->load("http://lac-archives-live.is.ed.ac.uk:8082/?verb=GetRecord&metadataPrefix=oai_ead&identifier=oai:archivesspace//repositories/2/resources/86763");
	 

   $proc = new XSLTProcessor();
   $proc->importStylesheet($xslDoc);
   echo $proc->transformToXML($xmlDoc);


?>

