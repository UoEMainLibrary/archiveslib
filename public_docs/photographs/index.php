<?php

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include "../../mgt_config/sql.php";

include "../includes/header.php";
echo "<title>Archives and Manuscripts: Directory of Photographs</title>";
if (MYSQLIMODE) {
	$id = mysqli_real_escape_string($_GET['id']);
	$term = mysqli_real_escape_string($_GET['term']);
	$filter = mysqli_real_escape_string($_GET['filter']);
	$prefix = mysqli_real_escape_string($_GET['prefix']);
	$number = mysqli_real_escape_string($_GET['number']);
} else {
	$id = mysql_real_escape_string($_GET['id']);
	//	$id = $_GET['id'];
	$term = mysql_real_escape_string($_GET['term']);
	//$term = $_GET['term'];

	$filter = mysql_real_escape_string($_GET['filter']);
	//$filter = $_GET['filter'];

	$prefix = mysql_real_escape_string($_GET['prefix']);
	//$prefix = $_GET['prefix'];

	$number = mysql_real_escape_string($_GET['number']);
	//$number = $_GET['number'];
}
?>



<style>
	td {
		vertical-align: top;
		border-bottom: thin;
		border-bottom-color: #333366;
		border-bottom-style: groove;
	}

	td.toplabel,
	td.label {
		font-weight: bold;
	}
</style>
<?php include "../includes/lowerheader.php"; ?>
<div><a href="/">Special Collections : Archives Catalogues &amp; Resources</a></div>
<div class='localContent'>
	<h1>Directory of Photographs</h1>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
		<input name="func" type="hidden" value="results" />
		<table width="650" border="1" cellspacing="5" cellpadding="5">
			<tr>
				<td width="120"><label for="searchTerm">Search for:</label></td>
				<td><input id="searchTerm" name="term" type="text" value="<?php echo $term ?>" /> Tip! search for all or part of a word
				</td>
			</tr>
			<tr>
				<td></td>
				<td align="right"><input type="submit" value="Search" /> or browse by: <a
						href="<?php echo $_SERVER['PHP_SELF'] ?>?func=filter&amp;filter=students">students</a>, <a
						href="<?php echo $_SERVER['PHP_SELF'] ?>?func=filter&amp;filter=staff">staff</a>, <a
						href="<?php echo $_SERVER['PHP_SELF'] ?>?func=filter&amp;filter=sports">sports</a>, <a
						href="<?php echo $_SERVER['PHP_SELF'] ?>?func=filter&amp;filter=campus">campus</a></td>
			</tr>
		</table>
	</form>

	<?php

	if ($_GET['func'] != "about") {
		echo "<div align='right'><a href='" . $_SERVER['PHP_SELF'] . "?func=about'>About this Resource</a></div>";
	}


	if ($_GET['func'] == "results") {

		$sql_str = "SELECT * FROM eua_photographs WHERE uoe LIKE 'y' AND Description LIKE '%$term%' ORDER BY dateFrom ASC";

		if (MYSQLIMODE) {
			$photsearch = mysqli_query($id_link, $sql_str) or die("Search Failed!");
		} else {
			$photsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
		}


		echo "<table border='0' cellpadding='5' width='100%'>";
		echo "<tr><td width='60%' class='toplabel'>Description</td><td class='toplabel'>Date</td><td class='toplabel'>Collection/Group</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
		if (MYSQLIMODE) {
			while ($results = mysqli_fetch_array($photsearch)):
				echo "<tr><td>" . $results['Description'] . "</td><td>" . $results['dateFrom'] . " - " . $results['dateTo'] . "</td><td>" . $results['Location'] . "</td><td><a href='" . $_SERVER['PHP_SELF'] . "?func=detail&amp;id=" . $results['id'] . "'>Further details</a></td></tr>";
			endwhile;
		} else {
			while ($results = mysql_fetch_array($photsearch)):
				echo "<tr><td>" . $results['Description'] . "</td><td>" . $results['dateFrom'] . " - " . $results['dateTo'] . "</td><td>" . $results['Location'] . "</td><td><a href='" . $_SERVER['PHP_SELF'] . "?func=detail&amp;id=" . $results['id'] . "'>Further details</a></td></tr>";
			endwhile;
		}

		echo "</table>";

	} elseif ($_GET['func'] == "filter") {

		$sql_str = "SELECT * FROM eua_photographs WHERE uoe LIKE 'y' AND " . $filter . " LIKE 'y' ORDER BY dateFrom ASC";

		if (MYSQLIMODE) {
			$photsearch = mysqli_query($id_link, $sql_str) or die("Search Failed!");
		} else {
			$photsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
		}
		echo "<p style='font-weight:bold'>Browse filter: " . $filter . "</p>";

		echo "<table border='0' cellpadding='5' width='100%'>";
		echo "<tr><td width='60%' class='toplabel'>Description</td><td class='toplabel'>Date</td><td>&nbsp;</td></tr>";
		if (MYSQLIMODE) {
			while ($results = mysqli_fetch_array($photsearch)):
				echo "<tr><td>" . utf8_encode($results['Description']) . "</td><td>" . $results['dateFrom'] . " - " . $results['dateTo'] . "</td><td><a href='" . $_SERVER['PHP_SELF'] . "?func=detail&amp;id=" . $results['id'] . "'>Further details</a></td></tr>";
			endwhile;
		} else {
			while ($results = mysql_fetch_array($photsearch)):
				echo "<tr><td>" . utf8_encode($results['Description']) . "</td><td>" . $results['dateFrom'] . " - " . $results['dateTo'] . "</td><td><a href='" . $_SERVER['PHP_SELF'] . "?func=detail&amp;id=" . $results['id'] . "'>Further details</a></td></tr>";
			endwhile;
		}
		echo "</table>";

	} elseif ($_GET['func'] == "related") {

		$sql_str = "SELECT * FROM eua_photographs WHERE Prefix LIKE '$prefix' AND Number LIKE '$number' ORDER BY dateFrom ASC";

		if (MYSQLIMODE) {
			$photsearch = mysqli_query($id_link, $sql_str) or die("Search Failed!");
		} else {
			$photsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
		}
		echo "<p style='font-weight:bold'>ID: " . $prefix . $number . "</p>";

		echo "<table border='0' cellpadding='5' width='100%'>";
		echo "<tr><td width='60%' class='toplabel'>Description</td><td class='toplabel'>Date</td><td>&nbsp;</td></tr>";

		if (MYSQLIMODE) {
			while ($results = mysqli_fetch_array($photsearch)):
				echo "<tr><td>" . utf8_encode($results['Description']) . "</td><td>" . $results['dateFrom'] . " - " . $results['dateTo'] . "</td><td><a href='" . $_SERVER['PHP_SELF'] . "?func=detail&amp;id=" . $results['id'] . "'>Further details</a></td></tr>";
			endwhile;
		} else {
			while ($results = mysql_fetch_array($photsearch)):
				echo "<tr><td>" . utf8_encode($results['Description']) . "</td><td>" . $results['dateFrom'] . " - " . $results['dateTo'] . "</td><td><a href='" . $_SERVER['PHP_SELF'] . "?func=detail&amp;id=" . $results['id'] . "'>Further details</a></td></tr>";
			endwhile;
		}
		echo "</table>";

	} elseif ($_GET['func'] == "detail") {

		$sql_str = "SELECT * FROM eua_photographs WHERE id LIKE '$id'";

		if (MYSQLIMODE) {
			$photsearch = mysqli_query($id_link, $sql_str) or die("Search Failed!");
			$results = mysqli_fetch_array($photsearch);
		} else {
			$photsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
			$results = mysql_fetch_array($photsearch);
		}

		##echo $id;
	
		echo "<table border='0' cellpadding='5' width='100%'>";

		echo "<tr><td width='200' class='label'>Identifier</td><td><a href='" . $_SERVER['PHP_SELF'] . "?func=related&amp;prefix=" . $results['Prefix'] . "&amp;number=" . $results['Number'] . "'>" . $results['Prefix'] . $results['Number'] . "</a> (click to see any related items sharing this identifier)</td></tr>";

		echo "<tr><td width='200' class='label'>Description</td><td>" . $results['Description'] . "</td></tr>";

		echo "<td class='label'>Dates</td><td>" . $results['dateFrom'] . " - " . $results['dateTo'] . "</td></tr>";

		echo "<td class='label'>Accession</td><td>" . $results['Accession'] . "</td></tr>";

		echo "<td class='label'>Current location</td><td>" . $results['Location'] . "</td></tr>";

		echo "</table>";

	} elseif ($_GET['func'] == "about") {

		echo "<h2>About this Resource</h2>";

		echo "<p>Photographs in our collections tend to be either fully integral to their parent collection or be shelved separately in a dedicated space.  As such it is not always obvious where to look, particularly when trying to locate phoographs of or relating to the University.  This resource is designed to be a shortcut to locating such photographs.  Drawn from various pre-existing lists and indexes, and other off-line finding aids.</p>";

		echo "<p>The intention is not for this to be a comprehensive record of all our photographs but instead to be a useful interim resource until such time as more detailed cataloguing of our photographs can be undertaken.  Please accept that there will be some typographical and other errors present.</p>";

		##echo "<h3>The Collections</h3>";
	
		##echo "<p>The <strong>Quatercentenary Collection</strong> came about as a result of an appeal made by the University as it approached its 400th anniversary in 1983. Amongst lecture notes, reminiscences, medals, memorabilia and much more were a significant quantity of both official and unoficial photographs of University life and events.</p>";
	
	}


	if ($_GET['func'] != "about") {
		echo "<p>This is not a comprehensive database of all our photographs.  Please also use our main <a href='/catalogue/'>Archives &amp; Manuscripts catalogue</a> to identify items.</p>";

		echo "<p style='font-weight:bold; margin-top:15px;'>This database contains unverified data complied from various legacy typescript lists and indexes.  It is being made available as an interim means of identifying key photographs and related items in our collections.  Please accept that there will be some typographical and other errors present.</p>";

		## echo "<h3>Browse (not in database)</h3>";
	
		## echo "<p><a href='inglis.php'>Inglis Collection (campus c1900)</a></p>";
	
	}

	echo "</div>";
	include "../includes/footer.php";

	?>