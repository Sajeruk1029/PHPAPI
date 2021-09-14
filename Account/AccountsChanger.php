<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Controll-Allow-Methods: POST");
	header("Access-Controll-Max-Age: 3600");
	header("Access-Controll-Allow-Headers: Content-Type, Access-Controll-Allow-Headers, Authorization, X-Requested-With");

	include_once '../DB/Database.php';

	$Query = "update Accounts set Login = ?, Password = ?, IsDeleted = ? where Login = ?";

	$Db = new Database("host", "user", "password", "databasename");

	$Stmt = NULL;

	$OldLogin = "";
	$NewLogin = "";
	$NewPassword = "";
	$NewIsDeleted = "";

	if(isset($_GET['OldLogin'])){ $OldLogin = $_GET['OldLogin']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'OldLogin' parametr!"));
		return;
	}

	if(isset($_GET['NewLogin'])){ $NewLogin = $_GET['NewLogin']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'NewLogin' parametr!"));
		return;
	}

	if(isset($_GET['NewPassword'])){ $NewPassword = $_GET['NewPassword']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'NewPassword' parametr!"));
		return;
	}

	if(isset($_GET['NewIsDeleted'])){ $NewIsDeleted = $_GET['NewIsDeleted']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'NewIsDeleted' parametr!"));
		return;
	}

	if($OldLogin == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "OldLogin must not be empty!"));
		return;
	}

	if($NewLogin == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "NewLogin must not be empty!"));
		return;
	}

	if($NewPassword == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "NewPassword must not be empty!"));
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

	$Stmt->bind_param("ssss", $NewLogin, $NewPassword, $NewIsDeleted, $OldLogin);

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
