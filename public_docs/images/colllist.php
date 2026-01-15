<?	 echo "<form method='GET' action='index.php'>View images from: <input type='hidden' name='view' value='collection' /><select style='font-size: 10px;' name='collectionid'><option value='0'></option>";

$colllist_sql_str="SELECT DISTINCT collection FROM images ORDER BY collection ASC";
	$colllist_search = mysql_db_query($dbname, $colllist_sql_str, $id_link) or die("Select Failed!");
	while ($colllist_results = mysql_fetch_array($colllist_search)) {
	$colllist = $colllist_results['collection'];
	
	$collname_sql_str="SELECT * FROM cms_collections WHERE coll=$colllist ORDER BY coll ASC";
	$collname_search = mysql_db_query($dbname, $collname_sql_str, $id_link) or die("Select Failed!");
	while ($collname_results = mysql_fetch_array($collname_search)) {
	
	echo "<option value='".$colllist."'>Coll-".$collname_results['coll']." ".$collname_results['title']."</option>";
	
	}
	
	} 
	echo"</select> <input style='font-size: 10px;' type='submit' value='Go' /></form>";
	 
	?>
	
