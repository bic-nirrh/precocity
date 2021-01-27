<?php
session_start();
include("head.php");
?>


<table width="90%" border="0" cellspacing="10" cellpadding="6" bgcolor="#FFFFFF" align="center">
  <tr>
    <td><h2 align="center">Analysis</h2>
    <table width="950" border="1" cellspacing="0" cellpadding="20" align="center" bordercolor="#666666">
  
  <tr>
    <td>
      
      <p align="center"><img src="image/pathway_gene_pie.jpg" alt="Snow" style="width:100%;max-width:900px" />
      </p><h3 align="center">A multilayered pie representation of the enriched pathways and their groups, using PrecocityDB gene set.</h3></td>
      </tr>
      <tr>
        <td align="center"><img src="image/pathway_tf_pie.jpg" style="width:100%;max-width:900px" /><h3>A multilayered pie representation of the enriched pathways and their groups, using transcription factors of PrecocityDB gene set</h3>
          </td>
      </tr>
      <tr>
        <td align="center"><img src="image/pathway_bubbleplot.jpg" style="width:100%;max-width:900px" /><h3>Bubble plot illustrating the pvalue of the enriched KEGG pathways using (A) PrecocityDB gene set. (B) Transcription factors of the PrecocityDB gene set. The x-axis represents the gene overlap score (as given by GS2D) and y-axis indicates enriched disease terms. Bubble size is proportional to the pvalue of the enriched diseases. Bubble color represents parent pathway term</h3>
          </td>
      </tr>
      <tr>
        <td align="center"><img src="image/disease_pie.jpg" style="width:100%;max-width:900px" /><h3>A multilayered pie representation of the diseases enriched by GS2D using PrecocityDB gene set.</h3>
          </td>
      </tr>
      <tr>
        <td align="center"><img src="image/disease_network.png" style="width:100%;max-width:900px" /><h3>A network of enriched diseases illustrating the association of one enriched disease with another enriched disease. The node colour represents parent disease term and node size is proportional to the pvalue</h3></td>
      </tr>
      <tr>
        <td align="center"><img src="image/disease_bubbleplot.jpg" style="width:100%;max-width:900px" /><h3>Bubble plot illustrating the pvalue of the enriched diseases. The x-axis represents the gene overlap score (as given by GS2D) and y-axis indicates enriched disease terms. Bubble size is proportional to the pvalue of the enriched diseases. Bubble color represents parent pathway term.</h3></td>
      </tr>
      <tr>
        <td align="center"><img src="image/pathway_gene_cluster.jpg" style="width:100%;max-width:900px" /><h3>Graphical representation of clustering analysis of enriched pathways using PrecocityDB gene set</h3></td>
      </tr>
      <tr>
        <td align="center"><img src="image/pathway_tf_cluster.jpg" style="width:100%;max-width:900px" /><h3>Graphical representation of clustering analysis of enriched pathways using transcription factor of PrecocityDB geneset</h3></td>
      </tr>
    </table>
      
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
