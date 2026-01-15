<?php
                     
$ftp_server = "holyrood.ed.ac.uk";
$ftp_user = "gbuttars";
$ftp_pass = "Comebm3d"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title></title>
</head>
<body>

<?php // set up a connection or die
$conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server"); 

// try to login
if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
    echo "Connected as $ftp_user@$ftp_server\n";
} else {
    echo "Couldn't connect as $ftp_user\n";
}

// get contents of the current directory
$contents = ftp_nlist($conn_id, ".");

// output $contents
//$list_item = (var_dump($contents));


foreach ($contents as $value) {
    echo "<p>".$value."</p>";
}

?> 
<hr />

</body>
</html>
