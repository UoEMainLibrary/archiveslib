#!/home/cpan/bin/perl -w
#

use Net::FTP;
use Cwd;

$dirtoget="/data/d4/archives/source_docs/isad";
opendir(IMD, $dirtoget) || die("Cannot open directory");
@thefiles= readdir(IMD);
closedir(IMD);

print "Content-type: text/html\n\n";
print "<HTML><BODY>";


chdir($dirtoget);


my $ldir = getcwd();

print "Local directory is\: ",$ldir;
print"<HR><BR>";

foreach $lf (@thefiles)
{
  unless ( ($lf eq ".") || ($lf eq "..") )
  { 
   print "$lf<BR><BR>";

  }
}

$ftp = Net::FTP->new("archiveshub.lib.ed.ac.uk")    or die "Can't connect: $@\n";
$ftp->login("cheshire", "0r1enta1")       or die "Couldn't login\n";

$ftp->cwd("/home/cheshire/cheshire/ead/DATA");
print "Remote directory is\: ", $ftp->pwd(), "<HR><BR>";

print "Current remote files are\: <BR><BR>";



print "</BODY></HTML>";
