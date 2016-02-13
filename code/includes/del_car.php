<?php

$db = new db;

$fields = $db->field_list('vehicles', array('price', 'year', 'kilometres'));


			
?>
<h2>Delete Vehicles</h2><br>
<form action="../<?php echo $current_page; ?>" method="POST">
<table>
	<thead>
		<tr>
			<th>ID</th>
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
		
		$db->del_car_table_data('vehicles', 'vehicle_id');
		
		?>
	</tbody>
</table>
<input type="submit" class="del_sel_cars" name="del_sel_cars" value="Delete Selected Cars">
</form>