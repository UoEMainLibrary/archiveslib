<?

 include "../../mgt_config/sql.php"; 

        if (!$id_link || !mysql_select_db($dbname)):
                echo '<p>Error!</p>';
                echo 'Connection to database has failed.  This is most likely due to a temporary server problem.';
                exit();
        endif; 
		
		
$sub_subj = file_get_contents("sub_subj.txt");

$subj_arr_p = explode (",", $sub_subj);

sort($subj_arr_p);

$subj_arr = array_unique($subj_arr_p);


echo "<table>";
foreach ($subj_arr as $authfilenumber) {
 $sql_str="SELECT * FROM cms_auth_subj where id='$authfilenumber'"; 
 $subjsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
 $results = mysql_fetch_array($subjsearch);
 
 echo "<tr><td>".$results['term']."</td></tr>";
}
echo "</table>";
?>