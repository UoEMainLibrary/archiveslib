<?php 
#  Lets get all pre 1997 accessions and create skeleton records for them
$acc_sql_str="SELECT DISTINCT year, number, suffix FROM cms_accessionsToPage WHERE year<1997";
	 
	 $accsearch = mysql_db_query($dbname, $acc_sql_str, $id_link) or die("Search Failed!");
	
	  
	 echo "<table border='1' cellpadding='5' width='100%'>";
	 
	 while ($accresults = mysql_fetch_array($accsearch)):
	 $year = $accresults['year'];
	 
	 $number = $accresults['number'];
	 
	 $suffix = $accresults['suffix'];
	 
	 echo "<tr><td>".$year."</td><td>".$number."</td><td>".$suffix."</td><td>This is a skeleton record.  Detail can be found in the digitised MSS Accession Register</td><td>";
	 
	
	
			$accpage_sql_str="SELECT * FROM cms_accessionsToPage WHERE year LIKE '$year' AND number LIKE '$number'";
	 		$accpagesearch = mysql_db_query($dbname, $accpage_sql_str, $id_link) or die("Search Failed!");

			while ($accpageresults = mysql_fetch_array($accpagesearch)):

			echo $accpageresults['image_file'].", ";

			endwhile;
	
	
	 
	 echo "</td></tr>";
	 
	 endwhile;
	 echo "</table>";
	 
	 ?>