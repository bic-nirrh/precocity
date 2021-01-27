<?php
session_start();
include("head.php");

?>
 <script type="text/javascript">
var windowObjectReference = null; // global variable
var PreviousUrl; /* global variable that will store the
                    url currently in the secondary window */

function openRequestedSinglePopup(url) {
  if(windowObjectReference == null || windowObjectReference.closed) {
    windowObjectReference = window.open(url, "SingleSecondaryWindowName",
         "resizable,scrollbars,status");
  } else if(PreviousUrl != url) {
    windowObjectReference = window.open(url, "SingleSecondaryWindowName",
      "resizable=yes,scrollbars=yes,status=yes");
    /* if the resource to load is different,
       then we load it in the already opened secondary window and then
       we bring such window back on top/in front of its parent window. */
    windowObjectReference.focus();
  } else {
    windowObjectReference.focus();
  };

  PreviousUrl = url;
  /* explanation: we store the current url in order to compare url
     in the event of another call of this function. */
}
</script>

<table width="90%" border="0" cellspacing="10" cellpadding="6" bgcolor="#FFFFFF" align="center">
  <tr>
    <td><h2 align="center">Pathway enrichment analysis<sup><a href="help.php#patenr"><i style="font-size:12px;color:#1DA8BF" class="fa fa-question-circle" ></i></a></sup></h2>
    <table width="90%" border="0" cellspacing="0" cellpadding="20" align="center">
  <tr>
    <td><p align="justify"><font size="+1">Pathway enrichment analysis was performed on the manually curated gene-set and its transcription factors using <a href="https://maayanlab.cloud/Enrichr/" target="_blank">Enrichr</a>. The transcription factors of the gene-set were identified using <a href="https://www.grnpedia.org/trrust/" target="_blank">TRRUST V2</a>. <a href="https://www.genome.jp/kegg/pathway.html" target="_blank">KEGG database</a> was used as pathway resource. Pathways with P value &lt; 0.05 were selected. The pathways were clustered based on KEGG pathway terms using <a href="https://www.ncbi.nlm.nih.gov/pmc/articles/PMC2666812/" target="_blank">ClueGO</a>. The graphical representations of the observations can be seen below:</font></p></td>
  </tr>
</table>

    <table width="1050" border="1" cellspacing="0" cellpadding="20" align="center" bordercolor="#666666">
  <tr>
    <td>
      <p align="center"><a
 href="image/kegg_enrich.png"
 target="SingleSecondaryWindowName"
 onclick="openRequestedSinglePopup(this.href); return false;"
 title="Multi-level pie chart illustrating percent distribution of enriched KEGG pathways along with its parent terms obtained using PrecocityDB gene-set."
><img src="image/kegg_enrich.png" alt="1" style="width:100%; max-width:1000px"/></a>
      </p><p align="justify"><font size="+1">Multi-level pie chart illustrating percent distribution of enriched KEGG pathways along with its parent terms obtained using PrecocityDB gene-set.</font></p></td>
      </tr>
      <tr>
        <td align="center"><a
 href="image/kegg_enrich_tf.png"
 target="SingleSecondaryWindowName"
 onclick="openRequestedSinglePopup(this.href); return false;"
 title="Multi-level pie chart illustrating percent distribution of enriched KEGG pathways along with its parent terms obtained using transcription factors of PrecocityDB gene-set."
><img src="image/kegg_enrich_tf.png" style="width:100%; max-width:1000px"/></a><p align="justify"><font size="+1">Multi-level pie chart illustrating percent distribution of enriched KEGG pathways along with its parent terms obtained using transcription factors of PrecocityDB gene-set.</font></p>
          </td>
      </tr>
      <tr>
        <td align="center"><a
 href="image/pathway_bubbleplot.png"
 target="SingleSecondaryWindowName"
 onclick="openRequestedSinglePopup(this.href); return false;"
 title="Bubble plot illustration of KEGG pathways enriched in (A) PrecocityDB gene-set and (B) transcription factors of PrecocityDB gene-set."
><img src="image/pathway_bubbleplot.png" style="width:100%; max-width:1000px"/></a><p align="justify"><font size="+1">Bubble plot illustration of KEGG pathways enriched in (A) PrecocityDB gene-set and (B) transcription factors of PrecocityDB gene-set. The x-axis represents gene overlap score (provided by <a href="http://cbdm-01.zdv.uni-mainz.de/~jfontain/cms/?page_id=592" target="_blank">GS2D</a>) and y-axis indicates enriched pathway terms. Bubble size is proportional to P value of enriched pathways. Bubble color represents parent pathway term.</font></p>
          </td>
      </tr>  
      <tr>
        <td align="center"><a
 href="image/pathway_gene_cluster.png"
 target="SingleSecondaryWindowName"
 onclick="openRequestedSinglePopup(this.href); return false;"
 title="Clustering analysis of enriched pathways using PrecocityDB gene-set. Node size is proportional to P value. Edge represents at least one gene shared between two connecting nodes. Nodes within a cluster are colored based on the most significant pathway term (labelled in same color)."
><img src="image/pathway_gene_cluster.png" style="width:100%; max-width:1000px"/></a><p align="justify"><font size="+1">Clustering analysis of enriched pathways using PrecocityDB gene-set. Node size is proportional to P value. Edge represents at least one gene shared between two connecting nodes. Nodes within a cluster are colored based on the most significant pathway term (labelled in same color).</font></p></td>
      </tr>
      <tr>
        <td align="center"><a
 href="image/pathway_tf_cluster.png"
 target="SingleSecondaryWindowName"
 onclick="openRequestedSinglePopup(this.href); return false;"
 title="Clustering analysis of enriched pathways using transcription factors of PrecocityDB gene-set. Node size is proportional to P value. Edge represents at least one gene shared between two connecting nodes. Nodes within a cluster are colored based on the most significant pathway term (labelled in same color)."
><img src="image/pathway_tf_cluster.png" style="width:100%; max-width:1000px"/></a>
<p align="justify"><font size="+1">Clustering analysis of enriched pathways using transcription factors of PrecocityDB gene-set. Node size is proportional to P value. Edge represents at least one gene shared between two connecting nodes. Nodes within a cluster are colored based on the most significant pathway term (labelled in same color).</font></p></td>
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
</body>
</html>
