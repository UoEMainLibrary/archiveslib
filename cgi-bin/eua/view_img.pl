#!/home/cpan/bin/perl -w
#
# view_img.pl
#

use CGI qw(:standard);
my $image = param('img');
my $caption = param ('cap');

print "Content-type: text/html\n\n";
print <<ENDHTML;
<HTML>
<HEAD>
<TITLE>Perl Variable Test</TITLE>
</HEAD>
<BODY>

<P>Image: $image: $caption</P>

<img alt="image" src="http://www.nahste.ac.uk/media/images/$image.jpg" />
</BODY>
</HTML>

ENDHTML


