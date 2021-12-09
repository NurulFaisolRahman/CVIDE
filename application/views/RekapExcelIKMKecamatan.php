<?php
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename='.$NamaFile.'.xls');
?>
<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="ProgId" content="Excel.Sheet">
  <meta name="Generator" content="WPS Office ET">
  <!--[if gte mso 9]>
   <xml>
    <o:DocumentProperties>
     <o:Author>WINDOWS 10</o:Author>
     <o:Created>2021-04-15T13:04:56</o:Created>
     <o:LastAuthor>WINDOWS 10</o:LastAuthor>
     <o:LastSaved>2021-04-15T13:26:57</o:LastSaved>
    </o:DocumentProperties>
    <o:CustomDocumentProperties>
     <o:KSOProductBuildVer dt:dt="string">1033-11.2.0.10101</o:KSOProductBuildVer>
    </o:CustomDocumentProperties>
   </xml>
  <![endif]-->
  <style>
<!-- @page
	{margin:1,00in 0,75in 1,00in 0,75in;
	mso-header-margin:0,50in;
	mso-footer-margin:0,50in;}
tr
	{mso-height-source:auto;
	mso-ruby-visibility:none;}
col
	{mso-width-source:auto;
	mso-ruby-visibility:none;}
br
	{mso-data-placement:same-cell;}
.font0
	{color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:134;}
.font1
	{color:windowtext;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:134;}
.font2
	{color:#000000;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:134;}
.font3
	{color:#FF0000;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:134;}
.font4
	{color:#FFFFFF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font5
	{color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font6
	{color:#800080;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:underline;
	text-underline-style:single;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font7
	{color:#9C6500;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font8
	{color:#FF0000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font9
	{color:#7F7F7F;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font10
	{color:#0000FF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:underline;
	text-underline-style:single;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font11
	{color:#000000;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font12
	{color:#FA7D00;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font13
	{color:#FFFFFF;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font14
	{color:#3F3F3F;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font15
	{color:#44546A;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:134;}
.font16
	{color:#44546A;
	font-size:13.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:134;}
.font17
	{color:#44546A;
	font-size:18.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:134;}
.font18
	{color:#44546A;
	font-size:15.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:134;}
.font19
	{color:#FA7D00;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font20
	{color:#3F3F76;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font21
	{color:#006100;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font22
	{color:#9C0006;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
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
	mso-pattern:auto none;
	background:#9BC2E6;
	color:windowtext;
	font-weight:700;
	mso-font-charset:134;
	border:.5pt solid windowtext;}
.xl66
	{mso-style-parent:style0;
	text-align:center;
	white-space:normal;
	mso-pattern:auto none;
	background:#9BC2E6;
	color:windowtext;
	font-weight:700;
	mso-font-charset:134;
	border:.5pt solid windowtext;}
.xl67
	{mso-style-parent:style0;
	text-align:center;
	color:#000000;
	font-weight:700;
	mso-font-charset:134;
	border-left:.5pt solid windowtext;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;}
.xl68
	{mso-style-parent:style0;
	text-align:center;
	color:#000000;
	font-weight:700;
	mso-font-charset:134;
	border-left:.5pt solid windowtext;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;}
.xl69
	{mso-style-parent:style0;
	mso-number-format:"0\;\[Red\]0";
	text-align:center;
	color:#000000;
	font-weight:700;
	mso-font-charset:134;
	border:.5pt solid windowtext;}
.xl70
	{mso-style-parent:style0;
	text-align:center;
	color:#000000;
	font-weight:700;
	mso-font-charset:134;
	border-left:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;}
.xl71
	{mso-style-parent:style0;
	mso-number-format:"\@";
	text-align:center;
	color:#000000;
	font-weight:700;
	mso-font-charset:134;
	border:.5pt solid windowtext;}
.xl72
	{mso-style-parent:style0;
	text-align:center;
	color:#FF0000;
	font-weight:700;
	mso-font-charset:134;
	border:.5pt solid windowtext;}
.xl73
	{mso-style-parent:style0;
	mso-number-format:"0\;\[Red\]0";
	text-align:center;
	color:#FF0000;
	font-weight:700;
	mso-font-charset:134;
	border:.5pt solid windowtext;}
.xl74
	{mso-style-parent:style0;
	text-align:center;
	color:#FF0000;
	font-weight:700;
	mso-font-charset:134;
	border:.5pt solid windowtext;}
.xl75
	{mso-style-parent:style0;
	mso-number-format:"\@";
	text-align:center;
	color:#FF0000;
	font-weight:700;
	mso-font-charset:134;
	border:.5pt solid windowtext;}
 -->  </style>
  <!--[if gte mso 9]>
   <xml>
    <x:ExcelWorkbook>
     <x:ExcelWorksheets>
      <x:ExcelWorksheet>
       <x:Name>Sheet1</x:Name>
       <x:WorksheetOptions>
        <x:DefaultRowHeight>300</x:DefaultRowHeight>
        <x:StandardWidth>2340</x:StandardWidth>
        <x:Selected/>
        <x:Panes>
         <x:Pane>
          <x:Number>3</x:Number>
          <x:ActiveCol>8</x:ActiveCol>
          <x:ActiveRow>1</x:ActiveRow>
          <x:RangeSelection>I2</x:RangeSelection>
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
      </x:ExcelWorksheet>
     </x:ExcelWorksheets>
     <x:ProtectStructure>False</x:ProtectStructure>
     <x:ProtectWindows>False</x:ProtectWindows>
     <x:WindowHeight>7815</x:WindowHeight>
     <x:WindowWidth>20490</x:WindowWidth>
    </x:ExcelWorkbook>
    <x:SupBook>
     <x:Path>D:\CVIDE\TemplateExcel\</x:Path>
     <x:SheetName>BPD</x:SheetName>
     <x:SheetName>KinerjaPemdes</x:SheetName>
     <x:SheetName>KinerjaAparatur</x:SheetName>
    </x:SupBook>
   </xml>
  <![endif]-->
 </head>
 <body link="blue" vlink="purple">
  <table width="871" border="0" cellpadding="0" cellspacing="0" style='width:653.25pt;border-collapse:collapse;table-layout:fixed;'>
   <col width="26" style='mso-width-source:userset;mso-width-alt:950;'/>
   <col width="40" style='mso-width-source:userset;mso-width-alt:1462;'/>
   <col width="145" style='mso-width-source:userset;mso-width-alt:5302;'/>
   <col width="110" span="12" style='mso-width-source:userset;mso-width-alt:4022;'/>
   <tr height="20" style='height:15.00pt;'>
    <td height="20" width="26" style='height:15.00pt;width:19.50pt;'></td>
    <td width="40" style='width:30.00pt;'></td>
    <td width="145" style='width:108.75pt;'></td>
    <td width="110" style='width:82.50pt;'></td>
    <td width="110" style='width:82.50pt;'></td>
    <td width="110" style='width:82.50pt;'></td>
    <td width="110" style='width:82.50pt;'></td>
    <td width="110" style='width:82.50pt;'></td>
    <td width="110" style='width:82.50pt;'></td>
		<td width="110" style='width:82.50pt;'></td>
    <td width="110" style='width:82.50pt;'></td>
    <td width="110" style='width:82.50pt;'></td>
    <td width="110" style='width:82.50pt;'></td>
    <td width="110" style='width:82.50pt;'></td>
		<td width="110" style='width:82.50pt;'></td>
   </tr>
   <tr height="20" style='height:15.00pt;'>
    <td height="20" style='height:15.00pt;'></td>
    <td class="xl65" x:str>No</td>
    <td class="xl65" x:str>Desa</td>
    <td class="xl66" x:num>Persyaratan Pelayanan</td>
    <td class="xl66" x:num>Prosedur Pelayanan</td>
    <td class="xl66" x:num>Waktu Pelayanan</td>
    <td class="xl66" x:num>Biaya / Tarif</td>
    <td class="xl66" x:num>Spesifikasi Pelayanan</td>
		<td class="xl66" x:num>Kompetensi Pelaksana</td>
		<td class="xl66" x:num>Perilaku Pelaksana</td>
		<td class="xl66" x:num>Kedisiplinan</td>
		<td class="xl66" x:num>Penanganan Pengaduan</td>
		<td class="xl66" x:num>Sarana</td>
		<td class="xl66" x:num>Penerapan Smart Kampung</td>
    <td class="xl65" x:str>Nilai Indeks</td>
		<td class="xl65" x:str>Mutu Pelayanan</td>
		<td class="xl65" x:str>Kinerja Pelayanan</td>
   </tr>
	 <?php for ($i=0; $i < count($IKMDesa); $i++) { $Pisah = explode("|",$IKMDesa[$i]); ?>
   <tr height="20" style='height:15.00pt;'>
    <td height="20" rowspan="2" style='height:15.00pt;'></td>
    <td class="xl67" rowspan="2" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;' x:num><?=($i+1)?></td>
    <td class="xl68" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;' x:str><?=$Pisah[0]?></td>
    <td class="xl69" x:str><?=str_replace(".",",",$Pisah[1])?></td>
    <td class="xl69" x:str><?=str_replace(".",",",$Pisah[2])?></td>
    <td class="xl69" x:str><?=str_replace(".",",",$Pisah[3])?></td>
    <td class="xl69" x:str><?=str_replace(".",",",$Pisah[4])?></td>
    <td class="xl69" x:str><?=str_replace(".",",",$Pisah[5])?></td>
    <td class="xl69" x:str><?=str_replace(".",",",$Pisah[6])?></td>
		<td class="xl69" x:str><?=str_replace(".",",",$Pisah[7])?></td>
    <td class="xl69" x:str><?=str_replace(".",",",$Pisah[8])?></td>
    <td class="xl69" x:str><?=str_replace(".",",",$Pisah[9])?></td>
    <td class="xl69" x:str><?=str_replace(".",",",$Pisah[10])?></td>
    <td class="xl69" x:str><?=str_replace(".",",",$Pisah[11])?></td>
		<td class="xl69" x:str><?=str_replace(".",",",$Pisah[12])?></td>
		<td class="xl69" rowspan="2" x:str><?=$Pisah[12]==0?'-':($Pisah[12]<43.75?'D':($Pisah[12]<62.5?'C':($Pisah[12]<81.25?'B':'A')));?></td>
		<td class="xl69" rowspan="2" x:str><?=$Pisah[12]==0?'-':($Pisah[12]<43.75?'Tidak Baik':($Pisah[12]<62.5?'Kurang Baik':($Pisah[12]<81.25?'Baik':'Sangat Baik')));?></td>
   </tr>
	 <tr height="20" style='height:15.00pt;'>
    <td height="20" style='height:15.00pt;'></td>
    <td class="xl69" x:str><?=$Pisah[1]==0?'-':($Pisah[1]<43.75?'Tidak Baik':($Pisah[1]<62.5?'Kurang Baik':($Pisah[1]<81.25?'Baik':'Sangat Baik')));?></td>
    <td class="xl69" x:str><?=$Pisah[2]==0?'-':($Pisah[2]<43.75?'Tidak Baik':($Pisah[2]<62.5?'Kurang Baik':($Pisah[2]<81.25?'Baik':'Sangat Baik')));?></td>
    <td class="xl69" x:str><?=$Pisah[3]==0?'-':($Pisah[3]<43.75?'Tidak Baik':($Pisah[3]<62.5?'Kurang Baik':($Pisah[3]<81.25?'Baik':'Sangat Baik')));?></td>
    <td class="xl69" x:str><?=$Pisah[4]==0?'-':($Pisah[4]<43.75?'Tidak Baik':($Pisah[4]<62.5?'Kurang Baik':($Pisah[4]<81.25?'Baik':'Sangat Baik')));?></td>
    <td class="xl69" x:str><?=$Pisah[5]==0?'-':($Pisah[5]<43.75?'Tidak Baik':($Pisah[5]<62.5?'Kurang Baik':($Pisah[5]<81.25?'Baik':'Sangat Baik')));?></td>
    <td class="xl69" x:str><?=$Pisah[6]==0?'-':($Pisah[6]<43.75?'Tidak Baik':($Pisah[6]<62.5?'Kurang Baik':($Pisah[6]<81.25?'Baik':'Sangat Baik')));?></td>
		<td class="xl69" x:str><?=$Pisah[7]==0?'-':($Pisah[7]<43.75?'Tidak Baik':($Pisah[7]<62.5?'Kurang Baik':($Pisah[7]<81.25?'Baik':'Sangat Baik')));?></td>
    <td class="xl69" x:str><?=$Pisah[8]==0?'-':($Pisah[8]<43.75?'Tidak Baik':($Pisah[8]<62.5?'Kurang Baik':($Pisah[8]<81.25?'Baik':'Sangat Baik')));?></td>
    <td class="xl69" x:str><?=$Pisah[9]==0?'-':($Pisah[9]<43.75?'Tidak Baik':($Pisah[9]<62.5?'Kurang Baik':($Pisah[9]<81.25?'Baik':'Sangat Baik')));?></td>
    <td class="xl69" x:str><?=$Pisah[10]==0?'-':($Pisah[10]<43.75?'Tidak Baik':($Pisah[10]<62.5?'Kurang Baik':($Pisah[10]<81.25?'Baik':'Sangat Baik')));?></td>
    <td class="xl69" x:str><?=$Pisah[11]==0?'-':($Pisah[11]<43.75?'Tidak Baik':($Pisah[11]<62.5?'Kurang Baik':($Pisah[11]<81.25?'Baik':'Sangat Baik')));?></td>
		<td class="xl69" x:str><?=$Pisah[12]==0?'-':($Pisah[12]<43.75?'Tidak Baik':($Pisah[12]<62.5?'Kurang Baik':($Pisah[12]<81.25?'Baik':'Sangat Baik')));?></td>
   </tr>
   <?php } ?>
   <tr height="20" style='height:15.00pt;'>
    <td height="20" style='height:15.00pt;'></td>
    <td class="xl72" rowspan="2" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;' x:str>#</td>
    <td class="xl72" rowspan="2" style='border-right:.5pt solid windowtext;border-bottom:.5pt solid windowtext;' x:str><?=$IKMKecamatan[0]?></td>
    <td class="xl73" x:str><?=str_replace(".",",",$IKMKecamatan[1])?></td>
    <td class="xl73" x:str><?=str_replace(".",",",$IKMKecamatan[2])?></td>
    <td class="xl73" x:str><?=str_replace(".",",",$IKMKecamatan[3])?></td>
    <td class="xl73" x:str><?=str_replace(".",",",$IKMKecamatan[4])?></td>
    <td class="xl73" x:str><?=str_replace(".",",",$IKMKecamatan[5])?></td>
    <td class="xl73" x:str><?=str_replace(".",",",$IKMKecamatan[6])?></td>
		<td class="xl73" x:str><?=str_replace(".",",",$IKMKecamatan[7])?></td>
    <td class="xl73" x:str><?=str_replace(".",",",$IKMKecamatan[8])?></td>
    <td class="xl73" x:str><?=str_replace(".",",",$IKMKecamatan[9])?></td>
    <td class="xl73" x:str><?=str_replace(".",",",$IKMKecamatan[10])?></td>
    <td class="xl73" x:str><?=str_replace(".",",",$IKMKecamatan[11])?></td>
    <td class="xl73" x:str><?=str_replace(".",",",$IKMKecamatan[12])?></td>
		<td class="xl73" rowspan="2" x:str><?=$IKMKecamatan[12]==0?'-':($IKMKecamatan[12]<43.75?'D':($IKMKecamatan[12]<62.5?'C':($IKMKecamatan[12]<81.25?'B':'A')));?></td>
		<td class="xl73" rowspan="2" x:str><?=$IKMKecamatan[12]==0?'-':($IKMKecamatan[12]<43.75?'Tidak Baik':($IKMKecamatan[12]<62.5?'Kurang Baik':($IKMKecamatan[12]<81.25?'Baik':'Sangat Baik')));?></td>
   </tr>
	 <tr height="20" style='height:15.00pt;'>
    <td height="20" style='height:15.00pt;'></td>
    <td class="xl73" x:str><?=$IKMKecamatan[1]==0?'-':($IKMKecamatan[1]<43.75?'Tidak Baik':($IKMKecamatan[1]<62.5?'Kurang Baik':($IKMKecamatan[1]<81.25?'Baik':'Sangat Baik')));?></td>
    <td class="xl73" x:str><?=$IKMKecamatan[2]==0?'-':($IKMKecamatan[2]<43.75?'Tidak Baik':($IKMKecamatan[2]<62.5?'Kurang Baik':($IKMKecamatan[2]<81.25?'Baik':'Sangat Baik')));?></td>
    <td class="xl73" x:str><?=$IKMKecamatan[3]==0?'-':($IKMKecamatan[3]<43.75?'Tidak Baik':($IKMKecamatan[3]<62.5?'Kurang Baik':($IKMKecamatan[3]<81.25?'Baik':'Sangat Baik')));?></td>
    <td class="xl73" x:str><?=$IKMKecamatan[4]==0?'-':($IKMKecamatan[4]<43.75?'Tidak Baik':($IKMKecamatan[4]<62.5?'Kurang Baik':($IKMKecamatan[4]<81.25?'Baik':'Sangat Baik')));?></td>
    <td class="xl73" x:str><?=$IKMKecamatan[5]==0?'-':($IKMKecamatan[5]<43.75?'Tidak Baik':($IKMKecamatan[5]<62.5?'Kurang Baik':($IKMKecamatan[5]<81.25?'Baik':'Sangat Baik')));?></td>
    <td class="xl73" x:str><?=$IKMKecamatan[6]==0?'-':($IKMKecamatan[6]<43.75?'Tidak Baik':($IKMKecamatan[6]<62.5?'Kurang Baik':($IKMKecamatan[6]<81.25?'Baik':'Sangat Baik')));?></td>
		<td class="xl73" x:str><?=$IKMKecamatan[7]==0?'-':($IKMKecamatan[7]<43.75?'Tidak Baik':($IKMKecamatan[7]<62.5?'Kurang Baik':($IKMKecamatan[7]<81.25?'Baik':'Sangat Baik')));?></td>
		<td class="xl73" x:str><?=$IKMKecamatan[8]==0?'-':($IKMKecamatan[8]<43.75?'Tidak Baik':($IKMKecamatan[8]<62.5?'Kurang Baik':($IKMKecamatan[8]<81.25?'Baik':'Sangat Baik')));?></td>
		<td class="xl73" x:str><?=$IKMKecamatan[9]==0?'-':($IKMKecamatan[9]<43.75?'Tidak Baik':($IKMKecamatan[9]<62.5?'Kurang Baik':($IKMKecamatan[9]<81.25?'Baik':'Sangat Baik')));?></td>
		<td class="xl73" x:str><?=$IKMKecamatan[10]==0?'-':($IKMKecamatan[10]<43.75?'Tidak Baik':($IKMKecamatan[10]<62.5?'Kurang Baik':($IKMKecamatan[10]<81.25?'Baik':'Sangat Baik')));?></td>
		<td class="xl73" x:str><?=$IKMKecamatan[11]==0?'-':($IKMKecamatan[11]<43.75?'Tidak Baik':($IKMKecamatan[11]<62.5?'Kurang Baik':($IKMKecamatan[11]<81.25?'Baik':'Sangat Baik')));?></td>
		<td class="xl73" x:str><?=$IKMKecamatan[12]==0?'-':($IKMKecamatan[12]<43.75?'Tidak Baik':($IKMKecamatan[12]<62.5?'Kurang Baik':($IKMKecamatan[12]<81.25?'Baik':'Sangat Baik')));?></td>
   </tr>
  </table>
 </body>
</html>