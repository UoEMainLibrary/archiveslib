<?php

## create a redirect to an image in Luna based on variable 'workid' ##

$workid = $_GET['workid'];
$baseurl = "http://images.is.ed.ac.uk/luna/servlet/view/search?q=work_record_id=";

if (isset($workid)) {
	
	$urlpath = $baseurl.$workid;
	
##	echo "<a href='".$urlpath."'>".$urlpath."</a>";
	
	header("Location: $urlpath");
	exit;
	
header( $urlpath );
	
}
else {  ?>
	
<form action="<?php echo $_SERVER['PHP_SELF'] ?>">
<input name="workid" type="text" />
<input type="submit" />
</form>	
	
<?php	
}

?>