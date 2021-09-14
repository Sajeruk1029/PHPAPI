<?php
	class Database
	{
		private $Hostname = "";
		private $DBName = "";
		private $Login = "";
		private $Password = "";

		private $DB = NULL;

		public $Opened = false;

		public function __construct($Host, $User, $Passwd, $Dbname)
		{
			$this->Hostname = $Host;
			$this->DBName = $Dbname;
			$this->Login = $User;
			$this->Password = $Passwd;
		}

		public function getHostName(){ return $this->Hostname; }
		public function getDBName(){ return $this->DBName; }
		public function getLogin(){ return $this->Login; }
		public function getPassword(){ return $this->Password; }

		public function getDB(){ return $this->DB; }

		public function getConnectionErrorCode(){ return $this->DB->connect_errno; }
		public function getConnectionError(){ return $this->DB->connect_error; }
		public function getError(){ return $this->DB->error; }

		public function getHostInfo(){ return $this->host_info(); }

		public function setHostName($Host){ $this->Hostname = $Host; }
		public function setDBName($Dbname){ $this->DBName = $Dbname; }
		public function setUserName($User){ $this->Login = $User; }
		public function setPassword($Passwd){ $this->Password = $Passwd; }

		public function openConnection()
		{
			$this->DB = @new mysqli($this->Hostname, $this->Login, $this->Password, $this->DBName);

			$this->Opened = (!$this->DB->connect_errno)? true : false;

			return $this->Opened;
		}

		public function closeConnection()
		{
			if($this->Opened)
			{
				mysqli_close($this->DB);
			}
		}
	}

?>
