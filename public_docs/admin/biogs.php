<?php

## This script is designed to be called by an xslt stylesheet and retrieve the most current version of a term 
## from the Authorities database for inclusion in xml/EAD document

##call database connection
include "../../mgt_config/sql.php";

$dir = "/home/archives/catalogue_source_docs/authorities/eacxml/pers";

 ?>
 
 
<p>Biogs</p>
 
 <?php
 

 	 $sql_str="SELECT * FROM isaar WHERE suppress LIKE 'n'";
	 
	 $perssearch = mysql_db_query($dbname, $sql_str, $id_link) or die("Search Failed!");
	 
	 
	 
	 while ($results = mysql_fetch_array($perssearch)): 
	 
	 $filename = $dir."/_".$results['id'].".xml";
	 
	 $FileHandle = fopen($filename, 'w') or die("can't open file");
	 
	  
	 
	 
	 $content = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
	<?xml-stylesheet type=\"text/css\" href=\"http://www.archives.lib.ed.ac.uk/cataloguing/css/eac.css\"?>
	 <eac-cpf xmlns=\"urn:isbn:1-931666-33-4\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
    xsi:schemaLocation=\"urn:isbn:1-931666-33-4 http://eac.staatsbibliothek-berlin.de/schema/cpf.xsd\">
    <control><recordId>GB-237-eac-temp_".$results['id']."</recordId><maintenanceStatus>new</maintenanceStatus>
        <publicationStatus>inProcess</publicationStatus>
        <maintenanceAgency>
            <agencyCode>GB-237</agencyCode>
            <agencyName>Special Collections, Edinburgh University Library</agencyName>
        </maintenanceAgency><languageDeclaration>
            <language languageCode=\"eng\">English</language>
            <script scriptCode=\"Latn\" xml:lang=\"\">Latin</script>
        </languageDeclaration><conventionDeclaration>
            <abbreviation>ISAAR(CPF)</abbreviation>
            <citation xmlns:ns1=\"http://www.w3.org/1999/xlink\" ns1:type=\"simple\">
                <span localType=\"bibTitle\">International Standard Archival Authority Record For
                    Corporate Bodies, Persons and Families</span>
            </citation>
        </conventionDeclaration><maintenanceHistory>
            <maintenanceEvent>
                <eventType>created</eventType>
                <eventDateTime standardDateTime=\"2010\">2010</eventDateTime>
                <agentType>human</agentType>
                <agent>Stephen Hall</agent>
                <eventDescription>draft completed</eventDescription>
            </maintenanceEvent>
        </maintenanceHistory><sources>
            <source>
			<sourceEntry>[REPLACE]</sourceEntry>
			<descriptiveNote>
                <p>".$results['sources']."</p>
            </descriptiveNote>
			</source>
			</sources>
			</control>
    <cpfDescription>
        <identity>
            <entityId>GB-237-eac-temp_".$results['id']."</entityId>
            <entityType>person</entityType>
            <nameEntry>
                <part localType=\"family\">".$results['surname']."</part>
                <part localType=\"given\">".$results['forename']."</part>
                <part localType=\"title\">".$results['title_prefix']."</part>
                <part localType=\"title\">".$results['title_suffix']."</part>
            </nameEntry>
            <descriptiveNote>
                <p>".$results['epithet']."</p>
            </descriptiveNote>
			</identity>
        <description>
            <existDates><dateRange><fromDate standardDate=\"".$results['birth_year']."\">".$results['birth_year_prefix'].$results['birth_year']."</fromDate><toDate standardDate=\"".$results['death_year']."\">".$results['birth_year_prefix'].$results['death_year']."</toDate></dateRange>
                <descriptiveNote>
                    <p>[REPLACE/DELETE]</p>
                </descriptiveNote></existDates>
            <biogHist>
                <p>".$results['biography']."</p>
				
                <p>Awards: ".$results['awards']."</p>
				
                <p>Publications: ".$results['publications']."</p>
            </biogHist>
        </description>
        <relations>
            <cpfRelation xmlns:ns1=\"http://www.w3.org/1999/xlink\" ns1:type=\"simple\"
                cpfRelationType=\"xxxxx\" ns1:href=\"99999\">
                <relationEntry>xxxxxx</relationEntry>
                <descriptiveNote>
                    <p>".$results['relations']."</p>
                </descriptiveNote>
			</cpfRelation>
		</relations>
    </cpfDescription>
</eac-cpf>";
	
	fwrite($FileHandle, utf8_encode($content));

	 fclose($FileHandle);
	 
	 
     endwhile;	

 	
 
?>

  

     


