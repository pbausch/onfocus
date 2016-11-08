<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN"/>
	<xsl:variable name="title" select="/rss/channel/title"/>
	<xsl:template match="/">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<title><xsl:value-of select="$title"/></title>
				<link rel="stylesheet" href="/feed.css" type="text/css"/>
			</head>
			<xsl:apply-templates select="rss/channel"/>
		</html>
	</xsl:template>
	<xsl:template match="channel">
		<body xmlns="http://www.w3.org/1999/xhtml">
			<h1>
				<a href="{link}">
					<xsl:apply-templates select="image"/>
					<xsl:value-of select="$title"/>

				</a>
			</h1>
			<div style="text-align:center;font-family:Verdana,Arial;font-size:10pt;margin-left:24px;padding:10px;background-color:#eee;color:red;border:solid #ccc 5px;">This is an RSS 0.91 formatted XML site feed. It is intended to be viewed in a Newsreader or syndicated to another site.</div>
			<div id="content">
				<xsl:apply-templates select="item"/>
			</div>
			<div style="clear:both"/>
			<div id="footer">
				<span id="footerspan"/>

			</div>
		</body>
	</xsl:template>
	<xsl:template match="item">
		<dl xmlns="http://www.w3.org/1999/xhtml">
			<dt>
				<a href="{link}">
					<xsl:value-of select="title"/>
				</a>

			</dt>
			<dd>
				<xsl:value-of select="substring(pubDate,5)"/>
			</dd>
			<dd>
				<xsl:call-template name="outputContent"/>
			</dd>
		</dl>
	</xsl:template>

	<xsl:template match="image">
		<xsl:element name="img" namespace="http://www.w3.org/1999/xhtml">
			<xsl:attribute name="src"><xsl:value-of select="url"/></xsl:attribute>
			<xsl:attribute name="alt">Link to <xsl:value-of select="title"/></xsl:attribute>
			<xsl:attribute name="align">absmiddle</xsl:attribute>
			<xsl:attribute name="border">0</xsl:attribute>
		</xsl:element>

		<xsl:text/>
	</xsl:template>

	<xsl:template name="outputContent">
		<xsl:choose>
			<xsl:when test="xhtml:body" xmlns:xhtml="http://www.w3.org/1999/xhtml">
				<xsl:copy-of select="xhtml:body/*"/>
			</xsl:when>
			<xsl:when test="xhtml:div" xmlns:xhtml="http://www.w3.org/1999/xhtml">
				<xsl:copy-of select="xhtml:div"/>
			</xsl:when>
			<xsl:when test="content:encoded" xmlns:content="http://purl.org/rss/1.0/modules/content/">

				<xsl:value-of select="content:encoded" disable-output-escaping="yes"/>
			</xsl:when>
			<xsl:when test="description">
				<xsl:value-of select="description" disable-output-escaping="yes"/>
			</xsl:when>
		</xsl:choose>
	</xsl:template>
</xsl:stylesheet>