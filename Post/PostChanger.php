<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Controll-Allow-Methods: POST");
	header("Access-Controll-Max-Age: 3600");
	header("Access-Controll-Allow-Headers: Content-Type, Access-Controll-Allow-Headers, Authorization, X-Requested-With");

	include_once '../DB/Database.php';

	$Query = "update Post set Name = ?, Salary = ?, IsDeleted = ? where Name  =  ?";

	$Db = new Database("host", "user", "password", "databasename");

	$Stmt = NULL;

	$OldName = "";
	$NewName = "";
	$NewSalary = 0;
	$NewIsDeleted = 0;

	if(isset($_GET['OldName'])){ $OldName = $_GET['OldName']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'OldName' parametr!"));
		return;
	}

	if(isset($_GET['NewName'])){ $NewName = $_GET['NewName']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'NewName' parametr!"));
		return;
	}

	if(isset($_GET['NewSalary'])){ $NewSalary = $_GET['NewSalary']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'NewSalary' parametr!"));
		return;
	}

	if(isset($_GET['NewIsDeleted'])){ $NewIsDeleted = $_GET['NewIsDeleted']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'NewIsDeleted' parametr!"));
		return;
	}

	if($OldName == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "OldName must not be empty!"));
		return;
	}

	if($NewName == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "NewName must not be empty!"));
		return;
	}

	if($NewSalary == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "NewSalary must not be empty!"));
		return;
	}

	if($NewIsDeleted == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "NewIsDeleted must not be empty!"));
		return;
	}

	if(!$Db->openConnection())
	{
		http_response_code(500);
		echo json_encode(array('Error' => "Error connection with database!", 'Error' => "Error code: " . $Db->getConnectionErrorCode() . " Error: " . $Db->getConnectionError()));
		return;
	}

	$Stmt = $Db->getDb()->prepare($Query);

	$Stmt->bind_param("siis", $NewName, $NewSalary, $NewIsDeleted, $OldName);

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
