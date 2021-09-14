<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include_once '../DB/Database.php';

	$Db = new Database("host", "user", "password", "databasename");

	$Query = "select * from Post where IsDeleted = 1";
	$Stmt = NULL;
	$Num = 0;
	$PostArr = NULL;
	$Row = NULL;
	$PostItem = NULL;

	$Post = NULL;

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
		$PostArr = array();
		$PostArr["records"] = array();

		while($Row = $Stmt->fetch_assoc())
		{
			$PostItem = array
			(
				"Id" => $Row['Id'],
				"Name" => $Row['Name'],
				"Salary" => $Row['Salary'],
				"IsDeleted" => $Row['IsDeleted']
			);

			array_push($PostArr["records"], $PostItem);
		}

		http_response_code(200);
		echo json_encode($PostArr);
	}
	else
	{
		http_response_code(404);
		echo json_encode(array('Result' => 'List post deleted is empty!'));
	}

	$Db->closeConnection();
?>
