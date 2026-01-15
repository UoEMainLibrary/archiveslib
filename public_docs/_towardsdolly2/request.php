<?

include "includes/top_header.php";

echo "<title>Towards Dolly: Catalogue - Consultation Request</title>";

include "includes/lower_header_main.php"; 

############################################################################################## ?>

<h1>Catalogue - Consultation Request</h1>

<?php	
$rep_id = substr($_GET['refid'], 0, 6);

$replaceable = "-";
$replacewith = "/";
$tempstr = str_replace($replaceable, $replacewith, $_GET['refid']);

## echo $rep_id;

if ($rep_id == "GB-238") { ## check if NCL
echo "<p>Consult at:</p>";
echo "<div style='margin-left:10px;'><strong>New College Library</strong><br />Mound Place<br />Edinburgh<br />EH1 2LU<br />Tel: 0131 650 8957<br />Fax: 0131 650 7952<br />
Email: <a href='mailto:new.college.library@ed.ac.uk'>new.college.library@ed.ac.uk</a></div>";

$replaceable2 = "GB/238/";
			$replacewith2 = "GB 238 ";
			$refstr = str_replace($replaceable2, $replacewith2, $tempstr); 

}
elseif ($rep_id == "GB-237") { ## check if Spec Coll
echo "<p>Consult at:</p>";
echo "<div style='margin-left:10px;'><strong>Centre for Research Collections</strong><br />Main Library<br />George Square<br />Edinburgh<br />EH8 9LJ<br />Tel: 0131 650 8379<br />Fax: 0131 650 2922<br />
Email: <a href='mailto:is-crc@ed.ac.uk'>is-crc@ed.ac.uk</a></div>";
if (fnmatch("GB-237-Coll-*", $_GET['refid'])) {
			$replaceable2 = "GB/237/Coll/";
			$replacewith2 = "GB 237 Coll-";
			$refstr = str_replace($replaceable2, $replacewith2, $tempstr); }
			elseif (fnmatch("GB-237-EUA-*", $_GET['refid']))  {
			$replaceable2 = "GB/237/EUA/";
			$replacewith2 = "GB 237 EUA ";
			$refstr = str_replace($replaceable2, $replacewith2, $tempstr);
			}
			elseif (fnmatch("GB-237-BAI-*", $_GET['refid']))  {
			$replaceable2 = "GB/237/BAI/";
			$replacewith2 = "GB 237 BAI ";
			$refstr = str_replace($replaceable2, $replacewith2, $tempstr);
			}
			elseif (fnmatch("GB-237-PJM-*", $_GET['refid']))  {
			$replaceable2 = "GB/237/PJM/";
			$replacewith2 = "GB 237 PJM ";
			$refstr = str_replace($replaceable2, $replacewith2, $tempstr);
			}
			else {
			$replaceable2 = "GB/237/";
			$replacewith2 = "GB 237 ";
			$refstr = str_replace($replaceable2, $replacewith2, $tempstr); 
			}

}

if (!isset ($_GET['submit'])) {

##echo $rep_id; ?>

		<p>You can use the following online form to make arrangements to consult this item</p>
<table summary="" width="100%" cellpadding="5" border="0">
<form action="<?php echo $SERVER['PHP_SELF'] ?>" method="get">


	<?php	echo "<tr><td width='150' valign='top'><b>Title</b></td><td>".$_GET['title']."</td></tr>"; 
	
	echo "<input type='hidden' name='rep_id' value='".$rep_id."' />";	
echo "<input type='hidden' name='title' value='".$_GET['title']."' />";	 		

## creating normal reference codes from id strings

			
			
## end			
			echo "<tr><td valign='top'><b>Reference Code</b></td><td>".$refstr."</td></tr>";
echo "<input type='hidden' name='unitid' value='".$refstr."' />"; 
echo "<input type='hidden' name='refid' value='".$_GET['refid']."' />";
			
			if ($_GET['warning'] == 2) {
			echo "<tr><td valign='top'><b>Note</b></td><td>This is a ".$_GET['level']." level description and not the lowest level in this part of the catalogue.  Please make sure that you are wanting to consult everything under this Reference Code. Please note that requests to see excessive amounts of material at the same time may be declined.  If you are unsure, please contact us.</td></tr>"; 
			
}

echo "<tr><td class='label'>Your name</td><td><input type='text' name='name' size='70' /></td></tr>";
echo "<tr><td class='label'>Your email address</td><td><input type='text' name='email' size='70' /></td></tr>";
echo "<tr><td class='label'>Date of intended visit</td><td><input type='text' name='date' size='70' /></td></tr>"; ?>
<tr><td class='label' valign="top">Message for us</td><td>
<textarea rows="4" cols="70" name="msg"></textarea>
</td></tr>
<tr><td></td><td><input type="submit" name="submit" value="Send Request" /></td></tr>
</form>
</table>

<?	}

elseif ($_GET['submit'] == "Send Request") { ?>




<p>Please check details below.  Use your BACK button to make any changes.</p>

<form action="<?php $PHP_SELF ?>" method="get">
<?php

echo "<table cellpadding='5'>";
echo "<input type='hidden' name='rep_id' value='".$_GET['rep_id']."' />";	
echo "<input type='hidden' name='refid' value='".$_GET['refid']."' />";
echo "<input type='hidden' name='unitid' value='".$_GET['unitid']."' />"; 
echo "<input type='hidden' name='title' value='".$_GET['title']."' />"; 
echo "<input type='hidden' name='name' value='".$_GET['name']."' />"; 
echo "<input type='hidden' name='email' value='".$_GET['email']."' />";  
echo "<input type='hidden' name='date' value='".$_GET['date']."' />";
echo "<input type='hidden' name='msg' value='".$_GET['msg']."' />";

echo "<tr><td class='label'>Reference code</td><td>".$_GET['unitid']."</td></tr>";
echo "<tr><td class='label'>Title</td><td>".$_GET['title']."</td></tr>";
echo "<tr><td class='label'>Your name</td><td>".$_GET['name']."</td></tr>";
echo "<tr><td class='label'>Your email</td><td>".$_GET['email']."</td></tr>";
echo "<tr><td class='label'>Date of intended visit</td><td>".$_GET['date']."</td></tr>";
echo "<tr><td class='label'>Your message</td><td>".$_GET['msg']."</td></tr>";
echo "</table>";

if (preg_match("/201/i", $_GET['date'])) {
echo "<input type='submit' name='submit' value='Send' />";
	
} else {
    echo "<p style ='color: red;'>Date invalid. Please use your BACK button and enter date so that the year has four digits.</p>";
}
 ?>

</form>

<?php }

elseif ($_GET['submit'] == "Send") { 

$cat_url = "<a href='http://www.archives.lib.ed.ac.uk/towardsdolly/cs/viewcat.pl?id=".$_GET['refid']."&amp;view=basic'>".$_GET['unitid']."</a>";

$subject = "Manuscripts/Archives consultation";

$message = "I would like to consult the following:<br><br>".$_GET['title']."<br><br>Reference code: ".$cat_url."<br /><br />Date of intended visit: ".$_GET['date']."<br /><br />".$_GET['msg']."<br /><br />[This email was sent via an online form from the <a href='http://www.archives.lib.ed.ac.uk/towardsdolly/'>Towards Dolly website</a>]";

echo "<p>You have sent us the following message</p>";
echo "<table cellpadding='5' style='background-color: #ffff99'>";
echo "<tr><td class='label'>From</td><td>".$_GET['name'].", ".$_GET['email']."</td></tr>";
echo "<tr><td class='label'>Subject</td><td>".$subject."</td></tr>";
echo "<tr><td class='label'>Message</td><td>".$message."</td></tr>";
echo "</table>";

echo "<p>Please note that if you are not already registered as a <a href='http://www.ed.ac.uk/schools-departments/information-services/services/library-museum-gallery/crc/reading-rooms'>Reader of the Centre of Research Collections</a> you will need to do so.</p>";



include "cs/mailout.php";
 }


 ##############################################################################################
include "includes/footer.php";

?>