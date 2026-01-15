<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?
error_reporting(E_ALL);
ini_set('display_errors', '1');

 include "../../mgt_config/sql.php"; 

        if (!$id_link || !mysql_select_db($dbname)):
                echo '<p>Error!</p>';
                echo 'Connection to database has failed.  This is most likely due to a temporary server problem.';
                exit();
        endif; 
		
$type = $_GET['type'];

####### GEOG ###############

if ($type == 'geog') {

$file = "/data/d4/cwatson/website/data/mads/geog.xml";
 echo "place";
$handle = fopen($file, 'w') or die("can't open file");

fwrite ($handle, "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");

fwrite ($handle, "<madsCollection xmlns=\"http://www.loc.gov/mads/\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" 
xsi:schemaLocation=\"http://www.loc.gov/mads/ http://www.loc.gov/standards/mads/mads.xsd\">\n");

$sub_geog = file_get_contents("sub_geog.txt");

$geog_arr_p = explode (",", $sub_geog);

sort($geog_arr_p);

$geog_arr = array_unique($geog_arr_p);

$count_str = "0";

foreach ($geog_arr as $authfilenumber) {
	
 $sql_str="SELECT * FROM cms_auth_geog where id='$authfilenumber' AND id <> ''"; 
 $subjsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
 $results = mysql_fetch_array($subjsearch);
 
 ### preliminaries regardless of geog term type #####
  if ($authfilenumber <>'') {
  
 fwrite ($handle,  "<mads>\n<authority>\n");
 
 $count_str =  $count_str+1;
 
 echo "<hr>";
 echo $results['id'];
 ### hierarchical terms only ###
 
	if ($results['part_order'] <>'') {	
	
	fwrite ($handle, "<hierarchicalGeographic authority=\"".$results['id']."\">\n");
	
	$hier_arr = explode (",", $results['part_order']);
	
	foreach($hier_arr as $key => $value) {
  	if($value == NULL) {
    unset($hier_arr[$key]);
  	}
	}
	
	$hier_arr_2 = array_values($hier_arr); 
	
	$realcount = count($hier_arr);
	
	while ($realcount <>0) {	
	$realcount = $realcount-1;	
	if ($hier_arr[$realcount] == "area") { $fieldname = "term"; }
	else {$fieldname = $hier_arr[$realcount]; }	
	fwrite ($handle, ("<".$hier_arr[$realcount].">".htmlspecialchars(($results[$fieldname]), ENT_QUOTES)));	
	echo " --- ".$results[$fieldname];
	}
		
	$currentcount=0;
	$maxcount = count($hier_arr);
	
	while ($currentcount < $maxcount) {	
	fwrite ($handle, "</".$hier_arr[$currentcount].">");
	$currentcount = $currentcount+1;
	}
	
	
	fwrite ($handle, "</hierarchicalGeographic>"); 
	}
	
	else {
	fwrite ($handle, "<geographic authority=\"".$results['id']."\">".htmlspecialchars(($results['term']), ENT_QUOTES)."</geographic>\n");
	echo " --- ".$results['term'];
	}
	
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
	
	if ($results['notes'] <> '') {
	fwrite ($handle, "<note type=\"general\">".$results['notes'].".</note>\n");
	}
	fwrite ($handle, "</mads>\n");
	}
	}
fwrite ($handle, "</madsCollection>\n");	
		
	}

############################

?>

<body>
</body>
</html>
