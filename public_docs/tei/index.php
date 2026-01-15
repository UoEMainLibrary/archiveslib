<?php  
$view = $_GET['view'];

$source = $_GET['source']; 

$source_file = "teixml/".$source;

## check which TEI files are present ##

## traverse EAD and match

 

#######################################

if ($view == "toc") {

$node = str_replace(".xml", "", $source);
 }
else
{
$node = $_GET['node'];
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css">
<!--

body, div, p {
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

// -->
</style>
<title>Carmichael Watson</title>
<head>
<body>
<div class="banner-cell"><a href="./">Carmichael Watson :: TEI</a></div>

<?php include "tei_list.php"; ?>
<div id="ead">
<?php include "ead.php"; ?>
</div>

<div id="tei">

<?php


if (isset($view)) {

   $xslDoc = new DOMDocument();
   $xslDoc->load("tei.xsl");	 
	
   $xmlDoc = new DOMDocument();
   $xmlDoc->load($source_file);
   $proc = new XSLTProcessor();
   $proc->importStylesheet($xslDoc);
	 $proc->setParameter('', 'view', $view);
	 $proc->setParameter('', 'source', $source);
	 $proc->setParameter('', 'node', $node);
   echo $proc->transformToXML($xmlDoc);
	 
	}
	else {
	echo "<p>Select Notebook from menu above</p>"; 
	echo "<img src='0009067c.jpg' alt='page from notebook' width='600'>";

}

?>
</div>
<div id="images">
<?php include "images.php"; ?>
</div>
</body>
</html>
