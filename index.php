<?php
session_start();
include("head.php");
date_default_timezone_set ("Asia/Calcutta");
$aaa= $_SERVER['REMOTE_ADDR']; 
$bbb=date("y/m/d : H:i:s" ,time());
$query="insert into log
  (IP, DAT_TIM)
values
  ('$aaa', '$bbb')";
mysql_query($query) or
die(mysql_error());
?>
<table width="90%" border="0" cellspacing="0" cellpadding="6" bgcolor="#FFFFFF" align="center">
  <tr>
    <td><table width="90%" border="0" cellspacing="0" cellpadding="20" align="center">
  <tr>
    <td><p align="justify"><font size="+1">Precocious puberty is an important endocrine disorder affecting children. It has been defined as the appearance of secondary sexual characteristics before the age of 8 yrs in females and 9 yrs in males. There are many research groups working towards understanding the causal factors of precocious puberty.</font></p>
    <p align="justify"><font size="+1">PrecocityDB is the first manually curated online database on genes, SNPs, pathways, and ontologies associated with precocious puberty.  The database has curated information of 44 genes, 235 pathways, 199 SNPs, and 26874 ontology terms associated with precocious puberty. SNP visualizer can be used for visualizing SNP coordinates and allelic variation on each chromosome for the genes associated with precocious puberty. Graphical representations of the pathway and disease enrichment analyses based on genes associated with precocious puberty can be viewed from the Enrichment analysis tab.</font></p>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
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