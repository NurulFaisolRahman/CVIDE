<?php
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=DataKomoditas_'.$NamaKecamatan.'_'.$NamaDesa.'.xls');
?>
MIME-Version: 1.0
X-Document-Type: Workbook
Content-Type: multipart/related; boundary="----=_NextPart_c61e64716fff4828b8056c03de67b114"

------=_NextPart_c61e64716fff4828b8056c03de67b114
Content-Location: file:///C:/ksoet/TemplateKomoditi.htm
Content-Transfer-Encoding: quoted-printable
Content-Type: text/html; charset="us-ascii"

<html xmlns:v=3D"urn:schemas-microsoft-com:vml" xmlns:o=3D"urn:schemas-microsoft-com:office:office" xmlns:x=3D"urn:schemas-microsoft-com:office:excel" xmlns:dt=3D"uuid:C2F41010-65B3-11d1-A29F-00AA00C14882" xmlns=3D"http://www.w3.org/TR/REC-html40">
 <head>
  <meta name=3D"Excel Workbook Frameset">
  <meta http-equiv=3D"Content-Type" content=3D"text/html; charset=3Dutf-8">
  <meta name=3D"ProgId" content=3D"Excel.Sheet">
  <meta name=3D"Generator" content=3D"WPS Office ET">
  <!--[if gte mso 9]>
   <xml>
    <o:DocumentProperties>
     <o:Author>WINDOWS 10</o:Author>
     <o:Created>2020-12-23T14:17:18</o:Created>
     <o:LastAuthor>WINDOWS 10</o:LastAuthor>
     <o:LastSaved>2020-12-23T14:43:22</o:LastSaved>
    </o:DocumentProperties>
    <o:CustomDocumentProperties>
     <o:KSOProductBuildVer dt:dt=3D"string">1033-11.2.0.9906</o:KSOProductBuildVer>
    </o:CustomDocumentProperties>
   </xml>
  <![endif]-->
  <link rel=3D"File-List" href=3D"TemplateKomoditi.files/filelist.xml">
  <link id=3D"shLink" href=3D"TemplateKomoditi.files/sheet001.htm">
  <link id=3D"shLink" href=3D"TemplateKomoditi.files/sheet002.htm">
  <link id=3D"shLink" href=3D"TemplateKomoditi.files/sheet003.htm">
  <script src=3D"TemplateKomoditi.files/js.js"></script>
  <script type=3D"text/javascript">window.g_iIEVer=3DfnGetIEVer();fnBuildFrameset(0);</script>
  <!--[if gte mso 9]>
   <xml>
    <x:ExcelWorkbook>
     <x:ExcelWorksheets>
      <x:ExcelWorksheet>
       <x:Name>Jumlah</x:Name>
       <x:WorksheetSource HRef=3D"TemplateKomoditi.files/sheet001.htm"/>
      </x:ExcelWorksheet>
      <x:ExcelWorksheet>
       <x:Name>Harga</x:Name>
       <x:WorksheetSource HRef=3D"TemplateKomoditi.files/sheet002.htm"/>
      </x:ExcelWorksheet>
      <x:ExcelWorksheet>
       <x:Name>Nilai</x:Name>
       <x:WorksheetSource HRef=3D"TemplateKomoditi.files/sheet003.htm"/>
      </x:ExcelWorksheet>
     </x:ExcelWorksheets>
     <x:Stylesheet HRef=3D"TemplateKomoditi.files/stylesheet.css"/>
     <x:ProtectStructure>False</x:ProtectStructure>
     <x:ProtectWindows>False</x:ProtectWindows>
     <x:WindowHeight>7815</x:WindowHeight>
     <x:WindowWidth>20490</x:WindowWidth>
    </x:ExcelWorkbook>
    <x:SupBook>
     <x:Path>D:\CVIDE\</x:Path>
    </x:SupBook>
   </xml>
  <![endif]-->
 </head>
 <frameset rows=3D"*,36" border=3D"0" width=3D"0" frameborder=3D"no">
  <frame src=3D"TemplateKomoditi.files/sheet001.htm" name=3D"frSheet" noresize/>
  <frame src=3D"TemplateKomoditi.files/tabstrip.htm" name=3D"frTabs" marginwidth=3D"0" marginheight=3D"0"/>
  <noframes>
   <body>
    <p>&#27492;&#39029;&#38754;&#20351;&#29992;&#20102;&#26694;&#26550;&#65292;&#32780;&#24744;&#30340;&#27983;&#35272;&#22120;&#19981;&#25903;&#25345;&#26694;&#26550;</p>
   </body>
  </noframes>
 </frameset>
</html>

------=_NextPart_c61e64716fff4828b8056c03de67b114
Content-Location: file:///C:/ksoet/TemplateKomoditi.files/js.js
Content-Transfer-Encoding: quoted-printable
Content-Type: text/html; charset="us-ascii"

var c_lTabs=3D3;
var c_rgszSh=3Dnew Array(c_lTabs);
c_rgszSh[0]=3D"Jumlah";
c_rgszSh[1]=3D"Harga";
c_rgszSh[2]=3D"Nilai";
var g_iShCur=3D0;
var g_rglTabX=3Dnew Array(c_lTabs+1);
var g_clrs=3Dnew Array(8);
g_clrs[0]=3D"window";
g_clrs[1]=3D"buttonface";
g_clrs[2]=3D"windowframe";
g_clrs[3]=3D"windowtext";
g_clrs[4]=3D"threedlightshadow";
g_clrs[5]=3D"threedhighlight";
g_clrs[6]=3D"threeddarkshadow";
g_clrs[7]=3D"threedshadow";

function fnGetIEVer() 
{
	var ua =3D window.navigator.userAgent;
	var msie =3D ua.indexOf("MSIE");
	if (msie > 0 && window.navigator.platform =3D=3D "Win32")
		return parseInt(ua.substring(msie+5, ua.indexOf(".",msie)));
	else
		return 0;
}
function fnMouseOverTab(event, iTab)
{
	if (iTab !=3D g_iShCur){
		if (parent.window.g_iIEVer>=3D4){
			frames['frTabs'].event.srcElement.style.background=3Dg_clrs[5];
		}
		else{
			event.target.style.background=3Dg_clrs[5];		}
	}
}
function fnMouseOutTab(event, iTab)
{
	if (iTab >=3D 0 && iTab !=3D g_iShCur){
		if (parent.window.g_iIEVer >=3D 4)
			frames['frTabs'].event.srcElement.style.background=3Dg_clrs[1];
		else
			target=3Devent.target.style.background=3Dg_clrs[1];
	}
}
function fnSetTabProps(iTab, fActive)
{
	if (iTab>=3D0){
		with (frames['frTabs'].document.all.aTab[iTab].style){
			background =3D fActive ? "#B0E0E6" : g_clrs[1];
			cursor =3D (fActive ? "default" : "pointer");
		}
	}
}
function fnSetActiveSheet(iSh)
{
	if (iSh !=3D g_iShCur){
		fnSetTabProps(g_iShCur, false);
		fnSetTabProps(iSh, true);
		g_iShCur =3D iSh;
	}
}
function fnInit()
{
	g_rglTabX[0] =3D 0;
	var row =3D frames['frTabs'].document.all.tbTabs.rows[0];
	for (var i =3D 1; i <=3D c_lTabs; ++i)
		g_rglTabX[i] =3D row.cells[i-1].offsetLeft + row.cells[i-1].offsetWidth;
	fnSetTabProps(g_iShCur, true);
}
function fnUpdateTabs(index)
{
	if (index < 0)
		return;
	if (document.readyState =3D=3D "complete")
		fnSetActiveSheet(index);
	else
		window.setTimeout("fnUpdateTabs("+index+");",150);
}
function fnBuildFrameset(index)
{
	var szHTML =3D "<frameset rows=3D\"*,18px\" border=3D0 width=3D0 frameborder=3Dno framespacing=3D0>" + "<frame src=3D\""+document.all.item("shLink")[index].href+"\" name=3D\"frSheet\" noresize>" + "<frameset cols=3D\"80px,*\" border=3D0 width=3D0 frameborder=3Dno framespacing=3D0>"+"<frame name=3D\"frScroll\" marginwidth=3D0 marginheight=3D0 scrolling=3Dno noresize>"+"<frame name=3D\"frTabs\" marginwidth=3D0 marginheight=3D0 scrolling=3Dno noresize>"+"</frameset></frameset>";
	with (document){
		open('text/html', 'replace');
		write(szHTML);
		close();
	}
	fnBuildTabStrip();
}
function fnNextTab(fDir)
{
	var iNextTab =3D -1;
	var i;
	with (frames['frTabs'].document.body){
		if (fDir =3D=3D 0){
			if (scrollLeft > 0){
				for (i =3D 0; i < c_lTabs && g_rglTabX[i] < scrollLeft; ++i);
				if ( i < c_lTabs)
					iNextTab =3D i - 1;
			}
		}
		else{
			if (g_rglTabX[c_lTabs] > offsetWidth + scrollLeft){
				for (i =3D 0; i < c_lTabs && g_rglTabX[i] <=3D scrollLeft; ++i);
				if (i < c_lTabs)
					iNextTab=3Di;
			}
		}
	}
	return iNextTab;
}
function fnScrollTabs(fDir)
{
	var iNextTab =3D fnNextTab(fDir);
	if (iNextTab >=3D 0){
		frames['frTabs'].scroll(g_rglTabX[iNextTab], 0);
		return true;
	}
	else
		return false;
}
function fnFastScrollTabs(fDir)
{
	if (c_lTabs > 16)
		frames['frTabs'].scroll(g_rglTabX[fDir ? c_lTabs-1 : 0], 0);
	else if (fnScrollTabs(fDir) > 0)
		window.setTimeout("fnFastScrollTabs("+fDir+");", 5);
}
function fnMouseOverScroll(iCtl)
{
	frames['frScroll'].document.all.tdScroll[iCtl].style.color =3D g_clrs[7];
}
function fnMouseOutScroll(iCtl)
{
	frames['frScroll'].document.all.tdScroll[iCtl].style.color =3D g_clrs[6];
}
function fnBuildTabStrip()
{
	var szHTML =3D "<html><head><style>.clScroll{font:8pt Courier New;cursor:default;line-height:10pt;}"+".clScroll2{font:10pt Arial;cursor:default;line-height:11pt;}</style></head>"+"<body topmargin=3D0 leftmargin=3D0><table border=3D1 cellpadding=3D0 cellspacing=3D0 width=3D100%>"+"<tr>"+"<td valign=3Dtop id=3DtdScroll class=3D\"clScroll\" onclick=3D\"parent.fnFastScrollTabs(0);\" ondblclick=3D\"parent.fnFastScrollTabs(0);\" onmouseover=3D\"parent.fnMouseOverScroll(0);\" onmouseout=3D\"parent.fnMouseOutScroll(0);\">&nbsp;&#171;&nbsp;</td>"+"<td valign=3Dtop id=3DtdScroll class=3D\"clScroll2\" onclick=3D\"parent.fnScrollTabs(0);\" ondblclick=3D\"parent.fnScrollTabs(0);\" onmouseover=3D\"parent.fnMouseOverScroll(1);\" onmouseout=3D\"parent.fnMouseOutScroll(1);\">&nbsp;&lt;&nbsp;</td>"+"<td valign=3Dtop id=3DtdScroll class=3D\"clScroll2\" onclick=3D\"parent.fnScrollTabs(1);\" ondblclick=3D\"parent.fnScrollTabs(1);\" onmouseover=3D\"parent.fnMouseOverScroll(2);\" onmouseout=3D\"parent.fnMouseOutScroll(2);\">&nbsp;&gt;&nbsp;</td>"+"<td valign=3Dtop id=3DtdScroll class=3D\"clScroll\" onclick=3D\"parent.fnFastScrollTabs(1);\" ondblclick=3D\"parent.fnFastScrollTabs(1);\" onmouseover=3D\"parent.fnMouseOverScroll(3);\" onmouseout=3D\"parent.fnMouseOutScroll(3);\">&nbsp;&#187;&nbsp;</td>"+"</tr></table></body></html>";
	with (frames['frScroll'].document){
		open("text/html","replace");
		write(szHTML);
		close();
	}
	szHTML =3D "<html><head>"+"<style>A:link,A:visited,A:active{text-decoration:none;"+"color:#000000;}"+".clTab{cursor:hand;background:"+g_clrs[1]+";font:9pt \"&#23435;&#20307;\";padding-left:3px;padding-right:3px;text-align:center;}"+"</style></head><body onload=3D\"parent.fnInit();\" topmargin=3D0 leftmargin=3D0><table id=3DtbTabs border=3D1 cellpadding=3D0 cellspacing=3D0><tr>"; 
	for (i =3D 0; i < c_lTabs; ++i){
		szHTML+=3D"<td id=3DtdTab height=3D1 nowrap class=3D\"clTab\" "+"onmouseover=3D\"parent.fnMouseOverTab(event," + i + ");\" onmouseout=3D\"parent.fnMouseOutTab(event,"+i+");\">"+"<a href=3D\""+document.all.item("shLink")[i].href+"\" target=3D\"frSheet\" id=3DaTab>&nbsp;"+c_rgszSh[i]+"&nbsp;</a></td>"; 
	}
	szHTML +=3D "</tr></table></body></html>";
	with (frames['frTabs'].document){
		open('text/html','replace');
		write(szHTML);
		close();
	}
}

------=_NextPart_c61e64716fff4828b8056c03de67b114
Content-Location: file:///C:/ksoet/TemplateKomoditi.files/tabstrip.htm
Content-Transfer-Encoding: quoted-printable
Content-Type: text/html; charset="us-ascii"

<html>
 <head>
  <meta http-equiv=3D"Content-Type" content=3D"text/html; charset=3DUTF-8">
  <meta name=3D"ProgId" content=3D"Excel.Sheet">
  <meta name=3D"Generator" content=3D"WPS Office ET">
  <link id=3D"Main-File" rel=3D"Main-File" href=3D"../TemplateKomoditi.mht">
  <style>A:link,A:visited,A:active{text-decoration:none;color:#000000;font-size:9pt;}		 table{cursor:hand;background:buttonface;font:9pt &#23435;&#20307;;text-align:center;}		 td{white-space:nowrap}</style>
  <script language=3D"JavaScript">if(window.name!=3D'frTabs')
 	window.location.replace(document.getElementById('Main-File').href);</script>
 </head>
 <body style=3D'margin:"0";'>
  <table border=3D"1" cellspacing=3D"0">
   <tr>
    <td><a href=3D"sheet001.htm" target=3D"frSheet">&nbsp;Jumlah&nbsp;</a></td>
    <td><a href=3D"sheet002.htm" target=3D"frSheet">&nbsp;Harga&nbsp;</a></td>
    <td><a href=3D"sheet003.htm" target=3D"frSheet">&nbsp;Nilai&nbsp;</a></td>
   </tr>
  </table>
 </body>
</html>

------=_NextPart_c61e64716fff4828b8056c03de67b114
Content-Location: file:///C:/ksoet/TemplateKomoditi.files/sheet001.htm
Content-Transfer-Encoding: quoted-printable
Content-Type: text/html; charset="us-ascii"

<html xmlns:v=3D"urn:schemas-microsoft-com:vml" xmlns:o=3D"urn:schemas-microsoft-com:office:office" xmlns:x=3D"urn:schemas-microsoft-com:office:excel" xmlns=3D"http://www.w3.org/TR/REC-html40">
 <head>
  <meta http-equiv=3D"Content-Type" content=3D"text/html; charset=3DUTF-8">
  <meta name=3D"ProgId" content=3D"Excel.Sheet">
  <meta name=3D"Generator" content=3D"WPS Office ET">
  <link id=3D"Main-File" rel=3D"Main-File" href=3D"../TemplateKomoditi.mht">
  <link rel=3D"File-List" href=3D"filelist.xml">
  <link rel=3D"Stylesheet" href=3D"stylesheet.css">
  <style>
<!-- @page
	{margin:1,00in 0,75in 1,00in 0,75in;
	mso-header-margin:0,50in;
	mso-footer-margin:0,50in;}
 -->  </style>
  <!--[if gte mso 9]>
   <xml>
    <x:WorksheetOptions>
     <x:DefaultRowHeight>300</x:DefaultRowHeight>
     <x:StandardWidth>2340</x:StandardWidth>
     <x:Selected/>
     <x:Panes>
      <x:Pane>
       <x:Number>3</x:Number>
       <x:ActiveCol>0</x:ActiveCol>
       <x:ActiveRow>0</x:ActiveRow>
      </x:Pane>
     </x:Panes>
     <x:ProtectContents>False</x:ProtectContents>
     <x:ProtectObjects>False</x:ProtectObjects>
     <x:ProtectScenarios>False</x:ProtectScenarios>
     <x:PageBreakZoom>100</x:PageBreakZoom>
     <x:Print>
      <x:PaperSizeIndex>9</x:PaperSizeIndex>
     </x:Print>
    </x:WorksheetOptions>
   </xml>
  <![endif]-->
  <script language=3D"JavaScript">
	if (window.name!=3D"frSheet")
		window.location.replace("../TemplateKomoditi.mht");
	else
		parent.fnUpdateTabs(0);
</script>
 </head>
 <body link=3D"blue" vlink=3D"purple">
  <table width=3D"64" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" style=3D'width:48.00pt;border-collapse:collapse;table-layout:fixed;'>
   <col width=3D"64" style=3D'width:48,00pt;'/>
   <tr height=3D"20" style=3D'height:15.00pt;'>
    <td class=3D"xl65" height=3D"20" width=3D"64" style=3D'height:15.00pt;width:48.00pt;' x:str>Id</td>
    <?php for ($i=1; $i <= 154; $i++) { ?>
      <td class=3D"xl65" height=3D"20" width=3D"64" style=3D'height:15.00pt;width:48.00pt;' x:str><?=$i?></td>
    <?php } ?>
   </tr>
   <?php for ($j=0; $j < count($IPM); $j++) { ?>
   <tr height=3D"20" style=3D'height:15.00pt;'>
    <td class=3D"xl65" height=3D"20" width=3D"64" style=3D'height:15.00pt;width:48.00pt;' x:str><?=$IPM[$j]['Id']?></td>
    <?php $Jumlah = explode("|",$IPM[0]['Banyaknya']); for ($i=0; $i < 154; $i++) { ?>
      <td class=3D"xl65" height=3D"20" width=3D"64" style=3D'height:15.00pt;width:48.00pt;' x:str><?=$Jumlah[$i] != '' ? $Jumlah[$i] : 0; ?></td>
    <?php } ?>
   </tr>
   <?php } ?>
   <![if supportMisalignedColumns]>
    <tr width=3D"0" style=3D'display:none;'/>
   <![endif]>
  </table>
 </body>
</html>

------=_NextPart_c61e64716fff4828b8056c03de67b114
Content-Location: file:///C:/ksoet/TemplateKomoditi.files/sheet002.htm
Content-Transfer-Encoding: quoted-printable
Content-Type: text/html; charset="us-ascii"

<html xmlns:v=3D"urn:schemas-microsoft-com:vml" xmlns:o=3D"urn:schemas-microsoft-com:office:office" xmlns:x=3D"urn:schemas-microsoft-com:office:excel" xmlns=3D"http://www.w3.org/TR/REC-html40">
 <head>
  <meta http-equiv=3D"Content-Type" content=3D"text/html; charset=3DUTF-8">
  <meta name=3D"ProgId" content=3D"Excel.Sheet">
  <meta name=3D"Generator" content=3D"WPS Office ET">
  <link id=3D"Main-File" rel=3D"Main-File" href=3D"../TemplateKomoditi.mht">
  <link rel=3D"File-List" href=3D"filelist.xml">
  <link rel=3D"Stylesheet" href=3D"stylesheet.css">
  <style>
<!-- @page
	{margin:1,00in 0,75in 1,00in 0,75in;
	mso-header-margin:0,50in;
	mso-footer-margin:0,50in;}
 -->  </style>
  <!--[if gte mso 9]>
   <xml>
    <x:WorksheetOptions>
     <x:DefaultRowHeight>300</x:DefaultRowHeight>
     <x:StandardWidth>2340</x:StandardWidth>
     <x:Panes>
      <x:Pane>
       <x:Number>3</x:Number>
       <x:ActiveCol>0</x:ActiveCol>
       <x:ActiveRow>0</x:ActiveRow>
      </x:Pane>
     </x:Panes>
     <x:ProtectContents>False</x:ProtectContents>
     <x:ProtectObjects>False</x:ProtectObjects>
     <x:ProtectScenarios>False</x:ProtectScenarios>
     <x:PageBreakZoom>100</x:PageBreakZoom>
     <x:Print>
      <x:PaperSizeIndex>9</x:PaperSizeIndex>
     </x:Print>
    </x:WorksheetOptions>
   </xml>
  <![endif]-->
  <script language=3D"JavaScript">
	if (window.name!=3D"frSheet")
		window.location.replace("../TemplateKomoditi.mht");
	else
		parent.fnUpdateTabs(1);
</script>
 </head>
 <body link=3D"blue" vlink=3D"purple">
  <table width=3D"64" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" style=3D'width:48.00pt;border-collapse:collapse;table-layout:fixed;'>
   <col width=3D"64" style=3D'width:48,00pt;'/>
   <tr height=3D"20" style=3D'height:15.00pt;'>
    <td class=3D"xl65" height=3D"20" width=3D"64" style=3D'height:15.00pt;width:48.00pt;' x:str>Id</td>
    <?php for ($i=1; $i <= 154; $i++) { ?>
      <td class=3D"xl65" height=3D"20" width=3D"64" style=3D'height:15.00pt;width:48.00pt;' x:str><?=$i?></td>
    <?php } ?>
   </tr>
   <?php for ($j=0; $j < count($IPM); $j++) { ?>
   <tr height=3D"20" style=3D'height:15.00pt;'>
    <td class=3D"xl65" height=3D"20" width=3D"64" style=3D'height:15.00pt;width:48.00pt;' x:str><?=$IPM[$j]['Id']?></td>
    <?php $Jumlah = explode("|",$IPM[0]['Harga']); for ($i=0; $i < 154; $i++) { ?>
      <td class=3D"xl65" height=3D"20" width=3D"64" style=3D'height:15.00pt;width:48.00pt;' x:str><?=$Jumlah[$i] != '' ? $Jumlah[$i] : 0; ?></td>
    <?php } ?>
   </tr>
   <?php } ?>
   <![if supportMisalignedColumns]>
    <tr width=3D"0" style=3D'display:none;'/>
   <![endif]>
  </table>
 </body>
</html>

------=_NextPart_c61e64716fff4828b8056c03de67b114
Content-Location: file:///C:/ksoet/TemplateKomoditi.files/sheet003.htm
Content-Transfer-Encoding: quoted-printable
Content-Type: text/html; charset="us-ascii"

<html xmlns:v=3D"urn:schemas-microsoft-com:vml" xmlns:o=3D"urn:schemas-microsoft-com:office:office" xmlns:x=3D"urn:schemas-microsoft-com:office:excel" xmlns=3D"http://www.w3.org/TR/REC-html40">
 <head>
  <meta http-equiv=3D"Content-Type" content=3D"text/html; charset=3DUTF-8">
  <meta name=3D"ProgId" content=3D"Excel.Sheet">
  <meta name=3D"Generator" content=3D"WPS Office ET">
  <link id=3D"Main-File" rel=3D"Main-File" href=3D"../TemplateKomoditi.mht">
  <link rel=3D"File-List" href=3D"filelist.xml">
  <link rel=3D"Stylesheet" href=3D"stylesheet.css">
  <style>
<!-- @page
	{margin:1,00in 0,75in 1,00in 0,75in;
	mso-header-margin:0,50in;
	mso-footer-margin:0,50in;}
 -->  </style>
  <!--[if gte mso 9]>
   <xml>
    <x:WorksheetOptions>
     <x:DefaultRowHeight>300</x:DefaultRowHeight>
     <x:StandardWidth>2340</x:StandardWidth>
     <x:Panes>
      <x:Pane>
       <x:Number>3</x:Number>
       <x:ActiveCol>0</x:ActiveCol>
       <x:ActiveRow>0</x:ActiveRow>
      </x:Pane>
     </x:Panes>
     <x:ProtectContents>False</x:ProtectContents>
     <x:ProtectObjects>False</x:ProtectObjects>
     <x:ProtectScenarios>False</x:ProtectScenarios>
     <x:PageBreakZoom>100</x:PageBreakZoom>
     <x:Print>
      <x:PaperSizeIndex>9</x:PaperSizeIndex>
     </x:Print>
    </x:WorksheetOptions>
   </xml>
  <![endif]-->
  <script language=3D"JavaScript">
	if (window.name!=3D"frSheet")
		window.location.replace("../TemplateKomoditi.mht");
	else
		parent.fnUpdateTabs(2);
</script>
 </head>
 <body link=3D"blue" vlink=3D"purple">
  <table width=3D"64" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" style=3D'width:48.00pt;border-collapse:collapse;table-layout:fixed;'>
   <col width=3D"64" style=3D'width:48,00pt;'/>
   <tr height=3D"20" style=3D'height:15.00pt;'>
    <td class=3D"xl65" height=3D"20" width=3D"64" style=3D'height:15.00pt;width:48.00pt;' x:str>Id</td>
    <?php for ($i=1; $i <= 154; $i++) { ?>
      <td class=3D"xl65" height=3D"20" width=3D"64" style=3D'height:15.00pt;width:48.00pt;' x:str><?=$i?></td>
    <?php } ?>
   </tr>
   <?php for ($j=0; $j < count($IPM); $j++) { ?>
   <tr height=3D"20" style=3D'height:15.00pt;'>
    <td class=3D"xl65" height=3D"20" width=3D"64" style=3D'height:15.00pt;width:48.00pt;' x:str><?=$IPM[$j]['Id']?></td>
    <?php $Jumlah = explode("|",$IPM[0]['Nilai']); for ($i=0; $i < 154; $i++) { ?>
      <td class=3D"xl65" height=3D"20" width=3D"64" style=3D'height:15.00pt;width:48.00pt;' x:str><?=$Jumlah[$i] != '' ? $Jumlah[$i] : 0; ?></td>
    <?php } ?>
   </tr>
   <?php } ?>
   <![if supportMisalignedColumns]>
    <tr width=3D"0" style=3D'display:none;'/>
   <![endif]>
  </table>
 </body>
</html>

------=_NextPart_c61e64716fff4828b8056c03de67b114
Content-Location: file:///C:/ksoet/TemplateKomoditi.files/stylesheet.css
Content-Transfer-Encoding: quoted-printable
Content-Type: text/html; charset="us-ascii"

tr
	{mso-height-source:auto;
	mso-ruby-visibility:none;}
col
	{mso-width-source:auto;
	mso-ruby-visibility:none;}
br
	{mso-data-placement:same-cell;}
.style0
	{mso-number-format:"General";
	text-align:general;
	vertical-align:middle;
	white-space:nowrap;
	mso-rotate:0;
	mso-pattern:auto;
	mso-background-source:auto;
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:134;
	border:none;
	mso-protection:locked visible;
	mso-style-name:"Normal";
	mso-style-id:0;}
.style16
	{mso-pattern:auto none;
	background:#BDD7EE;
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"40% - Accent1";}
.style17
	{mso-number-format:"_\(* \#\,\#\#0\.00_\)\;_\(* \\\(\#\,\#\#0\.00\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	mso-style-name:"Comma";
	mso-style-id:3;}
.style18
	{mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022_\)\;_\(\@_\)";
	mso-style-name:"Comma [0]";
	mso-style-id:6;}
.style19
	{mso-number-format:"_-\0022Rp\0022* \#\,\#\#0_-\;\\-\0022Rp\0022* \#\,\#\#0_-\;_-\0022Rp\0022* \0022-\0022??_-\;_-\@_-";
	mso-style-name:"Currency [0]";
	mso-style-id:7;}
.style20
	{mso-number-format:"_-\0022Rp\0022* \#\,\#\#0\.00_-\;\\-\0022Rp\0022* \#\,\#\#0\.00_-\;_-\0022Rp\0022* \0022-\0022??_-\;_-\@_-";
	mso-style-name:"Currency";
	mso-style-id:4;}
.style21
	{mso-number-format:"0%";
	mso-style-name:"Percent";
	mso-style-id:5;}
.style22
	{color:#0000FF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:underline;
	text-underline-style:single;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"Hyperlink";
	mso-style-id:8;}
.style23
	{mso-pattern:auto none;
	background:#FFD966;
	color:#FFFFFF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"60% - Accent4";}
.style24
	{color:#800080;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:underline;
	text-underline-style:single;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"Followed Hyperlink";
	mso-style-id:9;}
.style25
	{mso-pattern:auto none;
	background:#A5A5A5;
	color:#FFFFFF;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	border:2.0pt double #3F3F3F;
	mso-style-name:"Check Cell";}
.style26
	{color:#44546A;
	font-size:13.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:134;
	border-bottom:1.0pt solid #5B9BD5;
	mso-style-name:"Heading 2";}
.style27
	{mso-pattern:auto none;
	background:#FFFFCC;
	border:.5pt solid #B2B2B2;
	mso-style-name:"Note";}
.style28
	{mso-pattern:auto none;
	background:#DBDBDB;
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"40% - Accent3";}
.style29
	{color:#FF0000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"Warning Text";}
.style30
	{mso-pattern:auto none;
	background:#F8CBAD;
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"40% - Accent2";}
.style31
	{color:#44546A;
	font-size:18.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:134;
	mso-style-name:"Title";}
.style32
	{color:#7F7F7F;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"CExplanatory Text";}
.style33
	{color:#44546A;
	font-size:15.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:134;
	border-bottom:1.0pt solid #5B9BD5;
	mso-style-name:"Heading 1";}
.style34
	{color:#44546A;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:134;
	border-bottom:1.0pt solid #ACCCEA;
	mso-style-name:"Heading 3";}
.style35
	{color:#44546A;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:134;
	mso-style-name:"Heading 4";}
.style36
	{mso-pattern:auto none;
	background:#FFCC99;
	color:#3F3F76;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	border:.5pt solid #7F7F7F;
	mso-style-name:"Input";}
.style37
	{mso-pattern:auto none;
	background:#C9C9C9;
	color:#FFFFFF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"60% - Accent3";}
.style38
	{mso-pattern:auto none;
	background:#C6EFCE;
	color:#006100;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"Good";}
.style39
	{mso-pattern:auto none;
	background:#F2F2F2;
	color:#3F3F3F;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	border:.5pt solid #3F3F3F;
	mso-style-name:"Output";}
.style40
	{mso-pattern:auto none;
	background:#DDEBF7;
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"20% - Accent1";}
.style41
	{mso-pattern:auto none;
	background:#F2F2F2;
	color:#FA7D00;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	border:.5pt solid #7F7F7F;
	mso-style-name:"Calculation";}
.style42
	{color:#FA7D00;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	border-bottom:2.0pt double #FF8001;
	mso-style-name:"Linked Cell";}
.style43
	{color:#000000;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	border-top:.5pt solid #5B9BD5;
	border-bottom:2.0pt double #5B9BD5;
	mso-style-name:"Total";}
.style44
	{mso-pattern:auto none;
	background:#FFC7CE;
	color:#9C0006;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"Bad";}
.style45
	{mso-pattern:auto none;
	background:#FFEB9C;
	color:#9C6500;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"Neutral";}
.style46
	{mso-pattern:auto none;
	background:#5B9BD5;
	color:#FFFFFF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"Accent1";}
.style47
	{mso-pattern:auto none;
	background:#D9E1F2;
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"20% - Accent5";}
.style48
	{mso-pattern:auto none;
	background:#9BC2E6;
	color:#FFFFFF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"60% - Accent1";}
.style49
	{mso-pattern:auto none;
	background:#ED7D31;
	color:#FFFFFF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"Accent2";}
.style50
	{mso-pattern:auto none;
	background:#FCE4D6;
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"20% - Accent2";}
.style51
	{mso-pattern:auto none;
	background:#E2EFDA;
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"20% - Accent6";}
.style52
	{mso-pattern:auto none;
	background:#F4B084;
	color:#FFFFFF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"60% - Accent2";}
.style53
	{mso-pattern:auto none;
	background:#A5A5A5;
	color:#FFFFFF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"Accent3";}
.style54
	{mso-pattern:auto none;
	background:#EDEDED;
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"20% - Accent3";}
.style55
	{mso-pattern:auto none;
	background:#FFC000;
	color:#FFFFFF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"Accent4";}
.style56
	{mso-pattern:auto none;
	background:#FFF2CC;
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"20% - Accent4";}
.style57
	{mso-pattern:auto none;
	background:#FFE699;
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"40% - Accent4";}
.style58
	{mso-pattern:auto none;
	background:#4472C4;
	color:#FFFFFF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"Accent5";}
.style59
	{mso-pattern:auto none;
	background:#B4C6E7;
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"40% - Accent5";}
.style60
	{mso-pattern:auto none;
	background:#8EA9DB;
	color:#FFFFFF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"60% - Accent5";}
.style61
	{mso-pattern:auto none;
	background:#70AD47;
	color:#FFFFFF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"Accent6";}
.style62
	{mso-pattern:auto none;
	background:#C6E0B4;
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"40% - Accent6";}
.style63
	{mso-pattern:auto none;
	background:#A9D08E;
	color:#FFFFFF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-style-name:"60% - Accent6";}
td
	{mso-style-parent:style0;
	padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	mso-number-format:"General";
	text-align:general;
	vertical-align:middle;
	white-space:nowrap;
	mso-rotate:0;
	mso-pattern:auto;
	mso-background-source:auto;
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-generic-font-family:auto;
	mso-font-charset:134;
	border:none;
	mso-protection:locked visible;}
.xl65
	{mso-style-parent:style0;
	text-align:center;
	mso-font-charset:134;}


------=_NextPart_c61e64716fff4828b8056c03de67b114
Content-Location: file:///C:/ksoet/TemplateKomoditi.files/filelist.xml
Content-Transfer-Encoding: quoted-printable
Content-Type: text/xml; charset="us-ascii"

<xml xmlns:o=3D"urn:schemas-microsoft-com:office:office">
 <o:MainFile href=3D"../TemplateKomoditi"/>
 <o:File href=3D"js.js"/>
 <o:File href=3D"tabstrip.htm"/>
 <o:File href=3D"sheet001.htm"/>
 <o:File href=3D"sheet002.htm"/>
 <o:File href=3D"sheet003.htm"/>
 <o:File href=3D"stylesheet.css"/>
 <o:File href=3D"filelist.xml"/>
</xml>
------=_NextPart_c61e64716fff4828b8056c03de67b114--