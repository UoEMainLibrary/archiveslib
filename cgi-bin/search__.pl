#!/home/cpan/ins5.6.1/bin/perl -w
#
# free_search.pl
#

use strict;
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

my %free_table;
tie %free_table, 'MLDBM', "$repository_root/free/termtable.mldbm", O_RDONLY, 0640 or die $!;

my @results;
my @sorted_results;

my $startpoint;
my $endpoint;
my $num_results;
my $total_results;

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

# datecmp
#
# Custom sort routine to straighten out the result list of IDs. Compare
# first by start date, then by end date. Text in dates should get
# shuttled to the end.
#########################################################################

sub datecmp {
  if (@{$idtable{$b}}[2] =~ /\D/) { 
    -1				# b is a string, leave them
  } elsif (@{$idtable{$a}}[2] =~ /\D/) {
    1				# a is a string, switch them
  } elsif (@{$idtable{$a}}[2] == @{$idtable{$b}}[2]) {
    @{$idtable{$a}}[3] <=> @{$idtable{$b}}[3];
  } else {
    @{$idtable{$a}}[2] <=> @{$idtable{$b}}[2];
  }
}

# print_footer
#
#########################################################################

sub print_footer {
  print <<EOF;
</td>
</tr>
<tr>
<td class="pgtitle" colspan="3" height="35"> </td>
</tr>
</table>
</body>
</html>
EOF
}

# report_error
#
#########################################################################

sub report_error {
  my $error = shift;
  print "<h2>ERROR</h2>\n";
  print "<h3>$error</h3>\n";
  print_footer;
  exit 0;
}

# and_search
#
#########################################################################

sub and_search {
  my $arrayref = shift;
  my @terms = @{$arrayref};
  my $term;
  my %results;
  my $result;
  my @additional_results;
  my %newresults;

#print "<h2>AND</h2>\n";

  $term = shift(@terms);

  if (exists $free_table{$term}) {
    %results = %{$free_table{$term}};	# results for a single term
  } else {
    return [];				# if none, the AND will return none
  }

  while (scalar @terms > 0) {				# take each AND operation in turn

    %newresults = ();					# start with no results 
    $term = shift(@terms);
    @additional_results = keys %{$free_table{$term}};	# get results for latest term

    foreach my $result (@additional_results) {		# take each result in turn
      if (exists $results{$result}) {			# only if in our existing pool of results
        $newresults{$result} = 1;			# is it added to our result hash
      }
    }
    %results = %newresults;				# and update the master hash of results
  }

  my @returnarray = keys %results;
  return \@returnarray;
}

# or_search
#
#########################################################################

sub or_search {
  my $arrayref = shift;
  my @terms = @{$arrayref};
  my %results = ();
  my %newresults;

#print "<h2>OR</h2>\n";

  foreach my $term (@terms) {
    if (exists $free_table{$term}) {
      my %newresults = %{$free_table{$term}};
      foreach my $result (keys %newresults) {
        $results{$result} = 1;
      }
    }
  } 
  my @returnarray = keys %results;
  return \@returnarray;
}


# main
#
#########################################################################

&pull_CGI_args;

# print headers

print "Content-type: text/html\n\n";

</td></tr>
</table>
<hr />
<p class="footer">&copy; Edinburgh University Library</p>
</body>
</html>

my $termstring = $form_data{"term"} || report_error("No search term specified");
my $mode = $form_data{"mode"} || report_error("No search mode specified");
unless ($startpoint = $form_data{"start"}) { $startpoint = 1; }
unless ($num_results = $form_data{"results"}) { $num_results = 50; }

unless (($mode eq "and") || ($mode eq "or")) {
  report_error("Search mode must be 'and' or 'or'");
}

# normalise the search terms as done during indexing

my $real_termstring = $termstring;		# we will transform this
$real_termstring =~ s/[\.,;:'|\(\)]//g;		# delete punctuation
$real_termstring =~ s/\b\S{1,2}\b//g;		# get rid of one or two letter words
$real_termstring = lc $real_termstring;
$real_termstring =~ s/\s+/ /g;		# eliminate multiple whitespace
$real_termstring =~ s/(^ | $)//g;	# eliminate leading or trailing whitespace

my @terms = split / /, $real_termstring;

if ((scalar @terms) > 5) {
  print "<p>Too many terms. Please try again with a shorter search string.</p>\n";
} elsif ((scalar @terms) == 0) {
  print "<p>No search terms specified. Please try again.</p>\n";
} else {

  print "<p>You searched for: <b>$termstring</b></p>\n";

  if ($mode eq "and") {
    @results = @{and_search(\@terms)};
  } else {
    @results = @{or_search(\@terms)};
  }

  $total_results = scalar @results;

  if ($total_results == 0) {
    print "<p>No results.</p>\n";

  } else {

    $endpoint = $startpoint + $num_results - 1;
    if ($total_results < $endpoint) {
      $endpoint = $total_results;
    }

    print "<p>Showing results $startpoint - $endpoint of\n";
    print "<a href=\"search.pl?term=$termstring&mode=$mode&results=$total_results\">$total_results</a>.</p>\n";

    @sorted_results = sort datecmp @results;
  
    print "<ol start=\"$startpoint\">\n";
    for (my $count = $startpoint; $count <= $endpoint; $count += 1) {
      my $result = $sorted_results[$count - 1];
      my $titletext = @{$idtable{$result}}[1];
      print "<li><a href=\"$view_isad_url?id=$result&view=basic\">$titletext</a> ";
      my $lowdate = @{$idtable{$result}}[2];
      my $highdate = @{$idtable{$result}}[3];
      print "($lowdate";
      if (($lowdate =~ /\D/) || ($highdate != $lowdate)) {
        print "-$highdate";
      }
      print ")</li>\n";
    }
    print "</ol>\n";

    print "<p>\n";  

    if ($startpoint > 1 ) {
      my $new_startpoint = $startpoint - $num_results;
      if ($new_startpoint < 1) { $new_startpoint = 1; }
      print "<a href=\"search.pl?term=$termstring&mode=$mode&start=$new_startpoint&results=$num_results\">Previous</a>\n";
    }

    if ($endpoint < $total_results) {
      my $new_startpoint = $endpoint + 1;
      print "<a href=\"search.pl?term=$termstring&mode=$mode&start=$new_startpoint&results=$num_results\">Next</a>\n";
    }

    print "</p>\n";
  }
}
&print_footer;


