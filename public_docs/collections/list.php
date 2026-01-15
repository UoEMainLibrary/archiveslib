<?php

$dbname = 'gbuttars';

   $hostname = 'morse.ucs.ed.ac.uk';

   $username = 'gbuttars';

   $password = 'actijij4';
				
	 $dbname= 'gbuttars'; 
	 
	 
   $id_link = mysql_connect($hostname, $username, $password); 
	 
	 echo "<ul>";
	 
 	 $sql_str="SELECT * FROM collections WHERE sub_level=0";
	 
	 $collsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 while ($results = mysql_fetch_array($collsearch)):
	 
	 $file = "/data/d4/archives/source_docs/isad/Coll-".$results['coll'].".xml";
	 
	 if (file_exists($file)) {
	 
	 
	 ## insert code to read titleproper tag from xml file
	 

$xml_parser = xml_parser_create();

if (!($fp = fopen($file, "r"))) {
   die("could not open XML input");
}

$data = fread($fp, filesize($file));
fclose($fp);
xml_parse_into_struct($xml_parser, $data, $vals, $index);
xml_parser_free($xml_parser);

$params = array();
$level = array();
foreach ($vals as $xml_elem) {
  if ($xml_elem['type'] == 'open') {
   if (array_key_exists('attributes',$xml_elem)) {
     list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);
   } else {
     $level[$xml_elem['level']] = $xml_elem['tag'];
   }
  }
  if ($xml_elem['type'] == 'complete') {

   $start_level = 1;
   $php_stmt = '$params';
   while($start_level < $xml_elem['level']) {
     $php_stmt .= '[$level['.$start_level.']]';
     $start_level++;
   }
   $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
   eval($php_stmt);
  }
}
if ($xml_elem == "titleproper"):
echo "<pre>";
print_r ($params);
echo "</pre>";
endif;

	 
	 ## end xml
	 
	 
	 
	 
           echo "<li><a href='/cgi-bin/view_isad.pl?id=GB-237-Coll-".$results['coll']."&amp;view=basic'> ".$results['title']."</a><br /><br /></li>";
}
endwhile;

echo "</ul>";
	 
	 ?> 