<?php

echo "<p><b>This is a temporary feature</b></p>";
	 
if ($handle = opendir('/data/d4/archives/catalogue_repository/isad/')) {

	 echo "<ul class=\"colllist\">";
	 
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != ".." && $file != "idtable.mldbm") {
		
		$filename1 = str_replace('GB-237-', '', $file);
		$filename2 = str_replace('Coll-', '', $filename1);
		$filename3 = str_replace('-', ' ', $filename2);
	 
 	 $sql_str="SELECT * FROM cms_collections WHERE coll='$filename3' OR alt LIKE '$filename3'";
	 
	 $collsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($collsearch);
	 
	 echo "<li><a href='cs/viewcat.pl?id=".$file."&amp;view=basic'> ".$results['title']."</a><br /><br /></li>";	
		
        }
    }
	echo "</ul>";
    closedir($handle);
}
	 
	 ?> 