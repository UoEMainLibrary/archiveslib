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
		
$sql_str="SELECT * FROM cms_auth_pers WHERE family_name LIKE ''";

	 $perssearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 echo "<h1>Title</h1>";
echo "<table cellpadding='2' border='1'>";
while ($results = mysql_fetch_array($perssearch)):

	
		$name_parts = htmlspecialchars(($results['persterm']), ENT_QUOTES);
		$name_part = explode(" | ", $name_parts);
		echo "<tr><td>".$results['id']."</td><td>".$name_part[0]."</td></tr>";
		$id = $results['id'];
		$family_name = $name_part[0];


$sql_str="UPDATE cms_auth_pers SET family_name='$family_name' WHERE id='$id' LIMIT 1";

mysql_query($sql_str) or die ("Update person failed!");
	

	endwhile;
	
 echo "</table>";

		
?>