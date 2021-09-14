<?php
	class Post
	{
		private $Id = 0;
		private $Login = "";
		private $Password = "";
		private $IsDeleted = 0;

		public function __construct($Id, $Login, $Password, $IsDeleted)
		{
			$this->Id = $Id;
			$this->Login = $Login;
			$this->Password = $Password;
			$this->IsDeleted = $IsDeleted;
		}

		public function getId(){ return $this->Id; }
		public function getLogin(){ return $this->Login; }
		public function getPassword(){ return $this->Password; }
		public function getIsDeleted(){ return $this->IsDeleted; }

		public function setId($Id){ $this->Id = $Id; }
		public function setName($Login){ $this->Login = $Login; }
		public function setSalary($Password){ $this->Password = $Password; }
		public function setIsDeleted($IsDeleted){ $this->IsDeleted = $IsDeleted; }
	}
?>
