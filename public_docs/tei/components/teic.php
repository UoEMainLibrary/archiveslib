<?php


  $xslDoc = new DOMDocument();
   $xslDoc->load("components/tei.xsl");	 
	
   $xmlDoc = new DOMDocument();
   $xmlDoc->load($teifile);
   $proc = new XSLTProcessor();
   $proc->importStylesheet($xslDoc);
	 $proc->setParameter('', 'source', $source);
	 $proc->setParameter('', 'teilevel', $teilevel);
	 $proc->setParameter('', 'teinode', $teinode);
   echo $proc->transformToXML($xmlDoc);
	 


?>