<?php include "../../mgt_config/sql.php";

 $id_link = mysql_connect($hostname, $username, $password);
 
 $view = $_GET['view'];
 $section = $_GET['section'];
 $item = $_GET['item'];
 $searchterm = $_GET['searchterm'];

  ## check the database can be accessed
	
	if (!$id_link || !mysql_select_db($dbname)):
	$pagetitle= "Error";
	include "includes/lower.php";
	echo 'Connection to database has failed.';
	include "includes/foot.php";
  exit();
	endif; ?>

<?php include "../includes/header.php"; ?>
<title>Archives of the Patrick Geddes Centre for Planning Studies</title>

<?php include "../includes/lowerheader.php"; ?>

<div><a href="/">Special Collections : Archival Resources</a></div>

<h1>Coll-1167: Archives of the Patrick Geddes Centre for Planning Studies</h1>
<p>The <i>Photographs from the Survey of Edinburgh</i> are part of a larger collection formerly held within the Outlook Tower on Castlehill.  The collection as whole was catalogued while still at the Outlook Tower, this catalogue published as a 2-volume set <i>Catalogue of the archives of the Patrick Geddes Centre for Planning Studies</i>, the second volume focussed solely on the Edinburgh Survey photographs.  It is this volume which has now been revisited, its contents keyed, with minor alterations, into a database, accessible below.</p>

<p>It is hoped to address the rest of the collection in due course. Meanwwhile a full digital copy of the <a href="coll-1167.pdf" target="_blank">first volume</a> is available in pdf format (9MB file)</p>

</table>
<div>


<div style="margin-left:20px">
<h2>
<?php if ($view != ''){ 
echo "<a href='1167.php'>/1: Photographs from the Survey of Edinburgh</a>";
 }
 else echo "/1: Photographs from the Survey of Edinburgh"; ?>
</h2>
<div style="margin-left:20px">
<form action="<?php echo $SERVER['PHP_SELF'] ?>" method="get">
<input name="view" type="hidden" value="results" />
<input name="searchterm" type="text" />
<input name="" type="submit" value="Search" />
</form>
<br />
<?php
if (!isset($view)){ 

$sql_str="SELECT DISTINCT section FROM geddes_photos";
		$search = mysql_db_query($dbname, $sql_str, $id_link);
		echo "<table border='0' cellpadding='5' width='100%'>";
		while ($results = mysql_fetch_array($search)) {
		
		$section = $results['section'];
		
		$sql_str2="SELECT title FROM geddes_sections WHERE section LIKE '$section'";
		$search2 = mysql_db_query($dbname, $sql_str2, $id_link);
		$results2 = mysql_fetch_array($search2);
		
		echo "<tr><td>/".$results['section']."</td><td><a href='".$SERVER['PHP_SELF']."?view=section&amp;section=".$results['section']."'>".$results2['title']."</a></td></tr>";
		
		}
		
		echo "</table>";
}
elseif ($view == 'section') {

$sql_str="SELECT * FROM geddes_photos WHERE section LIKE '$section' ORDER BY number ASC, suffix ASC";
		$search = mysql_db_query($dbname, $sql_str, $id_link);
		
		$sql_str2="SELECT title FROM geddes_sections WHERE section LIKE '$section'";
		$search2 = mysql_db_query($dbname, $sql_str2, $id_link);
		$results2 = mysql_fetch_array($search2);
		
echo "<h3><a href='".$SERVER['PHP_SELF']."?view=section&amp;section=".$section."'>/".$section.": ".$results2['title']."</a></h3><br />";
		
		echo "<table border='0' cellpadding='5' width='100%'>";
		while ($results = mysql_fetch_array($search)) {
		
		echo "<tr><td width='40'>&nbsp;&nbsp;&nbsp;&nbsp;/".$results['number'];
		
		if ($results['suffix'] <> '') {
		echo $results['suffix'];
		}
		
		echo "</td><td><a href='".$SERVER['PHP_SELF']."?view=item&amp;section=".$section."&amp;item=".$results['id']."'>".$results['unittitle']."</a></td></tr>";
		
		}
		
		echo "</table>";

}

elseif ($view == 'item') {

$sql_str="SELECT * FROM geddes_photos WHERE id LIKE '$item'";
		$search = mysql_db_query($dbname, $sql_str, $id_link);
		$results = mysql_fetch_array($search);
		
		$sql_str2="SELECT * FROM geddes_sections WHERE section LIKE '$section'";
		$search2 = mysql_db_query($dbname, $sql_str2, $id_link);
		$results2 = mysql_fetch_array($search2);
		
echo "<h3><a href='".$SERVER['PHP_SELF']."?view=section&amp;section=".$results['section']."'>/".$results['section'].": ".$results2['title']."</a></h3><br />";

echo "<div style='margin-left:50px'>";

echo "<div style='font-weight:bold'>/".$results['number'];
		
		if ($results['suffix'] <> '') {
		echo $results['suffix'];
		}
		echo "<br /><br /></div>";
		echo "<table border='0' cellpadding='5' width='100%'>";
		
		echo "<tr><td style='font-weight:bold;' width='200'>Full reference code</td><td>Coll-1167/1/".$results['section']."/".$results['number'];
		
		if ($results['suffix'] <> '') {
		echo $results['suffix'];
		}
		
		echo "</td></tr>";
		
		echo "<tr><td style='font-weight:bold;'' valign='top'>Title</td><td>".$results['unittitle']."</td></tr>";
		
		echo "<tr><td style='font-weight:bold;''>Original title</td><td>".$results['originaltitle']."</td></tr>";
		
		echo "<tr><td style='font-weight:bold;''>Date</td><td>".$results['unitdate']."</td></tr>";
		
		echo "<tr><td style='font-weight:bold;''>Creator</td><td>".$results['origination']."</td></tr>";
		
		echo "<tr><td style='font-weight:bold;'' valign='top'>Scope and content</td><td>".$results['scopecontent']."</td></tr>";
		
		echo "<tr><td style='font-weight:bold;''>Author of original title</td><td>".$results['title_author']."</td></tr>";
		
		echo "<tr><td style='font-weight:bold;''>Negative number</td><td>".$results['negative_number']."</td></tr>";
		
		echo "<tr><td style='font-weight:bold;'' valign='top'>Note</td><td>".$results['note']."</td></tr>";
		
		echo "<tr><td style='font-weight:bold;'' valign='top'>Related items</td><td>";
		
		
		
		
		
	#########
	
	if (preg_match ("/\bColl-1167\b/i", $results['scopecontent'])) {
	
	$pieces = explode(" ", $results['scopecontent']);
	
	foreach ($pieces as $piece) {
	
	if (preg_match ("/\bColl-1167\b/i", $piece)) {	
	
	$trimmed = trim($piece, " ,() .");
	$replaceable = "/";
			$replacewith = "-";
			$idstr = str_replace($replaceable, $replacewith, $trimmed);
	
	$replaceable = "Coll-1167/1/";
			$replacewith = "";
			$short = str_replace($replaceable, $replacewith, $trimmed);
			
			$short_pieces = explode("/", $short);
			
			echo "<a href='".$SERVER['PHP_SELF']."?view=item&amp;section=".$short_pieces[0]."&amp;item=".$short_pieces[1]."'>".$trimmed."</a> ";
	
	
##	echo $trimmed." ".$idstr." ";
	
	
	}
	
	}
	 
} 

if (preg_match ("/\bColl-1167\b/i", $results['note'])) {
	
	$pieces = explode(" ", $results['note']);
	
	foreach ($pieces as $piece) {
	
	if (preg_match ("/\bColl-1167\b/i", $piece)) {	
	
	$trimmed = trim($piece, " ,() .");
	$replaceable = "/";
			$replacewith = "-";
			$idstr = str_replace($replaceable, $replacewith, $trimmed);
	
	$replaceable = "Coll-1167/1/";
			$replacewith = "";
			$short = str_replace($replaceable, $replacewith, $trimmed);
			
			$short_pieces = explode("/", $short);
			
			echo "<a href='".$SERVER['PHP_SELF']."?view=item&amp;section=".$short_pieces[0]."&amp;item=".$short_pieces[1]."'>".$trimmed."</a> ";
	
	
##	echo $trimmed." ".$idstr." ";
	
	
	}
	
	}
	 
} 
	#########
	
		echo "</td></tr>";
		echo "</table>";
		echo "</div>";

}

elseif ($view == 'results') {
echo "<h3>Results</h3>";

echo "<p>You searched for: <span class='boldred'>".$searchterm."</span></p>";

$sql_str="SELECT * FROM geddes_photos WHERE scopecontent LIKE '%$searchterm%' ORDER BY section ASC, number ASC, suffix ASC";
		$search = mysql_db_query($dbname, $sql_str, $id_link);
		echo "<table border='0' cellpadding='5'>";
		while ($results = mysql_fetch_array($search)) {
		
		echo "<tr><td>/".$results['section']."/".$results['number'];
		
		if ($results['suffix'] <> '') {
		echo $results['suffix'];
		}
		
		echo "</td><td><a href='".$SERVER['PHP_SELF']."?view=item&amp;item=".$results['id']."'>".$results['unittitle']."</a></td></tr>";
		
		}
		
		echo "</table>";
}
?>
</div>
</div>
</div>

<?php include "../includes/footer.php"; ?>
