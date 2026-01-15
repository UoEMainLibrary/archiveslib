<?php include "../../mgt_config/sql.php";

## define variables
$view = $_GET['view'];
$unitid = $_GET['unitid'];
$luna = $_GET['luna']; ?>

<html>
<head>
<title>Images</title>
	<link type="text/css" rel="stylesheet" href="http://images.is.ed.ac.uk/luna/js/build/container/assets/container.css" />
 <link rel="stylesheet" href="http://images.is.ed.ac.uk/luna/themes/blue/blue.css" type="text/css" />
 <link rel="stylesheet" href="http://images.is.ed.ac.uk/luna/css/structure.css" type="text/css" />
 <style>
 body, p, div, li, td, a{
 font-size: 10pt;
 font-family:Verdana, Arial, Helvetica, sans-serif;
 }
 a, a:visited, a:hover {
color: #000000;
text-decoration:underline;
}

 a.body, a.body:visited, a.body:hover {
color: #ffffff;
text-decoration:underline;
}
 </style>
    </head>
    
    <body>

<div id="HeaderLogo" style="background-image: url( http://lac-live1.is.ed.ac.uk:8180/graphics/luna-header.jpg);">

 
</div>

<?php 
if (!isset($view)) {

$sql_str="SELECT DISTINCT coll_unitid FROM cms_image_metadata WHERE coll_unitid <>'' ORDER BY coll_unitid ASC";

$collsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");



echo "<ul>";
	 
	 while ($results = mysql_fetch_array($collsearch)):
	 
	 $prefix = substr($results['coll_unitid'], 0, 4);
	 
	 if ($prefix == 'Coll'){
	 $coll = substr($results['coll_unitid'], 5, 4);
	 }
	 else {
	 $coll = $results['coll_unitid'];	 
	 }
	 $sql_str_a="SELECT * FROM cms_collections WHERE coll LIKE '$coll' OR alt LIKE '$coll'";	 
	 $collsearch_a = mysql_db_query($dbname, $sql_str_a, $id_link) or die("Search Failed!");	 
	 $results_a = mysql_fetch_array($collsearch_a);
	 $coll_title = utf8_decode($results_a['title']);
	 
	 echo "<li style='padding:5px;'><div style='padding:5px;'><a class='body' href='".$_SERVER['PHP_SELF']."?view=gallery&amp;unitid=".$results['coll_unitid']."'>".$results['coll_unitid']." - ".$coll_title."</a></div></li>";
	 
	 endwhile;

echo "</ul>";

}

elseif ($view =="gallery") {
$prefix = substr($unitid, 0, 4);

if ($prefix == 'Coll'){
$coll = substr($unitid, 5, 4);

## echo $prefix." ".$coll;

$sql_str_a="SELECT * FROM cms_collections WHERE coll LIKE '$coll'";
	 
	 $collsearch = mysql_db_query($dbname, $sql_str_a, $id_link) or die("Search Failed!");
	 
	 $results_a = mysql_fetch_array($collsearch);
	 
	 $unitid_str = $unitid;
}

elseif ($prefix <> 'Coll'){

$sql_str_a="SELECT * FROM cms_collections WHERE alt LIKE '$unitid'";
	 
	 $collsearch = mysql_db_query($dbname, $sql_str_a, $id_link) or die("Search Failed!");
	 
	 $results_a = mysql_fetch_array($collsearch);
	 
	 	$replaceable = " ";
		$replacewith = "-";
		$unitid_str = str_replace(" ", "-", $unitid);

}
	 
	 $coll_title = $results_a['title'];

echo "<div style='background-color:#FFFFFF; color:#000000; height:60px; padding:5px;'>Images taken from: <strong>".$coll_title."</strong> <br /><span style='font-size: smaller';>[ <a href='cs/viewcat.pl?id=GB-237-".$unitid_str."'>Collection catalogue record</a> | <a href='".$_SERVER['PHP_SELF']."'>Other archive collections with images online</a> ]</span></div>";

echo "<div style='background-color:#000000;'>";

 	 $sql_str="SELECT * FROM cms_image_metadata WHERE coll_unitid LIKE '$unitid'";
	 
	 $imagesearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 while ($results = mysql_fetch_array($imagesearch)):
	 
	 $Work_Record_ID = substr($results['image file'], 0, -5); ?>
     
	 
<iframe id="widgetPreview" frameBorder="0"  width="370px"  height="470px"  border="0px" style="border:0px solid white"  src="http://images.is.ed.ac.uk/luna/servlet/view/search?embedded=true&q=Work_Record_ID=&quot;<?php echo $Work_Record_ID ?>&quot;&res=1&pgs=50&widgetFormat=javascript&widgetType=thumbnail&controls=0&nsip=0" ></iframe>


     
  <?php   endwhile;
     
     
	 

?>
</div>
  
<?php }  ?>
     



</body>
</html>
