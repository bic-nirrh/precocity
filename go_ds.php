<?php
session_start();
include("head.php");
$x=0;

if(isset($_REQUEST['qry']))
{
$qry=$_REQUEST["qry"];
$_SESSION["qry"]=$qry;
}
else
{
	$qry=$_SESSION["qry"];
}


$typea=str_replace(' ', '%20', $type);
$sep=$_REQUEST["page"];
		$x=$sep*$limit;
		$y=$x+$limit;
	
			
			$rrs=mysql_query("select count(DISTINCT go_id) as numm from gene2go where go_function LIKE '%$qry%' or go_id like '%$qry%' or type like '%$qry%' or geneSymbol like '%$qry%'");
			$ress=mysql_query("select go_function, go_id, type from gene2go where go_function LIKE '%$qry%' or go_id like '%$qry%' or type like '%$qry%' or geneSymbol like '%$qry%' GROUP BY go_id ORDER BY COUNT(*) DESC");
			
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
        <td><h2 align="center">&nbsp;</h2>
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
    </table></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">&nbsp;</td>
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