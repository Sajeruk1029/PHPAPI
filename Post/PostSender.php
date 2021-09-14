<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Controll-Allow-Methods: POST");
	header("Access-Controll-Max-Age: 3600");
	header("Access-Controll-Allow-Headers: Content-Type, Access-Controll-Allow-Headers, Authorization, X-Requested-With");

	include_once '../DB/Database.php';

	$Query = "insert into Post values(?, ?, ?, ?)";

	$Db = new Database("host", "user", "password", "databasename");

	$Stmt = NULL;

	$Id = 0;
	$Name = "";
	$Salary = 0;
	$IsDeleted = 0;

	if(isset($_GET['Id'])){ $Id = $_GET['Id']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'Id' parametr!"));
		return;
	}

	if(isset($_GET['Name'])){ $Name = $_GET['Name']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'Name' parametr!"));
		return;
	}

	if(isset($_GET['Salary'])){ $Salary = $_GET['Salary']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'Salary' parametr!"));
		return;
	}

	if(isset($_GET['IsDeleted'])){ $IsDeleted = $_GET['IsDeleted']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'IsDeleted' parametr!"));
		return;
	}

	if($Id == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "Id must not be empty!"));
		return;
	}

	if($Name == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "Name must not be empty!"));
		return;
	}

	if($Salary == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "Salary must not be empty!"));
		return;
	}

	if($IsDeleted == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "IsDeleted must not be empty!"));
		return;
	}

	if(!$Db->openConnection())
	{
		http_response_code(500);
		echo json_encode(array('Error' => "Error connection with database!", 'Error' => "Error code: " . $Db->getConnectionErrorCode() . " Error: " . $Db->getConnectionError()));
		return;
	}

	$Stmt = $Db->getDb()->prepare($Query);

	$Stmt->bind_param("isii", $Id, $Name, $Salary, $IsDeleted);

	if(!$Stmt->execute())
	{
		http_response_code(400);
		echo json_encode(array('Error' => "Error execute query!"));
		$Db->closeConnection();
		return;
	}

	$Db->closeConnection();

	http_response_code(200);
	echo json_encode(array('Result' => "Ok!"));
?>
