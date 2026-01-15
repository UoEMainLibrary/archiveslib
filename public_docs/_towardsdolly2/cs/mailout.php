<?
/* To send HTML mail, you can set the Content-type header. */
//$to      = "Grant E. L. Buttars <grant_buttars@yahoo.com>";
//$to      = "Grant E. L. Buttars <grant.buttars@ed.ac.uk>";
$to      = "Centre for Research Collections <is-crc@ed.ac.uk>";
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

$headers .= "From: ".$_GET['name']."<".$_GET['email'].">\r\n";
/* and now mail it */


mail($to, $subject, $message, $headers);

?>