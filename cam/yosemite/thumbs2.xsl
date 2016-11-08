<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/TR/WD-xsl" language="VBScript">

<xsl:script xmlns:xsl="http://www.w3.org/TR/WD-xsl" language="VBScript"><![CDATA[

]]></xsl:script>


<xsl:template match="/">

<script language="JavaScript"><xsl:comment><![CDATA[

function popup(d,t,s,h,w) {
	var d = escape(d);
	var t = escape(t);

	window.open('http://www.onfocus.com/image.asp?d='+d+'&t='+t+'&s='+s+'&h='+h+'&w='+w,'photos','width=' + w + ',height=' + h + ',directories=no,location=no,toolbar=no,menubar=no,scrollbars=no,status=no,resizable=no,top=30,left=10,screeny=30,screenx=10')

}

]]></xsl:comment></script>


			<table width="390" cellpadding="5" cellspacing="0" border="0" bgcolor="#333333">
				<xsl:apply-templates select="all"/>
			</table>

</xsl:template>

<xsl:template match="all" >
		<tr>
			<td align="left" valign="center" bgcolor="#333333">
		<xsl:for-each select="picture" order-by="+ date(file/name)">
		<a>
		<xsl:attribute name="href">JavaScript:popup('<xsl:value-of select="file/date"/>','<xsl:value-of select="meta/caption"/>','cam/<xsl:value-of select="file/name"/>',<xsl:value-of select="@height"/>,<xsl:value-of select="@width"/>)</xsl:attribute>
		<img>
			<xsl:attribute name="src">thumbs/<xsl:value-of select="file/name"/></xsl:attribute>
			<xsl:attribute name="width">50</xsl:attribute>
			<xsl:attribute name="alt"><xsl:value-of select="meta/caption"/></xsl:attribute>
			<xsl:attribute name="border">0</xsl:attribute>
		</img></a>
		</xsl:for-each>
			</td>
		</tr>
</xsl:template>

</xsl:stylesheet>
