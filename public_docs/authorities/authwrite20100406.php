<?php
 include "../../mgt_config/sql.php"; 

        if (!$id_link || !mysql_select_db($dbname)):
                echo '<p>Error!</p>';
                echo 'Connection to database has failed.  This is most likely due to a temporary server problem.';
                exit();
        endif; 
		
$type = $_GET['type'];
	
if ($type == 'subj') {


$file = "/data/d4/cwatson/website/data/mads/subj.xml";
 echo "subject";
$handle = fopen($file, 'w') or die("can't open file");

fwrite ($handle, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");


 $sql_str="SELECT * FROM cms_auth_subj WHERE suppress IS NULL ORDER BY id ASC";

	 $subjsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");

fwrite ($handle, "<madsCollection>\n");
	
	while ($results = mysql_fetch_array($subjsearch)):
	fwrite ($handle,  "<mads>\n<authority>\n");
	$term = htmlspecialchars(($results['term']), ENT_QUOTES);
	
	fwrite ($handle, "<topic authority=\"".$results['id']."\">".$term."</topic>\n");
	fwrite ($handle,  "</authority>\n");
	
	if ($results['use_for'] <> '') {
	fwrite ($handle,  "<variant>\n");
	$variants = $results['use_for'];
	$variant = explode(";", $variants);
	foreach ($variant as $topic) {
	$topic2 = htmlspecialchars(($topic), ENT_QUOTES);
	fwrite ($handle, "<topic>".$topic2."</topic>\n");
	}
	fwrite ($handle, "</variant>\n");
	}
	
	fwrite ($handle, "<recordInfo>\n");
	
            fwrite ($handle, "<recordContentSource xmlns=\"http://www.loc.gov/mods/v3\">".$results['source']."</recordContentSource>\n");
			
			if ($results['created_on'] == '0000-00-00 00:00:00') {
			fwrite ($handle, "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">before 2009-08-17</recordCreationDate>\n");
			}			
			else {
			fwrite ($handle, "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">".$results['created_on']."</recordCreationDate>\n");
			}
			$last_edited_year = substr ($results['last_edited'], 0, 4);
			$last_edited_month = substr ($results['last_edited'], 4, 2);
			$last_edited_day = substr ($results['last_edited'], 6, 2);
            fwrite ($handle, "<recordChangeDate xmlns=\"http://www.loc.gov/mods/v3\">".$last_edited_year."-".$last_edited_month."-".$last_edited_day."</recordChangeDate>\n");
    fwrite ($handle, "</recordInfo>\n");
	fwrite ($handle, "<note type=\"recordCreator\">Created for project/activity ".$results['created_for']." by ".$results['created_by'].".</note>\n");
	
	if ($results['last_edited_by'] <> '') {
	fwrite ($handle, "<note type=\"recordEditor\">Last edited by ".$results['last_edited_by'].".</note>\n");
	}
	
	if ($results['note'] <> '') {
	fwrite ($handle, "<note type=\"general\">".$results['note'].".</note>\n");
	}
	
	fwrite ($handle,  "</mads>\n");
	endwhile;
	
	
fwrite ($handle, "</madsCollection>\n");	
	
	
fclose($handle);	
	}
	
elseif ($type == 'geog') {

$file = "/data/d4/cwatson/website/data/mads/geog.xml";
 echo "place";
$handle = fopen($file, 'w') or die("can't open file");

fwrite ($handle, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");

 $sql_str="SELECT * FROM cms_auth_geog WHERE suppress IS NULL ORDER BY id ASC";

	 $geogsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");


fwrite ($handle, "<madsCollection xmlns=\"http://www.loc.gov/mads/\"
    xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
    xsi:schemaLocation=\"http://www.loc.gov/mads/ http://www.loc.gov/standards/mads/mads.xsd\">\n");
	
	while ($results = mysql_fetch_array($geogsearch)):
	fwrite ($handle, "<mads>\n");
	fwrite ($handle, "<authority>\n");
	$term = htmlspecialchars(($results['term']), ENT_QUOTES);
	
	## geographic or hierarchicalGeographic
	
	if ($results['island'] <>'' or $results['city'] <>'' or $results['county'] <>'' or $results['country'] <>'') {
	fwrite ($handle, "<hierarchicalGeographic authority=\"".$results['id']."\">\n");
	
	fwrite ($handle, "<country>".$results['country']);
	
		##if county and island are set
		if ($results['county'] <>'' && $results['island'] <>'') {

		fwrite ($handle, "<county>".$results['county']);
			fwrite ($handle, "<island>".$results['island']);			
				if ($results['term'] <>'') {
				fwrite ($handle, "<area>".$results['term']."</area>\n");
				}
			fwrite ($handle, "</island>\n");
		fwrite ($handle, "</county>\n");
		}
		
		## else if county and city are set
		elseif ($results['county'] <>'' && $results['city'] <>'') {
		fwrite ($handle, "<county>".$results['county']);
		fwrite ($handle, "<city>".$results['city']);		
				if ($results['term'] <>'') {
				fwrite ($handle, "<area>".$results['term']."</area>\n");
				}		
		fwrite ($handle, "</city>\n");		
		fwrite ($handle, "</county>\n");
		}
		
		## if county is not set and island is set
		elseif ($results['county'] =='' && $results['island'] <>'') {
		fwrite ($handle, "<island>".$results['island']);		
				if ($results['term'] <>'') {
				fwrite ($handle, "<area>".$results['term']."</area>\n");
				}		
		fwrite ($handle, "</island>\n");	
		}
		
		## if county is not set and city is set
		elseif ($results['county'] =='' && $results['city'] <>'') {
		fwrite ($handle, "<city>".$results['city']);		
				if ($results['term'] <>'') {
				fwrite ($handle, "<area>".$results['term']."</area>\n");
				}		
		fwrite ($handle, "</city>\n");	
		}
		
		## if county is not set and city is not set and island is not set 
		elseif ($results['county'] <>'' && $results['city'] <>'' && $results['island'] <>'') {
				fwrite ($handle, "<area>".$results['term']."</area>\n");
		}
	
	fwrite ($handle, "</country>\n");
	
	fwrite ($handle, "</hierarchicalGeographic>\n");
	}
	else {
	fwrite ($handle, "<geographic authority=\"".$results['id']."\">".$term."</geographic>\n");
	}
	## end geographic or hierarchicalGeographic
	
	fwrite ($handle, "</authority>\n");
	
	if ($results['locator'] <> '') {
	fwrite ($handle, "<extension><coordinates>".$results['locator']."</coordinates></extension>\n");
	}
	
	if ($results['alt_form'] <> '') {
	fwrite ($handle, "<variant type=\"translation\" xml:lang=\"".$results['alt_form_lang']."\">\n");
	$alt_form = htmlspecialchars(($results['alt_form']), ENT_QUOTES);	
	fwrite ($handle, "<geographic>".$alt_form."</geographic>\n");
	fwrite ($handle, "</variant>\n");
	}	
	
	if ($results['use_for'] <> '') {
	fwrite ($handle, "<variant type=\"other\">\n");
	$variants = $results['use_for'];
	$variant = explode(";", $variants);
	foreach ($variant as $geographic) {
	fwrite ($handle, "<geographic>".$geographic."</geographic>\n");
	}
	fwrite ($handle, "</variant>\n");
	}
	
	fwrite ($handle, "<recordInfo>\n");
            fwrite ($handle, "<recordContentSource xmlns=\"http://www.loc.gov/mods/v3\">".$results['source']."</recordContentSource>\n");
			
			if ($results['created_on'] == '0000-00-00 00:00:00') {
			fwrite ($handle, "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">before 2009-08-17</recordCreationDate>\n");
			}			
			else {
			fwrite ($handle, "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">".$results['created_on']."</recordCreationDate>\n");
			}
			$last_edited_year = substr ($results['last_edited'], 0, 4);
			$last_edited_month = substr ($results['last_edited'], 4, 2);
			$last_edited_day = substr ($results['last_edited'], 6, 2);
            fwrite ($handle, "<recordChangeDate xmlns=\"http://www.loc.gov/mods/v3\">".$last_edited_year."-".$last_edited_month."-".$last_edited_day."</recordChangeDate>\n");
    fwrite ($handle, "</recordInfo>\n");
	fwrite ($handle, "<note type=\"recordCreator\">Created for project/activity ".$results['created_for']." by ".$results['created_by'].".</note>\n");
	
	if ($results['last_edited_by'] <> '') {
	fwrite ($handle, "<note type=\"recordEditor\">Last edited by ".$results['last_edited_by'].".</note>\n");
	}
	
	if ($results['note'] <> '') {
	fwrite ($handle, "<note type=\"general\">".$results['note'].".</note>\n");
	}
	fwrite ($handle, "</mads>\n");
	
	endwhile;
fwrite ($handle, "</madsCollection>\n");	
		
	}
	
	elseif ($type == 'genr') {


$file = "/data/d4/cwatson/website/data/mads/genr.xml";
 echo "genre";
$handle = fopen($file, 'w') or die("can't open file");

fwrite ($handle, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");


 $sql_str="SELECT * FROM cms_auth_genr WHERE suppress IS NULL ORDER BY id ASC";

	 $subjsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");

fwrite ($handle, "<madsCollection>\n");
	
	while ($results = mysql_fetch_array($subjsearch)):
	fwrite ($handle,  "<mads>\n<authority>\n");
	$term = htmlspecialchars(($results['term']), ENT_QUOTES);
	
	fwrite ($handle, "<genre authority=\"".$results['id']."\">".$term."</genre>\n");
	fwrite ($handle,  "</authority>\n");
	
	if ($results['use_for'] <> '') {
	fwrite ($handle,  "<variant>\n");
	$variants = $results['use_for'];
	$variant = explode(";", $variants);
	foreach ($variant as $topic) {
	$topic2 = htmlspecialchars(($topic), ENT_QUOTES);
	fwrite ($handle, "<topic>".$topic2."</topic>\n");
	}
	fwrite ($handle, "</variant>\n");
	}
	
	fwrite ($handle, "<recordInfo>\n");
	
            fwrite ($handle, "<recordContentSource xmlns=\"http://www.loc.gov/mods/v3\">".$results['source']."</recordContentSource>\n");
			
			if ($results['created_on'] == '0000-00-00 00:00:00') {
			fwrite ($handle, "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">before 2009-08-17</recordCreationDate>\n");
			}			
			else {
			fwrite ($handle, "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">".$results['created_on']."</recordCreationDate>\n");
			}
			$last_edited_year = substr ($results['last_edited'], 0, 4);
			$last_edited_month = substr ($results['last_edited'], 4, 2);
			$last_edited_day = substr ($results['last_edited'], 6, 2);
            fwrite ($handle, "<recordChangeDate xmlns=\"http://www.loc.gov/mods/v3\">".$last_edited_year."-".$last_edited_month."-".$last_edited_day."</recordChangeDate>\n");
    fwrite ($handle, "</recordInfo>\n");
	fwrite ($handle, "<note type=\"recordCreator\">Created for project/activity ".$results['created_for']." by ".$results['created_by'].".</note>\n");
	
	if ($results['last_edited_by'] <> '') {
	fwrite ($handle, "<note type=\"recordEditor\">Last edited by ".$results['last_edited_by'].".</note>\n");
	}
	
	if ($results['note'] <> '') {
	fwrite ($handle, "<note type=\"general\">".$results['note'].".</note>\n");
	}
	
	fwrite ($handle,  "</mads>\n");
	endwhile;
	
	
fwrite ($handle, "</madsCollection>\n");	
	
	
fclose($handle);	
	}
	
	elseif ($type == 'pers') {

$file = "/data/d4/cwatson/website/data/mads/pers.xml";
 echo "people";
$handle = fopen($file, 'w') or die("can't open file");

fwrite ($handle, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");


 $sql_str="SELECT * FROM cms_auth_pers WHERE variant_of=0 AND suppress IS NULL ORDER BY id ASC";

	 $perssearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");


fwrite ($handle, "<madsCollection xmlns=\"http://www.loc.gov/mads/\"
    xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
    xsi:schemaLocation=\"http://www.loc.gov/mads/ http://www.loc.gov/standards/mads/mads.xsd\">\n");
	
	while ($results = mysql_fetch_array($perssearch)):
	fwrite ($handle, "<mads>\n");
	fwrite ($handle, "<authority>\n");
	$id = $results['id'];
	$primary_name = htmlspecialchars(($results['family_name']), ENT_QUOTES);
	$secondary_name = htmlspecialchars(($results['given_name']), ENT_QUOTES);
	$terms_of_address = htmlspecialchars(($results['terms_of_address']), ENT_QUOTES);
	$date = $results['date'];
	$description = htmlspecialchars(($results['description']), ENT_QUOTES);
	
	fwrite ($handle, "<name authority=\"".$id."\" type=\"personal\">\n");
	fwrite ($handle, "<namePart type=\"family\">".$family_name."</namePart>\n");
	fwrite ($handle, "<namePart type=\"given\">".$given_name."</namePart>\n");
	fwrite ($handle, "<namePart type=\"termsOfAddress\">".$terms_of_address."</namePart>\n");
	fwrite ($handle, "<namePart type=\"date\">".$date."</namePart>\n");	
	fwrite ($handle, "<description>".$description."</description>\n");	
	fwrite ($handle, "</name>\n");
	fwrite ($handle, "</authority>\n");
	
	if ($results['variant_of'] == '0') {
	
	 $sql_str2="SELECT * FROM cms_auth_pers WHERE variant_of=$id AND suppress IS NULL ORDER BY family_name ASC";

	 $perssearch2 = mysql_db_query($dbname, $sql_str2, $id_link) or die("Search Failed!");
	 
	 while ($results2 = mysql_fetch_array($perssearch2)):
	 
	 
	$id2 = $results2['id'];
	$primary_name2 = htmlspecialchars(($results2['family_name']), ENT_QUOTES);
	$secondary_name2 = htmlspecialchars(($results2['given_name']), ENT_QUOTES);
	$terms_of_address2 = htmlspecialchars(($results2['terms_of_address']), ENT_QUOTES);
	$date2 = $results2['date'];
	$description2 = htmlspecialchars(($results2['description']), ENT_QUOTES);
	 
	fwrite ($handle, "<variant type=\"non-preferred\">\n");
	fwrite ($handle, "<name authority=\"".$id2."\" type=\"personal\">\n");
	fwrite ($handle, "<namePart type=\"family\">".$family_name2."</namePart>\n");
	fwrite ($handle, "<namePart type=\"given\">".$given_name2."</namePart>\n");
	fwrite ($handle, "<namePart type=\"terms of address\">".$terms_of_address2."</namePart>\n");
	fwrite ($handle, "<namePart type=\"date\">".$date2."</namePart>\n");	
	fwrite ($handle, "<description>".$description2."</description>\n");	
	fwrite ($handle, "</name>\n");
	fwrite ($handle, "</variant>\n");
	
	endwhile;
	}	
	
	if ($results['use_for'] <> '') {
	fwrite ($handle, "<variant type=\"other\">\n");
	$variants = $results['use_for'];
	$variant = explode(";", $variants);
	foreach ($variant as $name) {
	fwrite ($handle, "<name>".$name."</name>\n");
	}
	fwrite ($handle, "</variant>\n");
	}
	
	fwrite ($handle, "<recordInfo>\n");
            fwrite ($handle, "<recordContentSource xmlns=\"http://www.loc.gov/mods/v3\">".$results['source']."</recordContentSource>\n");
			
			if ($results['created_on'] == '0000-00-00 00:00:00') {
			fwrite ($handle, "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">before 2009-08-17</recordCreationDate>\n");
			}			
			else {
			fwrite ($handle, "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">".$results['created_on']."</recordCreationDate>\n");
			}
			$last_edited_year = substr ($results['last_edited'], 0, 4);
			$last_edited_month = substr ($results['last_edited'], 4, 2);
			$last_edited_day = substr ($results['last_edited'], 6, 2);
            fwrite ($handle, "<recordChangeDate xmlns=\"http://www.loc.gov/mods/v3\">".$last_edited_year."-".$last_edited_month."-".$last_edited_day."</recordChangeDate>\n");
    fwrite ($handle, "</recordInfo>\n");
	fwrite ($handle, "<note type=\"recordCreator\">Created for project/activity ".$results['created_for']." by ".$results['created_by'].".</note>\n");
	
	if ($results['last_edited_by'] <> '') {
	fwrite ($handle, "<note type=\"recordEditor\">Last edited by ".$results['last_edited_by'].".</note>\n");
	}
	
	if ($results['note'] <> '') {
	fwrite ($handle, "<note type=\"general\">".$results['note'].".</note>\n");
	}
	fwrite ($handle, "</mads>\n");
	echo " . ";
	endwhile;
fwrite ($handle, "</madsCollection>\n");	
		

		
	}	
	
	
elseif ($type == 'corp') {

$file = "/data/d4/cwatson/website/data/mads/corp.xml";
 echo "corporate";
$handle = fopen($file, 'w') or die("can't open file");

fwrite ($handle, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");


 $sql_str="SELECT * FROM cms_auth_corp WHERE variant_of=0 AND suppress IS NULL ORDER BY id ASC";

	 $perssearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");


fwrite ($handle, "<madsCollection xmlns=\"http://www.loc.gov/mads/\"
    xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
    xsi:schemaLocation=\"http://www.loc.gov/mads/ http://www.loc.gov/standards/mads/mads.xsd\">\n");
	
	while ($results = mysql_fetch_array($perssearch)):
	fwrite ($handle, "<mads>\n");
	fwrite ($handle, "<authority>\n");
	$id = $results['id'];
	$primary_name = htmlspecialchars(($results['primary_name']), ENT_QUOTES);
	$secondary_name = htmlspecialchars(($results['secondary_name']), ENT_QUOTES);
	$date = $results['date'];
	$description = htmlspecialchars(($results['description']), ENT_QUOTES);
	$location = htmlspecialchars(($results['location']), ENT_QUOTES);
	
	fwrite ($handle, "<name authority=\"".$id."\" type=\"corporate\">\n");
	fwrite ($handle, "<namePart>".$primary_name."</namePart>\n");
	if ($secondary_name <>''){
	fwrite ($handle, "<namePart>".$secondary_name."</namePart>\n");
		}
	fwrite ($handle, "<namePart type=\"date\">".$date."</namePart>\n");	
	fwrite ($handle, "<description>".$description."</description>\n");	
	fwrite ($handle, "</name>\n");
	fwrite ($handle, "</authority>\n");
	
	if ($results['variant_of'] == '0') {
	
	 $sql_str2="SELECT * FROM cms_auth_corp WHERE variant_of=$id AND suppress IS NULL ORDER BY primary_name ASC";

	 $perssearch2 = mysql_db_query($dbname, $sql_str2, $id_link) or die("Search Failed!");
	 
	 while ($results2 = mysql_fetch_array($perssearch2)):
	 
	 
	$id2 = $results2['id'];
	$primary_name2 = htmlspecialchars(($results2['primary_name']), ENT_QUOTES);
	$secondary_name2 = htmlspecialchars(($results2['secondary_name']), ENT_QUOTES);
	$date2 = $results2['date'];
	$description2 = htmlspecialchars(($results2['description']), ENT_QUOTES);
	$location = htmlspecialchars(($results2['location']), ENT_QUOTES);
	 
	fwrite ($handle, "<variant type=\"non-preferred\">\n");
	fwrite ($handle, "<name authority=\"".$id2."\" type=\"corporate\">\n");
	fwrite ($handle, "<namePart>".$primary_name2."</namePart>\n");
	if ($secondary_name2 <>''){
	fwrite ($handle, "<namePart>".$secondary_name2."</namePart>\n");
	}
	fwrite ($handle, "<namePart type=\"date\">".$date2."</namePart>\n");	
	fwrite ($handle, "<description>".$description2."</description>\n");	
	fwrite ($handle, "</name>\n");
	fwrite ($handle, "</variant>\n");
	
	endwhile;
	}	
	
	if ($results['use_for'] <> '') {
	fwrite ($handle, "<variant type=\"other\">\n");
	$variants = $results['use_for'];
	$variant = explode(";", $variants);
	foreach ($variant as $name) {
	fwrite ($handle, "<name>".$name."</name>\n");
	}
	fwrite ($handle, "</variant>\n");
	}
	
	fwrite ($handle, "<recordInfo>\n");
            fwrite ($handle, "<recordContentSource xmlns=\"http://www.loc.gov/mods/v3\">".$results['source']."</recordContentSource>\n");
			
			if ($results['created_on'] == '0000-00-00 00:00:00') {
			fwrite ($handle, "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">before 2009-08-17</recordCreationDate>\n");
			}			
			else {
			fwrite ($handle, "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">".$results['created_on']."</recordCreationDate>\n");
			}
			$last_edited_year = substr ($results['last_edited'], 0, 4);
			$last_edited_month = substr ($results['last_edited'], 4, 2);
			$last_edited_day = substr ($results['last_edited'], 6, 2);
            fwrite ($handle, "<recordChangeDate xmlns=\"http://www.loc.gov/mods/v3\">".$last_edited_year."-".$last_edited_month."-".$last_edited_day."</recordChangeDate>\n");
    fwrite ($handle, "</recordInfo>\n");
	fwrite ($handle, "<note type=\"recordCreator\">Created for project/activity ".$results['created_for']." by ".$results['created_by'].".</note>\n");
	
	if ($results['last_edited_by'] <> '') {
	fwrite ($handle, "<note type=\"recordEditor\">Last edited by ".$results['last_edited_by'].".</note>\n");
	}
	
	if ($results['note'] <> '') {
	fwrite ($handle, "<note type=\"general\">".$results['note'].".</note>\n");
	}
	fwrite ($handle, "</mads>\n");
	echo " . ";
	endwhile;
fwrite ($handle, "</madsCollection>\n");	
		

		
	}	
	
	
elseif ($type == 'fam') {

$file = "/data/d4/cwatson/website/data/mads/fam.xml";
 echo "family";
$handle = fopen($file, 'w') or die("can't open file");

fwrite ($handle, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");


 $sql_str="SELECT * FROM cms_auth_fam WHERE variant_of=0 AND suppress IS NULL ORDER BY id ASC";

	 $perssearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");


fwrite ($handle, "<madsCollection xmlns=\"http://www.loc.gov/mads/\"
    xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
    xsi:schemaLocation=\"http://www.loc.gov/mads/ http://www.loc.gov/standards/mads/mads.xsd\">\n");
	
	while ($results = mysql_fetch_array($perssearch)):
	fwrite ($handle, "<mads>\n");
	fwrite ($handle, "<authority>\n");
	$id = $results['id'];
	$family_name = htmlspecialchars(($results['family_name']), ENT_QUOTES);
	$title = htmlspecialchars(($results['title']), ENT_QUOTES);
	$territorial_distinction = htmlspecialchars(($results['territorial_distinction']), ENT_QUOTES);
	
	fwrite ($handle, "<name authority=\"".$id."\" type=\"personal\">\n");
	fwrite ($handle, "<namePart type=\"family\">".$family_name."</namePart>\n");
	if ($title <>''){
	fwrite ($handle, "<namePart type=\"termsOfReference\">".$title."</namePart>\n");
		}
		if ($territorial_distinction <>''){
	fwrite ($handle, "<description>".$territorial_distinction."</description>\n");
	}	
	fwrite ($handle, "</name>\n");
	fwrite ($handle, "</authority>\n");
	
		
	if ($results['use_for'] <> '') {
	fwrite ($handle, "<variant type=\"other\">\n");
	$variants = $results['use_for'];
	$variant = explode(";", $variants);
	foreach ($variant as $name) {
	fwrite ($handle, "<name>".$name."</name>\n");
	}
	fwrite ($handle, "</variant>\n");
	}
	
	fwrite ($handle, "<recordInfo>\n");
            fwrite ($handle, "<recordContentSource xmlns=\"http://www.loc.gov/mods/v3\">".$results['source']."</recordContentSource>\n");
			
			if ($results['created_on'] == '0000-00-00 00:00:00') {
			fwrite ($handle, "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">before 2009-08-17</recordCreationDate>\n");
			}			
			else {
			fwrite ($handle, "<recordCreationDate xmlns=\"http://www.loc.gov/mods/v3\">".$results['created_on']."</recordCreationDate>\n");
			}
			$last_edited_year = substr ($results['last_edited'], 0, 4);
			$last_edited_month = substr ($results['last_edited'], 4, 2);
			$last_edited_day = substr ($results['last_edited'], 6, 2);
            fwrite ($handle, "<recordChangeDate xmlns=\"http://www.loc.gov/mods/v3\">".$last_edited_year."-".$last_edited_month."-".$last_edited_day."</recordChangeDate>\n");
    fwrite ($handle, "</recordInfo>\n");
	fwrite ($handle, "<note type=\"recordCreator\">Created for project/activity ".$results['created_for']." by ".$results['created_by'].".</note>\n");
	
	if ($results['last_edited_by'] <> '') {
	fwrite ($handle, "<note type=\"recordEditor\">Last edited by ".$results['last_edited_by'].".</note>\n");
	}
	
	if ($results['note'] <> '') {
	fwrite ($handle, "<note type=\"general\">".$results['note'].".</note>\n");
	}
	fwrite ($handle, "</mads>\n");
	echo " . ";
	endwhile;
fwrite ($handle, "</madsCollection>\n");	
		

		
	}	
?>