<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0"
	xmlns:ead="urn:isbn:1-931666-22-9" xmlns:ns2="http://www.w3.org/1999/xlink"
	exclude-result-prefixes="xsl ead ns2">
	<xsl:output method="html" omit-xml-declaration="yes" indent="yes" encoding="utf-8"/>
	<xsl:param name="self" />
	<xsl:param name="node" />
	<xsl:template match="/">
		
		<div class="fonds">
			<table width="100%">
				<tr><td class="ead_label">Ref. code</td><td><xsl:value-of select="//ead:archdesc/ead:did/ead:unitid"/></td></tr>
				<tr><td class="ead_label">Title</td><td><xsl:value-of select="//ead:archdesc/ead:did/ead:unittitle"/></td></tr>
				<tr><td class="ead_label">Date</td><td><xsl:value-of select="//ead:archdesc/ead:did/ead:unitdate"/>)</td></tr>
				<tr><td class="ead_label" valign="top">Physical</td><td><xsl:value-of select="//ead:archdesc/ead:did/ead:physdesc"/></td></tr>
				<tr><td class="ead_label" valign="top">Scope &amp; Content</td>
				<td>
					<xsl:for-each select="//ead:archdesc/ead:scopecontent/ead:p">                  
						<xsl:apply-templates select="."/>                  
					</xsl:for-each>
				</td></tr>
				<tr><td class="ead_label" valign="top">Subjects</td>
					<td>
						<xsl:for-each select="//ead:archdesc/ead:controlaccess/ead:subject">     
							<xsl:element name="a">
								<xsl:attribute name="href">names.php?id=<xsl:value-of select="@authfilenumber"/>&amp;type=subject</xsl:attribute>
								<xsl:apply-templates select="."/>                  
							</xsl:element>
							<br/>
						</xsl:for-each>
					</td></tr>
				<tr><td class="ead_label" valign="top">People</td>
					<td>
						<xsl:for-each select="//ead:archdesc/ead:controlaccess/ead:persname">     
							<xsl:element name="a">
								<xsl:attribute name="href">names.php?id=<xsl:value-of select="@authfilenumber"/>&amp;type=person</xsl:attribute>
								<xsl:apply-templates select="."/>                  
							</xsl:element>
							<br/>
						</xsl:for-each>
					</td></tr>
			</table>
			
		</div>
		
		<div class="contains">
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
							
							
							<xsl:variable name="teiexists">../teixml/GB-237-<xsl:value-of select="$noderef"/>.xml</xsl:variable>							
							<xsl:variable name="ancestor_teiexists">../teixml/GB-237-<xsl:value-of select="translate(ancestor::ead:c/ead:did/ead:unitid, '/', '-')"/>.xml</xsl:variable>
							<!--<xsl:value-of select="$teiexists"/>-->
							
							<xsl:choose>
							<xsl:when test="document($teiexists)">
								<xsl:text> </xsl:text>
								<xsl:element name="a">
									<xsl:attribute name="href">./?view=toc&amp;source=GB-237-<xsl:value-of select="$noderef"/>.xml</xsl:attribute>
									<img src="tei.png" width="20" alt="TEI logo"/><img src="down.png" width="20" alt="down arrow"/>
								</xsl:element>					
							</xsl:when>	
								<xsl:when test="document($ancestor_teiexists)">
									<xsl:text> </xsl:text>
									<xsl:element name="a">
										<xsl:attribute name="href">./?view=toc&amp;source=GB-237-<xsl:value-of select="$noderef"/>.xml</xsl:attribute>
										<img src="tei.png" width="20" alt="TEI logo"/>
									</xsl:element>					
								</xsl:when>		
							</xsl:choose>
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
							<xsl:variable name="ancestor_teiexists">../teixml/GB-237-<xsl:value-of select="translate(ancestor::ead:c/ead:did/ead:unitid, '/', '-')"/>.xml</xsl:variable>
							<li>
								<xsl:element name="a">
									<xsl:attribute name="href"><xsl:value-of select="$self"/>?view=eadc&amp;ead=<xsl:value-of select="//ead:archdesc/ead:did/ead:unitid"/>&amp;id=<xsl:value-of select="ead:did/ead:unitid"/></xsl:attribute>
									<xsl:value-of select="ead:did/ead:unitid"/> : <xsl:value-of select="ead:did/ead:unittitle"/> (<xsl:value-of select="ead:did/ead:unitdate"/>)
									<xsl:if test="document($ancestor_teiexists)">
										<xsl:text> </xsl:text>
										<img src="tei.png" width="20" alt="TEI logo"/>
										</xsl:if>
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