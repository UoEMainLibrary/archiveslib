<?php include "../includes/header.php"; ?>
<title>University Archives: Minutes of the Senatus Academicus 1733-1855</title>
<?php include "../includes/lowerheader.php"; ?>
<div><a href="/">Special Collections : Archives Catalogues &amp; Resources</a></div>
<?php include "/data/d4/archives/cmsys/mysql_link.php"; 
echo "<h1>University Archives: Minutes of the Senatus Academicus 1733-1855</h1>";

echo "<p>The beginning of the 17th Century saw the emergence of the Senatus Academicus (or 'The Principal and the Professors of the College of King James the Sixth'). At this time it contained the Principal of the College and 4 Regents. By 1760 The Senatus Academicus contained 18 professors besides the Principal. In the Universities (Scotland) Act of 1858 the governance of Edinburgh University passed from Edinburgh Town Council to the Senatus Academicus.<p>";

echo "<p>As such the Senatus minutes are the most comprehensive extant record of the business of the University during this period.</p>";

echo "<p>The first seven volumes of <a href='/catalogue/cs/viewcat.pl?id=GB-237-EUA-IN1-GOV-SEN-1&view=basic'>minutes</a> have a combined index which can be searched here.</p><br />";


$view=$_GET['view'];
$searchterm1=$_GET['searchterm1'];

if (!isset($view)) { ?>

<form action="<?php echo $SERVER['PHP_SELF'] ?>" method="GET">

<input type="hidden" name="view" value="search" />
<table summary="" width="100%">
<tr><td class="label">Search for: </td><td><input type="text" name="searchterm1" size="50" /></td></tr>
<tr><td class="label"></td><td><input type="submit" value="Search" /></td></tr>
</table>
</form>

<?php}

elseif ($view == "search") {


echo "<p><a href='./'>Search again</a></p>";

$sql_str1="SELECT * FROM euaSenatusIndex WHERE termAsWritten LIKE '%$searchterm1%' ORDER BY volume, page, pageSuffix";
	 
	  $idx_search = mysql_db_query($dbname, $sql_str1, $id_link) or die("Search Failed!");
	  
	  echo"<h2>Search Results</h2>";
	  
	  echo "<p>You searched for: <em>".$searchterm1."</em></p>";
	  
	  echo "<table border='1' width='100%'>";
	  
	  echo "<tr><td valign='top' width='350'><strong>Term</strong></td><td width='100'><strong>Volume</strong></td><td><strong>Page</strong></td><td valign='top' width='350'><strong>See (also)</strong></td></tr>";
	  
	  while ($results1 = mysql_fetch_array($idx_search)):
	  
	if ($results1['volume'] ==  '1') { $vol = "I"; $yearspan = "1733-1790"; }
	if ($results1['volume'] ==  '2') { $vol = "II"; $yearspan = "1790-1811"; }
	if ($results1['volume'] ==  '3') { $vol = "III"; $yearspan = "1812-1824"; }
	if ($results1['volume'] ==  '4') { $vol = "IV"; $yearspan = "1825-1829"; }
	if ($results1['volume'] ==  '5') { $vol = "V"; $yearspan = "1829-1837"; }
	if ($results1['volume'] ==  '6') { $vol = "VI"; $yearspan = "1838-1844"; }
	if ($results1['volume'] ==  '7') { $vol = "VII"; $yearspan = "1844-1855"; }
	

	  echo "<tr><td valign='top'>".$results1['termAsWritten']."</td><td>".$vol." (".$yearspan.")</td><td>".$results1['page'].$results1['pageSuffix']."</td><td>";
	  
	  if ($results1['crossReference'] <> $searchterm1 ) {
	  
	  echo "<a href='./?view=search&amp;searchterm1=".$results1['crossReference']."'>".$results1['crossReference'];
	  
	  }
	  
	  echo "</td></tr>";	
	  
	   
	  
	  endwhile;
	  
	  echo "</table>";

	   }
	   
	   echo "<p>You can also <a href='/catalogue/docs/euasenidx.pdf' target='_blank'>browse the entire index</a> (pdf)</p>";
	   
	   echo "<p>This resource is still in development</p>";
	    include "../includes/footer.php"; ?>