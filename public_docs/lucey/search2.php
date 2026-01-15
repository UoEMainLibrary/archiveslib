<?php include "../../mgt_config/sql.php"; 
$view = $_GET['view'];
$searchterm = $_GET['searchterm'];

if ($view == "results") {

$sql_str="SELECT * FROM Lucey WHERE title LIKE'%$searchterm%' OR comments LIKE'%$searchterm%' OR 'Named Individuals' LIKE'%$searchterm%' ORDER BY number";
		$search = mysql_db_query($dbname, $sql_str, $id_link);
		
		echo "<table width='100%' border='1'>";
		
		while ($results = mysql_fetch_array($search)) {	
			
			echo "<tr>";
			echo "<td>".$results['number']."</td>";
			echo "<td>".htmlentities($results['title'], ENT_QUOTES, "UTF-16");"</td>";			
			echo "<td>".$results['format']."</td>";
			echo "<td>".$results['media']."</td>";
			echo "<td>".$results['sound']."</td>";
			echo "<td>".$results['colour']."</td>";
			echo "<td>".$results['footage_estimate']."</td>";
			echo "<td>".$results['comments']."</td>";
			echo "<td>".$results['purpose']."</td>";			
			
			echo "<td>".$results['Genetic_material']."</td>";
			echo "<td>".$results['Faculty_of_Science']."</td>";
			echo "<td>".$results['Personal_material']."</td>";
			echo "<td>".$results['Trips_Abroad']."</td>";
			echo "<td>".$results['Commercial_Production']."</td>";
			echo "<td>".$results['category_unknown']."</td>";
			echo "<td>".$results['experimental_film_techniques']."</td>";
			
			echo "<td>".$results['Named_Individuals']."</td>";
			
			echo "<td>".$results['Scottish']."</td>";
			
			
			
			echo "<td>";
			
			if ($results['code'] != NULL) {
			##########################################
			
			echo "VIEWED";
						
			##########################################
			}
			
			echo "</td>";
						
			$number = $results['number'];
			
			$sql_str2="SELECT * FROM Lucey_viewed WHERE id=$number";
			
			$search2 = mysql_db_query($dbname, $sql_str2, $id_link);
			
			$results2 = mysql_fetch_array($search2);
			
			echo "<td>".$results2['footage']."</td>";
			echo "<td>".$results2['frames']."</td>";
			echo "<td>".$results2['rt24fps']."</td>";
			echo "<td>".$results2['rt18fps']."</td>";
			
			echo "<td>".htmlentities($results2['comments'], ENT_QUOTES, "UTF-16");"</td>";	
			
			echo "<td>".htmlentities($results2['titles_brief_synopsis_credits'], ENT_QUOTES, "UTF-16");"</td>";
			
						
			echo "<td>".$results2['associated_paper']."</td>";
			echo "<td>".$results2['related_items']."</td>";
			echo "<td>".$results2['category']."</td>";
			
			$sql_str3="SELECT * FROM Lucey2 WHERE id=$number";
			
			$search3 = mysql_db_query($dbname, $sql_str3, $id_link);
			
			$results3 = mysql_fetch_array($search3);
			
			echo "<td>".$results3['old box no']."</td>";
			echo "<td>".$results3['new box no']."</td>";
			echo "<td>".$results3['storage container']."</td>";
			echo "<td>".$results3['repackaged?']."</td>";			
			echo "<td>".$results3['fungus']."</td>";
			echo "<td>".$results3['vinegar']."</td>";
			echo "</tr>";
				
			
		}
		echo "</table>";
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
		
		
?>

