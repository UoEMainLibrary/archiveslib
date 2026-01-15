<?php##call database connection
include "../../mgt_config/sql.php";
 
 if ($_GET['view'] == "list") {	 

 
 if ($handle = opendir('/data/d4/archives/catalogue_repository/isad/')) {
  header("Content-Type: text/xml ");
  echo "<ead-files>\n";
	 
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != ".." && $file != "idtable.mldbm" && $file != "admin.html" && $file != "basic.html" && $file != "component.xml") {
		
		$filename1 = str_replace('GB-237-', '', $file);
		$filename2 = str_replace('Coll-', '', $filename1);
		$filename3 = str_replace('-', ' ', $filename2);
	 
 	 $sql_str="SELECT * FROM cms_collections WHERE coll='$filename3' OR alt LIKE '$filename3'";
	 
	 $collsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 $results = mysql_fetch_array($collsearch);
	 
	 echo "<ead-file>";
	 
	 echo "<unittitle>".utf8_encode(htmlspecialchars($results['title'], ENT_QUOTES))."</unittitle>";
	 
	 $file_s = str_replace("GB-237-", "", $file);
	 
	 echo "<file>http://www.archives.lib.ed.ac.uk".$_SERVER['PHP_SELF']."?view=file&amp;file=".$file_s."</file>";	
	 $filename = "/data/d4/archives/catalogue_source_docs/isad/".$file_s.".xml";
	 
	 echo "<fileLastMod>".date ("Y-m-d H:i:s", filemtime($filename))."</fileLastMod>";			
	 
	  echo "</ead-file>";
		
        }
    }
 
 echo "</ead-files>\n";
	
    closedir($handle);
}
 
 }
 
 elseif ($_GET['view'] == "file") { 
  header("Content-Type: text/xml"); 
  $contents = file_get_contents("/data/d4/archives/catalogue_source_docs/isad/".$_GET['file'].".xml");  
  
 
 echo $contents;

 }  ?>