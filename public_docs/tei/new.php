<?php 
$self = $_SERVER['PHP_SELF'];
$view = $_GET['view'];
$ead = $_GET['ead'];
$id = $_GET['id'];
$mrid = str_replace("/", "-", "$id");;
$node = $_GET['node'];
$source = $_GET['source']; 

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body { 
margin: 0px;
}
body,div,p,td,button {
font-family: arial;
font-size: 10pt;
}
td,p {
padding: 5px;
}

div.fonds {
		float: right;
	top: 270px;
  width: 550px;
  margin: 5px;
  border: 3px solid #660033;
    background-color: #ffffcc;
    padding: 5px;
}

div.contains {
  position: absolute;
	left: 5px;
	top: 230px;
  width: 750px;
  margin: 5px;
  padding: 5px;
  border: 3px solid #660033;
  background-color: #ffffff;
}

div.component {
  position: absolute;
	left: 5px;
	top: 270px;
  width: 450px;
  margin: 5px;
  padding: 5px;
  border: 3px solid #660033;
  background-color: #ffffcc;
}
div.component-list {	
  position: absolute;
	left: 500px;
	top: 270px;
  width: 550px;
  margin: 5px;
  padding: 5px;
  border: 3px solid #660033;
}

div.images {
	position: absolute;
	top: 270px;
	left: 1100px;
  width: 370px;
  margin: 5px;
  padding: 5px;
	text-align: center;
}
div.teiitem {	
  position: absolute;
	left: 500px;
	top: 270px;
  width: 550px;
  margin: 5px;
  padding: 5px;
  border: 3px solid #660033;
}

div.banner {
height: 150px;
font-size: 50pt;
text-align: center;
left: 0px;
right: 0px;
padding: 25pt;
background-image: url("https://images.is.ed.ac.uk/MediaManager/srvr?mediafile=/Size4/UoEcar-1-NA/1002/0002915c.jpg");
background-position: center; /* Center the image */
background-repeat: no-repeat; /* Do not repeat the image */
background-size: cover; /* Resize the background image to cover the entire container */
}

div.linksbar {
  height:30px;
	width: 100%;
  position: absolute;
	top: 180px;
	left: 0px;
  background-color: #000000;
	color: #ffffff;
	padding: 5px;
	font-size: 14pt;
}

a.linksbar {
color: #ffffff;
}

li {
padding: 5px;
}
div.list_item {

  padding: 11px;
	margin-left: 11px;
	}
.collapsible {
  cursor: pointer;
  padding: 11px;
  width: 650;
  border: none;
  text-align: left;
  outline: none;
  background-color: #ffffff;
}

.active, .collapsible:hover {
  background-color: #ffffff;
}

.collapsible:after {
  content: '\002B';
  color: #000000;
  font-weight: bold;
  float: left;
  margin-right: 5px;
}

.active:after {
  content: "\2212";
}

.content {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  background-color: #ffffff;
}
td.ead_label {
  font-weight: bold;
  width: 150px;
}
</style>
</head>
<body>
<div class="banner">Carmichael Watson</div>
<div class="linksbar"><a class="linksbar" href="<?php echo $self; ?>?view=ead">Home</a></div>
<?php
if ($view == "eadc") {
#show ead
include "components/eadc.php";

include "components/images.php";

# check for partner TEI file
$teifile= "teixml/GB-237-".$mrid.".xml";
$teinode= "GB-237-".$mrid;

$output = explode("-",$mrid);
$newout = $output[count($output)-1];
$chop = strlen($newout)+1;
$parent_tei = substr($mrid, 0, -$chop);
$parent_teifile = "teixml/GB-237-".$parent_tei.".xml";


if (file_exists($teifile)) {
$teilevel = "whole";
include "components/teic.php";
}
elseif (file_exists($parent_teifile)) {
$teilevel = "item";
$teifile=$parent_teifile;
include "components/teic.php";
}
else {
include "components/teic.php";
echo "<p>No transcription available</p>";
}
}
elseif ($view == "ead") {
#show full tei
include "components/ead.php";
}

elseif ($view == "name") {
#show name details
include "name.php";
}
else {
echo "No view selected";
}

 ?> 
 
 <script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>

</body>
</html>