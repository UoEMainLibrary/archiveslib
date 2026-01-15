<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Checklist</title>
<style>
td {
font-family: arial;
font-size: 9pt;
}

</style>
</head>
<body>
<?php  

include "../../mgt_config/sql.php"; 

        if (!$id_link || !mysql_select_db($dbname)):
                echo '<p>Error!</p>';
                echo 'Connection to database has failed.  This is most likely due to a temporary server problem.';
                exit();
        endif; 
		
$sql_str="SELECT * FROM cms_auth_pers WHERE suppress IS NULL ORDER BY persterm ASC";

	 $perssearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 echo "<h1>Title</h1>";
echo "<table cellpadding='2' border='1'>";
while ($results = mysql_fetch_array($perssearch)):
	
	$id = $results['id']; 
	
		$name_parts = $results['normal'];
		$name_part = explode(", ", $name_parts);
	
	$family_name = $name_part[0];
	$given_name_u = $name_part[1]." ".$name_part[2];
	
		$name_parts = htmlspecialchars(($results['persterm']), ENT_QUOTES);
		$name_part = explode(" | ", $name_parts);	
		
		foreach ($name_part as $fragment) {
	
	    if (strstr($fragment,'1') or strstr($fragment,'2') or strstr($fragment,'3') or strstr($fragment,'4') or strstr($fragment,'5') or strstr($fragment,'6') or strstr($fragment,'7') or strstr($fragment,'8') or strstr($fragment,'9') or strstr($fragment,'0')) {
        $datespan = $fragment;
    	}
		else {
		$date = NULL;
		}
		
		$desc = end($name_part); 
		
		} 
		
	$date = $datespan;
	
		if ($date != $desc) {
	$description = mysql_real_escape_string($desc);
		}
		else {
		$description = NULL;
		}
	
$persterm = $results['persterm'];
$normal = $results['normal'];
$given_name = mysql_real_escape_string($given_name_u);
$terms_of_address = $results['terms_of_address'];
$variant_of = $results['variant_of'];
$use_for = $results['use_for'];
$source = $results['source'];
$lang_code = $results['lang_code'];
$notes = $results['notes'];
$last_edited = date("Y-m-d H:i:s"); 
$last_edited_by = "Grant Buttars";
$suppress = $results['suppress'];

$persterm_str = "<span style='background-color: #ffffcc;'>".$family_name."</span> | <span style='background-color: #99cccc;'>".$given_name."</span> | <span style='background-color: #ccffff;'>".$date."</span> | ".$description;

if ($persterm == $persterm_str) { $alert= "n"; } else { $alert = "y"; }

echo "<tr><td width='150'>Existing version</td><td width='750'>".$persterm."</td><td>".$alert."</td></tr>";
echo "<tr><td>Compiled version</td><td>".$persterm_str."</td><td></td></tr>";
echo "<tr><td colspan='3'><hr></td></tr>";

## $sql_str="UPDATE cms_auth_pers SET date='$date', description='$description' WHERE id='$id' LIMIT 1";

## mysql_query($sql_str) or die ("Update person failed!");

##$sql = sprintf("UPDATE cms_auth_pers SET
##	given_name = '$given_name'
##    WHERE id = '$id'",
##	mysql_real_escape_string($given_name)
##    ); 
## echo $id." ".$family_name."<br>";
	
		$date = NULL;
		$datespan = NULL;
		$desc = NULL;
		$description = NULL;
	

	endwhile;
	
 echo "</table>";

		
?>