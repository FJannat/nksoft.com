<?php
session_start('admin');
$admin = $_SESSION['admin'];
if(!isset($admin)) 
	header('Location: ../../login.php'); 

include("../../header.inc.php");

if($_POST) {

	if(strlen($_POST['title'])<3) 
		$error[] = "Too Short Title.";
		
	if(empty($error)) {
		$title		= mysql_real_escape_string($_POST['title']);
		$body		= mysql_real_escape_string($_POST['body']);
		//$enable		= mysql_real_escape_string(addslashes($_POST['enable']));

	//debug($_POST);
		
		if(isset($_POST['edit']))
		 {
			$update = mysql_query("UPDATE page_authoring SET title='" . $title . "', body='".$body."' WHERE id=".$_POST['edit']) or die(mysql_error());
			if(!$update)
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
		else
		{
			$insert = mysql_query("INSERT INTO page_authoring (title,body) values ('".$title."', '".$body."')") or die(mysql_error());
			if(!$insert)
				{
					echo '<br><br>An Error Occured!!! Please try again. <a href="index.php">Click here to return</a>';
					include("../../footer.inc.php");
					exit;
				}
				
				else
				{
					 echo '<br><br>Insertion is successful!.<a href="index.php">Click here to return</a>';
					 include("../../footer.inc.php");
					 exit;
				}

		}
	}else{
		foreach($error as $e) {
			$show_error .= "<div style='text-align: center; font-weight: bold; color: #FF0000'>".$e."</div>";
		}
	}
}

include("../../fckeditor/fckeditor.php") ;

if(isset($_GET['edit'])) {
	$sql = mysql_query("SELECT * FROM page_authoring WHERE id=".$_GET['edit']) or die(mysql_error());
	$n = mysql_fetch_object($sql);
	$title		= stripslashes($n->title);
	$body		= stripslashes($n->body);

	$addHidden = "<input type='hidden' name='edit' value='".$_GET['edit']."'>\n";
}


$menu['List'] = 'index.php';
$menu['Add'] = 'page_managment.php';


?>

<br />
<div style="font-size: 18px; font-weight: bold; color: #cccccc">&nbsp;&nbsp;Page Authoring Management</div>

<?php
echo subNav($menu,$_GET['x']);
?>

<!--
<div style="text-align: center;">[ <a href="index.php">News List</a> ]</div>
-->
<br />
<?= $show_error; ?>
<form name="page_authoringManagment" method="post" action="">
<input type="hidden" name="user" value="<?= $_SESSION['user_id']; ?>">
<?= $addHidden; ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
 <tr>
  <td style="background-color: #fff;">Title: <input type="text" name="title" size="100" value="<?= $title; ?>" class="input" maxlength="255"></td>
 </tr> 
 <tr>
  <td style="background-color: #fff;">Description: 
  
  <?php 

/*$oFCKeditor = new FCKeditor('body');
$oFCKeditor->BasePath = '../../fckeditor/';
$oFCKeditor->Value = stripslashes($n->body);
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '750' ;
$oFCKeditor->Create();*/


$oFCKeditor = new FCKeditor('body');
$oFCKeditor->BasePath = '../../fckeditor/';
$oFCKeditor->Value = stripslashes($n->body);
$oFCKeditor->Width  = '94%' ;
$oFCKeditor->Height = '750' ;
$fck_about = $oFCKeditor->CreateHtml();
  	
	//$sw = new SPAW_Wysiwyg('body',stripslashes($text));
	//$sw->show();
   echo $fck_about;
	?>

	</td>
 </tr>
 <tr>
  <td style="background-color: #fff;">&nbsp;</td>
 </tr>
 <tr>
  <td style="text-align: center; background-color: #fff;"><input type="image" name="imageField" src="../../images/submit1.gif" /></td>
 </tr>
</table>
</form>



<?php

echo "<p>&nbsp;</p>";
echo "<p>&nbsp;</p>";
echo "<p>&nbsp;</p>";
echo "<p>&nbsp;</p>";

include("../../footer.inc.php");
?>