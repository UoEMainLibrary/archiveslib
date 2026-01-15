<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    version="1.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
    <xsl:output method="html" omit-xml-declaration="yes" indent="yes" encoding="utf-8"/>
    
    <xsl:template match="/">
        <xsl:for-each select="//dc:rights">
            <xsl:value-of select="."/>
        </xsl:for-each>
        
        </xsl:template>
</xsl:stylesheet>