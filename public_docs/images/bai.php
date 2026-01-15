<?php include "../../mgt_config/sql.php"; ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Carmichael Watson Project: Image metadata editor</title>
<link rel="stylesheet" type="text/css" href="../eua.css" />
</head>
<body>

<h1>Carmicheal Watson Project</h1>
<h2>Image metadata editor</h2>

<p><a href="bai.php">Home</a></p>
<hr />

<?	$view = $_GET['view'];
		$id = $_GET['id'];
		$title = $_GET['title'];
		$caption = $_GET['caption'];
		$ref = $_GET['ref'];
		$refid = $_GET['refid'];

if (!isset ($view)) { $view ="list"; }

if ($view == "list") {

echo "<p>Series with digitised items:</p>";

$sql_str="SELECT DISTINCT ref, refid FROM images WHERE collection=104";
		$search = mysql_db_query($dbname, $sql_str, $id_link);
		echo "<ul>";
		while ($results = mysql_fetch_array($search)) {
		echo "<li><a href='bai.php?view=group&amp;refid=".$results['refid']."'>".$results['ref']."</a></li>";
		}
		echo "</ul>";
		echo "<p><a href='bai.php?view=all'>View all</a></p>";
		
		echo "<hr />";
}

if ($view == "all") {


	$sql_str="SELECT * FROM images WHERE collection=104";
	$search = mysql_db_query($dbname, $sql_str, $id_link);
	
	echo "<table border='0' cellpadding='3'>";
	
	while ($results = mysql_fetch_array($search)) {
	
	echo "<tr><td valign='top'><img src='/images/tn/".$results['image'].".jpg' /><br >".$results['image'].".jpg</td><td valign='top'><h3>".$results['title']."</h3><p>".$results['caption']."</p><p>".$results['ref']." </p>";

if (($results['sequence']) > 0) {
echo "<p># ".$results['sequence']." in sequence</p>";
}

echo "</td></tr>";
echo "<tr><td><b>EAD code for this image</b></td><td align='right'>[<a href='bai.php?view=ead&amp;refid=".$results['refid']."'>Full <b>EAD code</b> for this ref</a>]</td></tr>";
echo "<tr><td colspan='2'><textarea cols='90' rows='6' readonly='readonly'>";
echo "<daoloc href=\"http://www.archives.lib.ed.ac.uk/images/index.php?view=individual&amp;amp;id=".$results['id']."\">\n";

echo "<daodesc>\n";

echo "<p>".$results['title']."</p>\n";

echo "</daodesc>\n";

echo "</daoloc>\n";

echo "</textarea></td></tr>";

echo "<tr><td colspan='2' align='right'><b><a href='bai.php?view=edit&amp;id=".$results['id']."'>edit metadata</a></b><hr /></td></tr>";
	}
	echo "</table>";

}

if ($view == "group") {


	$sql_str="SELECT * FROM images WHERE collection=97 AND refid LIKE '$refid'";
	$search = mysql_db_query($dbname, $sql_str, $id_link);
	
	echo "<table border='0' cellpadding='3'>";
	
	while ($results = mysql_fetch_array($search)) {
	
	echo "<tr><td valign='top' width='100'><img src='/images/tn/".$results['image'].".jpg' /><br >".$results['image'].".jpg</td><td valign='top'><h3>".$results['title']."</h3><p>".$results['caption']."</p><p>".$results['ref']." </p>";

if (($results['sequence']) > 0) {
echo "<p># ".$results['sequence']." in sequence</p>";
}

echo "</td></tr>";
echo "<tr><td><b>EAD code for this image</b></td><td align='right'>[<a href='bai.php?view=ead&amp;refid=".$results['refid']."'>Full <b>EAD code</b> for this ref</a>]</td></tr>";
echo "<tr><td colspan='2'><textarea cols='90' rows='6' readonly='readonly'>";
echo "<daoloc href=\"http://www.archives.lib.ed.ac.uk/images/index.php?view=individual&amp;amp;id=".$results['id']."\">\n";

echo "<daodesc>\n";

echo "<p>".$results['title']."</p>\n";

echo "</daodesc>\n";

echo "</daoloc>\n";

echo "</textarea></td></tr>";

echo "<tr><td colspan='2' align='right'><b><a href='bai.php?view=edit&amp;id=".$results['id']."'>edit metadata</a></b><hr /></td></tr>";
	}
	echo "</table>";

}

if ($view == "ead") {

echo "<p>".$refid."</p>";
	
	$sql_str="SELECT * FROM images WHERE refid LIKE '$refid'";
	$search = mysql_db_query($dbname, $sql_str, $id_link);
	
	echo "<textarea rows=90 cols=90 readonly=\"readonly\">\n";
	echo "<odd encodinganalog=\"images\">\n";
	echo "<head>Digital Images</head>\n";
	echo "<daogrp>";
	
	while ($results = mysql_fetch_array($search)) { ?>
	
	<daoloc href="http://www.archives.lib.ed.ac.uk/images/index.php?view=individual&amp;amp;id=<?php echo $results['id'] ?>">
	<daodesc>
	<p><?php echo $results['title'] ?></p>
	</daodesc>
	</daoloc>
<?	}
	echo "</daogrp>\n";
	echo "</odd>";
	echo " </textarea>";

}

if ($view == "edit") { 

	$sql_str="SELECT * FROM images WHERE id=$id";
	$search = mysql_db_query($dbname, $sql_str, $id_link);
	$result = mysql_fetch_array($search);

?>

<form method="GET" action="bai.php">
<input type="hidden" name="view" value="update" />
<input type="hidden" name="id" value="<?php echo $id ?>" />
<table cellpadding="5">
<tr><td>ID</td><td><?php echo $id ?></td></tr>
<tr><td>Image</td><td><?php echo $result['image'] ?>.jpg</td></tr>
<tr><td>Sequence</td><td><?php echo $result['sequence'] ?></td></tr>
<tr><td>Title</td><td><input size="70" name="title" value="<?php echo $result['title'] ?>" /></td></tr>
<tr><td>Caption</td><td><textarea rows="5" cols="54" name="caption"><?php echo $result['caption'] ?></textarea></td></tr>
<tr><td>Ref. code</td><td><input size="70" name="ref" value="<?php echo $result['ref'] ?>" /></td></tr>
<tr><td>Ref. ID</td><td><input size="70" name="refid" value="<?php echo $result['refid'] ?>" /></td></tr>
<tr><td></td><td><input type="submit" value="Update" /></td></tr>
</table>
</form>

<?php}

if ($view == "update") {
echo "<p>Updating metadata . . . .";

	mysql_select_db($dbname);
	
	$update_str="UPDATE images SET id='$id', title='$title', caption='$caption', ref='$ref', refid='$refid' WHERE id='$id' LIMIT 1";

		mysql_query($update_str) or die(mysql_error()); 

	echo "<p>Metadata updated!</p>";

}	 ?>
	
</body>
</html> 