<?php

$db = new db;

$fields = $db->field_list('clients', array('name', 'address', 'phone', 'email', 'client_id'));


			
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
		
		$db->client_table_data('clients', 'client_id');
		
		?>
	</tbody>
</table>