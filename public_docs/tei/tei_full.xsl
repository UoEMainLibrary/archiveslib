<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
  <xsl:output method="html" omit-xml-declaration="yes" indent="yes" encoding="utf-8"/>
  <xsl:param name="source" />
  <xsl:param name="source_file" />
  <xsl:param name="page" />
  <xsl:template match="/">
    
 <xsl:apply-templates select="TEI.2/text/body"/> 
            
 </xsl:template>
  
  <xsl:template match="//div">   
    <xsl:element name="div">
      <hr class="item-division"/>
      <p><xsl:value-of select="@id"/></p>
      <div><xsl:apply-templates/></div>
    
    </xsl:element>
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
 <!--   <p>=== PAGE BREAK === <xsl:value-of select="@id"/>:
    Page: f.<xsl:value-of select="substring-after(@id,'-')"/></p>
    Source: <xsl:value-of select="//body/div/@id"/>-->
    <hr class="page-division"/>
    <br/>
    <xsl:element name="object">
      <xsl:attribute name="align">middle</xsl:attribute> 
      <xsl:attribute name="class">image</xsl:attribute> 
      <xsl:variable name="and"><![CDATA[&]]></xsl:variable>
      <xsl:attribute name="data" >images_full.php?source=<xsl:value-of select="$source"/><xsl:value-of select="$and"/>page=f.<xsl:value-of select="substring-after(@id,'-')"/></xsl:attribute> 
      <xsl:attribute name="width">620</xsl:attribute> 
      <xsl:attribute name="height">830</xsl:attribute>
    </xsl:element>
    <br/>    
    
    
  </xsl:template>
</xsl:stylesheet>