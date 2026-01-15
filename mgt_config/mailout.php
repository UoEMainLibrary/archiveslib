<? 

/* To send HTML mail, you can set the Content-type header. */
if ($recpt == "1") {
$to      = "Grant E. L. Buttars <grant.buttars@ed.ac.uk>";
} elseif ($recpt == "2") {
$to      = "Centre for Research Collections <grant.buttars@ed.ac.uk>";
}
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

$headers .= "From: ".$name."<".$user."@".$domain.">\r\n";
/* and now mail it */

$message2 = ($message."<br /><br />[This email was sent via an online form at <a href='http://www.taybank.org.uk/contact.php'>http://www.taybank.org.uk/contact.php</a>.  User IP: ".$_SERVER['REMOTE_ADDR'].".]");
mail($to, $subject, $message2, $headers);

 ?>
