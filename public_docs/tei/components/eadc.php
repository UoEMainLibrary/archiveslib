<?php  

$xslDoc = new DOMDocument();
   $xslDoc->load("components/eadc.xsl");
	
   $xmlDoc = new DOMDocument();
   $xmlDoc->load("Coll-97_rem.xml");

	 

   $proc = new XSLTProcessor();
   $proc->importStylesheet($xslDoc);
	 $proc->setParameter('', 'id', $id);
	 $proc->setParameter('', 'mrid', $mrid);
	 $proc->setParameter('', 'node', $node);
	 $proc->setParameter('', 'self', $self);
	 $proc->setParameter('', 'ead', $ead);
   echo $proc->transformToXML($xmlDoc);

?>

