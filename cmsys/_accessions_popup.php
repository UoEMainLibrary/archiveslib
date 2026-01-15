<?  $scriptstore = "/data/d4/archives/cmsys/";
include $scriptstore."mysql_link.php";
include "../includes/auth.php";
include "/data/d4/archives/cmsys/auth.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="author" content="Edinburgh University Library Special Collections" />
<link rel="stylesheet" type="text/css" href="../includes/style.css" />
<title>Accessions</title>
</head>
<body>

<div align='right'><button onclick="window.print()">Print this page</button></div>
<form action="<? echo $PHP_SELF ?>">
<input type="text" name="year" value="echo $_GET['year']" />
<input type="text" name="type" value="echo $_GET['type']" />
<input type="submit" value="Select" />
</form>
<?



	echo "<h1>Accessions: ".$GET['year']."</h1>";
	 $sql_str="SELECT * FROM cms_accessions WHERE type LIKE '$type' AND year='$year'";

	 $acc_search = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 echo "<table width='100%' cellpadding='5' class='detail'>";
	 while ($results = mysql_fetch_array($acc_search)):
	 echo "<tr><td class='label' width='200'>Accession</td><td>".$results['ShMark']."</td></tr>";
	 echo "<tr><td class='label'>Description</td><td>".$results['DatName']."</td></tr>";
	 endwhile;
	 echo "</table>";
	 ?>
</body>
</html>

