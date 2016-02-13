<li><?php
if ($current_page == '/westcoastauto/staff_info.php')
{
	echo '<a class="sub_current" ';
}
else
{
	echo '<a ';
}

?>  href="../westcoastauto/staff_info.php">Staff Details</a>
	<ul>
		<li><?php
if ($current_page == '/westcoastauto/staff_add.php')
{
	echo '<a class="sub_current" ';
}
else
{
	echo '<a ';
}

?>  href="../westcoastauto/staff_add.php">Add Staff</a></li>
	</ul>
</li>