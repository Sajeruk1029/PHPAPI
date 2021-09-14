<?php
	class Post
	{
		private $Id = 0;
		private $Name = "";
		private $Salary = 0;
		private $IsDeleted = false;

		public function __construct($Id, $Name, $Salary, $IsDeleted)
		{
			$this->Id = $Id;
			$this->Name = $Name;
			$this->Salary = $Salary;
			$this->IsDeleted = $IsDeleted;
		}

		public function getId(){ return $this->Id; }
		public function getName(){ return $this->Name; }
		public function getSalary(){ return $this->Salary; }
		public function getIsDeleted(){ return $this->IsDeleted; }

		public function setId($Id){ $this->Id = $Id; }
		public function setName($Name){ $this->Name = $Name; }
		public function setSalary($Salary){ $this->Salary = $Salary; }
		public function setIsDeleted($IsDeleted){ $this->IsDeleted = $IsDeleted; }
	}
?>
