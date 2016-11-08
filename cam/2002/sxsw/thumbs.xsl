<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/TR/WD-xsl" language="VBScript">

<xsl:script xmlns:xsl="http://www.w3.org/TR/WD-xsl" language="VBScript"><![CDATA[

	
]]></xsl:script>


<xsl:template match="/">

<html>
<head>
	<title>onfocus.com : sxsw 2002</title>
	
<style> <![CDATA[          
	 <!--
	 textarea  {
	 	background-color: #666666;
	 	font-family: Trebuchet MS,Verdana,Arial;
	 	font-size: 11px;
		color: #ffffff;
		border-style: solid;
		border-color: #009900;
		border-width: 1px 1px 1px 1px {4};
	 }
	 
	 input  {
	 	background-color: #666666;
	 	font-family: Trebuchet MS,Verdana,Arial;
	 	font-size: 11px;
		color: #ffffff;
		border-style: solid;
		border-color: #009900;
		border-width: 1px 1px 1px 1px {4};
	 }
	 
	 .formText {
	 	font-family: Arial,Verdana,Trebuchet MS;
	 	font-size: 10px;
		color: green;
	 }
	 -->
]]></style>

<script language="JavaScript"><xsl:comment><![CDATA[

function popup(d,t,s,h,w) {

	window.open('http://www.onfocus.com/image.asp?d='+d+'&t='+t+'&s='+s+'&h='+h+'&w='+w,'photos','width=' + w + ',height=' + h + ',directories=no,location=no,toolbar=no,menubar=no,scrollbars=no,status=no,resizable=no,top=30,left=10,screeny=30,screenx=10')

}

]]></xsl:comment></script>

</head>

<body bgcolor="#000000" topmargin="0" leftmargin="0" text="#ffffff" alink="gray" link="green" vlink="#009900">
<basefont face="verdana,arial"/>
<table width="100%" height="100%" cellpadding="5" cellspacing="0" border="0">
	<tr>
		<td align="center" valign="center">
			<table width="300" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td align="left"><img src="sxswpics_logo.gif" width="203" height="43" alt="south by southwest"/></td>
				</tr>
				<tr>
					<td align="center" valign="center" bgcolor="#333333"><xsl:apply-templates select="all"/></td>
				</tr>
				<tr>
					<td align="right"><img src="sxswpics_2002.gif" width="101" height="37" alt="2002"/></td>
				</tr>
				<xsl:apply-templates select="picture/meta/comments"/>
				<xsl:if test="picture/@admin[. = 1]">
				<tr>
					<td align="right" bgcolor="#003300">
						<table>
							<form method="post" onSubmit="return checkForm(this);"><xsl:attribute name="action"><xsl:value-of select="/picture/@script"/></xsl:attribute>
								<!-- <tr><td align="right" valign="middle"><font size="1" class="formText">name</font></td><td><input name="txtName" type="text" size="25" maxlength="25"/></td></tr> -->
								<!-- <tr><td align="right" valign="middle"><font size="1" class="formText">url</font></td><td><input name="txtURL" type="text" size="25" maxlength="50"/></td></tr> -->
								<tr><td align="right" valign="top"><font size="1" class="formText">caption</font></td><td><textarea cols="26" rows="3" name="txaBody"><xsl:apply-templates select="picture/meta/caption"/></textarea></td></tr>
								<tr><td></td><td><input style="color:#ffffff;background-color:#009900;border-color:#000000" type="submit" value="submit"/></td></tr>
								<input type="hidden" name="hdnRedirect"><xsl:attribute name="value"><xsl:value-of select="/picture/@script"/>?p=<xsl:value-of select="/picture/@id"/>&amp;admin=1</xsl:attribute></input>
								<input type="hidden" name="hdnFile"><xsl:attribute name="value"><xsl:value-of select="/picture/file/name"/></xsl:attribute></input>
							</form>
						</table>
					</td>
				</tr>
				</xsl:if>
				<tr>
					<td align="right">
						<br/><br/>
						<img src="copyright.gif" alt="copyright 2002 pb" width="100" height="6"/> <font size="1">|</font> <a href="http://www.onfocus.com/"><img src="refocus.gif" border="0" alt="refocus" width="42" height="6"/></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

</body>
</html>

</xsl:template>

<xsl:template match="all" >
		<div style="padding:5px;border:solid #ffffff 5px;">
		<xsl:for-each select="picture"><a><xsl:attribute name="href">index.asp?p=<xsl:value-of select="@id"/></xsl:attribute><img>
			<xsl:attribute name="style">border:solid #666666 1px;</xsl:attribute>
			<xsl:attribute name="src">thumbs/<xsl:value-of select="file/name"/></xsl:attribute>
			<xsl:attribute name="width">50</xsl:attribute>
			<xsl:attribute name="alt"><xsl:value-of select="meta/caption"/></xsl:attribute>
			<xsl:attribute name="border">0</xsl:attribute></img></a>
		</xsl:for-each>
		</div>
</xsl:template>


<xsl:template match="picture/meta/caption">
		<xsl:value-of/>
</xsl:template>

<xsl:template match="picture/meta/comments">
<tr>
	<td colspan="2" bgcolor="#000000">
		<xsl:for-each select="comment" >
			<font face="trebuchet ms,verdana,arial" size="2"><b><xsl:value-of select="@author"/></b>: "<xsl:value-of/>"</font><p/>
		</xsl:for-each>
	</td>
</tr>
</xsl:template>

</xsl:stylesheet>
