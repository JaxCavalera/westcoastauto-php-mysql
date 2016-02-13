<?php

$db = new db;

$fields = $db->field_list('staff', array('username', 'name', 'phone', 'email', 'staff_id'));

?>


<table>
	<thead>
		<tr>
			<?php
			
			foreach ($fields as $row)
			{
				echo '<th class="table_heads">'.ucwords($row).'</th>';
			}
			
			?>
		</tr>
	</thead>
	<tbody>
		<?php
		
		$db->staff_table_data('staff', 'staff_id');
		
		?>
	</tbody>
</table>