<TABLE border=0 cellpadding=3 cellspacing=0>
<TR><TD colspan=4 bgcolor=000000></TD>
</TR>
<TR>
	<TD colspan=4 bgcolor=ffffff>Tabelle <? echo $Li; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; [Stand: <?PHP echo $sp; ?>. Spieltag]</TD>
</TR>
<TR>
	<TD colspan=4 bgcolor=000000></TD>
</TR>
<?PHP
	for ($i=0;$i<10;$i++)
	{
		if($Mannschaft[$i]!="")
                {
			if ($i%2==0) { echo "<TR bgcolor=eeeeee>"; }
			if ($i%2==1) { echo "<TR bgcolor=fefefe>"; }
			echo "<td>";
	                if ($i+1==$pl) { echo "<B>";}
	                echo ($i+1).". </td><td width=150>";
	                if ($i+1==$pl) { echo "<B>";}
	                echo $Mannschaft[$i]."</td><td width=100 align=right>";
	                if ($i+1==$pl) { echo "<B>";}
	                echo $MP[$i].":".($MPm[$i])."</td><td width=100 align=center>";
	                if ($i+1==$pl) { echo "<B>";}
	                echo number_format($BP[$i],1)."</td></tr>";
                  }
	  }
?>
<TR><TD colspan=4 bgcolor=000000></TD></TR>
</TABLE>