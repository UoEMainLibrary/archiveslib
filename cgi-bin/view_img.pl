#!/home/cpan/bin/perl -w
#
# view_img.pl
#

use CGI qw(:standard);

my $item = param('item');
my $image = param('img');

if ($item eq 'ld') {
$subtitle = 'Laureations and Degrees (1587-1809)';
$alt = 'image from the album';
$ref = 'IN1/ADS/STA/1/1';
$arr ='In bound order.  Research into this volume has revealed that, at some point in its history, it was bound out of order.  As such, pages are not completely chronological.';
$acc_cond ='For preservation reasons, the original of this item will not normally be produced to readers.';
$hi ='155';
$lo = '1';
}

if ($item eq 'rece72') {
$subtitle = 'Rectorial election, 1972';
$alt = 'image from the album';
$ref = 'IN1/ADS/SEC/M/RECE/1972';
$arr ='Reverse chronological order, with the most recent document first';
$acc_cond = 'The original of this item will not normally be produced to readers.  This surrogate has been redacted in accordance with Data Protection legislation.';
$hi ='12';
$lo = '1';
$subdir = 'rece72/';
}

if ($item eq 'rec') {
$subtitle = 'Rector (communications between offices of the University Secretary and the Rector during Brown\'s tenure)';
$alt = 'image from the album';
$ref = 'IN1/ADS/SEC/M/REC(3)';
$arr ='Reverse chronological order, with the most recent document first';
$acc_cond = 'The original of this item will not normally be produced to readers.  This surrogate has been redacted in accordance with Data Protection legislation.';
$hi ='179';
$lo = '0';
$subdir = 'rec/';
}

if ($item eq 'ins74') {
$subtitle = 'Installation of Rector, 1974';
$alt = 'image from the album';
$ref = 'IN1/ADS/SEC/M/RECE/INS/1974';
$arr ='Reverse chronological order, with the most recent document first';
$acc_cond = 'The original of this item will not normally be produced to readers.  This surrogate has been redacted in accordance with Data Protection legislation.';
$hi ='22';
$lo = '1';
$subdir = 'ins74/';
}

if ($item eq 'ruc') {
$subtitle = 'Rector\'s Unofficial Commission';
$alt = 'image from the album';
$ref = 'IN1/ADS/SEC/M/REC/RUC';
$arr ='Reverse chronological order, with the most recent document first';
$acc_cond = 'The original of this item will not normally be produced to readers.  This surrogate has been redacted in accordance with Data Protection legislation.';
$hi ='176';
$lo = '1';
$subdir = 'ruc/';
}

if ($item eq 'rece72') {$subtitle = 'Rectorial election, 1972';}

if ($item eq 'rec') {$subtitle = 'Rector (communications between offices of the University Secretary and the Rector during Brown\'s tenure)';}

if ($item eq 'ins74') {$subtitle = 'Installation of Rector, 1974';}

if ($item eq 'ruc') {$subtitle = 'Rector\'s Unofficial Commission';}

# print headers

print "Content-type: text/html\n\n";

open(HTML_INPUT, "/home/archives/public_docs/includes/header.php");
while (<HTML_INPUT>) {
  print $_;
}


print <<EOF;

<script language="JavaScript">
<!--
/*
No rightclick script v.2.5
(c) 1998 barts1000
barts1000@aol.com
Don't delete this header!
*/

var message="Sorry, that function is disabled.  Images are copyright, Edinburgh University Library."; 

// Don't edit below!

function click(e) {
if (document.all) {
if (event.button == 2) {
alert(message);
return false;
}
}
if (document.layers) {
if (e.which == 3) {
alert(message);
return false;
}
}
}
if (document.layers) {
document.captureEvents(Event.MOUSEDOWN);
}
document.onmousedown=click;
// --> 

</script>

EOF

print "<title>Gallery: $subtitle</title>";

print "<META HTTP-EQUIV='imagetoolbar' CONTENT='no'>";

open(HTML_INPUT, "/home/archives/public_docs/includes/lowerheader.php");
while (<HTML_INPUT>) {
  print $_;
}

open(HTML_INPUT, "/home/archives/public_docs/includes/gallery_menu.shtml");
while (<HTML_INPUT>) {
  print $_;
}

if ($image > $hi) {$image = $hi }
if ($image < $lo) {$image = $lo }
my $image_u = ($image+1);
my $image_d = ($image-1);

  print <<EOF;
	
<div><a href="/">Special Collections : Archival Resources</a> :: <a href="/gallery/">Gallery</a></div>
  
	<h1>$subtitle</h1>
	<br />
		<table summary="" width="90%">
<tr><td width="200" valign="top"><b>Reference code:</b></td><td>$ref</td></tr>
<tr><td valign="top"><b>Arrangement:</b></td><td>$arr</td></tr>
<tr><td valign="top"><b>Conditions governing access:</b></td><td>$acc_cond</td></tr>
<tr><td valign="top"><b>Image:</b></td><td>$image of $hi</td></tr>
<tr><td valign="top"><b>Navigation:</b></td><td><a href='/gallery/' title='Gallery index'><img src='/graphics/up.gif' width="25"  alt='Gallery index' border='0'>Up</a> | <a href="view_img.pl?item=$item&img=$lo">Start</a> | <a href="view_img.pl?item=$item&img=$image_d">Previous</a> | <a href="view_img.pl?item=$item&img=$image_u">Next</a> | <a href="view_img.pl?item=$item&img=$hi">End</a></td></tr>
</table>
	
<table summary="image" align="center" cellpadding="10">
<tr><td><img alt="$alt" src="http://www.archives.lib.ed.ac.uk/dao/$subdir$image.jpg" /></td></tr>
</table>

<p align="center"><i>Image &copy; Edinburgh University Library</i></p>

EOF




open(HTML_INPUT, "/home/archives/public_docs/includes/footer.php");
while (<HTML_INPUT>) {
  print $_;
}
