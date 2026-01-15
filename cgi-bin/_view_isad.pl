#!/home/cpan/bin/perl -w
#
# view_isad.pl
#

use strict;
use XML::Twig;
use Storable;
use Fcntl;
use MLDBM qw(DB_File Storable);         # DB_File and Storable


# configuration section ####################################################

my $repository_root = "/home/archives/repository";
my $view_isad_url = "http://www.archives.lib.ed.ac.uk/cgi-bin/view_isad.pl";

############################################################################

my $isad_root = "$repository_root/isad";

my %form_data;
my %idtable;
tie %idtable, 'MLDBM', "$isad_root/idtable.mldbm", O_RDONLY, 0640 or die $!;

undef $/;	# get entire files at once when reading

# pull_CGI_args
#
# Standard CGI read stuff nicked from somewhere rather than take the 
# overhead of the full CGI.pm
#########################################################################

sub pull_CGI_args {
  my $my_data;
  if($ENV{'REQUEST_METHOD'} eq "GET") { 
    $my_data = $ENV{'QUERY_STRING'}; 
  } else {
    my $data_length = $ENV{'CONTENT_LENGTH'}; 
    my $bytes_read = read(STDIN, $my_data, $data_length); 
  } 
  
  my @name_value_array = split(/&/, $my_data); 
  
  # Here's where we do the actual work. We're going to cycle 
  # through @name_value_array to decode the name=value pairs 
  
  foreach my $name_value_pair (@name_value_array)  { 
    my ($name, $value) = split(/=/, $name_value_pair); 
    $name =~ tr/+/ /; 
    $value =~ tr/+/ /; 
    $name =~ s/%(..)/pack("C",hex($1))/eg; 
    $value =~ s/%(..)/pack("C",hex($1))/eg; 

# Finally, we'll load the variables into an associative array 
# so we can use it when we need it. 

    if($form_data{$name}) { 
      $form_data{$name} .= "\t$value"; 
    } else { 
      $form_data{$name} = $value; 
    } 
  } 
}

# main
#
#########################################################################

&pull_CGI_args;

my $id = $form_data{"id"} || die "no id specified";
my $view = $form_data{"view"} || die "no view specified";

# load the master table mapping document IDs to location in the 
# filesystem. Obtain the working directory and title of the document
# being requested

exists $idtable{$id} || die "key $id doesn't exist";
my ($component_dir, $titletext, $lowdate, $highdate, $level) = @{$idtable{$id}};

(($view eq "basic") || ($view eq "admin")) || die "invalid view";

# print headers

print "Content-type: text/html\n\n";

open(HTML_INPUT, "/home/archives/public_docs/includes/top_header.shtml");
while (<HTML_INPUT>) {
  print $_;
}

print "<title>Catalogue entry - $titletext</title>";

open(HTML_INPUT, "/home/archives/public_docs/includes/lower_header.shtml");
while (<HTML_INPUT>) {
  print $_;
}

open(HTML_INPUT, "/home/archives/public_docs/includes/catalogues_menu.shtml");
while (<HTML_INPUT>) {
  print $_;
}


if ($view eq "basic") {

# print navigation list at head of page

  my @ancestors = split /\//, $component_dir;
  pop @ancestors;		# last member is current component

  unless (scalar(@ancestors) == 0) {
    my $count = 0;
    print "<p>\n";
    foreach my $ancestor (@ancestors) {
      print "&nbsp;&nbsp;&nbsp;&nbsp;" x $count;
      print "<a href=\"$view_isad_url?id=$ancestor&view=$view\">$idtable{$ancestor}[1]</a><br />\n";
      $count++;
    }
    print "</p>\n";
  }
}

# print pre-built HTML body

open(HTML_INPUT, "$isad_root/$component_dir/$view.html");
while (<HTML_INPUT>) {
  print $_;
}

if ($view eq "basic") {
  print <<EOF;
<tr><td colspan="2" align="center" valign="middle" class="title"><p>
<a href="$view_isad_url?id=$id&view=admin">[View administrative information]</a>
</p>
</td></tr>
EOF
} else {
  print <<EOF;
<tr><td colspan="2" align="center" valign="middle" class="title"><p>
<a href="$view_isad_url?id=$id&view=basic">[View descriptive information]</a>
</p>
</td></tr>
EOF
}
print "</table>\n";

close(HTML_INPUT);

if ($view eq "basic") {

# obtain a list of all subcomponents by listing subdirectories

  opendir(COMPONENT_DIR, "$isad_root/$component_dir") or die "can't list directory: $!";
  my @subcomponents = grep -d, map "$isad_root/$component_dir/$_", readdir COMPONENT_DIR;
  closedir(COMPONENT_DIR);

  shift @subcomponents;	# the first two directories listed are always
  shift @subcomponents;	# the current and parent dirs . & ..

# and print a list of links as subcomponents

print <<EOF;
<form action="/request.php" method="GET">
<input type="hidden" name="level" value="$level" />
<input type="hidden" name="title" value="$titletext" />
<input type="hidden" name="refid" value="$id" />
<input type="hidden" name="warning" value=
EOF
if (scalar(@subcomponents) == 0) {
print "1";
}
else {
print "2";
}
print <<EOF;
 />
<input type="submit" value="Request" />
</form>
EOF
 unless (scalar(@subcomponents) == 0) {
		
	  my $sc_titletext;
    my $sc_ref;
		my $sc_lowdate;
    my $sc_highdate;
		
		print "<h2>Lower levels of description</h2>\n";
    print "<ul>\n";
    foreach my $subcomponent (@subcomponents) {
    $subcomponent =~ s/.*\///;		# strip off path
    $sc_titletext = @{$idtable{$subcomponent}}[1];
		$sc_lowdate = @{$idtable{$subcomponent}}[2];
    $sc_highdate = @{$idtable{$subcomponent}}[3];
		$sc_ref = @{$idtable{$subcomponent}}[0];
      print "<li>";
      print "<a href=\"$view_isad_url?id=$subcomponent&view=$view\">$sc_titletext</a> ($sc_lowdate";
 if ($sc_lowdate eq $sc_highdate) {
 print ")" }
 else { print "-$sc_highdate)" }
      print "</li>\n";
    }
    print "</ul>\n";
  }
}

open(HTML_INPUT, "/home/archives/public_docs/includes/footer.shtml");
while (<HTML_INPUT>) {
  print $_;
}

