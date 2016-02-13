<li><?php
if ($current_page == '/westcoastauto/vehicle_add.php' || $current_page == '/westcoastauto/client_info.php' || $current_page == '/westcoastauto/client_add.php' || $current_page == '/westcoastauto/staff_info.php' || $current_page == '/westcoastauto/staff_add.php')
{
	echo '<a class="current" ';
}
else
{
	echo '<a ';
}

?>href="../westcoastauto/client_info.php">Control Panel</a>
	<ul>
		<li><?php
if ($current_page == '/westcoastauto/client_info.php')
{
	echo '<a class="sub_current" ';
}
else
{
	echo '<a ';
}

?> href="../westcoastauto/client_info.php">Client Details</a>
			<ul>
				<li><?php
if ($current_page == '/westcoastauto/client_add.php')
{
	echo '<a class="sub_current" ';
}
else
{
	echo '<a ';
}

?> href="../westcoastauto/client_add.php">Add Client</a></li>
			</ul>
		</li>
		<?php
		if ($db->security_check_2($staff_id))
		{
			include 'code/includes/secure_2.php';
		}
		?>
		<li><?php
if ($current_page == '/westcoastauto/vehicle_add.php')
{
	echo '<a class="sub_current" ';
}
else
{
	echo '<a ';
}

?>href="../westcoastauto/vehicle_add.php">Edit Vehicles</a></li>
	</ul>
</li>