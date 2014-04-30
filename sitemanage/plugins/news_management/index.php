<?php
session_start('admin');
$admin = $_SESSION['admin'];
if(!isset($admin)) 
	header('Location: ../../login.php'); 

include("../../header.inc.php");

ini_set('error_reporting', E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);


if(isset($_GET['delete'])) {
	$delete = mysql_query("delete from news where id=".$_GET['delete']) or die(mysql_error());
}


$menu['News List'] = 'index.php';
$menu['Add News'] = 'news_management.php';


?>


<br />
<div style="font-size: 18px; font-weight: bold; color: #cccccc">&nbsp;&nbsp;News Management</div>

<?php
echo subNav($menu,$_GET['x']);
?>

<!--
<div style="text-align: center;">[ <a href="news_management.php">Add News</a> ]</div>
-->
<br />

<table width="550" border="0" cellpadding="0" cellspacing="0" background="../../images/body_r6_c6.gif">
  <tr>
    <td width="19"><img src="../../images/body_r5_c5.gif" width="19" height="31" /></td>
    <td background="../../images/body_r5_c6.gif">

	<table width="513" border="0" cellpadding="0" cellspacing="0">
	 <tr>
	  <td width="23">&nbsp;</td>
	  <td width="28">&nbsp;</td>
	  <td><strong>&nbsp;Title</strong></td>
	  <!-- <td width="150" style="text-align: center; background-color: #ffDCAE;"><strong>Date</strong></td> -->
	  <td width="50" style="text-align: center;"><strong>Active</strong></td>
	 </tr>
	</table>

	</td>
    <td width="18"><img src="../../images/body_r5_c7.gif" width="18" height="31" /></td>
  </tr>
  <tr>
    <td background="../../images/body_r6_c5.gif">&nbsp;</td>
    <td>

	<table width="513" border="0" cellpadding="0" cellspacing="0">


	<?php

		$sql = mysql_query("select *, DATE_FORMAT(published_date, '%M %D, %Y') as pub_date from news order by published_date DESC") or die(mysql_error());
		$num = 0;

		while($news = mysql_fetch_object($sql)) {
			$num++;
			$tdbg = $tdbg == "ffffff" ? "f2f2f2" : "ffffff";

			$enabled = $news->active == "y" ? "Yes" : "<font color='red'><strong>No</strong></font>";

			echo '<tr onmouseover="style.backgroundColor=\'#ffffff\';" onmouseout="style.backgroundColor=\'\'" class="btnav">';
			echo '<td style="text-align: center; text-align: left; border-bottom: 1px dashed #999999;" width="23" background="../../images/body_r6_c6.gif"><a href="news_management.php?edit='.$news->id.'"><img src="../../images/edit_btn.gif" alt="Edit" border="0"></a></td>';
			echo '<td style="text-align: center; text-align: left; border-bottom: 1px dashed #999999;" width="28" background="../../images/body_r6_c6.gif"><a onclick="return confirmSubmit(\'Are you sure you want to delete this article?\')" href="index.php?delete='.$news->id.'"><img src="../../images/delete_btn.gif" alt="Delete" border="0"></a></td>';
			echo '<td style="text-align: left; border-bottom: 1px dashed #999999;" background="../../images/body_r6_c6.gif">'.stripslashes($news->title).'</td>';
			//echo '<td style="text-align: center; text-align: left; border-bottom: 1px dashed #999999;" width="150" background="../../images/body_r6_c6.gif"><div style="text-align: center;">'.$news->pub_date.'</div></td>';
			echo '<td style=" text-align: left; border-bottom: 1px dashed #999999;" width="50" background="../../images/body_r6_c6.gif"><div style="text-align: center;">'.$enabled.'</div></td>';
			echo '</tr>';
		}

		if(mysql_num_rows($sql)<1) {
			echo '<tr><td style="text-align: center; background-color: #fff;" colspan="5" background="../../images/body_r6_c6.gif">No news items found.</td></tr>';
		}

	?>

	</table>

	</td>
    <td background="../../images/body_r6_c7.gif">&nbsp;</td>
  </tr>
  <tr>
    <td><img src="../../images/body_r7_c5.gif" width="19" height="19" /></td>
    <td background="../../images/body_r7_c6.gif"></td>
    <td><img src="../../images/body_r7_c7.gif" width="18" height="19" /></td>
  </tr>
</table>

<?php

echo "<p>&nbsp;</p>";
echo "<p>&nbsp;</p>";
echo "<p>&nbsp;</p>";
echo "<p>&nbsp;</p>";

include("../../footer.inc.php");
?>
