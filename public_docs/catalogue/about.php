<?php include "../../mgt_config/sql.php";

	include "includes/top_header.php"; 
	echo "<title>Archives and Manuscripts Catalogue: About the Catalogue</title>";
	include "includes/abt_header.php";
	include "includes/lower_header.php"; ?>

<h1>About the Catalogue</h1>

<p>The catalogue is built using technology developed for the RSLP-funded NAHSTE project (concluded 2001).  It has since been enhanced to take account of newer standards and changes in cataloguing methodology.  At its heart are a number of Perl scripts which interogate EAD-encoded xml files to build the catalogue.  Html derivatives of EAC-encoded xml records are added manually and picked up automatically by the catalogue as it delivers content to the user. Similarly html pages embedded with a historic map API are also automaticly detected and delivered. <em>A more detailed account of the underlying technology and methodology will be available here soon.</em></p>

<h2>Catalogue Records</h2>

<p>These are the heart of the catalogue.  These reflect the hierarchical arrangement of material within any given collection although for many collections we only currently have the collection or fonds level record created and provide the structure to the catalogue to which everything else links.</p>

<p>Navigation to the catalogue record will be either from a page of search results or by browsing the authority terms (see below).  The catalogue record will display any linked authority terms, show the position of the record within the overall catalogue to that particular collection (where relevant), offer a link to any supporting documentation (usually any interim handlist of items awaiting full cataloguing (where this exists) and offer a link to request the item(s) for consultation.</p>

<h2>Authority terms</h2>

<p>These are grouped by type, namely subject, genre, geographic name, personal name, corporate name, family name, and can be browsed alphabetically.  The page for any term will list all occurences of that term in the catalogue.  Additional information for certain geographic names and personal names is also available as follows:</p>

<h3>Geographic names</h3>

<p>Certain Scottish place names only have their geospatial coordinates recorded in our system and, for terms where this is the case, a 19th century map will be displayed.  This utilises an API freely available from the National Library of Scotland.</p>

<h3>Personal names</h3>

<p>We have compiled EAC records for a number of individuals, listing their biographical details.  Where these exist, they will be displayed alongside the list of occurences of that name in the catalogue.  We hope to add considerably more of these records to the system and extend them to cover corporate names as well.</p>


<?php include "includes/footer.php";

?>
