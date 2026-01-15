<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  version="1.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
  <xsl:output method="html" omit-xml-declaration="yes" indent="yes" encoding="utf-8"/>
  <xsl:param name="node" />  
  <xsl:param name="view" />
  <xsl:template match="/">

<xsl:choose>
  <xsl:when test="$view='item'">
 
    <xsl:for-each select="TEI.2/text/body/div/div">
       
      <xsl:if test="@id=$node">
        
       
        <!--<div class="id">Ref. ID: <xsl:value-of select="@id"/>       
        </div>-->
        
        <div>
        <xsl:element name="a">
          <xsl:attribute name="href">
            <xsl:text>?source=</xsl:text><xsl:value-of select="//TEI.2/text/body/div/@id"/><xsl:text>.xml&amp;view=toc</xsl:text>
          </xsl:attribute>
          Back to Notebook Contents
        </xsl:element>
          <br/><br/>
        </div>
        <xsl:choose>
          <xsl:when test="title"></xsl:when>
          <xsl:otherwise>[No title given]</xsl:otherwise>
        </xsl:choose>
        
       
        <xsl:apply-templates/>
     
      </xsl:if>
    </xsl:for-each> 
   
  </xsl:when> 
  <xsl:otherwise>
    <h1>Notebook Contents</h1>
    <ul>
      <xsl:for-each select="TEI.2/text/body/div/div">
        <li>
          <xsl:element name="a">
            <xsl:attribute name="href">
              <xsl:text>?view=item&amp;source=</xsl:text><xsl:value-of select="//TEI.2/text/body/div/@id"/><xsl:text>.xml&amp;node=</xsl:text><xsl:value-of select="@id"/>
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
  </xsl:otherwise>
</xsl:choose>
  </xsl:template>
  
  <xsl:template match="//title">   
     <strong><xsl:apply-templates/></strong>
  </xsl:template>
  
  <xsl:template match="//p">
    <p><xsl:apply-templates/></p>    
  </xsl:template>
  
  <xsl:template match="//lg">
    <div class="linegrp"><xsl:apply-templates/></div>    
  </xsl:template>
  
  <xsl:template match="//l">
    <div class="line"><xsl:apply-templates/></div>    
  </xsl:template>
  
  <xsl:template match="//expan">
    [<xsl:apply-templates/>]    
  </xsl:template>
  
  <xsl:template match="//corr">
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
  
  <xsl:template match="//date">
    <span class="date"><xsl:apply-templates/></span>    
  </xsl:template>
  
  <xsl:template match="//del">
    <span style="text-decoration: line-through;">
      <xsl:apply-templates/>
    </span>
  </xsl:template>
  
  <xsl:template match="//orig">
    <span style="text-decoration: line-through;">
      <xsl:apply-templates/><xsl:text> </xsl:text>
    </span>
  </xsl:template>
  
  <xsl:template match="//lb">
    <br/>
  </xsl:template>
  
  <xsl:template match="//pb">
    <p>=== PAGE BREAK === <xsl:value-of select="@id"/></p>
  </xsl:template>
</xsl:stylesheet>