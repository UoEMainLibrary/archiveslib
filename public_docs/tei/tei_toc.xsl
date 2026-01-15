<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  version="1.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
  <xsl:output method="html" omit-xml-declaration="yes" indent="yes" encoding="utf-8"/>
    <xsl:template match="/">
    <a name="top"/>   
    <h1>Table of Contents</h1>
    <ul>
      <xsl:for-each select="TEI.2/text/body/div/div">
        <li>
          <xsl:element name="a">
            <xsl:attribute name="href">
              <xsl:text>?source=</xsl:text><xsl:value-of select="//TEI.2/text/body/div/@id"/><xsl:text>.xml&amp;node=</xsl:text><xsl:value-of select="@id"/>
            </xsl:attribute>
            <xsl:value-of select="@id"/>: 
            <xsl:choose>
              <xsl:when test="title"><xsl:apply-templates select="title"/></xsl:when>
              <xsl:otherwise>
                [No title given]
              
              </xsl:otherwise>
            </xsl:choose>
          </xsl:element>
        </li>
      </xsl:for-each>
    </ul>
    
  </xsl:template>
  
  <xsl:template match="//expan">
    [<xsl:apply-templates/>]    
  </xsl:template>
  
  <xsl:template match="//name">
    <xsl:choose>
      <xsl:when test="@type = 'place'">
        <span class="place"><xsl:apply-templates/></span>
        <xsl:text> </xsl:text>
        
        <xsl:element name="a">
          <xsl:attribute name="href">
            names.php?id=<xsl:value-of select="@key"/>&amp;type=<xsl:value-of select="@type"/>
          </xsl:attribute>
          <img src="globe-128.png" height="13"/>
        </xsl:element>
      </xsl:when>
      <xsl:when test="@type = 'person'">
        <span class="person"><xsl:apply-templates/></span> 
        <xsl:text> </xsl:text>
        <xsl:element name="a">
          <xsl:attribute name="href">
            names.php?id=<xsl:value-of select="@key"/>&amp;type=<xsl:value-of select="@type"/>
          </xsl:attribute>
          <img src="person-128.png" height="13"/>  
        </xsl:element>
      </xsl:when>
    </xsl:choose>
  </xsl:template>
</xsl:stylesheet>