<?xml version="1.0" standalone="yes" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="xml" omit-xml-declaration="no" indent="yes" encoding="utf-8"/>

	<xsl:template match="/">
		<ead>
			<eadheader>
			<xsl:element name="eadid">
			<xsl:attribute name="countrycode">GB</xsl:attribute> 
			<xsl:attribute name="mainagencycode">237</xsl:attribute> 
			<xsl:attribute name="publicid">
			<xsl:value-of select="/ead/eadheader/eadid/@publicid"/>
			</xsl:attribute> 
		  <xsl:apply-templates select="/ead/eadheader/eadid"/>
			</xsl:element>
	 <filedesc> 
		<titlestmt> 
		  <xsl:apply-templates select="/ead/eadheader/filedesc/titlestmt/titleproper"/>
		</titlestmt>
	 </filedesc>
	 
	  
</eadheader> 
<xsl:element name="archdesc">

<xsl:attribute name="level">
<xsl:value-of select="/ead/archdesc/@level"/>
</xsl:attribute>
 <xsl:attribute name="id">
            <xsl:value-of select="/ead/archdesc/@id"/>
	</xsl:attribute>		
	<did>			
				<!-- <xsl:apply-templates select="/ead/eadheader/filedesc/titlestmt/titleproper"/> -->
				<!-- <unittitle>
				<xsl:value-of select="/ead/eadheader/filedesc/titlestmt/titleproper"/>
				</unittitle> -->
				
				<xsl:apply-templates select="ead/archdesc/did/repository"/>
				<xsl:apply-templates select="ead/archdesc/did/unitid"/>
				<xsl:apply-templates select="ead/archdesc/did/physloc"/>
		 <!-- <xsl:apply-templates select="/ead/archdesc/did/unittitle"/> -->
				<xsl:variable name="cid" select="ead/archdesc/@id"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/unittitle.php?id='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$cid"/>
							</xsl:variable>
							<xsl:copy-of select="document($input-file)" />
				<xsl:apply-templates select="/ead/archdesc/did/unitdate"/>
				<physdesc encodinganalog="isadg(2)315" label="Extent and Medium of the Unit of Description">
				<xsl:apply-templates select="ead/archdesc/did/physdesc/extent"/>
				<xsl:apply-templates select="ead/archdesc/did/physdesc/genreform"/>
				<xsl:apply-templates select="ead/archdesc/did/physdesc/dimensions"/>
				</physdesc>				
				<xsl:apply-templates select="ead/archdesc/did/physdesc/physfacet"/>
				
				<xsl:apply-templates select="ead/archdesc/did/origination"/>
				
				<langmaterial>
				<!-- <xsl:apply-templates select="ead/archdesc/did/langmaterial"/> -->
				<xsl:apply-templates select="ead/archdesc/did/langmaterial/language"/>
				</langmaterial>
				<xsl:if test="ead/archdesc/physdesc//text()">
				<phystech>
				<xsl:apply-templates select="ead/archdesc/phystech"/>
				<xsl:apply-templates select="ead/archdesc/phystech/p"/>
				<!-- <xsl:apply-templates select="ead/archdesc/descgrp/phystech"/> -->
				</phystech>
				</xsl:if>
				</did>
				
				<bioghist encodinganalog="isadg(2)322">
				<!-- <xsl:apply-templates select="ead/archdesc/bioghist"/> -->
				<xsl:apply-templates select="ead/archdesc/bioghist/p"/>
				<xsl:apply-templates select="ead/archdesc/bioghist/list"/>
				</bioghist>
				
				<scopecontent encodinganalog="isadg(2)331">
				<!-- <xsl:apply-templates select="ead/archdesc/scopecontent"/> -->
				<xsl:apply-templates select="ead/archdesc/scopecontent/p"/>
				<xsl:apply-templates select="ead/archdesc/scopecontent/list"/>
				<xsl:apply-templates select="ead/archdesc/scopecontent/arrangement"/>
				</scopecontent>
				
<!-- ################################################################################# -->			
<!-- #################### Access points - pull in external content ################### -->
<!-- ################################################################################# -->	

				<xsl:if test="ead/archdesc/controlaccess/controlaccess//text()">
				<controlaccess encodinganalog="NAHSTE38">
					<!-- nested controlaccess -->
					
					<!-- Subjects -->
					<xsl:if test="ead/archdesc/controlaccess/controlaccess/subject//text()">
					<controlaccess encodinganalog="NAHSTE381">
						<xsl:for-each select="ead/archdesc/controlaccess/controlaccess/subject">
							<xsl:variable name="afid" select="@authfilenumber"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/authterm.php?table=cms_auth_subj&amp;authfilenumber='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$afid"/>
							</xsl:variable> 
							<xsl:copy-of select="document($input-file)" />							
						</xsl:for-each>
					</controlaccess>
					</xsl:if>
					
					<!-- Geographic names -->
					<xsl:if test="ead/archdesc/controlaccess/controlaccess/geogname//text()">
					<controlaccess encodinganalog="NAHSTE384">
						<xsl:for-each select="ead/archdesc/controlaccess/controlaccess/geogname">
							<xsl:variable name="afid" select="@authfilenumber"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/authterm.php?table=cms_auth_geog&amp;authfilenumber='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$afid"/>
							</xsl:variable> 
							<xsl:copy-of select="document($input-file)" />							
						</xsl:for-each>
					</controlaccess>
					</xsl:if>
					
					<!-- Genres -->
					<xsl:if test="ead/archdesc/controlaccess/controlaccess/genre//text()">
					<controlaccess encodinganalog="NAHSTE385">
						<xsl:for-each select="ead/archdesc/controlaccess/controlaccess/genre">
							<xsl:variable name="afid" select="@authfilenumber"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/authterm.php?table=cms_auth_genr&amp;authfilenumber='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$afid"/>
							</xsl:variable> 
							<xsl:copy-of select="document($input-file)" />							
						</xsl:for-each>
					</controlaccess>
					</xsl:if>
					
					<!-- Personal names -->
					<xsl:if test="ead/archdesc/controlaccess/controlaccess/persname//text()">
					<controlaccess encodinganalog="NAHSTE382">
						<xsl:for-each select="ead/archdesc/controlaccess/controlaccess/persname">
							<xsl:variable name="afid" select="@authfilenumber"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/authterm.php?table=cms_auth_pers&amp;authfilenumber='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$afid"/>
							</xsl:variable> 
							<xsl:copy-of select="document($input-file)" />							
						</xsl:for-each>
					</controlaccess>
					</xsl:if>
					
					<!-- Corporate names -->
					<xsl:if test="ead/archdesc/controlaccess/controlaccess/corpname//text()">
					<controlaccess encodinganalog="NAHSTE383">
						<xsl:for-each select="ead/archdesc/controlaccess/controlaccess/corpname">
							<xsl:variable name="afid" select="@authfilenumber"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/authterm.php?table=cms_auth_corp&amp;authfilenumber='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$afid"/>
							</xsl:variable> 
							<xsl:copy-of select="document($input-file)" />							
						</xsl:for-each>
					</controlaccess>
					</xsl:if>
					
					<!-- Geographic names -->
					<xsl:if test="ead/archdesc/controlaccess/controlaccess/famname//text()">
					<controlaccess encodinganalog="NAHSTE385">
						<xsl:for-each select="ead/archdesc/controlaccess/controlaccess/famname">
							<xsl:variable name="afid" select="@authfilenumber"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/authterm.php?table=cms_auth_fam&amp;authfilenumber='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$afid"/>
							</xsl:variable> 
							<xsl:copy-of select="document($input-file)" />							
						</xsl:for-each>
					</controlaccess>
					</xsl:if>
					
				</controlaccess>
				</xsl:if>
				
<!-- ################################################################################# -->
<!-- ############## End of Access points ############################################# -->		
<!-- ################################################################################# -->	
				
				<descgrp>
				
				<xsl:if test="ead/archdesc/arrangement//text()">
				<arrangement encodinganalog="isadg(2)334">
				<xsl:apply-templates select="ead/archdesc/arrangement"/>
				<xsl:apply-templates select="ead/archdesc/arrangement/p"/>
				<xsl:apply-templates select="ead/archdesc/arrangement/list"/>
				</arrangement>
				</xsl:if>
				
				<xsl:if test="ead/archdesc/custodhist//text()">
				<custodhist encodinganalog="isadg(2)323">
				<xsl:apply-templates select="ead/archdesc/custodhist"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/custodhist"/>
				
				<xsl:apply-templates select="ead/archdesc/custodhist/p"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/custodhist/p"/>
				</custodhist>
				</xsl:if>
				
				<acqinfo encodinganalog="isadg(2)324">
				<xsl:apply-templates select="ead/archdesc/acqinfo"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/acqinfo"/>
				
				<xsl:apply-templates select="ead/archdesc/acqinfo/p"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/acqinfo/p"/>
				</acqinfo>
				
				<appraisal encodinganalog="isadg(2)332">
				<xsl:apply-templates select="ead/archdesc/appraisal"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/appraisal"/>
				
				<xsl:apply-templates select="ead/archdesc/appraisal/p"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/appraisal/p"/>
				</appraisal>
				
				<accruals encodinganalog="isadg(2)333">
				<xsl:apply-templates select="ead/archdesc/accruals"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/accruals"/>
				
				<xsl:apply-templates select="ead/archdesc/accruals/p"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/accruals/p"/>	
							
				<xsl:apply-templates select="ead/archdesc/accruals/list"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/accruals/list"/>
				</accruals>
				
				<userestrict encodinganalog="isadg(2)342">
				<xsl:apply-templates select="ead/archdesc/userestrict"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/userestrict"/>
				
				<xsl:apply-templates select="ead/archdesc/userestrict/p"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/userestrict/p"/>
				</userestrict>
				
				<accessrestrict encodinganalog="isadg(2)341">
				<xsl:apply-templates select="ead/archdesc/accessrestrict"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/accessrestrict"/>
				
				<xsl:apply-templates select="ead/archdesc/accessrestrict/p"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/accessrestrict/p"/>
				</accessrestrict>				
				
				<altformavail encodinganalog="isadg(2)352">
				<xsl:apply-templates select="ead/archdesc/altformavail"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/altformavail"/>
				
				<xsl:apply-templates select="ead/archdesc/altformavail/p"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/altformavail/p"/>
				</altformavail>
				
				<originalsloc encodinganalog="isadg(2)351">
				<xsl:apply-templates select="ead/archdesc/originalsloc"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/originalsloc"/>		
				
				<xsl:apply-templates select="ead/archdesc/originalsloc/p"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/originalsloc/p"/>
				</originalsloc>
				
				<otherfindaid encodinganalog="isadg(2)345">
				<xsl:apply-templates select="ead/archdesc/otherfindaid"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/otherfindaid"/>
				
				<xsl:apply-templates select="ead/archdesc/otherfindaid/p"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/otherfindaid/p"/>
				</otherfindaid>
				
				<relatedmaterial encodinganalog="isadg(2)353">
				<xsl:apply-templates select="ead/archdesc/relatedmaterial"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/relatedmaterial"/>
				
				<xsl:apply-templates select="ead/archdesc/relatedmaterial/p"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/relatedmaterial/p"/>
				
				<xsl:apply-templates select="ead/archdesc/relatedmaterial/list"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/relatedmaterial/list"/>
				</relatedmaterial>
				
				<separatedmaterial>
				<xsl:apply-templates select="ead/archdesc/separatedmaterial"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/separatedmaterial"/>
				
				<xsl:apply-templates select="ead/archdesc/separatedmaterial/p"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/separatedmaterial/p"/>
				</separatedmaterial>
				
				<odd>
				<xsl:apply-templates select="ead/archdesc/odd"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/odd"/>
				
				<xsl:apply-templates select="ead/archdesc/odd/p"/>
				<xsl:apply-templates select="ead/archdesc/descgrp/odd/p"/>
				</odd>
				
				<bibliography encodinganalog="isadg(2)354">
				<xsl:apply-templates select="ead/archdesc/bibliography"/>
				<xsl:apply-templates select="ead/archdesc/bibliography/p"/>
				<xsl:apply-templates select="ead/archdesc/bibliography/list"/>
				</bibliography>
				
				<prefercite>
				<xsl:apply-templates select="ead/archdesc/prefercite"/>
				<xsl:apply-templates select="ead/archdesc/prefercite/p"/>
				</prefercite>
				
				<!--<note>
				<xsl:apply-templates select="ead/archdesc/note"/>
				<xsl:apply-templates select="ead/archdesc/note/p"/>
				<xsl:apply-templates select="ead/archdesc/note/list"/>
				<xsl:apply-templates select="ead/eadheader/filedesc/notestmt/note"/>
				<xsl:apply-templates select="ead/eadheader/filedesc/notestmt/note/p"/>
				<xsl:apply-templates select="ead/eadheader/filedesc/notestmt/note/list"/>
			
				<xsl:apply-templates select="ead/archdesc/did/note"/>
				</note>-->
				
				<processinfo>
				<xsl:apply-templates select="ead/archdesc/processinfo"/>
				<xsl:apply-templates select="ead/archdesc/processinfo/p"/>
				</processinfo>
				
				</descgrp>
				
			  <!-- <xsl:apply-templates select="ead/archdesc/controlaccess"/> -->
				
				<xsl:apply-templates select="ead/archdesc/dsc"/>
				<xsl:apply-templates select="ead/archdesc/dsc/c"/>
				
				<!-- close ARCHDESC -->
			</xsl:element>
		</ead>
	</xsl:template>
	
	<!-- LISTS -->
	<xsl:template match="list">
		<xsl:choose>
			<xsl:when test="@type='ordered'">
				<list type="ordered">
					<xsl:for-each select="item">
						<item>
							<xsl:apply-templates/>
						</item>
					</xsl:for-each>
				</list>
			</xsl:when>
			<xsl:when test="@type='unordered'">
				<list type="unordered">
					<xsl:for-each select="item">
						<item>
							<xsl:apply-templates/>
						</item>
					</xsl:for-each>
				</list>
			</xsl:when>
			<xsl:when test="@type='marked'">
				<list type="marked">
					<xsl:for-each select="item">
						<item>
							<xsl:apply-templates/>
						</item>
					</xsl:for-each>
				</list>
			</xsl:when>
			<xsl:when test="@type='simple'">
				<list type="simple">
					<xsl:for-each select="item">
					 <item>
						<xsl:apply-templates/>
						</item>
					</xsl:for-each>
				</list>
			</xsl:when>
			<xsl:otherwise>
				<list>
					<xsl:for-each select="item">
						<item>
							<xsl:apply-templates/>
						</item>
					</xsl:for-each>
				</list>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	
   <!--CHRON LISTS-->
	<xsl:template match="chronlist">
		<chronlist>
			<xsl:for-each select="chronitem">
			<chronitem>
				<xsl:value-of select="."/>
				</chronitem>
			</xsl:for-each>
		</chronlist>
	</xsl:template>
	
   <!--TITLEPROPER -->
	<xsl:template match="filedesc/titlestmt/titleproper">
		<titleproper>
				<xsl:call-template name="all"/>
			</titleproper>
	</xsl:template>
	 
    <!-- START OF BODY OF TEXT -->
	<xsl:template match="/ead/archdesc/did">
		<xsl:apply-templates/>
	</xsl:template>
	<!-- UNITID -->
	<xsl:template match="unitid">
    <xsl:choose>
    <xsl:when test="@encodinganalog = 'formerRef'">
			<unitid encodinganalog="formerRef" label="Former Reference code">
			<xsl:call-template name="all"/>
		</unitid>
            </xsl:when>
            <xsl:otherwise> 
			<unitid encodinganalog="isadg(2)311" label="Reference code">
            <xsl:call-template name="all"/>
            </unitid>
		</xsl:otherwise>          
    </xsl:choose>
	</xsl:template>
	<!-- PHYSLOC -->
	<xsl:template match="physloc">
		<physloc encodinganalog="shelfmark" label="Shelfmark">
		<xsl:call-template name="all"/>
		</physloc>
	</xsl:template>	
	<!-- UNITTITLE -->
	 <xsl:template match="unittitle">
		<unittitle encodinganalog="isadg(2)312" label="Title">
		<xsl:call-template name="all"/>
		</unittitle> 
							
				
	</xsl:template>
	<!-- UNITDATE -->
	<xsl:template match="unitdate">
		<unitdate encodinganalog="isadg(2)313" label="Date">
		<xsl:attribute name="normal">
			<xsl:value-of select="@normal"/>
			</xsl:attribute>
		<xsl:call-template name="all"/>
		</unitdate>
	</xsl:template>
	<!-- REPOSITORY -->
	<xsl:template match="repository">
		<repository>Edinburgh University Library Special Collections</repository>
	</xsl:template>
	<!-- EXTENT -->
	<xsl:template match="extent">
		<extent>
		<xsl:call-template name="all"/>  
		</extent>	
	</xsl:template>
	<!-- GENREFORM -->
	<xsl:template match="genreform">
	<genreform>
	<xsl:call-template name="all"/>
	</genreform>
	</xsl:template>
	<!-- physical condition -->
	<xsl:template match="physfacet">
		<xsl:call-template name="all"/>
	</xsl:template>
	<!-- DIMENSIONS -->
<xsl:template match="dimensions">
		<dimensions>
		<xsl:call-template name="all"/>
		</dimensions>
	</xsl:template>

	
			
	<!-- ORIGINATION -->
	<xsl:template match="origination">
		<origination encodinganalog="isadg(2)321"><xsl:apply-templates/></origination>
	</xsl:template>
	<!-- date created -->
	<xsl:template match="profiledesc/creation">
		<creation><xsl:value-of select="."/></creation>
	</xsl:template>
	<xsl:template match="profiledesc/descrules">
		<descrules><xsl:value-of select="."/></descrules>
	</xsl:template>
	<!-- date revised -->
	<xsl:template match="revisiondesc">
		<strong>Revision</strong>:
		</xsl:template>
	<xsl:template match="revisiondesc/list/item">
		<xsl:value-of select="."/>
	</xsl:template>
	<!-- language -->
	
	<xsl:template match="langmaterial/language">
	<language><xsl:attribute 
	name="langcode"><xsl:value-of select="@langcode"/></xsl:attribute>
		<xsl:value-of select="."/>
		</language>
	</xsl:template>
	<!--publication statement:publisher -->
	
	<!-- biographical -->
	<xsl:template match="bioghist/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>

	<!-- scope and content -->
	<xsl:template match="scopecontent/p">
		<p>
			 <xsl:apply-templates/>
		</p>
	</xsl:template>
	<!-- arrangement in scopecontent field -->
	<xsl:template match="scopecontent/arrangement"><head>
		System of arrangement</head>
		<xsl:apply-templates/>
	</xsl:template>
	<!-- arrangement -->
	<xsl:template match="arrangement">
		<xsl:choose>
   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
   </xsl:when>
   <xsl:otherwise>
		<head>
      System of Arrangement</head>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="arrangement/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
	<!-- physical characteristics -->
	<xsl:template match="phystech">
	
		<xsl:choose>
	   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
	   </xsl:when>
	   <xsl:otherwise>
		<head>
		  Physical Characteristics and Technical Requirements</head>
		</xsl:otherwise>
		</xsl:choose>	
		
   </xsl:template>	
	<xsl:template match="phystech/p">
			<p>
		<xsl:apply-templates/>
		</p>
	</xsl:template>	
	<!-- custodial history -->
	<xsl:template match="custodhist">
		<xsl:choose>
   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
   </xsl:when>
   <xsl:otherwise>
		<head>
      Archival History</head>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="custodhist/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
	<!-- acqinfo -->
		<xsl:template match="acqinfo">
		<xsl:choose>
   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
   </xsl:when>
   <xsl:otherwise>
		<head>
      Immediate source of acquisition</head>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="acqinfo/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
	<!-- acqinfo old -->

	<!-- <xsl:template match="acquinfo/p">
		<p>
			<xsl:call-template name="all"/>
		</p>
	</xsl:template> -->
	<!-- appraisal -->
	<xsl:template match="appraisal">
		<xsl:choose>
   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
   </xsl:when>
   <xsl:otherwise>
		<head>
      Appraisal</head>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="appraisal/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
	<!-- accruals -->
	<xsl:template match="accruals">
		<xsl:choose>
   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
   </xsl:when>
   <xsl:otherwise>
		<head>
      Accruals</head>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="accruals/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
	<!-- userestrict -->
	<xsl:template match="userestrict">
		<xsl:choose>
   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
   </xsl:when>
   <xsl:otherwise>
		<head>
      Conditions Governing Reproduction</head>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="userestrict/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
	<!-- accessrestrict -->
	<xsl:template match="accessrestrict">
		<xsl:choose>
   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
   </xsl:when>
   <xsl:otherwise>
		<head>
      Conditions Governing Access</head>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="accessrestrict/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
	<!-- altformavail -->
	<xsl:template match="altformavail">
		<xsl:choose>
   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
   </xsl:when>
   <xsl:otherwise>
		<head>
      Existence/Location of Copies</head>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="altformavail/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
	<!-- originalsloc -->
	<xsl:template match="originalsloc">
		<xsl:choose>
   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
   </xsl:when>
   <xsl:otherwise>
		<head>
      Existence/Location of Originals</head>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="originalsloc/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
	<!-- otherfindaid -->
	<xsl:template match="otherfindaid">
		<xsl:choose>
   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
   </xsl:when>
   <xsl:otherwise>
		<head>
      Finding Aids</head>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="otherfindaid/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
    
    
    
	<!-- relatedmaterial -->
	<xsl:template match="relatedmaterial">
		<xsl:choose>
   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
   </xsl:when>
   <xsl:otherwise>
		<head>
      Related Units of Description</head>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="relatedmaterial/p">
		<p>
            <xsl:apply-templates/>
		</p>
	</xsl:template>
    
	<!-- Separated material -->
	<xsl:template match="separatedmaterial">
		<xsl:choose>
   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
   </xsl:when>
   <xsl:otherwise>
		<head>
      Separated Material</head>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="separatedmaterial/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
	<!-- other descriptive data -->
	<xsl:template match="odd">
	<xsl:if test="p//text()">
			<head><xsl:value-of select="head"></xsl:value-of></head>
		</xsl:if>
	</xsl:template>
	<xsl:template match="odd/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
	<xsl:template match="odd/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
	<!-- bibliography -->
	<xsl:template match="bibliography">
		<xsl:choose>
   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
   </xsl:when>
   <xsl:otherwise>
		<head>
      Publication Note</head>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="bibliography/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
   <!-- Preferred Citation -->
   	<xsl:template match="prefercite">
		<xsl:choose>
   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
   </xsl:when>
   <xsl:otherwise>
		<head>
      Preferred citation</head>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="prefercite/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
	<!-- NOTE in archdesc -->
	<xsl:template match="notestmt/note">
		<xsl:if test="p//text()"><head>
			Archivist's Note</head>
		</xsl:if>
	</xsl:template>
	<xsl:template match="note">
		<xsl:if test="p//text()"><head>
			Note</head>
		</xsl:if>
	</xsl:template>
	<xsl:template match="note/p">
		<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>
	<!-- note statement in filedesc-->
	<xsl:template match="ead/eadheader/filedesc/notestmt/note/p">
		<xsl:apply-templates/>
	</xsl:template>
	<!-- note statement in processinfo-->
	<xsl:template match="processinfo">
		<xsl:choose>
   <xsl:when test="head/text()"><head><xsl:value-of select="head"/></head>
   </xsl:when>
   <xsl:otherwise>
		<head>
      Archivists's Note</head>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="processinfo/p">
	<p>
			<xsl:apply-templates/>
		</p>
	</xsl:template>	
	<!-- template for calling all -->
	
	<xsl:template name="all">
	
		<xsl:value-of select="."/>
	</xsl:template>
	<!-- index terms -->
<!-- temp removed to tl-index.xsl -->
	
	<!-- LOWER LEVEL DESCRIPTIONS -->
	<!-- the section of the source tree this template applies to is c within dsc. c is the match attribute, so it is the context node and all expressions are relative to this. Everything inside the template is what will be output to the results tree. This template calls the process template. --> 
 <xsl:template match="dsc">
<!-- <xsl:value-of select="head" />  -->
 </xsl:template>
	<xsl:template match="dsc/c">
    <dsc>
		        <xsl:element name="c">
		            <xsl:attribute name="id"><xsl:value-of select="@id"/></xsl:attribute>
		            <xsl:attribute name="level"><xsl:value-of select="@level"/></xsl:attribute>
		
		<!-- call the process-the dsc template usually using call-template name-->
		<xsl:call-template name="process-the-dsc">
		
			<xsl:with-param name="level" select="c"/>
			
			
		</xsl:call-template>
		<!-- where have more components, select them and use the process-the-dsc template. So if there is a c, select this and use the process template for it -->
		<xsl:if test="//c">
			
		    <xsl:for-each select="c">
		        <xsl:element name="c">
		            <xsl:attribute name="id"><xsl:value-of select="@id"/></xsl:attribute>
		            <xsl:attribute name="level"><xsl:value-of select="@level"/></xsl:attribute>
					<xsl:call-template name="process-the-dsc">
          
          </xsl:call-template>
					<xsl:if test="//c">
						
					    <xsl:for-each select="c">
					        <xsl:element name="c">
					            <xsl:attribute name="id"><xsl:value-of select="@id"/></xsl:attribute>
					            <xsl:attribute name="level"><xsl:value-of select="@level"/></xsl:attribute>
								<xsl:call-template name="process-the-dsc">
          
          </xsl:call-template>
								<xsl:if test="//c">
									
								    <xsl:for-each select="c">
								        <xsl:element name="c">
								            <xsl:attribute name="id"><xsl:value-of select="@id"/></xsl:attribute>
								            <xsl:attribute name="level"><xsl:value-of select="@level"/></xsl:attribute>
											<xsl:call-template name="process-the-dsc">
          
          </xsl:call-template>
											<xsl:if test="//c">
												
											    <xsl:for-each select="c">
											        <xsl:element name="c">
											            <xsl:attribute name="id"><xsl:value-of select="@id"/></xsl:attribute>
											            <xsl:attribute name="level"><xsl:value-of select="@level"/></xsl:attribute>
														<xsl:call-template name="process-the-dsc">
          
          </xsl:call-template>
														<xsl:if test="//c">
															
														    <xsl:for-each select="c">
														        <xsl:element name="c">
														            <xsl:attribute name="id"><xsl:value-of select="@id"/></xsl:attribute>
														            <xsl:attribute name="level"><xsl:value-of select="@level"/></xsl:attribute>
																	<xsl:call-template name="process-the-dsc">
          
																	</xsl:call-template>
														        </xsl:element>
																</xsl:for-each>
															
														</xsl:if>
											        </xsl:element>
													</xsl:for-each>
												
											</xsl:if>
								        </xsl:element>
										</xsl:for-each>
									
								</xsl:if>
					        </xsl:element>
							</xsl:for-each>
						
					</xsl:if>
		        </xsl:element>
				</xsl:for-each>
			
		</xsl:if>
		            </xsl:element>
        </dsc>
	</xsl:template>
	<!--DSC SECTION providing a template that given the headings for the reference code and title and other header information and then calls templates for the other fields -->
	<xsl:template name="process-the-dsc">
		<!--<xsl:param name="level"/>-->
		<did>
		<xsl:apply-templates select="did/unitid"/>
		<xsl:apply-templates select="did/physloc"/>
		<xsl:apply-templates select="did/unittitle"/>
		<xsl:apply-templates select="did/unitdate"/>
		
		<physdesc encodinganalog="isadg(2)315" label="Extent and Medium of the Unit of Description">
				<xsl:apply-templates select="did/physdesc/extent"/>
				<xsl:apply-templates select="did/physdesc/genreform"/>
				<xsl:apply-templates select="did/physdesc/dimensions"/>
		</physdesc>	
		<xsl:apply-templates select="did/langmaterial"/>
		<xsl:apply-templates select="did/origination"/>
		</did>
		<!-- from here we have templates called for the body of the record -->
		<xsl:call-template name="bioghist-sub">		
		</xsl:call-template>
		<xsl:call-template name="scopecontent-sub">
		</xsl:call-template>
		<descgrp>
		<xsl:call-template name="arrangement-sub">
		</xsl:call-template>
		<xsl:call-template name="custodhist-sub">
		</xsl:call-template>
		<xsl:call-template name="acqinfo-sub">
		</xsl:call-template>
		<xsl:call-template name="appraisal-sub">
		</xsl:call-template>
		<xsl:call-template name="accruals-sub">
		</xsl:call-template>
		<xsl:call-template name="userestrict-sub">
		</xsl:call-template>
		<xsl:call-template name="accessrestrict-sub">
		</xsl:call-template>
		<xsl:call-template name="altformavail-sub">
		</xsl:call-template>
		<xsl:call-template name="originalsloc-sub">
		</xsl:call-template>
		<xsl:call-template name="note-sub">
		</xsl:call-template>
		<xsl:call-template name="otherfindaid-sub">
		</xsl:call-template>
		<xsl:call-template name="relatedmaterial-sub">
		</xsl:call-template>
		<xsl:call-template name="bibliography-sub">
		</xsl:call-template>
		<xsl:call-template name="processinfo-sub">
		</xsl:call-template>
		</descgrp>
		<xsl:call-template name="accesspoints-sub">
		</xsl:call-template>
	</xsl:template>
	<xsl:template name="bioghist-sub">
		<xsl:if test="bioghist//text()">
		<bioghist encodinganalog="isadg(2)322">
		<xsl:for-each select="bioghist/p">
				<xsl:apply-templates select="."/>
		</xsl:for-each>
		</bioghist>
		</xsl:if>
	</xsl:template>
	<!-- scopecontent with paras i hope -->
	<xsl:template name="scopecontent-sub">
		<xsl:if test="scopecontent//text()">
		<scopecontent encodinganalog="isadg(2)331">
			
		
		<xsl:for-each select="scopecontent/p">
			
				<xsl:apply-templates select="."/>
			
		</xsl:for-each>
		</scopecontent>
		</xsl:if>
	</xsl:template>

	<xsl:template name="arrangement-sub">
		<xsl:if test="descgrp/arrangement//text()">
		<arrangement encodinganalog="isadg(2)334">
		<xsl:for-each select="descgrp/arrangement/p">
			<xsl:apply-templates select="."/>
			
		</xsl:for-each>
		</arrangement>
		</xsl:if>
	</xsl:template>
	
	<xsl:template name="custodhist-sub">
		<xsl:if test="descgrp/custodhist//text()">
		<custodhist encodinganalog="isadg(2)323">
		<xsl:for-each select="descgrp/custodhist/p">
			
				<xsl:apply-templates select="."/>
			
		</xsl:for-each>
		</custodhist>
		</xsl:if>
	</xsl:template>
	<xsl:template name="acqinfo-sub">
		<xsl:if test="descgrp/acqinfo//text()">
		<acqinfo encodinganalog="isadg(2)324">
		<xsl:for-each select="descgrp/acqinfo/p">
			
				<xsl:apply-templates select="."/>
			
		</xsl:for-each>
		</acqinfo>
		</xsl:if>
	</xsl:template>
	<xsl:template name="appraisal-sub">
		<xsl:if test="descgrp/appraisal//text()">
		<appraisal encodinganalog="isadg(2)332">
		<xsl:for-each select="descgrp/appraisal/p">
			
				<xsl:apply-templates select="."/>
			
		</xsl:for-each>
		</appraisal>
		</xsl:if>
	</xsl:template>
	
	<xsl:template name="accruals-sub">
		<xsl:if test="descgrp/accruals//text()">
		<accruals encodinganalog="isadg(2)333">
		<xsl:for-each select="descgrp/accurals/p">
			
				<xsl:apply-templates select="."/>
			
		</xsl:for-each>
		</accruals>
		</xsl:if>
	</xsl:template>
	
	<xsl:template name="userestrict-sub">
		<xsl:if test="descgrp/userestrict//text()">
		<userestrict encodinganalog="isadg(2)342">
		<xsl:for-each select="descgrp/userestrict/p">
			<p>
				<xsl:apply-templates select="."/>
			</p>
		</xsl:for-each>
		</userestrict>
		</xsl:if>
	</xsl:template>
	
	<xsl:template name="accessrestrict-sub">
		<xsl:if test="descgrp/accessrestrict//text()">
		<accessrestrict encodinganalog="isadg(2)341">
		<xsl:for-each select="descgrp/accessrestrict/p">
				<xsl:apply-templates select="."/>
		</xsl:for-each>
		</accessrestrict>
		</xsl:if>
	</xsl:template>
	
		
	<xsl:template name="altformavail-sub">
		<xsl:if test="descgrp/altformavail//text()">
		<altformavail encodinganalog="isadg(2)352">
		<xsl:for-each select="descgrp/altformavail/p">
				<xsl:apply-templates select="."/>
		</xsl:for-each>
		</altformavail>
		</xsl:if>
	</xsl:template>
	
	<xsl:template name="originalsloc-sub">
		<xsl:if test="descgrp/originalsloc//text()">
		<originalsloc encodinganalog="isadg(2)351">
		<xsl:for-each select="descgrp/originalsloc/p">
				<xsl:apply-templates select="."/>
		</xsl:for-each>
		</originalsloc>
		</xsl:if>
	</xsl:template>
	
	<xsl:template name="note-sub">
		<xsl:if test="descgrp/note//text()">
		<note encodinganalog="isadg(2)361">
		<xsl:for-each select="descgrp/note/p">
				<xsl:apply-templates select="."/>
		</xsl:for-each>
		</note>
		</xsl:if>
	</xsl:template>
	
	<xsl:template name="phystech-sub">
		<xsl:if test="descgrp/phystech//text()">
		<phystech encodinganalog="isadg(2)344">
		<xsl:for-each select="descgrp/phystech/p">
				<xsl:apply-templates select="."/>
		</xsl:for-each>
		</phystech>
		</xsl:if>
	</xsl:template>
	
	<xsl:template name="otherfindaid-sub">
		<xsl:if test="descgrp/otherfindaid//text()">
		<otherfindingaid encodinganalog="isadg(2)345">
		<xsl:for-each select="descgrp/otherfindaid/p">			
			<xsl:apply-templates select="."/>
		</xsl:for-each>
		</otherfindingaid>
		</xsl:if>
	</xsl:template>
	
	<xsl:template name="relatedmaterial-sub">
		<xsl:if test="descgrp/relatedmaterial//text()">
		<relatedmaterial encodinganalog="isadg(2)353">
		<xsl:for-each select="descgrp/relatedmaterial/p">		
			<xsl:apply-templates select="."/>
		</xsl:for-each>
		</relatedmaterial>
		</xsl:if>
	</xsl:template> 	
	
	<xsl:template name="bibliography-sub">
		<xsl:if test="descgrp/bibliography//text()">
		<bibliography encodinganalog="isadg(2)354">
		<xsl:for-each select="descgrp/bibliography/p">
				<xsl:apply-templates select="."/>
		</xsl:for-each>
		</bibliography>
		</xsl:if>
	</xsl:template>
	
	<xsl:template name="processinfo-sub">
					<xsl:if test="descgrp/processinfo//text()">
					<processinfo>
			<xsl:for-each select="descgrp/processinfo/p">				
			<xsl:call-template name="all"/>
		</xsl:for-each>
		</processinfo>
			</xsl:if>
	</xsl:template>
	
	<!-- index terms (sub) go in here-->
	<xsl:template name="accesspoints-sub">
		<xsl:if test="controlaccess//text()">
		<controlaccess encodinganalog="NAHSTE38">
		
			<xsl:if test="controlaccess/controlaccess/subject//text()">
								<controlaccess encodinganalog="NAHSTE381">
						<xsl:for-each select="controlaccess/controlaccess/subject">
							<xsl:variable name="afid" select="@authfilenumber"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/authterm.php?table=cms_auth_subj&amp;authfilenumber='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$afid"/>
							</xsl:variable> 
							<xsl:copy-of select="document($input-file)" />							
						</xsl:for-each>							 
				</controlaccess>
		 </xsl:if>
		 
		 <xsl:if test="controlaccess/controlaccess/geogname//text()">
								<controlaccess encodinganalog="NAHSTE384">
						<xsl:for-each select="controlaccess/controlaccess/geogname">
							<xsl:variable name="afid" select="@authfilenumber"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/authterm.php?table=cms_auth_geog&amp;authfilenumber='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$afid"/>
							</xsl:variable> 
							<xsl:copy-of select="document($input-file)" />							
						</xsl:for-each>							 
				</controlaccess>
		 </xsl:if>
		 
		 <xsl:if test="controlaccess/controlaccess/genre//text()">
								<controlaccess encodinganalog="NAHSTE385">
						<xsl:for-each select="controlaccess/controlaccess/genre">
							<xsl:variable name="afid" select="@authfilenumber"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/authterm.php?table=cms_auth_genr&amp;authfilenumber='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$afid"/>
							</xsl:variable> 
							<xsl:copy-of select="document($input-file)" />							
						</xsl:for-each>							 
				</controlaccess>
		 </xsl:if>
		 
		 <xsl:if test="controlaccess/controlaccess/persname//text()">
								<controlaccess encodinganalog="NAHSTE382">
						<xsl:for-each select="controlaccess/controlaccess/persname">
							<xsl:variable name="afid" select="@authfilenumber"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/authterm.php?table=cms_auth_pers&amp;authfilenumber='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$afid"/>
							</xsl:variable> 
							<xsl:copy-of select="document($input-file)" />							
						</xsl:for-each>							 
				</controlaccess>
		 </xsl:if>
		 
		 <xsl:if test="controlaccess/controlaccess/corpname//text()">
								<controlaccess encodinganalog="NAHSTE383">
						<xsl:for-each select="controlaccess/controlaccess/corpname">
							<xsl:variable name="afid" select="@authfilenumber"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/authterm.php?table=cms_auth_corp&amp;authfilenumber='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$afid"/>
							</xsl:variable> 
							<xsl:copy-of select="document($input-file)" />							
						</xsl:for-each>							 
				</controlaccess>
		 </xsl:if>
		 
		 <xsl:if test="controlaccess/controlaccess/famname//text()">
								<controlaccess encodinganalog="NAHSTE386">
						<xsl:for-each select="controlaccess/controlaccess/famname">
							<xsl:variable name="afid" select="@authfilenumber"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/authterm.php?table=cms_auth_fam&amp;authfilenumber='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$afid"/>
							</xsl:variable> 
							<xsl:copy-of select="document($input-file)" />							
						</xsl:for-each>							 
				</controlaccess>
		 </xsl:if>
				
		</controlaccess>
		</xsl:if>
	</xsl:template>
	
	<!-- contents of frag1.xsl were here -->

	<!--NOTES in bioghist-->
<!-- 	<xsl:template match="/ead/archdesc/bioghist/note">
		<br/>
		<b>
			<xsl:text>Bibliographic Sources</xsl:text>
		</b>
		<br/>
		<xsl:apply-templates/>
		<br/>
	</xsl:template> -->
	
		<!--REFS-->
	<xsl:template match="ref[@target]">
		<xsl:element name="ref">
			<xsl:attribute name="target"><xsl:value-of select="./@target"/></xsl:attribute>
					<xsl:apply-templates/>
		</xsl:element>
	</xsl:template>
	
	<!--ARCHREFS-->
	<xsl:template match="archref[@href]">
		<xsl:element name="archref">
			<xsl:attribute name="href"><xsl:value-of select="./@href"/></xsl:attribute>
					<xsl:apply-templates/>
		</xsl:element>
	</xsl:template>
	
	<!--EXREFS-->
	<xsl:template match="extref[@href]">
		<xsl:element name="extref">
			<xsl:attribute name="href"><xsl:value-of select="./@href"/></xsl:attribute>
					<xsl:apply-templates/>
		</xsl:element>
	</xsl:template>
	
		<!--TITLES-->
	<xsl:template match="//title">
					<xsl:element name="title">
					<xsl:apply-templates/>
					</xsl:element>
	</xsl:template>
	
	<!-- IMAGES-->
	<xsl:template name="images">
		<xsl:element name="img">
			<xsl:attribute name="src"><xsl:value-of select="ead/eadheader/filedesc/titlestmt/subtitle/extptr/@href"/></xsl:attribute>
		</xsl:element>
	</xsl:template>

<!--EMBEDDED PERSNAMES-->
	<xsl:template match="//persname">
<xsl:variable name="afid" select="@authfilenumber"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/authterm.php?table=cms_auth_pers&amp;authfilenumber='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$afid"/>
							</xsl:variable> 
						<xsl:copy-of select="document($input-file)" />	
</xsl:template>	

<!--EMBEDDED CORPNAMES-->
	<xsl:template match="//corpname">
<xsl:variable name="afid" select="@authfilenumber"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/authterm.php?table=cms_auth_corp&amp;authfilenumber='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$afid"/>
							</xsl:variable> 
						<xsl:copy-of select="document($input-file)" />	
</xsl:template>	

<!--EMBEDDED FAMNAMES-->
	<xsl:template match="//famname">
<xsl:variable name="afid" select="@authfilenumber"/>
							<xsl:variable name="path" select="'http://www.archives.lib.ed.ac.uk/admin/authterm.php?table=cms_auth_fam&amp;authfilenumber='" />
							<xsl:variable name="input-file">
								<xsl:value-of select="$path"/>                    
								<xsl:value-of select="$afid"/>
							</xsl:variable> 
						<xsl:copy-of select="document($input-file)" />	
</xsl:template>	
			
	<!--LINE BREAKS-->
	<xsl:template match="//lb">
		<lb/>
		<xsl:apply-templates/>
	</xsl:template>
	
</xsl:stylesheet>