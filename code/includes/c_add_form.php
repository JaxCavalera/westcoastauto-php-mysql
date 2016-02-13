<?php

$db = new db;

$add_client_error = '';

/*Create a new vehicle entry when the submit button is pressed*/
if (isset($_POST['name']) && 
	isset($_POST['address']) && 
	isset($_POST['phone']) && 
	isset($_POST['email']))
{
	$client_name =	$_POST['name'];
	$address =		$_POST['address'];
	$phone =		$_POST['phone'];
	$email =		$_POST['email'];

	if (!empty($client_name) && 
	!empty($address) && 
	!empty($phone) && 
	!empty($email)) 
	{
/*  Processing the new entry into the database  */
		if ($db->insert_new_client($client_name, $address, $phone, $email))
		{
			$add_client_error = 'Client has been added to the server.  Re-visit the Add Clients page via the MENU, to clear the form. ';
		}
		else
		{
			$add_client_error = 'There was an unexpected error adding the vehicle';
		}
	}
	else
	{
		$add_client_error = 'Please fill in all values correctly.';
	}
}

?>


<!--Forms content below this point :-->
<div id="add_new_client">
<h2>Add Client</h2><br>
	<form id="add_form" action="../<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
		<div id="table_container">
			<div id="form_input_left">
				<p>Name : </p>		<input type="text" name="name" value="<?php if(isset($client_name)){echo $client_name;} ?>"><br>
				<p>Address : </p>	<input type="text" name="address" value="<?php if(isset($address)){echo $address;} ?>"><br>
			</div>
			<div id="form_input_right">			
				<p>Phone : </p>			<input type="text" name="phone" value="<?php if(isset($phone)){echo $phone;} ?>"><br>
				<p>Email : </p>			<input type="text" name="email" value="<?php if(isset($email)){echo $email;} ?>"><br>
			</div>
		</div>
		<input class ="client_add_sub" type="submit" value="Submit">
		<p class="add_client_error"><?php echo $add_client_error; ?></p>
	</form>
</div>