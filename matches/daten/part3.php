<noscript><center><br><img src="noscriptfirstpos.jpg">
</center></noscript>
<script LANGUAGE="JavaScript1.1">
<!--
with(document)
{
	if(idnet==0)
	{
		write("<table BORDER=0>");
		write("<tr>");
		write("<td>");

		write("<table BORDER=0>");
		write("<tbody>");
		write("<tr>");
		write("<td>");
	}

	write("<table BORDER=0 CELLPADDING=0 CELLSPACING=0>");
	write("<tbody>");

	ds = "#F8E1B8";
	distart = "D0";
	dz = "";
	dsq = "";
	koord();

	for (i = 0; i < 8; i++)
	{
		document.write("<TR>");
		document.write("<td BGCOLOR=" + dc + " align=middle>&nbsp;" + fa + Math.abs(i - 8) + fe + "&nbsp;</td>");

		if (ds == "#F8E1B8")
		{
			dsq = "";
			ds = "#AE823E"
		}
		else
		{
			dsq = "";
			ds = "#F8E1B8";
		}

		for (j = 0; j < 8; j++)
		{
			if (ds == "#F8E1B8")
			{
				dsq = "";
				ds = "#AE823E";
			}
			else
			{
				dsq = "";
				ds = "#F8E1B8";
			}

			if (dsq != "") { dz = "<td BACKGROUND=" + dsq + " BGCOLOR=" + ds + " >" }
			else dz = "<td BGCOLOR=" + ds + ">";
			dz = dz + "<img border=0 ";

			if (distart != "") {dz = dz + "NAME=" + distart + " " };
			distart = "";
			dz = dz + "HEIGHT=32  WIDTH=32></TD>";
			document.write(dz);
		}

		document.write("<td BGCOLOR=" + dc + " align=middle>&nbsp;" + fa + Math.abs(i - 8) + fe + "&nbsp;</td>");
		document.write("</TR>");
	}

	koord();

	write("</tbody>");
	write("</table>");

	if(idnet==0)
	{
		write("</td>");
		write("</tr>");
		write("</tbody>");
		write("</table>");

		write("</td>");
		write("</tr>");
		write("<tr>");
	}

	if(idnet==0){write("<td VALIGN='TOP'>");
	write("<center>");}
	write("<form NAME='moves0'>");
	write("<input TYPE='button' TITLE='Zum ersten Zug' VALUE=' &lt;= ' ONCLICK='c(0, -3)' ONDBLCLICK='c(0, -3)'>");
	write("<input TYPE='button' TITLE='Zum vorherigen Zug' VALUE='&nbsp;&lt;&nbsp;'  ONKEYPRESS='c(0, -1)' ONCLICK='c(0, -1)' ONDBLCLICK='c(0, -1)'>");
	write("<input TYPE='button' TITLE='Zum nächsten Zug' VALUE='&nbsp;&gt;&nbsp;'  ONKEYPRESS='c(0, -2)' ONCLICK='c(0, -2)' ONDBLCLICK='c(0, -2)'>");
	write("<input TYPE='button' TITLE='Zum letzten Zug' VALUE=' =&gt; ' ONCLICK='c(0, -4)' ONDBLCLICK='c(0, -4)'>");

	write(" ");
	if((!document.all)||(op==1)){write("<BR>Letzter Zug: <input NAME='lastmove' VALUE='' size=12>")}

	if(idnet==0){write("</center>");}
}
//-->
</script>

<script LANGUAGE="JavaScript1.1">
<!--
document.write("</form>");
if(idnet==0){
	document.write("</td>");
	document.write("</tr>");
	document.write("</table>");
}
//-->
</script>
