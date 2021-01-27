<?php
session_start();

include("head.php");
mysql_query("SET SESSION group_concat_max_len = 1000000");

if(($_POST["bttn"]=="Reset Page") or ($_POST["sho"]=="GO") or ($_REQUEST["page"]=="0"))
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
$db=$_REQUEST["limitt"];
$_SESSION["limitt"]=$db;
}
else
{
	$db=$_SESSION["limitt"];
}

$sep=$_REQUEST["page"];
		
		$x=$sep*$limit;
		$y=$x+$limit;
#echo "database selected is $db"."<br>";		
	if($db =="all" or $db =="")
	{
		if(($char=="all") or ($char==""))
		{
			if ($qry == "")
			{
			$rrs=mysql_query("select count(DISTINCT pathwayname) as numm from kegg_path,gene where kegg_path.entrezid = gene.entrez_gene UNION select count(DISTINCT pathwayname) as numm from reactome, gene where reactome.entrezid = gene.entrez_gene");
			$ress=mysql_query( "SELECT distinct pathwayname, pathwayid, group_concat( distinct geneSymbol separator ', ') as geneSymbol,group_concat(distinct entrezid separator ', ') as entrezid FROM kegg_path, gene where kegg_path.entrezid = gene.entrez_gene group by pathwayname UNION  SELECT pathwayname,pathwayid, group_concat( distinct geneSymbol separator ', ') as geneSymbol,group_concat(distinct entrezid separator ', ') as entrezid FROM reactome, gene where reactome.entrezid = gene.entrez_gene GROUP BY pathwayname order by pathwayid LIMIT $x, $limit");
			}
			elseif($qry != "")
			{
			$rrs=mysql_query( "select count(DISTINCT pathwayname) as numm from kegg_path,gene where kegg_path.entrezid = gene.entrez_gene and pathwayname like '%$qry%' UNION select count(DISTINCT pathwayname) as numm from reactome, gene where reactome.entrezid = gene.entrez_gene and pathwayname like '%$qry%'");
			$ress=mysql_query( "SELECT distinct pathwayname, pathwayid, group_concat( distinct geneSymbol separator ', ') as geneSymbol,group_concat(distinct entrezid separator ', ') as entrezid FROM kegg_path, gene where kegg_path.entrezid = gene.entrez_gene and pathwayname Like '%$qry%' group by pathwayname UNION  SELECT pathwayname,pathwayid, group_concat( distinct geneSymbol separator ', ') as geneSymbol,group_concat(distinct entrezid separator ', ') as entrezid FROM reactome, gene where reactome.entrezid = gene.entrez_gene and pathwayname Like '%$qry%' GROUP BY pathwayname ORDER BY pathwayid LIMIT $x, $limit");
				
			}
		}
		elseif($char != "all" or $char != "")
		{
			if($qry=="")
			{
			$rrs=mysql_query( "select count(DISTINCT pathwayname) as numm from kegg_path,gene where kegg_path.entrezid = gene.entrez_gene and pathwayname like '$char%' UNION select count(DISTINCT pathwayname) as numm from reactome, gene where reactome.entrezid = gene.entrez_gene and pathwayname like '$char%'");
			$ress=mysql_query( "SELECT distinct pathwayname, pathwayid, group_concat( distinct geneSymbol separator ', ') as geneSymbol,group_concat(distinct entrezid separator ', ') as entrezid FROM kegg_path, gene where kegg_path.entrezid = gene.entrez_gene and pathwayname Like '$char%' group by pathwayname UNION  SELECT pathwayname,pathwayid, group_concat( distinct geneSymbol separator ', ') as geneSymbol,group_concat(distinct entrezid separator ', ') as entrezid FROM reactome, gene where reactome.entrezid = gene.entrez_gene and pathwayname Like '$char%' GROUP BY pathwayname ORDER BY pathwayid LIMIT $x, $limit");
			}
			elseif($qry != "")
			{
			$rrs=mysql_query( "select count(DISTINCT pathwayname) as numm from kegg_path,gene where kegg_path.entrezid = gene.entrez_gene and (pathwayname like '%$qry%' and pathwayname like '$char%') UNION select count(DISTINCT pathwayname) as numm from reactome, gene where reactome.entrezid = gene.entrez_gene and (pathwayname like '%$qry%' and pathwayname like '$char%')");
			$ress=mysql_query( "SELECT distinct pathwayname, pathwayid, group_concat( distinct geneSymbol separator ', ') as geneSymbol,group_concat(distinct entrezid separator ', ') as entrezid FROM kegg_path, gene where kegg_path.entrezid = gene.entrez_gene and (pathwayname like '%$qry%' and pathwayname like '$char%') group by pathwayname UNION  SELECT pathwayname,pathwayid, group_concat( distinct geneSymbol separator ', ') as geneSymbol,group_concat(distinct entrezid separator ', ') as entrezid FROM reactome, gene where reactome.entrezid = gene.entrez_gene and (pathwayname like '%$qry%' and pathwayname like '$char%') GROUP BY pathwayname ORDER BY pathwayid LIMIT $x, $limit");
			}
		}
		
	}
	elseif($db != "" or $db !== "all")
		{
			if($char == "" )
			{
				if ($qry == "")
				{
				$rrs = mysql_query( "select count(DISTINCT pathwayname) as numm from $db,gene where $db.entrezid = gene.entrez_gene GROUP BY pathwayid ORDER BY pathwayname");
				$ress=mysql_query( "SELECT distinct pathwayname, pathwayid, group_concat( distinct geneSymbol separator ', ') as geneSymbol,group_concat(distinct entrezid separator ', ') as entrezid FROM $db,gene where $db.entrezid = gene.entrez_gene GROUP BY pathwayid ORDER BY pathwayname LIMIT $x, $limit");
				}
				elseif($qry != "")
				{
				$rrs = mysql_query( "select count(DISTINCT pathwayname) as numm from $db,gene where $db.entrezid = gene.entrez_gene and pathwayname like '%$qry%' GROUP BY pathwayid ORDER BY pathwayname");
				$ress=mysql_query( "SELECT distinct pathwayname, pathwayid, group_concat( distinct geneSymbol separator ', ') as geneSymbol,group_concat(distinct entrezid separator ', ') as entrezid FROM $db,gene where $db.entrezid = gene.entrez_gene and pathwayname like '%$qry%' GROUP BY pathwayid ORDER BY pathwayname LIMIT $x, $limit");
				}
			}
			elseif($char != "" or $char != "all")
			{
				if($qry == "")
				{
				$rrs = mysql_query( "select count(DISTINCT pathwayname) as numm from $db,gene where $db.entrezid = gene.entrez_gene and pathwayname like '$char%' GROUP BY pathwayid ORDER BY pathwayname");
				$ress=mysql_query( "SELECT distinct pathwayname, pathwayid, group_concat( distinct geneSymbol separator ', ') as geneSymbol,group_concat(distinct entrezid separator ', ') as entrezid FROM $db,gene where $db.entrezid = gene.entrez_gene and pathwayname like '$char%' GROUP BY pathwayid ORDER BY pathwayname LIMIT $x, $limit");
				}
				elseif($qry != "" )
				{
				$rrs = mysql_query( "select count(DISTINCT pathwayname) as numm from $db,gene where $db.entrezid = gene.entrez_gene and (pathwayname like '$char%' and pathwayname like '%$qry%') GROUP BY pathwayid ORDER BY pathwayname");
				$ress=mysql_query( "SELECT distinct pathwayname, pathwayid, group_concat( distinct geneSymbol separator ', ') as geneSymbol,group_concat(distinct entrezid separator ', ') as entrezid FROM $db,gene where $db.entrezid = gene.entrez_gene and (pathwayname like '$char%' and pathwayname like '%$qry%') GROUP BY pathwayid ORDER BY pathwayname LIMIT $x, $limit");
				}
			}
		}
		while($ass1=mysql_fetch_array($rrs))
		{
			
			$mumm+=$ass1["numm"];
		}
		
		
		$num=mysqli_num_rows($ress);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel ="icon" type="image/ico" href="favicon.ico"></link>
<link rel ="shortcut icon" href="favicon.ico"></link>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name='description' content='precocious puberty database provides complete information about precocious puberty and genetic data with gene and mutation.' />
<meta name='keywords' content='precocious puberty, syndrome, database, knowledgebase' />

<title>Pathways: precocious puberty</title>
<link href='css/style1.css' type='text/css' rel='stylesheet' />
<script language="javascript" src="css/jsval.js">
    </script>
<script type="text/javascript" src="css/dropdown.js"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    
    <table width="98%" border="0" align="center" cellpadding="10" cellspacing="0">
	
      <tr>
        <td>
        <h2 align="center">Pathways associated with precocious puberty<sup><a href="help.php#brpathway"><i style="font-size:12px;color:#1DA8BF" class="fa fa-question-circle" ></i></a></sup></h2>
        
        <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
    <td height="45"><form id="form4" name="form4" method="post" action="pathway.php">
      <div align="left"><strong>Filter 
          <select name="limitt" id="limitt">
           <?php if(($db=="") or ($db=="all"))
		  {}
		  else
		  {if($db=="kegg_path")
		  { $dbs="KEGG";}
		  elseif($db=="reactome")
		  { $dbs="Reactome";
		  }
		  
			  ?>
              <option value="<?php echo $db; ?>" selected="selected"><?php echo $dbs; ?></option>
              <?php
		  } ?>
            <option value="">All</option>
            <option value="kegg_path">KEGG</option>
            <option value="reactome">Reactome</option>
          </select>
      </strong>
		<input name="sho" type="submit" value="GO" />
      </div>
    </form></td>
    <td></td><td><form id="form4e" name="form4e" method="post" action="pathway.php">
      <div align="right">Show
<select name="limit" id="limit">
        
          <option value="10">10</option>
          <option value="50">50</option>
          <option value="100">100</option>
          <option value="<?php echo $mumm; ?>">All</option>
        </select>
        <input type="hidden" name="limitt" value="<?php echo $db; ?>" />
        <input type="hidden" name="qry" value="<?php echo $qry; ?>" />
        <input type="hidden" name="char" value="<?php echo $char; ?>" />
        <input name="shoh" type="submit" value="GO" />
      </div>
    </form></td>
	<tr>
    <td width="29%" valign="bottom"><form id="form5" name="form5" method="post" action="pathway.php"><input name="qry" type="text" />
    <input type="hidden" name="limitt" value="<?php echo $db; ?>" />
    <input name="sear" type="submit" value="Search" />
    </form></td>
    <td width="42%"><h3 align="center"><strong><?php if ($qry=='') {?>
    <?php } else echo "Query term: ".$qry;?></strong></h3></td>
    <td width="29%" valign="bottom"><form id="form4" name="form4" method="post" action="pathway.php">
      <div align="right">Search by alphabet
        <select name="char" id="select">
         <?php if(($char=="") or ($char=="all"))
		  {}
		  else
		  {
			  ?>
              <option value="<?php echo $char; ?>" selected="selected"><?php echo $char; ?></option>
              <?php
		  } ?>
        <option value="all">All</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
          <option value="D">D</option>
          <option value="E">E</option>
          <option value="F">F</option>
          <option value="G">G</option>
          <option value="H">H</option>
          <option value="I">I</option>
          <option value="J">J</option>
          <option value="K">K</option>
          <option value="L">L</option>
          <option value="M">M</option>
          <option value="N">N</option>
          <option value="O">O</option>
          <option value="P">P</option>
          <option value="Q">Q</option>
          <option value="R">R</option>
          <option value="S">S</option>
          <option value="T">T</option>
          <option value="U">U</option>
          <option value="V">V</option>
          <option value="W">W</option>
          <option value="X">X</option>
          <option value="Y">Y</option>
          <option value="Z">Z</option>
        </select>
        <input type="hidden" name="limitt" value="<?php echo $db; ?>" />
        <input name="sho" type="submit" value="GO" />
      </div>
    </form></td>
  </tr>
</table>

 
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
          <tr>
            <td width="70%" height="38"><strong><?php $y1=$y; if($y1 > $mumm){$y1=$mumm;} echo ($x+1)." to ".$y1." of ".$mumm." Pathways"; ?></strong></td><td width="30%"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
          <tr>
            <td><td width="25%"><form id="form1" name="form1" method="post" action="pathway.php?char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&db=<?php echo $db; ?>">
            <input name="s1" type="submit" <?php if($sep==0){ ?>disabled="disabled" <?php } ?> value="&lt;&lt;" />
            
            </form></td>
            <td width="25%"><form id="form2" name="form2" method="post" action="pathway.php?page=<?php echo $sep-1; ?>&char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&db=<?php echo $db; ?>">
              <input type="submit"  <?php if($sep==0){ ?>disabled="disabled" <?php } ?> name="button" id="button" value="<"/>
            </form></td>
            <td width="25%"><form id="form3" name="form2" method="post" action="pathway.php?page=<?php echo $sep+1; ?>&char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&db=<?php echo $db; ?>">
              <input type="submit" name="button" <?php if($y>=$mumm){ ?>disabled="disabled" <?php } ?> id="button" value=">" />
            </form></td>
            <td width="25%"><form id="form4" name="form2" method="post" action="pathway.php?page=<?php $mumm1=$mumm-($mumm%10);
			if(($mumm%10) ==0)
			{ echo ($mumm1/10)-1; }
			else{
			echo $mumm1/10; } ?>&char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&db=<?php echo $db; ?>">
              <input type="submit" name="button" <?php if($y>=$mumm){ ?>disabled="disabled" <?php } ?> id="button" value=">>" />
            </form></td>
            </tr>
        </table>
            </td></tr></table>
		
        <table width="100%" border="0" cellspacing="1" cellpadding="6" bordercolor="#000000">
  <tr align="center" valign="top" bgcolor="#DEEDEF">
    <td width="24%" align="left"><strong>Pathway</strong></td>
    <td width="16%" align="left"><strong>Pathway ID</strong></td>
    <td width="30%" align="left"><strong>Gene Symbol</strong></td>
    <td width="30%" align="left"><strong>Entrez Gene ID</strong></td>
  </tr>
  <?php $i=1;
  while($row1=mysql_fetch_array($ress))
	{ $pathway=$row1["pathwayname"];
	$pathway_id=$row1["pathwayid"];
	$gene = $row1["geneSymbol"];
	$gid =$row1["entrezid"];
	/*$res=mysql_query( "select * from kegg_path where pathwayname='$pathway' UNION select * from reactome where pathwayname='$pathway' order by geneSymbol");
	$num1=mysqli_num_rows($res);
	while($row2=mysql_fetch_array($res))
	{ $gene=$row2["geneSymbol"];
	$kegg_id=$row2["pathwayid"];*/
		#echo "$i is i this time"."<br>";
	?>
  <tr <?php if($i%2 == 0){ ?>bgcolor="#DEEDEF" <?php } ?>>
  <?php if (strpos($pathway_id, "R-HSA-") === FALSE){ ?>
    <td rowspan="<?php echo $num1+1; ?>" valign="top" width="24%"><a href="http://www.genome.jp/kegg-bin/show_pathway?<?php echo $pathway_id; ?>" target="_blank"><?php echo $pathway; ?></a></td> 
    <td> <?php echo "$pathway_id"; ?> </td> <td align="justify"><?php $ga=explode(",",$gene); 
	$sig=0;
	$asda="";
	foreach($ga as $g){
		$g=trim($g);
	if($sig==0)
		{
			$asda= "<a href= 'gene_det.php?gene=$g' target='_blank'>$g</a>";
		}
		else
		{
			$asda= $asda.", <a href= 'gene_det.php?gene=$g' target='_blank'>$g</a>";
		}
	$sig++;
	} 
	echo $asda;
	?>
    
    
    </td><td align = "justify"><?php $gi=explode(",",$gid);
	$sig=0;
	$asda="";
	 foreach($gi as $g)
	{ $g=trim($g);
		if($sig==0)
		{
		 $asda= "<a href= 'https://www.ncbi.nlm.nih.gov/gene/$g' target='_blank'>$g</a>";
       
		}
		else
		{
			$asda= $asda.", <a href= 'https://www.ncbi.nlm.nih.gov/gene/$g' target='_blank'>$g</a>";
		}
		$sig++;
		}
		echo $asda;
		?></td> </tr>
    
    <?php 
  }
  
  else
  {?>
 <tr <?php if($i%2 == 0){ ?>bgcolor="#DEEDEF" <?php }?>>
 
	  <td rowspan="<?php echo $num1+1; ?>" valign="top" width="24%"><a href="https://reactome.org/PathwayBrowser/#/<?php echo $pathway_id; ?>" target="_blank"><?php echo $pathway; ?></a></td> 
	  <td> <?php  echo "$pathway_id"; ?> </td> <td align="justify"><?php $ga=explode(",",$gene); foreach($ga as $g){$g=trim($g);?> <a href= "gene_det.php?gene=<?php echo $g; ?>" target="_blank"><?php echo "$g";} ?></a></td><td align = "justify"><?php $gi=explode(",",$gid); $sig=0;
	$asda="";
	 foreach($gi as $g)
	{ $g=trim($g);
		if($sig==0)
		{
		 $asda= "<a href= 'https://www.ncbi.nlm.nih.gov/gene/$g' target='_blank'>$g</a>";
       
		}
		else
		{
			$asda= $asda.", <a href= 'https://www.ncbi.nlm.nih.gov/gene/$g' target='_blank'>$g</a>";
		}
		$sig++;
		}
		echo $asda;
		?>
      </td>
 </tr>
 <?php
 
  }
  $i++;
	}
	
	
		
	?>
		
			
	
    
    <?php 
	/*
	if($num1>0)
		{
	$ress1=mysql_query( "select approved_name from gene where gene_name='$gene'");
	while($row3=mysql_fetch_array($ress1))
	{ $approved_name=$row3["approved_name"];}
	$approved_name=ucfirst($approved_name);*/
	?>
    
   
  
  
</table>


            </td>
      </tr>
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
          <tr>
		  <td width="41%"><form id="form7" name="form7" method="post" action="pathway.php">
              <input type="submit" name="bttn" id="bttn" value="Reset Page" />
            </form></td>
            <td width="29%"></td><td width="30%"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
          <tr>
            <td width="2%"><td width="25%"><form id="form1" name="form1" method="post" action="pathway.php?char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&db=<?php echo $db; ?>">
            <input name="s1" type="submit" <?php if($sep==0){ ?>disabled="disabled" <?php } ?> value="&lt;&lt;" />
            
            </form></td>
            <td width="25%"><form id="form2" name="form2" method="post" action="pathway.php?page=<?php echo $sep-1; ?>&char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&db=<?php echo $db; ?>">
              <input type="submit"  <?php if($sep==0){ ?>disabled="disabled" <?php } ?> name="button" id="button" value="<"/>
            </form></td>
            <td width="26%"><form id="form3" name="form2" method="post" action="pathway.php?page=<?php echo $sep+1; ?>&char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&db=<?php echo $db; ?>">
              <input type="submit" name="button2" <?php if($y>=$mumm){ ?>disabled="disabled" <?php } ?> id="button2" value=">" />
            </form></td>
            <td width="22%"><form id="form4" name="form2" method="post" action="pathway.php?page=<?php $mumm1=$mumm-($mumm%10);
			if(($mumm%10) ==0)
			{ echo ($mumm1/10)-1; }
			else{
			echo $mumm1/10; } ?>&char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&db=<?php echo $db; ?>">
              <input type="submit" name="button" <?php if($y>=$mumm){ ?>disabled="disabled" <?php } ?> id="button" value=">>" />
            </form></td>
            </tr>
        </table>
            </td>
      </tr>
        </table>          <p>&nbsp;</p></td>
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