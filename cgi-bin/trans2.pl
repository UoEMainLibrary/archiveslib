#!/usr/bin/perl

# The input file was preperared in the follwoing manner:
# The CSV file was imported to Excel, and exported as a tab delimited file.
# The file was called tovey_letters.txt

# The file was worked on under the unix like environment provided by cygwin.

# Carriage return characters were converted to Line Feeds so that the file
# could be processed under unix.  The follwoing command was used:
# $ cat tovey_letters.txt | tr '\15' '\12' > tovey_letters1.txt
# The command has the effect of replacing bytes with octal value 015 with
# bytes of octal value 012. 015 is an ASCII CR (Carriage Return) and
# 012 is an ASCII NL (Line Feed).

# Vertical tabs were removed from the file using the following command:
# $ cat tovey_letters1.txt | tr -d '\11' > tovey_letters2.txt
# The effect of this command is to remove all bytes of value 011.  These
# bytes represent ASCII vertical tabs.  It is unclear why these characters
# are present in the input file.
 
# The above steps are necessery to allow the proper line by line processing 
# in the perl script.

# Grouped names such as JoeJohn, BloggsSmith, Sir were found to be seperated by
# the ASCII GS (Group Seperator) character, whoose octal value is 035.
# Note: when the GS charcter is skipped as it is in Excel, it is impossible to
# tell whether we have a Sir Joe Bloggs, and a John Smith or a 
# Sir John Smith and Joe Bloggs.

# To make things cleaerer and to enable easier processing of these characters
# they were translated into semi-colon characters using the following command.
# $ cat tovey_letters2.txt | tr '\35' ':' > input.txt
# So now the names become- Joe:John, Bloggs:Smith, :Sir
# It is now clear that the Sir belongs to the John Smith rather than Joe Bloggs
 
# The script is executed with the following command:
# $ cat input.txt | trans2.pl 
# This will produce one xml file per record.
 
# Eric Jutrzenka
# ericj@fmail.co.uk

use strict;

use Lang_codes;

open(INFO, '-');

my @months = ("Jan", "Feb", "Mar", "Apr", "May", "Jun", 
          "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" );
my %cvs;
my %EAD;



while (my $line = <INFO>)
{
    
    my @fields = split (/\t/, $line);    
    for(my $i = 0; $i <= $#fields; $i++) {
      $fields[$i] = clean($fields[$i]);  # remove whitspace and quotes and replace &
    }
    $cvs{'date_added'}              = $fields[0];     # A
    $cvs{'title'}                   = $fields[3];     # D
    $cvs{'description'}             = $fields[4];     # E
    $cvs{'sender_surname'}          = $fields[5];     # F
    $cvs{'sender_firstnames'}       = $fields[6];     # G
    $cvs{'sender_title'}            = $fields[7];     # H
    $cvs{'sender_dates'}            = $fields[8];     # I
    $cvs{'sender_organisation'}     = $fields[9];     # J
    $cvs{'recipients_surnames'}     = $fields[10];    # K
    $cvs{'recipients_firstnames'}   = $fields[11];    # L
    $cvs{'recipients_titles'}       = $fields[12];    # M
    $cvs{'recipients_dates'}        = $fields[13];    # N
    $cvs{'recipients_organisations'}= $fields[14];    # O
    $cvs{'country'}                 = $fields[15];    # P
    $cvs{'county'}                  = $fields[16];    # Q
    $cvs{'town'}                    = $fields[17];    # R
    $cvs{'town1'}                   = $fields[18];    # S
    $cvs{'country1'}                = $fields[20];    # U
    $cvs{'date_sent'}               = $fields[21];    # V
    $cvs{'language'}                = $fields[22];    # W
    $cvs{'form'}                    = $fields[23];    # X
    $cvs{'category'}                = $fields[24];    # Y
    $cvs{'format'}                  = $fields[25];    # Z
    $cvs{'names_surnames'}          = $fields[27];    # AB
    $cvs{'names_firstnames'}        = $fields[28];    # AC
    $cvs{'names_titles'}            = $fields[29];    # AD
    $cvs{'names_dates'}             = $fields[30];    # AE
    $cvs{'identifier'}              = $fields[31];    # AF
    
    # Declared here for clarity
    my %EAD_persname = (
      title => '',
      firstnames => '',
      dates => '',
      organisation => '',
      source => '',
      normal => '',
      authfilenumber => ''
    );
    my %data = (
      identifier => '',
      unittitle => '',
      unitdate => '',
      unitdate_attr_certainty => '',
      unitdate_attr_normal => '',
      sender => '',
      persons => '',
      organisations => '',
      language => '',
      language_attr_langcode => ''
    );
    my @title_parts = split(/,/, $cvs{'title'});
    my $crspnd_type = $title_parts[0];
    my $name_to;
    my $name_from;
    foreach my $part (@title_parts) 
    {
        if ($part =~ /.* to .*/)
        {
            my @names = split(/ to /, $part);
            $name_from = trim($names[0]);
            $names[1] =~ s/\"//;
            $name_to = trim($names[1]);
        }
    }
    $data{'unittitle'} = "$crspnd_type to $name_to from $name_from";
    #$data{'unittitle'} =~ s/\&/&amp;/g;
    $data{'unitdate_attr_certainty'} = "certain";
    
    my $day;
    my $month;
    my $year;
    ($day, $month, $year) = split(/\//, $cvs{'date_sent'});    
    if ($day =~ /^[1-9]$/) { $day = "0".$day; }     
    if ($month =~ /^[1-9]$/) { $month = "0".$month; }
    if($year =~ /^0[0-9]$/) { $year = "20".$year; }
    if($year =~ /^[1-9][0-9]$/) { $year = "19".$year; }
    $data{'unitdate_attr_normal'} = "$year$month$day";
    $data{'unitdate'} = "$day $months[$month-1] $year";
    if ( $cvs{'title'} =~ /\[n *\. *[d,y] *\]/ ||
        $cvs{'title'} =~ /\[ *[1,2][9,0][0-9][0-9] *.*\]/) {
            $data{'unitdate_attr_certainty'} = "uncertain";
            $data{'unitdate'} = "c ".$data{'unitdate'};
    }
    if ($day == "01" and $month == "01") {
        $data{'unitdate'} = "c$year";
    }

    $data{'language'} = $cvs{'language'};
    $data{'language_attr_langcode'} = Lang_codes::get_code($cvs{'language'});

    $data{'persons'} =  [ create_persons() ];
    $data{'organisations'} = [ create_organisations() ];
    $data{'identifier'} = $cvs{'identifier'};
    $data{'identifier'} =~ s/(L[0-9]+)(\/[0-9]+)?.*((L[0-9]+)(\/[0-9]+)?)/$1$2-$3/g;
  
    open (OUT,">output/$data{'identifier'}.xml");  
  
    print OUT "<c level=\"item\" id=\"GB-237-Coll-411-1-$data{'identifier'}\">\n";
    print OUT "    <did><head>Item Summary</head>\n";
    print OUT '        <repository audience="external" label="Repository" '.
          'encodinganalog="EUL1">Edinburgh University Library Special '.
          "Collections</repository>\n";
    print OUT '        <unitid label="Reference Code" encodinganalog="isadg(2)311" '.
          'type="Coll 411" countrycode="GB" repositorycode="237">'.
          "GB 237 Coll-411/1/$data{'identifier'}</unitid>\n";
    print OUT '        <physloc encodinganalog="EUL2" label="Physical location" '.
          'audience="internal"></physloc>'."\n";
   
    print OUT '    <unittitle label="Title" encodinganalog="isadg(2)312" audience="external">'.
          "$data{'unittitle'}</unittitle>\n";
    print OUT '    <unitdate label="Date(s)" encodinganalog="isadg(2)313" '.
          'type="inclusive" certainty="'.$data{'unitdate_attr_certainty'}.
          '" normal="'.$data{'unitdate_attr_normal'}.'" '.
          'audience="external">'.$data{'unitdate'}.'</unitdate>'."\n";
    print OUT '    <physdesc label="Extent and Medium of the Unit of Description" '.
          'encodinganalog="isadg(2)315" audience="external">'."\n".
          '        <extent>1</extent>'."\n".
          "        <genreform>$crspnd_type</genreform>\n";
    print OUT "    <dimensions encodinganalog=\"EUL3\">$cvs{'form'}</dimensions>\n";
    print OUT       "    </physdesc>\n";
    
    print OUT '    <origination label="Name of Creator(s)" encodinganalog="isadg(2)321" '.
          'audience="external">'."\n";
    print OUT '        '.xml_originator_persname($data{'persons'}[0]);
    print OUT "    </origination>\n";
    print OUT '    <langmaterial audience="external" label="Language/scripts of '.
          'material" encodinganalog="isadg(2)343"><language '.
          "langcode=\"$data{'language_attr_langcode'}\">$data{'language'}".
          '</language></langmaterial>'."\n";
    print OUT '    </did>'."\n";
    print OUT '    <scopecontent audience="external" encodinganalog="isadg(2)331">'.
          "\n        <head>Scope and Content</head>\n";
  
    print OUT "        <p>$cvs{'title'}. $cvs{'description'}. $cvs{'format'}.</p>\n";
    print OUT "    </scopecontent>\n";
    print OUT '    <controlaccess encodinganalog="EUL4" audience="external">'."\n";
    print OUT "        <head>Index</head>\n";
    print OUT '        <controlaccess encodinganalog="EUL5">'."\n";
    print OUT "            <head>Subjects</head>\n";
    print OUT "            <p>$cvs{'category'}</p>\n";
    print OUT "        </controlaccess>\n";
    
    print OUT '        <controlaccess encodinganalog="EUL6">'."\n";
    print OUT "            <head>People</head>\n";
    foreach my $person (@{$data{'persons'}}) {
      print OUT '                '.xml_controlaccess_persname($person)."\n";
    }
    print OUT "        </controlaccess>\n";
    
    
    
  if (@{$data{'organisations'}}) {
    print OUT '        <controlaccess encodinganalog="EUL7">'."\n";
      print OUT "            <head>Businesses and Organisations</head>\n";
      foreach my $corp (@{$data{'organisations'}}) {
          print OUT '        '.xml_corpname($corp)."\n";
      }
      print OUT "        </controlaccess>\n";
  }
  
  print OUT '        <controlaccess encodinganalog="EUL6">'."\n";
  print OUT "            <head>Places</head>\n";
  print OUT "            <geogname source=\"lcsh\" authfilenumber=\"REPLACE\"".
                     " normal=\"$cvs{'town'} ($cvs{'country'})\">".
                     "$cvs{'town'} ($cvs{'country'})</geogname>\n";
  print OUT "            <geogname rules=\"lcsh\" authfilenumber=\"REPLACE\"".
                     " normal=\"$cvs{'town1'} ($cvs{'country1'})\">".
                     "$cvs{'town1'} ($cvs{'country1'})</geogname>\n";
  print OUT "        </controlaccess>\n";
  print OUT "    </controlaccess>\n";

  print OUT '    <descgrp>'."\n".
		    '        <head>Administrative Information</head>'."\n".
		    '        <note encodinganalog="isadg(2)361" audience="external" label="Note">'."\n".
			  '            <p/>'."\n".
		    '        </note>'."\n".
		    '        <processinfo>'."\n".
			  '            <processinfo audience="internal" encodinganalog="isadg(2)371">'."\n".
				"                 <head>Archivist's Notes</head>\n".
				'                 <p/>'."\n".
			  '            </processinfo>'."\n".
			  '            <processinfo audience="internal" encodinganalog="isadg(2)373">'."\n".
				'                 <head>Date(s) of Description</head>'."\n".
				'                 <p>'."\n".
				'                     <persname source="ncarules" role="archivist" normal="REPLACE"/>'."\n".
				'                     <date type="single" normal="19950727" certainty="certain">27 July 1995</date>'."\n".
				'                 </p>'."\n".
			  '             </processinfo>'."\n".
		    '        </processinfo>'."\n".
	      '    </descgrp>'."\n";
  print OUT '</c>'."\n";
  
  
  
}

close(OUT);


#print 'count: '.@records."\n";



#Concatenates initials.
sub convert_firstnames ($) {
  my $firstnames = shift;
  $firstnames =~ s/[\.\'\"]//g;
  $firstnames =~ s/(^ *|  +)(\[ *)?([A-Z]) +([A-Z] *\]?)($| +)/$2$3$4/gi; 
  return $firstnames;
}

sub create_organisations() {
    my @organisations;
    if ($cvs{'sender_firstnames'} eq '' && 
        $cvs{'sender_surname'} eq '' &&
        !($cvs{'sender_organisation'} eq '')) {
        push @organisations, $cvs{'sender_organisation'};
    }
    if ($cvs{'recipients_firstnames'} eq '' && 
        $cvs{'recipients_surnames'} eq '' &&
        !($cvs{'recipients_organisations'} eq '')) {
        
        push @organisations, $cvs{'recipients_organisations'};
    }
    return @organisations;
}

sub create_persons() {
  my $type = shift;
  my %EAD_origination_persname;
  my @EAD_persnames;
  
  my @firstnames    ;
  my @surnames      ;
  my @dates         ;
  my @titles        ;
  my @organisations ;
  
 
    my @tmp_firstnames    = split (/:/, $cvs{'sender_firstnames'});
    my @tmp_surnames      = split (/:/, $cvs{'sender_surname'});
    my @tmp_dates         = split (/:/, $cvs{'sender_dates'});
    my @tmp_titles        = split (/:/, $cvs{'sender_title'});
    my @tmp_organisations = split (/:/, $cvs{'sender_organisation'});
    
    # Iterate either on no. of firstnames or surnames, which ever is bigger
    # Has the effect of filtering out organisations - handy.
    
    while (@tmp_surnames || @tmp_firstnames) {
        push @surnames,      @tmp_surnames ? shift @tmp_surnames : "";
      push @firstnames,    @tmp_firstnames ? shift @tmp_firstnames : "";
      push @titles,        @tmp_titles ? shift @tmp_titles : "";
      push @dates,         @tmp_dates ? shift @tmp_dates : "";
      push @organisations, @tmp_organisations ? shift @tmp_organisations : "";
    }
    
    @tmp_firstnames    = split (/:/, $cvs{'recipients_firstnames'});
    @tmp_surnames      = split (/:/, $cvs{'recipients_surnames'});
    @tmp_dates         = split (/:/, $cvs{'recipients_dates'});
    @tmp_titles        = split (/:/, $cvs{'recipients_titles'});
    @tmp_organisations = split (/:/, $cvs{'recipients_organisations'});
    
    while ( @tmp_surnames || @tmp_firstnames)  {

      push @surnames,      @tmp_surnames ? shift @tmp_surnames : "";
      push @firstnames,    @tmp_firstnames ? shift @tmp_firstnames : "";
      push @titles,        @tmp_titles ? shift @tmp_titles : "";
      push @dates,         @tmp_dates ? shift @tmp_dates : "";
      push @organisations, @tmp_organisations ? shift @tmp_organisations : "";
    }
    
    @tmp_firstnames    = split (/:/, $cvs{'names_firstnames'});
    @tmp_surnames      = split (/:/, $cvs{'names_surnames'});
    @tmp_dates         = split (/:/, $cvs{'names_dates'});
    @tmp_titles        = split (/:/, $cvs{'names_titles'});
    
    for(my $i = 0; $i < @tmp_titles; $i++) {
      if ($tmp_titles[$i] =~ /(Mr|Mrs|Miss|Ms)/) {
        $tmp_titles[$i] =''; # remove salutations
      }
    }
    
     while (@tmp_surnames || @tmp_firstnames) {
      push @surnames,      @tmp_surnames ? shift @tmp_surnames : "";
      push @firstnames,    @tmp_firstnames ? shift @tmp_firstnames : "";
      push @titles,        @tmp_titles ? shift @tmp_titles : "";
      push @dates,         @tmp_dates ? shift @tmp_dates : "";
    }
   
     
     while (@surnames) { # surnames are consumed one by one
      
      my %EAD_persname;
      my $surname = shift @surnames; 
      my $firstname = shift @firstnames;
      my $title = shift @titles;
      my $date = shift @dates;
      $date =~ s/ //g;
      my $organisation = shift @organisations;
      
      $EAD_persname{'title'} = $title;
      $EAD_persname{'firstnames'} = convert_firstnames ($firstname);
      $EAD_persname{'surname'} = $surname;
      $EAD_persname{'dates'} = $date;
      $organisation =~ s/^The//i;
      $EAD_persname{'organisation'} = $organisation;
      
      $EAD_persname{'normal'} = $EAD_persname{'surname'};
      if (!($EAD_persname{'title'} eq "")) {
        $EAD_persname{'normal'} .= ', '.$EAD_persname{'title'};
      }
      if (!($EAD_persname{'firstnames'} eq "")) {
        $EAD_persname{'normal'} .= ', '.$EAD_persname{'firstnames'};
      }
            
      #print "$title $firstname $surname $date $organisation\n"
      $EAD_persname{'authfilenumber'} = "REPLACE";
      if ((
      $EAD_persname{'surname'} eq "Tovey" &&
       ($EAD_persname{'firstnames'} =~ /([Dd]onald|[Ff]rancis)/ ||
     $EAD_persname{'dates'} eq "1875-1940")
     ) || (
     $EAD_persname{'surname'} eq "Tovey" &&
     $EAD_persname{'firstnames'} eq '' &&
     $EAD_persname{'dates'} eq ''
     )) {
  
     $EAD_persname{'surname'}      = "Tovey";
     $EAD_persname{'title'}        = "Sir";
     $EAD_persname{'firstnames'}   = "Donald Francis";
     $EAD_persname{'dates'}        = "1875-1940";
     $EAD_persname{'organisation'} =
               "Reid Professor of Music, University of Edinburgh";
     $EAD_persname{'normal'}  = "Tovey, Sir, Donald Francis";
     $EAD_persname{'authfilenumber'} = "GB 237 EUA P2843";
     
     
    }
    push @EAD_persnames, { %EAD_persname };
    }
  return @EAD_persnames;
  #print "=======================\n";

  

}

sub xml_corpname($) {
    my $corp = shift;
    
    my $xml = '<corpname source="ncarules" authfilenumber="REPLACE" '.
              "normal=\"$corp\">$corp</corpname>";
    return $xml;
}

sub xml_originator_persname($) {
  my $pname = shift;
  
  my $xml = "<persname source=\"ncarules\" ".
        "authfilenumber=\"$pname->{'authfilenumber'}\" ".
        "normal=\"$pname->{'normal'}\" role=\"originator\">";
        
         $xml .= $pname->{'surname'};
  $xml .= $pname->{'title'} eq ''        ? '' : " | $pname->{'title'}";
  $xml .= $pname->{'firstnames'} eq ''   ? '' : " | $pname->{'firstnames'}";
  $xml .= $pname->{'dates'} eq ''        ? '' : " | $pname->{'dates'}";
  $xml .= $pname->{'organisation'} eq '' ? '' : " | $pname->{'organisation'}";
  
  $xml .= "</persname>\n";
  
  return $xml;
}

sub xml_controlaccess_persname($) {
  my $pname = shift;
  
  my $xml = "<persname source=\"ncarules\" ".
        "authfilenumber=\"$pname->{'authfilenumber'}\" ".
        "normal=\"$pname->{'normal'}\">";
        
  $xml .= $pname->{'surname'};
  $xml .= $pname->{'title'} eq ''        ? '' : " | $pname->{'title'}";
  $xml .= $pname->{'firstnames'} eq ''   ? '' : " | $pname->{'firstnames'}";
  $xml .= $pname->{'dates'} eq ''        ? '' : " | $pname->{'dates'}";
  $xml .= $pname->{'organisation'} eq '' ? '' : " | $pname->{'organisation'}";
  
  $xml .= "</persname>";
  
  return $xml;
}

# Removes trailing and leading white space
sub trim($)
{
    my $string = shift;
    $string =~ s/^\s+//;
    $string =~ s/\s+$//;
    return $string;
}

# Removes trailing and leading white space, removes double quotes and & to &amp;.
sub clean($)
{
  my $string = shift;
  $string = trim($string);
  $string =~ s/^\"//;
  $string =~ s/\"$//;
  $string =~ s/\&/&amp;/g;
  return $string;
}
