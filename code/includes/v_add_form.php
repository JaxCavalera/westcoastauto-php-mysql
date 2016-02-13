<?php

$db = new db;

$add_car_error = '';

/*Create a new vehicle entry when the submit button is pressed*/
if (isset($_POST['category']) && 
	isset($_POST['kilometres']) && 
	isset($_POST['price']) && 
	isset($_POST['manufacturer']) && 
	isset($_POST['cylinders']) && 
	isset($_POST['colour']) && 
	isset($_POST['model']) && 
	isset($_POST['transmission']) && 
	isset($_POST['vin']) && 
	isset($_POST['year']) && 
	isset($_POST['fuel']))
{
	$category = 	$_POST['category'];
	$km =			$_POST['kilometres'];
	$price =		$_POST['price'];
	$photo =		$_FILES['photo_add']['name'];
	$brand =		$_POST['manufacturer'];
	$cyl =			$_POST['cylinders'];
	$reg =			$_POST['registration'];
	$colour =		$_POST['colour'];
	$model =		$_POST['model'];
	$trans =		$_POST['transmission'];
	$vin =			$_POST['vin'];
	$staff_id =		$_POST['staff_id'];
	$year =			$_POST['year'];
	$fuel =			$_POST['fuel'];
	$special =		$_POST['special'];
	$client_id =	$_POST['client_id'];

	if (!empty($category) && 
	!empty($km) && 
	!empty($price) && 
	!empty($brand) && 
	!empty($cyl) && 
	!empty($colour) && 
	!empty($model) && 
	!empty($trans) && 
	!empty($vin) && 
	!empty($year) && 
	!empty($fuel))
	{
		/*  processing the upload image first  */
		if ($_FILES['photo_add']['size'] > 2000000)
		{
			$add_car_error = 'Photo must be less than 2Mb in size';
		}
		elseif ($_FILES['photo_add']['type'] != ('image/jpeg' || 'image/jpg'))
		{
			$add_car_error = 'Image must be a Jpg or Jpeg';
		}
		else
		{
			$tmp_name = $_FILES['photo_add']['tmp_name'];
			$location = 'images/';
			$today = getdate();
			
			if (move_uploaded_file($tmp_name, $photo_loc = $location.strtolower($colour).'_'.strtolower($category).'_'.$today['mday'].'_'.$today['mon'].'_'.$today['year'].'.jpg'))
			{
				$add_car_error = 'Image Successfully Uploaded to : '.$photo_loc;
				
				if (!ctype_digit($year) || strlen($year) < 4)
				{
					$add_car_error = 'YEAR must only contain numbers and must be 4 digits long';
				}
				elseif (!ctype_digit($vin) || strlen($vin) != 12)
				{
					$add_car_error = 'VIN must be 12 digits long and only contain numbers';
				}
				elseif (!ctype_digit($cyl) || $cyl > 24)
				{
					$add_car_error = 'Cylinders must be a number and can not exceed 24';
				}
				elseif (!ctype_digit($price))
				{
					$add_car_error = 'Price must only contain numbers';
				}
				elseif (!ctype_digit($km))
				{
					$add_car_error = 'Kilometres must only contain numbers';
				}
				elseif 	(empty($photo))
				{
					$add_car_error = 'No photo chosen';
				}
				else
				{
				
				/*  Processing the new entry into the database  */
					if ($db->insert_new_car($category, $km, $price, $photo_loc, $brand, $cyl, $reg, $colour, $model, $trans, $vin, $staff_id, $year, $fuel, $special, $client_id))
					{
						$add_car_error = 'Vehicle has been added to the server.  Re-visit the Edit Vehicles page via the MENU, to clear the form. ';
					}
					else
					{
						$add_car_error = 'There was an unexpected error adding the vehicle';
					}
				}
			}
			else
			{
				$add_car_error = 'There was an unexpected error uploading the photo.';
			}
		}
	}
	else
	{
		$add_car_error = 'Please fill in all values correctly.';
	}
}

?>


<!--Forms content below this point :-->
<div id="add_new_car">
<h2>Add Vehicle</h2><br>
	<form id="add_form" action="../<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
		<div id="form_input_left">
			<p>Category : </p>		<select name="category"><?php $db->get_tab_options('car_types', 'category'); ?></select><br>
			<p>Kilometres : </p>	<input type="text" name="kilometres" value="<?php if(isset($km)){echo $km;} ?>"><br>
			<p>Price : </p>			<input type="text" name="price" value="<?php if(isset($price)){echo $price;} ?>"><br>
			<p>Photo : </p>			<input type="file" name="photo_add">
		</div>
		<div id="form_input_middle_left">
			<p>Manufacturer : </p>	<select name="manufacturer"><?php $db->get_tab_options('car_brand', 'manufacturer'); ?></select><br>
			<p>Cylinders : </p>		<input type="text" name="cylinders" maxlength="2" value="<?php if(isset($cyl)){echo $cyl;} ?>"><br>
			<p>Registration : </p>	<input type="text" name="registration" value="<?php if(isset($reg)){echo $reg;} ?>"><br>
			<p>Colour : </p>		<input type="text" name="colour" value="<?php if(isset($colour)){echo $colour;} ?>">
		</div>
		<div id="form_input_middle_right">			
			<p>Model : </p>			<input name="model" value="<?php if(isset($model)){echo $model;} ?>"><br>
			<p>Transmission : </p>	<select name="transmission"><?php $db->get_tab_options('car_trans', 'transmission'); ?></select><br>
			<p>12 Digit VIN : </p>	<input type="text" name="vin" maxlength="12" value="<?php if(isset($vin)){echo $vin;} ?>"><br>
			<p>Staff ID : </p>		<select name="staff_id">
										<option></option> <!-- keep this option empty -->
										<?php $db->get_tab_options('staff', 'staff_id'); ?>
									</select>
		</div>
		<div id="form_input_right">			
			<p>Year : </p>			<input type="text" name="year" maxlength="4" value="<?php if(isset($year)){echo $year;} ?>"><br>
			<p>Fuel Type : </p>		<select name="fuel"><?php $db->get_tab_options('car_fuel', 'fuel'); ?></select><br>
			<p>On Special? : </p>	<select name="special"><option>0</option><option>1</option></select><br>
			<p>Client ID : </p>		<select name="client_id">
										<option></option> <!-- keep this option empty -->
										<?php $db->get_tab_options('clients', 'client_id'); ?>
									</select>
		</div>
		<p class="add_car_error"><?php echo $add_car_error; ?></p><input class ="car_add_sub" type="submit" value="Submit">
	</form>
</div>
<div id="del_existing_car">
	<?php
	
	include 'code/includes/del_car.php';
	
	?>
</div>