<?php
      ##  $hostname = 'morse.ucs.ed.ac.uk';
		
		//$hostname = 'lac-php-live1.is.ed.ac.uk';
		$hostname = 'localhost';

   ##  $username = 'speccoll';
	 

   ##  $password = 'arch1ve';
	 
	 	 $username = 'gbuttars';

     $password = 'actijij4';
	 
				
		$dbname= 'speccoll';

define("MYSQLIMODE", true);				
if (MYSQLIMODE) {
	$id_link = mysqli_connect($hostname, $username, $password);
	mysqli_select_db($id_link, $dbname);
} else {						
	$id_link = mysql_connect($hostname, $username, $password);
}
?>
