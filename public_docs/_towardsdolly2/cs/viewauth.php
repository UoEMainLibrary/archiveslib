<?php	$type = $_GET['type'];
	$id = $_GET['id'];
	$term = $_GET['term'];
	
	$filename = "/home/archives/catalogue_source_docs/authorities/html/".$type."/".$id.".shtml";


	##	echo "<h1>".$term."</h1>";
	
	if (file_exists($filename)) {
	echo "<table width=\"500\"><tr><td>";
include $filename;
echo "</td></tr></table>";
echo "</td><td valign=\"top\">";
} else {

  ##  echo "<p>A descriptive entry has not (yet) been created for this term.</p>";

}
?>