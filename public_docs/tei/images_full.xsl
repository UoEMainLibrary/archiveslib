<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
  <xsl:output method="html" omit-xml-declaration="yes" indent="yes" encoding="utf-8"/>
  <xsl:param name="source" />
  <xsl:param name="page" />
  <xsl:template match="/">
    <div class="image">
      <!--SRC:<xsl:value-of select="$source"/>-->
      <xsl:for-each select="//instance[caption=$page and parent_ref=$source][1]">
        <!--PR:<xsl:value-of select="parent_ref"/> -->
      
         
         <div class="image">Page: <xsl:value-of select="caption"/></div>
            <xsl:element name="img">
              <xsl:attribute name="src">images/<xsl:value-of select="image"/></xsl:attribute>
              <xsl:attribute name="style">max-width: 600px;</xsl:attribute>
            </xsl:element>
        
        
          
        
        
      
        
    </xsl:for-each>          
    </div>
    
    
  </xsl:template> 
  
</xsl:stylesheet>