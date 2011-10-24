<?php

class Models_Database
{
	
	var $link = NULL;
	var $database = NULL;
	private $host = 'localhost';
	private $user = '';
	private $password = '';
	private $dbname = '';
	
	function __construct(){
		$this->link = new mysqli($this->host, $this->user, $this->password, $this->dbname);
		$this->database = $this->dbname;
		if(mysqli_connect_errno())
		{
		    trigger_error('Error connecting: '.$mysqli->error);
		}
	}
			
	public function readSql($sql){
		
		$q = $this->link->query($sql);
		$result = '';		
		while($row = $q->fetch_array()){
			$result[] = $row;
		}

		return $result;
	}

	public function insertData($arr,$tablename,$id = false){
	
		$values = array();
		foreach($arr as $key=>$val){
			$fields[] = "$key";
			$val = addslashes($val);
			$values[] = "'" . $this->link->real_escape_string($val) . "'";
		}
		
		$fields = implode(",",$fields);
		$values = implode(",",$values);
		
		$q = "INSERT INTO `" . $tablename . "` ($fields) VALUES ($values)";
		if($this->executeQuery($q)){
			if($id == true){
				//return last inserted id
				return $this->link->insert_id;
			}else{
				return true;	
			}
		}else{
			return false;
		}
	
	}
	
	public function updateData($table,$arr,$key_c,$key_v){
	
		$values = array();
		foreach($arr as $key=>$val){
			$values[] = "`$key` = '" . $this->link->real_escape_string($val) . "'";
		}
		
		$values = implode(",",$values);	
		$q = "UPDATE `" . $table . "` SET " . $values . " WHERE `$key_c` = '".$this->link->real_escape_string($key_v)."'";
		
		return $this->executeQuery($q);
	}
	

	public function deleteData($table,$key_c,$key_v, $limit = '1'){
		$q = "DELETE FROM `$table` WHERE `$table`.`$key_c` = "
			.$this->link->real_escape_string($key_v); 
			//." LIMIT $limit";
		
		return $this->executeQuery($q);
	}
	
	public function executeQuery($sql){	
		return $this->link->query($sql);
	}
}

?>