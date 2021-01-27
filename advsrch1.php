<?php
session_start();
error_reporting(0);
include('head.php');
?>

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

</script>
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
    <td valign="top" bgcolor="#FFFFFF">
    <?php 
	
	$section=$_POST["make"];
	$qury = $_POST["qry"];
	$qury1=$qury;
	
	$lookFor="} [";
	$replacement="} OR [";
	$qury=str_replace($lookFor, $replacement, $qury);
	
	
	$qury=str_replace('"', '', $qury);
	//echo $qury;
	$lookFor="{";
	$replacement="'%";
	$qury=str_replace($lookFor, $replacement, $qury);
	
	$lookFor="}";
	$replacement="%'";
	$qury=str_replace($lookFor, $replacement, $qury);
	if($section=="Gene Information")
	{
	$lookFor="[Gene Symbol]";
	$replacement="gene_name LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Aliases]";
	$replacement="aliases LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Gene Name]";
	$replacement="approved_name LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Entrez Gene ID]";
	$replacement="entrez_gene LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Chromosomal Location]";
	$replacement="genomic_loc LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Gene Summary]";
	$replacement="entrez_summary LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[GeneCards ID]";
	$replacement="gc_id LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[UniGene]";
	$replacement="unigene_link LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[RefSeq DNA]";
	$replacement="refseq_dna_seq LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[RefSeq mRNA]";
	$replacement="refseq_mrnas LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	
	$querw="select * from gene WHERE ".$qury." order by gene_name";
	//echo $querw;
	$res = mysql_query($querw); 
	$cnt1=mysql_num_rows($res);
	}
	elseif($section=="Protein Information")
	{
	$lookFor="[Gene Symbol]";
	$replacement="gene_name LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Protein Name]";
	$replacement="description LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Function]";
	$replacement="`function` LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Refseq Proteins]";
	$replacement="ref_seq_proteins LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[UniProt]";
	$replacement="uniprot_id LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[RCSB PDB]";
	$replacement="pdb_ids LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	//$lookFor="[Interpro ID]";
	//$replacement="interpro_ids LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$querw="select * from gene WHERE ".$qury." order by gene_name";
	//echo $querw;
	$res = mysql_query($querw); 
	$cnt1=mysql_num_rows($res);
	}
	elseif($section=="GO")
	{
	$lookFor="[Gene]";
	$replacement="geneSymbol LIKE";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[GO ID]";
	$replacement="go_id LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Ontology]";
	$replacement="type LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Definition]";
	$replacement="go_function LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$querw="select * from gene2go WHERE ".$qury." order by geneSymbol";
	//echo $querw;
	$res = mysql_query($querw); 
	
	$cnt1=mysql_num_rows($res);
	}
	elseif($section=="SNP")
	{
	$lookFor="[Gene]";
	$replacement="gene_symbol LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[SNP ID]";
	$replacement="snpid LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[SNP]";
	$replacement="mutation LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Associated disease]";
	$replacement="disease LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$querw="select * from snp WHERE ".$qury." order by gene_symbol";
	//echo $querw;
	$res = mysql_query($querw); 
	$cnt1=mysql_num_rows($res);
	}
	elseif($section=="References")
	{
	
	$lookFor="[Pubmed ID]";
	$replacement="PubMed_Unique_Identifier LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Title]";
	$replacement="Title LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Source";
	$replacement="Source LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Abstract]";
	$replacement="Abstract LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Author]";
	$replacement="Full_Author LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$querw="select * from pubmed WHERE ".$qury." ORDER BY Date_Created DESC";
	//echo $querw;
	$res = mysql_query($querw); 
	$cnt1=mysql_num_rows($res);
	}
	elseif($section=="Associated Pathways")
	{
			$lookFor="[Gene]";
	$replacement="geneSymbol LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Pathway]";
	$replacement="pathwayname LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[ID]";
	$replacement="pathwayid LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$querw="select distinct pathwayname, pathwayid from kegg_path,gene WHERE ".$qury." and(kegg_path.entrezid = gene.entrez_gene) union select distinct pathwayname, pathwayid from reactome,gene where ".$qury." and (reactome.entrezid = gene.entrez_gene)";
	//echo $querw;
	$res = mysql_query($querw); 
	$cnt1=mysql_num_rows($res);
	}
?>
	
    <table width="98%" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td><table width="98%" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td>
		<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="85%"><?php echo "<div align = center> <strong>Query Term: </strong>".$qury1."</div>"; ?></td>
    <td width="15%" valign="top"><?php echo "<div align = right><strong>Hits: </strong>".$cnt1."</div>"; ?></td>
  </tr>
</table>
<?php
		
		
		if((($section=="Gene Information") or ($section=="Protein Information")) AND ($cnt1 > 0))
		{ ?>
        <p align="left"><strong><?php echo "$section"; ?></strong></p>
          <table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td><table width="99%" border="0" cellspacing="0" cellpadding="4" bordercolor="#000000">
       <tr bgcolor="#DEEDEF">
        
        <td width="15%" align="left"><div align="left"><strong>Gene Symbol</strong></div></td>
        <td width="10%" align="left"><div align="left"><strong>Entrez ID</strong></div></td>
        <td width="22%" align="left"><div align="left"><strong>Aliases</strong></div></td>
        <td width="25%" align="left"><div align="left"><strong>Gene Name</strong></div></td>
        <td width="14%" align="left"><div align="left"><strong>Chromosomal Location</strong></div></td>
        
        
        </tr>
        <?php 
		$ii=1;
		while($row = mysql_fetch_array($res))
		{ ?>
      <tr <?php if($ii%2 == 0){ ?>bgcolor="#DEEDEF" <?php }?>>
        <td valign="top" width = "5%"><a href="gene_det.php?gene=<?php echo $row["gene_name"]; ?>" target = "_blank" ><?php $gene_name=$row["gene_name"];
		 
			  $gene_name1=str_replace($lookFor, $replacement, $gene_name);
		echo $gene_name1; ?></a></td>
        <td valign="top" width = "8%">
          <?php $gene_id=$row["entrez_gene"];
		
			  $gene_id=str_replace($lookFor, $replacement, $gene_id);
		echo $gene_id; ?>
        </td>
        <td valign="top" width = "15%">
        
          <?php
		  $aliases=$row["aliases"];
		 $l = "|";
		 $r = ", ";
			  $aliases=str_replace($l,$r,$aliases);
			   
		
		echo $aliases; ?>
        </td>
        <td valign="top" width = "23%">
          <?php $official_name = $row["approved_name"]; 
					$official_name =trim($official_name);
					$official_name=ucfirst($official_name);	
		$rep = array(" | ", "  | ", "|", " |");
		$official_name=str_replace($rep, ", ", $official_name);
		$official_name=str_replace($lookFor, $replacement, $official_name);
		echo $official_name;
		?>
        </td>
        <td valign="top" width = "10%"><?php echo $row["genomic_loc"]; ?></td>
        </tr> <?php  $ii++;} ?>
    </table>
    </td></tr>
        <?php } 
		elseif(($section=="GO") AND ($cnt1 > 0))
	{
		?><p align="left"><strong>Gene Ontology</strong></p>
        <table width="99%" border="0" cellspacing="0" cellpadding="2" bordercolor="#000000">
         <tr bgcolor="#DEEDEF">
                    <td width="11%"><strong>Gene</strong></td>
                    <td width="11%"><strong>GO ID</strong></td>
                    <td width="23%"><strong>Type of Function</strong></td>
                    <td width="41%"><strong>Description</strong></td>
                    <td width="10%"><strong>Evidence</strong></td>
                    <td width="15%"><strong>Reference</strong></td>
                   <td width="6%">&nbsp;</td>
                  </tr>
        <?php $ii=1;
		while($rw1 = mysql_fetch_array($res))
		{ ?>
      <tr <?php if($ii%2 == 0){ ?>bgcolor="#DEEDEF" <?php }?>>
      <td valign="top"><?php $gene=$rw1["geneSymbol"];
	  $gene1=str_replace($lookFor, $replacement, $gene);
	  echo $gene1; ?></td>
        <td valign="top"><?php $go_id=""; $go_id=$rw1["go_id"];
		$go_id1=str_replace($lookFor, $replacement, $go_id);
				  
				  echo "<a href='http://amigo.geneontology.org/amigo/term/$go_id' target = '_blank'>$go_id1</a>"; ?></td>

                    <td valign="top"><?php $go_typ=$rw1["type"];
					$go_typ=ucfirst($go_typ);
					$go_typ=str_replace($lookFor, $replacement, $go_typ);
					echo $go_typ; ?></td>
                    <td valign="top"><?php $go_fun=$rw1["go_function"];
					$go_fun=ucfirst($go_fun);
					$go_fun=str_replace($lookFor, $replacement, $go_fun);
					echo $go_fun; ?></td>
                    <td valign="top"><?php $evid=$rw1["evidence"]; 
					
					$evid=str_replace($lookFor, $replacement, $evid);
					echo $evid;
					?>
                    </td>
                    <td valign="top"><?php $go_pmid="";
					$go_pmid=$rw1["pmid"]; 
					//$go_pmid = str_replace (" ", "", $go_pmid);
			 $go_pmid1="";
			$go_pmid1=explode(",", $go_pmid);
			$xi=0;
			$go_pp="";
			foreach($go_pmid1 as $go_pmid11)
			{$go_pmid11=trim($go_pmid11);
			settype($go_pmid11, "integer");
			if($go_pmid11 >0)
			{
			if($xi == 0)
			{
			$go_pp = "<a href='http://www.ncbi.nlm.nih.gov/pubmed?term=$go_pmid11'  target='_blank'>".$go_pmid11."</a>";
			
			}
			else
			{
			$go_pp=$go_pp.", <a href='http://www.ncbi.nlm.nih.gov/pubmed?term=$go_pmid11' target='_blank'>".$go_pmid11."</a>";
			}$xi++;
			}}
			echo $go_pp;?></td>
        <td><a href="gene_det.php?gene=<?php echo $rw1["geneSymbol"]; ?>"target="_blank">Gene...</a></td>
        </tr> <?php $ii++; } 
		
		?>
    </table>
        <?php } 
		elseif($section=="SNP")
	{
		?>
        <p align="left"><strong>SNP</strong></p>
        <?php 
		
		if($cnt1>0)
		{
		?>
        <table width="100%" border="0" align="right" cellpadding="4" cellspacing="0">
      <tr class="style2" bgcolor="#DEEDEF">
      <td width="14%"><strong><span class="style2">Gene symbol</span></strong></td>
        <td width="12%"><strong><span class="style2">SNP Id</span></strong></td>
        <td width="21%" class="style2"><div align="center"><strong>SNP</strong></div></td>
        <td width="33%"><strong><span class="style2">Associated disease</span></strong></td>
        <td width="19%" align="left"><div align="left"><strong><span class="style2">References</span></strong></div></td>
        </tr>
      <?php $ii++;
	  while($row1=mysql_fetch_array($res))
	{ 
	 ?>
       <tr valign="top" <?php if($ii%2 == 0){ ?>bgcolor="#DEEDEF" <?php }?>>
       <td><a href=gene_det.php?gene=<?php echo $row1["gene_symbol"]; ?> target="_blank"><?php echo $row1["gene_symbol"]; ?></a>
       </td>
        <td><?php 
			$snp_id=$row1["snpid"];
			$snp_id = preg_replace('/\s+/', '', $snp_id);
			$snp_id = preg_replace('/[^(\x20-\x7F)]*/','', $snp_id);
			echo "<a href='https://www.ncbi.nlm.nih.gov/snp/$snp_id' target='_blank'>$snp_id</a>"; ?></td>
        <td><div align="center"><?php echo $row1["mutation"]; ?></div></td>
        <td><?php $func_sig=ucfirst($row1["disease"]);
		echo $func_sig; ?></td>
        <td align="left"><div align="left">
          <?php $pubmed_disease_pr_ref=$row1["pmid"]; 
		  
		  $pubmed_disease_pr_ref = preg_replace('/\s+/', '', $pubmed_disease_pr_ref);
		  $pubmed_disease_prro=explode(",", $pubmed_disease_pr_ref);
		  $pubmed_disease_prr = array_unique($pubmed_disease_prro);
			$xi=0;
			foreach($pubmed_disease_prr as $pubmed_disease_pmd1)
			{$pubmed_disease_pmd="";
			//$ppmia=explode(" ", $pubmed_disease_pmd1);
				//$pubmed_disease_pmd2=preg_replace("/\([^\)]+\)/","",$ppmia[0]); 
				//$pubmed_disease_pmd2=preg_replace("^", "", $pubmed_disease_pmd2);
				
				$pubmed_disease_pmd=trim($pubmed_disease_pmd1);
				//settype($pubmed_disease_pmd, "integer");
				
			if($xi == 0)
			{
			$pubmed_disease_pmid = "<a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=search&term=$pubmed_disease_pmd' target='_blank'>$pubmed_disease_pmd</a>";
			}
			else
			{
			$pubmed_disease_pmid=$pubmed_disease_pmid.", <a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=search&term=$pubmed_disease_pmd'  target='_blank'>$pubmed_disease_pmd</a>";
			}$xi++;
			}
			echo $pubmed_disease_pmid; ?>
        </div></td><td width="1%"></td>
        </tr>
      <?php
	$ai++;
	$ii++; }
	  ?>
    </table>

          <?php 
	} ?>
    <?php } 
		elseif(($section=="Associated Diseases") AND ($cnt1 > 0))
	{
		?>
     <p align="left"><strong>Associated Disease</strong></p>
    
    
    <table width="100%" border="0" cellspacing="1" cellpadding="6" bordercolor="#000000">
  <tr align="center" valign="top" bgcolor="#DEEDEF">
    <td width="26%" align="left"><strong>Disease</strong></td>
    <td width="74%" align="left"><strong>Gene (Gene Symbol)</strong></td>
    
  </tr>
  <?php $i=1;
  while($row1=mysql_fetch_array($res))
	{ $disease=$row1["disease_merge"];
	$disease1=ucfirst($disease);
	$ress=mysql_query("select DISTINCT geneSymbol, pmid from disease_tertiary where disease_merge='$disease' order by geneSymbol");
	$num1=mysql_num_rows($ress);
	?>
  <tr <?php if($i%2 == 0){ ?>bgcolor="#DEEDEF" <?php }?>>
    <td  valign="top" width="26%"><a href="disease.php?qry=<?php echo $disease1; ?>"target="_blank"> <?php 
	$disease1=str_replace($lookFor, $replacement, $disease1);
	echo $disease1; ?></a></td>
   
    <?php 
	 $xa=0;
		if($num1>0)
		{
	?>
    <td width="74%" valign="top">
    <?php while($row2=mysql_fetch_array($ress))
	{ 
	if($xa==0)
	{
	?>
    <a href="gene_det.php?gene=<?php echo trim($row2["geneSymbol"]); ?>"target="_blank"><?php echo trim($row2["geneSymbol"]); ?></a>
      <?php
	}
	else
	  {
	  ?>
  , <a href="gene_det.php?gene=<?php echo trim($row2["geneSymbol"]); ?>"target="_blank"><?php echo trim($row2["geneSymbol"]); ?> </a><?php 
	  }
		$xa++; } ?>
     <?php } ?>
      </tr>
      
  
  <?php $i++; } ?>
</table>

    <?php } 
		elseif(($section=="References") AND ($cnt1 > 0))
	{
		$i=1;
		
		?>
        <p align="left"><strong>References</strong></p>
        <?php
		while($rw2=mysql_fetch_array($res))
	{?>
    <table width="100%" border="0" align="right" cellpadding="5" cellspacing="=0">
           <tr>
            <td>
            
              <h4 onClick="toggle('<?php echo "pri".$i; ?>');"><a href="#ref"><?php echo $rw2["Title"];?></a>
            </h4>
          <table width="100%" border="0" cellpadding="2" cellspacing="=0" align="left" >
           
			<tr>
            <td colspan="2"><div align="justify"><?php $auth = str_replace(',', '' ,$rw2["Full_Author"]);
			$auth = str_replace('|', ',' ,$auth);
			$auth = preg_replace('/[^(\x20-\x7F)]*/','', $auth);
			echo $auth;?></div></td>
          </tr>
          <tr>
            <td colspan="2"><div align="justify" ><?php 
			$affili=$rw2["Affiliation"];
			$affili = preg_replace('/[^(\x20-\x7F)]*/','', $affili);
			$affili = str_replace('|', ',' ,$affili);
			echo $affili;?></div></td>
          </tr>
          <tr>
            <td colspan="2"><div align="justify"><?php $source=$rw2["Source"];
			$source = preg_replace('/[^(\x20-\x7F)]*/','', $source);
			echo $source;
			?></div></td>
          </tr>
           <tr>
            <td width="54%"><div align="justify"><strong>PMID: </strong><a href="http://www.ncbi.nlm.nih.gov/pubmed/<?php echo $rw2["PubMed_Unique_Identifier"];?>" target="_blank" ><?php echo $rw2["PubMed_Unique_Identifier"]; $ppmidd=$rw2["PubMed_Unique_Identifier"];
			?></a></div></td>
          
           <?php $res21 = mysql_query("select gene_name from gene where primary_references LIKE '%$ppmidd%' or references_all LIKE '%$ppmidd%'");  
		  $cnst=mysql_num_rows($res21);
		  ?>
          <td width="46%" >
          <?php if($cnst > 0)
		  {
			  ?>
		      <div align="right"><strong>Gene: 
		        <?php $xi=0;
		  while($rroe=mysql_fetch_array($res21)) 
		  {
			  $ggne=$rroe["gene_name"];
			  if($xi == 0)
			{
			$sr_mid = "<a href='gene_det.php?gene=$ggne' target='_blank'>".$ggne."</a>";
			
			}
			else
			{
			$sr_mid=$sr_mid.", <a href='gene_det.php?gene=$ggne' target='_blank'>".$ggne."</a>";
			}$xi++;
			}
			echo $sr_mid;
			  
		  ?>
		        </strong></div> <?php } ?></td></tr>
          <tr <?php echo "pri".$i; ?>=fred id="hidethis" style="display:none">
            <td colspan="2"><div align="justify">
              <p><div class="style26"><strong>Abstract</strong></div>
              <?php $abstract=$rw2["Abstract"];
			  $lookFor="PURPOSE:";
			  $replacement="<br><strong>PURPOSE:</strong>";
			  $abstract=str_replace($lookFor, $replacement, $abstract);
			  $lookFor="OBJECTIVES:";
			  $replacement="<br><strong>OBJECTIVES:</strong>";
			  $abstract=str_replace($lookFor, $replacement, $abstract);
			  $lookFor="OBJECTIVE:";
			  $replacement="<br><strong>OBJECTIVE:</strong>";
			  $abstract=str_replace($lookFor, $replacement, $abstract);
			  $lookFor="BACKGROUND:";
			  $replacement="<br><strong>BACKGROUND:</strong>";
			  $abstract=str_replace($lookFor, $replacement, $abstract);
			  $lookFor="METHODS:";
			  $replacement="<br><strong>METHODS:</strong>";
			  $abstract=str_replace($lookFor, $replacement, $abstract);
			  $lookFor="RESULTS:";
			  $replacement="<br><strong>RESULTS:</strong>";
			  $abstract=str_replace($lookFor, $replacement, $abstract);
			  $lookFor="CONCLUSIONS:";
			  $replacement="<br><strong>CONCLUSIONS:</strong>";
			  $abstract=str_replace($lookFor, $replacement, $abstract);
			  echo $abstract;?></div></td>
          </tr>
          
         
        </table></td>
          </tr></table>       
        <?php $i++; }?>
	
        <?php }
		elseif(($section=="Associated Pathways") AND ($cnt1 > 0))
	{
		?>
     <p align="left"><strong>Associated Pathway</strong></p>
    
    
    <table width="100%" border="0" cellspacing="1" cellpadding="6" bordercolor="#000000">
  <tr align="center" valign="top" bgcolor="#DEEDEF">
		<td width="25%" align="left"><strong>Pathway</strong></td>
		<td width="25%" align = "left"><strong>Pathway ID</strong></td>   
		<td width="40%" align="left"><strong>Gene (Gene Symbol)</strong></td>
      <td width="10%" align = "left"><strong>Source</strong></td>
    
  </tr>
  <?php $i=1;
  while($row=mysql_fetch_array($res))
	{ 
	$pathn=$row['pathwayname'];
			$path=$row['pathwayid'];
			//echo "$path"."<br>";
			$path=trim($path);
			if (strpos($path, "R-HSA-") === FALSE){
			$ress=mysql_query("select geneSymbol, pathwayname, pathwayid, entrezid from kegg_path,gene where pathwayid = '$path' and kegg_path.entrezid = gene.entrez_gene");
			//echo "select geneSymbol, pathwayname, pathwayid, entrezid from kegg_path where pathwayid = '$path';";
			$link = '<a href="http://www.genome.jp/kegg-bin/show_pathway?'.$path.'" target="_blank">';
			$source = 'KEGG';
			}
			else{
			$ress=mysql_query("select geneSymbol, pathwayname, pathwayid, entrezid from reactome,gene where pathwayid = '$path' and reactome.entrezid = gene.entrez_gene");
			//echo "select geneSymbol, pathwayname, pathwayid, entrezid from kegg_path where pathwayid = '$path';";
			$link = '<a href="https://reactome.org/PathwayBrowser/#/'.$path.'" target="_blank">';
			$source = 'Reactome';
			}
	//$disease1=ucfirst($disease);
	//$ress=mysql_query("select DISTINCT geneSymbol from kegg_path where pathwayname ='$disease' order by geneSymbol");
	//$num1=mysql_num_rows($ress);
	?>
		
	    <tr <?php if($i%2 == 0){ ?> bgcolor="#DEEDEF" <?php }?> >
      <td><?php echo $link; echo $pathn; ?></a></td> 
	 
      <td> 
  <?php echo $path;  ?>
	  </td>
      <td align="justify">
	  <?php
	  $xa=0;
		while($row1=mysql_fetch_array($ress)){
	  if($xa==0)
	{
	?>
    <a href="gene_det.php?gene=<?php echo trim($row1["geneSymbol"]); ?>" target="_blank"><?php echo trim($row1["geneSymbol"]); ?></a>
      <?php
	}
	else
	  {
	  ?>
  , <a href="gene_det.php?gene=<?php echo trim($row1["geneSymbol"]); ?>" target ="_blank"><?php echo trim($row1["geneSymbol"]); ?> </a><?php 
	  }
	  $xa++;
		}
	  ?>
	  
	  </td>
		<td><?php echo $source; ?></td>
   		
		<?php 
  $i++;}
		?>
		 </tr>
		 </table>
		 <?php
	} ?>
	
        </td>
    
</table>

          <div align="center">
  <?php  ?> 
  <form action="advsrh.php" method="post">
  <input name="qry" type="hidden" value="<?php echo $qury1; ?>" />
  <input name="a" type="submit" value="Back" />
  </form>
          </div>
      </tr>
    </table><p>&nbsp;</p></td>
      </tr>
<tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
      <tr>
        
        
        <td width="21%" bgcolor="#46439a"><div align="center" class="style1"><strong><a href="stats.php"><font color="#ffffff">Statistics </font></a></strong></div></td>                                                                                           <td width="29%" bgcolor="#46439a"><div align="center" class="style1"><strong><a href="aboutus.php"><font color="#ffffff">About BIC</font></a></strong></div></td>
        <td width="25%" bgcolor="#46439a"><div align="center" class="style1"><strong><a href="feedback.php"><font color="#ffffff">Feedback</font></a></strong></div></td>
        
        <td width="25%" bgcolor="#46439a"><div align="center" class="style1"><strong><a href='contact.php'><font color="#ffffff">Contact Us</font></a></strong></div></td>
        
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