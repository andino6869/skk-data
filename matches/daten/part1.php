<link rel=stylesheet type="text/css" href="game.css">

<script LANGUAGE="JavaScript1.1">
<!--
	window.status = "Loading pieces...";
	var bwk      = new Image();
	bwk.src  = "fwk32.gif";
	var bwd      = new Image();
	bwd.src  = "fwd32.gif";
	var bwt      = new Image();
	bwt.src  = "fwt32.gif";
	var bwl      = new Image();
	bwl.src  = "fwl32.gif";
	var bws      = new Image();
	bws.src  = "fws32.gif";
	var bwb      = new Image();
	bwb.src  = "fwb32.gif";
	var bsk      = new Image();
	bsk.src  = "fsk32.gif";
	var bsd      = new Image();
	bsd.src  = "fsd32.gif";
	var bst      = new Image();
	bst.src  = "fst32.gif";
	var bsl      = new Image();
	bsl.src  = "fsl32.gif";
	var bss      = new Image();
	bss.src  = "fss32.gif";
	var bsb      = new Image();
	bsb.src  = "fsb32.gif";
	var bleer    = new Image();
	bleer.src= "fleer.gif";
	idxkorr = new Array(0, 0);
	rotated = new Array(0, 0);
	dummy1=0;
	ldd=0;
	ptjv=310;
	fst=1;
	jumpdone=0;
	op=0;
	if ((navigator.appName == "Netscape") && (navigator.appVersion.substring(0,1) == "3"))
	{ idnet = 1;} else { idnet = 0 };
	var htmname = "game_game1.htm";

function initdia(){
if (dummy1 == 1) return;
window.status = "Init. diagrams...";
j=0;
with(document){
	for(i=0;i<images.length;i++){
		if((images[i].name!=null)&&(images[i].name.charAt(0)=="D")){
			idxkorr[j]=i;
			j++;}}}
dummy1 = 1;
window.status = "";}

var fa = "<span class='coordinates'>";
var fe = "</span>";
var dc = "#D5D5D5";
function koord() {
	var k = "abcdefgh";
	document.write("<tr><td BGCOLOR=" + dc + ">&nbsp;</td>");
	for (i = 0; i < 8; i++) {
		document.write("<td BGCOLOR=" + dc + " align=middle>&nbsp;" + fa + k.charAt(i) + fe + "&nbsp;</TD>"); }
	document.write("<td BGCOLOR=" + dc + ">&nbsp;</td></tr>"); }

	var x="x";
	var goback=-1;
	var goahead=-2;
	var idx=0;
	var bidx=0;
	var lastidx=new Array(0, 0);
	var lastcolor="#000000";
	var movebgcol="#F8E1B8";
	var movecol="#071E47";
	var bgcolor="#FFFFFF";
	var maxvar=0;
	var engl=0;
	var nbgames = 1;
	var diagram=self;
	var timer=null;
	var dummy2=0;
	var dummy3=0;
	if ((navigator.appName=="Netscape")&&(navigator.appVersion.substring(0,1) == "3"))
	{idnet1=1}else{idnet1=0};
