<?php
session_start();
include('connect.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Precocity</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
.togList
{
 color: #1003F8;
  
}

.togList dt
{
  cursor: pointer; cursor: hand;
  
}

.togList dt span
{
  font-family: monospace;
  }

.togList dd
{
  padding-bottom: 5px;
}

html.isJS .togList dd
{
  display: none;
}

</style>
<script type="text/javascript">

/* Only set closed if JS-enabled */
document.getElementsByTagName('html')[0].className = 'isJS';

function tog(dt)
{
  var display, dd=dt;
  /* get dd */
  do{ dd = dd.nextSibling } while(dd.tagName!='DD');
  toOpen =!dd.style.display;
  dd.style.display = toOpen? 'block':''
  dt.getElementsByTagName('span')[0].innerHTML
    = toOpen? '-':'+' ;
}
</script>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script>

function toggle(thisname) {
tr=document.getElementsByTagName('tr')
for (i=0;i<tr.length;i++){
if (tr[i].getAttribute(thisname)){
if ( tr[i].style.display=='none' ){
tr[i].style.display = '';
}
else {
tr[i].style.display = 'none';
}
}
}
}
function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }



function validate()
{
         var fields = $("input[name='genes[]']").serializeArray();
         if (fields.length == 0)
        {
              alert('Please select Gene');
			  var success = false;
        }
        else
       {
             success = true;
       }
	   return success;
}
</script>
<style type="text/css">
<!--
a:link {
	text-decoration: none;
	color: #006;
}
a:visited {
	text-decoration: none;
	color: #662100;
}
a:hover {
	text-decoration: none;
	color: #662100;
}
a:active {
	text-decoration: none;
	color: #662100;
}
body,td,th {
	font-size: 12pt;
	color: #000;
	font-family: Verdana, Geneva, sans-serif;
}
body {
	background-color: #E0E0E0;
}
.style32 {color: #003300; font-weight: bold; }
.style33 {color: #FF0000; font-weight: bold; }
.style35 {color: #CC0000}
.style36 {
	color: #0000EE;
	font-weight: bold;
}
.style37 {
	color:#800040;
	font-weight: bold;
	font-size: 12pt ;
	background: #DCE4FD;
	padding: 5px ;
}
.style38 {color: #800040;
font-size: 12pt ;}
.style43 {color: #003300; font-weight: bold; font-size: 12; }
.style46 {color: #004400; font-weight: bold; }
.style49 {color: #000099; font-weight: bold; }
.style50 {color: #000099}
.style51 {color: #000000}
 #mynetwork {
            width: 800px;
            height: 800px;
            border: 1px solid #444444;
            background-color: #dddddd;
        }
-->
</style>
<link rel="stylesheet" type="text/css" href="tooltip/style.css" />
<script type="text/javascript" language="javascript" src="tooltip/script.js"> </script>
<script type="text/javascript">
at_attach("sample_attach_menu_parent", "sample_attach_menu_child", "hover", "y", "pointer");
      </script>
      
     <script type="text/javascript" src="vis-4.21.0/vis-4.21.0/dist/vis.js"></script>
    <link href="vis-4.21.0/vis-4.21.0/dist/vis-network.min.css" rel="stylesheet" type="text/css"/>

<link href='css/style1.css' type='text/css' rel='stylesheet' />
<script language="javascript" src="css/jsval.js">
    </script>
<script type="text/javascript" src="css/dropdown.js"> </script>
<style type="text/css">
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #000;
}
body {
	background-color: #D6D6D6;
}
.head {
	
  background-repeat: no-repeat;
  background-size: contain;
  height: 110px;
}
</style>
</head>

<body>
<table width="90%" border="0" cellspacing="0" cellpadding="6" align="center" bgcolor="#FFFFFF">
  <tr>
    <td background="head.jpg" class="head" >&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="ffffff">
      <tr bgcolor="#46439a">
      
        <td width="12%" height="51" align="center" bgcolor="#46439a"><ul id="MenuBar1" class="MenuBarHorizont">
          <li><a class="MenuBarItemSubmenu" href="index.php"><strong> Home</strong></a></li></ul>
              </td>
        
        <td width="14%" align="center" bgcolor="#46439a"> <ul id="MenuBar2" class="MenuBarHorizontal">
            <li><a class="MenuBarItemSubmenu" href="#"><strong>Search</strong></a>
              <ul>
                <li><div align="left"><a href="search.php">Quick Search</a></div></li>
               
                <li><div align="left"><a href="advsrh.php">Advanced Search</a></div></li>
              </ul>
            </li>
            
          </ul></td>
          <td width="17%" align="center" bgcolor="#46439a"><ul id="MenuBar3" class="MenuBarHorizontal">
          <li><a class="MenuBarItemSubmenu" href="#"><strong>Browse</strong></a>
            <ul>
              <li><div align="left"> <a href="gene.php">Genes</a></div></li>
               <li><div align="left"> <a href="snp.php">SNPs</a></div></li>
              <li><div align="left"><a href="pathway.php">Pathways</a></li>
              <li><div align="left"> <a href="go_d.php">Ontologies</a></div></li>
              </ul>
          </li>
        </ul></td>
        <td width="20%" align="center" bgcolor="#46439a"><ul id="MenuBar4" class="MenuBarHorizontal">
  <li><a href="ideogramk.php"><strong>SNP visualizer</strong></a>
  </li>
            
          </ul><a href='srch.html'><font color="#000000"><strong></strong></font> </a></td>
   
   <td width="22%" align="center" bgcolor="#46439a"><strong><ul id="MenuBar5" class="MenuBarHorizontal">
   <li><a class="MenuBarItemSubmenu" href="#"><strong>Enrichment analysis </strong></a>
              <ul>
                <li><div align="left"><a href="pathway_enrichment.php">Pathways</a></div></li>
               
                <li><div align="left"><a href="disease_enrichment.php">Diseases</a></div></li>
              </ul>
            </li>
         </ul></strong></td>      
        <td width="15%" align="center" bgcolor="#46439a"><strong><ul id="MenuBar6" class="MenuBarHorizont">
          <li><a class="MenuBarItemSubmenu" href='help.php'>Help </a></li></ul></strong></td>      
        
        </tr>
    </table>
	<script type="text/javascript">
at_attach("sample_attach_menu_parent", "sample_attach_menu_child", "hover", "y", "pointer");
</script></td>
  </tr>
</table>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var MenuBar2 = new Spry.Widget.MenuBar("MenuBar2", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var MenuBar3 = new Spry.Widget.MenuBar("MenuBar3", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var MenuBar4 = new Spry.Widget.MenuBar("MenuBar4", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var MenuBar5 = new Spry.Widget.MenuBar("MenuBar5", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var MenuBar6 = new Spry.Widget.MenuBar("MenuBar6", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
