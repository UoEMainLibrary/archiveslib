<?php

	 echo "<ul>";
	 
 	 $sql_str="SELECT * FROM cms_collections";
	 
	 $collsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 while ($results = mysql_fetch_array($collsearch)):
	 
	 $file = "/data/d4/archives/source_docs/isad/Coll-".$results['coll'].".xml";
	 
	 if (file_exists($file)) {
	 	if ($results['eua'] == 'y') {
		$replaceable = " ";
			$replacewith = "-";
			$newstr = str_replace($replaceable, $replacewith, $results['alt']);
		echo  "<li><a href='/cgi-bin/view_isad.pl?id=GB-237-".$newstr."&amp;view=basic'> ".$results['title']."</a><br /><br /></li>";
		}
		else
		{
	    echo "<li><a href='/cgi-bin/view_isad.pl?id=GB-237-Coll-".$results['coll']."&amp;view=basic'> ".$results['title']."</a><br /><br /></li>";
		}	   
		   
}
endwhile;
## temp bit

echo "<li><a href='/cgi-bin/view_isad.pl?id=GB-237-EUA-IN1&amp;view=basic'>Records of the University of Edinburgh</a><br /><br /></li>";

echo "<li><a href='/cgi-bin/view_isad.pl?id=GB-237-EUA-IN2&amp;view=basic'>Records of the Royal (Dick) Veterinary College</a><br /><br /></li>";

echo "<li><a href='/cgi-bin/view_isad.pl?id=GB-237-EUA-GD20&amp;view=basic'>Records of Edinburgh University Settlement</a><br /><br /></li>";

echo "<li><a href='/cgi-bin/view_isad.pl?id=GB-237-EUA-GD25&amp;view=basic'>Records of Edinburgh Indian Association</a><br /><br /></li>";

## end
echo "</ul>";

$euasearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");

while ($euaresults = mysql_fetch_array($euasearch)):

$ref = $euaresults['alt'];

## echo $xyz." - ";

if ($ref == "EUA-10") {

$file = "/data/d4/archives/source_docs/isad/".$ref.".xml";

echo "file:". $file;
}
endwhile;
	 
	 ?> 