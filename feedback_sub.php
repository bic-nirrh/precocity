<?php
session_start();
include("head.php");
?>
<?php

 if(($_SESSION['security_code'] == $_POST['security_code']) && (!empty($_SESSION['security_code'])) ) 
		{
	$from  = $_POST['email']; 
$nme = $_POST['nme'];
$org = $_POST['org'];
$msg = $_POST['msg'];
$to = "biomedinfo@nirrh.res.in";

// subject
$subject = 'Feedback of Precocity:';


// message
$message = '
<html>
<head>
  <title>National Institute for Research in Reproductive Health, Jehangir Merwanji Street, Parel, Mumbai-400 012</title>
</head>
<body>
<h3>Feedback of PCOSKB</h3>
  <p>Name: '.$nme.'</p>
  <p>Organization:'.$org.'</p>
  <p>'.$msg.'</p>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: BIC NIRRH <biomedinfo@bicnirrh.res.in>' . "\r\n";
$headers .= 'From: '.$nme.'  <'.$from.'>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);

	unset($_SESSION['security_code']);
} else {
header( 'Location: feedback.php' ); 
}
?>

<table width="90%" border="0" cellspacing="0" cellpadding="6" bgcolor="#FFFFFF" align="center">
  <tr>
    <td>
    <form id="form1" name="form1" method="post" action="feedback_sub.php">
          
          <table width="80%" border="0" align="center" cellpadding="4" cellspacing="0">
            <tr>
              <td colspan="2" align="center"><h3>Feedback Form</h3></td>
              </tr>
            <tr>
              <td width="30%">Name</td>
              <td width="70%"><span id="sprytextfield2">
                <input type="text" name="nme" id="textfield" />
                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>
            <tr>
              <td>Email ID</td>
              <td><span id="sprytextfield1">
                <input type="text" name="email" id="textfield2" />
                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>
            <tr>
              <td>Organization</td>
              <td><input type="text" name="org" id="textfield3" /></td>
            </tr>
            <tr>
              <td>Feedback</td>
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
