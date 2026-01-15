<?php include "../../mgt_config/sql.php"; ?>

<?php include "../includes/header.php"; ?>
<title>The Lucey Collection: Search</title>
<?php include "../includes/lowerheader.php";
$view = $_GET['view'];
$searchterm = $_GET['searchterm'];
 ?>
<div><a href="/">Special Collections : Archives Catalogues &amp; Resources</a></div>
<h1>The Lucey Collection: Search</h1>
<?php include "includes/top.php"; ?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
<input name="view" type="hidden" value="results" />
<table>
<tr><td>Search for:</td><td><input name="searchterm" type="text" value="<?php echo $searchterm ?>" /></td><td><input name="" type="submit" value="Search" /></td></tr>
</table>

</form>


<?php	if ($view == "results") {

include "note.php";

echo "<p><strong>Search results for:</strong> <em> ".$searchterm."</em></p>";

$sql_str="SELECT * FROM Lucey WHERE title LIKE'%$searchterm%' OR comments LIKE'%$searchterm%' OR 'Named Individuals' LIKE'%$searchterm%'";
		$search = mysql_db_query($dbname, $sql_str, $id_link);
		
		while ($results = mysql_fetch_array($search)) {	
		
		echo "<table width='100%' border='1' cellpadding='4' style='border-color:#000000'>";	
			echo "<tr><td rowspan='5' valign='top' width='5%'>".$results['number']."</td><td colspan='5'><h2>".htmlentities($results['title'], ENT_QUOTES, "UTF-16")."</h2></td></tr>";
			
			echo"<tr><td width='20%'><strong>Format: </strong>".$results['format']."</td><td width='20%'><strong>Media: </strong>".$results['media']."</td><td width='20%'><strong>Sound: </strong>".$results['sound']."</td><td width='20%'><strong>Footage estimate: </strong>".$results['footage_estimate']."</td></tr>";
			echo "<tr><td colspan='4'><strong>Comments: </strong>".$results['comments']."<br /><br /></td></tr>";
			echo "<tr><td colspan='4'><strong>Named Individuals: </strong>".$results['Named_Individuals']."<br /><br /></td></tr>";
			echo "<tr><td colspan='2'>";
			
			if ($results['code'] != NULL) {
			##########################################
			
			echo "Viewed";
						
			##########################################
			}
			echo "</td><td colspan='2' align='right'><a href='".$_SERVER['PHP_SELF']."?view=item&amp;searchterm=".$searchterm."&amp;number=".$results['number']."'>View full record</a></td></tr>";
			echo "</table><br /><br />";	
			
		}
		
		}
		elseif ($view == "item") {
		
		$number = $_GET['number'];
		
		$sql_str="SELECT * FROM Lucey WHERE number=$number";
		$search = mysql_db_query($dbname, $sql_str, $id_link);
		
		$results = mysql_fetch_array($search);	
		
		echo "<table width='100%' border='1' cellpadding='4' style='border-color:#000000'>";	
			echo "<tr><td rowspan='4' valign='top' width='5%'>".$results['number']."</td><td colspan='5'><h2>".htmlentities($results['title'], ENT_QUOTES, "UTF-16")."</h2></td></tr>";
			
			echo"<tr><td width='20%'><strong>Format: </strong>".$results['format']."</td><td width='20%'><strong>Media: </strong>".$results['media']."</td><td width='20%'><strong>Sound: </strong>".$results['sound']."</td><td width='20%'><strong>Footage estimate: </strong>".$results['footage_estimate']."</td></tr>";
			echo "<tr><td colspan='4'><strong>Comments: </strong>".$results['comments']."<br /><br /></td></tr>";
			echo "<tr><td colspan='4'><strong>Named Individuals: </strong>".$results['Named_Individuals']."<br /><br /></td></tr>";
			
			
			if ($results['code'] != NULL) {
			##########################################
			
			$sql_str2="SELECT * FROM Lucey_viewed WHERE id=$number";
			
			$search2 = mysql_db_query($dbname, $sql_str2, $id_link);
			
			$results2 = mysql_fetch_array($search2);
			
			echo "<tr><td><strong>V</strong></td><td><strong>Footage: </strong>".$results2['footage']."</td><td><strong>Frames: </strong>".$results2['frames']."</td><td><strong>Running time 24fps: </strong>".$results2['rt24fps']."</td><td><strong>Running time 18fps: </strong>".$results2['rt18fps']."</td</tr>";
			
			echo "<tr><td></td><td colspan=4'><strong>Description:<br /></strong>".$results2['titles_brief_synopsis_credits']."</td></tr>";
			
			##########################################
			}
			
			$sql_str3="SELECT * FROM Lucey2 WHERE id=$number";
			
			$search3 = mysql_db_query($dbname, $sql_str3, $id_link);
			
			$results3 = mysql_fetch_array($search3);
			
			echo "<tr><td></td><td><strong>Old box: </strong>".$results3['old box no']."</td><td><strong>New box: </strong>".$results3['new box no']."</td><td><strong>Storage: </strong>".$results3['storage container']."</td><td><strong>Repackaged?: </strong>".$results3['repackaged?']."</td</tr>";
			
			echo "<tr><td></td><td colspan=2'><strong>Fungus:<br /></strong>".$results3['fungus']."</td><td colspan=2'><strong>Vinegar:<br /></strong>".$results3['vinegar']."</td></tr>";
			
		echo "</table><br /><br />";
			
		}
		
		include "../includes/footer.php"	
?>

