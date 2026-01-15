<?php

include "../includes/header.php";

$item = $_GET['item'];
$image = $_GET['img'];

if ($item == 'rece72') {
$subtitle = 'Rectorial election, 1972';
$alt = 'image from the album';
$ref = 'IN1/ADS/SEC/M/RECE/1972';
$arr ='Reverse chronological order, with the most recent document first';
$acc_cond = 'The original of this item will not normally be produced to readers.  This surrogate has been redacted in accordance with Data Protection legislation.';
$hi ='12';
$lo = '1';
$subdir = 'rece72/';
}

if ($item == 'rec') {
$subtitle = 'Rector (communications between offices of the University Secretary and the Rector during Brown\'s tenure)';
$alt = 'image from the album';
$ref = 'IN1/ADS/SEC/M/REC(3)';
$arr ='Reverse chronological order, with the most recent document first';
$acc_cond = 'The original of this item will not normally be produced to readers.  This surrogate has been redacted in accordance with Data Protection legislation.';
$hi ='179';
$lo = '0';
$subdir = 'rec/';
}

if ($item == 'ins74') {
$subtitle = 'Installation of Rector, 1974';
$alt = 'image from the album';
$ref = 'IN1/ADS/SEC/M/RECE/INS/1974';
$arr ='Reverse chronological order, with the most recent document first';
$acc_cond = 'The original of this item will not normally be produced to readers.  This surrogate has been redacted in accordance with Data Protection legislation.';
$hi ='22';
$lo = '1';
$subdir = 'ins74/';
}

if ($item == 'ruc') {
$subtitle = 'Rector\'s Unofficial Commission';
$alt = 'image from the album';
$ref = 'IN1/ADS/SEC/M/REC/RUC';
$arr ='Reverse chronological order, with the most recent document first';
$acc_cond = 'The original of this item will not normally be produced to readers.  This surrogate has been redacted in accordance with Data Protection legislation.';
$hi ='176';
$lo = '1';
$subdir = 'ruc/';
}

if ($image > $hi) {$image = $hi; }
if ($image < $lo) {$image = $lo; }
$image_u = $image+1;
$image_d = $image-1;
echo "<title>Gordon Brown as Rector</title>";
include"../includes/lowerheader.php";
echo "<div><a href='/'>Special Collections : Archives Catalogues &amp; Resources</a></div>";

if (isset ($image)) {
echo "<h1>Gordon Brown as Rector</h1>";
echo "<h2>$subtitle</h2>	<br />";

echo "<table summary='' width='90%'>
<tr><td width='200' valign='top'><b>Reference code:</b></td><td>".$ref."</td></tr>
<tr><td valign='top'><b>Arrangement:</b></td><td>".$arr."</td></tr>
<tr><td valign='top'><b>Conditions governing access:</b></td><td>".$acc_cond."</td></tr>
<tr><td valign='top'><b>Image:</b></td><td>".$image." of ".$hi."</td></tr>
<tr><td valign='top'><b>Navigation:</b></td><td><a href='./' title='section index'><img src='/graphics/up.gif' width='25'  alt='Gallery index' border='0'>Up</a> | <a href='./?item=$item&img=$lo'>Start</a> | <a href='./?item=$item&img=$image_d'>Previous</a> | <a href='./?item=$item&img=$image_u'>Next</a> | <a href='./?item=$item&img=$hi'>End</a></td></tr>
</table>
	
<table summary='image' align='center' cellpadding='10'>
<tr><td><img alt='$alt' src='http://www.archives.lib.ed.ac.uk/dao/".$subdir.$image.".jpg' /></td></tr>
</table>";

}

else { ?>

<h1>Gordon Brown as Rector</h1>
<br />

<p>Gordon Brown served as University Rector from session 1972-1973 through to 1974-1975.  This material relates to his election, installation and tenure of the post and to the unofficial commission he set up to look into the structure of the University.</p>

<p>University Secretary's files:</p>
<ul>
<li><a href="./?item=rece72&img=1">IN1/ADS/SEC/B/M/RECE/1972</a>: <b>Rectorial election, 1972</b> [12 images]<br /><br /></li>
<li><a href="./?item=rec&img=0">IN1/ADS/SEC/B/M/REC/3</a>: <b>Rector</b> (communications between the offices of the University Secretary and the Rector, during Brown's tenure) [179 images]<br /><br /></li>
<li><a href="./?item=ins74&img=1">IN1/ADS/SEC/B/M/RECE/INS/1974</a>: <b>Installation of Gordon Brown as Rector, 1974</b> [22 images]<br /><br /></li>
<li><a href="./?item=ruc&img=1">IN1/ADS/SEC/B/M/REC/RUC</a>: <b>Rector's Unofficial Commission</b> [176 images]<br /><br /></li>
</ul>

<p>Quite extensive information on Gordon Brown can also be found in back copies of <i><a href="http://discovered.ed.ac.uk/44UOE_VU1:default_scope:44UOE_ALMA2183336410002466" target="_blank">The Student</a></i> which are available on open access microfilm in our Reading Room.</p>


<?php }

include"../includes/footer.php";

?>

