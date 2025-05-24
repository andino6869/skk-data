<FORM ACTION="_admin_login_new_pwd_ok.php">
<table>
<tr>
	<td>Neues Passwort (max. L&auml;nge 12):</td>
	<td>
	  <INPUT TYPE=PASSWORD SIZE=12 maxlength=12 NAME=px>
	</td>
</tr>
<tr>
	<td>Passwort  best&auml;tigen (max. L&auml;nge 12):</td>
	<td>
	  <INPUT TYPE=PASSWORD SIZE=12 maxlength=12 NAME=px_valid>
	</td>
</tr>
<tr>
	<td></td>
	<td>
	  <INPUT TYPE=SUBMIT VALUE="Passwort speichern">
	</td>
</tr>
</table>
<?PHP
	$ulx = $_REQUEST["ulx"];
	$ufx = $_REQUEST["ufx"];
	echo "<INPUT TYPE='HIDDEN' NAME='ulx' Value='".$ulx."'>";
	echo "<INPUT TYPE='HIDDEN' NAME='ufx' Value='".$ufx."'>";

	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>";
?>
</FORM>