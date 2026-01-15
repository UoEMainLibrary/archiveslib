<?php 	 $view = $_GET['view'];
   		 $subview = $_GET['subview'];
		 $imgid = isset($_GET['id']) ? $_GET['id'] : null;
		 $year = $_GET['year'];
		 $image = isset($_GET['image']) ? $_GET['image'] : null;

        //SR 16/09/2024 -commenting out as not set to anything		 
	//echo "<h2>".$pagetitle."</h2>";
	
	$sql_str="SELECT DISTINCT year FROM eua_students_ld WHERE year>0 ORDER BY year ASC";
	if (MYSQLIMODE) {
                $yearsearch = mysqli_query($id_link, $sql_str) or die("Select Failed!");
	} else {
        	$yearsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
	}
	echo "<form action='".$_SERVER['PHP_SELF'] ."' method='GET'>";
	echo "<input type='hidden' name='view' value='ld'/>";
	echo "<input type='hidden' name='subview' value='year'/>";
	echo "Select year to view: ";
	echo "<select name='year'>";
	echo "<option value='".$year."'>".$year."</option>";
        if (MYSQLIMODE) {
		while ($results = mysqli_fetch_array($yearsearch)) {
                         echo "<option value='".$results['year']."'>".$results['year']."</option>";
                         }
	} else {
		while ($results = mysql_fetch_array($yearsearch)) {	

			 }
	}
	echo "</select>"; 
	echo "<input type='submit' value='Go'/>";
	echo " | <a href='".$_SERVER['PHP_SELF'] ."'>Clear</a>";
	echo "</form>";
        echo "<br>";
	
	if (!isset($subview) || $year == '') {
	
	
	}
	elseif ($subview == "year") {
		 
		echo "<h3>Pages relating to the year ".$year."</h3>";

		$sql_str="SELECT * FROM eua_students_ld WHERE year LIKE '$year'";

        
        	if (MYSQLIMODE) {
                	$yearsearch = mysqli_query($id_link, $sql_str) or die("Select Failed!");
        	} else {
                	$yearsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
        	}
	
		echo "<ul>";
 
        	if (MYSQLIMODE) {
			while ($results = mysqli_fetch_array($yearsearch)) {		
				echo "<li><a href='".$_SERVER['PHP_SELF']."?view=ld&amp;subview=image&amp;image=".$results['image']."&amp;year=".$year."'>".$results['image']."</a></li>";		
			}
       	 	} else {
                	while ($results = mysql_fetch_array($yearsearch)) {
                		echo "<li><a href='".$_SERVER['PHP_SELF']."?view=ld&amp;subview=image&amp;image=".$results['image']."&amp;year=".$year."'>".$results['image']."</a></li>";
                	}
        	}
		echo "</ul><br>";
		
	}
        
	elseif ($subview == "image") {
	
		echo "<h3>Page relating to ".$year."</h3>";

		
		echo "<img src='../dao/".$image.".jpg' />";
		
##		$next = $image+1;
##		$prev = $image-1;
		
##		echo "<div><a href='".$_SERVER['PHP_SELF']."?view=ld&amp;subview=image&amp;image=".$prev."&amp;year=0'>&lt;&lt;&lt;</a> | ".$next."</div>";
		echo "<table summary='' cellpadding='5' width='100%'><tr>";
		echo "<td valign='top' width='50%'><h3>All years on this page</h3>";
		
		$sql_str="SELECT year FROM eua_students_ld WHERE image=$image ORDER BY year";

		if (MYSQLIMODE) {
                	$yearsearch = mysqli_query($id_link, $sql_str) or die("Select Failed!");
       		 } else {
                	$yearsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
        	}
                echo "<ul>";
		
	        if (MYSQLIMODE) {	
			while ($results = mysqli_fetch_array($yearsearch)) {		
				echo "<li><a href='".$_SERVER['PHP_SELF']."?view=ld&amp;subview=year&amp;year=".$results['year']."'>".$results['year']."</a></li>";		
			}
		} else {
			while ($results = mysql_fetch_array($yearsearch)) {
                		echo "<li><a href='".$_SERVER['PHP_SELF']."?view=ld&amp;subview=year&amp;year=".$results['year']."'>".$results['year']."</a></li>";
               		}
		}
		echo "</ul></td>";
		
		echo "<td valign='top' width='50%'><h3>All pages relating to ".$year."</h3>";
		
		$sql_str="SELECT image FROM eua_students_ld WHERE year=$year";

                if (MYSQLIMODE) {
                        $imagesearch = mysqli_query($id_link, $sql_str) or die("Select Failed!");
                } else {
                        $imagesearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
                }	
		echo "<ul>";

		if (MYSQLIMODE) {
			while ($results = mysqli_fetch_array($imagesearch)) {		
				echo "<li><a href='".$_SERVER['PHP_SELF']."?view=ld&amp;subview=image&amp;image=".$results['image']."&amp;year=".$year."'>".$results['image']."</a></li>";		
			}
		} else {
                	while ($results = mysql_fetch_array($imagesearch)) {
                		echo "<li><a href='".$_SERVER['PHP_SELF']."?view=ld&amp;subview=image&amp;image=".$results['image']."&amp;year=".$year."'>".$results['image']."</a></li>";
                	}
                }
		echo "</ul></td>";	
		echo "</tr></table>";		
	        echo "<br>";
	}
			
?>
