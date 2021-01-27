<?php
session_start();
include("head.php");
?>


<table width="90%" border="0" cellspacing="0" cellpadding="6" bgcolor="#FFFFFF" align="center">
  <tr>
    <td>
    <form id="form1" name="form1" method="post" action="feedback_sub.php">
          
          <table width="80%" border="0" align="center" cellpadding="4" cellspacing="0">
            <tr>
              <td colspan="2" align="center"><h2>Feedback Form</h2></td>
              </tr>
            <tr>
              <td width="30%"><font size="+1">Name</font></td>
              <td width="70%"><span id="sprytextfield2">
                <input type="text" name="nme" id="textfield" />
                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>
            <tr>
              <td><font size="+1">Email ID</font></td>
              <td><span id="sprytextfield1">
                <input type="text" name="email" id="textfield2" />
                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>
            <tr>
              <td><font size="+1">Organization</font></td>
              <td><input type="text" name="org" id="textfield3" /></td>
            </tr>
            <tr>
              <td><font size="+1">Feedback</font></td>
              <td><textarea name="msg" id="textarea" cols="45" rows="5"></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Send" />
                 <input type="reset" name="button2" id="button2" value="Reset" /></td>
              </tr>
          </table>
          
        </form>     
    <p>&nbsp;</p></td>
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
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
//-->
</script>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
    </body>
</html>