<?php include "../../mgt_config/sql.php";

$accpage_sql_str="SELECT * FROM cms_accessionsToPage ORDER BY year,number";
	 $accpagesearch = mysql_db_query($dbname, $accpage_sql_str, $id_link) or die("Search Failed!");
	 
	 echo "<textarea>";
	 
	 while ($accpageresults = mysql_fetch_array($accpagesearch)):
	 
	 $year = $accpageresults['year'];
	 $number = $accpageresults['number'];



$accsm_sql_str="SELECT * FROM cms_accessionsToShelfmarks WHERE year='$year' AND number='$number'";
echo $accpageresults['year'].",".$accpageresults['number'].$accpageresults['suffix'].",".$accpageresults['image_file'].",";

	 $accsmsearch = mysql_db_query($dbname, $accsm_sql_str, $id_link) or die("Search Failed!");
while ($accsmresults = mysql_fetch_array($accsmsearch)):

if ($accsmresults['sm_prefix'] <>'') {
echo $accsmresults['sm_prefix'].".".$accsmresults['sm_1'].$accsmresults['sm_2'].$accsmresults['sm_suffix']." ";
}
endwhile;

echo "\r\n";

endwhile;

echo "</textarea>";


?>