<xsl:stylesheet 
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
    xmlns:eac="urn:isbn:1-931666-33-4"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    xmlns:xtf="http://cdlib.org/xtf"
    xmlns:xs="http://www.w4.org/2001/XMLSchema" 
    xmlns:iso="iso:/3166"
    xmlns:CharUtils="java:org.cdlib.xtf.xslt.CharUtils"
    exclude-result-prefixes="#all" 
    version="2.0">
    
    
    <xsl:output omit-xml-declaration="no" method="html" indent="yes" encoding="utf-8"/>
 
    <xsl:template match="/">
        <table width="90%" border="0" cellspacing="0" cellpadding="5">
           <tr>
                <td colspan="2">
                    <xsl:apply-templates select="//eac:cpfDescription/eac:description/eac:biogHist/eac:p"/>
                    <xsl:if test="//eac:cpfDescription/eac:description/eac:biogHist/eac:chronList/text()">
                        <table class="chronList" cellpadding="5" width="95%">
                            <xsl:apply-templates select="//eac:cpfDescription/eac:description/eac:biogHist/eac:chronList"/> 
                        </table>
                    </xsl:if>
                    
                </td>
            </tr>
            <xsl:if test="//eac:control/eac:sources/text()">
                <tr>
                    <td class="label">Sources</td> 
                    <td>
                        <table class="sourceList" cellpadding="5">
                            <xsl:apply-templates select="//eac:control/eac:sources/eac:source"/> 
                        </table>
                    </td>
                </tr>
            </xsl:if>
        </table>
        
    </xsl:template>
    
    <xsl:template match="//eac:p">
        <p><xsl:apply-templates/></p> 
    </xsl:template>
    
    <xsl:template match="//eac:span">
        <span><xsl:apply-templates/></span> 
    </xsl:template>
    
    
    <xsl:template match="//eac:chronList/eac:chronItem">
           <tr>
               <xsl:choose>
               <xsl:when test="eac:dateRange//text()">               
                   <td class="chronDate"><xsl:value-of select="eac:dateRange/eac:fromDate"/>-<xsl:value-of select="eac:dateRange/eac:toDate"/></td>
               </xsl:when>
                   <xsl:otherwise>
           <td class="chronDate"><xsl:value-of select="eac:date"/></td>
                   </xsl:otherwise>
               </xsl:choose>
           <td class="chronPlace"><xsl:value-of select="eac:placeEntry"/></td>
           <td style="chronEvent"><xsl:value-of select="eac:event"/></td>
           </tr> 
    </xsl:template>
</xsl:stylesheet>