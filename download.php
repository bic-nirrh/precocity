<?php

date_default_timezone_set('Asia/Calcutta');
header('Content-type: plain/text');
header('Content-Disposition: attachment; filename="'."precocity_gene"."_".date('Y-m-d H-i-s').'.txt"');
	
echo "Gene_Symbol\tAliases\tEntrez_Gene_ID\tGene_Name\tChromosomal_Location\tHGNC_ID\tGene_Summary\tRefSeq_DNA\tRefSeq_mRNA\tEnsembl_Gene\tEnsembl_transcript\tEnsembl_protein\tSNPs\tGene_Ontology\tProtein_Name\tProtein_Function\tRefseq_Proteins\tUniProt\tPDB\tKEGG_pathways\tReactome_pathway\tPrimary_references\n";
include('connect.php');
foreach($_REQUEST["genes"] as $gene_n)
{ //echo "select * from gene where gene_name = '$gene_n'";
	$res=mysql_query("select * from gene where gene_name = '$gene_n'"); 
	while($row=mysql_fetch_array($res))
	{
		$gene=$row["gene_name"]; 
		$gnen_id=$row["entrez_gene"];
		$pr_ref=$row["primary_references"];
		
		$snp=mysql_query("select * from snp where gene_symbol='$gene'");
			$snp_no=mysql_num_rows($snp);
			
			$pathw=mysql_query("select pathwayid, pathwayname from kegg_path where entrezid='$gnen_id'");
			   $kegg_nu=mysql_num_rows($pathw);
			  $pathr=mysql_query("select * from reactome where entrezid='$gnen_id'");
				  $rect_nu=mysql_num_rows($pathr); 
			   
		$gene_type="Gene"; 
		$pr_ref=$row["primary_references"];
#gene_symbol		
  echo $gene; 
  echo "\t";
   $aliases=$row["aliases"];
	#aliases
					  $aliases = str_replace("|", ", ", $aliases);
				  echo "$aliases";  echo "\t";
              		#entrez_id
				  echo $gnen_id;
				  echo "\t";
                 $official_name = $row["approved_name"]; 
					$official_name =trim($official_name);
					$official_name=ucfirst($official_name);	
		$rep = array(" | ", "  | ", "|", " |");
		$official_name=str_replace($rep, ", ", $official_name);
		#tGene_Name
		echo $official_name;
		echo "\t";
		
		 $genomic_loc = $row["genomic_loc"]; $genomic_loc = trim($genomic_loc, "\s"); 
			#Chromosomal_Location
			echo $genomic_loc; 
			echo "\t";
			
			$hgnc_ref=$row["hgnc_id"];
			 
			#hgnc id
			echo $hgnc_ref;
			echo "\t";
			
			#Entrez summary
			 $entrez_summary=$row["entrez_summary"];
			   echo $entrez_summary;
			   echo "\t";
			   
			
			  $rseq_id=$row["refseq_dna_seq"];
			  #tRefSeq_DNA
			 echo $rseq_id;
			echo "\t";
			
			 
			  $rfm_ref=$row["refseq_mrnas"];
			  
			#tRefSeq_mRNA
			echo $rfm_ref;
			 echo "\t";
			  $ensa_id=$row["ensembl_ids"];
			  echo $ensa_id;
			echo "\t";
			  $enst_ref=$row["ensembl_ids_transcripts"];
			  echo $enst_ref;
			echo "\t";
			  $ensp_ref=$row["ensembl_proteins"];
			  echo $ensp_ref;
			echo "\t";
			$ai=0;
			
			if($snp_no>0)
			{
				 $ii=0;
	  while($row1=mysql_fetch_array($snp))
	{ 
	if($ii < 1)
	{
	  echo $row1["mutation"]; 
	}
	else
	{
		echo "#".$row1["mutation"]; 
	}
			$snp_id=$row1["snpid"];
			$snp_id = preg_replace('/\s+/', '', $snp_id);
			echo "|".$snp_id;  
			$func_sig=ucfirst($row1["disease"]);
			echo "|".$func_sig; 
			$pubmed_disease_pr_ref=$row1["pmid"]; 
		  $pubmed_disease_pr_ref = preg_replace('/\s+/', '', $pubmed_disease_pr_ref);
		  
			echo "|$pubmed_disease_pr_ref"; 
       
	
	$ii++; }
	  
	} 
     echo "\t";
	 
				$goo=mysql_query("select * from gene2go where GeneID='$gnen_id' and pmid !='-' order by type");
				$goi=0;
				$gon=mysql_num_rows($goo);
				if($gon > 0)
				{
	
                while($rw1=mysql_fetch_array($goo))
	{ 
	 $go_id=""; 
	 $go_id=$rw1["go_id"];
	 if($goi < 1)
	{
	  echo $go_id; 
	}
	else
	{
		echo "#".$go_id; 
	}
				  
				  echo $go_id;  
				  $go_typ=$rw1["type"];
					$go_typ=ucfirst($go_typ);
					echo "|".$go_typ; 
					 $go_fun=$rw1["go_function"];
					$go_fun=ucfirst($go_fun);
					echo "|".$go_fun; 
					echo "|".$rw1["evidence"]; 
					 $go_pmid="";
					$go_pmid=$rw1["pmid"]; 
					$go_pmid = str_replace("|", ",", $go_pmid);
					
			echo "|".$go_pmid; 
			$goi++; } } 
			echo "\t";
			 $definition = $row["description"]; $definition =trim($definition);
					$definition=ucfirst($definition);	
		$rep = array(" | ", "  | ", "|", " |");
		$definition=str_replace($rep, ", ", $definition);
		echo $definition; 
		echo "\t";
                           $function = $row["function"];
		$function=str_replace("FUNCTION: ", "", $function);
		$function =preg_replace('/{(.*?).}/', '', $function);
		$function =preg_replace('/{(.PubMed:?).}/', '', $function);
		$function = preg_replace("/\.+$/", "", $function);
		$function = preg_replace("/~\s+/", "", $function);
		$function = preg_replace("/\.+$/", "", $function);
		echo $function;
		echo "\t";
		 $rfp_ref=$row["ref_seq_proteins"]; 
			  	  		
			$rfp_ref = str_replace("|", ",", $rfp_ref);
			
			echo $rfp_ref;
			echo "\t";
                  
			 
			  $unip_id=$row["uniprot_id"];
			 
			 echo $unip_id;
			 echo "\t";
			 
			$pdb_ref=$row["pdb_ids"];
			
			  $pdb_ref = str_replace(";", ",", $pdb_ref);
			  echo $pdb_ref;
			 echo "\t";
			
			$ipr_ref=$row["interpro_ids"];
			
			 $ipr_ref = str_replace("|", ",", $ipr_ref);
			
			//echo $ipr_ref;
			//echo "\t";
			 
	//$pfamr=mysql_query("select DISTINCT pfam, id from pfam where $pmp");
			$pfam_no=mysql_num_rows($pfamr);
			if($pfam_no > 0)
			{			
			$pfi=0;
  while($fffm=mysql_fetch_array($pfamr))
  {
   $pfaccn=$fffm["pfam"];
	if($xi < 1)
	{
	echo $pfaccn."|".$fffm["id"];  
	}
	else
	{
		echo "#".$pfaccn."|".$fffm["id"];
	}
$pfi++;
	}
	
			}
			//echo "\t";
	 $xi=0; 
  while($kpat=mysql_fetch_array($pathw))
  {
  $path_acc=$kpat["pathwayid"];
  $path_nam=$kpat["pathwayname"];
  if($xi < 1)
	{
	  echo "$path_nam|$path_acc"; 
	}
	else
	{
		echo "#$path_nam|$path_acc"; 
	}
			$xi++;
			}
			echo "\t";
			 $xi=0; 
  while($rpat=mysql_fetch_array($pathr))
  {
  $path_acc=$rpat["pathwayid"];
  $path_nam=$rpat["pathwayname"];
			if($xi < 1)
	{
	  echo "$path_nam|$path_acc"; 
	}
	else
	{
		echo "#$path_nam|$path_acc"; 
	}
			$xi++;
			}
			echo "\t";
           
                 $rresq=mysql_query("select * from gene_asso where gene_name_ncbi='$gene'");
				 
				$dsn=mysql_num_rows($rresq);
				$pmio=0;
				while($rw4=mysql_fetch_array($rresq))
	{
		if($pmio < 1)
		{
			echo $rw4["pmid"]."|";
			}
		else
		{
			echo "#".$rw4["pmid"]."|";
			}
			
		
		$diss_nam = $rw4["disease_name"];
					$diss_nam = preg_replace('/[^(\x20-\x7F)]*/','', $diss_nam);
					echo $diss_nam."|";
					 $gen_mut = $rw4["genetic_mutations"];
					$gen_mut = preg_replace('/[^(\x20-\x7F)]*/','', $gen_mut);
					echo $gen_mut."|";
					$stu_pop = $rw4["study_population"];
					$stu_pop = preg_replace('/\s+/', ' ', $stu_pop);
					echo $stu_pop."|";
					$ethnicity = $rw4["ethnicity"];
					$ethnicity = preg_replace('/\s+/', ' ', $ethnicity);
					echo $ethnicity."|";
					$age_pop=$rw4["age"];
					
					$age_pop=str_replace("?"," &plusmn; ",$age_pop);
					$age_pop = preg_replace('/[^(\x20-\x7F)]*/','', $age_pop);
					$age_pop = preg_replace('/\s+/', ' ', $age_pop);
					echo $age_pop."|";
					echo $rw4["sample_type"];
				
				 
				 $pmio++;
	}
				
}
echo "\n";
}
?>