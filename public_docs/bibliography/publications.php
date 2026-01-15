<?php  include "../includes/header.php"; ?>
<title>University Archives: Publications</title>
<style>
span.fieldLabelSpan {
font-weight: bold;
margin-right: 10px;
}
</style>
<?php  include "../includes/lowerheader.php"; ?>
<div><a href="/">Special Collections : Archives Catalogues &amp; Resources</a></div>
<?php  include "../../mgt_config/sql.php"; 

$view = $_GET['view'];
$title = $_GET['title'];

echo "<h1>University Archives: Publications</h1>";

echo "<p>NOTE: This is an expermental page which might not be retained in its current form</p>";
if (!isset($view)) {

$sql_str="SELECT DISTINCT author, title FROM eua_pubs ORDER BY title ASC";

$titlesearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");

echo "<ul>";

while ($results = mysql_fetch_array($titlesearch)):

echo "<li><a href='".$_SERVER['PHP_SELF']."?view=title&amp;title=".$results['title']."'>".$results['title']."</a></li>";

endwhile;

echo "<ul>";

}

elseif ($view == 'title') {

echo "<a href='".$_SERVER['PHP_SELF']."'>View list</a>";

$sql_str="SELECT * FROM eua_pubs where title LIKE '$title' ORDER BY date ASC";

$bibsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
$bibresults = mysql_fetch_array($bibsearch);
include "bib.php";

	$pubsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
	
	echo "<table width='100%'>";
	
	echo "<tr><td><h2>Online at archive.org</h2></td></tr>";
	echo "<tr><td>[links will open in a new window/tab]</td></tr>";
	
		
		while ($results = mysql_fetch_array($pubsearch)):
		
		echo "<tr><td width='100'><a target='_blank' href='".$results['url']."'>";
		
		if ($results['volume'] >0) {
		
		echo "Volume: ".$results['volume'].", ";
		
		}
		
		echo $results['date']."</a></td></tr>";
		
		endwhile;
		
		echo "</table>";

	
	}

  include "../includes/footer.php"; ?>