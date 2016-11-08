<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/TR/WD-xsl" language="VBScript">

<xsl:script xmlns:xsl="http://www.w3.org/TR/WD-xsl" language="VBScript"><![CDATA[

	Function GetNextLink(node)
		Set x = node.SelectSingleNode("picture")
		totalpics = CInt(x.getAttribute("total"))
		thispic = CInt(x.getAttribute("id"))
		thisScript = x.getAttribute("script")
		admin = x.getAttribute("admin")
		If thispic < totalpics Then
			intNext = thisPic + 1
			GetNextLink = thisScript & "?p=" & intNext
		Else
			GetNextLink = thisScript & "?p=1"
		End If
		Set x = Nothing
	End Function

	Function GetNext(node,wrap)
		Set x = node.SelectSingleNode("picture")
		totalpics = CInt(x.getAttribute("total"))
		thispic = CInt(x.getAttribute("id"))
		thisScript = x.getAttribute("script")
		admin = x.getAttribute("admin")
		If thispic < totalpics Then
			intNext = thisPic + 1
			GetNext = "<a class=""nav"" href=""" & thisScript & "?p=" & intNext
			If admin = 1 Then
				GetNext = GetNext & "&admin=" & admin
			End If
			GetNext = GetNext & """>" & wrap & "</a>"
		Else
			GetNext = "<div style=""width:27px"">&nbsp;&nbsp</div>"
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
			GetBack = "<a class=""nav"" href=""" & thisScript & "?p=" & intBack 
			If admin = 1 Then
				GetBack = GetBack & "&admin=" & admin
			End If
			GetBack = GetBack & """>" & wrap & "</a>"
		Else
			GetBack = "<div style=""width:27px"">&nbsp;&nbsp</div>"
		End If
		Set x = Nothing
	End Function

]]></xsl:script>


<xsl:template match="/">
&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="geo.country" content="US" />
	<meta name="dc.language" content="en" />
<style type="text/css"> <![CDATA[          
	 <!--
	 BODY {
		background-color:#fff;
		text-align:center;
	}
	#container {
  		margin: 0 auto;
		text-align:left;
	}
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
	 	font-family:georgia, garamond, times, serif;
		color:#747A6B;
		font-size:20pt;
		font-weight:bold;
		margin-bottom:2px;
	 }
	 .number {
	 	font-family:garamond;
		color:#333;
		font-size:12pt;
		font-weight:bold;
		margin-bottom:2px;
	 }
	 .caption {
		text-align:center;
	 	font-family:arial;
		font-style:italic;
		color:#747A6B;
		font-size:10pt;
		padding:20px;
	 }
	 .count {
	 	color:#747A6B;
		font-size:8pt;
		font-family:arial;
	 }
	 .nav {
		font-family:tahoma, arial, sans-serif;
		font-weight:normal;
		font-size:smaller;
     }
	 #copynav {
		font-family:tahoma, arial, sans-serif;
		font-weight:normal;
		font-size:smaller;
		background-color:#D38252;
		padding:5px;
		width:250px;
		color:#ffffff;
		margin: 0 auto;
		margin-top:25px;
		border-right:solid #747A6B 2px;
		border-bottom:solid #747A6B 2px;
		text-align:center;
      }
	 -->
]]></style>

<script language="javascript" type="text/javascript"><xsl:comment><![CDATA[

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
	<title>onfocus.com | San Diego Zoo</title>
</head>

<body bgcolor="#FFFFFF" text="#999999" alink="#FFFFFF" link="#CCCCCC" vlink="#FFFFFF">
<div id="container"><xsl:attribute name="style">width:<xsl:value-of select="/picture/@width"/>px;</xsl:attribute>
			<table width="300" cellpadding="0" cellspacing="5" border="0">
				<tr>
					<td class="title">San Diego Zoo</td>
					<td align="right" valign="bottom" width="150" class="count"><xsl:value-of select="picture/@id"/> of <xsl:value-of select="picture/@total"/></td>
				</tr>
				<tr>
					<td  colspan="2" align="center">
					        <a><xsl:attribute name="href"><xsl:eval>GetNextLink(me)</xsl:eval></xsl:attribute>
						<xsl:apply-templates select="picture/file"/>
						</a>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td align="left" valign="top"><xsl:eval>GetBack(me,"&lt;img border=""0"" src=""leftarrow.gif"" alt="""" /&gt;")</xsl:eval></td>
								<td align="center"><div class="caption"><xsl:apply-templates select="picture/meta/caption"/></div></td>
								<td align="right" valign="top"><xsl:eval>GetNext(me,"&lt;img border=""0"" src=""rightarrow.gif"" alt="""" /&gt;")</xsl:eval></td>
							</tr>
						</table>
					</td>
				</tr>
				<xsl:apply-templates select="picture/meta/comments"/>
				<xsl:if test="picture/@admin[. = 1]">
				<tr>
					<td colspan="2" align="right">
						<table width="100%">
							<form method="post" onSubmit="return checkForm(this);"><xsl:attribute name="action"><xsl:value-of select="/picture/@script"/></xsl:attribute>
								<!-- <tr><td align="right" valign="middle"><font size="1" class="formText">name</font></td><td><input name="txtName" type="text" size="25" maxlength="25"/></td></tr> -->
								<!-- <tr><td align="right" valign="middle"><font size="1" class="formText">url</font></td><td><input name="txtURL" type="text" size="25" maxlength="50"/></td></tr> -->
								<tr><td align="right" valign="top"><font size="1" class="formText">caption</font></td><td><textarea cols="45" rows="5" name="txaBody"><xsl:apply-templates select="picture/meta/caption"/></textarea></td></tr>
								<tr><td></td><td><input style="color:#ffffff;background-color:#009900;border-color:#000000" type="submit" value="submit"/></td></tr>
								<input type="hidden" name="hdnRedirect"><xsl:attribute name="value"><xsl:value-of select="/picture/@script"/>?p=<xsl:value-of select="/picture/@id"/>&amp;admin=1</xsl:attribute></input>
								<input type="hidden" name="hdnFile"><xsl:attribute name="value"><xsl:value-of select="/picture/file/name"/></xsl:attribute></input>
							</form>
						</table>
					</td>
				</tr>
				</xsl:if>
			</table>
</div>
<div id="copynav">copyright 2004 <a href="https://pbcoding.com/onfocus/contact.asp">Paul Bausch</a>  +  <a href="http://www.onfocus.com">refocus</a></div>

</body>
</html>

</xsl:template>

<xsl:template match="picture/file">
		<img>
			<xsl:attribute name="src"><xsl:value-of select="name"/></xsl:attribute>
			<xsl:attribute name="height"><xsl:value-of select="/picture/@height"/></xsl:attribute>
			<xsl:attribute name="width"><xsl:value-of select="/picture/@width"/></xsl:attribute>
			<xsl:attribute name="alt"><xsl:value-of select="/picture/meta/caption"/></xsl:attribute>
			<xsl:attribute name="style">border:solid 2px #747A6B;background-color:#aaa;</xsl:attribute>
		</img>
</xsl:template>


<xsl:template match="picture/meta/caption">
		<xsl:value-of/>
</xsl:template>

<xsl:template match="picture/meta/comments">
<tr>
	<td colspan="2">
		<xsl:for-each select="comment">
			<font face="trebuchet ms,verdana,arial" size="2"><b><xsl:value-of select="@author"/></b>: "<xsl:value-of/>"</font><p/>
		</xsl:for-each>
	</td>
</tr>
</xsl:template>

</xsl:stylesheet>
