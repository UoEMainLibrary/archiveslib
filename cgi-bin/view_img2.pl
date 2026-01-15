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
$arr ='In bound order';
$hi ='155';
$lo = '1';
}

if ($item eq 'rece72') {
$subtitle = 'Rectorial election, 1972';
$alt = 'image from the album';
$ref = 'IN1/ADS/SEC/M/RECE/1972';
$arr ='Reverse chronological order, with the most recent document first';
$hi ='12';
$lo = '1';
$subdir = 'rece72/';
}

if ($item eq 'rec') {
$subtitle = 'Rector (communications between offices of the University Secretary and the Rector during Brown\'s tenure)';
$alt = 'image from the album';
$ref = 'IN1/ADS/SEC/M/REC(3)';
$arr ='Reverse chronological order, with the most recent document first';
$hi ='159';
$lo = '0';
$subdir = 'rec/';
}

if ($item eq 'ins74') {
$subtitle = 'Installation of Rector, 1974';
$alt = 'image from the album';
$ref = 'IN1/ADS/SEC/M/RECE/INS/1974';
$arr ='Reverse chronological order, with the most recent document first';
$hi ='22';
$lo = '1';
$subdir = 'ins74/';
}

if ($item eq 'ruc') {
$subtitle = 'Rector\'s Unofficial Commission';
$alt = 'image from the album';
$ref = 'IN1/ADS/SEC/M/REC/RUC';
$arr ='Reverse chronological order, with the most recent document first';
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

open(HTML_INPUT, "/home/archives/public_docs/includes/top_header.shtml");
while (<HTML_INPUT>) {
  print $_;
}

print "<title>Gallery: $subtitle</title>";

open(HTML_INPUT, "/home/archives/public_docs/includes/l_head_gal.shtml");
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
	
	<h2 class="main_head">$subtitle</h2>
		<table summary="">
<tr><td><b>Reference code:</b></td><td>$ref</td></tr>
<tr><td><b>Arrangement:</b></td><td>$arr</td></tr>
<tr><td><b>Image:</b></td><td>$image of $hi</td></tr>
<tr><td><b>Navigation:</b></td><td><a href='/gallery/'><img src='/graphics/up.gif' width="20"  alt='Gallery index' border='0'>Up</a> | <a href="view_img2.pl?item=$item&img=$lo">Start</a> | <a href="view_img2.pl?item=$item&img=$image_d">Previous</a> | <a href="view_img2.pl?item=$item&img=$image_u">Next</a> | <a href="view_img2.pl?item=$item&img=$hi">End</a></td></tr>
</table>
	
<table summary="image" align="center" cellpadding="10">
<tr><td><img alt="$alt" src="http://www.archives.lib.ed.ac.uk/dao/$subdir$image.jpg" /></td></tr>
</table>



EOF




open(HTML_INPUT, "/home/archives/public_docs/includes/footer.shtml");
while (<HTML_INPUT>) {
  print $_;
}
