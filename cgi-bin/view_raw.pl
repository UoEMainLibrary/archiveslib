#!/home/cpan/bin/perl -w
#
# view_raw.pl
#

my $fil = "/home/archives/source_docs/isad/EUA-RDV.xml";
print "Content-type: text/xml\n\n";
{
    local *INPUT;
    open (INPUT, "/home/archives/source_docs/isad/EUA-RDV.xml") or warn "Cannot open file: $!" && return;
    print while (<INPUT>);
    close INPUT;
}
