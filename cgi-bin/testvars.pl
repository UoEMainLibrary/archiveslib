#!/home/cpan/bin/perl -w

print "Content-type: text/html", "\n\n";
print "<HTML>", "\n";
print "<HEAD><TITLE>About this Server</TITLE></HEAD>", "\n";
print "<BODY><H1>About this Server</H1>", "\n";
print "<HR><PRE>";
print "Server Name:      ", $ENV{'SERVER_NAME'}, "<BR>", "\n";
print "Running on Port:  ", $ENV{'SERVER_PORT'}, "<BR>", "\n";
print "Server Software:  ", $ENV{'SERVER_SOFTWARE'}, "<BR>", "\n";
print "Server Protocol:  ", $ENV{'SERVER_PROTOCOL'}, "<BR>", "\n";
print "CGI Revision:     ", $ENV{'GATEWAY_INTERFACE'}, "<BR>", "\n";
print "Remote Host:     ", $ENV{'REMOTE_HOST'}, "<BR>", "\n";
print "Remote Address:     ", $ENV{'REMOTE_ADDR'}, "<BR>", "\n";
print "Remote User:     ", $ENV{'REMOTE_USER'}, "<BR>", "\n";
print "<HR></PRE>", "\n";
print "</BODY></HTML>", "\n";
exit (0);
