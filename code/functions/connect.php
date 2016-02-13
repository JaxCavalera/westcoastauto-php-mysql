<?php

class connect
{
	public function db_connect($host, $user, $pass, $db_name)
	{
		return new PDO('mysql:host='.$host.'; dbname='.$db_name, $user, $pass);
	}
}
?>