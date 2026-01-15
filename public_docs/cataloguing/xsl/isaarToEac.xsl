<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/css" href="http://www.archives.lib.ed.ac.uk/cataloguing/css/eac.css"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0">
    <xsl:output  method="xml"
        indent="yes"
        omit-xml-declaration="no"/> 
    <xsl:template match="/">
        <eac-cpf xmlns="urn:isbn:1-931666-33-4" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="urn:isbn:1-931666-33-4 http://eac.staatsbibliothek-berlin.de/schema/cpf.xsd">
            <control>
                <recordId>GB-237-EAC-<xsl:value-of select="substring(//unitid, 17)"></xsl:value-of></recordId>
                <maintenanceStatus>new</maintenanceStatus>
                <publicationStatus>inProcess</publicationStatus>
                <maintenanceAgency>
                    <agencyCode>GB-237</agencyCode>
                    <agencyName>Special Collections, Edinburgh University Library</agencyName>
                </maintenanceAgency>
                <languageDeclaration>
                    <language languageCode="eng">English</language>
                    <script scriptCode="Latn" xml:lang="">Latin</script>        </languageDeclaration>
                <conventionDeclaration>
                    <abbreviation>ISAAR(CPF)</abbreviation>
                    <citation xmlns:ns1="http://www.w3.org/1999/xlink" ns1:type="simple">
                        <span localType="bibTitle">International Standard Archival Authority Record For Corporate Bodies, Persons and Families</span>
                    </citation>
                </conventionDeclaration><maintenanceHistory>
                    <maintenanceEvent>
                        <eventType>revised</eventType>
                        <eventDateTime standardDateTime="2012-05-02">02 May 2012</eventDateTime>
                        <agentType>machine</agentType>
                        <agent>xslt transformation</agent>
                        <eventDescription>draft completed</eventDescription>
                    </maintenanceEvent>
                </maintenanceHistory>
                <sources>
                    <xsl:for-each select="//archnote/p">
                        <xsl:if test=". != 'List of sources for the biographical information:'">
                            <source xmlns:ns1="http://www.w3.org/1999/xlink" ns1:type="simple">
                                <sourceEntry>
                                    <xsl:value-of select="."></xsl:value-of>
                                </sourceEntry>
                            </source>
                        </xsl:if>
                    </xsl:for-each>
                </sources>
            </control>
            <cpfDescription>
                <!---->
                <identity>
                    <entityId>GB-237-EAC-<xsl:value-of select="substring(//unitid, 17)"></xsl:value-of></entityId>
                    <entityType>person</entityType>
                    <nameEntry><part localType="NCA string"><xsl:value-of select="//authentry"></xsl:value-of></part></nameEntry>
                </identity>
                <description>
                    <existDates>
                        <date/>
                        <descriptiveNote>
                            <p>to be completed</p>
                        </descriptiveNote></existDates>
                    
                    <biogHist>
                        <xsl:for-each select="//occsphere/p">
                            <p><xsl:value-of select="."></xsl:value-of></p>
                        </xsl:for-each>
                        <chronList>
                                <xsl:for-each select="//honqual/p">
                            <chronItem>
                                <date><xsl:value-of select="date"></xsl:value-of></date>
                                    <event><xsl:apply-templates select="."/></event>
                            </chronItem>
                                </xsl:for-each>
                        </chronList> 
                        <xsl:if test="//otherinfo/p//text()">
                       <xsl:for-each select="//otherinfo/p">
                       	<p><xsl:apply-templates select="."/></p>
                       </xsl:for-each> 
                       </xsl:if>                        
                  </biogHist>
                </description>
                <relations>
                  <cpfRelation xmlns:ns1="http://www.w3.org/1999/xlink" ns1:type="simple">
                      <relationEntry>
                      </relationEntry>
                        <descriptiveNote>
                    <xsl:for-each select="//relships/p">
                    <p>
                        <xsl:value-of select="."></xsl:value-of>
                    </p>
                    </xsl:for-each>
                        </descriptiveNote>
                </cpfRelation>
                </relations>
            </cpfDescription>
         </eac-cpf>
    </xsl:template>
    <!--<xsl:template match="date">
        <date><xsl:value-of select="."></xsl:value-of></date>
    </xsl:template>-->
    <xsl:template match="//honqual/p/date" />
    
    <xsl:template match="//bibref/imprint/date">
        <span xmlns="urn:isbn:1-931666-33-4" localType="mods-date"><xsl:value-of select="."></xsl:value-of></span>
    </xsl:template>
    
    <xsl:template match="//bibref/title">
        <span xmlns="urn:isbn:1-931666-33-4" localType="mods-title"><xsl:value-of select="."></xsl:value-of></span>
    </xsl:template>

</xsl:stylesheet>
