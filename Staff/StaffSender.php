<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Controll-Allow-Methods: POST");
	header("Access-Controll-Max-Age: 3600");
	header("Access-Controll-Allow-Headers: Content-Type, Access-Controll-Allow-Headers, Authorization, X-Requested-With");

	include_once '../DB/Database.php';

	$Query = "insert into Staff values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

	$Db = new Database("host", "user", "password", "databasename");

	$Stmt = NULL;

	$Id = 0;
	$FirstName = "";
	$LastName = "";
	$Patronymic = "";
	$Post = 0;
	$PassportNumber = 0;
	$PassportSeries = 0;
	$Account = 0;
	$Education = "";
	$IsDeleted = 0;

	if(isset($_GET['Id'])){ $Id = $_GET['Id']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'Id' parametr!"));
		return;
	}

	if(isset($_GET['FirstName'])){ $FirstName = $_GET['FirstName']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'FirstName' parametr!"));
		return;
	}

	if(isset($_GET['LastName'])){ $LastName = $_GET['LastName']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'LastName' parametr!"));
		return;
	}

	if(isset($_GET['Patronymic'])){ $Patronymic = $_GET['Patronymic']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'Patronymic' parametr!"));
		return;
	}

	if(isset($_GET['Post'])){ $Post = $_GET['Post']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'Post' parametr!"));
		return;
	}

	if(isset($_GET['PassportNumber'])){ $PassportNumber = $_GET['PassportNumber']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'PassportNumber' parametr!"));
		return;
	}

	if(isset($_GET['PassportSeries'])){ $PassportSeries = $_GET['PassportSeries']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'PassportSeries' parametr!"));
		return;
	}

	if(isset($_GET['Account'])){ $Account = $_GET['Account']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'Account' parametr!"));
		return;
	}

	if(isset($_GET['Education'])){ $Education = $_GET['Education']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'Education' parametr!"));
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

	if($FirstName == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "FirstName must not be empty!"));
		return;
	}

	if($LastName == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "LastName must not be empty!"));
		return;
	}

	if($Patronymic == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "Patronymic must not be empty!"));
		return;
	}

	if($Post == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "Post must not be empty!"));
		return;
	}

	if($PassportNumber == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "PassportNumber must not be empty!"));
		return;
	}

	if($PassportSeries == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "PassportSeries must not be empty!"));
		return;
	}

	if($Account == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "Account must not be empty!"));
		return;
	}

	if($Education == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "Education must not be empty!"));
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

	$Stmt->bind_param("isssiiiisi", $Id, $FirstName, $LastName, $Patronymic, $Post, $PassportNumber, $PassportSeries, $Account, $Education, $IsDeleted);

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

