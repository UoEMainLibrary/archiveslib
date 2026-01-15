<?  $scriptstore = "/data/d4/archives/cmsys/";
include $scriptstore."mysql_link.php";
include "../includes/auth.php";
include "/data/d4/archives/cmsys/auth.php"; 
?>

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

<form action="<? echo $PHP_SELF ?>">
<input type="hidden" name="popup" value="<? echo $_GET['popup'] ?>" />
Type: 
<select name="type">
<option value="<? echo $_GET['type'] ?>"><? echo $_GET['type'] ?></option>
<option value="RBP">RBP</option>
<option value="MS">MS</option>
<option value="EUA">EUA</option>
</select> Year: 
<input type="text" name="year" value="<? echo $_GET['year'] ?>" />
<input type="submit" value="Select" />
</form>
<hr />

<?   $year = $_GET['year'];
     $type = $_GET['type'];
	 
	 if ($type <>'' ){
	 echo "<div align='right'><button onclick='window.print()'>Print this page</button></div>";
	 }

	 $sql_str="SELECT * FROM cms_accessions WHERE acc_type LIKE '$type' AND year LIKE '$year'";

	 $acc_search = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 echo "<table width='100%' cellpadding='5' class='detail' border='1'>";
	 while ($results = mysql_fetch_array($acc_search)):
	 
	 echo "<tr><td class='label' width='200'>Accession</td><td><a href='../cms.php?func=accessions&amp;view=viewacc&amp;id=".$results['id']."'  target='MAIN'>";  
	 
	 include "accstyle.php";
	 
	 echo "</a></td></tr>";
	 echo "<tr><td class='label'>Description</td><td>".$results['description']."</td></tr>";
	 echo "<tr><td height='10' colspan='2'></td></tr>";
	 endwhile;
	 echo "</table>";
	 ?>
</body>
</html>

