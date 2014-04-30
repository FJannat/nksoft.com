<?php
session_start('admin');
$admin = $_SESSION['admin'];
if(!isset($admin)) 
	header('Location: ../../login.php'); 

include("../../header.inc.php");

ini_set('error_reporting', E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);


if($_POST) {

	if(strlen($_POST['title'])<3) 
		$error[] = "You must have a title for the article.";
			
	$title				= mysql_real_escape_string($_POST['title']);
	$body				= mysql_real_escape_string($_POST['body']);
	$enable				= mysql_real_escape_string($_POST['enable']);
	//$overseas_news		= mysql_real_escape_string(addslashes($_POST['overseas_news']));
	//$project		    = mysql_real_escape_string(addslashes($_POST['project']));	
	$pubDate 			= $_POST['published_date'];
	
	if(empty($error)) {
		
		if(strlen($_POST['published_date']) > 0) {
			$pubDate = $_POST['published_date'];
		}else{
			$pubDate = date('Y-m-d');
		}

		if(isset($_POST['edit'])) {
			$update = mysql_query("update news set title='".$title."', body='".$body."', active='".$enable."', published_date='".$pubDate."' where id=".$_POST['edit']) or die(mysql_error());
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


		}else{
			$insert = mysql_query("insert into news (title, body, published_date, active) values ('".$title."','".$body."','".$pubDate."','".$enable."')") or die(mysql_error());
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

		//header("location: index.php");

	}else{
		foreach($error as $e) {
			$show_error .= "<div style='text-align: center; font-weight: bold; color: #FF0000'>".$e."</div>";
		}
	}
}

$proj_id_edit = 0;
require_once("../../fckeditor/fckeditor.php");

if(isset($_GET['edit'])) {
	$sql = mysql_query("select *,DATE_FORMAT(published_date, '%Y-%m-%d') as pubDate from news where id=".$_GET['edit']) or die(mysql_error());
	$n = mysql_fetch_object($sql);

	$title		= stripslashes($n->title);
	$body		= stripslashes($n->body);
	$enable		= $n->active;
	$pubDate  = $n->pubDate;
	//$overseas_news = $n->overseas_news;
	//$project = $n->proj_id;

	$addHidden = "<input type='hidden' name='edit' value='".$_GET['edit']."'>\n";
}

//require_once("proj_list.php"); 
//$proj_list = $proj_list_norm;


$menu['News List'] = 'index.php';
$menu['Add News'] = 'news_management.php';


?>

<br />
<div style="font-size: 18px; font-weight: bold; color: #cccccc">&nbsp;&nbsp;News Management</div>

<?php
echo subNav($menu,$_GET['x']);
?>

<!--
<div style="text-align: center;">[ <a href="index.php">News List</a> ]</div>
-->
<br />

<?= $show_error; ?>
<script language="JavaScript" src="CalendarPopup.js"></script>
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>

<form name="frmNewsManagment" method="post" action="" onsubmit="return  doFormSubmit();">
<?= $addHidden; ?>
<table width="80%" border="0" cellpadding="0" cellspacing="0" align="center">
 <tr>
  <td style="background-color: #fff;" class="input">Published Date:<br/> 
  	<input type="text" name="published_date" size="12" value="<?php echo $pubDate; ?>" class="input" maxlength="12">
  	<A HREF="#" onClick="cal.select(document.frmNewsManagment.published_date,'anchor1x','yyyy-MM-dd'); return false;" TITLE="cal.select(document.frmNewsManagment.published_date,'anchor1x','yyyy-MM-dd'); return false;" NAME="anchor1x" ID="anchor1x"><img src="../../images/cal.png" border="0"></A>
  	
			<SCRIPT LANGUAGE="JavaScript" ID="jscal">
				var cal = new CalendarPopup("calendarDiv");
				cal.showNavigationDropdowns();
				cal.setYearSelectStartOffset(1);
			</SCRIPT>

	</td>
 </tr>
 <tr>
 	<td style="background-color: #fff" class="input">Show this Article?<br/>
		<select name="enable" class="input" style="font-size: 10px;">
			<option value="y" <? if($enable == "y") echo "selected"; ?>>Yes</option>
			<option value="n" <? if($enable == "n") echo "selected"; ?>>No</option>
		</select>

  </td>
 </tr>
 <tr>
  <td style="background-color: #fff;" class="input">Title:<br/> 
  		<input type="text" name="title" size="60" value="<?php echo $title; ?>" class="input" maxlength="255">
  </td>
 </tr>
 <tr>
  <td style="background-color: #fff;" class="input">Details:<br/>
  
  <?php 
  	
	//$sw = new SPAW_Wysiwyg('body',stripslashes($body));
	//$sw->show();
	
	$oFCKeditor = new FCKeditor('body');
	$oFCKeditor->BasePath = '../../fckeditor/';
	$oFCKeditor->Value = stripslashes($body);
	$oFCKeditor->Width  = '100%' ;
	$oFCKeditor->Height = '450' ;
	$fck_about = $oFCKeditor->CreateHtml();
	
    echo $fck_about;
	?>
	
	</td>
 </tr>
<tr>
  <td style="background-color: #fff;">&nbsp;</td>
 </tr>
 <tr>
  <td style="background-color: #fff;" align="center"><input type="image" name="imageField" src="../../images/submit1.gif" /></td>
 </tr>
</table>
</form>


<div id="calendarDiv" style="position: absolute; visibility: hidden; background-color: #fff; layer-background-color: #fff;"></div>

<?php

echo "<p>&nbsp;</p>";
echo "<p>&nbsp;</p>";
echo "<p>&nbsp;</p>";
echo "<p>&nbsp;</p>";

include("../../footer.inc.php");
?>
<script language="javascript">
function doFormSubmit()
{
	frm = document.frmNewsManagment;
	with(frm)
	{
		if(title.value == "")
		{
			alert("Please Enter Title.");
			return false;
		}
		if(overseas_news[0].checked == false && overseas_news[1].checked == false && overseas_news[2].checked == false)
		{
			alert("You must choose a news activation.");
			return false;
		}
		if(overseas_news[2].checked == true && project.value == "")
		{
			alert("Please select at least one project.");
			return false;
		}
		
		
	}
	//alert("hmm i am here");
	return true;
}
</script>
