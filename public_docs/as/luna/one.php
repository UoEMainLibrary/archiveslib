<?php 


   $xslDoc = new DOMDocument();
   $xslDoc->load("luna1.xsl");

   $xmlDoc = new DOMDocument();
   $xmlDoc->load("https://images.is.ed.ac.uk/luna/servlet/oai?verb=GetRecord&metadataPrefix=oai_dc&identifier=oai:N/A:UoEgal~5~5~58054~105342");

   $proc = new XSLTProcessor();
   $proc->importStylesheet($xslDoc);
   echo $proc->transformToXML($xmlDoc);

?> 