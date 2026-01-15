<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    version="1.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:eac="urn:isbn:1-931666-33-4">
    <xsl:output method="html" omit-xml-declaration="yes" indent="yes" encoding="utf-8"/>
    <xsl:template match="/">
        <p>From EAC file - ID: <xsl:value-of select="//eac:entityId"/></p>
        
        <xsl:for-each select="//eac:biogHist/eac:p">
            <p><xsl:value-of select="."/></p> 
            
        </xsl:for-each>
        
    </xsl:template>
    </xsl:stylesheet>