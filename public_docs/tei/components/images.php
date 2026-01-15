<?php  


## echo "This is the images script<br/>";



   $xslDoc = new DOMDocument();
   $xslDoc->load("components/images.xsl");
	
   $xmlDoc = new DOMDocument();
   $xmlDoc->load("images.xml");
	 

   $proc = new XSLTProcessor();
   $proc->importStylesheet($xslDoc);
	 $proc->setParameter('', 'mrid', $mrid);
   echo $proc->transformToXML($xmlDoc);


?>

