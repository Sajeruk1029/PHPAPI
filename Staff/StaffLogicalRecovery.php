<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Controll-Allow-Methods: POST");
	header("Access-Controll-Max-Age: 3600");
	header("Access-Controll-Allow-Headers: Content-Type, Access-Controll-Allow-Headers, Authorization, X-Requested-With");

	include_once '../DB/Database.php';

	$Query = "update Staff set IsDeleted = ? where PassportNumber = ? and PassportSeries = ?";

	$Db = new Database("host", "user", "password", "databasename");

	$Stmt = NULL;

	$PassportNumber = 0;
	$PassportSeries = 0;

	$IsDeleted = 0;

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

	if(!$Db->openConnection())
	{
		http_response_code(500);
		echo json_encode(array('Error' => "Error connection with database!", 'Error' => "Error code: " . $Db->getConnectionErrorCode() . " Error: " . $Db->getConnectionError()));
		return;
	}

	$Stmt = $Db->getDb()->prepare($Query);

	$Stmt->bind_param("iii", $IsDeleted, $PassportNumber, $PassportSeries);

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
