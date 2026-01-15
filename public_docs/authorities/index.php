<?php  header ("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";

include "../../mgt_config/sql.php"; 

        if (!$id_link || !mysql_select_db($dbname)):
                echo '<p>Error!</p>';
                echo 'Connection to database has failed.  This is most likely due to a temporary server problem.';
                exit();
        endif; 
		
$type = $_GET['type'];
	
if ($type == 'subj') {

 $sql_str="SELECT * FROM cms_auth_subj WHERE suppress IS NULL ORDER BY term ASC";

	 $subjsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");


echo "<madsCollection xmlns=\"http://www.loc.gov/mads/\"
    xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
    xsi:schemaLocation=\"http://www.loc.gov/mads/ http://www.loc.gov/standards/mads/mads.xsd\">";
	
	while ($results = mysql_fetch_array($subjsearch)):
	echo "<mads>";
	echo "<authority>";
	$term = htmlspecialchars(($results['term']), ENT_QUOTES);
	echo"<topic authority=\"".$results['id']."\">".$term."</topic>";
	echo "</authority>";
	
	if ($results['use_for'] <> '') {
	echo "<variant>";
	$variants = $results['use_for'];
	$variant = explode(";", $variants);
	foreach ($variant as $topic) {
	$topic2 = htmlspecialchars(($topic), ENT_QUOTES);
	echo "<topic>".$topic2."</topic>";
	}
	echo "</variant>";
	}
	
	echo "<recordInfo>";
            echo "<recordContentSource xmlns=\"http://www.loc.gov/mods/v3\">".$results['source']."</recordContentSource>";
			
			if ($results['created_on'] == '0000-00-00 00:00:00') {
			echo "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">before 2009-08-17</recordCreationDate>";
			}			
			else {
			echo "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">".$results['created_on']."</recordCreationDate>";
			}
			$last_edited_year = substr ($results['last_edited'], 0, 4);
			$last_edited_month = substr ($results['last_edited'], 4, 2);
			$last_edited_day = substr ($results['last_edited'], 6, 2);
            echo "<recordChangeDate xmlns=\"http://www.loc.gov/mods/v3\">".$last_edited_year."-".$last_edited_month."-".$last_edited_day."</recordChangeDate>";
    echo "</recordInfo>";
	echo "<note type=\"recordCreator\">Created for project/activity ".$results['created_for']." by ".$results['created_by'].".</note>";
	
	if ($results['last_edited_by'] <> '') {
	echo "<note type=\"recordEditor\">Last edited by ".$results['last_edited_by'].".</note>";
	}
	
	if ($results['note'] <> '') {
	echo "<note type=\"general\">".$results['note'].".</note>";
	}
	echo "</mads>";
	endwhile;
echo "</madsCollection>";	
		
	}
	
elseif ($type == 'geog') {

 $sql_str="SELECT * FROM cms_auth_geog WHERE suppress IS NULL ORDER BY term ASC";

	 $geogsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");


echo "<madsCollection xmlns=\"http://www.loc.gov/mads/\"
    xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
    xsi:schemaLocation=\"http://www.loc.gov/mads/ http://www.loc.gov/standards/mads/mads.xsd\">";
	
	while ($results = mysql_fetch_array($geogsearch)):
	echo "<mads>";
	echo "<authority>";
	$term = htmlspecialchars(($results['term']), ENT_QUOTES);
	
	## geographic or hierarchicalGeographic
	
	if ($results['island'] <>'' or $results['city'] <>'' or $results['county'] <>'' or $results['country'] <>'') {
	echo "<hierarchicalGeographic authority=\"".$results['id']."\">";
	
	echo "<continent xmlns=\"http://www.loc.gov/mods/v3\"><country xmlns=\"http://www.loc.gov/mods/v3\">".$results['country'];
	
		##if county and island are set
		if ($results['county'] <>'' && $results['island'] <>'') {
		echo "<county xmlns=\"http://www.loc.gov/mods/v3\">".$results['county'];
			echo "<island xmlns=\"http://www.loc.gov/mods/v3\">".$results['island'];			
				if ($results['term'] <>'') {
				echo "<area xmlns=\"http://www.loc.gov/mods/v3\">".$results['term']."</area>";
				}
			echo "</island>";
		echo "</county>";
		}
		
		## else if county and city are set
		elseif ($results['county'] <>'' && $results['city'] <>'') {
		echo "<county xmlns=\"http://www.loc.gov/mods/v3\">".$results['county'];
		echo "<city xmlns=\"http://www.loc.gov/mods/v3\">".$results['city'];		
				if ($results['term'] <>'') {
				echo "<area xmlns=\"http://www.loc.gov/mods/v3\">".$results['term']."</area>";
				}		
		echo "</city>";		
		echo "</county>";
		}
		
		## if county is not set and island is set
		elseif ($results['county'] =='' && $results['island'] <>'') {
		echo "<island xmlns=\"http://www.loc.gov/mods/v3\">".$results['island'];		
				if ($results['term'] <>'') {
				echo "<area xmlns=\"http://www.loc.gov/mods/v3\">".$results['term']."</area>";
				}		
		echo "</island>";	
		}
		
		## if county is not set and city is set
		elseif ($results['county'] =='' && $results['city'] <>'') {
		echo "<city xmlns=\"http://www.loc.gov/mods/v3\">".$results['city'];		
				if ($results['term'] <>'') {
				echo "<area xmlns=\"http://www.loc.gov/mods/v3\">".$results['term']."</area>";
				}		
		echo "</city>";	
		}
		
		## if county is not set and city is not set and island is not set 
		elseif ($results['county'] <>'' && $results['city'] <>'' && $results['island'] <>'') {
				echo "<area xmlns=\"http://www.loc.gov/mods/v3\">".$results['term']."</area>";
		}
	
	echo "</country></continent>";
	
	echo "</hierarchicalGeographic>";
	}
	else {
	echo "<geographic authority=\"".$results['id']."\">".$term."</geographic>";
	}
	## end geographic or hierarchicalGeographic
	
	echo "</authority>";
	
	if ($results['locator'] <> '') {
	echo "<extension><coordinates>".$results['locator']."</coordinates></extension>";
	}
	
	if ($results['alt_form'] <> '') {
	echo "<variant type=\"translation\" xml:lang=\"".$results['alt_form_lang']."\">";
	$alt_form = htmlspecialchars(($results['alt_form']), ENT_QUOTES);	
	echo "<geographic>".$alt_form."</geographic>";
	echo "</variant>";
	}	
	
	if ($results['use_for'] <> '') {
	echo "<variant type=\"other\">";
	$variants = $results['use_for'];
	$variant = explode(";", $variants);
	foreach ($variant as $geographic) {
	echo "<geographic>".$geographic."</geographic>";
	}
	echo "</variant>";
	}
	
	echo "<recordInfo>";
            echo "<recordContentSource xmlns=\"http://www.loc.gov/mods/v3\">".$results['source']."</recordContentSource>";
			
			if ($results['created_on'] == '0000-00-00 00:00:00') {
			echo "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">before 2009-08-17</recordCreationDate>";
			}			
			else {
			echo "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">".$results['created_on']."</recordCreationDate>";
			}
			$last_edited_year = substr ($results['last_edited'], 0, 4);
			$last_edited_month = substr ($results['last_edited'], 4, 2);
			$last_edited_day = substr ($results['last_edited'], 6, 2);
            echo "<recordChangeDate xmlns=\"http://www.loc.gov/mods/v3\">".$last_edited_year."-".$last_edited_month."-".$last_edited_day."</recordChangeDate>";
    echo "</recordInfo>";
	echo "<note type=\"recordCreator\">Created for project/activity ".$results['created_for']." by ".$results['created_by'].".</note>";
	
	if ($results['last_edited_by'] <> '') {
	echo "<note type=\"recordEditor\">Last edited by ".$results['last_edited_by'].".</note>";
	}
	
	if ($results['note'] <> '') {
	echo "<note type=\"general\">".$results['note'].".</note>";
	}
	echo "</mads>";
	
	endwhile;
echo "</madsCollection>";	
		
	}
elseif ($type == 'pers_old') {

 $sql_str="SELECT * FROM cms_auth_pers WHERE suppress IS NULL ORDER BY persterm ASC";

	 $perssearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");


echo "<madsCollection xmlns=\"http://www.loc.gov/mads/\"
    xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
    xsi:schemaLocation=\"http://www.loc.gov/mads/ http://www.loc.gov/standards/mads/mads.xsd\">";
	
	while ($results = mysql_fetch_array($perssearch)):
	echo "<mads>";
	echo "<authority>";
	$persterm = htmlspecialchars(($results['term']), ENT_QUOTES);
	echo"<name authority=\"".$results['id']."\">";
	$name_parts = $results['normal'];
	$name_part = explode(", ", $name_parts);
	echo "<namePart type=\"family\">".$name_part[0]."</namePart>";
	echo "<namePart type=\"given\">".$name_part[1]." ".$name_part[2]."</namePart>";
	
	$name_parts = htmlspecialchars(($results['persterm']), ENT_QUOTES);
	$name_part = explode(" | ", $name_parts);	
	foreach ($name_part as $fragment) {
	
	    if (strstr($fragment,'1') or strstr($fragment,'2') or strstr($fragment,'3') or strstr($fragment,'4') or strstr($fragment,'5') or strstr($fragment,'6') or strstr($fragment,'7') or strstr($fragment,'8') or strstr($fragment,'9') or strstr($fragment,'0')) {
        $datespan = $fragment;
		$desc = end($name_part); 
    }
	} 
	echo "<namePart type=\"date\">".$datespan."</namePart>";
	
	if ($datespan != $desc) {
	echo "<description>".$desc."</description>";
	}
	echo "</name>";
	$datespan = NULL;
	
	echo "</authority>";
	if ($results['alt_form'] <> '') {
	echo "<variant type=\"translation\" xml:lang=\"".$results['alt_form_lang']."\">";
	$alt_form = htmlspecialchars(($results['alt_form']), ENT_QUOTES);	
	echo "<geographic>".$alt_form."</geographic>";
	echo "</variant>";
	}	
	
	if ($results['use_for'] <> '') {
	echo "<variant type=\"other\">";
	$variants = $results['use_for'];
	$variant = explode(";", $variants);
	foreach ($variant as $geographic) {
	echo "<geographic>".$geographic."</geographic>";
	}
	echo "</variant>";
	}
	
	echo "<recordInfo>";
            echo "<recordContentSource xmlns=\"http://www.loc.gov/mods/v3\">".$results['source']."</recordContentSource>";
			
			if ($results['created_on'] == '0000-00-00 00:00:00') {
			echo "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">before 2009-08-17</recordCreationDate>";
			}			
			else {
			echo "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">".$results['created_on']."</recordCreationDate>";
			}
			$last_edited_year = substr ($results['last_edited'], 0, 4);
			$last_edited_month = substr ($results['last_edited'], 4, 2);
			$last_edited_day = substr ($results['last_edited'], 6, 2);
            echo "<recordChangeDate xmlns=\"http://www.loc.gov/mods/v3\">".$last_edited_year."-".$last_edited_month."-".$last_edited_day."</recordChangeDate>";
    echo "</recordInfo>";
	echo "<note type=\"recordCreator\">Created for project/activity ".$results['created_for']." by ".$results['created_by'].".</note>";
	
	if ($results['last_edited_by'] <> '') {
	echo "<note type=\"recordEditor\">Last edited by ".$results['last_edited_by'].".</note>";
	}
	
	if ($results['note'] <> '') {
	echo "<note type=\"general\">".$results['note'].".</note>";
	}
	echo "</mads>";
	endwhile;
echo "</madsCollection>";	
		
	}
elseif ($type == 'pers') {

 $sql_str="SELECT * FROM cms_auth_pers WHERE variant_of=0 AND suppress IS NULL ORDER BY family_name ASC";

	 $perssearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");


echo "<madsCollection xmlns=\"http://www.loc.gov/mads/\"
    xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
    xsi:schemaLocation=\"http://www.loc.gov/mads/ http://www.loc.gov/standards/mads/mads.xsd\">";
	
	while ($results = mysql_fetch_array($perssearch)):
	echo "<mads>";
	echo "<authority>";
	$id = $results['id'];
	$family_name = htmlspecialchars(($results['family_name']), ENT_QUOTES);
	$given_name = htmlspecialchars(($results['given_name']), ENT_QUOTES);
	$terms_of_address = htmlspecialchars(($results['terms_of_address']), ENT_QUOTES);
	$date = $results['date'];
	$description = htmlspecialchars(($results['description']), ENT_QUOTES);
	
	echo"<name authority=\"".$id."\">";
	echo "<namePart type=\"family\">".$family_name."</namePart>";
	echo "<namePart type=\"given\">".$given_name."</namePart>";
	echo "<namePart type=\"termsOfAddress\">".$terms_of_address."</namePart>";
	echo "<namePart type=\"date\">".$date."</namePart>";	
	echo "<description>".$description."</description>";	
	echo "</name>";
	echo "</authority>";
	
	if ($results['variant_of'] == '0') {
	
	 $sql_str2="SELECT * FROM cms_auth_pers WHERE variant_of=$id AND suppress IS NULL ORDER BY family_name ASC";

	 $perssearch2 = mysql_db_query($dbname, $sql_str2, $id_link) or die("Search Failed!");
	 
	 while ($results2 = mysql_fetch_array($perssearch2)):
	 
	 
	$id2 = $results2['id'];
	$family_name2 = htmlspecialchars(($results2['family_name']), ENT_QUOTES);
	$given_name2 = htmlspecialchars(($results2['given_name']), ENT_QUOTES);
	$terms_of_address2 = htmlspecialchars(($results2['terms_of_address']), ENT_QUOTES);
	$date2 = $results2['date'];
	$description2 = htmlspecialchars(($results2['description']), ENT_QUOTES);
	 
	echo "<variant type=\"non-preferred\">";
	echo"<name authority=\"".$id2."\">";
	echo "<namePart type=\"family\">".$family_name2."</namePart>";
	echo "<namePart type=\"given\">".$given_name2."</namePart>";
	echo "<namePart type=\"termsOfAddress\">".$terms_of_address2."</namePart>";
	echo "<namePart type=\"date\">".$date2."</namePart>";	
	echo "<description>".$description2."</description>";	
	echo "</name>";
	echo "</variant>";
	
	endwhile;
	}	
	
	if ($results['use_for'] <> '') {
	echo "<variant type=\"other\">";
	$variants = $results['use_for'];
	$variant = explode(";", $variants);
	foreach ($variant as $name) {
	echo "<name><namePart>".$name."</namePart></name>";
	}
	echo "</variant>";
	}
	
	echo "<recordInfo>";
            echo "<recordContentSource xmlns=\"http://www.loc.gov/mods/v3\">".$results['source']."</recordContentSource>";
			
			if ($results['created_on'] == '0000-00-00 00:00:00') {
			echo "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">before 2009-08-17</recordCreationDate>";
			}			
			else {
			echo "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">".$results['created_on']."</recordCreationDate>";
			}
			$last_edited_year = substr ($results['last_edited'], 0, 4);
			$last_edited_month = substr ($results['last_edited'], 4, 2);
			$last_edited_day = substr ($results['last_edited'], 6, 2);
            echo "<recordChangeDate xmlns=\"http://www.loc.gov/mods/v3\">".$last_edited_year."-".$last_edited_month."-".$last_edited_day."</recordChangeDate>";
    echo "</recordInfo>";
	echo "<note type=\"recordCreator\">Created for project/activity ".$results['created_for']." by ".$results['created_by'].".</note>";
	
	if ($results['last_edited_by'] <> '') {
	echo "<note type=\"recordEditor\">Last edited by ".$results['last_edited_by'].".</note>";
	}
	
	if ($results['note'] <> '') {
	echo "<note type=\"general\">".$results['note'].".</note>";
	}
	echo "</mads>";
	endwhile;
echo "</madsCollection>";	
		
	}		
?>