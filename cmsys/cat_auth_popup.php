<? $scriptstore = "/data/d4/archives/cmsys/";
include $scriptstore."mysql_link.php";
include "../includes/auth.php";
include "/data/d4/archives/cmsys/auth.php";
include $scriptstore."vars.php"; ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="author" content="Edinburgh University Library Special Collections" />
<link rel="stylesheet" type="text/css" href="../includes/style.css" />

<title>Geog Authorities</title>
</head>
<body onunload="window.opener.document.location.reload(true);">
<h1>Geog Authorities</h1>

<?

$geogdir = "/home/archives/catalogue_source_docs/authorities/html/geog";

  function EmptyDir($dir) {
$handle=opendir($dir);

while (($file = readdir($handle))!==false) {
echo "$file deleted<br>";
@unlink($dir.'/'.$file);
}

closedir($handle);
}

EmptyDir($geogdir);
 

 	 $sql_str="SELECT * FROM cms_auth_geog";
	 
	 $termsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 
	 
	 while ($results = mysql_fetch_array($termsearch)): 
	 
	 if ($results['locator'] <> '') {
	 
	 if ($results['country'] == 'Scotland') {
	 
	 $filename = $geogdir."/".$results['id'].".shtml";
	 
	 echo $results['id']." created | ";
	 
	 $locators  = $results['locator'];
	 $locator = explode(";", $locators);
		echo $locator[0]." | "; // piece1
		echo $locator[1]."<br/>"; // piece2
		echo "<br/><br/>";
	 
	 $FileHandle = fopen($filename, 'w') or die("can't open file");
	 
	 $FileContent = "<iframe width='550' height='350' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='http://nls.tileserver.com/?lat=".$locator[0]."&lng=".$locator[1]."&zoom=12'></iframe><br/>Currently showing maps for Scottish locations which have been geo-referenced only.";
	 
	## $FileContent = "Geo term ".$results['id']." has locators ".$results['locator'].". Embedded map will show here in due course."; 
	 
	 
	 fwrite($FileHandle, $FileContent); 

	 fclose($FileHandle);
	 
	 }   
	 } 
     endwhile;	

 	
 
?>

  

     


