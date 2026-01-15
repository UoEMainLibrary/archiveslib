<?php include "../../mgt_config/sql.php";

$result = mysql_query("SHOW COLUMNS FROM eua_photographs");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
if (mysql_num_rows($result) > 0) {
    while ($row = mysql_fetch_assoc($result)) {
		foreach($row as $row_name) {
        echo $row_name;
		echo "<br/>";
		}
    }
}

?>