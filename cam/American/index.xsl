<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/TR/WD-xsl" language="VBScript">

<xsl:script xmlns:xsl="http://www.w3.org/TR/WD-xsl" language="VBScript"><![CDATA[

	Function GetNext(node,wrap)
		Set x = node.SelectSingleNode("picture")
		totalpics = CInt(x.getAttribute("total"))
		thispic = CInt(x.getAttribute("id"))
		thisScript = x.getAttribute("script")
		If thispic < totalpics Then
			intNext = thisPic + 1
			GetNext = "<a href=""" & thisScript & "?p=" & intNext & """>" & wrap & "</a>"
		Else
			GetNext = "&nbsp;"
		End If
		Set x = Nothing
	End Function
	
	Function GetBack(node,wrap)
		Set x = node.SelectSingleNode("picture")
		totalpics = CInt(x.getAttribute("total"))
		thispic = CInt(x.getAttribute("id"))
		thisScript = x.getAttribute("script")
		If thisPic > 1 Then
			intBack = thispic - 1
			GetBack = "<a href=""" & thisScript & "?p=" & intBack & """>" & wrap & "</a>"
		Else
			GetBack = "&nbsp;"
		End If
		Set x = Nothing
	End Function

]]></xsl:script>


<xsl:template match="/">

<html>
<head>
	<title>Rafting the American</title>
	
<style> <![CDATA[          
	 <!--
	 textarea  {
	 	background-color: #666666;
	 	font-family: Trebuchet MS,Verdana,Arial;
	 	font-size: 11px;
		color: #ffffff;
		border-style: solid;
		border-color: #000099;
		border-width: 1px 1px 1px 1px {4};
	 }
	 
	 input  {
	 	background-color: #666666;
	 	font-family: Trebuchet MS,Verdana,Arial;
	 	font-size: 11px;
		color: #ffffff;
		border-style: solid;
		border-color: #000099;
		border-width: 1px 1px 1px 1px {4};
	 }
	 
	 .formText {
	 	font-family: Arial,Verdana,Trebuchet MS;
	 	font-size: 10px;
		color: blue;
	 }
	 -->
]]></style>

<script language="JavaScript"><xsl:comment><![CDATA[

function checkForm(f) {
	if (f.txtName.value == '') {
		alert('Please enter a name.');	
		return false;
	}
	if (f.txaBody.value == '') {
		alert('Please enter a comment.');
		return false;
	}
	return true;
}

]]></xsl:comment></script>

</head>

<body bgcolor="#000000" topmargin="0" leftmargin="0" text="#ffffff" alink="gray" link="blue" vlink="#000099">
<basefont face="verdana,arial"/>
<table width="100%" height="100%" cellpadding="5" cellspacing="0" border="0">
	<tr>
		<td align="center" valign="center">
			<table width="300" cellpadding="5" cellspacing="0" border="0">
				<tr>
					<td width="156" colspan="2">
						<img src="rta.gif" width="226" height="11" alt="" border="0"/>
					</td>
				</tr>
				<tr>
					<td  colspan="2" align="center" valign="center" bgcolor="#333333">
						<xsl:apply-templates select="picture/file"/>
						<font face="arial" size="2"><xsl:apply-templates select="picture/meta/caption"/></font>
					</td>
				</tr>
				<tr>
					<td align="left">
						<font size="2"><xsl:eval>GetBack(me,"back")</xsl:eval></font>
					</td>
					<td align="right">
						<font size="2"><xsl:eval>GetNext(me,"next")</xsl:eval></font>
					</td>
				</tr>
				<tr>
					<td></td>
					<td align="right">
						<font face="arial" size="1">copyright2k by pb | <a href="http://www.onfocus.com">refocus</a></font>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

</body>
</html>

</xsl:template>

<xsl:template match="picture/file">
		<img>
			<xsl:attribute name="src"><xsl:value-of select="name"/></xsl:attribute>
			<xsl:attribute name="height"><xsl:value-of select="/picture/@height"/></xsl:attribute>
			<xsl:attribute name="width"><xsl:value-of select="/picture/@width"/></xsl:attribute>
		</img>
</xsl:template>


<xsl:template match="picture/meta/caption">
		<xsl:value-of/>
</xsl:template>

<xsl:template match="picture/meta/comments">
<tr>
	<td colspan="2" bgcolor="#000000">
		<xsl:for-each select="comment">
			<font face="trebuchet ms,verdana,arial" size="2"><b><xsl:value-of select="@author"/></b>: "<xsl:value-of/>"</font><p/>
		</xsl:for-each>
	</td>
</tr>
</xsl:template>

</xsl:stylesheet>
