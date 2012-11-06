<?php
	//Idea Box PHP Widget by Johnathan Sanders
	///internalfusion@gmail.com
	//This script is free for personal use
	//Copyright 2009, Johnathan Sanders
	//johnathansanders.com
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>My Idea Box</title>
	<style>
	<!--
		.bold_18 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 18px;
	color: #000000;
		}
		.extrasmall {
			font-size: x-small;
			font-family: Verdana, Arial, Helvetica, sans-serif;
		}
		.text_verdana {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: small;
}
		
		.headertext {			
			font-size: 14pt;
			font-family: Verdana, Arial, Helvetica, sans-serif;
		}
		.smallbold {
	font-size: small;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
		}
		.bigtext{
	font-size:	14pt;
	color:	#0099CC;
		}
.invisible {color: #FFFFFF}
.smallred {color: #FF0000}
.optionsbutton {
	font-size: 10pt;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
	-->
	</style>
</head>
<body>
<div align="center">
	<?php
	$ibcatdir = explode("/", $_SERVER['SCRIPT_FILENAME']);
	for ($i=0;$i<(count($ibcatdir)-1);++$i) {
		$ibcatdir2 .= $ibcatdir[$i].'/';
	}
	$ibcatdir = $ibcatdir2;
	$ibcat = $ibcatdir . "ib_cat.dat";
	$mscat = $ibcatdir . "ib_ms.dat";
	
	// DETERMINE IF CATEGORY FILE EXISTS
	if (file_exists($ibcat)) {
		// CATEGORY FILE EXISTS
		if ($_POST['scat'] && $_POST['entry']) {
			// IDEA TO BE POSTED
			$message = wordwrap($_POST['entry'], 70);
			$user = $_POST['uid'] . "+" . $_POST['scat'] . "@gmail.com";
			if (file_exists($mscat)) {
				$handle = fopen($mscat, "rb");
				$contents = '';
				while (!feof($handle)) {
		  			$contents .= fread($handle, 8192);
				}
				fclose($handle);
				$pieces = explode(",", $contents);
				$mailserver = $pieces[0];
				$mailuser = $pieces[1];
				ini_set("SMTP", $mailserver);
				ini_set("sendmail_from", $mailuser);
			}
			mail($user, "Another idea for your Cookie Jar!", $message) or die("Could not send email, check your configuration!");
	?>
        <table width="70%" border="0" align="center" cellpadding="1" cellspacing="0">
          <tr>
            <td bgcolor="#000000"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
                  <tr>
                    <td bgcolor="#E8E8E8"><p align="left"><span class="smallred"><span class="bold_18">Ideas</span><br />
                    </span><span class="extrasmall">My Idea Cookie Jar</span></p></td>
                    <td bgcolor="#E8E8E8">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2"><p align="left" class="smallbold"><br />
                      Idea submitted to the Cookie Jar.</p>
                      <p align="left"><span class="smallbold"><a href="<?php echo $_SERVER["PHP_SELF"]; ?>">Click here</a> to continue.</span><br />
                        <br />
                        <br />
                      </p></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table>

  <?php
	} elseif ($_POST["gooptions"]) {
		// we need to give the user some options to work with...change settings and update their categories
		if ($_POST["u"]) {
			// The user has updated their information....so lets modify our files...
			
		} else {
			$handle = fopen($ibcat, "rb");
			$contents = '';
			while (!feof($handle)) {
			  $contents .= fread($handle, 8192);
			}
			fclose($handle);
			$pieces = explode(",", $contents);
			$user = $pieces[0];
			$cat_count = (count($pieces) - 1);
			echo $cat_count;
			$cats = $pieces[1];
			if (file_exists($mscat)) {
				$handle = fopen($mscat, "rb");
				$contents = '';
				while (!feof($handle)) {
		  			$contents .= fread($handle, 8192);
				}
				fclose($handle);
				$pieces = explode(",", $contents);
				$mailserver = $pieces[0];
				$mailuser = $pieces[1];
			}
		}
	?>
        <table width="70%" border="0" align="center" cellpadding="1" cellspacing="0">
      <tr>
        <td bgcolor="#000000"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
              <tr>
                <td bgcolor="#E8E8E8"><p align="left"><span class="smallred"><span class="bold_18">Ideas</span><br />
                </span><span class="extrasmall">My Idea Cookie Jar</span></p></td>
              </tr>
              <tr>
                <td><p align="left" class="smallbold"><br />
                Options<br />
                  <br />
                </p>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="45%"><div align="right"><span class="headertext">Your Gmail Username:&nbsp;</span></div></td>
                      <td width="55%"><div align="left">
                        <input name="uid" type="text" class="bigtext" size="30" maxlength="256" value="<?php echo $user; ?>"/>
                      </div></td>
                    </tr>
                    <tr>
                      <td colspan="2" class="invisible">.</td>
                    </tr>
                    <tr>
                      <td valign="top"><div align="right"><span class="headertext">Categories:&nbsp;                  </span></div></td>
                      <td valign="top"><div align="left">
                        <input type="text" class="bigtext" name="cats" size="30" maxlength="256" />
                        <br />
                        <span class="extrasmall">(Separate these with a comma, and please don't use any special characters you wouldn't use in front of your mother. Those include slashes, asterisks, percent signs and dollar signs)</span></div></td>
                    </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td valign="top" class="extrasmall"><div align="right"><span class="headertext">Mail Server:&nbsp;</span></div></td>
                      <td valign="top" class="extrasmall"><div align="left">
                        <input name="mailserver" type="text" class="bigtext" size="30" maxlength="256" id="mailserver" />
                        <br />
                        (Leave this blank unless you need to change the SMTP server, so if you don't know what that means, leave it blank.)</div></td>
                    </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td valign="top" class="headertext"><div align="right">Mail Server Username:&nbsp;</div></td>
                      <td valign="top"><div align="left">
                        <input name="mailuser" type="text" class="bigtext" size="30" maxlength="256" id="mailuser" /> 
                        <span class="extrasmall"><br />
                          (Format of: you@company.com and required ONLY IF you entered a Mail Server above.)</span></div></td>
                    </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2"><div align="center"><input name="gooptions" type="hidden" value="true" /><input name="u" type="hidden" value="1" />
                        <input type="submit" name="submit" class="headertext" value="  Update  " />
                      </div></td>
                    </tr>
                  </table>
                  <br />
                  </form>
                  </td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>
	<?php 
        }else {
		// Our category file exists, so we run as normal
		$handle = fopen($ibcat, "rb");
		$contents = '';
		while (!feof($handle)) {
		  $contents .= fread($handle, 8192);
		}
		fclose($handle);
		$pieces = explode(",", $contents);
	?>
        <table width="70%" border="0" align="center" cellpadding="1" cellspacing="0">
          <tr>
            <td bgcolor="#000000"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
                  <tr>
                    <td width="80%" valign="top" bgcolor="#E8E8E8"><p align="left"><span class="invisible"><span class="bold_18">Ideas</span><br />
                    </span><span class="extrasmall">My Idea Cookie Jar</span></p></td>
                    <td width="20%" valign="top" bgcolor="#E8E8E8"><form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                      <label></label>
                                            
                              <div align="right" class="optionsbutton">
                                <input name="gooptions" type="hidden" value="true" />
                                <input type="submit" name="options" class="headertext" value="  Options  " id="options" />
                                </div>
                    </form>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><br />
                      <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                         <div align="center"><span class="style2"><br />
                         </span>
                           <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
                             <tr>
                               <td><div align="left"><span class="text_verdana">Ideas to: <?php echo $pieces[0]; ?> at gmail dot com</span></div></td>
                             </tr>
                             <tr>
                               <td><div align="center">
                                 <textarea rows="15" cols="90" name="entry"></textarea>
                               </div></td>
                             </tr>
                             <tr>
                               <td><span class="invisible">.</span></td>
                             </tr>
                             <tr>
                               <td><div align="center"><span class="text_verdana">Select your category (+name):</span>
                                 <select class="headertext" name="scat">
                                   <?php
                            for ($i=1;$i<(count($pieces));++$i) {
                                echo "<option value='$pieces[$i]'>$pieces[$i]</option>";
                            }
                        ?>
                                 </select>
                               </div></td>
                             </tr>
                             <tr>
                               <td class="invisible">.</td>
                             </tr>
                             <tr>
                               <td><div align="center">
                                 <input type="hidden" name="uid2" value="<?php echo $pieces[0]; ?>" />
                                 <input type="submit" name="submit2" class="headertext" value="Put this idea in my cookie jar" />
                               </div></td>
                             </tr>
                           </table>
                           <br />
                         <br />
                         <br />
                         <br />
                         </div>
                      </form>            </td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table>
	<?php
		}
	} elseif ($_POST["uid"] && $_POST["cats"]) {
		// CREATE CATEGORY FILE
		// we are in the middle stage, stuff has been sent and we need to create our cat file...
		$handle = fopen($ibcat, "w");
		$cats = $_POST["cats"];
		$cats = str_replace(" ", "", $cats);
		$ibout = $_POST["uid"] . "," . $cats;
		if (@fwrite($handle, $ibout)===FALSE) echo "Write error to " . $ibcat;
		fclose($handle);
		$mailserver = $_POST["mailserver"];
		$mailuser = $_POST["mailuser"];
		if (strlen($mailserver) > 0) {
			$handle = fopen($mscat, "w");
			$msout = $mailserver . "," . $mailuser;
			if (@fwrite($handle,$msout)===FALSE) echo "Write error to " . $mscat;
			fclose($handle);
		}
?>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="0">
  <tr>
    <td bgcolor="#000000"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
          <tr>
            <td bgcolor="#E8E8E8"><p align="left"><span class="smallred"><span class="bold_18">Ideas</span><br />
            </span><span class="extrasmall">My Idea Cookie Jar</span></p></td>
          </tr>
          <tr>
            <td><p align="left" class="smallbold"><br />
              OK, We're all ready to go!</p>
              <p align="left"><span class="smallbold"><a href="<?php echo $_SERVER["PHP_SELF"]; ?>">Click here</a> to continue.</span><br />
                <br />
                <br />
              </p></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
    

<?php
	}else {
		// Our category file doesn't exist, so we know setup hasnt been run
?>

<table width="70%" border="0" align="center" cellpadding="1" cellspacing="0">
  <tr>
    <td bgcolor="#000000"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
          <tr>
            <td bgcolor="#E8E8E8"><p align="left"><span class="smallred"><span class="bold_18">Ideas</span><br />
            </span><span class="extrasmall">My Idea Cookie Jar</span></p></td>
          </tr>
          <tr>
            <td><p align="left" class="smallbold"><br />
              It appears this is the first time you've used this Idea Box. So, we're going to need a little bit of information from you (Don't worry, it won't take long).<br />
              <br />
            </p>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="45%"><div align="right"><span class="headertext">Your Gmail Username:&nbsp;</span></div></td>
                  <td width="55%"><div align="left">
                    <input name="uid" type="text" class="bigtext" size="30" maxlength="256" />
                  </div></td>
                </tr>
                <tr>
                  <td colspan="2" class="invisible">.</td>
                </tr>
                <tr>
                  <td valign="top"><div align="right"><span class="headertext">Categories:&nbsp;                  </span></div></td>
                  <td valign="top"><div align="left">
                    <input type="text" class="bigtext" name="cats" size="30" maxlength="256" />
                    <br />
                    <span class="extrasmall">(Separate these with a comma, and please don't use any special characters you wouldn't use in front of your mother. Those include slashes, asterisks, percent signs and dollar signs)</span></div></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" class="extrasmall"><div align="right"><span class="headertext">Mail Server:&nbsp;</span></div></td>
                  <td valign="top" class="extrasmall"><div align="left">
                    <input name="mailserver" type="text" class="bigtext" size="30" maxlength="256" id="mailserver" />
                    <br />
                    (Leave this blank unless you need to change the SMTP server, so if you don't know what that means, leave it blank.)</div></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" class="headertext"><div align="right">Mail Server Username:&nbsp;</div></td>
                  <td valign="top"><div align="left">
                    <input name="mailuser" type="text" class="bigtext" size="30" maxlength="256" id="mailuser" /> 
                    <span class="extrasmall"><br />
                      (Format of: you@company.com and required ONLY IF you entered a Mail Server above.)</span></div></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><div align="center">
                    <input type="submit" name="submit" class="headertext" value="Begin" />
                  </div></td>
                </tr>
              </table>
              <br />
              </form>
              </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

<?php
	}

?>
</div>
</body>
</html>