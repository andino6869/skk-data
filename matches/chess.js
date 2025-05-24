/* PGN to JS V.3.1 - Please do not change this line . */
if(document.images==null){
alert("Your browser doesn't support JavaScript 1.1");}
var nocmpl=0;
var idnet2=0;
if (navigator.appName=="Netscape"){
if(navigator.appVersion.substring(0,1) == "3")
idnet2=1;
if(navigator.appVersion.substring(0,1) == "5")
nocmpl=1;}

var lastboard=0;
var bstart=1;
var varStep=1;
var nmbr=0;
var nb=1;
var black=0;
var von; var nach;
rbr=new Array(
"#","#","#","#","#","#","#","#","#","#","#","#","#","#","#","#",
"#","#","#","#","#","#","#","#","#","#","#","#","#","#","#","#",
"#","#","#","#","#","#","#","#","#","#","#","#","#","#","#","#",
"#","#","#","#","#","#","#","#","#","#","#","#","#","#","#","#");

feld=new Array(
"a8","b8","c8","d8","e8","f8","g8","h8",
"a7","b7","c7","d7","e7","f7","g7","h7",
"a6","b6","c6","d6","e6","f6","g6","h6",
"a5","b5","c5","d5","e5","f5","g5","h5",
"a4","b4","c4","d4","e4","f4","g4","h4",
"a3","b3","c3","d3","e3","f3","g3","h3",
"a2","b2","c2","d2","e2","f2","g2","h2",
"a1","b1","c1","d1","e1","f1","g1","h1");

if(!window.wsave){
window.onresize=nsfreshup;
wsave=window.innerWidth;
hsave=window.innerHeight;}

function nsfreshup(){
if((nocmpl==0)&&(wsave!=window.innerWidth || hsave!=window.innerHeight))
history.go(0);}

function init(){
for(q=0;q<lastidx.length-1;q++){
window.status = "Loading game " + (q + 1) + " / " + nbgames;
c(q,lastidx[q])}
window.status = "";}

function setboard(afeld,figur,bbidx){
var bild;
if(figur=="K"){bild=diagram.bwk.src}
else if(figur=="Q"){bild=diagram.bwd.src}
else if(figur=="R"){bild=diagram.bwt.src}
else if(figur=="B"){bild=diagram.bwl.src}
else if(figur=="N"){bild=diagram.bws.src}
else if(figur=="P"){bild=diagram.bwb.src}
else if(figur=="k"){bild=diagram.bsk.src}
else if(figur=="q"){bild=diagram.bsd.src}
else if(figur=="r"){bild=diagram.bst.src}
else if(figur=="b"){bild=diagram.bsl.src}
else if(figur=="n"){bild=diagram.bss.src}
else if(figur=="p"){bild=diagram.bsb.src}
else if(figur=="U"){bild=diagram.bwu.src}
else if(figur=="V"){bild=diagram.bwv.src}
else if(figur=="W"){bild=diagram.bww.src}
else if(figur=="X"){bild=diagram.bwx.src}
else if(figur=="Y"){bild=diagram.bwy.src}
else if(figur=="Z"){bild=diagram.bwz.src}
else if(figur=="u"){bild=diagram.bsu.src}
else if(figur=="v"){bild=diagram.bsv.src}
else if(figur=="w"){bild=diagram.bsw.src}
else if(figur=="x"){bild=diagram.bsx.src}
else if(figur=="y"){bild=diagram.bsy.src}
else if(figur=="z"){bild=diagram.bsz.src}
else {bild=diagram.bleer.src}
anbr=afeld;
if (diagram.rotated!=null){
if (diagram.rotated[bbidx]==1){
anbr=Math.abs(anbr-63)}}
anbr=anbr+diagram.idxkorr[bbidx];
if(diagram.document.images[anbr]!=null)diagram.document.images[anbr].src=bild;}

function setboardex(afeld,bbidx){
afeld++;afeld--;
setboard(afeld,br[bbidx][afeld],bbidx);
if((nocmpl==1)||(diagram.document.images[afeld+diagram.idxkorr[bbidx]].complete))
rbr[afeld]=br[bbidx][afeld];}

function refreshboard(iboard,force){
var imgs=diagram.document.images;
for(i=0;i<br[iboard].length;i++){
if(((rbr[i]!=br[iboard][i])||(imgs[i+diagram.idxkorr[iboard]].src==""))||(force==1)||(bstart==1)){
setboard(i,br[iboard][i],iboard);}
if((nocmpl==1)||(imgs[i+diagram.idxkorr[iboard]].complete))
rbr[i]=br[iboard][i];}
bstart=0;}

function getnexthvar(svarinfo){
ik=0;
izug="";
while(ik<svarinfo.length){
if(svarinfo.charAt(ik)==" "){
ik++;
while(ik<svarinfo.length){
if(svarinfo.charAt(ik)==" "){
return izug}
else izug=izug+svarinfo.charAt(ik);
ik++}}
ik++}
return x}

function lres(abidx, aidx, lss){
if(diagram.lmess!=null){
lz=eval("diagram.document.comment"+abidx);
if(lz==null){return};
diagram.lnext[abidx]=0;
lz=eval("diagram.document.comment"+abidx+".scomment");
if(lz!=null){
if((aidx<lpnt.length)&&(lnr[abidx]!=0)){
mess="";
if((diagram.laf[abidx]!=-1)&&(diagram.lzf[abidx]!=-1)&&(lpnt[aidx]!=0)){
if((lss.substring(0,2)==diagram.laf[abidx])&&(lss.substring(2,4)==diagram.lzf[abidx])){
lges[abidx]=lges[abidx]+lpnt[aidx];
if(diagram.total!=null){
diagram.total=diagram.total+lpnt[aidx]};
mess=diagram.lmess[2]+" "}
else mess=diagram.lmess[3]+" ";
lpnt[aidx]=0;
lnr[abidx]--}
aidx++;
if(aidx<zg.length){
sm=zg[aidx];
if(sm.length>8){
if(vartxt(sm)){aidx++}
else{
i=getbackidx(sm);
if(i!=x){aidx=getnexthvar(zg[i])}}}}
if ((aidx!=0)&&(aidx<lpnt.length)&&(lpnt[aidx]!=0)&&(lnr[abidx]!=0)){
lz.value=diagram.lmess[0]+" ( "+lpnt[aidx]+" P )";
diagram.lnext[abidx]=1}
else lz.value=mess+diagram.lmess[1]+" "+lges[abidx]+' / '+ltot[abidx];
if (lnr[abidx]==0){
lz.value=diagram.lmess[1]+" "+lges[abidx]+' / '+ltot[abidx];
mess=Math.round(lges[abidx]*100/ltot[abidx]);
mess=diagram.lmess[4]+"  "+diagram.lmess[5]+" "+mess+" %";
alert(mess)}}
else lz.value=""}
diagram.laf[abidx]=-1;
diagram.lzf[abidx]=-1;
diagram.llast[abidx]="";}}

function getbackidx(fen){
e="";
l=fen.length;
while(l > 0){
l--;
cfen=fen.charAt(l);
if(cfen==" ")break;
e=cfen+e;}
return e;}

function vartxt(zeile){
if(zeile==null)return false;
zeichen=zeile.charAt(0);
if(((zeichen=="b")&&(zeile.indexOf("/")==-1))||(zeichen=="w")){return true}
else return false;}

function getzug(m1){
if (m1.length>8){m=m1.substring(m1.length-6,m1.length-2)}else{m=m1}
von=m.substring(0,2);
nach=m.substring(2,4);
if(von==nach)return "";
if(von.charAt(0)=="0") von=von.charAt(1);
if(nach.charAt(0)=="0") nach= nach.charAt(1);
m=br[bidx][von];
m=m.toUpperCase();
if(m=="P") m="";
if(engl==0){
if(m=="Q")m="D";
else if(m=="R") m = "T";
else if(m=="B") m = "L";
else if(m=="N") m = "S"}
else if((engl==2)&&(lang!=null)){
if(m=="K")m = lang[0];
else if(m=="Q") m = lang[1];
else if(m=="R") m = lang[2];
else if(m=="B") m = lang[3];
else if(m=="N") m = lang[4];
else if(m=="P") m = lang[5]}
if(br[bidx][nach]!="-"){n=x}
else n="-";
return m+feld[von]+n+feld[nach];}

function setvars(ii){
if(maxvar!=0){
s=zg[ii];
if(!vartxt(s)) return false;
zz="";
var ob=eval("diagram.document.moves"+bidx+".vars");
if(ob==null)return false;
j=-1;
for(i = 1;i<s.length;i++){
if(s.charAt(i)==" "){
if((j != -1)&&(j != 0)){
ob.options[j].text=nr+getzug(zg[zz]);
ob.options[j].value=zz;
if(j==maxvar) break;}
else{
if(j==-1){
nr=zz;
if(s.charAt(0)=="b"){
nr=nr-1;
nr=nr+"..."}
else nr=nr+".";}}
zz="";
j++;}
else zz=zz+s.charAt(i);}
ii++;
ob.options[0].text=nr+getzug(zg[ii]);
ob.options[0].value=ii;
ob.selectedIndex=0;
varStep=1;
return true;}
else return false;}

function stopautoplay(){
if(diagram.autofer!=null){diagram.autofer=1}}

function getHIdx(svartxt){
qq=svartxt.indexOf(" ");
if(qq!=-1){
qq++;
smaxnr="";
while(qq<svartxt.length){
cchar=svartxt.charAt(qq);
if(cchar==" ")break;
smaxnr=smaxnr+cchar;
qq++;}
smaxnr++;smaxnr--;
return smaxnr;}
return -1;}

function setvonnach(svn){
von=svn.substring(0,2);
nach=svn.substring(2,4);
if(von.charAt(0)=="0") von=von.charAt(1);
if(nach.charAt(0)=="0") nach=nach.charAt(1);}

function c(bindex,aindex){
if(diagram==null)return;
if((diagram.ptjv!=null)&&(diagram.dummy1==0)){history.go(0);return;}
dummy2=1;
doc(bindex,aindex);}

function handleKey(ik){
if(ik==37)c(0,-1)
else if(ik==39)c(0,-2)
else if(ik==38)c(0,-3)
else if(ik==40)c(0,-4)
else if(ik==35)c(0,-5)
else if(ik==36)c(0,-3)}

function doc(bindex,aindex){
var anfang=0;
var ende=0;
var gotovar=0;
var step=0;

bidx=bindex;
if(lastboard!=bidx){
lastboard=bidx;
bstart=1;}

if (varStep==1){
var theVars=eval("diagram.document.moves"+bidx+".vars");
if((maxvar!=0)&&(theVars!=null)){
if(theVars.selectedIndex>0)gotovar=theVars.options[theVars.selectedIndex].value;
for(i=0;i<maxvar;i++) {
theVars.options[i].text="";
theVars.options[i].value=0;}}}
varStep=0;
handlevar=0;
sback="";

if (aindex==-3) {
aindex=lastidx[bidx];
lidx=aindex;
while(aindex>0){
s=zg[aindex];
if(getbackidx(s)==x)break;
if((vartxt(s))&&(getHIdx(s)>lidx)){
aindex++;
handlevar=1;
break;}
aindex--;}}
if ((aindex==-4)||(aindex==-5)){
var nvar=aindex;
aindex=lastidx[bidx];
while(aindex<zg.length-1){
theidx=aindex;
theidx++;
s=zg[theidx];
if(getbackidx(s)==x)break;
if((s.length>8)&&(s.substring(s.length-1,s.length)!="z")&&(nvar==-4)){
theidx++;
if(vartxt(zg[theidx]))theidx++;
aindex=theidx;
break;}
aindex++;}}
if ((aindex==goback)||(handlevar==1)){
if(handlevar==0){
idx=lastidx[bidx];
s=zg[idx];
if(s.length>8){
i=getbackidx(s);
if(i==x)return;}
if((diagram.fst!=null)&&((s.length==4)||(s.length==7))){
step=2;sback=s;}}
else idx=aindex;
if(idx>0){
idx--;
s=zg[idx];
if(vartxt(s)){idx--;
s=zg[idx];}
if(s.length>8){
sback="";step=0;
i=getbackidx(s);
if(i=="z"){}
else if(i!=x){
s=zg[i];
if(vartxt(s)) i--;
idx=i;}}}}
else if(aindex==goahead){
idx=lastidx[bidx];
if(gotovar!=0){idx=gotovar;}
else{
if(idx<zg.length-1){
idx++;
s=zg[idx];
if(!vartxt(s)){
if(s.length>8){
i=getbackidx(s);
if(i=="z"){}
else if(i==x){
idx--;
stopautoplay()
return;}
else{
i=idx-2;
if(i>-1){
z="";
s=zg[i];
if(vartxt(s)){

j=-1;
for(i=1;i<s.length;i++){
if(s.charAt(i)==" "){
if(j!=-1){
if(z==0){
idx--;
return;}
else{
bo=setvars(z);
idx=z;
s=zg[idx];
if(vartxt(s))idx++;
break;}}
z="";
j++;}
else z=z+s.charAt(i);}}
else{
idx--;
stopautoplay();
return;}}

else idx++;}}else step=1;}
else{
setvars(idx);
idx++;}}
else{stopautoplay()}}}
else{idx=aindex};

if(idx>zg.length-1)return;
if(step==0){
s=zg[idx];

if((s.length<9)||(vartxt(s))){
ende=idx;
i=idx;
while((i > 0)&&((s.length<9)||(vartxt(s)))){
i--;
s=zg[i];}
anfang=i+1;}

j = 0;
nb="";
for(i=0;i<s.length;i++){
slash=0;
z=s.charAt(i);
if((z=="1")||(z=="2")||(z=="3")||(z=="4")||
(z=="5")||(z=="6")||(z=="7")||(z=="8")){
for(k=0;k<z;k++){
br[bidx][j]="-";
j++;}
j--;}
else if(z=="/"){slash=1}
else if(z==" "){
for(k=i+1;k<s.length;k++){
z=s.charAt(k);
if ((z==" ")||(z=="x")){break}
nb=nb+z}
break}
else {br[bidx][j]=z};
if(slash!=1){j++;}}
nmbr=0;}
else{
anfang=idx;
ende=idx;}

lm=""; black=-1;
if (ende>0){
for(i=anfang;i<=ende;i++){
s=zg[i];
if(!vartxt(s)){
if(sback!=""){
von=sback.substring(2,4);
nach=sback.substring(0,2);
ende=i;}
else{
von=s.substring(0,2);
nach=s.substring(2,4);}
if(von.charAt(0)=="0"){von=von.charAt(1)};
if(nach.charAt(0)=="0"){nach=nach.charAt(1)};
if (i==ende){
z=br[bidx][von];
if ((z=="k")||(z=="q")||(z=="r")||(z=="b")||(z=="n")||(z=="p")){black=1}
else{black=0};
if(sback=="") lm=getzug(s);}
nmbr=nmbr+1;
br[bidx][nach]=br[bidx][von];
if(step!=0)setboardex(nach,bidx);
if(von!=nach)
br[bidx][von]="-";
if(step!=0)setboardex(von,bidx);
if(sback!=""){
if(sback.length==7){
br[bidx][von]=sback.charAt(4);
setboardex(von,bidx);}
nmbr=nmbr-2;
black=Math.abs(black-1);
lm="";
setvonnach(s);
lm=feld[von]+"-"+feld[nach];
break;}
if(s.length==5){br[bidx][nach]=s.charAt(4);
if(step!=0)setboardex(nach,bidx);};
if(s.length==6){
epfeld=s.substring(4,6);
br[bidx][epfeld]="-";
if(step!=0)setboardex(epfeld,bidx);}
if(s.length==8){
von=s.substring(4,6);
if(von.charAt(0)=="0"){von=von.charAt(1)};
nach=s.substring(6,8);
if(nach.charAt(0)=="0"){nach=nach.charAt(1)};
br[bidx][nach]=br[bidx][von];
if(step!=0)setboardex(nach,bidx);
br[bidx][von]="-";
if(step!=0)setboardex(von,bidx);}}}}

if(step==0)refreshboard(bidx,idnet2);
lres(bidx, idx, s);

if(document.all){
var doc="document.all.";
var bgfarb=".style.background";
var farb=".style.color";
var el;
if(lastidx[bidx]!=-1){
el=eval(doc+"l"+lastidx[bidx]);
if(el!=null){
if(movecol!=""){el.style.color=lastcolor;}
if(self.bgcolor!=null)el.style.background=self.bgcolor
else el.style.background="";}}
el=eval(doc+"l"+idx);
if(el!=null){
lcolor=el.style.color;
if((lcolor!=null)&&(lcolor!="")){lastcolor=lcolor}else if(lastcolor==null){lastcolor=document.linkColor};
if(movecol!=""){el.style.color=movecol;}
if((self.bgcolor!=null)||(document.bgColor!=null))el.style.background=movebgcol;
if(diagram!=self){
var itop = el.offsetTop+10;
var o = el.offsetParent;
while((o!=null)&&(o.offsetTop!=null)){
itop=itop+o.offsetTop;
o=o.offsetParent;}
if((itop-document.body.scrollTop>document.body.clientHeight)||(itop<document.body.scrollTop)) {
if(navigator.userAgent.indexOf("Konqueror")==-1)window.scrollTo(0, itop - (document.body.clientHeight / 2));}}}}
if(s.substring(s.length-1,s.length)=="z"){
s=s.substring(s.length-6,s.length-2);
setvonnach(s);
if(von==nach)s="";
else s=feld[von]+"-"+feld[nach]}
else {s=""}
if(ende!=0){
var number=nmbr-1;
z=number%2;
if(((z==0)&&(black==1))||((z==1)&&(black==0))){number=number+1}
number=number>>1;
nb++;nb--;
number=number+nb;
if (black==1){number=number+"... "}
else{number=number+". "}
if(this.exhtml!=null)number="";
s=number+lm}
lz=eval("diagram.document.moves"+bidx+".lastmove");
if(lz!=null){lz.value=s}
lastidx[bidx]=idx;
if((parent!=null)&&(parent.engine!=null))startAna();}

function startAna(){
if(parent.engine.loaded==0)return;
var f=0;
var sfen="";
while(f<br[0].length){
sfen=sfen+br[0][f];
f++;}
if(black==-1)sfen=sfen+dummy3
else sfen=sfen+black;
parent.engine.document.MiniMax.repeatLoop(sfen,20);}
