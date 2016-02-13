<?php

if (isset($_POST['username']) && isset($_POST['password']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
/*	echo $username, $password;*/
	$user_obj = new user();
	
	if ($user_obj->login($username, $password))
	{
		header('Location: '.$http_referer);
	}
}
	
?>


<!--Form content below this point :-->

<form id="login_form" action="../<?php echo $current_page; ?>" method="post">
	<p>Username :</p><input type="text" name="username"><br>
	<p>Password :</p><input type="password" name="password"><br>
	<p class="error_css"><?php if (isset($username)) {echo $user_obj->def_un;} else {echo '';} ?></p>
	<input class="submit_button" type="submit" value="Login">
</form>
