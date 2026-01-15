<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <base href="http://collections.ed.ac.uk/alumni/">

    <title></title>

    <link rel="pingback" href="http://collections.ed.ac.uk/pingback" />

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
    Remove this if you use the .htaccess -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>University of Edinburgh Historical Alumni</title>

    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile viewport optimized: j.mp/bplateviewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
    <link rel="shortcut icon" href="http://collections.ed.ac.uk/theme/alumni/images/favicon.ico">
    <link rel="apple-touch-icon" href="http://collections.ed.ac.uk/theme/alumni/images/apple-touch-icon.png">

    <!-- CSS: implied media="all" -->
    <link rel="stylesheet" href="http://collections.ed.ac.uk/theme/alumni/css/style.css?v=2">
    <link rel="stylesheet" href="http://collections.ed.ac.uk/assets/fancybox/source/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
    <link rel="stylesheet" href="http://collections.ed.ac.uk/assets/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="http://collections.ed.ac.uk/assets/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <link rel="stylesheet" href="http://releases.flowplayer.org/6.0.4/skin/minimalist.css">
    <link rel="stylesheet" href="http://collections.ed.ac.uk/assets/font-awesome/css/font-awesome.min.css">

    <!-- Uncomment if you are specifically targeting less enabled mobile browsers
    <link rel="stylesheet" media="handheld" href="css/handheld.css?v=2">  -->

    <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
    <script src="http://collections.ed.ac.uk/assets/modernizr/modernizr-1.7.min.js"></script>
    <script src="http://collections.ed.ac.uk/assets/jquery-1.11.0/jquery-1.11.0.min.js"></script>
    <script src="http://collections.ed.ac.uk/assets/jquery-ui-1.10.4/ui/minified/jquery-ui.min.js"></script>
    <script src="http://collections.ed.ac.uk/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="http://collections.ed.ac.uk/assets/jquery-1.11.0/jcarousel/jquery.jcarousel.min.js"></script>
    <script src="http://www.google-analytics.com/analytics.js"></script>

    <!-- Google Analytics -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-25737241-9', 'auto');
        ga('send', 'pageview');

    </script>
    <!-- End Google Analytics -->

    <script src="http://releases.flowplayer.org/6.0.4/flowplayer.min.js"></script>

    <!-- global options -->
    <script>
        flowplayer.conf = {
            analytics: "UA-25737241-9"
        };
    </script>

    
</head>

<body>

<div id="container">

        <header>
            <div id="collection-title">
                <a href="http://www.ed.ac.uk" class="uoelogo" title="The University of Edinburgh Home" target="_blank"></a>
                <a href="http://collections.ed.ac.uk/alumni" class="logo" title="University of Edinburgh Historical Alumni Home"></a>
                <a href="http://collections.ed.ac.uk/alumni" class="menulogo" title="University of Edinburgh Historical Alumni  Home"></a>
            </div>
            <div id="collection-search">
                <form action="./redirect/" method="post">
                    <fieldset class="search">
                        <input type="text" name="q" value="" id="q" />
                        <input type="submit" name="submit_search" class="btn" value="Search" id="submit_search" />
                       <!-- <a href="./advanced" class="advanced">Advanced search</a>-->
                    </fieldset>
                </form>
            </div>
        </header>

        <div id="main" role="main" class="clearfix">

<div class="col-main">

<?php 	 $view = $_GET['view'];
   		 $subview = $_GET['subview'];
		 $imgid = $_GET['id'];
		 $year = $_GET['year'];
		 $image = $_GET['image'];
		 
	echo "<h2>".$pagetitle."</h2>";
	
	$sql_str="SELECT DISTINCT year FROM eua_students_ld WHERE year>0 ORDER BY year ASC";
	$yearsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
	echo "<form action='".$_SERVER['PHP_SELF'] ."' method='GET'>";
	echo "<input type='hidden' name='view' value='ld'/>";
	echo "<input type='hidden' name='subview' value='year'/>";
	echo "<a href='".$_SERVER['PHP_SELF'] ."?view=ld'>Start</a> | Select year to view: ";
	echo "<select name='year'>";
	echo "<option value='".$year."'>".$year."</option>";
	while ($results = mysql_fetch_array($yearsearch)) {	
		 echo "<option value='".$results['year']."'>".$results['year']."</option>";
		 }
	echo "</select>"; 
	echo "<input type='submit' value='Go'/>";
	echo "</form>";
	
	if (!isset($subview) || $year == '') {
	
	echo "<p>Please select a year above to navigate to relevant page(s) for that year</p><hr />";
	include "info/6.php";
	}
	elseif ($subview == "year") {
		 
		 echo "<h3>Pages relating to the year ".$year."</h3>";

	$sql_str="SELECT * FROM eua_students_ld WHERE year LIKE '$year'";

	$yearsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
	
		echo "<ul>";
		while ($results = mysql_fetch_array($yearsearch)) {		
		echo "<li><a href='".$_SERVER['PHP_SELF']."?view=ld&amp;subview=image&amp;image=".$results['image']."&amp;year=".$year."'>".$results['image']."</a></li>";		
		}
		echo "</ul>";
		
	}
	elseif ($subview == "image") {
	
			 echo "<h3>Page relating to ".$year."</h3>";

		
		echo "<img src='../dao/".$image.".jpg' />";
		
##		$next = $image+1;
##		$prev = $image-1;
		
##		echo "<div><a href='".$_SERVER['PHP_SELF']."?view=ld&amp;subview=image&amp;image=".$prev."&amp;year=0'>&lt;&lt;&lt;</a> | ".$next."</div>";
	echo "<table summary='' cellpadding='5' width='100%'><tr>";
		echo "<td valign='top' width='50%'><h3>All years on this page</h3>";
		
		$sql_str="SELECT year FROM eua_students_ld WHERE image=$image";

	$yearsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
	
		echo "<ul>";
		while ($results = mysql_fetch_array($yearsearch)) {		
		echo "<li><a href='".$_SERVER['PHP_SELF']."?view=ld&amp;subview=year&amp;year=".$results['year']."'>".$results['year']."</a></li>";		
		}
		echo "</ul></td>";
		
				echo "<td valign='top' width='50%'><h3>All pages relating to ".$year."</h3>";
		
		$sql_str="SELECT image FROM eua_students_ld WHERE year=$year";

	$imagesearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
	
		echo "<ul>";
		while ($results = mysql_fetch_array($imagesearch)) {		
		echo "<li><a href='".$_SERVER['PHP_SELF']."?view=ld&amp;subview=image&amp;image=".$results['image']."&amp;year=".$year."'>".$results['image']."</a></li>";		
		}
		echo "</ul></td>";	
		echo "</tr></table>";		
	
	}
			
?>


</div>
</div>
</body>
</html>
