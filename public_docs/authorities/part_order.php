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
		
$sql_str="SELECT * FROM cms_auth_geog";
$termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
while ($results = mysql_fetch_array($termsearch)):
if ($results['suppress'] <>'y') {
$id = $results['id'];
if ($results['term'] <>'') { $term = "area,"; $endcomma1=""; } else { $term = '';  $endcomma1=","; }
if ($results['island'] <>'') { $island = "island,"; $endcomma2=""; } else { $island ='';  $endcomma2=","; }
if ($results['city'] <>'') { $city = "city,"; $endcomma3=""; } else { $city ='';  $endcomma3=","; }
if ($results['territory'] <>'') { $territory = "territory,"; $endcomma4=""; } else { $territory ='';  $endcomma4=","; }
if ($results['county'] <>'') { $county = "county,"; $endcomma5=""; } else { $county ='';  $endcomma5=","; }
if ($results['country'] <>'') { $country = "country,"; $endcomma6=""; } else { $country ='';  $endcomma6=","; }
if ($results['continent'] <>'') { $continent = "continent,"; $endcomma7=""; } else { $continent ='';  $endcomma7=","; }

$endcommas = $endcomma1.$endcomma2.$endcomma3.$endcomma4.$endcomma5.$endcomma6.$endcomma7;

##echo $results['term'].",".$results['island'].",".$results['city'].",".$results['territory'].",".$results['county'].",".$results['country'].",".$results['continent'].",".$results['part_order']."<br>";

$part_str1 = $term.$island.$city.$territory.$county.$country.$continent.$endcommas;
$part_str2 = substr($part_str1, 0, -1);
if ($part_str2 <>'area,,,,,,') {
echo $part_str2."<br>";
$sql_str="UPDATE cms_auth_geog SET part_order='$part_str2' WHERE id='$id' LIMIT 1";

mysql_query($sql_str) or die ("Update place failed!");
unset ($endcommas);
}
##else {
##echo "NULL<br>";
##}



}
endwhile;
	echo "Done";	
?>
</body>
</html>