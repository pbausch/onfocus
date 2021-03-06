<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/TR/WD-xsl" language="VBScript">

<xsl:script xmlns:xsl="http://www.w3.org/TR/WD-xsl" language="VBScript"><![CDATA[

	Function GetNext(node,wrap)
		Set x = node.SelectSingleNode("picture")
		totalpics = CInt(x.getAttribute("total"))
		thispic = CInt(x.getAttribute("id"))
		thisScript = x.getAttribute("script")
		admin = x.getAttribute("admin")
		If thispic < totalpics Then
			intNext = thisPic + 1
			GetNext = "<a href=""" & thisScript & "?p=" & intNext
			If admin = 1 Then
				GetNext = GetNext & "&admin=" & admin
			End If
			GetNext = GetNext & """>" & wrap & "</a>"
		Else
			GetNext = "<div style=""width:20px"">&nbsp;&nbsp</div>"
		End If
		Set x = Nothing
	End Function
	
	Function GetBack(node,wrap)
		Set x = node.SelectSingleNode("picture")
		totalpics = CInt(x.getAttribute("total"))
		thispic = CInt(x.getAttribute("id"))
		thisScript = x.getAttribute("script")
		admin = x.getAttribute("admin")
		If thisPic > 1 Then
			intBack = thispic - 1
			GetBack = "<a href=""" & thisScript & "?p=" & intBack 
			If admin = 1 Then
				GetBack = GetBack & "&admin=" & admin
			End If
			GetBack = GetBack & """>" & wrap & "</a>"
		Else
			GetBack = "<div style=""width:20px"">&nbsp;&nbsp</div>"
		End If
		Set x = Nothing
	End Function

]]></xsl:script>


<xsl:template match="/">

<html>
<head>
	<title>onfocus.com : the inside passage</title>
	
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
	 .title {
	 	font-family:garamond;
		color:#333333;
		font-size:20pt;
		font-weight:bold;
		margin-bottom:2px;
	 }
	 .number {
		font-family:lucida console,courier new,sans-serif;
		font-size:7pt;
		color:#00FF00;
		line-height:130%;
		text-transform:uppercase;
		margin-bottom:2px;
	 }
	 .caption {
		font-family:lucida console,courier new,sans-serif;
		font-size:9pt;
		color:#00FF00;
		line-height:130%;
		text-transform:uppercase;
		padding:10px;
	 }
	a:link {color:#00FF00;text-decoration:none;}
	a:visited {color:#00FF00;text-decoration:none;}
	a:active {color:#FFFF00;text-decoration:none;}
	a:hover {color:Yellow;text-decoration:underline;}
	 -->
]]></style>

<script language="JavaScript"><xsl:comment><![CDATA[

function checkForm(f) {
	//if (f.txtName.value == '') {
	//	alert('Please enter a name.');	
	//	return false;
	//}
	if (f.txaBody.value == '') {
		alert('Please enter a comment.');
		return false;
	}
	return true;
}

]]></xsl:comment></script>

</head>

<body bgcolor="#000000" topmargin="0" leftmargin="0" text="#cccccc" alink="gray" link="green" vlink="#009900">
<basefont face="verdana,arial"/>
<table width="100%" height="100%" cellpadding="5" cellspacing="0" border="0">
	<tr>
		<td align="center" valign="center">
			<table width="300" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td align="left"><img src="rgby.gif" width="79" height="30" alt="RGBY" border="0"/><xsl:if test="picture/meta/sound"></xsl:if></td>
					<td align="right" valign="bottom"><nobr><span class="number"><xsl:value-of select="picture/@id"/> of <xsl:value-of select="picture/@total"/></span></nobr></td>
				</tr>
				<tr>
					<td  colspan="2" align="center" valign="center" bgcolor="#0000"><xsl:apply-templates select="picture/file"/></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><table width="100%"><tr><td align="left" valign="top" class="number"><xsl:eval>GetBack(me,"back")</xsl:eval></td><td align="center"><div class="caption"><xsl:apply-templates select="picture/meta/caption"/></div></td><td align="right" valign="top" class="number"><xsl:eval>GetNext(me,"next")</xsl:eval></td></tr></table></td>
				</tr>
				<xsl:apply-templates select="picture/meta/comments"/>
				<xsl:if test="picture/@admin[. = 1]">
				<tr>
					<td colspan="2" align="right" bgcolor="#000000">
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
					<td colspan="2" align="right">
						<br/><br/>
						<img align="bottom" src="copyright.gif" alt="copyright 2002 pb" width="93" height="13"/> <span class="number" style="padding-bottom:5px;">&#164;</span> <a href="http://www.onfocus.com/"><img align="bottom" src="refocus.gif" border="0" alt="refocus" width="41" height="13"/></a>
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
			<xsl:attribute name="alt"><xsl:value-of select="/picture/meta/caption"/></xsl:attribute>
		</img></xsl:template>


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
