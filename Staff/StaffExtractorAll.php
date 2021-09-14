<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include_once '../DB/Database.php';

	$Db = new Database("host", "user", "password", "databasename");

	$Query = "select Staff.Id, Staff.FirstName, Staff.LastName, Staff.Patronymic, Post.Name, Post.Salary, Staff.PassportNumber, Staff.PassportSeries, Accounts.Login, Accounts.Password, Staff.Education, Staff.IsDeleted from Staff join Post on Staff.Post = Post.Id join Accounts on Staff.Account = Accounts.Id";

	$Stmt = NULL;
	$Num = 0;
	$StaffArr = NULL;
	$Row = NULL;
	$StaffItem = NULL;

	if(!$Db->openConnection())
	{
		http_response_code(500);
		echo json_encode(array('Error' => "Error connection with database!", 'Error' => "Error code: " . $Db->getConnectionErrorCode() . " Error: " . $Db->getConnectionError()));
		return;
	}

	$Stmt = $Db->getDB()->query($Query);
	$Num = $Stmt->num_rows;

	if($Num > 0)
	{
		$StaffArr = array();
		$StaffArr["records"] = array();

		while($Row = $Stmt->fetch_assoc())
		{
			$StaffItem = array
			(
				"Id" => $Row['Id'],
				"FirstName" => $Row['FirstName'],
				"LastName" => $Row['LastName'],
				"Patronymic" => $Row['Patronymic'],
				"Post" => $Row['Name'],
				"Salary" => $Row['Salary'],
				"PassportNumber" => $Row['PassportNumber'],
				"PassportSeries" => $Row['PassportSeries'],
				"Login" => $Row['Login'],
				"Password" => $Row['Password'],
				"Education" => $Row['Education'],
				"IsDeleted" => $Row['IsDeleted']
			);

			array_push($StaffArr["records"], $StaffItem);
		}

		http_response_code(200);
		echo json_encode($StaffArr);
	}
	else
	{
		http_response_code(404);
		echo json_encode(array('Result' => 'List staff is empty!'));
	}

	$Db->closeConnection();
?>
