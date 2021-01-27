<?php
session_start();
include("head.php");
$x=0;
$lnk=$_REQUEST["lnk"];
mysql_query("SET SESSION group_concat_max_len = 1000000");
if(($_POST["bttn"]=="Reset Page") or ($_POST["sho2"]=="GO") or ($_REQUEST["page"]=="0") or ($_POST["sho"]=="GO"))
{
	$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
}
if(isset($_REQUEST['qry']))
{
$qry=$_REQUEST["qry"];
$_SESSION["qry"]=$qry;
}
else
{
	$qry=$_SESSION["qry"];
}
if(isset($_REQUEST['limit']))
{
$limit=$_REQUEST['limit'];
$_SESSION["limit"]=$limit;
}
else
{
	$limit=$_SESSION["limit"];
	if($limit==0)
	{
	$limit=10;
	}
}
if(isset($_REQUEST['char']))
{
$char=$_REQUEST["char"];
$_SESSION["char"]=$char;
}
else
{
	$char=$_SESSION["char"];
}
if(isset($_REQUEST['limitt']))
{
$type=$_REQUEST["limitt"];
$_SESSION["limitt"]=$type;

}
else
{
	$type=$_SESSION["limitt"];
}

$typea=str_replace(' ', '%20', $type);
$sep=$_REQUEST["page"];
		$x=$sep*$limit;
		$y=$x+$limit;
		if($type== "all" or $type == "")
		{
		if(($char=="all") or ($char==""))
		{
			if($qry == "")
			{
			$rrs=mysql_query("select count(DISTINCT go_id) as numm from gene2go");
			$ress=mysql_query("SELECT go_id, go_function, type from gene2go GROUP BY go_id ORDER BY COUNT(*) DESC  LIMIT $x, $limit");
			//echo "SELECT go_id, go_function, type from gene2go GROUP BY go_id ORDER BY COUNT(*) DESC  LIMIT $x, $limit";
			}
			elseif($qry != "")
			{
			$rrs=mysql_query("select count(DISTINCT go_id) as numm from gene2go where go_function LIKE '%$qry%' or go_id like '%$qry%' or type like '%$qry%' or geneSymbol like '%$qry%'");
			$ress=mysql_query("select go_function, go_id, type from gene2go where go_function LIKE '%$qry%' or go_id like '%$qry%' or type like '%$qry%' or geneSymbol like '%$qry%' GROUP BY go_id ORDER BY COUNT(*) DESC LIMIT $x, $limit");
			}
		}
		elseif($char != "" or $char != "all")
			{
				if($qry == "")
				{
				$rrs=mysql_query("select count(DISTINCT go_id) as numm from gene2go where go_function LIKE '$char%'");
				$ress=mysql_query("SELECT go_id, go_function, type from gene2go where go_function LIKE '$char%' GROUP BY go_id ORDER BY COUNT(*) DESC LIMIT $x, $limit");
				}
				elseif($qry != "")
				{
				$rrs=mysql_query("select count(DISTINCT go_id) as numm from gene2go where go_function LIKE '$char%' and (go_function LIKE '%$qry%' or type like '%$qry%' OR geneSymbol like '%$qry%'");
				$ress=mysql_query("SELECT go_id, go_function, type from gene2go where go_function LIKE '$char%' and (go_function LIKE '%$qry%' or type like '%$qry%' OR geneSymbol like '%$qry%') GROUP BY go_id ORDER BY COUNT(*) DESC LIMIT $x, $limit");
				}
			}
		}
		elseif($type != "all" or $type !="")
		{
			if(($char=="all") or ($char==""))
		{
			if($qry == "")
			{
			$rrs=mysql_query("select count(DISTINCT go_id) as numm from gene2go where type = '$type'");
			$ress=mysql_query("SELECT go_id, go_function, type from gene2go where type = '$type' GROUP BY go_id ORDER BY COUNT(*) DESC  LIMIT $x, $limit");
			}
			elseif($qry != "")
			{
			$rrs=mysql_query("select count(DISTINCT go_id) as numm from gene2go where (go_function LIKE '%$qry%'or  go_id like '%$qry%' OR geneSymbol like '%$qry%') and (type = '$type') ");
			$ress=mysql_query("select go_function, go_id, type from gene2go where (go_function LIKE '%$qry%' or go_id like '%$qry%' or type like '%$qry%' OR geneSymbol like '%$qry%') and (type = '$type') GROUP BY go_id ORDER BY COUNT(*) DESC LIMIT $x, $limit");
			}
		}
		elseif($char != "" or $char != "all")
			{
				if($qry == "")
				{
				$rrs=mysql_query("select count(DISTINCT go_id) as numm from gene2go where (go_function LIKE '$char%') and (type = '$type')");
				$ress=mysql_query("SELECT go_id, go_function, type from gene2go where (go_function LIKE '$char%') and (type = '$type') GROUP BY go_id ORDER BY COUNT(*) DESC LIMIT $x, $limit");
				}
				elseif($qry != "")
				{
				$rrs=mysql_query("select count(DISTINCT go_id) as numm from gene2go where (go_function LIKE '$char%' and go_function LIKE '%$qry%') and type = '$type'");
				$ress=mysql_query("SELECT go_id, go_function, type from gene2go where go_function LIKE '$char%' and (go_function LIKE '%$qry%' and type = '$type') GROUP BY go_id ORDER BY COUNT(*) DESC LIMIT $x, $limit");
				}
			}
			
		}
		while($ass1=mysql_fetch_array($rrs))
		{$mumm=$ass1["numm"];}
		
		$num=mysql_num_rows($ress);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel ="icon" type="image/ico" href="favicon.ico"></link>
<link rel ="shortcut icon" href="favicon.ico"></link>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name='description' content='PCOS database provides complete information about PCOS and associated diseases, manually genetic data with gene and mutation.' />
<meta name='keywords' content='PCOS, polycystic, ovarian, syndrome, database, knowledgebase' />

<title>Associated Ontology Terms: Polycystic Ovarian Syndrome Database</title>
<link href='css/style1.css' type='text/css' rel='stylesheet' />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script language="javascript" src="css/jsval.js">
    </script>
<script type="text/javascript" src="css/dropdown.js"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.js"></script>
<script>
jQuery(function($){
$(".expander").click(function() {
    if ($(this).hasClass("expander")) {
        $(this).removeClass("expander");	 
    }
    else {
         $(this).addClass("expander");
    } 
	})
});
</script>
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
.expander {
    height: 3.9em;
    overflow: hidden;
    cursor: pointer;
}
body,td,th {
	font-size: 10pt;
	color: #000;
	font-family: Verdana, Geneva, sans-serif;
}
body {
	background-color: #E0E0E0;
}
-->
</style></head>


<body topmargin="0" leftmargin="0" >
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center" >
 
  
  <tr>
    <td bgcolor="#FFFFFF">
    <table width="100%" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td><h2 align="center">Ontologies associated with precocious puberty<sup> <a href="help.php#ontology"><i style="font-size:12px;color:#1DA8BF" class="fa fa-question-circle" ></i></a></sup></h2>
          <table width="98%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
              <td ><form id="form5" name="form4" method="post" action="go_d.php">
                <div align="left"><strong>Filter
                  <select name="limitt" id="limitt">
                    <?php
          if(($type=='') or ($type=='all'))
		  {}
		  else
		  { if($type=="biological process")
		  {
			  $limitta = "Biological process";}
			  if($type=="molecular function")
		  {
			  $limitta = "Molecular function";}
			  if($type=="cellular component")
		  {
			  $limitta = "Cellular component";}
		  ?>
                    <option value="<?php echo $type; ?>" selected="selected"><?php echo $limitta; ?></option>
                    <?php } ?>
                    <option value="">All</option>
                    <option value="biological process">Biological process</option>
                    <option value="molecular function">Molecular function</option>
                    <option value="cellular component">Cellular component</option>
                  </select>
                  </strong>
                  <input name="sho" type="submit" value="GO" />
                </div>
              </form></td>
              <td width="44%"></td>
              <td></td>
            </tr>
            <tr>
              <td width="27%" height="29"><form id="form6" name="form5" method="post" action="go_d.php">
                <input name="qry" type="text" />
                <strong>
                  <input type="hidden" name="limitt" value="<?php echo $type; ?>" />
                  </strong>
                <input name="sear" type="submit" value="Search" />
              </form></td>
              <td><div align="center"><strong>
                <?php if ($qry=='') {?>
                <?php } else echo "Query term: ".$qry;?>
              </strong></div></td>
              <td><form id="form4e" name="form4e" method="post" action="go_d.php">
                <div align="right">Show
                  <select name="limit" id="limit">
                    <option value="10">10</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="<?php echo $mumm; ?>">All</option>
                  </select>
         <input type="hidden" name="limitt" value="<?php echo $type; ?>" />
        <input type="hidden" name="qry" value="<?php echo $qry; ?>" />
        <input type="hidden" name="char" value="<?php echo $char; ?>" />
                  <input name="shoh" type="submit" value="GO" />
                </div>
              </form></td>
            </tr>
            <tr>
              <td><strong>
                <?php $y1=$y; if($y1 > $mumm){$y1=$mumm;} echo ($x+1)." to ".$y1." of ".$mumm." Ontology terms"; ?>
              </strong></td>
              <td></td>
              <td width="29%"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
                <tr>
                  <td>&nbsp;</td>
                  <td width="25%"><form id="form9" name="form1" method="post" action="go_d.php?char=<?php echo $char; ?>&amp;qry=<?php echo $qry; ?>">
                    <input name="s2" type="submit" <?php if($sep==0){ ?>disabled="disabled" <?php } ?> value="&lt;&lt;" />
                  </form></td>
                  <td width="25%"><form id="form10" name="form2" method="post" action="go_d.php?page=<?php echo $sep-1; ?>&amp;char=<?php echo $char; ?>&amp;qry=<?php echo $qry; ?>">
                    <input type="submit"  <?php if($sep==0){ ?>disabled="disabled" <?php } ?> name="button2" id="button2" value="&lt;"/>
                  </form></td>
                  <td width="25%"><form id="form11" name="form2" method="post" action="go_d.php?page=<?php echo $sep+1; ?>&amp;char=<?php echo $char; ?>&amp;qry=<?php echo $qry; ?>">
                    <input type="submit" name="button2" <?php if($y>=$mumm){ ?>disabled="disabled" <?php } ?> id="button2" value="&gt;" />
                  </form></td>
                  <td width="25%"><form id="form5" name="form2" method="post" action="go_d.php?page=<?php $mumm1=$mumm-($mumm%10);
			if(($mumm%10) ==0)
			{ echo ($mumm1/10)-1; }
			else{
			echo $mumm1/10; } ?>&amp;char=<?php echo $char; ?>&amp;qry=<?php echo $qry; ?>">
                    <input type="submit" name="button2" <?php if($y>=$mumm){ ?>disabled="disabled" <?php } ?> id="button2" value="&gt;&gt;" />
                  </form></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <?php 
		
		
		if($num>0)
		{
		?>
          <table width="100%" border="0" cellspacing="1" cellpadding="6">
          
            <tr align="center" valign="top" bgcolor="#DEEDEF">
              <td width="25%" align="left"><strong>Ontology Term</strong></td>
              <td width="9%" align="left"><strong>Accession</strong></td>
              <td width="15%" align="left"><strong>Ontology Type</strong></td>
              <td width="51%" align="left"><strong>Gene Symbol</strong></td>
            </tr>
            <tr><td colspan="4">
            
            <?php $i=1;
  while($row1=mysql_fetch_array($ress))
	{ 
	$function=$row1["go_function"];
	$go_id=$row1["go_id"];
	$type=$row1["type"];
	$res=mysql_query("select distinct group_concat(DISTINCT geneSymbol separator ', ') as geneSymbol from gene2go where go_id='$go_id' order by geneSymbol");
	//echo "select distinct group_concat(DISTINCT geneSymbol separator ', ') as geneSymbol from gene2go where go_id='$go_id' order by geneSymbol";
	$num1=mysql_num_rows($res);
	?><div class="expander"><table width="100%" border="0" cellspacing="1" cellpadding="3">
            <tr <?php if($i%2 == 0){ ?>bgcolor="#DEEDEF" <?php }?>>
              <td rowspan="<?php
			   echo $num1+1; ?>" valign="top"  width="25%" align = "justify"><a href="http://amigo.geneontology.org/amigo/term/<?php echo $go_id; ?>" target="_blank"><?php echo ucfirst($function); ?></a></td>
              
            </tr>
            <?php 
	
		if($num1>0)
		{
	?>
            <?php while($row2=mysql_fetch_array($res))
	{ $gene=$row2["geneSymbol"];
		$ga= explode(",",$gene);
$gc=0;
	?>
            <tr <?php if($i%2 == 0){ ?>bgcolor="#DEEDEF" <?php }?> >
            <td valign="top" align = "justify" width="8%" >
            <?php 
				  
				  echo "<a href='http://amigo.geneontology.org/amigo/term/$go_id' target = '_blank'>$go_id</a>"; ?></td>
              <td valign="top" width="15%" ><?php echo ucfirst($type); ?></td>
              <td valign="top" align = "justify" width="50%" ><div><?php

		foreach ($ga as $g)
		{ 
		
		#echo "gc is $gc";
		//$gaa = "";
		$gaa=trim($g); 
		if($gc == 0)
		{
		$gg="<a href='gene_det.php?gene=$gaa' target='_blank'>$gaa<a/>";
		}
		else
		{
		$gg=$gg.", <a href='gene_det.php?gene=$gaa' target='_blank'>$gaa<a/>";
		}
		$gc++;
		
			}
		echo "<div align=justify>".$gg."</div>";   ?>
        <!--<a id="more" href="#">more...</a></div>
        -->
        </td>
            </tr></table>
          </div>
            <?php } ?>
            <?php		} ?>
            <?php $i++; }  ?>
          </td></tr></table>
          <?php 
		    
	} ?></td>
      </tr>
    </table>
    <h3 align="center">&nbsp;</h3></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
          <tr>
		  <td width="33%">
          <div align="center">
            <?php if($lnk=="qse")
		  {
			  ?>
          </div>
          <form id="form7" name="form7" method="post" action="search1.php">
            <div align="center">
              <input name="qury" type="hidden" value="<?php echo $qry; ?>" />
              <input type="submit" name="bttn" id="bttn" value="Back" />
            </div>
          </form>
            <div align="center">
              <?php } ?>
            </div></td>
            <td width="38%"><form id="form12" name="form7" method="post" action="go_d.php">
              <div align="center">
                <input type="submit" name="bttn2" id="bttn2" value="Reset Page" />
              </div>
            </form></td>
            <td width="1%"></td>
            <td width="28%"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
          <tr>
            <td><td width="25%"><form id="form1" name="form1" method="post" action="go_d.php?char=<?php echo $char; ?>&qry=<?php echo $qry; ?>">
            <input name="s1" type="submit" <?php if($sep==0){ ?>disabled="disabled" <?php } ?> value="&lt;&lt;" />
            
            </form></td>
            <td width="25%"><form id="form2" name="form2" method="post" action="go_d.php?page=<?php echo $sep-1; ?>&char=<?php echo $char; ?>&qry=<?php echo $qry; ?>">
              <input type="submit"  <?php if($sep==0){ ?>disabled="disabled" <?php } ?> name="button" id="button" value="<"/>
            </form></td>
            <td width="25%"><form id="form3" name="form2" method="post" action="go_d.php?page=<?php echo $sep+1; ?>&char=<?php echo $char; ?>&qry=<?php echo $qry; ?>">
              <input type="submit" name="button" <?php if($y>=$mumm){ ?>disabled="disabled" <?php } ?> id="button" value=">" />
            </form></td>
            <td width="25%"><form id="form4" name="form2" method="post" action="go_d.php?page=<?php $mumm1=$mumm-($mumm%10);
			if(($mumm%10) ==0)
			{ echo ($mumm1/10)-1; }
			else{
			echo $mumm1/10; } ?>&char=<?php echo $char; ?>&qry=<?php echo $qry; ?>">
              <input type="submit" name="button" <?php if($y>=$mumm){ ?>disabled="disabled" <?php } ?> id="button" value=">>" />
            </form></td>
            </tr>
        </table>
                      </td>
      </tr>
    </table>
    </td>
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
    </td>
  </tr>
 <tr>
    <td></td>
  </tr>
</table>
<blockquote>
<p align="center" class="style13">
     | © 2020,  Biomedical Informatics Centre, NIRRH |<br/>
    ICMR-National Institute for Research in Reproductive Health, Jehangir Merwanji Street, Parel, Mumbai-400   012<br>
    Tel: 91-22-24192104, Fax No: 91-22-24139412</p>
    </blockquote>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
    

</body>
</html>