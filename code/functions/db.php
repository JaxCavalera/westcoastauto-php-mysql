<?php

/*
When a new instance of db is created
Perform db queries using :
$sql = $this->_db->prepare(prepared query statement here)
$sql->execute()

Setting options for the Security Field

none is for all users with login credentials used for temp workers etc
secure_1 is for ALL users who can log in with basic functionality
secure_2 is for MANAGERS who can add new sales staff
*/

class db
{
	private $_db;
	
	public function __construct()
	{
		$this->_db = user::get_instance();
	}
	
	public function get_staff_name($staff_id)
	{
		$sql = $this->_db->prepare("SELECT name FROM staff WHERE staff_id = ?");
		$sql->bindParam(1, $staff_id);
		$sql->execute();
		
		$result = $sql->fetchObject();
		
		return $result->name;
	}
	
	public function security_check($staff_id)
	{
		$sql = $this->_db->prepare("SELECT security FROM staff WHERE staff_id = ?");
		$sql->bindParam(1, $staff_id);
		$sql->execute();
		
		$result = $sql->fetchObject();
		
		if ($result->security == 'secure_1' || $result->security == 'secure_2')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function security_check_2($staff_id)
	{
		$sql = $this->_db->prepare("SELECT security FROM staff WHERE staff_id = ?");
		$sql->bindParam(1, $staff_id);
		$sql->execute();
		
		$result = $sql->fetchObject();
		
		if ($result->security == 'secure_2')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
/*
Methods for displaying tabled results - Filtering the list is now optional
To filter the returned fields, include the second variable when using the method.
*/
	public function field_list($table, $match_array = null)
	{
		$sql = $this->_db->prepare("SELECT * FROM {$table} LIMIT 0");
		$sql->execute();
		
		for ($x = 0; $x < $sql->columnCount(); $x++)
		{
			$result = $sql->getColumnMeta($x);
			$fields[] = $result['name'];
			
			if (!empty($match_array))
			{
				$fields = array_intersect($match_array, $fields);
			}
		}
		return $fields;
	}
		
	public function count_rows($table, $field)
	{
		$sql = $this->_db->prepare("SELECT {$field} FROM {$table}");
		$sql->execute();
		
		$rows = $sql->rowCount();
		
		return $rows;
	}
	
	public function car_table_data($table, $field)
	{
		$x = 1;
		$all_fields = 'price, special, year, kilometres, manufacturer, model, category, colour, cylinders, transmission, fuel, photo';
		$car_count = ($this->count_rows($table, $field));
		
		$sql = $this->_db->prepare("SELECT {$all_fields} FROM {$table}");
		
		$sql->execute();
		
		while ($x <= $car_count)
		{		
			$row = $sql->fetch(PDO::FETCH_OBJ);
			
			echo '<tr>';
			echo '<td '; if ($row->special == 1){echo 'class="on_special"'; echo '> *SPECIAL*<br>$'.$row->price.'</td>';} else {echo '>$'.$row->price.'</td>';}
			echo '<td>'.$row->year.'</td>';
			echo '<td>'.$row->kilometres.'</td>';
			echo '<td>'.$row->manufacturer.' '.$row->model.'<br>'.$row->category.'<br>'.$row->colour.', '.$row->cylinders.' cylinders, '.$row->transmission.' running on '.$row->fuel.' fuel</td>';
			echo '<td><img class="car_thumb" src="'.$row->photo.'" alt="Photo of Vehicle"></td>';
			echo '</tr>';
			
			$x++;
		}
	}
	
	public function special_car_table_data($table, $field)
	{
		$x = 1;
		$all_fields = 'price, special, year, kilometres, manufacturer, model, category, colour, cylinders, transmission, fuel, photo';
		$car_count = ($this->count_rows($table, $field));
		
		$sql = $this->_db->prepare("SELECT {$all_fields} FROM {$table} WHERE special = ?");
		
		$sql->bindValue(1, 1);
		
		$sql->execute();
		
		while ($x != $car_count)
		{		
			$row = $sql->fetch(PDO::FETCH_OBJ);
			
			echo '<tr>';
			echo '<td '; if ($row->special == 1){echo 'class="on_special"'; echo '> *SPECIAL*<br>$'.$row->price.'</td>';} else {echo '>$'.$row->price.'</td>';}
			echo '<td>'.$row->year.'</td>';
			echo '<td>'.$row->kilometres.'</td>';
			echo '<td>'.$row->manufacturer.' '.$row->model.'<br>'.$row->category.'<br>'.$row->colour.', '.$row->cylinders.' cylinders, '.$row->transmission.' running on '.$row->fuel.' fuel</td>';
			echo '<td><img class="car_thumb" src="'.$row->photo.'" alt="Photo of Vehicle"></td>';
			echo '</tr>';
			
			$x++;
		}
	}
	
	public function del_car_table_data($table, $field)
	{
		$x = 1;
		$all_fields = 'vehicle_id, price, special, year, kilometres, manufacturer, model, category, colour, cylinders, transmission, fuel, photo';
		$car_count = ($this->count_rows($table, $field));
		
		$sql = $this->_db->prepare("SELECT {$all_fields} FROM {$table}");
		
		$sql->execute();
		
		while ($x <= $car_count)
		{		
			$row = $sql->fetch(PDO::FETCH_OBJ);
			
			echo '<tr>';
			echo '<td>ID : '.$row->vehicle_id.' <input type="checkbox" name="'.$row->vehicle_id.'"></td>';
			echo '<td '; if ($row->special == 1){echo 'class="on_special"'; echo '> *SPECIAL*<br>$'.$row->price.'</td>';} else {echo '>$'.$row->price.'</td>';}
			echo '<td>'.$row->year.'</td>';
			echo '<td>'.$row->kilometres.'</td>';
			echo '<td>'.$row->manufacturer.' '.$row->model.'<br>'.$row->category.'<br>'.$row->colour.', '.$row->cylinders.' cylinders, '.$row->transmission.' running on '.$row->fuel.' fuel</td>';
			echo '<td><img class="car_thumb" src="'.$row->photo.'" alt="Photo of Vehicle"></td>';
			echo '</tr>';
			
			$x++;
		}
	}
	
	public function get_tab_options($table, $field)
	{				
		$sql = $this->_db->prepare("SELECT {$field} FROM {$table}");
		$sql->execute();
		
		$x = 0;
		
		$cat_count = $sql->rowCount();
		
		while ($x < $cat_count)
		{
			$row = $sql->fetch(PDO::FETCH_OBJ);
			
			echo '<option>'.$row->$field.'</option>';
			
			$x++;
		}
	}
	
	public function insert_new_car($category, $km, $price, $photo_loc, $brand, $cyl, $reg, $colour, $model, $trans, $vin, $staff_id, $year, $fuel, $special, $client_id)
	{		
		$sql = $this->_db->prepare("INSERT INTO vehicles (category, kilometres, price, photo, manufacturer, cylinders, registration, colour, model, transmission, vin, staff_id, year, fuel, special, client_id)
									VALUES (:category, :km, :price, :photo_loc, :brand, :cyl, :reg, :colour, :model, :trans, :vin, :staff_id, :year, :fuel, :special, :client_id)");
		
		$sql->bindParam(':category', $category);
		$sql->bindParam(':km', $km);
		$sql->bindParam(':price', $price);
		$sql->bindParam(':photo_loc', $photo_loc);
		$sql->bindParam(':brand', $brand);
		$sql->bindParam(':cyl', $cyl);
		$sql->bindParam(':reg', $reg);
		$sql->bindParam(':colour', $colour);
		$sql->bindParam(':model', $model);
		$sql->bindParam(':trans', $trans);
		$sql->bindParam(':vin', $vin);
		$sql->bindParam(':staff_id', $staff_id);
		$sql->bindParam(':year', $year);
		$sql->bindParam(':fuel', $fuel);
		$sql->bindParam(':special', $special);
		$sql->bindParam(':client_id', $client_id);
		
		if ($sql->execute())
		{
			return true;
		}
	}
	
/*	Methods for CLIENTS  --------------------   */

	public function client_table_data($table, $field)
	{
		$x = 1;
		$all_fields = 'name, address, phone, email, client_id';
		$client_count = ($this->count_rows($table, $field));
		
		$sql = $this->_db->prepare("SELECT {$all_fields} FROM {$table}");
		
		$sql->execute();
		
		while ($x <= $client_count)
		{		
			$row = $sql->fetch(PDO::FETCH_OBJ);
			
			echo '<tr>';
			echo '<td>'.$row->name.'</td>';
			echo '<td>'.$row->address.'</td>';
			echo '<td>'.$row->phone.'</td>';
			echo '<td>'.$row->email.'</td>';
			echo '<td>'.$row->client_id.'</td>';
			echo '</tr>';
			
			$x++;
		}
	}
	
	public function insert_new_client($name, $address, $phone, $email)
	{		
		$sql = $this->_db->prepare("INSERT INTO clients (name, address, phone, email)
									VALUES (:name, :address, :phone, :email)");
		
		$sql->bindParam(':name', $name);
		$sql->bindParam(':address', $address);
		$sql->bindParam(':phone', $phone);
		$sql->bindParam(':email', $email);
		
		if ($sql->execute())
		{
			return true;
		}
	}
	
/*	Methods for STAFF  --------------------   */

	public function staff_table_data($table, $field)
	{
		$x = 1;
		$all_fields = 'username, name, phone, email, staff_id';
		$staff_count = ($this->count_rows($table, $field));
		
		$sql = $this->_db->prepare("SELECT {$all_fields} FROM {$table}");
		
		$sql->execute();
		
		while ($x <= $staff_count)
		{		
			$row = $sql->fetch(PDO::FETCH_OBJ);
			
			echo '<tr>';
			echo '<td>'.$row->username.'</td>';
			echo '<td>'.$row->name.'</td>';
			echo '<td>'.$row->phone.'</td>';
			echo '<td>'.$row->email.'</td>';
			echo '<td>'.$row->staff_id.'</td>';
			echo '</tr>';
			
			$x++;
		}
	}
	
	public function var_is_unique($table, $field, $var_to_compare)
	{				
		$sql = $this->_db->prepare("SELECT {$field} FROM {$table} WHERE {$field} = :var_to_compare");
		
		$sql->bindParam(':var_to_compare', $var_to_compare);
		
		if (!$sql->execute())
		{
			return true;
		}
	}
	
	public function insert_new_staff($staff_name, $phone, $email, $staff_uname, $staff_pass, $security_lvl)
	{
		$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sql = $this->_db->prepare("INSERT INTO staff (name, phone, email, username, password, security)
									VALUES (:name, :phone, :email, :username, :password, :security)");
		
		$sql->bindParam(':name', $name);
		$sql->bindParam(':phone', $phone);
		$sql->bindParam(':email', $email);
		$sql->bindParam(':username', $staff_uname);
		$sql->bindParam(':password', $staff_pass);
		$sql->bindParam(':security', $security_lvl);
		
		if ($sql->execute())
		{
			return true;
		}
	}
}

?>
