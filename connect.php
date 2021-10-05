<?php
	class DB_connect{
		public $conn;
		function connect(){
			$this->conn=mysqli_connect("localhost","root","","dnk");
			return $this->conn;
		}
		function close(){
			mysqli_close($this->conn);
		}
	}
?>