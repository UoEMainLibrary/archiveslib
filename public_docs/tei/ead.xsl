<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  version="1.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
  <xsl:output method="html" omit-xml-declaration="yes" indent="yes" encoding="utf-8"/>
  <xsl:param name="node" />
  <xsl:template match="/">
        
    
        <xsl:for-each select="//c">
      
          <xsl:if test="@id=$node">  
            <table>
              <tr><td class="ead_label" width="150" valign="top">Ref. code</td><td><xsl:value-of select="did/unitid"/></td></tr>
              <tr><td class="ead_label" valign="top">Title</td><td><xsl:value-of select="did/unittitle"/></td></tr>
              <tr><td class="ead_label" valign="top">Date(s)</td><td><xsl:value-of select="did/unitdate"/></td></tr>
              <tr><td class="ead_label" valign="top">Physical</td><td><xsl:value-of select="did/physdesc"/></td></tr>
              <tr><td class="ead_label" valign="top">Scope &amp; Content</td>
                <td>
                <xsl:for-each select="scopecontent/p">                  
                  <xsl:apply-templates select="."/>                  
                </xsl:for-each>
                </td></tr>
              <tr><td class="ead_label" valign="top">People</td>
                <td>
                  <xsl:for-each select="controlaccess/controlaccess/persname">     
                    <xsl:element name="a">
                      <xsl:attribute name="href">names.php?id=<xsl:value-of select="@authfilenumber"/>&amp;type=person</xsl:attribute>
                    <xsl:apply-templates select="."/>                  
                    </xsl:element>
                    <br/>
                  </xsl:for-each>
                </td></tr>
            </table>
          </xsl:if>
           </xsl:for-each>          
    
    
    
  </xsl:template> 
  <!--LINE BREAKS-->
  <xsl:template match="//lb">
    <lb/>
    <xsl:apply-templates/>
  </xsl:template>
  
  <!--PARAGRAPHS-->
  <xsl:template match="//p">
    <p><xsl:apply-templates/></p>
    
  </xsl:template>
  
  <!--DIMENSIONS-->
  <xsl:template match="//dimensions">
    <span style="margin-left: 10px">Dim. <xsl:apply-templates/></span>
    
  </xsl:template>
  
</xsl:stylesheet>