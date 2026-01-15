<?php
	 
	 $sql_str="SELECT * FROM cms_collections AND title NOT LIKE '%ALLOCATED%' ORDER BY creator ASC";

	 $collsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 echo "<table width='100%' cellpadding='5'>";
	 echo "<tr><thead><td width='100'></td><td width='200'><b>Creator</b></td><td><b>Title</b></td></thead></tr>";
	
	 while ($results = mysql_fetch_array($collsearch)):
	 
	 if (($results['desc']) == '1') {
	 echo "<tr><td><a href='/cgi-bin/view_isad.pl?id=GB-237-Coll-".$results['coll']."&view=basic'>Coll-".$results['coll']."</a></td><td>".$results['creator']."</td><td>".$results['title']."</td></tr>";
}
	 endwhile;
	 echo "</table>";
	  ?>