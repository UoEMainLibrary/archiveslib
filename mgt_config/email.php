	  <? 
	  
	  $go = $_GET['go'];
	  $name = $_GET['name'];
	  $user = $_GET['user'];
	  $domain = $_GET['domain'];
	  $subject = $_GET['subject'];
	  $when = $_GET['when'];
	  $eventtitle = $_GET['eventtitle'];
	  $who = $_GET['who'];
	  $room = $_GET['room'];
	  $numbers = $_GET['numbers'];
	  $layout = $_GET['layout'];
	  $specialrequirements = $_GET['message'];
	  $items = $_GET['items'];
	  $handling = $_GET['handling'];
	if (!isset ($go)) {?>
	
	<b>Note: Please put something in every box</b>
<FORM METHOD=GET ACTION=<?echo $PHP_SELF?>>
<input type="hidden" name="date" value="<? echo date("Y-m-d") ?>" />
<input type="hidden" name="d_date" value="<? echo date("l d F Y, H:i:s",$now) ?>" />
<table>
<tr><td>Name:</td><td><input type="text" name="name" size="40" /></td></tr>
<tr><td>Email:</td><td><input type="text" name="user" size="13" /> @ <input type="text" name="domain" size="20" /></td></tr>
<tr><td>Subject:</td><td><input type="text" name="subject" size="40" /></td></tr>

    <td width="300" valign="top"><p>Date, time and duration of event </p></td>
    <td valign="top"><textarea name="when" cols="70" rows="5"></textarea></td>
  </tr>
  <tr>
    <td width="300" valign="top"><p>Title of event </p></td>
    <td valign="top"><textarea name="eventtitle" cols="70" rows="5"></textarea></td>
  </tr>
  <tr>
    <td width="300" valign="top"><p>Responsible person and contact details (phone, email, address) </p></td>
    <td valign="top"><textarea name="who" cols="70" rows="5"></textarea></td>
  </tr>
  <tr>
    <td width="300" valign="top"><p>Room requested</p></td>
    <td valign="top"><select name="room"><option> - please select - </option><option value="5">5th floor</option><option value="6">6th floor</option></select></td>
  </tr>
  <tr>
    <td width="300" valign="top"><p>Numbers attending (a list of names will be taken on the day) </p></td>
    <td valign="top"><input name="numbers" type="text" size="70" /></td>
  </tr>
  <tr>
    <td width="300" valign="top"><p>Layout of room</p></td>
    <td valign="top"><select name="layout"><option> - please select - </option><option value="lecture">Lecture</option><option value="square">Square of tables around a hollow square</option><option value="block">Solid block of tables</option></select></td>
  </tr>
  <tr>
    <td width="300" valign="top"><p>Any special requirements </p></td>
    <td valign="top"><textarea name="specialrequirements" cols="70" rows="5"></textarea></td>
  </tr>
  <tr>
    <td width="300" valign="top"><p>Collections items requested, including shelfmarks/reference codes (3 weeks notice needed) </p></td>
    <td valign="top"><textarea name="items" cols="70" rows="5"></textarea></td>
  </tr>
  <tr>
    <td width="300" valign="top"><p>Who is to handle collection items (organiser or all attending)? </p></td>
    <td valign="top"><textarea name="handling" cols="70" rows="5"></textarea></td>
  </tr>

<tr><td></td><td><input type=submit value="Send message" NAME=go>&nbsp;&nbsp;
<input type=reset value="Clear form"></td></tr>
</table>
</form>


<?	
}
	if (isset($go)) {
		if ($user == "") { 
		echo "<p>You have not entered a valid email address (the part before the @ symbol).</p><FORM><INPUT TYPE='button' VALUE='Back' onClick='history.go(-1)'></FORM>";
		}
		elseif ($domain == "") { 
		echo "<p>You have not entered a valid email address  (the part after the @ symbol).</p><FORM><INPUT TYPE='button' VALUE='Back' onClick='history.go(-1)'></FORM>";
		}
		else {
		
		/* To send HTML mail, you can set the Content-type header. */

$to      = "Grant E. L. Buttars <grant.buttars@ed.ac.uk>";

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

$headers .= "From: ".$name."<".$user."@".$domain.">\r\n";
$message = "<table width='100%' cellpadding='5' border='1' style='background-color: #ffffcc; color: #660000;'><td width='300' valign='top'>Date, time and duration of event </td><td valign='top'>".$when."</td></tr>\r\n<tr><td width='300' valign='top'>Title of event </td><td valign='top'>".$eventtitle."</td></tr>\r\n <tr><td width='300' valign='top'>Responsible person and contact details</td><td valign='top'>".$who."</td></tr>\r\n<tr><td width='300' valign='top'>Room requested</td><td valign='top'>".$room."th floor</td></tr>\r\n<tr><td width='300' valign='top'>Numbers attending</td><td valign='top'>".$numbers."</td></tr>\r\n<tr><td width='300' valign='top'>Layout</td><td valign='top'>".$layout."</td></tr>\r\n<tr><td width='300' valign='top'>Any special requirements </td><td valign='top'>".$specialrequirements."</td></tr>\r\n<tr><td width='300' valign='top'>Collections items requested</td><td valign='top'>".$items."</td></tr>\r\n<tr><td width='300' valign='top'>Who is to handle collection items</td><td valign='top'>".$handling."</td></tr>\r\n</table>";
/* and now mail it */

$message2 = ($message."<br /><br />[This email was sent via an online form at <a href='".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."'>".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."</a>.  User IP: ".$_SERVER['REMOTE_ADDR'].".]");
mail($to, $subject, $message2, $headers);

		echo "<p>Message sent.</p>";
		
		##<i>$subject</i> from <i>$email</i> was successfully sent to <i>".htmlspecialchars($to)."</i>.
		
		echo "<p>Your IP address has been logged as ".$_SERVER['REMOTE_ADDR'].".</p>";

		}
	} ?>