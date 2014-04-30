<?php
session_start('admin');
$admin = $_SESSION['admin'];
if(!isset($admin)) 
	header('Location: ../../login.php'); 

include("../../header.inc.php");

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//                         The Copy Right of the Fucntion Goes To                                       //
//                         Manish,                                                                      //
//                         Software Engineer,                                                           //
//                         Green Land Informatio Technology,                                            //
//                         Dhaka-Bangladesh.                                                            //
//																										//	
//                         If any body wishes to use this function permission is required.              //
//////////////////////////////////////////////////////////////////////////////////////////////////////////

function stateName($state)
{
	$temp_state = file('state.txt');
	for($i = 0 ; $i < count($temp_state) ; $i++)
	{
		//echo $temp_state[$i].'<br>';
		
		if(substr($temp_state[$i],0,2) == $state)
		$finalState = substr($temp_state[$i],3);
		//$finalState = 'Albama'; 	
	}
	return $finalState; 
}
/*------------------------------------------------------------------------------------------------------------*/




$sql = mysql_query("select user_level from user where user_id='".$_SESSION['user']."'");
$obj1 = mysql_fetch_object($sql);
//$check = $obj1->user_level;
//if(!isset($admin) || $check=='0') 
	//echo "<meta http-equiv=\"Refresh\" content= \"0; URL=../../index.php\"//>";		
ini_set('error_reporting', E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$menu['Request List'] = 'index.php';
//$menu['Add User'] = 'add_att.php';

$user_name		= $_POST['user_name'];
$u_pass			= $_POST['u_pass'];
$u_c_pass		= $_POST['u_c_pass'];
$u_id 			= $_POST['u_id'];
$u_status 		= $_POST['active'];
$user_level		= $_POST['level'];

if(isset($_GET['edit'])) 
{
	$sqlAtt = mysql_query("select * from user where id=".$_GET['edit']) or die(mysql_error());
	$obj = mysql_fetch_object($sqlAtt);
	$label = 'Reply';
	$hidden = '<input type="hidden" name="edit" value="'.$_GET['edit'].'">';	
	
}
else
{
	$label = 'Add';
	$hidden = '';
}

echo '<br /><div style="font-size: 18px; font-weight: bold; color: #cccccc">&nbsp;&nbsp;'.$label.' Against Request</div>';
echo subNav($menu,$_GET['x']);

if($_POST)
{
	$headers = 'From: john@nksoft.com' . "\r\n" .
	'Content-type: text/html; charset=iso-8859-1'.
	'Reply-To: john@nksoft.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$mail_body = str_replace(chr(13).chr(10), "<br>" ,$_POST['reply']);
	
	$send_mail = mail($email,$subject, $mail_body, $headers);
	$send_mail1 = mail('updatedmanish@yahoo.com',$subject, $mail_body, $headers);
}
?>

<script src="../../hint.js"></script>
<?php
$result = mysql_query("select * from white_page where id=".$_GET['edit']);
$return = mysql_fetch_object($result);
?>
<form name="addAtt" method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="email" value="<?php echo $return->email;?>" />
	<?php echo $hidden; ?>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="20%" style="padding-left:20px;">First Name</td>
		  <td width="80%"><?php echo $return->first_name;?></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="20%" style="padding-left:20px;">Last Name</td>
		  <td width="80%"><?php echo $return->last_name;?></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="20%" style="padding-left:20px;">E-mail</td>
		  <td><?php echo $return->email;?></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="20%" style="padding-left:20px;">Phone</td>
		  <td><?php echo $return->phone; ?></td>
		</tr>				
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="20%" style="padding-left:20px;">Company</td>
		  <td><?php echo $return->company; ?></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>

		<tr>
		  <td width="20%" style="padding-left:20px;">City</td>
		  <td><?php echo $return->city; ?></td>
		</tr>				

		<tr>
		  <td>&nbsp;</td>
	    </tr>

		<tr>
		  <td width="20%" style="padding-left:20px;">State</td>
		  <td><?php echo stateName($return->state); ?></td>
		</tr>				

		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="20%" style="padding-left:20px;">Country</td>
		  <td><?php echo $return->country; ?></td>
		</tr>				

		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="20%" style="padding-left:20px;">Employee</td>
		  <td><?php echo $return->employees; ?></td>
		</tr>				

		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="20%" style="padding-left:20px;">Timings</td>
		  <td><?php echo $return->timing; ?></td>
		</tr>				

		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="20%" style="padding-left:20px;">Date</td>
		  <td><?php echo $return->date_input; ?></td>
		</tr>				
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td bgcolor="#E8E9C0" colspan="2"><h2>Reply To the User</h2></td>
	    </tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="20%" style="padding-left:20px;">Subject :</td>
		  <td><input type="text" name="subject" size="72" /></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="20%" style="padding-left:20px;" valign="top">Reply : </td>
		  <td><textarea rows="10" cols="55" name="reply"></textarea></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
			<td>&nbsp;</td>
		  <td align="left"><input type="image" name="imageField" src="../../images/submit1.gif" accesskey="<?php echo header(index.php); ?>" /></td>
	  </tr>
	</table>
</form>
<?php  include("../../footer.inc.php"); ?>