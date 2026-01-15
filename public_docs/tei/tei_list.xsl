<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	version="1.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<xsl:output method="html" omit-xml-declaration="yes" indent="yes" encoding="utf-8"/>
	<xsl:param name="node" />
	<xsl:template match="/">
		
<div>Notebook 
	
	
	<form action="./" method="get">
		<input type="hidden" name="view" value="toc" />
		<select name="source">
		<xsl:for-each select="//c">
			<xsl:variable name="filep">teixml/<xsl:value-of select="@id"/>.xml</xsl:variable>
				<xsl:if test="document($filep)">
				<xsl:element name="option">
					<xsl:attribute name="value"><xsl:value-of select="@id"/>.xml</xsl:attribute>
				<xsl:value-of select="did/unitid"/>
				</xsl:element>
				
			</xsl:if>
		</xsl:for-each>     
			
		</select>
		<input type="submit" value="Select" />
	</form>
</div>	
		
		
	</xsl:template> 
	
</xsl:stylesheet>