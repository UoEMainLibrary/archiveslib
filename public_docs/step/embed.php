<? include "/data/d4/archives/mgt_config/sql.php"; 

$id_link = mysql_connect($hostname, $username, $password);

 if (!$id_link || !mysql_select_db($dbname)):

 echo '1:Connection to PHP has failed.';

 exit();

 endif;
				
		$view = $_GET['view'];
		$author = $_GET['author'];
		$title = $_GET['title'];
		$id = $_GET['id'];
		$subject = $_GET['subject'];
?> 


<table summary="banner" width="100%" cellpadding="7" cellspacing="0">
<tr><td width="100%"><h1>STEP @ Edinburgh University Library</h1></td></tr>
<tr><td><a href="<? echo $_SERVER['PHP_SELF'] ?>">Home/Search</a></td></tr>
</table>
<hr />

<? 	
		
		
if (!isset ($view)) { ?>
<table summary="" width="100%" cellpadding="5">
<tr><td width="50%" valign="top">
<b>Introduction:</b>
<p>The Scottish Travellers' Education Programme (STEP) collection is held by <a href="http://www.lib.ed.ac.uk/speccoll/">Edinburgh University Library Special Collections</a> .  It is made up of books, pamphlets, reports and other material relating to Gypsy and Traveller communities.</p>


<b>Catalogue:</b>

<form action="<? echo $_SERVER['PHP_SELF'] ?>" method="GET">
<input type="hidden" name="view" value="results" />
<table summary="search form" width="300">
<tr><td class="label">Author</td><td><input type="text" name="author" size="50" /></td></tr>
<tr><td class="label">Title</td><td><input type="text" name="title" size="50" /></td></tr>
<tr><td class="title"></td><td align="right"><input type="reset" value="Clear" /><input type="submit" value="Search" /></td></tr>
</table>
</form>

<b>Search tips:</b>

<ul>
<li>Author: Enter all or part of an person's surname</li>
<li>Author:Enter all or part of an organisation's name</li>
<li>Title: Enter a word or phrase from a title</li>
</ul>



</td><td width="50%" valign="top">

<b>Access:</b>
<p>Once you have found what you are looking for in the catalogue, please <a href="http://www.lib.ed.ac.uk/speccoll/contact.shtml">contact Special Collections</a> to arrange for access.  Consultation will take place in the Special Collections Reading Room.</p>

<hr />

<b>Note:</b>

<p>This is not the final version of this catalogue.  This interface has simply been created to allow interim access to the collection. Further work, including editing, still needs to be done.</p>

<hr />

<b>Links:</b>
<br /><br />
<ul>
<li><a href="http://www.scottishtravellered.net/">STEP</a><br /><br /></li>
<li><a href="http://www.education.ed.ac.uk/es/">The Moray House School of Education: Educational Studies</a></li>
</ul>


</td></tr>
</table>
<?

}

elseif ($view == "results") {

$sql_str="SELECT * FROM step_data WHERE title LIKE '%$title%' AND author LIKE '%$author%' ORDER BY author ASC";

	$fullsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
	
	echo "<h2>Search Results</h2>";
	echo "<table align='center' width='90%' cellspacing='0' cellpadding='3' border='1'>";
	echo "<thead><th width='200'>Author</th><th colspan='2'>Title</th></thead>";
	while ($results = mysql_fetch_array($fullsearch)): 
	echo "<tr><td valign='top'>".$results['author']."</td><td valign='top'>".$results['title']."&nbsp;</td><td><a href='".$_SERVER['PHP_SELF']."?view=individual&amp;id=".$results['id']."'>More</a></td></tr>"; 
	endwhile;
	echo "</table>";
	}
	
	elseif ($view == 'individual') {
	
	$sql_str="SELECT * FROM step_data WHERE id = '$id'";

	$individualsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
	
	$results = mysql_fetch_array($individualsearch);
	
	echo "<h2>Individual record</h2>";
	echo "<table align='center' width='90%' cellspacing='0' cellpadding='3' border='0'>";
	echo "<tr><td class='label' width='150'>Shelfmark</td><td>STEP: ".$results['id']."</td></tr>";
	echo "<tr><td class='label' width='150'>Author</td><td>".$results['author']."</td></tr>";
	echo "<tr><td class='label' width='150'>Title</td><td>".$results['title']."</td></tr>";
	echo "<tr><td class='label' width='150'>Published</td><td>".$results['date']."</td></tr>";
	echo "<tr><td class='label' width='150'>Publisher</td><td>".$results['publisher']."</td></tr>";
	echo "<tr><td class='label' width='150' valign='top'>Subject(s)</td><td><a href='".$_SERVER['PHP_SELF']."?view=subject&amp;subject=".$results['subject1']."'>".$results['subject1']."</a> <a href='".$_SERVER['PHP_SELF']."?view=subject&amp;subject=".$results['subject2']."'>".$results['subject2']."</a> <a href='".$_SERVER['PHP_SELF']."?view=subject&amp;subject=".$results['subject3']."'>".$results['subject3']."</a> <a href='".$_SERVER['PHP_SELF']."?view=subject&amp;subject=".$results['subject4']."'>".$results['subject4']."</a> <a href='".$_SERVER['PHP_SELF']."?view=subject&amp;subject=".$results['subject5']."'>".$results['subject5']."</a> <a href='".$_SERVER['PHP_SELF']."?view=subject&amp;subject=".$results['subject6']."'>".$results['subject6']."</a></td></tr>";
	echo "</table>";
	
	}
	
	if ($view == "subject") {

$sql_str="SELECT * FROM step_data WHERE subject1 LIKE '$subject' OR subject2 LIKE '$subject' OR subject3 LIKE '$subject' OR subject4 LIKE '$subject' OR subject5 LIKE '$subject' OR subject6 LIKE '$subject' ORDER BY author ASC";

	$subsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
	
	echo "<h2>Subject: ".$subject."</h2>";
	echo "<table align='center' width='90%' cellspacing='0' cellpadding='3' border='1'>";
	echo "<thead><th width='200'>Author</th><th colspan='2'>Title</th></thead>";
	while ($results = mysql_fetch_array($subsearch)): 
	echo "<tr><td valign='top'>".$results['author']."&nbsp;</td><td valign='top'>".$results['title']."&nbsp;</td><td><a href='".$_SERVER['PHP_SELF']."?view=individual&amp;id=".$results['id']."'>More</a></td></tr>"; 
	endwhile;
	echo "</table>";
	}
	?>
	<br />
    <hr />

