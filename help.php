<?php
session_start();
include("head.php");
?>


<table width="90%" border="0" cellspacing="0" cellpadding="6" bgcolor="#FFFFFF" align="center">
  <tr>
    <td><table width="90%" border="0" align="center" cellpadding="20" cellspacing="0">
  <tr>
    <td><table width="95%" border="0" cellspacing="0" cellpadding="20" align="center">
      <tr>
          <td><h2 align="center"><strong>Help</strong></h2>
            <ul>
              <li><strong><font size="+1">Homepage</font></strong></li>
            </ul>
            <blockquote>
              <p align="justify"><font size="+1">PrecocityDB<strong> </strong>is a comprehensive  database dedicated to an endocrine disorder, Precocious Puberty (PP). The homepage provides a short  description of the disease and database contents. The database has manually  curated genes, SNPs associated with PP along with pathways and ontologies  associated with these genes.</font></p>
            </blockquote>
            <p align="center"><font size="+1">
              Data can be retrieved using the navigation tabs (menu bar) on  the top of the webpage</font><br />
              <img src="image/fig1.png" alt="1" style="width:100%;max-width:900px" /> <br />
             <font size="+1"> Database statistics and our contact information is available on  the bottom of the webpage </font><br />
              <img src="image/fig2.png" alt="2" style="width:100%;max-width:900px" /></p>
<ul>
  <li><strong><font size="+1">Search</font></strong>   
   
    <ul>
      <a name="quicksearch" id="quicksearch"></a>
      <li><strong><font size="+1">Quick Search</font></strong></li>
    </ul>
  </li>
  </ul>
            <blockquote>
              <p align="justify"><font size="+1">Quick search option in PrecocityDB allows users to query the whole database based  on keywords. The number of hits, from each section of the database along with  section name, is listed as a result. The results are hyperlinked to the  detailed search result of the respective section. <br />
                There are two search options: 1. Search, 2. Exact  search. Exact search matches the precise keyword, displays specific hits for  any id or symbol.</font></p>
              <p align="justify"><font size="+1">
                Note: Only the first keyword will be considered  for search if multiple keywords are given separated by space. Any other  delimiter is invalid.</font></p>
              <blockquote>
                <p align="center">
                  <img src="image/fig3.png" alt="3" style="width:100%;max-width:480px" /></p>
                  <p align="center"><img src="image/fig4_a.png" alt="5" width="338" height="256" /><img src="image/fig4_b.png" width="432" height="247" alt="4b" /></p>
                <p align="center"><img src="image/fig5.png" alt="8" style="width:100%;max-width:900px"/></p>
              </blockquote>
              
              </blockquote>
              <a name="advancesearch"></a>
              <ul>
                <ul>
                  <li><strong><font size="+1">Advanced Search</font></strong></li>
                  </ul>
              </ul>
            <p align="justify"><font size="+1">Advanced search in PrecocityDB allows users to search the database section-wise by selecting  fields and applying logical operators (AND, OR, NOT).</font></p>
            <table border="1" cellspacing="0" cellpadding="0" width="90%" align="center">
              <tr>
                <td width="210"><p>Title</p></td>
                <td width="312"><p>Sub-headings</p></td>
                <td width="312"><p>Description</p></td>
              </tr>
              <tr>
                <td width="210" rowspan="8"><p>Gene    Information</p></td>
                <td width="312"><p>Gene    Symbol</p></td>
                <td width="312"><p>Unique    gene symbol provided/ assigned by HUGO Gene Nomenclature Committee (HGNC)</p></td>
              </tr>
              <tr>
                <td width="312"><p>Aliases</p></td>
                <td width="312"><p>Synonyms    or known terms for genes. These are unapproved nomenclature used in old    literature.</p></td>
              </tr>
              <tr>
                <td width="312"><p>Entrez    Gene ID</p></td>
                <td width="312"><p>A    unique identification number assigned to every new gene record by NCBI </p></td>
              </tr>
              <tr>
                <td width="312"><p>Gene    Name</p></td>
                <td width="312"><p>A    unique name provided/ assigned by HUGO Gene Nomenclature Committee (HGNC) </p></td>
              </tr>
              <tr>
                <td width="312"><p>Chromosomal    Location</p></td>
                <td width="312"><p>It    provides information regarding the location of genes on a chromosome.</p></td>
              </tr>
              <tr>
                <td width="312"><p>Gene    Summary</p></td>
                <td width="312"><p>It    provides a short description of the gene from the NCBI Gene database.</p></td>
              </tr>
              <tr>
                <td width="312"><p>RefSeq    DNA</p></td>
                <td width="312"><p>RefSeq    DNA ID</p></td>
              </tr>
              <tr>
                <td width="312"><p>RefSeq    mRNA</p></td>
                <td width="312"><p>RefSeq    mRNA ID</p></td>
              </tr>
              <tr>
                <td width="210" rowspan="4"><p>Gene    Ontology</p></td>
                <td width="312"><p>Gene    Symbol</p></td>
                <td width="312"><p>Symbol    or aliases of the gene</p></td>
              </tr>
              <tr>
                <td width="312"><p>GO    ID</p></td>
                <td width="312"><p>The    Gene Ontology (GO) ID</p></td>
              </tr>
              <tr>
                <td width="312"><p>Ontology</p></td>
                <td width="312"><p>Biological    domain with three aspects: Molecular function, Cellular components, and    Biological processes.</p></td>
              </tr>
              <tr>
                <td width="312"><p>Function</p></td>
                <td width="312"><p>Sections    under three main biological domains.</p></td>
              </tr>
              <tr>
                <td width="210" rowspan="5"><p>Protein    Information</p></td>
                <td width="312"><p>Protein    Name</p></td>
                <td width="312"><p>It    reports the name(s) assigned to the protein in NCBI</p></td>
              </tr>
              <tr>
                <td width="312"><p>Function</p></td>
                <td width="312"><p>A    short description of the protein from UniProt.</p></td>
              </tr>
              <tr>
                <td width="312"><p>RefSeq    Protein</p></td>
                <td width="312"><p>RefSeq    Protein ID</p></td>
              </tr>
              <tr>
                <td width="312"><p>UniProt</p></td>
                <td width="312"><p>A    unique accession number assigned to the product. A protein can have more than    one accession number.</p></td>
              </tr>
              <tr>
                <td width="312"><p>RCSB    PDB</p></td>
                <td width="312"><p>A    unique identifier assigned to the new entry of a structure reported in    Protein Data Bank (PDB)</p></td>
              </tr>
              <tr>
                <td width="210" rowspan="3"><p>Associated    Pathways</p></td>
                <td width="312"><p>Gene    Symbol</p></td>
                <td width="312"><p>Symbol    or aliases of the gene</p></td>
              </tr>
              <tr>
                <td width="312"><p>Pathway    Name</p></td>
                <td width="312"><p>Name    assigned to the process.</p></td>
              </tr>
              <tr>
                <td width="312"><p>Pathway    ID</p></td>
                <td width="312"><p>A    unique identifier assigned to a pathway in KEGG pathways and Reactome</p></td>
              </tr>
              <tr>
                <td width="210" rowspan="3"><p>SNPs</p></td>
                <td width="312"><p>Gene    Symbol</p></td>
                <td width="312"><p>Symbol    or aliases of the gene</p></td>
              </tr>
              <tr>
                <td width="312"><p>SNP    ID</p></td>
                <td width="312"><p>A    unique identification code assigned to the mutation in the gene sequence.</p></td>
              </tr>
              <tr>
                <td><p>SNP</p></td>
                <td><p>Change    in the nucleotide</p></td>
              </tr>
              <tr>
                <td width="210" rowspan="5"><p>Reference</p></td>
                <td width="312"><p>Pubmed    ID</p></td>
                <td width="312"><p>An    identifier for published and freely- accessible articles</p></td>
              </tr>
              <tr>
                <td width="312"><p>Title</p></td>
                <td width="312"><p>Title    of the article</p></td>
              </tr>
              <tr>
                <td width="312"><p>Author</p></td>
                <td width="312"><p>Author(s)    of the article</p></td>
              </tr>
              <tr>
                <td width="312"><p>Abstract</p></td>
                <td width="312"><p>Abstract    of the article</p></td>
              </tr>
              <tr>
                <td width="312"><p>Source</p></td>
                <td width="312"><p>The    source of article</p></td>
              </tr>
            </table>
            <p><img src="image/fig6.png" alt="7" style="width:100%;max-width:900px"/> <br />
             <font size="+1"> Note:  Queries  can be build combining options using 'AND', 'OR' from one section at a time.</font></p>
            <p align="center"><img src="image/fig7.png" alt="8" style="width:100%;max-width:900px"/></p>
            <ul>
              <li><strong><font size="+1">Browse</font></strong>
              </li>
            </ul>
            <blockquote>
              <p align="justify"><font size="+1">Browse enables users to  surf the database for genes, SNPs, pathways, and ontology associated with PP.  The information available on each page is explained below:</font></p>
            <a name="brgenes"></a> <p align="justify"><strong><font size="+1">Genes:</strong> The genes associated with PP can be browsed in the gene browse  page. Links to complete information on manually curated genes are also provided  and the rest are hyperlinked to respective NCBI page. Complete information on  the manually curated genes has detailed information about protein, gene  ontology, associated pathways, and associated literature references. </font></p>
		<p align="center"> 
              <img src="image/fig_7b.png" alt="9" style="width:100%;max-width:900px"/> <br />
              <font size="+1">Meta-data of genes can be downloaded in a tab-separated file by selecting the checkboxes beside genes.</font></p>
            <a name="brsnp"></a>  <p align="justify"><font size="+1"><strong>SNPs:</strong>&nbsp;This option lists all SNPs associated with PP, along with  links to reference literature and the dbSNP database. </font> </p>
              <a name="brpathway"></a><p align="justify"><font size="+1"><strong>Pathways:</strong>&nbsp;The different metabolic/signaling pathways associated with  genes in the database can be browsed. Links to the KEGG/Reactome pathway  database is provided here.</font></p>
             <a name="ontology"></a> <p align="justify"><font size="+1"><strong>Ontologies:</strong>&nbsp;The different ontology terms associated with genes in the  database can be browsed here and ontologies are linked to GO page. Each ontology  term is associated with many genes, and genes are also linked to pathways and  diseases in the detailed information page of ontology.<br />
                All the  above-mentioned pages can be filtered, queried using keywords, and browsed by  alphabets. One or more of these can be clubbed to get more specific results.</font></p>
            </blockquote>
            <a name="ideo"></a>
            <ul>
              <li><strong><font size="+1">Chromosomal location of SNPs associated with precocious puberty</font></strong>
                </li>
            </ul>
            <blockquote>
              <p align="justify"><font size="+1">This tab allows to visualize  chromosomal coordinates of SNPs associated with PP. Chromosomes are shown as  vertical bars, wherein SNPs are marked in red. For details of a particular SNP,  the chromosome can be selected and the SNP ID, chromosome number and nucleotide  position can be seen by hovering over the red triangles.</font></p>
            </blockquote>
            <p align="center"> 
              <img src="image/fig8.png" alt="9" width="500" height="200" /> <br />
              <font size="+1">Multiple red triangles at a  single location indicates presence of SNPs in less than 350000 nucleotide  length.</font></p>
            <ul>
              <li><strong><font size="+1">Enrichment analysis</font></strong>
              </li>
            </ul>
            <blockquote>
              <a name="patenr"></a><p><font size="+1">This tab displays the result  of pathway and disease enrichment analysis using the data available in  PrecocityDB.</font></p>
            </blockquote>
            <ul>
              <ul>
                <li>
                  <div align="justify"><font size="+1"><strong>Pathway enrichment</strong> – Online available tool  <a href="https://maayanlab.cloud/Enrichr/" target="_blank">Enrichr</a>  was used to check  significant overlap of PrecocityDb genes and their transcription factors with  KEGG pathway&rsquo;s gene sets. Pathways were ranked based on adjusted <em> P </em> value computed by Fisher’s exact test. Adjusted <em> P </em> value is calculated by first computing <em> P </em> value for many random input gene lists. This is then used as a lookup table of expected ranks with their variances. Adjusted <em> P </em> value denotes the independence for probability of PrecocityDb genes belonging to KEGG pathway’s gene sets, i.e pathways will be assigned lower <em> P </em> value when the combination of input gene overlapping with the pathway genes are not by chance or less random.</font></div>
                  </li>
                </ul>
              <blockquote>
                <p align="justify"><font size="+1">Enriched KEGG pathways were then mapped to their parent pathway groups  using KEGG database. Cytoscape app ClueGO was used to cluster enriched  pathways. The results were represented in 3 different types of plots 1.  Multilayered pie (generated using Excel), 2. Bubble plot (generated in R;  <a href="https://ggplot2.tidyverse.org/" target="_blank">ggplot2 package</a> ) and 3. Pathway network clusters <a href="http://apps.cytoscape.org/apps/cluego" target="_blank">( ClueGO)</a>  . </font></p>
                </blockquote>
                <a name="disenr"></a>
              <ul>
                <li>
                  <div align="justify"><font size="+1"><strong>Disease  enrichment</strong> - A publically available web resource, <a href="http://cbdm-01.zdv.uni-mainz.de/~jfontain/cms/?page_id=592" target="_blank">Gene  set to Diseases (GS2D)</a> was used for performing disease enrichment. Similar  to pathways, diseases were also ranked based on <em>P</em> value.</font></div>
                  </li>
                </ul>
              <blockquote>
                <p align="justify"><font size="+1">Enriched disease terms were mapped to single parent group  based on a rule based method used in <a href="https://www.nature.com/articles/s41598-020-71418-8" target="_blank">PCOSKB R2</a>. The  results were represented in 3 different types of plots 1. Multilayered pie  (generated using Excel), 2. Bubble plot (generated in R; <a href="https://ggplot2.tidyverse.org/" target="_blank">ggplot2 package</a>) and 3.  Disease networks (generated using <a href="https://d3js.org/" target="_blank">D3 js</a>).</font></p>
                </blockquote>
            </ul>            </td>
        </tr>
    </table>
      <h2 align="center">&nbsp;</h2></td>
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