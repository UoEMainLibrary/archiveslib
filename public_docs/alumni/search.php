<?php include "../includes/header.php";
    include "../../mgt_config/sql.php";

 $id_link = mysql_connect($hostname, $username, $password);

  ## check the database can be accessed
	
	if (!$id_link || !mysql_select_db($dbname)):
	$pagetitle= "Error";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";

	echo 'Connection to database has failed.';
	include "../includes/footer.php";
  exit();
	endif;
	
include "parts/vars.php";

	if ($view == "results") {			
	$pagetitle = "Search Results";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php"; 
	include "parts/results.php";
	}	
				
	elseif ($view == "results1") {
	$pagetitle = $datatitle1.": Search Results";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/results1.php";		
	}
	
	elseif ($view == "results2") {
	$pagetitle = $datatitle2.": Search Results";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/results2.php";	
	}
	
		elseif ($view == "results3") {
	$pagetitle = $datatitle3.": Search Results";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/results3.php";	
	}
	
		elseif ($view == "results4") {
	$pagetitle = $datatitle4.": Search Results";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/results4.php";	
	}
	
		elseif ($view == "results5") {
	$pagetitle = $datatitle5.": Search Results";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/results5.php";	
	}
	
		elseif ($view == "results7") {
	$pagetitle = $datatitle7.": Search Results";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/results7.php";	
	}
	
		elseif ($view == "results8") {
	$pagetitle = $datatitle8.": Search Results";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/results8.php";	
	}
	
		elseif ($view == "results9") {
	$pagetitle = $datatitle9.": Search Results";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/results9.php";	
	}
	
	elseif ($view == "advanced") {
	$pagetitle = "Advanced Search";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/advanced.php";	
	}
	
	elseif ($view == "advanced1") {
	$pagetitle = $datatitle1.": Search";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/advanced1.php";	
	}
	
	elseif ($view == "advanced2") {
	$pagetitle = $datatitle2.": Search";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/advanced2.php";	
	}		
	
	elseif ($view == "advanced3") {
	$pagetitle = $datatitle3.": Search";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/advanced3.php";	
	}			
	
	elseif ($view == "advanced4") {
	$pagetitle = $datatitle4.": Search";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/advanced4.php";	
	}			
	
	elseif ($view == "advanced5") {
	$pagetitle = $datatitle5.": Search";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/advanced5.php";	
	}				
	
	elseif ($view == "advanced7") {
	$pagetitle = $datatitle7.": Search";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/advanced7.php";	
	}				
	
	elseif ($view == "advanced8") {
	$pagetitle = $datatitle8.": Search";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/advanced8.php";	
	}				
	
	elseif ($view == "advanced9") {
	$pagetitle = $datatitle9.": Search";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/advanced9.php";	
	}
	
	elseif ($view == "individual1") {
	$pagetitle = $datatitle1.": Individual Record";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/individual1.php";		
	}
	
	elseif ($view == "individual2") {
	$pagetitle = $datatitle2.": Individual Record";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/individual2.php";	
	}
	
	elseif ($view == "individual3") {
	$pagetitle = $datatitle3.": Individual Record";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/individual3.php";
	}
	
	elseif ($view == "individual4") {
	$pagetitle = $datatitle4.": Individual Record";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/individual4.php";	
	}
	
	elseif ($view == "individual5") {
	$pagetitle = $datatitle5.": Individual Record";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/individual5.php";	
	}	
	
	elseif ($view == "individual7") {
	$pagetitle = $datatitle7.": Individual Record";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/individual7.php";	
	}	
	
	elseif ($view == "individual8") {
	$pagetitle = $datatitle8.": Individual Record";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/individual8.php";	
	}	
	
	elseif ($view == "individual9") {
	$pagetitle = $datatitle9.": Individual Record";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/individual9.php";	
	}
	
	elseif ($view == "ld") {
	$pagetitle = "Laureation &amp; Degrees, 1587-1809";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";  
	include "parts/6.php";	
	}	
	
	elseif ($view == "sources") {
	$pagetitle = "Sources, Acknowledgements &amp; Coverage";
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	include "../includes/alumni_breadcrumbs.php";
	echo "<h1>Sources, Acknowledgements &amp; Coverage</h1>";  
	include "parts/sources.php";	
	}

	else {	
	$pagetitle = "Error";	
	include "parts/pagetitle.php";	
include "../includes/lowerheader.php";	
	echo "<p>No database selected</p>";	
	echo "<p>view is ".$view."</p>";
	}
	
		
	include "../includes/footer.php";		 ?>


