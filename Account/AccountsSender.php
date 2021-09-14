<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Controll-Allow-Methods: POST");
	header("Access-Controll-Max-Age: 3600");
	header("Access-Controll-Allow-Headers: Content-Type, Access-Controll-Allow-Headers, Authorization, X-Requested-With");

	include_once '../DB/Database.php';

	$Query = "insert into Accounts values(?, ?, ?, ?)";

	$Db = new Database("host", "user", "password", "databasename");

	$Stmt = NULL;

	$Id = 0;
	$Login = "";
	$Password = 0;
	$IsDeleted = false;

	if(isset($_GET['Id'])){ $Id = $_GET['Id']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'Id' parametr!"));
		return;
	}

	if(isset($_GET['Login'])){ $Login = $_GET['Login']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'Login' parametr!"));
		return;
	}

	if(isset($_GET['Password'])){ $Password = $_GET['Password']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'Password' parametr!"));
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

	if($Login == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "Login must not be empty!"));
		return;
	}

	if($Password == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "Password must not be empty!"));
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

	$Stmt->bind_param("issi", $Id, $Login, $Password, $IsDeleted);

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
