<? 	 $current_user = $_SERVER['REMOTE_USER'];

$sql_str="SELECT * FROM cms_users WHERE userid LIKE '$current_user'";

	 $usersearch = mysql_db_query($dbname, $sql_str, $id_link) or ("Search Failed!");
$results = mysql_fetch_array($usersearch);

$display_user = $results['forename']." ".$results['surname'];

$group_user =  $results['group'];

elseif ($group_user > "2") {
$edit_permissions = "y";
}
else {
$edit_permissions = "n";
}
?> 