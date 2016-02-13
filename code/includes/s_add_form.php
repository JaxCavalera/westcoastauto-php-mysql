<?php

$db = new db;

$add_staff_error = '';

/*Create a new vehicle entry when the submit button is pressed*/
if (isset($_POST['name']) && 
	isset($_POST['phone']) && 
	isset($_POST['email']) && 
	isset($_POST['f_username']) && 
	isset($_POST['f_password']) &&
	isset($_POST['f_password_again']))
{
	$staff_name =	$_POST['name'];
	$phone =		$_POST['phone'];
	$email =		$_POST['email'];
	$staff_uname =	$_POST['f_username'];
	$staff_pass =	$_POST['f_password'];
	$staff_pass_again =	$_POST['f_password_again'];
	$security_lvl =	$_POST['security'];
	
	if (!empty($staff_name) && 
	!empty($staff_uname) && 
	!empty($phone) && 
	!empty($email) &&
	!empty($staff_pass) && 
	!empty($staff_pass_again)) 
	{
/*  Processing the new entry into the database  */
		if ($staff_pass != $staff_pass_again)
		{
			$add_staff_error = 'Password Miss-Match';
		}
		else
		{		
			if (var_is_unique('staff', 'username', $staff_uname))
			{
				if ($db->insert_new_staff($staff_name, $phone, $email, $staff_uname, md5($staff_pass), $security_lvl))
				{
					$add_staff_error = 'staff has been added to the server.  Re-visit the Add staffs page via the MENU, to clear the form. ';
				}
				else
				{
					$add_staff_error = 'There was an unexpected error adding the vehicle';
				}
			}
			else
			{
				$add_staff_error = 'Username is Already Taken';
			}
		}
	}
	else
	{
		$add_staff_error = 'Please fill in all values correctly.';
	}
}

?>


<!--Forms content below this point :-->
<div id="add_new_staff">
<h2>Add Staff</h2><br>
	<form id="add_form" action="../<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
		<div id="table_container">
			<div id="form_input_left">
				<p>Name : </p>		<input type="text" name="name" value="<?php if(isset($staff_name)){echo $staff_name;} ?>"><br>
				<p>Phone : </p>			<input type="text" name="phone" value="<?php if(isset($phone)){echo $phone;} ?>"><br>
				<p>Email : </p>			<input type="text" name="email" value="<?php if(isset($email)){echo $email;} ?>">
			</div>
			<div id="form_input_right">			
				<p>Username : </p>			<input class="staff_add_pass" type="text" name="f_username" value="<?php if(isset($staff_uname)){echo $staff_uname;} ?>"><br>
				<p>Password : </p>			<input class="staff_add_pass" type="password" name="f_password"><br>
				<p>Confirm Password : </p>	<input class="staff_add_pass" type="password" name="f_password_again"><br>
				<p>Security Level : </p>	<select class="staff_add_pass" name="security">
												<option></option>
												<option>secure_1</option>
												<option>secure_2</option>
											</select>
			</div>
		</div>
		<input class ="staff_add_sub" type="submit" value="Submit">
		<p class="add_staff_error"><?php echo $add_staff_error; ?></p>
	</form>
</div>