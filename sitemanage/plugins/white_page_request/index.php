<?php
session_start('admin');
$admin = $_SESSION['admin'];
if(!isset($admin)) 
	header('Location: ../../login.php'); 

include("../../header.inc.php");


$sql = mysql_query("select user_level from user where user_id='".$_SESSION['user']."'");
$obj1 = mysql_fetch_object($sql);
//$check = $obj1->user_level;
//if(!isset($admin) || $check==0) 
	//echo "<meta http-equiv=\"Refresh\" content= \"0; URL=../../index.php\"//>";		

if(isset($_GET['delete'])) {
	$delete = mysql_query("delete from white_page where id=".$_GET['delete']) or die(mysql_error());
}

$menu['Request List'] = 'index.php';
//$menu['Add User'] = 'add_att.php';



?>


<br />
<div style="font-size: 18px; font-weight: bold; color: #cccccc">&nbsp;&nbsp;Request List</div>

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
	  <td width="23" >&nbsp;</td>
	  <td ><strong>User</strong></td>

	   <td width="23" >&nbsp;</td>
	    <td width="23" >&nbsp;</td>
		 <td width="23" >&nbsp;</td>
		  <td width="23" >&nbsp;</td>
		   <td width="23" >&nbsp;</td>
		   

	    <td width="5" >&nbsp;</td>
	   
	 <!-- <td width="50" style="text-align: center; background-color: #ffDCAE;"><strong>Active</strong></td>-->
	 </tr>
	</table>	</td>
    <td width="18"><img src="../../images/body_r5_c7.gif" width="18" height="31" /></td>
  </tr>
  <tr>
    <td background="../../images/body_r6_c5.gif">&nbsp;</td>
    <td>

	<table width="513" border="0" cellpadding="0" cellspacing="0">

	<?php
 	$db = new buildNav;
   	$db->offset = 'offset';
   	$db->number_type = 'number';
   	$db->limit = 10;
	$db->execute("select * from white_page");
	$info = $db->show_info();
	echo "<div align=right>";
   	print $info;
   	echo "</div>";
   	//$serial = $offset+1;
	echo "<tr><td colspan=2 height=25>&nbsp;</td>";
	echo "<td valign=top align=left><b>User ID</b></td>";
	echo "<td valign=top align=right><b>User Type</b></td>";
	echo "</tr>";
////	if(mysql_num_rows($sqlAttorney) > 0) {
	if(mysql_num_rows($db->sql_result) > 0) {
		
////		while($attorney = mysql_fetch_object($sqlAttorney)) {
		while($attorney = mysql_fetch_object($db->sql_result)) {
			//$showAttorney = ($attorney->active == 'y') ? 'Yes' : 'No';
			
			echo '<tr class="btnav">';
			echo '<td style="text-align: center; text-align: left; border-bottom: 1px dashed #999999;" width="23" background="../../images/body_r6_c6.gif"><a href="add_att.php?edit='.$attorney->id.'"><img src="../../images/edit_btn.gif" alt="Edit" border="0"></a></td>';
			echo '<td style="text-align: center; text-align: left; border-bottom: 1px dashed #999999;" width="28" background="../../images/body_r6_c6.gif"><a onclick="return confirmSubmit(\'Are you sure you want to delete this profile?\')" href="index.php?delete='.$attorney->id.'"><img src="../../images/delete_btn.gif" alt="Delete" border="0"></a></td>';			
			echo '<td style="text-align: left; background-color: #f1f1f1; border-bottom: 1px dashed #999999;">'.stripslashes($attorney->first_name).'</td>';
			echo '<td style="text-align: right; background-color: #f1f1f1; border-bottom: 1px dashed #999999;">'.stripslashes($attorney->email).'</td>';
	
			echo '</tr>';
		}
			echo '<tr class="btnav">';	
			echo '<td colspan="34" align=center>';				
    // -------------------------------
   	// CREATE A VAR WITH THE NAV LINKS
   	// -------------------------------
   	$pages = $db->show_num_pages('&laquo;','previous','&raquo;','next','|','class=moi');   // show pages
   	// OUTPUT THE NAV

 	echo "<div align=center>";
   	print "<font color=\"#38385E\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><br><strong>$pages</strong></font>";
	echo "</div>";
			echo '</td>';					
			echo '</tr>';			
		
	}else{
		echo '<tr><td style="text-align: center; background-color: #f1f1f1;">No User found.</td></tr>';
	}
	
	?>
	</table>	</td>
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

<?php
class buildNav // [Class : Controls all Functions for Prev/Next Nav Generation]
    {
        var $limit, $execute, $query;
        function execute($query) // [Function : mySQL Query Execution]
        {
            !isset($_GET[$this->offset]) ? $GLOBALS[$this->offset] = 0 : $GLOBALS[$this->offset] = $_GET[$this->offset];
            $this->sql_result = mysql_query($query);
            $this->total_result = mysql_num_rows($this->sql_result);
            if(isset($this->limit))
            {
                $query .= " LIMIT " . $GLOBALS[$this->offset] . ", $this->limit";
                $this->sql_result = mysql_query($query);
                $this->num_pages = ceil($this->total_result/$this->limit);
            }
        }

        function show_num_pages($frew = '', $rew = '', $ffwd = '', $fwd = '', $separator = '|', $objClass = '') // [Function : Generates Prev/Next Links]
        {
            $current_pg = $GLOBALS[$this->offset]/$this->limit+1;
            if ($current_pg > 5)
            {
                $fgp = $current_pg - 5 > 0 ? $current_pg - 5 : 1;
                $egp = $current_pg+4;
                if ($egp > $this->num_pages)
                {
                    $egp = $this->num_pages;
                    $fgp = $this->num_pages - 9 > 0 ? $this->num_pages  - 9 : 1;
                }
            }
            else {
                $fgp = 1;
                $egp = $this->num_pages >= 10 ? 10 : $this->num_pages;
            }

            if($this->num_pages > 1) {
                // searching for http_get_vars
                foreach ($GLOBALS[HTTP_GET_VARS] as $_get_name => $_get_value) {
                    if ($_get_name != $this->offset) {
                        $this->_get_vars .= "&$_get_name=$_get_value";
                    }
                }
                $this->successivo = $GLOBALS[$this->offset] + $this->limit;
                $this->precedente = $GLOBALS[$this->offset] - $this->limit;
                $this->theClass = $objClass;
                if (!empty($rew)) {
                  $return .= ($GLOBALS[$this->offset] > 0) ? "|<a href=\"$GLOBALS[PHP_SELF]?$this->offset=0$this->_get_vars\" $this->theClass>$frew</a>$separator " : "|$frew|";
                }

                // showing pages
                if ($this->show_pages_number || !isset($this->show_pages_number))
                {
                    for($this->a = $fgp; $this->a <= $egp; $this->a++)
                    {
                        $this->theNext = ($this->a-1)*$this->limit;
                        $_ss_k = floor($this->theNext/26);
                        if ($this->theNext != $GLOBALS[$this->offset])
                        {
                            $return .= " <a href=\"$GLOBALS[PHP_SELF]?$this->offset=$this->theNext$this->_get_vars\" $this->theClass> ";
                            if ($this->number_type == 'alpha')
                            {
                                 if($_ss_k>0)
                                 {
                                    $theLink = chr(64 + ($_ss_k));
                                    for($b = 0; $b < $_ss_k; $b++)
                                    {
                                       $theLink .= chr(64 + ($this->theNext%26)+1);
                                    }
                                    $return .= $theLink;
                                 } else {
                                 $return .= chr(64 + ($this->a));
                                 }
                            } else {
                                $return .= $this->a;
                            }
                            $return .= "</a> ";
                        } else {
                            if ($this->number_type == 'alpha')
                            {
                                 if($_ss_k>0)
                                 {
                                    $theLink = chr(64 + ($_ss_k));
                                    for($b = 0; $b < $_ss_k; $b++)
                                    {
                                       $theLink .= chr(64 + ($this->theNext%26)+1);
                                    }
                                    $return .= $theLink;
                                 } else {
                                 $return .= chr(64 + ($this->a));
                                 }
                            } else {
                                $return .= $this->a;
                            }
                            $return .= ($this->a < $this->num_pages) ? " $separator " : " ";
                        }
                    }
                    $this->theNext = $GLOBALS[$this->offset] + $this->limit;
                    if (!empty($fwd)) {
                        $offset_end = ($this->num_pages-1)*$this->limit;
                       $return .= ($GLOBALS[$this->offset] + $this->limit < $this->total_result) ? "|<a href=\"$GLOBALS[PHP_SELF]?$this->offset=$offset_end$this->_get_vars\" $this->theClass>$ffwd</a>|" : "|$ffwd|";
                    }
                }
            }
            return $return;
        }

        function show_info() // [Function : Showing the Information for the Offset]
        {
		//	echo "<br>";
           if($GLOBALS[$this->offset] >= $this->total_result || $GLOBALS[$this->offset] < 0) return false;
            $return .= $this->total_result . "&nbsp;Record(s) Found.";
            $_from = $GLOBALS[$this->offset] + 1;
            $GLOBALS[$this->offset] + $this->limit >= $this->total_result ? $_to = $this->total_result : $_to = $GLOBALS[$this->offset] + $this->limit;
            $return .= "<font color=\"#6699CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;Showing " . $_from . " to " . $_to . "</font><br><hr \"#FFFFFF\" width=50% align=right>";
            return "<font color=\"#6699CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$return</font>";
        }
    }

?>