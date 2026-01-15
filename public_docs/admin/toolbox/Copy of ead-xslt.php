<?php
 echo "Begin script";
// Allocate a new XSLT processor
$xh = xslt_create();
 echo $xh;
// Process the document
if (xslt_process($xh, 'sample.xml', 'sample.xsl', 'result.xml')) {
   echo "SUCCESS, sample.xml was transformed by sample.xsl into result.xml";
   echo ", result.xml has the following contents\n<br />\n";
   echo "<pre>\n";
   readfile('result.xml');
   echo "</pre>\n";
} else {
   echo "Sorry, sample.xml could not be transformed by sample.xsl into";
   echo "  result.xml the reason is that " . xslt_error($xh) . " and the ";
   echo "error code is " . xslt_errno($xh);
}

xslt_free($xh);

?> 