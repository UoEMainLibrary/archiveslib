<?  $scriptstore = "/data/d4/archives/cmsys/";
include $scriptstore."mysql_link.php";
include "../includes/auth.php";
include "/data/d4/archives/cmsys/auth.php";
include $scriptstore."vars.php";

    $today = date('Y-m-d');
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="author" content="Edinburgh University Library Special Collections" />
<link rel="stylesheet" type="text/css" href="../includes/style.css" />

<script language="javascript" type="text/javascript" src="datetimepicker.js">

//Date Time Picker script- by TengYong Ng of http://www.rainforestnet.com
//Script featured on JavaScript Kit (http://www.javascriptkit.com)
//For this script, visit http://www.javascriptkit.com

</script>

<title>Reader Details</title>
</head>
<body onunload="window.opener.document.location.reload(true);">

<? if (!isset ($view)) {
 	 $sql_str="SELECT * FROM crc_readers WHERE id=$id";
	 
	  $perssearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 	  
	  $results = mysql_fetch_array($perssearch);   ?>
    <form action="<? echo $_SERVER['PHP_SELF'] ?>" method="GET" name="myForm">
    <input name="view" type="hidden" value="update" />
    <input name="id" type="hidden" value="<? echo $results['id'] ?>" />
    <input name="popup" type="hidden" value="<? echo $_GET['popup'] ?>" />
    <input name="registration_date" type="hidden" size="50" value="<? echo $results['registration_date'] ?>"  />
    <input name="renewal_date" type="hidden" size="50" value="<? echo $results['renewal_date'] ?>"  />
    <table cellpadding="5" cellspacing="0">
    <tr><td class='label'>ID</td><td>CRC-RR-<? echo $results['id'] ?></td></tr> 
    <tr><td class='label'>Registration Date</td><td><? echo $results['registration_date'] ?></td></tr>
    <tr><td class='label'>Last Renewal</td><td><? echo $results['renewal_date'] ?></td></tr>   
    <tr><td class='label'>Library ID (if any)</td><td><input name="id_lib" type="text" size="50" value="<? echo $results['id_lib'] ?>" /></td></tr>
    <tr><td class='label'>Surname</td><td><input name="surname" type="text" size="50" value="<? echo $results['surname'] ?>" /></td></tr>
    <tr><td class='label'>Forenames</td><td><input name="forenames" type="text" size="50" value="<? echo $results['forenames'] ?>" /></td></tr>
    <tr><td class='label'>Address 1</td><td><input name="address1" type="text" size="50" value="<? echo $results['address1'] ?>" /></td></tr>
    <tr><td class='label'>Address 2</td><td><input name="address2" type="text" size="50" value="<? echo $results['address2'] ?>" /> </td></tr>
    <tr><td class='label'>Town</td><td><input name="town" type="text" size="50" value="<? echo $results['town'] ?>" /></td></tr> 
    <tr><td class='label'>County</td><td><input name="county" type="text" size="50" value="<? echo $results['county'] ?>" /></td></tr>
    <tr><td class='label'>Country</td><td><input name="country" type="text" size="50" value="<? echo $results['country'] ?>" /></td></tr>
    <tr><td class='label'>Postcode</td><td><input name="postcode" type="text" size="50" value="<? echo $results['postcode'] ?>" /></td></tr>
    <tr><td class='label'>Telephone</td><td><input name="telephone" type="text" size="50" value="<? echo $results['telephone'] ?>" /></td></tr>
    <tr><td class='label'>Email</td><td><input name="email" type="text" size="50" value="<? echo $results['email'] ?>" /></td></tr>
    <tr><td class='label'>Notes</td><td><textarea name="notes" cols="50" rows="6"><? echo $results['notes'] ?></textarea></td></tr>
   </table> 
   
   Is this a renewal? <input name="renewal" type="checkbox" value="1">
    <input name="" type="submit" value="Update" />
    <input type="button" value="Cancel" onClick="javascript:window.close();"  /> 
    </form>
    
    <p>Last edited: <? echo $results['last_edited'] ?></p>
    
 <!--   <input id="demo1" type="text" size="50" value="" />
    <a href="javascript:NewCal('demo1','ddmmyyyy')">Pick</a>-->
	  
<? }
elseif ($view == 'update') {
    $today = date('Y-m-d');

$id_lib = mysql_real_escape_string($_GET['id_lib']);
$surname = mysql_real_escape_string($_GET['surname']);
$forenames = mysql_real_escape_string($_GET['forenames']);
$address1 = mysql_real_escape_string($_GET['address1']);
$address2 = mysql_real_escape_string($_GET['address2']);
$town = mysql_real_escape_string($_GET['town']);
$county = mysql_real_escape_string($_GET['county']);
$country = mysql_real_escape_string($_GET['country']);
$postcode = mysql_real_escape_string($_GET['postcode']);
$telephone = $_GET['telephone'];
$email = $_GET['email'];
$registration_date = $_GET['registration_date'];
if ($_GET['renewal'] == 1 ){
$renewal_date = $today;
} else {
$renewal_date =  $_GET['renewal_date'];
}
$notes = mysql_real_escape_string($_GET['notes']);

$sql_str = "UPDATE crc_readers SET id_lib='$id_lib', surname='$surname', forenames='$forenames',  address1='$address1', address2='$address2', town='$town', county='$county', country='$country', postcode='$postcode', telephone='$telephone', email='$email', renewal_date='$renewal_date', notes='$notes', last_edited='$today' WHERE id='$id' LIMIT 1";

mysql_query($sql_str) or die ("Update entry failed!");

echo "<p><a href='javascript:window.close();'>Close and update main page</a></p>"; 
 }	  
elseif ($view == 'new') {	 ?>

   <form action="<? echo $_SERVER['PHP_SELF'] ?>" method="GET" name="myForm">
    <input name="view" type="hidden" value="add" />
    <input name="popup" type="hidden" value="<? echo $_GET['popup'] ?>" />
     <table cellpadding="5" cellspacing="0"> 
    <tr><td class='label'>Library ID (if any)</td><td><input name="id_lib" type="text" size="50" value="<? echo $results['id_lib'] ?>" /></td></tr>
    <tr><td class='label'>Surname</td><td><input name="surname" type="text" size="50" /></td></tr>
    <tr><td class='label'>Forenames</td><td><input name="forenames" type="text" size="50" /></td></tr>
    <tr><td class='label'>Address 1</td><td><input name="address1" type="text" size="50" /></td></tr>
    <tr><td class='label'>Address 2</td><td><input name="address2" type="text" size="50" /> </td></tr>
    <tr><td class='label'>Town</td><td><input name="town" type="text" size="50" /></td></tr> 
    <tr><td class='label'>County</td><td><input name="county" type="text" size="50" /></td></tr>
    <tr><td class='label'>Country</td><td><input name="country" type="text" size="50" /></td></tr>
    <tr><td class='label'>Postcode</td><td><input name="postcode" type="text" size="50" /></td></tr>
    <tr><td class='label'>Telephone</td><td><input name="telephone" type="text" size="50" /></td></tr>
    <tr><td class='label'>Email</td><td><input name="email" type="text" size="50" /></td></tr>
    <tr><td class='label'>Notes</td><td><textarea name="notes" cols="50" rows="6"></textarea></td></tr>
   </table> 
    <input name="" type="submit" value="Add" />   
    </form>
<? } 
elseif ($view == 'add') {

$id_lib = mysql_real_escape_string($_GET['id_lib']);
$surname = mysql_real_escape_string($_GET['surname']);
$forenames = mysql_real_escape_string($_GET['forenames']);
$address1 = mysql_real_escape_string($_GET['address1']);
$address2 = mysql_real_escape_string($_GET['address2']);
$town = mysql_real_escape_string($_GET['town']);
$county = mysql_real_escape_string($_GET['county']);
$country = mysql_real_escape_string($_GET['country']);
$postcode = mysql_real_escape_string($_GET['postcode']);
$telephone = $_GET['telephone'];
$email = $_GET['email'];
$notes = mysql_real_escape_string($_GET['notes']);

$sql_str = "INSERT INTO crc_readers (id, surname, forenames, address1, address2, town, county, country, postcode, telephone, email, registration_date, last_edited, notes) VALUES (NULL, '$surname', '$forenames', '$address1', '$address2', '$town', '$county', '$country', '$postcode', '$telephone', '$email', '$today', '$today', '$notes')";
mysql_query($sql_str) or die ("Add entry failed!");

echo "<p><a href='javascript:window.close();'>Close</a></p>"; 
}
	  ?>
</body>
</html>

