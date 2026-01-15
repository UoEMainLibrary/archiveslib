<?php
// define path to file containing connection details
include "../../mgt_config/sql.php";


//  define database name
// $dbname= "speccoll";

// connect to database
        $id_link = mysql_connect($hostname, $username, $password);

        if (!$id_link || !mysql_select_db($dbname)):
                echo '<p>Error!</p>';
                echo 'Connection to database has failed.  This is most likely due to a temporary server problem.';
                exit();
        endif; 
				
// define 'view' variable				
	$view = $_GET['view'];

// if $view is unset, show the search form 	
	if (!isset($view)) {
	$pagetitle = "Search";	
 include "includes/header.php";  
 echo "<h1>".$pagetitle."</h1>";
 
// echo "<img src='http://www.johnson-marshall.lib.ed.ac.uk/graphics/homess.jpg' alt='London County Council: 200,000 Homes' align='right' width='150' />";
 
// echo "<p>Search for books and journals in Percy Johnson-Marshall's library.  Not all have been retained.  However, where any have been disposed of, this will be stated and there will be an alternative copy of the same item within existing Edinburgh University Library stock.</p>";
 
######################################################
#                                                    #
# The search form contains 2 boxes where users can   #
# enter title and/or author details.  Instructions   #
# are given ragarding how to use them.               #
#                                                    #
######################################################
 
 echo "<form action='".$_SERVER['PHP_SELF']."' method='GET'>";
 
 echo "<input type='hidden' name='view' value='results' />";
 echo "<table summary='search form' cellpadding='5' style='margin-left: 150px'>";
 echo "<tr><td class='label'>Title</td><td><input type='text' name='title' /></td><td>Complete or part title</td></tr>";
 echo "<tr><td class='label'>Author</td><td><input type='text' name='author' /></td><td>All or part of an author's name (books only)</td></tr>";
 echo "<tr><td><input type='submit' value='Search' /></td></tr>";
 echo "</table>";
 echo "</form>";
 

		}
		
// VIEW: show results lists	
	elseif ($view == 'results') {	
		$title = $_GET['title'];
	  $author = $_GET['author'];
		

	$pagetitle = "Search Results";
include "includes/header.php"; 
 echo "<h1>".$pagetitle."</h1>";
 
 echo "<table cellpadding='5' style='margin-left: 150px'>";
 
 ## Checks whether the author box on the search form was used. ##
  
 if ($author >'') { $show_books = "y"; }
 elseif ($title >'') {$show_books = "y"; $show_journals = "y"; }
 
 if ($show_books == "y") {
 
 ## Query the pjm_books table for matching author/title ##
 		
	$sql_str="SELECT * FROM pjm_books_books WHERE author LIKE '%$author%' AND title LIKE '%$title%'";
	$booksearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
  echo "<tr><td><b>Books</b></td>";
	 echo "<td>Your search returned ".mysql_num_rows($booksearch)." results.</td>";
	 
 if (mysql_num_rows($booksearch)>0) {
 echo "<form action='".$_SERVER['PHP_SELF']."' method='GET'>";
 echo "<input type='hidden' name='view' value='bookresults' />";
 echo "<input type='hidden' name='title' value='".$title."' />";
 echo "<input type='hidden' name='author' value='".$author."' />";
 echo "<td><input type='submit' value='View' /></td>";
 echo "</form>";
 }
 
 echo "</tr>";
	}
	
 if ($show_journals == "y") { 
	$sql_str2="SELECT * FROM pjm_journals_journals WHERE title LIKE '%$title%'";
	$journalsearch = mysql_db_query($dbname, $sql_str2, $id_link) or die("Select Failed!");
	
	 echo "<tr><td><b>Journals</b></td>";
	 echo "<td>Your search returned ".mysql_num_rows($journalsearch)." results.</td>";
	 
 if (mysql_num_rows($journalsearch)>0) {
 echo "<form action='".$_SERVER['PHP_SELF']."' method='GET'>"; 
 echo "<input type='hidden' name='view' value='journalresults' />";
 echo "<input type='hidden' name='title' value='".$title."' />";
 echo "<td><input type='submit' value='View' /></td>";
 echo "</form>";
 }
 
 echo "</tr>";
  }
echo "</table>";
	}

// VIEW: show results list for books	
	elseif ($view == 'bookresults') {	
	$title = $_GET['title'];
	$author = $_GET['author'];
$pagetitle = "Search Results";
include "includes/header.php"; 
 echo "<h1>".$pagetitle."</h1>";
	
		$sql_str="SELECT * FROM pjm_books_books WHERE author LIKE '%$author%' AND title LIKE '%$title%' ORDER BY title ASC";
	$booksearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
 echo "Your search returned ".mysql_num_rows($booksearch)." results.</p>";

echo "<table cellpadding='5' border='1' width='100%'>";
echo "<thead><th class='label' width='200'>Author</th><th class='label'>Title</th><th class='label' width='50'>Date</th></thead>";

	while ($results = mysql_fetch_array($booksearch)):
	echo "<tr><td valign='top'>".$results['author']."</td><td valign='top'><a href='".$_SERVER['PHP_SELF'] ."?view=singlebook&amp;id=".$results['id']."'>".$results['title']."</a></td><td valign='top'>".$results['publication_date']."&nbsp;</td></tr>";
	endwhile;

echo "</table>";
}

// VIEW: show results list for journals
	elseif ($view == 'journalresults') {
	$title = $_GET['title'];	

	$sql_str="SELECT * FROM pjm_journals_journals WHERE title LIKE '%$title%' ORDER BY title ASC";
	$journalsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
$pagetitle = "Search Results";
include "includes/header.php"; 
 echo "<h1>".$pagetitle."</h1>";

echo "<ul style='margin-left: 150px'>";
	while ($results = mysql_fetch_array($journalsearch)):
	echo "<li><b><a href='".$_SERVER['PHP_SELF']."?view=singlejournal&amp;id=".$results['id']."'>".$results['title']."</a></b>";
	$journalid = $results['id'];
	echo "<ul style='margin-left: 50px'>";
	
	$sql_str2="SELECT * FROM pjm_journals_issues WHERE journalid = '$journalid'";
	$journalsearch2 = mysql_db_query($dbname, $sql_str2, $id_link) or die("Select Failed!");
	while ($results2 = mysql_fetch_array($journalsearch2)):
	echo "<li><a href='".$_SERVER['PHP_SELF'] ."?view=singleissue&amp;id=".$results2['id']."&amp;journalid=".$journalid."'>".$results2['edition']."</a></li>";
	endwhile;
	echo "</ul></li>";
	endwhile;
echo "</ul>";		
	
	}

// VIEW: show detail for a single book
		elseif ($view == 'singlebook') {	
		$id=$_GET['id'];
				$sql_str="SELECT * FROM pjm_books_books WHERE id='$id'";
	$booksearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");

$results = mysql_fetch_array($booksearch);

$pagetitle = $results['title'];

include "includes/header.php";

echo "<h1>".$results['title']."</h1>"; 

echo "<table cellpadding='5' border='1' width='100%'>";
	
	echo "<tr><td class='label' width='200'>Title</td><td valign='top'>".$results['title']."&nbsp;</td></tr>";
	
	echo "<tr><td class='label' width='200'>Author</td><td valign='top'>".$results['author']."&nbsp;</td></tr>";

if ($results['series'] <>'') {	
	echo "<tr><td class='label' width='200'>Series</td><td valign='top'>".$results['series']."&nbsp;</td></tr>";
}

if ($results['edition'] <>'') {
	echo "<tr><td class='label' width='200'>Edition</td><td valign='top'>".$results['edition']."&nbsp;</td></tr>";
}

	echo "<tr><td class='label' width='200'>Publisher</td><td valign='top'>".$results['publisher']."&nbsp;</td></tr>";

	echo "<tr><td class='label' width='200'> Place of Publication</td><td valign='top'>".$results['publication_place']."&nbsp;</td></tr>";

if ($results['isbn'] <>'') {
	echo "<tr><td class='label' width='200'>ISBN</td><td valign='top'>".$results['isbn']."&nbsp;</td></tr>";
}

	echo "<tr><td class='label' width='200'>Date of publication</td><td valign='top'>".$results['publication_date']."&nbsp;</td></tr>";

if ($results['archival_retention'] <>'') {
	echo "<tr><td class='label' width='200'>Archival reason for retention</td><td valign='top'>".$results['archival_retention']."&nbsp;</td></tr>";

}

if ($results['archival_series'] <>'') {
	echo "<tr><td class='label' width='200'>Related archival series</td><td valign='top'>".$results['archival_series']."&nbsp;</td></tr>";
}

if ($results['notes'] <>'') {
	echo "<tr><td class='label' width='200'>Notes</td><td valign='top'>".$results['notes']."&nbsp;</td></tr>";
}

if ($results['retained'] == '1') {
	echo "<tr><td class='label' width='200'>Retained</td><td valign='top'>This item has been appraised and retained</td></tr>";
}

if ($results['removed'] == '1') {
	echo "<tr><td class='label' width='200'>Disposal</td><td valign='top'>Duplicate copies have been discarded.</td></tr>";
}

if ($results['eul'] == '1') {
	echo "<tr><td class='label' width='200'>Alternative copy</td><td valign='top'>A copy of this item is in our general collections.  Please use the main <a href='http://catalogue.lib.ed.ac.uk/'>Library Catalogue</a> to locate it. [ EUL MARC id: ".$results['eulmarc']." ]</td></tr>";
}

	echo "<tr><td class='label' width='200'>Shelfmark</td><td valign='top'><a href='".$_SERVER['PHP_SELF']."?view=crate&amp;crate=".$results['crate']."'>PJM crate ".$results['crate']."</a></td></tr>";

echo "</table>";	

	}
	
	// VIEW: show single journal with list of issues
	elseif ($view == 'singlejournal') {
	$id = $_GET['id'];	

	$sql_str="SELECT * FROM pjm_journals_journals WHERE id = '$id'";
	$journalsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
	$results = mysql_fetch_array($journalsearch);
	
$pagetitle = $results['title'];
include "includes/header.php"; 
 echo "<h1>".$pagetitle."</h1>";

 $journalid = $_GET['id'];
	
	$sql_str2="SELECT * FROM pjm_journals_issues WHERE journalid = '$journalid'";
	$issuesearch = mysql_db_query($dbname, $sql_str2, $id_link) or die("Select Failed!");
	echo "<ul style='margin-left: 150px'>";
	while ($results2 = mysql_fetch_array($issuesearch)):
	echo "<li><a href='".$_SERVER['PHP_SELF'] ."?view=singleissue&amp;id=".$results2['id']."&amp;journalid=".$journalid."'>".$results2['edition']."</a></li>";
	endwhile;
	echo "</ul>";		
	
	}
	
	// VIEW: show detail for a single journal issue
		elseif ($view == 'singleissue') {	
		$id=$_GET['id'];
		$journalid=$_GET['journalid'];
		
				$sql_str="SELECT * FROM pjm_journals_issues WHERE id='$id'";
	$issuesearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");

  $results = mysql_fetch_array($issuesearch);
	
	
	$sql_str2="SELECT * FROM pjm_journals_journals WHERE id='$journalid'";
	$journalsearch = mysql_db_query($dbname, $sql_str2, $id_link) or die("Select Failed!");
	$results2 = mysql_fetch_array($journalsearch);

$pagetitle = $results2['title'];

include "includes/header.php";

echo "<h1>".$pagetitle."</h1>"; 

echo "<table cellpadding='5' border='0' width='100%'>";
	
	echo "<tr><td class='label' width='200'>Edition</td><td valign='top'>".$results['edition']."&nbsp;</td></tr>";
	
if ($results['archiveretain'] <>'') {
	echo "<tr><td class='label' width='200'>Archival reason for retention</td><td valign='top'>".$results['archiveretain']."&nbsp;</td></tr>";
}

if ($results['archival_series'] <>'') {	
	echo "<tr><td class='label' width='200'>Archival series</td><td valign='top'>".$results['series']."&nbsp;</td></tr>";
}

if ($results['removed'] == '1') {		
	echo "<tr><td class='label' width='200'>Disposal</td><td valign='top'>This has been disposed of.</td></tr>";
}
	
if ($results['notes'] <>'') {
	echo "<tr><td class='label' width='200'>Notes</td><td valign='top'>".$results['notes']."&nbsp;</td></tr>";
}

	echo "<tr><td class='label' width='200'>Shelfmark</td><td valign='top'><a href='".$_SERVER['PHP_SELF']."?view=crate&amp;crate=".$results['crate']."'>PJM crate ".$results['crate']."</a></td></tr>";

echo "<tr><td></td><td><a href='".$_SERVER['PHP_SELF']."?view=singlejournal&amp;id=".$results['journalid']."'>View all issues of this journal</a></td></tr>";

echo "</table>";	

	}

// VIEW: show all contents of a given crate
	elseif ($view == 'crate') {	
	$crate = $_GET['crate'];
	$next = ($crate+1);
	$previous = ($crate-1);
	
	$crate_str="SELECT * FROM pjm_crates WHERE id LIKE '$crate'";
	$cratesearch = mysql_db_query($dbname, $crate_str, $id_link) or die("Select Failed!");
	$crates = mysql_fetch_array($cratesearch);
	$cratename = $crates['name'];
$pagetitle = "Crate ".$crate." : ".$cratename;
	
include "includes/header.php"; 

 echo "<h1>".$pagetitle."</h1>";
 
 if ($previous > 0) { echo "<a href='".$_SERVER['PHP_SELF']."?view=crate&amp;crate=".$previous."'>Previous crate</a>"; } else { echo "Previous crate"; }
 
 echo " | <a href='".$_SERVER['PHP_SELF']."?view=crate&amp;crate=".$next."'>Next crate</a>";

	$sql_str="SELECT * FROM pjm_books_books WHERE crate LIKE '$crate'ORDER BY title ASC";
	$booksearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");

	if (mysql_numrows($booksearch)>0){ 
 echo "<h2>Books</h2>";
echo "<table cellpadding='5' border='1' width='100%'>";
echo "<thead><th class='label' width='200'>Author</th><th class='label'>Title</th><th class='label' width='50'>Date</th></thead>";
	while ($results = mysql_fetch_array($booksearch)):
	echo "<tr><td valign='top'>".$results['author']."</td><td valign='top'><a href='".$_SERVER['PHP_SELF'] ."?view=singlebook&amp;id=".$results['id']."'>".$results['title']."</a></td><td valign='top'>".$results['publication_date']."&nbsp;</td></tr>";
	endwhile;
echo "</table>";	
}
 
 
 	$sql_str="SELECT * FROM pjm_journals_issues WHERE crate = '$crate'";
	$issuesearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
	if (mysql_numrows($issuesearch)>0){
	echo "<h2>Journals</h2>";
	echo "<table cellpadding='5' border='1' width='100%'>";
	echo "<thead><th class='label' width='450'>Title</th><th class='label'>Issue</th></thead>";
	while ($results = mysql_fetch_array($issuesearch)):
	
	$journalid = $results['journalid'];
	
	$sql_str2="SELECT * FROM pjm_journals_journals WHERE id = '$journalid'";
	$journalsearch = mysql_db_query($dbname, $sql_str2, $id_link) or die("Select Failed!");
	$results2 = mysql_fetch_array($journalsearch);
	
	echo "<tr><td>".$results2['title']."</td><td><a href='".$_SERVER['PHP_SELF'] ."?view=singleissue&amp;id=".$results['id']."&amp;journalid=".$journalid."'>".$results['edition']."</a></td></tr>";
	endwhile;
	echo "</table>";	
 	}
	}
	
 include "includes/footer.php";