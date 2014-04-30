<?php
/*
 *		Add Sales Associate
 */
 
require_once("../../FCKEditor/fckeditor.php");
								


if($_POST) 
{
	include_once('../../data.inc.php');
			
/*echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	
echo "<pre>";
print_r($_FILES);
	echo "</pre>";*/
//	
//[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]
//var re = /^\w+([\.-]?\w+)*@\w+ ([\.-]?\w+)*(\.\w{2,3})+$/
//if(!ereg("/^\w+([\.-]?\w+)*@\w+ ([\.-]?\w+)*(\.\w{2,3})+$/", $_POST['res_email'])) 
    //{
	
   //echo "bad email";
   //header("location: add_att.php");
	//}
	
	
//else
{
if(!empty($_FILES['res_image1']['name'])) 
     {
	
		//echo "here";	
		if(preg_match('/\\.(exe|com|bat|zip|doc|txt|php|pl|cgi|htm|html|phtml)$/i', $_FILES['res_image1']['name'])) 
		{
			echo "File Not uploaded. Please use an image file for your pictures.";
		}
		else
		{
			#########upload the pdf and populate the db
			// copy to this directory
			$dir="../../uploads/images/";
			$image_name = $_FILES['res_image1']['name'];
					
			$photox = time().'_'."$image_name";
			
			//$image = stripslashes($image);

			// copy the file to the server
			move_uploaded_file($_FILES['res_image1']['tmp_name'],$dir.$photox);
				
			// check whether it has been uploaded
			if (!is_uploaded_file ($photo1))
			{
				$msg = "<b>$image_name</b> couldn't be copied.";
			}
		}
    }
	
	
	
	
if(!empty($_FILES['res_image2']['name'])) 
     {
	
		//echo "here";	
		if(preg_match('/\\.(exe|com|bat|zip|doc|txt|php|pl|cgi|htm|html|phtml)$/i', $_FILES['res_image2']['name'])) 
		{
			echo "File Not uploaded. Please use an image file for your pictures.";
		}
		else
		{
			#########upload the pdf and populate the db
			// copy to this directory
			$dir="../../uploads/images/";
			$image_name = $_FILES['res_image2']['name'];
					
			$photoy = time().'_'."$image_name";
			
			//$image = stripslashes($image);

			// copy the file to the server
			move_uploaded_file($_FILES['res_image2']['tmp_name'],$dir.$photoy);
				
			// check whether it has been uploaded
			if (!is_uploaded_file ($photo2))
			{
				$msg = "<b>$image_name</b> couldn't be copied.";
			}
		}
    }
	


if(!empty($_FILES['res_map']['name'])) 
     {
	
		//echo "here";	
		if(preg_match('/\\.(exe|com|bat|zip|doc|txt|php|pl|cgi|htm|html|phtml)$/i', $_FILES['res_map']['name'])) 
		{
			echo "File Not uploaded. Please use an image file for your pictures.";
		}
		else
		{
			#########upload the pdf and populate the db
			// copy to this directory
			$dir="../../uploads/images/";
			$image_name = $_FILES['res_map']['name'];
					
			$photoz = time().'_'."$image_name";
			
			//$image = stripslashes($image);

			// copy the file to the server
			move_uploaded_file($_FILES['res_map']['tmp_name'],$dir.$photoz);
				
			// check whether it has been uploaded
			if (!is_uploaded_file ($photo3))
			{
				$msg = "<b>$image_name</b> couldn't be copied.";
			}
		}
    }

    $photo1 = addslashes(mysql_real_escape_string($_POST['res_image1']));
	$photo2 = addslashes(mysql_real_escape_string($_POST['res_image2']));
	$photo3 = addslashes(mysql_real_escape_string($_POST['res_map']));

	
if(isset($_POST['edit'])) 
{
		if(!empty($_FILES['res_image1']['name']))
		{
			$updateProfile = mysql_query("update banner set 
			restaurant.res_image1='".$photox."',
			restaurant.res_image2='".$photoy."',
			where res_id=".$_POST['edit']) or die("83".mysql_error());
			
			//$updateUser =  mysql_query("update users set 
			//email='".$email."',
			//real_name='".$fname." ".$lname."', 
			//password='".encrypt($password)."', 
			//issales='y'			
			//where email='".$email."'") or die("90".mysql_error());
		}
		
		// its for photo 2
		
		else if(!empty($_FILES['res_image2']['name']))
		{
			$updateProfile = mysql_query("update restaurant set 
			restaurant.res_image1='".$photox."',
			restaurant.res_image2='".$photoy."',
			where res_id=".$_POST['edit']) or die("83".mysql_error());
			
		}

		else if(!empty($_FILES['res_map']['name']))
		{
			$updateProfile = mysql_query("update restaurant set 
			restaurant.res_image1='".$photox."',
			restaurant.res_image2='".$photoy."',
			where res_id=".$_POST['edit']) or die("83".mysql_error());
		}
		
		
		else
		{
			$updateProfile = mysql_query("update restaurant set 
			restaurant.res_name='".$res_name."',
			restaurant.res_address='".$res_address."',
			restaurant.res_phone='".$res_phone."',
			restaurant.res_mobile='".$res_mobile."',
			restaurant.res_email='".$res_email."',
			restaurant.res_fax='".$res_fax."',
			restaurant.res_cuisine='".$res_cuisine."', 
			restaurant.res_neighbor='".$res_neighbor."', 
			restaurant.res_description='".$about."',
			restaurant.res_price='".$res_price."',
			
			restaurant.res_payment='".$res_payment."',
			restaurant.res_atmosphere='".$res_atmosphere."',
			restaurant.res_hours='".$res_hours."',
			restaurant.res_capacity='".$res_capacity."'
			where res_id=".$_POST['edit']) or die("83".mysql_error());
			
			//$updateUser =  mysql_query("update users set 
			//email='".$email."',
			//real_name='".$fname." ".$lname."', 
			//password='".encrypt($password)."', 
			//issales='y'			
			//where email='".$email."'") or die("90".mysql_error());

		}	
		
		// start of query for res_cuisine
		
		    $deleteProfile = mysql_query("delete from res_cuisine where res_id=".$_POST['edit'])                             or die(mysql_error());
			
		    $count=count($cuisine);													
			for ($i=0; $i<$count ;$i++)															
			{
			 
			 $insertProfile = mysql_query(
			                        "insert into res_cuisine ( 
								     res_cuisine.res_id,
									 res_cuisine.cui_id
											
																			
															 ) 
									values (
									        '".$_POST['edit']."',
											'".$cuisine[$i]."'
									        )"
											) or die("152:".mysql_error());
			 
			 
			 }
			   // end of query for res_cuisine

		
}


else
{
		$insertProfile = mysql_query("insert into restaurant (
											restaurant.res_image1,
											restaurant.res_image2,
																			
															 ) 
									values (
											'".$photox."',
											'".$photoy."',
											)") or die("152:".mysql_error());
			
			$insert_id=mysql_insert_id();
											
			$count=count($cuisine);													
			for ($i=0; $i<$count ;$i++)															
			{
			 
			 $insertProfile = mysql_query(
			                        "insert into res_cuisine ( 
								     res_cuisine.res_id,
									 res_cuisine.cui_id
											
																			
															 ) 
									values (
									        '".$insert_id."',
											'".$cuisine[$i]."'
									        )"
											) or die("152:".mysql_error());
			 
			 
			 }
			 
			//$insertUser =  mysql_query(
			//"insert into users(email,real_name,password,issales)
			//values(
			//'".$email."',
			//'".$fname." ".$lname."',
			//'".encrypt($password)."',
			//'".'y'."'
			//)") or die("162:".mysql_error());																		
}
	
	header("location: index.php");
}

}

include("../../header.inc.php");


//if(isset($_GET['delete'])) {
	//$delete = mysql_query("delete from sales_associates where id=".$_GET['delete']) or die(mysql_error());
//}

$menu['Restaurant Lists'] = 'index.php';
$menu['Add Restaurant'] = 'add_att.php';


if(isset($_GET['edit'])) 
{
	$label = 'Edit';
	
	$sqlAtt = mysql_query("select * from restaurant where res_id=".$_GET['edit']) or die(  
	mysql_error());
	
	$is_checked= mysql_query("select * from res_cuisine where res_id=".$_GET['edit'])            or die(mysql_error());

    while($d = mysql_fetch_object($is_checked)) {
				$sel_neighbor[] = $d->cui_id; 
			                                 }
											 
	$obj = mysql_fetch_object($sqlAtt);
	$oFCKeditor = new FCKeditor('about');
	$oFCKeditor->BasePath = '../../FCKEditor/';
	$oFCKeditor->Value = stripslashes($obj->res_description);
	$oFCKeditor->Width  = '100%' ;
	$oFCKeditor->Height = '250' ;
	$fck_about = $oFCKeditor->CreateHtml();
	

	
	$hidden = '<input type="hidden" name="edit" value="'.$_GET['edit'].'">';
}


else
{
	$label = 'Add';
	$hidden = '';
	$oFCKeditor = new FCKeditor('about');
	$oFCKeditor->BasePath = '../../FCKEditor/';
	$oFCKeditor->Value = "";
	$oFCKeditor->Width  = '100%' ;
	$oFCKeditor->Height = '250' ;
	$fck_about = $oFCKeditor->CreateHtml();

}

echo '<br /><div style="font-size: 18px; font-weight: bold; color: #cccccc">&nbsp;&nbsp;'.$label.' Restaurants</div>';
echo subNav($menu,$_GET['x']);


?>

<br />
<form name="addAtt" method="post" action="" enctype="multipart/form-data">
	<?php echo $hidden; ?>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<?php if($obj->res_image1 != "") { ?>
		  <tr>
		  <td><span style="padding-top: 5px;">Current image1: <br />
              <img src="../../uploads/images/<?php echo stripslashes(stripslashes($obj->res_image1));?>" />
          </span></td>
	  </tr><?php }?>
	  <tr>
		  <td><span style="padding-top: 5px;">image1: <br />
              <input type="file" name="res_image1" size="48" value="<?php echo stripslashes(stripslashes($obj->res_image1)); ?>" class="input" />
          </span></td>
	  </tr><?php if($obj->res_image2 != "") { ?>
		  <tr>
		  <td><span style="padding-top: 5px;">Current image2: <br />
              <img src="../../uploads/images/<?php echo stripslashes(stripslashes($obj->res_image2));              ?>" />
          </span></td>
	  </tr>
		<?
		}
		?>
	  
	  <tr>
		  <td><span style="padding-top: 5px;">image2: <br />
              <input type="file" name="res_image2" size="48" value="<?php echo stripslashes(stripslashes($obj->res_image2)); ?>" class="input" />
          </span></td>
	  </tr>
	  
		
		
		<?
		if($obj->res_map != "")
		{
		
		?>
		  <tr>
		  <td><span style="padding-top: 5px;">Current Map: <br />
              <img src="../../uploads/images/<?php echo stripslashes(stripslashes($obj->res_map));              ?>" />
          </span></td>
	  </tr>
		<?
		}
		?>
	<tr>
		  <td><input type="image" name="imageField" src="../../images/submit_btn.gif" /></td>
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