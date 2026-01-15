<?  $scriptstore = "/data/d4/archives/cmsys/";
include $scriptstore."mysql_link_2.php";
include "../includes/auth.php";
include "/data/d4/archives/cmsys/auth.php";
include $scriptstore."vars.php";
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="author" content="Edinburgh University Library Special Collections" />
<link rel="stylesheet" type="text/css" href="../includes/style.css" />

<title>Enquiry</title>
</head>
<body onunload="window.opener.document.location.reload(true);">
<? if (!isset ($view)) {
 	 $sql_str="SELECT * FROM enquiries WHERE id=$id";
	 
	  $enqsearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 	  
	  $results = mysql_fetch_array($enqsearch); ?>
      
    <form action="<? echo $_SERVER['PHP_SELF'] ?>" method="GET" name="myForm">
    <input name="view" type="hidden" value="update" />
    <input name="id" type="hidden" value="<? echo $results['id'] ?>" />
    <input name="popup" type="hidden" value="<? echo $_GET['popup'] ?>" />
    <table cellpadding="5" cellspacing="0">
    <tr><td class='label'>Ref.</td><td>SC-ENQ-<? echo $results['id'] ?></td></tr>
    <tr><td class='label'>Enquirer name</td><td><input name="enquirer_name" type="text" size="50" value="<? echo $results['enquirer_name'] ?>" /></td></tr>
    <tr><td class='label'>Enquirer email</td><td><input name="enquirer_email" type="text" size="50" value="<? echo $results['enquirer_email'] ?>" /></td></tr>
        <tr><td class='label'>Enquirer (more)</td><td><textarea name="enquirer_more" cols="80" rows="5"><? echo $results['enquirer_more'] ?></textarea></td></tr>
    <tr><td class='label'>Subject</td><td><input name="subject" type="text" size="50" value="<? echo $results['subject'] ?>" /></td></tr>
    <tr><td class='label'>Received</td><td><input name="received" type="text" size="50" value="<? echo $results['received'] ?>" /> Date in format YYYY-MM-DD</td></tr>
    <tr><td class='label'>Acknowledged</td><td><input name="acknowledged" type="text" size="50" value="<? echo $results['acknowledged'] ?>" /> Date in format YYYY-MM-DD</td></tr>
    <tr><td class='label'>Assigned to</td><td><input name="assigned" type="text" size="50" value="<? echo $results['assigned'] ?>" /></td></tr>
    <tr><td class='label'>Completed</td><td><input name="completed" type="text" size="50" value="<? echo $results['completed'] ?>" /> Date in format YYYY-MM-DD</td></tr>
        <tr><td class='label'>Notes</td><td><textarea name="notes" cols="80" rows="10"><? echo $results['notes'] ?></textarea></td></tr>
    <tr><td class='label'>Logged by</td><td><? echo $results['logged_by'] ?></td></tr>
    </table> 
    <input name="" type="submit" value="Update" />   
    </form>
	  
<? }
elseif ($view == 'update') {

$enquirer_name = mysql_real_escape_string($_GET['enquirer_name']);
$enquirer_email = mysql_real_escape_string($_GET['enquirer_email']);
$enquirer_more = mysql_real_escape_string($_GET['enquirer_more']);
$subject = mysql_real_escape_string($_GET['subject']);
$received = $_GET['received'];
$acknowledged = $_GET['acknowledged'];
$completed = $_GET['completed'];
$assigned = $_GET['assigned'];
$logged_by = $_GET['logged_by'];
$notes = mysql_real_escape_string($_GET['notes']);

$sql_str = "UPDATE enquiries SET enquirer_name='$enquirer_name', enquirer_email='$enquirer_email', enquirer_more='$enquirer_more',  subject='$subject', received='$received', acknowledged='$acknowledged',  completed='$completed', notes='$notes' WHERE id='$id' LIMIT 1";

mysql_query($sql_str) or die ("Update entry failed!");

echo "<p><a href='javascript:window.close();'>Close and update main page</a></p>"; 
 }	  
elseif ($view == 'new') {	 ?>

   <form action="<? echo $_SERVER['PHP_SELF'] ?>" method="GET" name="myForm">
    <input name="view" type="hidden" value="add" />
    <input name="popup" type="hidden" value="<? echo $_GET['popup'] ?>" />
    <table cellpadding="5" cellspacing="0">
    <tr><td class='label'>Enquirer name</td><td><input name="enquirer_name" type="text" size="50" value="<? echo $results['enquirer_name'] ?>" /></td></tr>
    <tr><td class='label'>Enquirer email</td><td><input name="enquirer_email" type="text" size="50" value="<? echo $results['enquirer_email'] ?>" /></td></tr>
        <tr><td class='label'>Enquirer (more)</td><td><textarea name="enquirer_more" cols="80" rows="5"><? echo $results['enquirer_more'] ?></textarea></td></tr>
    <tr><td class='label'>Subject</td><td><input name="subject" type="text" size="50" value="<? echo $results['subject'] ?>" /></td></tr>
    <tr><td class='label'>Received</td><td><input name="received" type="text" size="50" value="<? echo $results['received'] ?>" /> Date in format YYYY-MM-DD</td></tr>
    <tr><td class='label'>Acknowledged</td><td><input name="acknowledged" type="text" size="50" value="<? echo $results['acknowledged'] ?>" /> Date in format YYYY-MM-DD</td></tr>
    <tr><td class='label'>Completed</td><td><input name="completed" type="text" size="50" value="<? echo $results['completed'] ?>" /> Date in format YYYY-MM-DD</td></tr>
    <tr><td class='label'>Assigned to</td><td><input name="assigned" type="text" size="50" value="<? echo $results['assigned'] ?>" /></td></tr>
        <tr><td class='label'>Notes</td><td><textarea name="notes" cols="80" rows="10"><? echo $results['notes'] ?></textarea></td></tr>
    </table> 
    <input name="" type="submit" value="Add" />   
    </form>
<? } 
elseif ($view == 'add') {

$enquirer_name = mysql_real_escape_string($_GET['enquirer_name']);
$enquirer_email = mysql_real_escape_string($_GET['enquirer_email']);
$enquirer_more = mysql_real_escape_string($_GET['enquirer_more']);
$subject = mysql_real_escape_string($_GET['subject']);
$received = $_GET['received'];
$acknowledged = $_GET['acknowledged'];
$completed = $_GET['completed'];
$assigned = $_GET['assigned'];
$notes = mysql_real_escape_string($_GET['notes']);
$logged_by = $current_user;

$sql_str = "INSERT INTO enquiries (id, enquirer_name, enquirer_email, enquirer_more, subject, received, acknowledged, assigned, completed, logged_by, notes) VALUES (NULL, '$enquirer_name', '$enquirer_email', '$enquirer_more', '$subject', '$received', '$acknowledged', '$assigned', '$completed', '$logged_by', '$notes')";
mysql_query($sql_str) or die ("Add entry failed!");

echo "<p><a href='javascript:window.close();'>Close and update main page</a></p>"; 
}
	  ?>
</body>
</html>

