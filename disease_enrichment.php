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
    <td><h2 align="center">Disease enrichment analysis<sup><a href="help.php#disenr"><i style="font-size:12px;color:#1DA8BF" class="fa fa-question-circle" ></i></a></sup></h2>
    <table width="90%" border="0" cellspacing="0" cellpadding="20" align="center">
  <tr>
    <td>
    <p align="justify"><font size="+1">Gene-disease associations were derived for the curated gene-set based on statistically significant co-occurrences of genes and diseases in PubMed literature by using the <a href="http://cbdm-01.zdv.uni-mainz.de/~jfontain/cms/?page_id=592" target="_blank">G2SD</a> tool. Diseases with P value &lt; 0.05 were selected. The graphical output can be seen below:</font></p></td></tr></table>
    <table width="1050" border="1" cellspacing="0" cellpadding="20" align="center" bordercolor="#666666">
    <tr>
        <td align="center"><p align="center"><a
 href="image/disease_pie.png"
 target="SingleSecondaryWindowName"
 onclick="openRequestedSinglePopup(this.href); return false;"
 title="Multi-level pie chart illustrating percent distribution of enriched diseases obtained using PrecocityDB gene-set and GS2D."
><img src="image/disease_pie.png" style="width:100%; max-width:1000px"/></a>
        <p align="justify"><font size="+1">Multi-level pie chart illustrating percent distribution of enriched diseases obtained using PrecocityDB gene-set and GS2D.</font></p>
          </td>
      </tr>
      <tr>
        <td align="center">
        <a
 href="image/disease_network.png"
 target="SingleSecondaryWindowName"
 onclick="openRequestedSinglePopup(this.href); return false;"
 title="Disease-disease association network for PP. Edges represent at least one gene shared between two connecting nodes. Node color represents parent disease term and node size is proportional to P value of disease enrichment analysis."
>
<img src="image/disease_network.png" style="width:100%; max-width:1000px"/><p align="justify"><font size="+1">Disease-disease association network for PP. Edges represent at least one gene shared between two connecting nodes. Node color represents parent disease term and node size is proportional to P value of disease enrichment analysis.</font></td>
      </tr>
      <tr>
        <td align="center">
        <a
 href="image/disease_bubbleplot.jpg"
 target="SingleSecondaryWindowName"
 onclick="openRequestedSinglePopup(this.href); return false;"
 title="Bubble plot illustration of enriched diseases in PP. The x-axis  represents gene overlap score (as given by GS2D) and y-axis indicates enriched  disease terms. Bubble size is proportional to P value of enriched diseases.  Bubble color represents parent disease term."
>
<img src="image/disease_bubbleplot.jpg" style="width:100%; max-width:1000px"/>
</a>
          <p align="justify"><font size="+1">Bubble plot illustration of enriched diseases in PP. The x-axis  represents gene overlap score (as given by GS2D) and y-axis indicates enriched  disease terms. Bubble size is proportional to P value of enriched diseases.  Bubble color represents parent disease term.</font></p></td>
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
