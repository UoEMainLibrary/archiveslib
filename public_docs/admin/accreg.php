<?

include "../../mgt_config/sql.php";

if ($_GET['view'] == "list") {

$sql_str="SELECT DISTINCT year, acc, file FROM cms_accessions_images";
	 
	 $accsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 echo "<h2>Accessions: chronological</h2>";
	 echo "<ul>";
	 
	 while ($results = mysql_fetch_array($accsearch)):
	 
	 echo "<li><a href='".$_SERVER['PHP_SELF']."?view=page&amp;file=".$results['file']."'>E.".$results['year'].".".$results['acc']."</a></li>";
	 
	 endwhile;
	 
	 echo "</ul>";

}
elseif ($_GET['view'] == "page") { 

	$file = $_GET['file'];

	$filenumber = substr(($file), -7, 3);
	 
	$nextfile  = sprintf("%03d",$filenumber + 1); 
	 
	$prevfile  = sprintf("%03d",$filenumber - 1); 
	
	echo "<div align='center'><a href='".$_SERVER['PHP_SELF']."?view=page&amp;file=01-".$prevfile.".pdf'>Previous Page</a> | <a href='".$_SERVER['PHP_SELF']."?view=list'>Full List</a> | <a href='".$_SERVER['PHP_SELF']."?view=page&amp;file=01-".$nextfile.".pdf'>Next Page</a></div>";
	
	echo "<object data='accreg_file.php?file=".$file."' type='application/pdf' width='1000' height='700' border='1'></object>";
	 
	 }
?>


     