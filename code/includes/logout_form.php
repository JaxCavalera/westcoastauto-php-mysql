<?php

if (isset($_POST['logout']))
{
	session_destroy();
	header('Location: '.$http_referer);
}

$staff_id = $_SESSION['id'];

$db = new db;

$name = $db->get_staff_name($staff_id);

?>


<!--Form content below this point :-->

<form id="logout_form" action="../<?php echo $current_page; ?>" method="post">
	<p>Welcome, <?php echo $name; ?></p><br>
	<input type="submit" name="logout" value="Logout">
</form>