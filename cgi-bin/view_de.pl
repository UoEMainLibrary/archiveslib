#!/home/cpan/bin/perl -w
#

$dirtoget="/data/d1/jpegs/drawnevidence/";
opendir(IMD, $dirtoget) || die("Cannot open directory");
@thefiles= readdir(IMD);
closedir(IMD);

print "Content-type: text/html\n\n";
print "<HTML><BODY>";

foreach $f (@thefiles)
{
  unless ( ($f eq ".") || ($f eq "..") )
  { 
   print "$f<BR>";
	 my $image = ("/data/d4/archives/public_docs/tempimg/$f");
	 print "$image<BR>";

  }
}

print "</BODY></HTML>";
