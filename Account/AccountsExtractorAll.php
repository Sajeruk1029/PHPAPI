<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include_once '../DB/Database.php';

	$Db = new Database("host", "user", "password", "databasename");

	$Query = "select * from Accounts";

	$Stmt = NULL;
	$Num = 0;
	$AccountsArr = NULL;
	$Row = NULL;
	$AccountstItem = NULL;

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
		$AccountsArr = array();
		$AccountsArr["records"] = array();

		while($Row = $Stmt->fetch_assoc())
		{
			$AccountsItem = array
			(
				"Id" => $Row['Id'],
				"Login" => $Row['Login'],
				"Password" => $Row['Password'],
				"IsDeleted" => $Row['IsDeleted']
			);

			array_push($AccountsArr["records"], $AccountsItem);
		}

		http_response_code(200);
		echo json_encode($AccountsArr);
	}
	else
	{
		http_response_code(404);
		echo json_encode(array('Result' => 'List accounts is empty!'));
	}

	$Db->closeConnection();
?>
