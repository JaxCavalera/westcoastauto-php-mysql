<?php

$db = new db;

$fields = $db->field_list('vehicles', array('price', 'year', 'kilometres'));


			
?>


<table>
	<thead>
		<tr>
			<?php
			
			foreach ($fields as $row)
			{
				echo '<th class="table_heads">'.ucwords($row).'<br><span class="down-arw"></span><span class="up-arw"></span></th>';
			}
			
			?>
			<th class="car_desc_h">Description</th>
			<th class="car_photo_h">Photo</th>
		</tr>
	</thead>
	<tbody>
		<?php
		
		$db->car_table_data('vehicles', 'vehicle_id');
		
		?>
	</tbody>
</table>