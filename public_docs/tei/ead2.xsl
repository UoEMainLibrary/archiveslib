<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0"
	xmlns:ead="urn:isbn:1-931666-22-9" xmlns:ns2="http://www.w3.org/1999/xlink"
	exclude-result-prefixes="xsl ead ns2">
	<xsl:output method="html" omit-xml-declaration="yes" indent="yes" encoding="utf-8"/>
	<xsl:param name="self" />
	<xsl:param name="node" />
	<xsl:template match="/">
		
		<xsl:value-of select="//ead:archdesc/ead:did/ead:unitid"/> : <xsl:value-of select="//ead:archdesc/ead:did/ead:unittitle"/> (<xsl:value-of select="//ead:archdesc/ead:did/ead:unitdate"/>)
		
		<div>
			<xsl:for-each select="//ead:dsc/ead:c">
				<xsl:choose>
				<xsl:when test="ead:c//text()"> 
				<button class="collapsible">
					
					<xsl:element name="a">
						<xsl:attribute name="href"><xsl:value-of select="$self"/>?view=eadc&amp;ead=<xsl:value-of select="//ead:archdesc/ead:did/ead:unitid"/>&amp;id=<xsl:value-of select="ead:did/ead:unitid"/></xsl:attribute>
					<xsl:value-of select="ead:did/ead:unitid"/> : <xsl:value-of select="ead:did/ead:unittitle"/> (<xsl:value-of select="ead:did/ead:unitdate"/>)
					</xsl:element>
					<xsl:variable name="noderef" select="translate(ead:did/ead:unitid, '/', '-')"/>
				<!--<xsl:value-of select="$noderef"/> :--> 
				
					
					<xsl:variable name="teiexists">teixml/GB-237-<xsl:value-of select="$noderef"/>.xml</xsl:variable>
				<!--<xsl:value-of select="$teiexists"/>-->
				<xsl:if test="document($teiexists)">
				<xsl:text> </xsl:text>
					<xsl:element name="a">
						<xsl:attribute name="href">./?view=toc&amp;source=GB-237-<xsl:value-of select="$noderef"/>.xml</xsl:attribute>
					<img src="tei.png" width="20"/>
					</xsl:element>					
				</xsl:if>					
				</button>
				</xsl:when>
					<xsl:otherwise>
						<xsl:element name="a">
							<xsl:attribute name="href"><xsl:value-of select="$self"/>?view=eadc&amp;ead=<xsl:value-of select="//ead:archdesc/ead:did/ead:unitid"/>&amp;id=<xsl:value-of select="ead:did/ead:unitid"/></xsl:attribute>
						<div class="list_item"><xsl:value-of select="ead:did/ead:unitid"/> : <xsl:value-of select="ead:did/ead:unittitle"/> (<xsl:value-of select="ead:did/ead:unitdate"/>)</div>
						</xsl:element>
					</xsl:otherwise>
				</xsl:choose>
					<div class="content">
					
					<ul>
					<xsl:for-each select="ead:c">
						<li>
							<xsl:element name="a">
								<xsl:attribute name="href"><xsl:value-of select="$self"/>?view=eadc&amp;ead=<xsl:value-of select="//ead:archdesc/ead:did/ead:unitid"/>&amp;id=<xsl:value-of select="ead:did/ead:unitid"/></xsl:attribute>
								<xsl:value-of select="ead:did/ead:unitid"/> : <xsl:value-of select="ead:did/ead:unittitle"/> (<xsl:value-of select="ead:did/ead:unitdate"/>)
							</xsl:element>
							<ul>
								<xsl:for-each select="ead:c">
									<li>
										<xsl:element name="a">
											<xsl:attribute name="href"><xsl:value-of select="$self"/>?view=eadc&amp;ead=<xsl:value-of select="//ead:archdesc/ead:did/ead:unitid"/>&amp;id=<xsl:value-of select="ead:did/ead:unitid"/></xsl:attribute>
											<xsl:value-of select="ead:did/ead:unitid"/> : <xsl:value-of select="ead:did/ead:unittitle"/> (<xsl:value-of select="ead:did/ead:unitdate"/>)
										</xsl:element>
										<ul>
											<xsl:for-each select="ead:c">
												<li>
													<xsl:element name="a">
														<xsl:attribute name="href"><xsl:value-of select="$self"/>?view=eadc&amp;ead=<xsl:value-of select="//ead:archdesc/ead:did/ead:unitid"/>&amp;id=<xsl:value-of select="ead:did/ead:unitid"/></xsl:attribute>
														<xsl:value-of select="ead:did/ead:unitid"/> : <xsl:value-of select="ead:did/ead:unittitle"/> (<xsl:value-of select="ead:did/ead:unitdate"/>)
													</xsl:element>
													
												</li>						
											</xsl:for-each>
										</ul>
									</li>						
								</xsl:for-each>
							</ul>
						</li>						
					</xsl:for-each>
					</ul>
				</div>	
				
			</xsl:for-each> 
			         
		</div>	
		
		
	</xsl:template> 
	
</xsl:stylesheet>