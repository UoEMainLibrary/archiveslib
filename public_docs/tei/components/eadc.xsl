<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns="http://www.w3.org/1999/xhtml"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0"
  xmlns:ead="urn:isbn:1-931666-22-9" xmlns:ns2="http://www.w3.org/1999/xlink"
  exclude-result-prefixes="xsl ead ns2">
  <xsl:output method="html" omit-xml-declaration="yes" indent="yes" encoding="utf-8"/>
  <xsl:param name="ead" />
  <xsl:param name="id" />
  <xsl:param name="mrid" />
  <xsl:param name="self" />
  <xsl:template match="/">
    
    
    <xsl:for-each select="//ead:c">
      
      <xsl:if test="ead:did/ead:unitid=$id"> 
       
        
        <!-- Navigation Area -->
        <xsl:choose>
          <!-- Are theare any <c> elements above this? -->
          <xsl:when test="ancestor::ead:c//text()">            
            <div>       
              
              <xsl:element name="a">
                <xsl:attribute name="href"><xsl:value-of select="$self"/>?view=eadc&amp;ead=<xsl:value-of select="//ead:archdesc/ead:did/ead:unitid"/>&amp;id=<xsl:value-of select="ancestor::ead:c/ead:did/ead:unitid"/>
                </xsl:attribute>
                 <img src="up.png" alt="Up" width="30" style="padding:5px"/> 
                <!--<xsl:value-of select="ancestor::ead:c/ead:did/ead:unitid"/>-->
              </xsl:element> 
              
              <xsl:if test="preceding-sibling::ead:c[1]/ead:did/ead:unitid/text()">
              <xsl:element name="a">
                <xsl:attribute name="href"><xsl:value-of select="$self"/>?view=eadc&amp;ead=<xsl:value-of select="//ead:archdesc/ead:did/ead:unitid"/>&amp;id=<xsl:value-of select="preceding-sibling::ead:c[1]/ead:did/ead:unitid"/>
                </xsl:attribute>
                <img src="left.png" alt="Up" width="30" style="padding:5px"/>                 
              <!--<xsl:value-of select="preceding-sibling::ead:c[1]/ead:did/ead:unitid"/> -->
              </xsl:element>
              </xsl:if>
                         
              <xsl:if test="following-sibling::ead:c[1]/ead:did/ead:unitid/text()">
                <xsl:element name="a">
                  <xsl:attribute name="href"><xsl:value-of select="$self"/>?view=eadc&amp;ead=<xsl:value-of select="//ead:archdesc/ead:did/ead:unitid"/>&amp;id=<xsl:value-of select="following-sibling::ead:c[1]/ead:did/ead:unitid"/>
                  </xsl:attribute> 
              <!--<xsl:value-of select="following-sibling::ead:c/ead:did/ead:unitid"/>-->
                  <img src="right.png" alt="Up" width="30" style="padding:5px"/>
                  </xsl:element>
              </xsl:if>
            </div>          
          </xsl:when>
          <xsl:otherwise>
            <!-- There must just be fonds above -->
            <div> 
              
              <xsl:element name="a">
                <xsl:attribute name="href"><xsl:value-of select="$self"/>?view=ead&amp;ead=<xsl:value-of select="//ead:archdesc/ead:did/ead:unitid"/>
                </xsl:attribute>
                <img src="up.png" alt="Up" width="30" style="padding:5px"/> 
                <!--<xsl:value-of select="ancestor::ead:c/ead:did/ead:unitid"/>-->
              </xsl:element> 
              
              <xsl:if test="preceding-sibling::ead:c[1]/ead:did/ead:unitid/text()">
                <xsl:element name="a">
                  <xsl:attribute name="href"><xsl:value-of select="$self"/>?view=eadc&amp;ead=<xsl:value-of select="//ead:archdesc/ead:did/ead:unitid"/>&amp;id=<xsl:value-of select="preceding-sibling::ead:c[1]/ead:did/ead:unitid"/>
                  </xsl:attribute>
                  <img src="left.png" alt="Up" width="30" style="padding:5px"/>                 
                  <!--<xsl:value-of select="preceding-sibling::ead:c[1]/ead:did/ead:unitid"/> -->
                </xsl:element>
              </xsl:if>
              
              <xsl:if test="following-sibling::ead:c[1]/ead:did/ead:unitid/text()">
                <xsl:element name="a">
                  <xsl:attribute name="href"><xsl:value-of select="$self"/>?view=eadc&amp;ead=<xsl:value-of select="//ead:archdesc/ead:did/ead:unitid"/>&amp;id=<xsl:value-of select="following-sibling::ead:c[1]/ead:did/ead:unitid"/>
                  </xsl:attribute> 
                  <!--<xsl:value-of select="following-sibling::ead:c/ead:did/ead:unitid"/>-->
                  <img src="right.png" alt="Up" width="30" style="padding:5px"/>
                </xsl:element>
              </xsl:if>
            </div>  
          </xsl:otherwise>
        </xsl:choose>
        
        <!-- End of navigation Area -->
        
        <div class="component">
          <h2>Catalogue entry</h2>
        <table>
          <!-- Create link to catalogue -->  
          <tr><td colspan="2"><xsl:element name="a">
            <xsl:attribute name="target">_blank</xsl:attribute>
            <xsl:attribute name="href">
              https://archives.collections.ed.ac.uk/repositories/2/archival_objects/<xsl:value-of select="ead:did/ead:unitid/ead:extptr/@href"/>            
            </xsl:attribute>
            View in ArchivesSpace
          </xsl:element>
          </td>
          </tr>
          <tr><td class="ead_label" width="150" valign="top">Ref. code</td><td><xsl:value-of select="ead:did/ead:unitid"/></td></tr>
          <tr><td class="ead_label" valign="top">Title</td><td><xsl:value-of select="ead:did/ead:unittitle"/></td></tr>
          <tr><td class="ead_label" valign="top">Date(s)</td><td><xsl:value-of select="ead:did/ead:unitdate"/></td></tr>
          
          <tr><td class="ead_label" valign="top">Extent</td><td><xsl:apply-templates select="ead:did/ead:physdesc"/></td></tr>
          
          <xsl:for-each select="ead:did/ead:physloc">
            <xsl:if test="starts-with(., 'fol')">
          <tr><td class="ead_label" valign="top"> </td><td><xsl:apply-templates select="."/></td></tr>
            </xsl:if>
          </xsl:for-each>
          <tr><td class="ead_label" valign="top">Scope &amp; Content</td>
            <td>
              <xsl:for-each select="ead:scopecontent/ead:p">                  
                <xsl:apply-templates select="."/>                  
              </xsl:for-each>
            </td></tr>
          <tr><td class="ead_label" valign="top">Subjects</td>
              <td>
                <xsl:for-each select="ead:controlaccess/ead:subject">     
                  <xsl:element name="a">
                    <xsl:attribute name="href">names.php?id=<xsl:value-of select="@authfilenumber"/>&amp;type=subject</xsl:attribute>
                    <xsl:apply-templates select="."/>                  
                  </xsl:element>
                  <br/>
                </xsl:for-each>
              </td></tr>
          <tr><td class="ead_label" valign="top">Places</td>
            <td>
              <xsl:for-each select="ead:controlaccess/ead:geogname">     
                <xsl:element name="a">
                  <xsl:attribute name="href">names.php?id=<xsl:value-of select="@authfilenumber"/>&amp;type=place</xsl:attribute>
                  <xsl:apply-templates select="."/>                  
                </xsl:element>
                <br/>
              </xsl:for-each>
            </td></tr>
          <tr><td class="ead_label" valign="top">People</td>
            <td>
              <xsl:for-each select="ead:controlaccess/ead:persname">     
                <xsl:element name="a">
                  <xsl:attribute name="href">names.php?id=<xsl:value-of select="@authfilenumber"/>&amp;type=person</xsl:attribute>
                  <xsl:apply-templates select="."/>                  
                </xsl:element>
                <br/>
              </xsl:for-each>
            </td></tr>
          <tr><td class="ead_label" valign="top">Organisations</td>
            <td>
              <xsl:for-each select="ead:controlaccess/ead:corpname">     
                <xsl:element name="a">
                  <xsl:attribute name="href">names.php?id=<xsl:value-of select="@authfilenumber"/>&amp;type=organisation</xsl:attribute>
                  <xsl:apply-templates select="."/>                  
                </xsl:element>
                <br/>
              </xsl:for-each>
            </td></tr>
        </table>
        </div>
        
        <xsl:if test="ead:c//text()">
          <div class="component-list">
            <!-- Check if there is an associated TEI -->
            <xsl:variable name="teiexists">../teixml/GB-237-<xsl:value-of select="$mrid"/>.xml</xsl:variable>         
            <xsl:variable name="ancestor_teiexists">../teixml/GB-237-<xsl:value-of select="translate(ancestor::ead:c/ead:did/ead:unitid, '/', '-')"/>.xml</xsl:variable>
            
            <xsl:if test="document($teiexists)">
              <xsl:text> </xsl:text>
              
              <img src="tei.png" width="50"/> available for items below this<br/>
            </xsl:if>
        <h2>Containing:</h2> 
        <ul>
        <xsl:for-each select="ead:c">
          <li>
            <xsl:element name="a">
              <xsl:attribute name="href"><xsl:value-of select="$self"/>?view=eadc&amp;ead=<xsl:value-of select="//ead:archdesc/ead:did/ead:unitid"/>&amp;id=<xsl:value-of select="ead:did/ead:unitid"/>
              </xsl:attribute>
            <xsl:value-of select="ead:did/ead:unitid"/>: <xsl:value-of select="ead:did/ead:unittitle"/> 
            </xsl:element>
          </li>
        </xsl:for-each>
        </ul>
         </div> 
          </xsl:if>      
    
      </xsl:if>
    </xsl:for-each> 
       
  </xsl:template> 
  
  
  
  
  <!--LINE BREAKS-->
  <xsl:template match="//ead:lb">
    <lb/>
    <xsl:apply-templates/>
  </xsl:template>
  
  <!--PARAGRAPHS-->
  <xsl:template match="//ead:p">
    <p><xsl:apply-templates/></p>
    
  </xsl:template>
  
  <!--DIMENSIONS-->
  <xsl:template match="//ead:dimensions">
    <span style="margin-left: 10px"><xsl:apply-templates/></span>
    
  </xsl:template>
  
</xsl:stylesheet>