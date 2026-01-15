<?php include "../../mgt_config/sql.php";

	include "includes/top_header.php"; 
	echo "<title>Archives and Manuscripts Catalogue: The Collections</title>";
	include "includes/cat_header.php";
	
	$id = $_GET['id'];
$term = $_GET['term'];

$filter = $_GET['filter'];
	 ?>
	


 <style>
div.localContent {
margin-left:30px;
text-align:left;
}
 td {
 vertical-align:top;
 border-bottom:medium;
 border-bottom-color:#333366;
 border-bottom-style:inset;
 }
 td.toplabel{
 font-weight:bold;
 }
 span.<?php echo $filter ?>{
 background-color:#FFFF33;
 }
 </style>
<?php include "includes/lower_header.php"; ?>
<div class='localContent'>
<h1>Directory of Photographs</h1>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
<input name="func" type="hidden" value="results" />
<table width="500" border="1" cellspacing="5" cellpadding="5">
  <tr>
    <td>Search for:</td>
    <td><input name="term" type="text" value="<?php echo $term ?>" /> Tip! search for all or part of a word</td>
  </tr>
  <tr>
  <td></td>
    <td align="right"><input type="submit" value="Search" /> or browse by: <span class="students"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?func=filter&amp;filter=students">students</a></span>, <span class="staff"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?func=filter&amp;filter=staff">staff</a></span>, <span class="sports"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?func=filter&amp;filter=sports">sports</a></span>, <span class="campus"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?func=filter&amp;filter=campus">campus</a></span></td>
  </tr>
</table>
</form>
<br /><br />

<?php



if ($_GET['func'] == "results") {

 $sql_str="SELECT * FROM eua_photographs WHERE Description LIKE '%$term%' ORDER BY dateFrom ASC";


$photsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");



echo "<table border='0' cellpadding='5' width='100%'>";
 echo "<tr><td width='60%' class='toplabel'>Description</td><td class='toplabel'>Date</td><td>&nbsp;</td></tr>";
	 
	 while ($results = mysql_fetch_array($photsearch)):
	 
	 
	 
	 echo "<tr><td>".utf8_encode($results['Description'])."</td><td>".$results['dateFrom']." - ".$results['dateTo']."</td><td><a href='".$_SERVER['PHP_SELF']."?func=detail&amp;id=".$results['id']."'>Further details</a></td></tr>";
	 
	 endwhile;

echo "</table>";

}
elseif ($_GET['func'] == "filter") {

 $sql_str="SELECT * FROM eua_photographs WHERE uoe LIKE 'y' AND ".$filter." LIKE 'y' ORDER BY dateFrom ASC";


$photsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");



echo "<table border='0' cellpadding='5' width='100%'>";
 echo "<tr><td width='60%' class='toplabel'>Description</td><td class='toplabel'>Date</td><td>&nbsp;</td></tr>";
	 
	 while ($results = mysql_fetch_array($photsearch)):
	 
	 
	 
	 echo "<tr><td>".utf8_encode($results['Description'])."</td><td>".$results['dateFrom']." - ".$results['dateTo']."</td><td><a href='".$_SERVER['PHP_SELF']."?func=detail&amp;id=".$results['id']."'>Further details</a></td></tr>";
	 
	 endwhile;

echo "</table>";

}
elseif ($_GET['func'] == "detail") {

$sql_str="SELECT * FROM eua_photographs WHERE id LIKE '$id'";

$photsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");

$results = mysql_fetch_array($photsearch);

##echo $id;

echo "<table border='0' cellpadding='5' width='100%'>";

	 echo "<tr><td width='200' class='label'>Identifier</td><td><a href=''>".$results['Prefix'].$results['Number']."</a</td></tr>";

	 echo "<tr><td width='200' class='label'>Description</td><td>".utf8_encode($results['Description'])."</td></tr>";
	 
	 echo"<td class='label'>Dates</td><td>".$results['dateFrom']." - ".$results['dateTo']."</td></tr>";
	 
	 echo "<td class='label'>Type</td><td>".$results['type']."</td></tr>";
	 
	 echo"<td class='label'>Accession</td><td>".$results['Accession']."</td></tr>";
	 
	 echo "<td class='label'>Current location</td><td>".$results['Location']."</td></tr>";
	 
	 echo "<td class='label'>Students</td><td>".$results['students']."</td></tr>";
	 
	 echo "<td class='label'>Staff</td><td>".$results['staff']."</td></tr>";
	 
	 echo "<td class='label'>Sports</td><td>".$results['sports']."</td></tr>";
	 
	 echo "<td class='label'>Campus</td><td>".$results['campus']."</td></tr>";

echo "</table>";

}


echo "<p style='font-style:italic; margin-top:15px;'>This database contains unverified data complied from various legacy typescript lists and indexes.  It is being made available as an interim means of identifying key photographs and related items in our collections.  Please accept that there will be some typographical and other errors present.</p>";





echo "</div>";
 include "includes/footer.php";

?>
