<?php
session_start('admin');
$admin = $_SESSION['admin'];
if(!isset($admin)) 
	header('Location: ../../login.php'); 

include("../../header.inc.php");


$sql = mysql_query("select user_level from user where user_id='".$_SESSION['user']."'");
$obj1 = mysql_fetch_object($sql);
//$check = $obj1->user_level;
//if(!isset($admin) || $check=='0') 
	//echo "<meta http-equiv=\"Refresh\" content= \"0; URL=../../index.php\"//>";		
ini_set('error_reporting', E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$menu['User List'] = 'index.php';
$menu['Add User'] = 'add_att.php';

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
	$label = 'Edit';
	$hidden = '<input type="hidden" name="edit" value="'.$_GET['edit'].'">';	
	
}
else
{
	$label = 'Add';
	$hidden = '';
}

echo '<br /><div style="font-size: 18px; font-weight: bold; color: #cccccc">&nbsp;&nbsp;'.$label.' User Information</div>';
echo subNav($menu,$_GET['x']);

if($_POST) 
{
	if(isset($_POST['edit'])) 
	{
		$error="";	
		if(empty($user_name))
		  {
		       $error.="Fill User name Field.".'<br>';
		  }

		if(empty($u_id))
		  {
		       $error.="Fill User ID Field.".'<br>';
		  }
		if((empty($u_pass)) || (empty($u_c_pass)) || ($_POST['u_c_pass'] != $_POST['u_pass']))
		  {
		  		$error.="Error in Password.".'<br>';
		  }
		   
		if(strlen($error) > 0 ) 
		  { 		
			$etag=1;
		  }    
		else
			{
				$modify_date = date("d-m-Y");			
			  
				$updateProfile = mysql_query("update user set 				
												user.user_id='".$u_id."',
												user.user_name='".$user_name."',
												user.user_passwd='".$u_pass."',
												user.user_status='".$u_status."',
												user.user_level='".$user_level."',
												user.modify_date='".$modify_date."'								
				where id=".$_POST['edit']);
				
				if(!$updateProfile)
				{
					echo '<br><br>An Error Occured!!! Please try again. <a href="index.php">Click here to return</a>';
					include("../../footer.inc.php");
					exit;
				}
				
				else
				{
					 echo '<br><br>Update is successful!.<a href="index.php">Click here to return</a>';
					 include("../../footer.inc.php");
					 exit;
				}
			}	
	}
	else
	{
        $error="";	     

		if(empty($user_name))
		  {
		       $error.="Fill User name Field.".'<br>';
		  }

		if(empty($u_id))
		  {
		       $error.="Fill User ID Field ".'<br>';
		  }
		  
		if((empty($u_pass)) || (empty($u_c_pass)) || ($_POST['u_c_pass'] != $_POST['u_pass']))
		  {
		  		$error.="Error in Password.".'<br>';
		  }
		  if(strlen($error) > 0 ) 
		  { 		
			$etag=1;                      
		  }
		  else
		  {
		    $entry_date = date("d-m-Y");
			if(!empty($u_id))
			{
			$insertProfile = mysql_query("insert into user (
																user.user_id,
																user.user_name,
																user.user_passwd,
																user.user_status,
																user.user_level,
																user.entry_date
													) values (
																'".$u_id."',
																'".$user_name."',
																'".$u_pass."',
																'".$u_status."',
																'".$user_level."',
																'".$entry_date."'
																)");// or die("Going to be Destroy:".mysql_error());
			}
			
			if(!$insertProfile)
				{
				echo '<br><br>An Error Occured!!! Please try again. <a href="index.php">Click here to return</a>';
			    include("../../footer.inc.php");
			    exit;
				}
				
			else
			{
			 echo '<br><br>Insertion is successful! <a href="index.php">Click here to return</a>';
			 include("../../footer.inc.php");
			 exit;
			}											
																					
			}	
	}
}


?>

<script src="../../hint.js"></script>
<?php if($etag == 1 ) { ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td colspan="2"><font color="#FF0000"><?php echo $error; ?></font></td></tr>
		</table>
<form name="addAtt" method="post" action="" enctype="multipart/form-data">
	<?php echo $hidden; ?>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">	
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="46%" style="padding-left:20px;">User Name</td>
		  <td width="54%"><input type="text" name="user_name" value="<?php echo $user_name;?>" /></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="46%" style="padding-left:20px;">User ID</td>
		  <td width="54%"><input type="text" name="u_id" value="<?php echo $u_id;?>" /></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="46%" style="padding-left:20px;">Password</td>
		  <td><input type="password" name="u_pass" value="<?php echo $_POST['u_pass'];?>" /></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="46%" style="padding-left:20px;">Confirm Password</td>
		  <td><input type="password" name="u_c_pass" value="<?php echo $_POST['u_c_pass'];?>" /></td>
		</tr>		
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="46%" style="padding-left:20px;">Active
				<label><input type="radio" name="active" value="1" />Yes</label>
				<label><input type="radio" name="active" value="0" />No</label>
    	  </td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="46%" style="padding-left:20px;">Level
				<label><input type="radio" name="level" value="1" />Super Admin</label>
				<label><input type="radio" name="level" value="0" />Admin</label>
    	  </td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td align="right"><input type="image" name="imageField" src="../../images/submit1.gif" accesskey="<?php echo header(index.php); ?>" /></td>
	    </tr>
	</table>
</form>

<?php } else { 
$result = mysql_query("select * from user where id=".$_GET['edit']);
$return = mysql_fetch_object($result);
?>
<form name="addAtt" method="post" action="" enctype="multipart/form-data">
	<?php echo $hidden; ?>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="46%" style="padding-left:20px;">User Name</td>
		  <td width="54%"><input type="text" name="user_name" value="<?php echo $return->user_name;?>" /></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="46%" style="padding-left:20px;">User ID</td>
		  <td width="54%"><input type="text" name="u_id" value="<?php echo $return->user_id;?>" /></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="46%" style="padding-left:20px;">Password</td>
		  <td><input type="password" name="u_pass" value="<?php echo $return->user_passwd;?>" /></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="46%" style="padding-left:20px;">Confirm Password</td>
		  <td><input type="password" name="u_c_pass" value="" /></td>
		</tr>				
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="46%" style="padding-left:20px;">Active
				  <label><input type="radio" name="active" value="1"<?php if($return->user_status == 1) echo "checked";?>/>Yes</label>
				  <label><input type="radio" name="active" value="0"<?php if($return->user_status == 0) echo "checked";?>/>No</label>
		</td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td width="46%" style="padding-left:20px;">Level
				<label><input type="radio" name="level" value="1"<?php if($return->user_level == 1) echo "checked";?> />Super Admin</label>
				<label><input type="radio" name="level" value="0"<?php if($return->user_level == 0) echo "checked";?> />Admin</label>
    	  </td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	    </tr>
		<tr>
		  <td align="right"><input type="image" name="imageField" src="../../images/submit1.gif" accesskey="<?php echo header(index.php); ?>" /></td>
	  </tr>
	</table>
</form>
<?php } include("../../footer.inc.php"); ?>