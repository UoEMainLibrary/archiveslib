<?php include "../includes/header.php";
    include "../../mgt_config/sql.php";
		
		 $id_link = mysql_connect($hostname, $username, $password);

	if (!$id_link || !mysql_select_db($dbname)):

                echo '1:Connection to PHP has failed.';

                exit();

        endif;
	
	  include "../includes/lowerheader.php"; 
	  include "../includes/alumni_breadcrumbs.php";
		
		echo "<h1>Page from: Laureation &amp; Degrees Album</h1>";
		
		 $imgid = $_GET['id'];

	$sql_str="SELECT * FROM eua_students_ld WHERE image=$imgid";

	$imagesearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
		
		$results = mysql_fetch_array($imagesearch);
		
		echo "<img src='../dao/".$results['image'].".jpg' />";
			
		include "../includes/footer.php";?>