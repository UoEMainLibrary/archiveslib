<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    version="1.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
    <xsl:output method="html" omit-xml-declaration="yes" indent="yes" encoding="utf-8"/>
    <xsl:param name="node" />
    <xsl:template match="/">
        
        
        <xsl:for-each select="//instance">
            
            <xsl:if test="ref=$node"> 
                <div class="image">
                    <!--<xsl:value-of select="parent_ref"></xsl:value-of>, <xsl:value-of select="caption"/>-->
                 <xsl:element name="a">
                     <xsl:attribute name="href">images/<xsl:value-of select="image"/></xsl:attribute> 
                     <xsl:attribute name="target">_blank</xsl:attribute>  
                <xsl:element name="img">
                <xsl:attribute name="src">images/<xsl:value-of select="image"/></xsl:attribute>
                    <xsl:attribute name="width">280</xsl:attribute>
                </xsl:element>
                </xsl:element>
                    <br/>
                </div>
              </xsl:if>
        </xsl:for-each>          
        
        
        
    </xsl:template> 
    
</xsl:stylesheet>