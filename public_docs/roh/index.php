<?php include "../includes/header.php"; ?>
<title>University Archives: Roll of Honour for World War 2</title>
<?php include "../includes/lowerheader.php"; ?>
<div><a href="/">Special Collections : Archives Catalogues &amp; Resources</a></div>
<?php include "/data/d4/archives/cmsys/mysql_link.php"; 
echo "<h1>University Archives: Roll of Honour for World War 2</h1>";





$view=$_GET['view'];
$surname=$_GET['surname'];

if (!isset($view)) { ?>

<p>Staff and students who lost their lives during the Second World War.<p>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
<input name="view" type="hidden" value="results" />
<table>
<tr><td>Surname</td><td><input name="surname" type="text" /></td><td><input name="" type="submit" value="Search" /></td></tr>
</table>

</form>
	  
<?	  }
	  elseif ($view == "results") {
	  
	  echo "<p><a href='./'>Search Again</a><p>";
	  
	  echo "<h2>Results</h2>";
	  
	  
	  
	   $sql_str="SELECT * FROM eua_rohww2 WHERE surname LIKE '$surname%' ORDER BY surname ASC";
	  
	  $perssearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	  
	  
	  while ($results = mysql_fetch_array($perssearch)):
	  echo "<table width='100%' border='0' cellpadding='10'>";
	  
	  echo "<tr><td style='font-weight:bold;' width='150'>Surname</td><td>".$results['surname']."</td><td rowspan='8' align='right'><img src='".$results['image']."' /></td></tr>";
	  
	  echo "<tr><td style='font-weight:bold;'>Forenames</td><td>".$results['forenames']."</td></tr>";
	  
	  echo "<tr><td style='font-weight:bold;'>Born</td><td>".$results['dob']."</td></tr>";
	  
	  echo "<tr><td style='font-weight:bold;'>Died</td><td>".$results['death']."</td></tr>";
	  
	  echo "<tr><td style='font-weight:bold;'>Place of origin</td><td>".$results['origin']."</td></tr>";
	  
	  echo "<tr><td style='font-weight:bold;'>Academic Record</td><td>".$results['academicRecord']."</td></tr>";
	  
	  echo "<tr><td style='font-weight:bold;'>War Record</td><td>".$results['warRecord']."</td></tr>";	
	  
	  echo "<tr><td style='font-weight:bold;'>Notes</td><td>".$results['notes']."</td></tr>";	
	  
	  echo "</table>";
	  echo "<br />";
	  
	  endwhile;
	  
	  
	  }
	  echo "<p><em>Data transcribed by Peter B. Freshwater. This resource is in development.</em></p>";
	    include "../includes/footer.php"; ?>