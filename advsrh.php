<?php
error_reporting(0);
include('head.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel ="icon" type="image/ico" href="favicon.ico"></link>
<link rel ="shortcut icon" href="favicon.ico"></link>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='css/style1.css' type='text/css' rel='stylesheet' />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript">



var persistmenu="yes" //"yes" or "no". Make sure each SPAN content contains an incrementing ID starting at 1 (id="sub1", id="sub2", etc)
var persisttype="sitewide" //enter "sitewide" for menu to persist across site, "local" for this page only

if (document.getElementById){ //DynamicDrive.com change
document.write('<style type="text/css">\n')
document.write('.submenu{display: none;}\n')
document.write('</style>\n')
}

function SwitchMenu(obj){
	if(document.getElementById){
	var el = document.getElementById(obj);
	var ar = document.getElementById("masterdiv").getElementsByTagName("span"); //DynamicDrive.com change
		if(el.style.display != "block"){ //DynamicDrive.com change
			for (var i=0; i<ar.length; i++){
				if (ar[i].className=="submenu") //DynamicDrive.com change
				ar[i].style.display = "none";
			}
			el.style.display = "block";
		}else{
			el.style.display = "none";
		}
	}
}

function get_cookie(Name) { 
var search = Name + "="
var returnvalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search)
if (offset != -1) { 
offset += search.length
end = document.cookie.indexOf(";", offset);
if (end == -1) end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end))
}
}
return returnvalue;
}

function onloadfunction(){
if (persistmenu=="yes"){
var cookiename=(persisttype=="sitewide")? "switchmenu" : window.location.pathname
var cookievalue=get_cookie(cookiename)
if (cookievalue!="")
document.getElementById(cookievalue).style.display="block"
}
}

function savemenustate(){
var inc=1, blockid=""
while (document.getElementById("sub"+inc)){
if (document.getElementById("sub"+inc).style.display=="block"){
blockid="sub"+inc
break
}
inc++
}
var cookiename=(persisttype=="sitewide")? "switchmenu" : window.location.pathname
var cookievalue=(persisttype=="sitewide")? blockid+";path=/" : blockid
document.cookie=cookiename+"="+cookievalue
}

if (window.addEventListener)
window.addEventListener("load", onloadfunction, false)
else if (window.attachEvent)
window.attachEvent("onload", onloadfunction)
else if (document.getElementById)
window.onload=onloadfunction

if (persistmenu=="yes" && document.getElementById)
window.onunload=savemenustate

</script>
	<SCRIPT language="javascript">
		function addRow(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var colCount = table.rows[1].cells.length;

			for(var i=0; i<colCount; i++) {

				var newcell	= row.insertCell(i);

				newcell.innerHTML = table.rows[1].cells[i].innerHTML;
				//alert(newcell.childNodes);
				switch(newcell.childNodes[0].type) {
					case "text":
							newcell.childNodes[0].value = "";
							break;
					case "checkbox":
							newcell.childNodes[0].checked = false;
							break;
					case "select-one":
							newcell.childNodes[0].selectedIndex = 0;
							break;
					case "textarea":
							newcell.childNodes[0].value = "";
							break;
				}
			}
		}

		function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					if(rowCount <= 2) {
						alert("Cannot delete all the rows.");
						break;
					}
					table.deleteRow(i);
					rowCount--;
					i--;
				}

			}
			}catch(e) {
				alert(e);
			}
		}

	</SCRIPT>
    <script language="javascript" src="script/chainedselects.js">

/***********************************************
* Chained Selects script- By Xin Yang (http://www.yxscripts.com/)
* Script featured on/available at http://www.dynamicdrive.com/
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>
<script language="javascript" src="script/config2.js"></script>

<script language="javascript">
function addterm()
{

  var element = document.getElementById('nm');
  var element = document.getElementById('ty');
  
  var clone = element.cloneNode(false); 
  dump('element='+element+'\n');
  dump('clone='+clone+'\n');


}

</script>

<script language="javascript">
function addq() {
var add=document.form1.qry.value;
var term=document.form1.trm1.value;
var typ=document.form1.type.value;

add=add+"["+typ+"]{"+term+"} ";
document.form1.qry.value=add;
document.form1.trm1.value="";
}

function clr() {
document.form1.qry.value="";
}

</script>

<script language="javascript">
function addq() {
var add=document.form1.qry.value;
var term=document.form1.trm1.value;
var typ=document.form1.type.value;

add=add+"["+typ+"]{"+term+"} ";
document.form1.qry.value=add;
document.form1.trm1.value="";
}
function op(opt) {
var add=document.form1.qry.value;
var op=opt;
add=add+op+" ";
document.form1.qry.value=add;
}

function lbrac() {
var add=document.form1.qry.value;
add=add+"(";
document.form1.qry.value=add;
}
function rbrac() {
var add=document.form1.qry.value;
add=add+")";
document.form1.qry.value=add;
}

</script>
<script language="JavaScript" type="text/javascript">
<!--
function checkform ( form )
{
  
   if(form.qry.value == "") {
    alert( "Please enter value." );
    return false ;
  }
  // ** END **
  return true ;
}
//-->
</script>

<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-weight: bold;
}
.style5 {
	font-size: 16px;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
	color: #000000;
}
.style6 {
	font-size: 14pt;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #990000;
}
.style8 {color: #CC6600}
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12pt;
	color: #000000;
}
-->
</style>
<script language="javascript" src="css/jsval.js">
    </script>
<script type="text/javascript" src="css/dropdown.js"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
a:link {
	text-decoration: none;
	color: #900;
}
a:visited {
	text-decoration: none;
	color: #930;
}
a:hover {
	text-decoration: none;
	color: #930;
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
-->
</style>
</head>

<body topmargin="0" leftmargin="0" onLoad="initListGroup('vehicles', document.forms[0].make, document.forms[0].type, document.forms[0].model, 'save')" >
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center" >
 
  <tr>
    <td width="75%" valign="top" bgcolor="#FFFFFF">
    <p align="center">&nbsp;</p>
    <h2 align="center">Advanced Search <sup><a href="help.php#advancesearch"><i style="font-size:12px;color:#1DA8BF" class="fa fa-question-circle" ></i></a></sup></h2>
    <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td valign="middle">
          
         
		    <form name="form1" method="post" action="advsrch1.php" onSubmit="return checkform(this);">
            <table width="90%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td colspan="3">
                
                
                <table width="90%" align="center" id="dataTable" cellpadding="0" cellspacing="0" align="center">
                  <tr >
                    <td><div align="left"></div></td>
                    <td><div align="center" class="style61">Select section</div></td>
                    <td colspan="2" align="left"><select name="make" style="width:150px;">
                    </select></td>
                  </tr>
                  
                  
                  <tr>
                  <td width="8%" height="40"><?php //<INPUT type="checkbox" name="chk[]"/> ?></td>
                    <td width="20%" valign="bottom"><div align="center" class="style61">Enter keyword </div></td>
                    <td width="35%" align="left" valign="bottom"><input type="text" name="trm1" id="tm"></td>
                    
                    <td width="35%" valign="bottom"><div class="style61">Field 
                      <select name="type" style="width:150px;" id="ty">
</select></div></td>
                  </tr>
                </table>
                
                </td>
                <td width="25%" valign="bottom"><div align="left">
                  <?php //<INPUT type="button" value="Add" onClick="addRow('dataTable')" /><INPUT type="button" value="Delete" onClick="deleteRow('dataTable')" /> ?>
                  <input type="button" name="Add" value="Add" onClick="addq();">
                </div></td>
              </tr>
              <tr>
                <td width="2%" height="52">&nbsp;</td>
                <td width="20%">&nbsp;</td>
                <td width="50%"><div align="center">
                  <input name="AND" type="button" id="AND" value="AND" onClick="op(this.value);">
                  <input name="OR" type="button" id="OR" value="OR" onClick="op(this.value);">
                  <input name="brac1" type="button" id="brac1" value="(" onClick="lbrac();">
                  <input name="brac2" type="button" id="brac2" value=")" onClick="rbrac();">
                </div></td>
                <td valign="bottom">&nbsp;</td>
              </tr>
              <tr>
                <td height="52">&nbsp;</td>
                <td><p align="right"><strong>Query  </strong></p></td>
                <td><textarea name="qry" cols="50" rows="4" readonly="readonly"><?php echo $_POST["qry"]; ?></textarea></td>
                <td valign="bottom">&nbsp;</td>
              </tr>
            </table>
            <p align="center">
              <input type="submit" name="Submit" value="Submit">
              <input name="Clear" type="button" id="Clear" value="Reset" onclick="clr();" />
            </p>
			
</form>
             <tr><td align ="center" ><p> <strong>Note: </strong>Queries can be build combining options using 'AND', 'OR' from one section at a time. </p></td> </tr>
          </td>
        </tr>
      </table></td>
  </tr>
  
  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
      <tr>
        
        
        <td width="25%" bgcolor="#46439a"><div align="center" class="style1"><strong><a href="stats.php"><font color="#ffffff">Statistics </font></a></strong></div></td>                                                                                           <td width="25%" bgcolor="#46439a"><div align="center" class="style1"><strong><a href="aboutus.php"><font color="#ffffff">About BIC</font></a></strong></div></td>
        <td width="25%" bgcolor="#46439a"><div align="center" class="style1"><strong><a href="feedback.php"><font color="#ffffff">Feedback</font></a></strong></div></td>
        
        <td width="25%" bgcolor="#46439a"><div align="center" class="style1"><strong><a href='contact.php'><font color="#ffffff">Contact Us</font></a></strong></div></td>
        
      </tr>
    </table></td>
  </tr>
</table>
<blockquote>
<p align="center" class="style13">
     | © 2020,  Biomedical Informatics Centre, NIRRH |<br/>
    National Institute for Research in Reproductive Health, Jehangir Merwanji Street, Parel, Mumbai-400   012<br>
    Tel: 91-22-24192104, Fax No: 91-22-24139412</p>
</blockquote>
    

</body>
</html>