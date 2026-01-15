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
		
$sql_str="SELECT * FROM cms_auth_corp WHERE suppress IS NULL ORDER BY corpterm ASC";

	 $perssearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 echo "<h1>Title</h1>";
echo "<table cellpadding='2' border='1'>";
while ($results = mysql_fetch_array($perssearch)):
	
	$id = $results['id']; 
	
	
		##break original nca string down into parts
		
		$name_parts = htmlspecialchars(($results['corpterm']));
		$name_part = explode(" | ", $name_parts);	
		$name_part_count = sizeof($name_part);
		$name = $name_part[0];
		$name2 = $name_part[1];
		$desc = end($name_part);
		
		foreach ($name_part as $fragment) {
		
		## identify part containing numerical characters and assign this value to variable 'datespan'
	    if (strstr($fragment,'1') or strstr($fragment,'2') or strstr($fragment,'3') or strstr($fragment,'4') or strstr($fragment,'5') or strstr($fragment,'6') or strstr($fragment,'7') or strstr($fragment,'8') or strstr($fragment,'9') or strstr($fragment,'0')) {
        $date = $fragment;
    	}
		
		## identify part containing brackets and claim this as variable 'place'
		if (strstr($fragment,'(') or strstr($fragment,')')) {
        $place = $fragment;
    	}
		} 
		
	
	
		if ($desc != $name && $desc != $place && $desc != $date) {
		$description = mysql_real_escape_string($desc);
		}
		elseif ($desc == $place) {
		$new = array_pop($name_part);
		if (end($name_part) != $name && end($name_part) != $date) {
		$description = end($name_part);
		}
		}
		else {
		$description = NULL;
		}
		
		if ($date != $name) {
	$datespan = $date;
		}
		else {
		$datespan = NULL;
		}
		
		if ($name2 != $description && $name2 != $place && $name2 != $date) {
		$secondary = $name_part[1];
		}
		else {
		$secondary = NULL;
		}
		
echo "<tr><td><a target='_blank'  href='http://www.lib.ed.ac.uk/resources/collections/cmsys/content/test.php?func=authorities&view=corpedit&id=".$results['id']."'>".$results['corpterm']."</a></td><td>".$name."</td><td>".$secondary."</td><td>".$date."</td><td>".$description."</td><td>".$place."</td><td>".$name_part_count."</td></tr>";

$secondary = mysql_real_escape_string($secondary);
$date = mysql_real_escape_string($date);
$description = mysql_real_escape_string($description);
$place = mysql_real_escape_string($place);

##$sql_str="UPDATE cms_auth_corp SET secondary_name='$secondary', date='$date', description='$description', location='$place' WHERE id='$id' LIMIT 1";

##mysql_query($sql_str) or die ("Update corporate name failed!");

##$sql = sprintf("UPDATE cms_auth_pers SET
##	given_name = '$given_name'
##    WHERE id = '$id'",
##	mysql_real_escape_string($given_name)
##    ); 
## echo $id." ".$family_name."<br>";
	
		$name = NULL;
		$secondary = NULL;
		$date = NULL;
		$datespan = NULL;
		$desc = NULL;
		$description = NULL;
		$place = NULL;
	

	endwhile;
	
 echo "</table>";

		
?>