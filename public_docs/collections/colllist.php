<?php  include "../../mgt_config/sql.php";

 $id_link = mysql_connect($hostname, $username, $password);
	 
	 $sql_str="SELECT * FROM cms_collections";

	 $collsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 echo "<table width='100%' cellpadding='5'>";
	
	 while ($results = mysql_fetch_array($collsearch)):
	 
	 
	 echo "<tr><td>".$results['coll']."</td><td>".$results['title']."</td></tr>";

	 endwhile;
	 echo "</table>";
	  ?>