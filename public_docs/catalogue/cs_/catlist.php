<?php

if ($handle = opendir('/data/d4/archives/catalogue_repository/isad/')) {

	 echo "<table border=\"1\">";
	 
	 $count=1;
	 
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != ".." && $file != "idtable.mldbm" && $file != "admin.html" && $file != "basic.html" && $file != "component.xml") {
		
		$filename1 = str_replace('GB-237-', '', $file);
		$filename2 = str_replace('Coll-', '', $filename1);
		$filename3 = str_replace('-', ' ', $filename2);
	 
 	 $sql_str="SELECT * FROM cms_collections WHERE coll='$filename3' OR alt LIKE '$filename3'";
	 
	 $collsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($collsearch);
	 
	 echo "<tr><td>".utf8_decode($results['creator'])."</td><td>".utf8_decode($results['title'])."</td><td width=\"150\"><a href='cs/viewcat.pl?id=".$file."&amp;view=basic'>".$file."</a></td><td>".utf8_decode($results['shelfmarks'])."</td></tr>";	
		$count++;
        }
    }
	echo "</table>";
	echo "<p>Total number of collections online:".$count.".</p>";
    closedir($handle);
}
	 
	 ?> 