<?php 

$source = $_GET['source'];
$source_file = "teixml/".$source.".xml";
$page = $_GET['page']; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css">
<!--

body, div, p, object {
font-family: arial;
font-size: 10pt;
}

div.banner-cell {
height: 50px;
font-size: 20pt;
background-color: #ccccff;
color:#ffffff;
text-align: center;
padding:20px;
margin-bottom: 10px;
}
object.image {
background-color: #cccccc;
}

div.linegrp {
padding-left: 20px;
} 

div.line {
padding-bottom: 10px;
}

span.place {
font-weight: bold;
color: #003300;
}

span.person {
font-weight: bold;
color: #0000ff;
}

span.date {
text-decoration: underline;
}

#tei {
    position: absolute;
  	top: 150px;
		width: 450px;
    padding: 20px;
}

#images {
    position: absolute;
  	left: 500px;
  	top: 180px;
		width: 300px;
}

#ead {
		position: absolute;
  	left: 830px;
  	top: 180px;
		width: 400px;
    background-color: #cc9999;
    padding: 20px
}

td.ead_label {
font-weight: bold;
}

hr.page-division {
border-top: 5px dotted red;
}
hr.item-division {
border-top: 2px dotted black;
width: 50%; 
text-align: left; 
margin-left: 0;
}

// -->
</style>
<title>Carmichael Watson</title>
<head>
<body>
<div class="banner-cell"><a href="./">Carmichael Watson :: TEI</a></div>

 <?php  $xslDoc = new DOMDocument();
   $xslDoc->load("tei_full.xsl");	 
	
   $xmlDoc = new DOMDocument();
   $xmlDoc->load($source_file);
   $proc = new XSLTProcessor();
   $proc->importStylesheet($xslDoc);
	 $proc->setParameter('', 'source', $source);
	 $proc->setParameter('', 'source_file', $source_file);
	 $proc->setParameter('', 'page', $page);
   echo $proc->transformToXML($xmlDoc);
	  ?> 
		
		</body>
		</html>