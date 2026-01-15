<?php include "../../mgt_config/sql.php";

include "../catalogue/includes/top_header.php"; 




$prefix = $_GET['prefix'];
$view = $_GET['view'];
$collectionid = $_GET['collectionid'];
$id = $_GET['id'];
$searchterm = $_GET['searchterm'];
$ref = $_GET['ref'];
$sequence = $_GET['sequence'];
$screenwidth = $_GET['screenwidth'];
$screenheight = $_GET['screenheight'];


$topnav = $scw."<strong>Manuscripts &amp; Archives catalogue</strong>
<hr /><table align=\"right\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" summary=\"\"><tr><td align=\"center\"><a href=\"/catalogue/\"><img alt=\"Search\" border=\"0\" src=\"/graphics/search.gif\" /><br />Search</a></td></tr></table>";

## $colllist = "<form method='GET' action='index.php'>View images from: <input type='hidden' name='view' value='collection' /><select style='font-size: 10px;' name='collectionid'><option value='0'></option><option value='97'>The Carmichael Watson Collection</option><option value='99'>Papers of James Geikie and family</option><option value='104'>Papers of John Baillie and the Baillie family</option><option value='6666'>Records of the University of Edinburgh</option><input style='font-size: 10px;' type='submit' value='Go' /></select></form>";


if (!isset ($view)) { $view = 'collection'; }

if ($view == "searchresults") { 

	echo "<title>Images: Search results</title>";
	include "../catalogue/includes/lower_header.php"; 
	echo $topnav;
	echo "<h1>Images</h1>";
	echo "<h2>Search results</h2>"; 

	$quicksearch_sql_str="SELECT * FROM images WHERE title LIKE '%$searchterm%'OR caption LIKE '%$searchterm%'";

	$quicksearch = mysql_db_query($dbname, $quicksearch_sql_str, $id_link) or die("Quicksearch query failed!");
	
	echo "<table width='70%' cellpadding='5' cellspacing='1' border='0'>";
	while ($searchresults = mysql_fetch_array($quicksearch)) {
	if (($searchresults['sequence'])<2) {
  echo "<tr><td></td><td colspan='2'><hr /></td></tr>";
	echo "<tr><td width='150' align='center' rowspan='4' valign='top'><a href='index.php?view=individual&id=".$searchresults['id']."'><img src=\"/".$searchresults['directory']."/tn/".$searchresults['image'].".jpg\" alt=\"".$searchresults['title']."\"></a></td></tr>";
	echo "<tr><td width='120'>Title:</td><td>".$searchresults['title']."</td></tr>";
 ## echo "<tr><td>Description:</td><td>".$searchresults['caption']."</td></tr>";
  echo "<tr><td>Catalogue ref. code:</td><td><a href='/catalogue/cs/viewcat.pl?id=".$searchresults['refid']."&view=basic'>".$searchresults['ref']."</a></td></tr>";
	}
  }
	echo "</table>";

 }
 
## begin option to view by collection
if ($view == "collection") {

## if collection id is set identify name of collection
if ($collectionid>0) {

	$sql_str="SELECT * FROM cms_collections WHERE coll=$collectionid AND sub_level=0";
	$collsearch = mysql_db_query($dbname, $sql_str, $id_link);
	$collresult = mysql_fetch_array($collsearch);
	
		echo "<title>Images: ".$collresult['title']."</title>";
	include "../catalogue/includes/lower_header.php"; 
	echo "<h1>Images</h1>";
	echo $topnav;
	
	include "colllist.php";
	echo "<h2>".$collresult['title']."</h2>";

## select images for current collection	
	$sql_str="SELECT * FROM images WHERE collection=$collectionid AND thumbnail LIKE 'y' ORDER BY image ASC";

	$imagesearch = mysql_db_query($dbname, $sql_str, $id_link); 
	
	echo "<table width='70%' cellpadding='5' cellspacing='1' border='0'>";
	while ($results = mysql_fetch_array($imagesearch)) {
  echo "<tr><td></td><td colspan='2'><hr /></td></tr>";
	echo "<tr><td width='150' align='center' rowspan='4' valign='top'><a href='index.php?view=individual&id=".$results['id']."'><img src=\"/".$results['directory']."/tn/".$results['image'].".jpg\" alt=\"".$results['title']."\"></a></td></tr>";
	echo "<tr><td width='120'>Title:</td><td>".$results['title']."</td></tr>";
 ## echo "<tr><td>Description:</td><td>".$results['caption']."</td></tr>";
  echo "<tr><td>Catalogue ref. code:</td><td><a href='/catalogue/cs/viewcat.pl?id=".$results['refid']."&view=basic'>".$results['ref']."</a></td></tr>";
  }
	echo "</table>";
	}
	else {
	echo "<title>Images: by collection</title>";
	include "../catalogue/includes/lower_header.php"; 
	echo $topnav;
	echo "<h1>Images: by collection</h1>";
	
	include "colllist.php";
	
	##previous version
	## $sql_str="SELECT * FROM images WHERE sequence<2 AND collection>0 ORDER BY RAND() LIMIT 12";
	
	$sql_str="SELECT * FROM images WHERE thumbnail <> 'n' AND collection>0 ORDER BY RAND() LIMIT 12";

## CW only
##$sql_str="SELECT * FROM images WHERE thumbnail <> 'n' AND collection=97 ORDER BY RAND() LIMIT 12";

	$imagesearch = mysql_db_query($dbname, $sql_str, $id_link) or die("imagesearch query failed!"); 
	
  echo "<h2>Random Selection</h2><table summary='thumbnails'><tr>";
	$count = -1;
	while ($results = mysql_fetch_array($imagesearch)) {
  $row = mysql_fetch_row($results);
	$count = ($count+1);
	if(($count %4)==0){ echo "</tr><tr>";  };
	
	echo "<td align='center'>"." <a href='index.php?view=individual&id=".$results['id']."'><img src='/".$results['directory']."/tn/".$results['image'].".jpg' alt='".$results['title']."'></a></td>";
  }
  echo "</tr></table>";
	}
	
	
	}
	
	if ($view == "individual") {
	
	
	$sql_str="SELECT * FROM images WHERE id=$id";
	
	$imagesearch = mysql_db_query($dbname, $sql_str, $id_link) or die("imagesearch query 2 failed!"); 
		
	$results = mysql_fetch_array($imagesearch);
	echo "<title>Images: ".$results['title']."</title>"; ?>
		
<script language="javascript">
 function pop_window(url) {
 //remove a attribute if you don't want it to show up
  var popit = window.open(url,'console','scrollbars,resizable,width=800,height=500');
 }
</script>


<?	include "../catalogue/includes/lower_header.php"; 
	echo $topnav;	
	echo "<h1>Images</h1>";
	echo "<h2>".$results['title']."</h2>";	
	$imgstr = "http://www.archives.lib.ed.ac.uk/".$results['directory']."/full/".$results['image'].".jpg";
	
	list($width, $height, $type, $attr) = getimagesize($imgstr);
	
		echo "<a href=\"javascript:pop_window('individual.php?image=".$results['image']."')\">";
	
 ?>


 <script language="JavaScript" type="text/javascript">
<!--

 var screenW = 640, screenH = 480
 if (parseInt(navigator.appVersion)>3) {
 screenW = screen.width;
 screenH = screen.height;
 }
 else if (navigator.appName == 'Netscape' 
     && parseInt(navigator.appVersion)==3
     && navigator.javaEnabled()
    )
 {
 var jToolkit = java.awt.Toolkit.getDefaultToolkit();
 var jScreenSize = jToolkit.getScreenSize();
 screenW = jScreenSize.width;
 screenH = jScreenSize.height;
 }
 
 realW = <?php echo $width; ?>;
 
 useableW = (screenW - 150);
 
 if (realW<useableW) {
 
 displayW = realW;
 
 }
 
 else {
 
 displayW = useableW;
 
 }
 
document.write("<img width=\""+displayW+"\" src=\"/<?php echo $results['directory']?>/full/<?php echo $results['image'] ?>.jpg\" alt=\"<?php echo $results['title'] ?>\"");


//-->
</script>

<?	echo "</a>";

echo "<br /> <br /><table summary='' border='0' cellpadding='5' width='90%'>";
	
	if (($results['caption']) <> '') {
	echo "<tr><td width='150' class='field' valign='top'>Details:</td><td>".$results['caption']."</td></tr>";
	}
	
	echo "<tr><td class='field' valign='top'>Catalogue ref. code:</td><td><a href='/catalogue/cs/viewcat.pl?id=".$results['refid']."&view=basic'>".$results['ref']."</a><br /><i>The catalogue will provide more information about this item</i></td></tr>";
  ## only display if this is a multi-image item
  	if (($results['sequence']) <> 0) {
  	echo "<tr><td class='field' valign='top'>Navigation:</td><td><a href='index.php?view=sequence&ref=".$results['ref']."&sequence=1'>Browse this multi-page item</a><br /><small>Please note that not all pages may have been digitised.  Refer to the catalogue entry to determine full extent, scope and content.</small>";
  	}

	
  ## identify which collection current item belongs to
	$collection = ($results['collection']);
	$sql_str="SELECT * FROM cms_collections WHERE coll=$collection";
	$collsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("collsearch query failed!");
	$collresult = mysql_fetch_array($collsearch);
	if ($collection >0) {
	echo "<tr><td class='field' valign='top'>Collection:</td><td>".$collresult['title']."</td></tr>";
	echo "<tr><td></td><td>[ <a href='index.php?view=collection&collectionid=".$collection."'>View all images from this collection</a> ]</td></tr>";
	}

	echo "</table>";
	 	echo "<p><a href=\"javascript:pop_window('individual.php?image=".$results['image']."')\"><img src=\"/graphics/size.gif\" alt=\"View image in its own window\" border=\"0\"></a> <a href=\"javascript:pop_window('individual.php?image=".$results['image']."')\">Click here</a> to view this image in a new window.</p>";
	}
	
	if ($view == "sequence") {
	if (!isset ($sequence)) { $sequence=1; }
	$sql_str="SELECT * FROM images WHERE ref LIKE '$ref' AND sequence=$sequence";
	$sequencesearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
	$sequenceresults = mysql_fetch_array($sequencesearch);
	
	echo "<title>Images: ".$sequenceresults['title']."</title>"; ?>
	
	<script language="javascript">
 function pop_window(url) {
 //remove a attribute if you don't want it to show up
  var popit = window.open(url,'console','scrollbars,resizable,width=800,height=500');
 }
</script>
	
<?	include "../catalogue/includes/lower_header.php";
	echo $topnav; 
	echo "<h1>Images</h1>";
	echo "<h2>".$sequenceresults['title']."</h2>"; 
	
	  ## create top navigation	
		
		 ## create link back to main entry
 
  $sql_str="SELECT * FROM images WHERE ref LIKE '$ref' AND sequence=1";
	$linksearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
	echo "<p>";
	$linkresult = mysql_fetch_array($linksearch);
	$desclink = "<a href='index.php?view=individual&id=".$linkresult['id']."'><b>Description</b></a><br /><br />";
	
		$sql_str="SELECT * FROM images WHERE ref LIKE '$ref'";
	$navsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Select Failed!");
		
		if ($sequence>1) { $prev=$sequence-1; }
		else { $prev=1; }		
		$last = mysql_numrows($navsearch);
		if ($sequence<($last-1)) { $next=$sequence+1; }
		else { $next=$last; }
		
	echo "<p>".$desclink."<a href='index.php?view=sequence&ref=".$ref."&sequence=1'>First page</a> | <a href='index.php?view=sequence&ref=".$ref."&sequence=".$prev."'>Previous page</a> | <a href='index.php?view=sequence&ref=".$ref."&sequence=".$next."'>Next page</a> | <a href='index.php?view=sequence&ref=".$ref."&sequence=".$last."'>Last page</a></p>";


##	echo "<img src=\"/".$sequenceresults['directory']."/full/".$sequenceresults['image'].".jpg\" alt=\"".$results['title']."\">";

	$imgstr = "http://www.archives.lib.ed.ac.uk/".$sequenceresults['directory']."/full/".$sequenceresults['image'].".jpg";
	
	list($width, $height, $type, $attr) = getimagesize($imgstr);
	
	
	echo "<a href=\"javascript:pop_window('individual.php?image=".$sequenceresults['image']."')\">";
 ?>

<!-- javascript to determine image width -->
 <script language="JavaScript" type="text/javascript">
<!--

 var screenW = 640, screenH = 480
 if (parseInt(navigator.appVersion)>3) {
 screenW = screen.width;
 screenH = screen.height;
 }
 else if (navigator.appName == 'Netscape' 
     && parseInt(navigator.appVersion)==3
     && navigator.javaEnabled()
    )
 {
 var jToolkit = java.awt.Toolkit.getDefaultToolkit();
 var jScreenSize = jToolkit.getScreenSize();
 screenW = jScreenSize.width;
 screenH = jScreenSize.height;
 }
 
 realW = <?php echo $width; ?>;
 
 useableW = (screenW - 150);
 
 if (realW<useableW) {
 
 displayW = realW;
 
 }
 
 else {
 
 displayW = useableW;
 
 }

document.write("<img width=\""+displayW+"\" src=\"/<?php echo $sequenceresults['directory']?>/full/<?php echo $sequenceresults['image'] ?>.jpg\" alt=\"<?php echo $sequenceresults['title'] ?>\"");

document.write("<br />");


//-->
</script>

<?php	
	echo "</a>";

echo "<p><a href=\"javascript:pop_window('individual.php?image=".$sequenceresults['image']."')\"><img src=\"/graphics/size.gif\" alt=\"View larger image\" border=\"0\"></a> <a href=\"javascript:pop_window('individual.php?image=".$sequenceresults['image']."')\">Click here</a> to view this image in a new window.</p>";
#	echo "<br /><table summary='' width='70%'><tr><td>Go to page:</td></tr><tr><td>";
#	while ($navresults = mysql_fetch_array($navsearch)) {
#	echo "<a href='index.php?view=sequence&ref=".$navresults['ref']."&sequence=".$navresults['sequence']."'>".$navresults['sequence']."</a> ";
#	}
		echo "</td></tr></table>";
	

	}

 include "../catalogue/includes/footer.php"; ?>
