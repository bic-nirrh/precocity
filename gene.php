<?php
session_start();
include("head.php");
?>

<?php 


if(($_POST["bttn"]=="Reset Page") or ($_POST["shonw"]=="GO") or ($_REQUEST["page"]=="0") or ($_POST["sho"]=="GO"))
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
	$limit=10;
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
$limitt=$_REQUEST["limitt"];
$limitt=str_replace('%20', ' ', $limitt);
$_SESSION["limitt"]=$limitt;
}
else
{
	$limitt=$_SESSION["limitt"];
}

$sep=$_REQUEST["page"];
		$x=$sep*$limit;
		$y=$x+$limit;
		if(($limitt=="") or ($limitt=="all"))
		{
		if(($char=="") and ($qry == ""))
		{
		$rrs=mysql_query( "select count(DISTINCT gene_name) as numm from gene");
		$ress=mysql_query( "select DISTINCT gene_name from gene order by gene_name LIMIT $x, $limit");
		}
		elseif(($qry == "") and ($char != ""))
		{
		$rrs=mysql_query( "select count(DISTINCT gene_name) as numm from gene where gene_name LIKE '$char%'");
		$ress=mysql_query( "select DISTINCT gene_name from gene where gene_name LIKE '$char%' order by gene_name  LIMIT $x, $limit");
		}
		elseif(($qry != "") and ($char == ""))
		{
		$rrs=mysql_query( "select count(DISTINCT gene_name) as numm from gene where gene_name LIKE '%$qry%'");
		$ress=mysql_query( "select DISTINCT gene_name from gene where gene_name LIKE '%$qry%' order by gene_name  LIMIT $x, $limit");
		}}
		if(($limitt=="Other sources") or($limitt=="Expression study") or ($limitt=="Manually curated"))
		{ 
			if(($char=="") and ($qry == ""))
		{
		$rrs=mysql_query( "select count(DISTINCT gene_name) as numm from gene where status='$limitt'");
		$ress=mysql_query( "select DISTINCT gene_name from gene where status='$limitt' order by gene_name LIMIT $x, $limit");
		}
		elseif(($qry == "") and ($char != ""))
		{
		$rrs=mysql_query( "select count(DISTINCT gene_name) as numm from gene where status='$limitt' and (gene_name LIKE '$char%' OR aliases LIKE '$char%')");
		$ress=mysql_query( "select DISTINCT gene_name from gene where status='$limitt' and (gene_name LIKE '$char%'  OR aliases LIKE '$char%') order by gene_name  LIMIT $x, $limit");
		}
		elseif(($qry != "") and ($char == ""))
		{
		$rrs=mysql_query( "select count(DISTINCT gene_name) as numm from gene where status='$limitt' and gene_name LIKE '%$qry%'");
		$ress=mysql_query( "select DISTINCT gene_name from gene where status='$limitt' and gene_name LIKE '%$qry%' order by gene_name  LIMIT $x, $limit");
		}
		}
		while($ass1=mysql_fetch_array($rrs))
		{$mumm=$ass1["numm"];}
		
		$num=mysql_num_rows($ress);
?>

<table width="90%" border="0" cellspacing="0" cellpadding="6" bgcolor="#FFFFFF" align="center">
  <tr>
    <td><table width="98%" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td>
        <h2 align="center"><strong>Genes associated with precocious puberty </strong><sup><a href="help.php#brgenes"><i style="font-size:12px;color:#1DA8BF" class="fa fa-question-circle" ></i></a></sup></h2>
        <table width="100%" border="0" cellspacing="0" cellpadding="2">
        
  <tr>
    <td width="32%" valign="bottom"><form id="form5" name="form5" method="post" action="gene.php">
      <div align="left">
        <input name="qry" type="text" />
        <input name="sear" type="submit" value="Search" />
        <input type="hidden" name="limitt" value="<?php echo $limitt; ?>" />
        
      </div>
    </form></td>
    <td width="36%"><div align="center"><strong>
                <?php if ($qry=='') {?>
                <?php } else echo "Query term: ".$qry;?>
              </strong></div></td>
    <td width="32%">
    <form id="form4e" name="form4e" method="post" action="gene.php">
      <div align="right">Show
<select name="limit" id="limit">
        
          <option value="10">10</option>
          <option value="<?php echo $mumm; ?>">All</option>
        </select>
         <input type="hidden" name="limitt" value="<?php echo $limitt; ?>" />
          <input type="hidden" name="qry" value="<?php echo $qry; ?>" />
           <input type="hidden" name="char" value="<?php echo $char; ?>" />
         <input name="shoh" type="submit" value="GO" />
      </div>
    </form>
    </td>
  </tr>
  
        </table> 
 <?php if($num==0)
 {
	 ?>
     <table width="60%" border="0" cellspacing="1" cellpadding="3" align="center">
  <tr>
    <td align="center"><strong>No results </strong></td>
  </tr>
</table>

		
	<?php	
 }
 else
		{
		?>
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
          <tr>
            <td width="70%" height="38"><strong><?php $y1=$y; if($y1 > $mumm){$y1=$mumm;} if ($mumm==0) echo "No result "; else echo ($x+1)." to ".$y1." of ".$mumm." Genes"; ?></strong></td><td width="30%"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
          <tr>
            <td><td width="25%"><form id="form1" name="form1" method="post" action="gene.php?char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&limitt=<?php $lm=str_replace(' ', '%20', $limitt); echo $lm; ?>">
            <input name="s1" type="submit" <?php if($sep==0){ ?>disabled="disabled" <?php } ?> value="&lt;&lt;" />
            
            </form></td>
            <td width="25%"><form id="form2" name="form2" method="post" action="gene.php?page=<?php echo $sep-1; ?>&char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&limitt=<?php $lm=str_replace(' ', '%20', $limitt); echo $lm; ?>">
              <input type="submit"  <?php if($sep==0){ ?>disabled="disabled" <?php } ?> name="button" id="button" value="<"/>
            </form></td>
            <td width="25%"><form id="form3" name="form2" method="post" action="gene.php?page=<?php echo $sep+1; ?>&char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&limitt=<?php $lm=str_replace(' ', '%20', $limitt); echo $lm; ?>">
              <input type="submit" name="button" <?php if($y>=$mumm){ ?>disabled="disabled" <?php } ?> id="button" value=">" />
            </form></td>
            <td width="25%"><form id="form4" name="form2" method="post" action="gene.php?page=<?php $mumm1=$mumm-($mumm%10);
			if(($mumm%10) ==0)
			{ echo ($mumm1/10)-1; }
			else{
			echo $mumm1/10; } ?>&char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&limitt=<?php $lm=str_replace(' ', '%20', $limitt); echo $lm; ?>">
              <input type="submit" name="button" <?php if($y>=$mumm){ ?>disabled="disabled" <?php } ?> id="button" value=">>" />
            </form></td>
            </tr>
        </table>
            </td></tr></table>
		
        <form action="download.php" method="post" name="myForm" id="myForm" onSubmit="return validate(this);">
        <table width="99%" border="0" cellspacing="0" cellpadding="4" bordercolor="#000000">
      <tr bgcolor="#DEEDEF">
        <td width="4%" align="left"><input type="checkbox" onChange="checkAll(this)" name="checkall" /></td>
        <td width="15%" align="left"><div align="left"><strong>Gene Symbol</strong></div></td>
        <td width="10%" align="left"><div align="left"><strong>Entrez ID</strong></div></td>
        <td width="20%" align="left"><div align="left"><strong>Aliases</strong></div></td>
        <td width="23%" align="left"><div align="left"><strong>Gene Name</strong></div></td>
        <td width="14%" align="left"><div align="left"><strong>Chromosomal Location</strong></div></td>
        
        
        </tr>
        <?php $ii=1;
		while($row1=mysql_fetch_array($ress))
	{ $gene_name=$row1["gene_name"];
	
	$res=mysql_query("select gene_name, entrez_gene, approved_name, aliases, genomic_loc from gene where gene_name='$gene_name'");
	$num1=mysql_num_rows($res);
	
		while($row = mysql_fetch_array($res))
		{ $sr_no = $row["sr_no"]; 
		?>
      <tr <?php if($ii%2 == 0){ ?>bgcolor="#DEEDEF" <?php }?>>
        <td valign="top"><?php $p_gene=$row["gene_name"]; ?>
          <input name="genes[]" type="checkbox" value="<?php echo $p_gene; ?>" />
        </td>
        <td valign="top"><?php if($sr_no < 535)
		{ ?><a href= "gene_det.php?gene=<?php echo $row["gene_name"]; ?>" target="_blank"><?php } else
		{ ?><a href= "https://www.ncbi.nlm.nih.gov/gene/<?php echo $row["entrez_gene"]; ?>" target="_blank"><?php  }
		echo $row["gene_name"]; ?></a></td>
        <td valign="top"><?php echo $row["entrez_gene"]; ?></td>
        <td valign="top"><?php $aliases= $row["aliases"]; $repa = array(" | ", "  | ", "|", " |");
		$aliases=str_replace($repa, ", ", $aliases);
		echo $aliases; ?></td>
        <td valign="top"><?php $official_name = $row["approved_name"]; 
					$official_name =trim($official_name);
					$official_name=ucfirst($official_name);	
		$rep = array(" | ", "  | ", "|", " |");
		$official_name=str_replace($rep, ", ", $official_name);
		echo $official_name;?></td>
        <td valign="top"><?php echo $row["genomic_loc"]; ?></td>
        
        </tr> <?php 
		}$ii++; }?>
    </table><table width="90%" border="0" cellspacing="0" cellpadding="7">
  <tr>
    <td><input name="download" type="submit" value="Download" /></td>
  </tr>
</table>

        <div align="right"></div>
        </form>
          <?php 
	} ?>
            </td>
      </tr>
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
          <tr>
            <td width="70%"><form id="form7" name="form7" method="post" action="gene.php">
              <input type="submit" name="bttn" id="bttn" value="Reset Page" />
            </form></td><td width="30%"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
          <tr>
            <td><td width="25%"><form id="form1" name="form1" method="post" action="gene.php?char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&limitt=<?php $lm=str_replace(' ', '%20', $limitt); echo $lm; ?>">
            <input name="s1" type="submit" <?php if($sep==0){ ?>disabled="disabled" <?php } ?> value="&lt;&lt;" />
            
            </form></td>
            <td width="25%"><form id="form2" name="form2" method="post" action="gene.php?page=<?php echo $sep-1; ?>&char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&limitt=<?php $lm=str_replace(' ', '%20', $limitt); echo $lm; ?>">
              <input type="submit"  <?php if($sep==0){ ?>disabled="disabled" <?php } ?> name="button" id="button" value="<"/>
            </form></td>
            <td width="25%"><form id="form3" name="form2" method="post" action="gene.php?page=<?php echo $sep+1; ?>&char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&limitt=<?php $lm=str_replace(' ', '%20', $limitt); echo $lm; ?>">
              <input type="submit" name="button" <?php if($y>=$mumm){ ?>disabled="disabled" <?php } ?> id="button" value=">" />
            </form></td>
            <td width="25%"><form id="form4" name="form2" method="post" action="gene.php?page=<?php $mumm1=$mumm-($mumm%10);
			if(($mumm%10) ==0)
			{ echo ($mumm1/10)-1; }
			else{
			echo $mumm1/10; } ?>&char=<?php echo $char; ?>&qry=<?php echo $qry; ?>&limitt=<?php $lm=str_replace(' ', '%20', $limitt); echo $lm; ?>">
              <input type="submit" name="button" <?php if($y>=$mumm){ ?>disabled="disabled" <?php } ?> id="button" value=">>" />
            </form></td>
            </tr>
        </table>
            </td></tr></table></td>
      </tr>
        </table>          <p>&nbsp;</p></td>
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