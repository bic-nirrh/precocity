<?php
session_start();
include("head.php");
$gene_n=$_REQUEST['gene'];
?>


<table width="90%" border="0" cellspacing="0" cellpadding="6" bgcolor="#FFFFFF" align="center">
  <tr>
    <td><p>
        
       <?php
	

	$res=mysql_query("select * from gene where gene_name = '$gene_n'"); 
	while($row=mysql_fetch_array($res))
	{
		$gene=$row["gene_name"]; 
		$gnen_id=$row["entrez_gene"];
		$pr_ref=$row["primary_references"];
		$diseasen=mysql_query("select distinct parent from disease_tertiary where geneId='$gnen_id' AND parent <> 'X' order by parent");
				
			  $dsi=0;
		$dsn=mysql_num_rows($diseasen);
		$snp=mysql_query("select * from snp where gene_symbol='$gene'");
			$snp_no=mysql_num_rows($snp);
			
			$pathw=mysql_query("select pathwayid, pathwayname from kegg_path where entrezid='$gnen_id'");
			   $kegg_nu=mysql_num_rows($pathw);
			  $pathr=mysql_query("select * from reactome where entrezid='$gnen_id'");
				  $rect_nu=mysql_num_rows($pathr); 
			   
		$gene_type="Gene"; 
		$pr_ref=$row["primary_references"];
		?> <h2 align="center"> <?php echo $gene; ?> <form action="download.php" method="post" enctype="application/x-www-form-urlencoded" name="download" target="_parent">
         <div align="right">
           <input name="genes[]" type="hidden" value="<?php echo $gene; ?>" />
           <input name="down" type="submit" value="Download" />
         </div>
       </form></h2>
      <table width="100%" border="0" cellspacing="4" cellpadding="0">
        <tr>
          <td width="18%" bgcolor="#FFFFCC"> <div align="center"> <span class="style36"> <a href="#gene">Gene Information</a> </span> </div> </td>
         <?php if($snp_no > 0)
		 { ?><td width="8%" bgcolor="#FFFFCC"> <div align="center"> <span class="style49"> <a href="#snp">SNPs</a> </span> </div> </td> <?php } ?>
          <td width="18%" bgcolor="#FFFFCC"> <div align="center"> <span class="style36"> <a href="#go">Gene Ontology (GO)</a> </span> </div> </td>
          <?php if($gene_type=="Gene")
		  {
			  ?>
          <td width="20%" bgcolor="#FFFFCC"> <div align="center"> <span class="style36"> <a href="#protein">Protein Information</a> </span> </div> </td>
          <?php } 
		  if($dsn > 0)
		  {?>
          <td width="20%" bgcolor="#FFFFCC"> <div align="center"> <strong> <a href="#ass_d">Associated Diseases</a> </strong> </div> </td>
          <?php }   
		  if(($kegg_nu > 0) or ($rect_nu > 0))
		  {?>
          <td width="20%" bgcolor="#FFFFCC"> <div align="center"> <strong> <a href="#path">Pathways</a> </strong> </div> </td>
          <?php } ?>
          <td width="16%" bgcolor="#FFFFCC"> <div align="center"> <strong> <a href="#ref">References</a> </strong> </div> </td>
        </tr>
      </table>
      
  <tr>
    <td valign="top">
   
    <table width="100%" border="0" align="center" cellpadding="20" cellspacing="=0" >
      <tr>
        <td> <div align="justify">
          <table width="100%" border="0" cellpadding="3">
            <tr>
              <td height="26" colspan="3" class="style14"> <a name="gene"> </a> <div align="justify" class="style37">Gene Information
                
                <div style="text-align:center"> <a href="http://www.genome.jp/dbget-bin/Jmol.jnlp?pdb:2ed7+-s"> </a> </div>
              </div> </td>
                </tr>
            <tr>
              <td width="1%" class="style14">&nbsp;</td>
                <td width="20%" class="style14"> <div align="justify"> <strong> <span onmouseover="tooltip.show('Gene Symbol - the official gene symbol approved by the HGNC, which is a short abbreviated form of the gene name.');" onmouseout="tooltip.hide();">Gene Symbol</span> </strong> </div> </td>
                <td width="79%" class="style14"> <div align="justify"> <?php echo $gene; ?> </div> </td>
              </tr>
              <?php $aliases=$row["aliases"];
			  if($aliases !='')
			  { ?>
              <tr>
              <td width="1%" class="style14">&nbsp;</td>
                <td width="20%" class="style14"> <div align="justify"> <strong><span onmouseover="tooltip.show(' Gene aliases');" onmouseout="tooltip.hide();">Aliases</span></strong></div> </td>
                <td width="79%" class="style14"> <div align="justify">
                  <?php 
				  $aliases = str_replace("|", ", ", $aliases);
				  echo "$aliases"; ?>
                </div> </td>
              </tr>
              <?php } ?>
              <tr>
              <td width="1%" class="style14">&nbsp;</td>
                <td width="20%" class="style14"> <div align="justify"> <strong><span onmouseover="tooltip.show('Entrez Gene ID - the GENE ID in NCBI Gene database');" onmouseout="tooltip.hide();">Entrez Gene ID </span></strong> </div> </td>
                <td width="79%" class="style14"> <div align="justify">
                  <?php 
				  echo "<a href='http://www.ncbi.nlm.nih.gov/gene/$gnen_id' target='_blank'>$gnen_id</a>";?>
                </div> </td>
              </tr>
            <tr>
              <td class="style14">&nbsp;</td>
                <td class="style14"> <div align="justify"> <strong><span onmouseover="tooltip.show('Gene Name - the full gene name approved by the HGNC.');" onmouseout="tooltip.hide();">Gene Name</span></strong> </div> </td>
                <td class="style14">
                  <div align="justify">
                    <?php $official_name = $row["approved_name"]; 
					$official_name =trim($official_name);
					$official_name=ucfirst($official_name);	
		$rep = array(" | ", "  | ", "|", " |");
		$official_name=str_replace($rep, ", ", $official_name);
		echo $official_name;?>
                  </div> </td>
              </tr>
            <tr>
              <td class="style14">&nbsp;</td>
                <td class="style14"> <div align="justify"> <strong><span onmouseover="tooltip.show('Chromosomal Location - indicates the cytogenetic location of the gene or region on the chromosome.');" onmouseout="tooltip.hide();">Chromosomal Location</span></strong></div> </td>
                <td class="style14">
                    <div align="justify">
                      <?php $genomic_loc = $row["genomic_loc"]; $genomic_loc = trim($genomic_loc, "\s"); 
			echo $genomic_loc; ?>
                    </div> </td>
              </tr>
            <tr>
              <td class="style14">&nbsp;</td>
                <td class="style14"> <div align="justify"> <strong><span onmouseover="tooltip.show('HGNC ID - a unique ID provided by the HGNC for each gene with an approved symbol.');" onmouseout="tooltip.hide();">HGNC ID</span></strong></div> </td>
                <td class="style14">
                    <div align="justify">
                      <?php 
			$hgnc_ref=$row["hgnc_id"];
			 
			$hgnc_r=explode(",", $hgnc_ref);
			$xi=0;
			foreach($hgnc_r as $hgnc_md1)
			{$hgnc_md=trim($hgnc_md1);
			if($xi == 0)
			{
			$hgnc_mid = "<a https://www.genenames.org/data/gene-symbol-report/#!/hgnc_id/$hgnc_md' target='_blank'>$hgnc_md</a>";
			
			}
			else
			{
			$hgnc_mid=$hgnc_mid.", <a https://www.genenames.org/data/gene-symbol-report/#!/hgnc_id/$hgnc_md'  target='_blank'>$hgnc_md</a>";
			}$xi++;
			}
			echo $hgnc_mid;
			 ?>
                      <?php //echo $row["hgnc_id"];?>
                    </div> </td>
              </tr>
              <?php $entrez_summary=$row["entrez_summary"];
			  if($entrez_summary=="")
			  {
			  }
			  else
			  { ?>
            <tr>
              <td class="style14">&nbsp;</td>
                <td class="style14" valign="top"> <div align="justify"> <strong><span onmouseover="tooltip.show('Summary of gene provided in NCBI Entrez Gene.');" onmouseout="tooltip.hide();">Summary</span></strong> </div> </td>
                <td class="style14">
                    <div align="justify">
                      <?php echo $row["entrez_summary"];?> 
                  </div> </td>
              </tr>
              <?php } 
			 ?>
            <?php $unig_ref=$row["unigene_link"];
			if($unig_ref !='')
			  {
			?>
            <tr>
              <td class="style14">&nbsp;</td>
                <td class="style14"> <div align="justify"> <strong><span onmouseover="tooltip.show('NCBI UniGene Identifier');" onmouseout="tooltip.hide();">UniGene </span></strong> </div> </td>
                <td class="style14">
                    <div align="justify">
                      <?php 
			
			 
			$unig_r=explode(",", $unig_ref);
			$xi=0;
			foreach($unig_r as $unig_md1)
			{$unig_md=trim($unig_md1);
			$un_md=explode("#", $unig_md);
			$unn=explode(".", $un_md[0]);
			if($xi == 0)
			{ 
			$unig_mid = "<a href='http://www.ncbi.nlm.nih.gov/UniGene/clust.cgi?ORG=$unn[0]&CID=$unn[1]' target='_blank'>$un_md[0]</a>";
			
			}
			else
			{
			$unig_mid=$unig_mid.", <a href='http://www.ncbi.nlm.nih.gov/UniGene/clust.cgi?ORG=$unn[0]&CID=$unn[1]' target='_blank'>$un_md[0]</a>";
			}$xi++;
			}
			echo $unig_mid;
			 ?>
                      <?php //echo $row["unigene_link"];?>
                    </div> </td>
              </tr>      
              <?php } 
			  $rseq_id=$row["refseq_dna_seq"];
			  if($rseq_id !='')
			  {
			  ?>    
            <tr>
              <td>&nbsp;</td>
                <td> <div align="justify"> <strong><span onmouseover="tooltip.show('NCBI Reference Sequence');" onmouseout="tooltip.hide();">RefSeq DNA </span></strong> </div> </td>
                <td> <div align="justify">
                  <?php 
            
			
			 
			$rfm_d=explode(",", $rseq_id);
			$xi=0;
			foreach($rfm_d as $rfm_d1)
			{$rfm_d1=rtrim($rfm_d1, "�");
			
			 $apc=$apc."<a href='http://www.ncbi.nlm.nih.gov/nuccore/".$rfm_d1."' target='_blank' >".$rfm_d1."</a>, ";
			 
			}
			 $apc=rtrim($apc, ', ');
			 echo $apc;
			
			
			 ?>
                </div> </td>
              </tr>
              <?php }
			  $rfm_ref=$row["refseq_mrnas"];
			  if($rfm_ref !='')
			  {
			   ?>
            <tr>
              <td>&nbsp;</td>
                <td> <div align="justify"> <strong><span onmouseover="tooltip.show('NCBI Reference Sequence');" onmouseout="tooltip.hide();">RefSeq mRNA</span></strong> </div> </td>
                <td> <div align="justify">
                  <?php 
			
			 $rfm_ref=preg_replace('/[|]/', ',', $rfm_ref);
			$rfm_r=explode(",", $rfm_ref);
			$xi=0;
			foreach($rfm_r as $rfm_md1)
			{$rfm_md=rtrim($rfm_md1, "�");
			if($xi == 0)
			{
			$rfm_mid = "<a href='http://www.ncbi.nlm.nih.gov/nuccore/$rfm_md'?report=GenBank target='_blank'>$rfm_md</a>";
			
			}
			else
			{
			$rfm_mid=$rfm_mid.", <a href='http://www.ncbi.nlm.nih.gov/nuccore/$rfm_md'?report=GenBank  target='_blank'>$rfm_md</a>";
			}$xi++;
			}
			echo $rfm_mid;
			 ?>
                </div> </td>
              </tr>
            
            <?php }
			  $ensa_ref=$row["ensembl_ids"];
			  $enst_ref=$row["ensembl_ids_transcripts"];
			  $ensp_ref=$row["ensembl_proteins"];
			  if(($ensa_ref =='') and ($enst_ref =='') and ($ensp_ref ==''))
			  {
			  }
			  else
			  {
			   ?>
            <tr>
              <td>&nbsp;</td> <td colspan="2">
  <em> <strong>e<font color="#FF0000">!</font>Ensembl </strong> </em>
    
                    <table width="80%" border="0" align="right" cellpadding="2">
                        <tr>
                          <td width="21%"> <strong><span onmouseover="tooltip.show('Ensembl Gene ID');" onmouseout="tooltip.hide();">Gene</span></strong> </td>
                          <td width="77%"> <div align="left">
                            <?php 
			
			 
			$ensa_r=explode("|", $ensa_ref);
			$xi=0;
			foreach($ensa_r as $ensa_md1)
			{$ensa_md=trim($ensa_md1);
			if($xi == 0)
			{
			$ensa_mid = "<a href='http://www.ensembl.org/Homo_sapiens/Gene/Summary?g=$ensa_md' target='_blank'>$ensa_md</a>";
			
			}
			else
			{
			$ensa_mid=$ensa_mid.", <a href='http://www.ensembl.org/Homo_sapiens/Gene/Summary?g=$ensa_md'  target='_blank'>$ensa_md</a>";
			}$xi++;
			}
			echo $ensa_mid;
			 ?>
                          </div> </td>
                          <td width="2%"> </td>
                      </tr>                        
                      <tr>
                        <td valign="top"> <strong><span onmouseover="tooltip.show('Ensembl Transcript ID');" onmouseout="tooltip.hide();">Transcript</span></strong> </td>
                        <td valign="top"> <div align="left">
                          <?php 
			
			 $enst_ref=preg_replace('/[|]/', ',', $enst_ref);
			$enst_r=explode(",", $enst_ref);
			$xi=0;
			foreach($enst_r as $enst_md1)
			{$enst_md=trim($enst_md1);
			if($xi == 0)
			{
			$enst_mid = "<a href='http://www.ensembl.org/Homo_sapiens/transview?db=core;transcript=$enst_md' target='_blank'>$enst_md</a>";
			}
			else
			{
			$enst_mid=$enst_mid.", <a href='http://www.ensembl.org/Homo_sapiens/transview?db=core;transcript=$enst_md'  target='_blank'>$enst_md</a>";
			}$xi++;
			}
			echo $enst_mid;
			 ?>
                        </div> </td>
                        <td valign="top">&nbsp;</td>
                      </tr>
                     
                      <tr>
                          <td valign="top"> <div align="left"> <strong><span onmouseover="tooltip.show('Ensembl Protein ID');" onmouseout="tooltip.hide();">Protein</span></strong> </div> </td>
                          <td valign="top"> <div align="left">
                            <?php 
			
			 
			$ensp_r=explode("|", $ensp_ref);
			$xi=0;
			foreach($ensp_r as $ensp_md1)
			{$ensp_md=trim($ensp_md1);
			if($xi == 0)
			{
			$ensp_mid = "<a href='http://www.ensembl.org/Homo_sapiens/protview?peptide=$ensp_md' target='_blank'>$ensp_md</a>";
			
			}
			else
			{
			$ensp_mid=$ensp_mid.", <a href='http://www.ensembl.org/Homo_sapiens/protview?peptide=$ensp_md'  target='_blank'>$ensp_md</a>";
			}$xi++;
			}
			echo $ensp_mid;
			?>
                            
                          </div> </td>
                          <td valign="top"> <div align="left"> </div> </td>
                      </tr>
                  </table> </td>
              </tr>
              </table>
               <?php } ?>
              <table width="100%" cellpadding="3">
              <tr>
              <td colspan="3">
   
    <?php
			
			$ai=0;
			if($snp_no>0)
			{?>
             <a name="snp"> </a>
    <p class="style37"> <strong>SNPs </strong> </p>
    <?php if ($snp_no > 5)
	{ ?>
    <div align="right" onClick="toggle('nameit');"> <a href="#snp">Show/Hide all(<?php echo $snp_no; ?>)</a> </div>
    <?php } ?>
   
        <table width="100%" border="0" align="right" cellpadding="4" cellspacing="0">
      <tr class="style2" bgcolor="#DEEDEF">
      <td width="16%" height="29"> <strong><span class="style2">
        <div align="left"> 
        <strong><span onmouseover="tooltip.show('accession of refSNP cluster of one or more submitted snp in dbSNP database');" onmouseout="tooltip.hide();">SNP</span> </strong></td>
        <td width="25%" class="style2"><div align="center"><strong>SNP ID</strong></div></td>
        <td width="36%"><strong><span class="style2">Associated disease</span></strong></td>
        <td width="23%" align="left"><div align="left"><strong><span class="style2">References</span></strong></div></td>
        </tr>
      <?php $ii++;
	  while($row1=mysql_fetch_array($snp))
	{ 
	 ?>
     <tr valign="top"  <?php if($ai > 4) echo "nameit=fred id='hidethis'style='display:none'"; ?> >  
       
        <td><?php echo $row1["mutation"]; ?></td>
        <td><div align="center">
          <?php 
			$snp_id=$row1["snpid"];
			$snp_id = preg_replace('/\s+/', '', $snp_id);
			echo "<a href='https://www.ncbi.nlm.nih.gov/snp/$snp_id' target='_blank'>$snp_id</a>"; ?>
        </div></td>
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
			$pubmed_disease_pmid = "<a href='https://pubmed.ncbi.nlm.nih.gov/$pubmed_disease_pmd' target='_blank'>$pubmed_disease_pmd</a>";
			}
			else
			{
			$pubmed_disease_pmid=$pubmed_disease_pmid.", <a href='https://pubmed.ncbi.nlm.nih.gov/$pubmed_disease_pmd'  target='_blank'>$pubmed_disease_pmd</a>";
			}$xi++;
			}
			echo $pubmed_disease_pmid; ?>
        </div></td>
        </tr>
      <?php
	$ai++;
	$ii++; }
	  ?>
    </table>

          <?php 
	} ?>
     </td>
              </tr> </table>
              <table width="100%" cellspacing="3">
              
              
              <tr>
                <td colspan="3" valign="top">
                <?php
				$goo=mysql_query("select * from gene2go where GeneID='$gnen_id' and pmid !='-' order by type");
				$goi=0;
				$gon=mysql_num_rows($goo);
				if($gon > 0)
				{
			
	?>
               <a name="go"> </a> <p class="style37"> <strong>Gene Ontology (GO)</strong> </p>
                <div align="right" onClick="toggle('goin');"> <a href="#go">Show/Hide all(<?php echo $gon; ?> </a>)</div>
                <table width="90%" border="0" align="right" cellpadding="4" cellspacing="1">
                  <tr>
                    <td width="11%"> <strong>GO ID</strong> </td>
                    <td width="16%"> <strong>Ontology</strong> </td>
                    <td width="46%"> <strong>Function</strong> </td>
                    <td width="11%"> <strong> <a href="http://www.geneontology.org/GO.evidence.shtml" target="_blank" >Evidence</a> </strong> </td>
                    <td width="16%"> <strong>Reference</strong> </td>
                  </tr>
                  <?php while($rw1=mysql_fetch_array($goo))
	{ 
	?>
                  <tr <?php if($goi > 4) echo "goin=fred id='hidethis'style='display:none'";?> >
                  <td valign="top" > <?php $go_id=""; $go_id=$rw1["go_id"];
				  
				  echo "<a href='http://amigo.geneontology.org/amigo/term/$go_id' target = '_blank'>$go_id</a>"; ?> </td>
                    <td valign="top"> <?php $go_typ=$rw1["type"];
					$go_typ=ucfirst($go_typ);
					echo $go_typ; ?> </td>
                    <td valign="top"> <?php $go_fun=$rw1["go_function"];
					$go_fun=ucfirst($go_fun);
					echo $go_fun; ?> </td>
                    <td valign="top"> <?php echo $rw1["evidence"]; ?> </td>
                    <td valign="top"> <?php $go_pmid="";
					$go_pmid=$rw1["pmid"]; 
					$go_pmid = str_replace("|", ",", $go_pmid);
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
			$go_pp = "<a href='https://pubmed.ncbi.nlm.nih.gov/$go_pmid11/'  target='_blank'>".$go_pmid11."</a>";
			
			}
			else
			{
			$go_pp=$go_pp.", <a href='https://pubmed.ncbi.nlm.nih.gov/$go_pmid11/' target='_blank'>".$go_pmid11."</a>";
			}$xi++;
			}}
			echo $go_pp;?> </td>
                  </tr>
                  <?php $goi++; } ?>
                </table>
                <?php } ?> </td>
                </tr></table>
                <?php if($gene_type=="Gene")
				{ ?>
                <table width="100%" cellpadding="3">
              <tr>
                <td colspan="3"> <a name="protein"> </a> <div align="justify" class="style37">Protein Information</div> </td>
                </tr>
              <tr>
                <td width="1%">&nbsp;</td>
                <td width="20%" valign="top"> <div align="justify"> <strong><span onmouseover="tooltip.show('Name of protein in UniProt database');" onmouseout="tooltip.hide();">Protein Name</span></strong></div> </td>
                <td width="79%"> <div align="justify"> <?php $definition = $row["description"]; $definition =trim($definition);
					$definition=ucfirst($definition);	
		$rep = array(" | ", "  | ", "|", " |");
		$definition=str_replace($rep, ", ", $definition);
		echo $definition; ?> </div> </td>
              </tr>
            <tr>
              <td class="style14">&nbsp;</td>
                <td class="style14" valign="top"> <div align="justify"> <strong><span onmouseover="tooltip.show('Function of protein in UniProt database');" onmouseout="tooltip.hide();">Function</span></strong> </div> </td>
                <td class="style14">
                    <div align="justify">
                      <table width="100%" border="0">
                        <tr>
                          <td>
                          <?php $function = $row["function"];
		$function=str_replace("FUNCTION: ", "", $function);
		$function =preg_replace('/{(.*?).}/', '', $function);
		$function =preg_replace('/{(.PubMed:?).}/', '', $function);
		$function = preg_replace("/\.+$/", "", $function);
		$function = preg_replace("/~\s+/", "", $function);
		$function = preg_replace("/\.+$/", "", $function);
		echo $function;?> </td>
                        </tr>
                      </table>
                  </div> </td>
              </tr>
              <?php $rfp_ref=$row["ref_seq_proteins"]; 
			  if($rfp_ref !='')
			  {
			  ?>
              <tr>
              <td>&nbsp;</td>
              <td> <div align="justify"> <strong><div align="justify"> <strong><span onmouseover="tooltip.show('NCBI Refseq Proteins');" onmouseout="tooltip.hide();">Refseq Proteins</span></strong> </div> </td>
                <td> <div align="justify">
                  <?php 
			
			 
			$rfp_r=explode("|", $rfp_ref);
			$xi=0;
			foreach($rfp_r as $rfp_md1)
			{$rfp_md=trim($rfp_md1);
			if($xi == 0)
			{
			$rfp_mid = "<a href='http://www.ncbi.nlm.nih.gov/protein/$rfp_md'?report=GenPept target='_blank'>$rfp_md</a>";
			
			}
			else
			{
			$rfp_mid=$rfp_mid.", <a href='http://www.ncbi.nlm.nih.gov/protein/$rfp_md'?report=GenPept  target='_blank'>$rfp_md</a>";
			}$xi++;
			}
			echo $rfp_mid;
			 ?>
                 
                </div> </td>
              </tr>
              <?php }
			  $unip_id=$row["uniprot_id"];
			  if($unip_id !='')
			  {
			  ?>
              <tr>
              <td class="style14">&nbsp;</td>
              <td valign="top" class="style14"> <div align="justify" class="style51"> <strong> <strong> <strong>UniProt</strong></strong></strong></div> </td>
              <td class="style14"> <div align="justify">
			  <?php 
			  
			  $una=explode(",", $unip_id);
			  $xi=0;
			foreach($una as $unipd1)
			 {
						
			$unip=trim($unipd1);
			if($xi == 0)
			{
				
				$unip=trim($unip);
				$pmp="spid = '$unip'";
				
			$unipd = "<a href='http://www.uniprot.org/uniprot/$unip' target='_blank'>$unip</a>";
			}
			else
			{
				$pmp="$pmp OR spid = '$unip'";
				$unipd =$unipd.", <a href='http://www.uniprot.org/uniprot/$unip' target='_blank'>$unip</a>";
			}
			$xi++;
			 }
			 echo $unipd;
			 ?>
			  
			  

              </div> </td>
            </tr>
            <?php }
			$pdb_ref=$row["pdb_ids"];
			if($pdb_ref !='')
			  { 
			  $pdb_ref = str_replace(";", ",", $pdb_ref);
			?>
             
            <tr>
              <td class="style14">&nbsp;</td>
                <td class="style14"> <div align="justify"> <strong>PDB</strong></div> </td>
                <td class="style14">
                    <div align="justify">
                      <?php 
			
			 
			$pdb_r=explode(",", $pdb_ref);
			$xi=0;
			foreach($pdb_r as $pdb_md1)
			{$pdb_md=trim($pdb_md1);
			if($xi == 0)
			{
			$pdb_mid = "<a href='http://www.rcsb.org/pdb/explore/explore.do?structureId=$pdb_md' target='_blank'>$pdb_md</a>";
			
			}
			else
			{
			$pdb_mid=$pdb_mid.", <a href='http://www.rcsb.org/pdb/explore/explore.do?structureId=$pdb_md'  target='_blank'>$pdb_md</a>";
			}$xi++;
			}
			echo $pdb_mid;
			 ?>
                      <?php //echo $row["pdb_ids"];?>
                    </div> </td>
              </tr>
            
            <?php } 
			$ipr_ref=$row["interpro_ids"];
			if($ipr_ref !='')
			{
			?>
            <tr>
              <td class="style14">&nbsp;</td>
                <td valign="top" class="style14"> <div align="justify"> <strong><span onmouseover="tooltip.show('InterPro protein families, domains and important sites database.');" onmouseout="tooltip.hide();">InterPro</span></strong></div> </td>
                <td class="style14">
                    <div align="justify">
                      <?php 
			
			 
			$iprr=explode("|", $ipr_ref);
			$xi=0;
			foreach($iprr as $ipmd1)
			{$ipmd11=trim($ipmd1);
			$ipmd12=explode("#", $ipmd11);
			$ipmd = $ipmd12[0];
			$iprod = $ipmd12[1];
			if($xi == 0)
			{
			$ipmid = "<table width = 70%> <tr> <td> <strong>Accessions</strong> </td> </tr> <tr> <td> <a href='http://www.ebi.ac.uk/interpro/entry/$ipmd' target='_blank'>$ipmd</a>";
			
			}
			else
			{
			$ipmid=$ipmid.", <a href='http://www.ebi.ac.uk/interpro/entry/$ipmd' target='_blank'>$ipmd</a>";
			}$xi++;
			}
			$ipmid=$ipmid."</td</tr> </table>";
			echo $ipmid;
			 ?>
                      <?php //echo $row["interpro_ids"];?>
                  </div> </td>
              </tr>
              <?php } ?>
              </table>
              
            <?php }
					
		}	
	$pfamr=mysql_query("select DISTINCT pfam, id from pfam where $pmp");
			$pfam_no=mysql_num_rows($pfamr);
			if($pfam_no > 0)
			{			
			?><table width="100%">
            <tr>
              <td width="1%">&nbsp;</td>
              <td width="20%" valign="top"> <div align="justify"> <strong><span onmouseover="tooltip.show('Pfam database is collection of protein families');" onmouseout="tooltip.hide();">Pfam</span></strong></div> </td>
                <td width="79%">
                <table width="95%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="24%"> <strong>Pfam Accession</strong> </td>
    <td width="21%"> <strong>Pfam ID</strong> </td>
    
  </tr>
  <?php 
  while($fffm=mysql_fetch_array($pfamr))
  {
  ?>
  <tr>
    <td> <?php $pfaccn=$fffm["pfam"];
	echo "<a href= http://pfam.xfam.org/family/".$pfaccn." target='_blank'>".$pfaccn."</a>"; ?> </td>
    <td> <?php echo $fffm["id"]; ?> </td>
   
  </tr>
  <?php } ?>
</table>

                </td>
              </tr>
              <?php } ?></table>
            
</td></tr>

<?php if(($kegg_nu > 0) OR ($rect_nu > 0))
{ ?>
                <tr><td>
              <table width="97%" align="center" cellpadding="6">
          
            <tr>
              <td colspan="4" class="style14">
                <div align="justify" class="style37"><strong><a name="path" id="path"> </a>Pathways</strong></div></td>
              </tr>
            <tr>
              <td width="14%" class="style14">&nbsp;</td>
              <?php 
			   
			   if($kegg_nu > 0)
			   {
			  ?>
                <td width="38%" class="style14"> <div align="justify"> <strong><span onmouseover="tooltip.show('KEGG Pathway');" onmouseout="tooltip.hide();">KEGG</span></strong> </div> </td>
                <td width="6%" class="style14">&nbsp;</td>
                <?php }
				 
			   if($rect_nu > 0)
			   {
				?>
                <td width="42%" class="style14">
                    <div align="justify"> <strong><span onmouseover="tooltip.show('Reactome Pathway');" onmouseout="tooltip.hide();">Reactome</span></strong> </div></td> 
                    <?php } ?>
              </tr>
            <tr>
              <td class="style14">&nbsp;</td>
              <td class="style14" valign="top"><p align="justify"><?php 
			 $xi=0; 
  while($kpat=mysql_fetch_array($pathw))
  {
  $path_acc=$kpat["pathwayid"];
  $path_nam=$kpat["pathwayname"];
			 if($xi == 0)
			{
			$kmid = "<a href='http://www.genome.jp/dbget-bin/show_pathway?$path_acc+$gnen_id' target='_blank'>$path_nam</a>";
			}
			else
			{
			$kmid=$kmid."<br><a href='http://www.genome.jp/dbget-bin/show_pathway?$path_acc+$gnen_id' target='_blank'>$path_nam</a>";
			}$xi++;
			}
			echo $kmid; ?></p></td>
              <td class="style14" valign="top">&nbsp;</td>
              <td class="style14" valign="top"><p align="justify"><?php 
			  $kmid ="";
			  //echo "select * from reactome where entrezid='$gnen_id'";
			 
			 $xi=0; 
  while($rpat=mysql_fetch_array($pathr))
  {
  $path_acc=$rpat["pathwayid"];
  $path_nam=$rpat["pathwayname"];
			 if($xi == 0)
			{
			$kmid = "<a href='https://reactome.org/content/detail/$path_acc' target='_blank'>$path_nam</a>";
			}
			else
			{
			$kmid=$kmid."<br><a href='https://reactome.org/content/detail/$path_acc' target='_blank'>$path_nam</a>";
			}$xi++;
			}
			echo $kmid; ?></p></td>
            </tr>
           </table>
        </td></tr>
          <?php } ?>
           <tr>
           <td colspan="3">
              <div align="justify">
  <table width="97%" align="center">
    <tr><td width="2%">
      <?php 
	  if($gene_type=="Gene")
	  {
	  $int1=mysql_query("select * from gene_interaction where entrezid='$gnen_id'");
			  $int_cnt=mysql_num_rows($int1);
			  if($int_cnt > 0)
			  { ?>
      <tr>
        <td colspan="3" class="style14"><div align="justify" class="style37"><strong>Interactions</strong></div></td>
        </tr>
      <tr>
        <td class="style14">&nbsp;</td> <td width="13%" valign="top" class="style14"> <div align="justify" ></div> </td>
        <td width="85%" class="style14">
          <div align="justify">
            <table width="100%" border="0" cellpadding="1">
              <tr>
                <td width="32%"> <span class="style2"><span onmouseover="tooltip.show('Interaction in STRING protein - protein interaction database');" onmouseout="tooltip.hide();">STRING</span></span> </td>
                <td width="34%"> <span class="style2"><span onmouseover="tooltip.show('Interaction in MINT interaction database');" onmouseout="tooltip.hide();">MINT</span></span> </td>
                <td width="34%"> <span class="style2"><span onmouseover="tooltip.show('Interaction in I2D (Interologous Interaction Database)');" onmouseout="tooltip.hide();">IntAct</span></span> </td>
                </tr>
              <?php 
				
			
			while($row1=mysql_fetch_array($int1))
	{ 
	 
	 ?>
              <tr>
                <td valign="top"> <?php 
			$gcir_id=$row1["string"];
			 $lnk="";
			//mid="<a href='http://string-db.org/version_9_0/newstring_cgi/show_network_section.pl?identifier=9606.$gcir_id&all_channels_on=1&interactive=no&network_flavor=evidence&targetmode=proteins' target='_blank'>$gcir_id</a>";
			
			echo $gcir_id;
			 ?>                    </td>
                <td valign="top"> <?php $ext_id = $row1["MINT"];
					
					$lnk="<a href='https://mint.bio.uniroma2.it/index.php/results-interactions/?id=$ext_id' target='_blank'>$ext_id</a>";
					echo $lnk;
					?>                    </td>
                <td valign="top"> <?php 	$lnk="";				
					$intrid = $row1["IntAct"];
//$lnk="<a href='http://ophid.utoronto.ca/ophidv2.204/ForwardingServlet?proteins=$intrid&inputFormat=SWISSPROT_ID&ophidVersion=1.9&ophidOrganism=HUMAN&outputFormat=htmlOutput#protein $intrid' target='_blank'>$intrid</a>";
					echo $intrid;
			
					?>                    </td>
                </tr>
              
              <?php
	 }
	?>
              </table>
            </div> </td>
        </tr>
   
    <tr>
      <td valign="top">&nbsp;</td> <td valign="top">&nbsp;</td>
      <td valign="top">
        
        <a href="javascript:window.open('string_int.php?gene=<?php echo $gene; ?>','<?php echo $gene; ?>','width=1200,height=900'); void(0);">View interactions</a>
        </td>
      
      </tr>
      <?php } ?>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td> <td valign="top">&nbsp;</td>
      </tr>
     <?php
			  }
		 //echo "select diseaseName, pmid, source from disease_tertiary where geneId='$gene_n' order by diseaseName";
				
				
				$rresq=mysql_query("select * from gene_asso where gene_name_ncbi='$gene'");
				$dsn=mysql_num_rows($rresq);
				?>
                
    
    <tr>
      <td colspan="3" class="style14"> <a name="ref"> </a>
        <div align="justify" class="style37"> <strong>References</strong> </div> </td>
      </tr>
      <tr>
              <td class="style14">&nbsp;</td>
                <td colspan="2" class="style14"> 
                    <div align="justify">
                      
                
    <?php       if($dsn < 1)
			{
				if($pr_ref=="")
				{}
				else
				{
				 
                  $pr_ref = str_replace("|", ",", $pr_ref);
                 $prr=explode(",", $pr_ref);
				 //echo $pr_ref;
			$xi=0;
			foreach($prr as $pmd1)
			{
				$pmd=trim($pmd1);
			//echo "select * from pubmed where PubMed_Unique_Identifier = '$pmd' GROUP BY PubMed_Unique_Identifier";
				$rs1=mysql_query("select * from pubmed where PubMed_Unique_Identifier = '$pmd' GROUP BY PubMed_Unique_Identifier");
		$xap=0;
	while($rw2=mysql_fetch_array($rs1))
	{ $xap++;
		?>
    <table width="100%" border="0" align="right" cellpadding="5" cellspacing="=0">
      <tr>
            <td> <div align="justify"> <strong>PMID: </strong> <a href="https://pubmed.ncbi.nlm.nih.gov/<?php echo $rw2["PubMed_Unique_Identifier"];?>/" target="_blank" > <?php echo $rw2["PubMed_Unique_Identifier"];?> </a> </div> </td>
          </tr>
          <tr>
            <td>
              <h4 onClick="toggle('pri<?php echo $xap; ?>');"> <a href="#ref"> <?php echo $rw2["Title"];?> </a>
            </h4>
          <table width="100%" border="0" cellpadding="2" cellspacing="=0" align="left" >
           <tr>
            <td> <div align="justify"> <?php $auth = str_replace(',', '' ,$rw2["Full_Author"]);
			$auth = preg_replace('/[^(\x20-\x7F)]*/','', $auth);
			$auth = str_replace('|', ',' ,$auth);
			echo $auth;?> </div> </td>
          </tr>
          <tr pri<?php echo $xap; ?>=fred id="hidethis<?php echo $xap; ?>" style="display:none">
            <td> <div align="justify"> <?php echo $rw2["Affiliation"];?> </div> </td>
          </tr>
          <tr pri<?php echo $xap; ?>=fred id="hidethis<?php echo $xap; ?>" style="display:none">
            <td width="71%"> <div align="justify"> <?php echo $rw2["Source"];?> </div> </td>
          </tr>
          <tr pri<?php echo $xap; ?>=fred id="hidethis<?php echo $xap; ?>" style="display:none">
            <td> <div align="justify">
              <p> <div class="style26"> <strong>Abstract</strong> </div>
              <?php $abstract=$rw2["Abstract"];
			  $lookFor="PURPOSE:";
			  $replacement="<br> <strong>PURPOSE:</strong>";
			  $abstract=str_replace($lookFor, $replacement, $abstract);
			  $lookFor="OBJECTIVES:";
			  $replacement="<br> <strong>OBJECTIVES:</strong>";
			  $abstract=str_replace($lookFor, $replacement, $abstract);
			  $lookFor="OBJECTIVE:";
			  $replacement="<br> <strong>OBJECTIVE:</strong>";
			  $abstract=str_replace($lookFor, $replacement, $abstract);
			  $lookFor="BACKGROUND:";
			  $replacement="<br> <strong>BACKGROUND:</strong>";
			  $abstract=str_replace($lookFor, $replacement, $abstract);
			  $lookFor="METHODS:";
			  $replacement="<br> <strong>METHODS:</strong>";
			  $abstract=str_replace($lookFor, $replacement, $abstract);
			  $lookFor="RESULTS:";
			  $replacement="<br> <strong>RESULTS:</strong>";
			  $abstract=str_replace($lookFor, $replacement, $abstract);
			  $lookFor="CONCLUSIONS:";
			  $replacement="<br> <strong>CONCLUSIONS:</strong>";
			  $abstract=str_replace($lookFor, $replacement, $abstract);
			  echo $abstract;?> </div> </td>
          </tr>
        </table>
        
         </td>
          </tr> </table>  <?php }
			}
				}
			}?>       </td>
                </tr>
               
        <?php
				 $dsi=0;
				
				if($dsn > 0)
				{
				?>
    <tr>
      <td class="style14">&nbsp;</td>
      <td colspan="2" class="style14"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="right">
          <tr>
            <td> 
              <div align="right" onClick="toggle('othr');"> <a href="#othr">Show/Hide all(<?php echo $dsn; ?>)</a></div><div align="justify">
                <table width="100%" border="0" cellspacing="1" cellpadding="6">
                  <tr bgcolor="#DEEDEF">
                    <td width="6%" valign="top"><strong>PubMed ID</strong></td>
                    <td width="18%" valign="top"><strong>Disease</strong></td>
                    <td width="18%" valign="top"><strong>SNP/Mutation</strong></td>
                    <td width="20%" valign="top"><strong>Study population</strong></td>
                    <td width="14%" valign="top"><strong>Ethnicity</strong></td>
                    <td width="18%" valign="top"><strong>Age of study population</strong></td>
                    <td width="6%" valign="top"><strong>Type of sample</strong></td>
                    </tr>
                  <?php while($rw4=mysql_fetch_array($rresq))
	{ $zax++;?>
                  <tr <?php if($zax > 5) echo "othr=fred id='hidethis'style='display:none'";?><?php if($zax%2 == 0){ ?>bgcolor="#EEF5F7" <?php }
		else{ ?>bgcolor="#F3F3EB" <?php }?>>
                    <td valign="top"><div align="left">
                <a href="http://www.ncbi.nlm.nih.gov/pubmed/<?php echo $rw4["pmid"];?>" target="_blank" ><?php echo $rw4["pmid"];?>&nbsp;</a></div></td>
                    
                    <td valign="top"><div align="left"><?php $diss_nam = $rw4["disease_name"];
					$diss_nam = preg_replace('/[^(\x20-\x7F)]*/','', $diss_nam);
					echo $diss_nam;
					?>&nbsp;</div></td>
                    <td valign="top"><div align="left"><?php $gen_mut = $rw4["genetic_mutations"];
					$gen_mut = preg_replace('/[^(\x20-\x7F)]*/','', $gen_mut);
					echo $gen_mut;
					?>
					&nbsp;</div></td>
                    <td valign="top"><?php $stu_pop = $rw4["study_population"];
					$stu_pop = preg_replace('/\s+/', ' ', $stu_pop);
					echo $stu_pop;
					?>&nbsp;</td>
                    <td valign="top"><div align="left"><?php $ethnicity = $rw4["ethnicity"];
					$ethnicity = preg_replace('/\s+/', ' ', $ethnicity);
					echo $ethnicity;
					?>&nbsp;</div></td>
                    <td valign="top"><?php 
					
					$age_pop=$rw4["age"];
					
					$age_pop=str_replace("?"," &plusmn; ",$age_pop);
					$age_pop = preg_replace('/[^(\x20-\x7F)]*/','', $age_pop);
					$age_pop = preg_replace('/\s+/', ' ', $age_pop);
					echo $age_pop;
					?>&nbsp;</td>
                    <td valign="top"><div align="center"><?php echo $rw4["sample_type"];?></div></td>
                    </tr>
                  <?php }?>
                  </table>
                </div> </td>
            </tr>
          </table>
        
        </td>
      </tr>
    
    
    
    
  </table>
  <?php 
				}
		//$resx=mysql_query("select * from invitro where gene_name='$gene'");
	 // $ccmt1=mysql_num_rows($resx);
	  if ($ccmt1 > 0)
	  {
	  ?>
             
              <table width="97%" border="0" cellspacing="0" cellpadding="6" align="center">
                <tr>
    <td valign="middle"><p><strong>Unreviewed Literature:</strong></p></td>
    </tr>
</table><div align="right" onClick="toggle('invit');"> <a href="#invit">Show/Hide all(<?php echo $ccmt1; ?>)</a></div>
  <table width="97%" border="0" cellspacing="2" cellpadding="6" align="center">
  
  <tr bgcolor="#DEEDEF">
    <td width="11%"><div align="left"><strong>PubMed / </strong><strong>PMC ID</strong></div></td>
    <td width="77%"><strong>Title</strong></td>
    <td width="12%"><strong>Type of study</strong></td>
    
    </tr>
     <?php 
	 $zax1=0;
	 while($rw5=mysql_fetch_array($resx))
	{ $zax1++;?>
        <tr <?php if($zax1 > 5) echo "invit=fred id='hidethis'style='display:none'";?> <?php if($zax1%2 == 0){ ?>bgcolor="#FFFFE8" <?php }
		else{ ?>bgcolor="#F3F3EB" <?php }?>>
 
    <td><?php $lit=$rw5["literature"]; 
	$lit1=explode("|", $lit);
			
	$pmid=trim($lit1[0]);
	$pmcid=trim($lit1[1]);
			$pubid=explode(":", $pmid);
			$pmmid=trim($pubid[1]);
			if($pmmid !='')
			{
		echo "<a href=http://www.ncbi.nlm.nih.gov/pubmed/$pmmid target='_blank'>$pmmid</a>";
			}
			$pumcid=explode(":", $pmcid);
			$pmccid=trim($pumcid[1]);
			if($pmccid !='')
			{
echo ", <a href=http://www.ncbi.nlm.nih.gov/pmc/articles/$pmccid target='_blank'>$pmccid</a>";
			}
	
	?></td>
    <td><div align="left"><?php echo $rw5["title"];?>&nbsp;</div></td>
    <td><div align="left"><?php echo ucfirst($rw5["typ_study"]);?>&nbsp;</div></td>
   
    </tr>
    <?php } ?>
      </table>

      
      
        <?php } ?>
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