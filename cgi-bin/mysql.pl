#!/home/cpan/bin/perl -w


 ## parsing a CSV file uploaded using a web interface, using Text::CSV
 
 use strict;
 use CGI;
 use CGI::Carp qw/fatalsToBrowser warningsToBrowser/;
 use Text::CSV;
 use Data::Dumper;
 
 my $csv = Text::CSV->new(); ## pass parameter {binary=>1} if you want to handle non-ascii chars
 my $cgi = new CGI;
 
 if($ENV{'REQUEST_METHOD'} eq 'POST')
 {
     print $cgi->header();
     my $h = $cgi->upload('up');
 
     my $total_rows = 0;
 
     print "<table border=1>";
     
     while(my $line = <$h>)
     {
         if($csv->parse($line))
         {
             print q(<tr>);
             print qq(<td>$_</td>) for($csv->fields());
             print q(</tr>);
         }
     }
 
     print "</table>";
 }
 else
 {
     print $cgi->header(),qq(<html><head><title>CSV Upload Parser</title>
         </head>
         <body>
         <form method="POST" enctype="multipart/form-data">
         <input type="file" name="up"><br><br>
         <input type="submit" name="bt" value="Upload">
         </form>
         </body>
         </html>);
 }