<?php include "../../mgt_config/sql.php";

	include "includes/top_header.php"; 
	echo "<title>Archives and Manuscripts Catalogue: The Collections</title>";
	include "includes/col_header.php";
	include "includes/lower_header.php"; ?>
<div align="left">
<h1>Collections</h1>

<p>We hold several thousand linear metres of manuscripts &amp; archives which have been acquired by transfer, gift, deposit or purchase. These collections are quite diverse but largely reflect our strengths in the areas of history of the University, medical and scientific history, Scottish literature, Middle Eastern studies, architecture, music, gaelic &amp; celtic studies and theology. Further acquisitions will enhance these strengths and lay down foundations (where appropriate) for new ones.</p>
	 			
<h2>These include</h2>
	 			
<ul>
<li>Early mediaeval and Middle Eastern manuscripts</li>
<li>Papers of major Scottish Enlightenment figures</li>
<li>Papers of major Scottish Scientists from the 17th century to the present</li>
<li>Papers of key figures in Scottish literature and culture</li>
<li>Drawings and papers of architects and town planners</li>
<li>Papers of former staff and alumni of the University</li>
<li>Records of the University itself, predecessor and affiliated bodies, and related material.</li>
</ul>

<h2>History, Management and Arrangement</h2>

<p>The Library has been a place of safe deposit for archives and manuscripts for almost as long as it has existed.  However it was not until the mid 1990s that the first University Archivist was appointed.  Management of this material has changed over time and there can sometimes be legacy issues about how items may have been referred to historically.  Modern technology offers us a way to build up a good cross-referencing system as do professional standards in how we manage these collections today.  A lot of our collections remain uncatalogued below fonds/collection level and items within them still need to be requested using old shelfmarks.</p>

<h2>Collection Groupings</h2>

<p>The <em>University Archives</em> is a distinct set of collections, consisting largely of the historic records of the University of Edinburgh, institutions which have been merged with (such as Moray House of the 'Dick Vet') and related bodies (such as student societies).</p>
<p>Alongside these sit our collections of <em>Archives, Manuscripts and Personal Papers</em>, which tend to have been largely purchased from or donated by private individuals/organisations.</p>
<p>Note that the dividing line between these can be quite blurred, especially with personal papers of staff and alumni of the University being in the latter category.  This catalogue searches across both so you do not need to work out in advance where the information you are looking for may be.</p>


<?php if ($_GET['list'] == 'y') {
include "cs/catlist.php";
} 

echo "</div>";
 include "includes/footer.php";

?>
