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
     <o:Created>2021-05-29T15:25:34</o:Created>
     <o:LastAuthor>WINDOWS 10</o:LastAuthor>
     <o:LastSaved>2021-06-09T13:40:11</o:LastSaved>
    </o:DocumentProperties>
    <o:CustomDocumentProperties>
     <o:KSOProductBuildVer dt:dt="string">1033-11.2.0.10152</o:KSOProductBuildVer>
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
	{color:#FF0000;
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
	{color:#FFFFFF;
	font-size:11.0pt;
	font-weight:400;
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
	{color:#0000FF;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:underline;
	text-underline-style:single;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font7
	{color:#800080;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:underline;
	text-underline-style:single;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font8
	{color:#FA7D00;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font9
	{color:#FFFFFF;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font10
	{color:#9C0006;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font11
	{color:#FA7D00;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font12
	{color:#44546A;
	font-size:13.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:134;}
.font13
	{color:#44546A;
	font-size:15.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:134;}
.font14
	{color:#7F7F7F;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font15
	{color:#FF0000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font16
	{color:#44546A;
	font-size:18.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:134;}
.font17
	{color:#9C6500;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font18
	{color:#3F3F3F;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font19
	{color:#3F3F76;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font20
	{color:#44546A;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:134;}
.font21
	{color:#000000;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Calibri";
	mso-generic-font-family:auto;
	mso-font-charset:0;}
.font22
	{color:#006100;
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
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
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
	mso-font-charset:0;
	mso-style-name:"40% - Accent3";}
.style29
	{color:#FF0000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
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
	mso-font-charset:0;
	mso-style-name:"40% - Accent2";}
.style31
	{color:#44546A;
	font-size:18.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-font-charset:134;
	mso-style-name:"Title";}
.style32
	{color:#7F7F7F;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri;
	mso-font-charset:0;
	mso-style-name:"CExplanatory Text";}
.style33
	{color:#44546A;
	font-size:15.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
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
	color:#000000;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri;
	mso-font-charset:134;
	border:none;
	mso-protection:locked visible;}
.xl65
	{mso-style-parent:style0;
	text-align:center;
	mso-pattern:auto none;
	background:#FFD966;
	color:#FF0000;
	font-weight:700;
	mso-font-charset:134;
	border:.5pt solid windowtext;}
.xl66
	{mso-style-parent:style0;
	text-align:left;
	mso-pattern:auto none;
	background:#FFD966;
	color:#FF0000;
	font-weight:700;
	mso-font-charset:134;
	border:.5pt solid windowtext;}
.xl67
	{mso-style-parent:style0;
	text-align:center;
	mso-pattern:auto none;
	background:#F4B084;
	font-weight:700;
	mso-font-charset:134;
	border:.5pt solid windowtext;}
.xl68
	{mso-style-parent:style0;
	text-align:left;
	mso-pattern:auto none;
	background:#F4B084;
	font-weight:700;
	mso-font-charset:134;
	border:.5pt solid windowtext;}
.xl69
	{mso-style-parent:style17;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	text-align:center;
	mso-pattern:auto none;
	background:#F4B084;
	font-weight:700;
	border:.5pt solid windowtext;}
.xl70
	{mso-style-parent:style0;
	text-align:center;
	font-weight:700;
	mso-font-charset:134;}
.xl71
	{mso-style-parent:style0;
	text-align:right;
	mso-pattern:auto none;
	background:#FFFF00;
	font-weight:700;
	mso-font-charset:134;
	border:.5pt solid windowtext;}
.xl72
	{mso-style-parent:style17;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	text-align:center;
	mso-pattern:auto none;
	background:#FFFF00;
	font-weight:700;
	border:.5pt solid windowtext;}
.xl73
	{mso-style-parent:style17;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	text-align:center;
	mso-pattern:auto none;
	background:#FFFF00;
	font-weight:700;
	border:.5pt solid windowtext;}
.xl74
	{mso-style-parent:style0;
	color:#FFFFFF;
	mso-font-charset:134;}
 -->  </style>
  <!--[if gte mso 9]>
   <xml>
    <x:ExcelWorkbook>
     <x:ExcelWorksheets>
      <x:ExcelWorksheet>
       <x:Name>Sheet1</x:Name>
       <x:WorksheetOptions>
        <x:DefaultRowHeight>300</x:DefaultRowHeight>
        <x:StandardWidth>2335</x:StandardWidth>
        <x:Selected/>
        <x:Panes>
         <x:Pane>
          <x:Number>3</x:Number>
          <x:ActiveCol>1</x:ActiveCol>
          <x:ActiveRow>0</x:ActiveRow>
          <x:RangeSelection>B1</x:RangeSelection>
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
     <x:SelectedSheets>0</x:SelectedSheets>
     <x:WindowHeight>7860</x:WindowHeight>
     <x:WindowWidth>20490</x:WindowWidth>
    </x:ExcelWorkbook>
   </xml>
  <![endif]-->
 </head>
 <body link="blue" vlink="purple">
  <table width="938,93" border="0" cellpadding="0" cellspacing="0" style='width:704.20pt;border-collapse:collapse;table-layout:fixed;'>
   <col width="26" style='mso-width-source:userset;mso-width-alt:950;'/>
   <col width="40" style='mso-width-source:userset;mso-width-alt:1462;'/>
   <col width="285" style='mso-width-source:userset;mso-width-alt:8000;'/>
   <col width="63,93" style='mso-width-source:userset;mso-width-alt:8000;'/>
   <col width="110" style='mso-width-source:userset;mso-width-alt:4022;'/>
   <col width="145" span="2" style='mso-width-source:userset;mso-width-alt:3000;'/>
   <col width="124" style='mso-width-source:userset;mso-width-alt:4000;'/>
	 <col width="124" style='mso-width-source:userset;mso-width-alt:4000;'/>
	 <col width="124" style='mso-width-source:userset;mso-width-alt:4000;'/>
	 <col width="124" style='mso-width-source:userset;mso-width-alt:4000;'/>
   <tr height="20" style='height:15.00pt;'>
    <td height="20" width="26" style='height:15.00pt;width:19.50pt;'></td>
    <td width="40" style='width:30.00pt;'></td>
    <td width="285" style='width:213.75pt;'></td>
    <td width="63,93" style='width:47.95pt;'></td>
    <td width="110" style='width:82.50pt;'></td>
    <td width="145" style='width:108.75pt;'></td>
    <td width="145" style='width:108.75pt;'></td>
    <td width="124" style='width:93.00pt;'></td>
   </tr>
   <tr height="24" style='height:18.00pt;mso-height-source:userset;mso-height-alt:360;'>
    <td height="24" style='height:18.00pt;'></td>
    <td class="xl65" x:str>No</td>
		<td class="xl66" x:str>Kegiatan</td>
    <td class="xl66" x:str>Deskripsi</td>
		<td class="xl66" x:str>Kategori</td>
		<td class="xl66" x:str>Sub Kategori</td>
    <td class="xl65" x:str>Kuantitas</td>
    <td class="xl65" x:str>Harga</td>
    <td class="xl65" x:str>Debit</td>
    <td class="xl65" x:str>Kredit</td>
    <td class="xl65" x:str>Tanggal</td>
   </tr>
	 <?php $Amount = 0; $No= 1; foreach ($Kas as $key) { $Date = explode("-",$key['Tanggal'])?> 
   <tr height="24" style='height:18.00pt;mso-height-source:userset;mso-height-alt:360;'>
    <td height="24" style='height:18.00pt;'></td>
    <td class="xl67" x:num><?=$No++?></td>
		<td class="xl68" x:str><?=isset($key['IdKegiatan']) ? $key['NamaKegiatan'] : ''; ?></td>
    <td class="xl68" x:str><?=isset($key['Description']) ? $key['Description'] : $key['Deskripsi']; ?></td>
		<td class="xl68" x:str><?=isset($key['Category']) ? $key['Category'] : $JenisPengeluaran[$key['JenisPengeluaran']]; ?></td>
		<td class="xl68" x:str><?=isset($key['Category']) ? '' : $SubPengeluaran[$key['JenisPengeluaran']][$key['SubPengeluaran']]; ?></td>
		<td class="xl67" x:num><?=isset($key['Quantity']) ? $key['Quantity'] == "" ? '1' : $key['Quantity'] : '1'; ?></td>
    <td class="xl69" x:num=""><span style='mso-spacerun:yes;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><?=isset($key['Price']) ? $key['Price'] == "" ? "Rp ".number_format($key['Amount'],0,',','.') : "Rp ".number_format($key['Price'],0,',','.') : "Rp ".number_format($key['NominalPengeluaran'],0,',','.'); ?><span style='mso-spacerun:yes;'>&nbsp;</span></td>
    <td class="xl69" x:num=""><span style='mso-spacerun:yes;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><?=isset($key['Jenis']) ? $key['Jenis'] == 'IN' ? "Rp ".number_format($key['Amount'],0,',','.') : '' : ''; ?><span style='mso-spacerun:yes;'>&nbsp;</span></td>
    <td class="xl69" x:num=""><span style='mso-spacerun:yes;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><?=isset($key['Jenis']) ? $key['Jenis'] == 'OUT' ? "Rp ".number_format($key['Amount'],0,',','.') : '' : "Rp ".number_format($key['NominalPengeluaran'],0,',','.'); ?><span style='mso-spacerun:yes;'>&nbsp;</span></td>
    <td class="xl67" x:str><?=$Date[2].'-'.$Date[1].'-'.$Date[0]?></td>
   </tr>
	 <?php } ?>
	 <?php if (count($Kas) > 0) { ?>
   <tr height="26,67" style='height:20.00pt;mso-height-source:userset;mso-height-alt:400;'>
    <td height="26,67" style='height:20.00pt;'></td>
    <td class="xl70" colspan="6" style='mso-ignore:colspan;'></td>
    <td class="xl71" x:str>Total</td>
    <td class="xl72" x:fmla="=SUM(I3:I<?=2+count($Kas)?>)" x:num=""><span style='mso-spacerun:yes;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='mso-spacerun:yes;'>&nbsp;</span></td>
    <td class="xl72" x:fmla="=SUM(J3:J<?=2+count($Kas)?>)" x:num=""><span style='mso-spacerun:yes;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='mso-spacerun:yes;'>&nbsp;</span></td>
    <td class="xl73" x:fmla="=I<?=3+count($Kas)?>-J<?=3+count($Kas)?>" x:num=""><span style='mso-spacerun:yes;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='mso-spacerun:yes;'>&nbsp;</span></td>
   </tr>
	 <?php } ?>
   <tr height="20" style='height:15.00pt;'>
    <td height="20" colspan="4" style='height:15.00pt;mso-ignore:colspan;'></td>
    <td class="xl74"></td>
    <td colspan="3" style='mso-ignore:colspan;'></td>
   </tr>
   <![if supportMisalignedColumns]>
    <tr width="0" style='display:none;'>
     <td width="26" style='width:20;'></td>
     <td width="40" style='width:30;'></td>
     <td width="285" style='width:214;'></td>
     <td width="64" style='width:48;'></td>
     <td width="110" style='width:83;'></td>
     <td width="145" style='width:109;'></td>
     <td width="124" style='width:93;'></td>
    </tr>
   <![endif]>
  </table>
 </body>
</html>
