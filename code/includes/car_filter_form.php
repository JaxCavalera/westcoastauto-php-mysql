<?php

?>


<!--
Needs AJAX to produce defined lists from values based on previously selected options
Form content below this point.
-->

<form id="car_filter" action="../<?php echo $current_page; ?>" method="post">
	<h1>Filter Used Vehicles</h1>
	<p>Category : </p>		<select name="category">
								<option>ALL</option>
							</select><br>
	<p>Manufacturer : </p>	<select name="manufacturer">
								<option value="all">ALL</option>
								<optgroup label="Toyota">
									<option value="model">Landcruiser</option>
								</optgroup>
							</select><br>
	<p>Year : </p>			<input type="text" name="year"><br>
	<p>Min Price : </p>		<input type="text" name="min_price"><br>
	<p>Max Price : </p>		<input type="text" name="max_price"><br>
	<p>Colour : </p>		<input type="" name="colour"><br>
	<p>Kilometres : </p>	<input type="" name="kilometres"><br>
	<p>Cylinders : </p>		<input type="" name="cylinders"><br>
	<p>Transmission : </p>	<select name="transmission">
								<option>ALL</option>
							</select><br>
	<p>Fuel Type : </p>		<select name="fuel">
								<option>ALL</option>
							</select><br>
	<p>Specials Only : </p>	<input type="checkbox" name="special">
	<input class="update_button" type="submit" name="update" value="Update">
</form>