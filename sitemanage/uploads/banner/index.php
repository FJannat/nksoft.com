<?php
/*
 *		Sales Associate Profiles
 */

include("../../header.inc.php");

if(isset($_GET['delete'])) {
	$delete = mysql_query("delete from banner where res_id=".$_GET['delete']) or die(mysql_error());
}

$menu['Banner Lists'] = 'index.php';
$menu['Add Banner'] = 'add_att.php';


?>


<br />
<div style="font-size: 18px; font-weight: bold; color: #cccccc">&nbsp;&nbsp;Banner Lists</div>

<?php
echo subNav($menu,$_GET['x']);
?>

<br />
<table width="550" border="0" cellpadding="0" cellspacing="0" background="../../images/body_r6_c6.gif">
  <tr>
    <td width="19"><img src="../../images/body_r5_c5.gif" width="19" height="31" /></td>
    <td background="../../images/body_r5_c6.gif">

	<table width="513" border="0" cellpadding="0" cellspacing="0">
	 <tr>
	  <td width="23" style="background-color: #ffDCAE;">&nbsp;</td>
	  <td width="28" style="background-color: #ffDCAE;">&nbsp;</td>
	  <td style="background-color: #ffDCAE;"><strong>&nbsp;Banner Name</strong></td>
	  <td width="50" style="text-align: center; background-color: #ffDCAE;"><strong>Active</strong></td>
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
		$sqlAttorney = mysql_query("select * from banner") or die(mysql_error());

	if(mysql_num_rows($sqlAttorney) > 0) {
		
		while($attorney = mysql_fetch_object($sqlAttorney)) {
			$showAttorney = ($attorney->active == 'y') ? 'Yes' : 'No';
			
			echo '<tr class="btnav">';
			echo '<td style="text-align: center; text-align: left; border-bottom: 1px dashed #999999;" width="23" background="../../images/body_r6_c6.gif"><a href="add_att.php?edit='.$attorney->ban_id.'"><img src="../../images/edit_btn.gif" alt="Edit" border="0"></a></td>';
			echo '<td style="text-align: center; text-align: left; border-bottom: 1px dashed #999999;" width="28" background="../../images/body_r6_c6.gif"><a onclick="return confirmSubmit(\'Are you sure you want to delete this profile?\')" href="index.php?delete='.$attorney->ban_id.'"><img src="../../images/delete_btn.gif" alt="Delete" border="0"></a></td>';			
			echo '<td style="background-color: #f1f1f1; border-bottom: 1px dashed #999999;">'.stripslashes($attorney->ban_name).'</td>';
			echo '<td width="50" style="text-align: center; background-color: #f1f1f1; border-bottom: 1px dashed #999999;">'.$ban_name.'</td>';
			echo '</tr>';
		}
	
	}else{
		echo '<tr><td style="text-align: center; background-color: #f1f1f1;">No Restaurants found.</td></tr>';
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
