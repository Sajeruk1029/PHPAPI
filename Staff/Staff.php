<?php

	class Staff
	{
		private $Id = 0;
		private $FirstName = "";
		private $LastName = "";
		private $Patronymic = "";
		private $PassportSeria = 0;
		private $PassportNumber = 0;
		private $Education = "";
		private $Post = 0;
		private $Account = 0;
		private $IsDeleted = 0;

		public function __construct($Id, $FistName, $LastName, $Patronymic, $PassportSeria, $PassportNumber, $Education, $Post, $Account, $IsDeleted)
		{
			$this->Id = $Id;
			$this->FirstName = $FirstName;
			$this->LastName = $LastName;
			$this->Patronymic = $Patronymic;
			$this->PassportSeria = $PassportSeria;
			$this->PassportNumber = $PassportNumber;
			$this->Education = $Education;
			$this->Post = $Post;
			$this->Account = $Account;
			$this->IsDeleted = $IsDeleted;
		}

		public function getId(){ return $this->Id; }
		public function getFistName(){ return $this->FirstName; }
		public function getLastName(){ return $this->LastName; }
		public function getPatronymic(){ return $this->Patronymic; }
		public function getPassportSeria(){ return $this->PassportSeria; }
		public function getPassportNumber(){ return $this->PassportNumber; }
		public function getEducation(){ return $this->Education; }
		public function getPost(){ return $this->Post; }
		public function getAccount(){ return $this->Account; }
		public function getIsDeleted(){ return $this->IsDeleted; }

		public function setId($Id){ $this->Id = $Id; }
		public function setFirstName($FirstName){ $this->FirstName = $FirstName; }
		public function setLastName($LastName){ $this->LastName = $LastName; }
		public function setPatronymic($Patronymic){ $this->Patronymic = $Patronymic; }
		public function setPassportSeria($PassportSeria){ $this->PassportSeria = $PassportSeria; }
		public function setPassportNumber($PassportNumber){ $this->PassportNumber = $PassportNumber; }
		public function setEducation($Education){ $this->Education = $Education; }
		public function setPost($Post){ $this->Post = $Post; }
		public function setAccount($Account){ $this->Account = $Account; }
		public function setIsDeleted($IsDeleted){ $this->IsDeleted = $IsDeleted; }
	}
?>
