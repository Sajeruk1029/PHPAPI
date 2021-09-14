<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Controll-Allow-Methods: POST");
	header("Access-Controll-Max-Age: 3600");
	header("Access-Controll-Allow-Headers: Content-Type, Access-Controll-Allow-Headers, Authorization, X-Requested-With");

	include_once '../DB/Database.php';

	$Query = "update Staff set FirstName = ?, LastName = ?, Patronymic = ?, Post = ?, PassportNumber = ?, PassportSeries = ?, Account = ?, Education = ?, IsDeleted = ? where PassportNumber =  ? and PassportSeries = ?";

	$Db = new Database("host", "user", "password", "databasename");

	$Stmt = NULL;

	$OldPassportNumber = 0;
	$OldPassportSeries = 0;

	$NewFirstName = "";
	$NewLastName = "";
	$NewPatronymic = "";
	$NewPost = 0;
	$NewPassportNumber = 0;
	$NewPassportSeries = 0;
	$NewAccount = 0;
	$NewEducation = 0;
	$NewIsDeleted = 0;

	if(isset($_GET['OldPassportNumber'])){ $OldPassportNumber = $_GET['OldPassportNumber']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'OldPassportNumber' parametr!"));
		return;
	}

	if(isset($_GET['OldPassportSeries'])){ $OldPassportSeries = $_GET['OldPassportSeries']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'OldPassportSeries' parametr!"));
		return;
	}

	if(isset($_GET['NewFirstName'])){ $NewFirstName = $_GET['NewFirstName']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'NewFirstName' parametr!"));
		return;
	}

	if(isset($_GET['NewLastName'])){ $NewLastName = $_GET['NewLastName']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'NewLastName' parametr!"));
		return;
	}

	if(isset($_GET['NewPatronymic'])){ $NewPatronymic = $_GET['NewPatronymic']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'NewPatronymic' parametr!"));
		return;
	}

	if(isset($_GET['NewPost'])){ $NewPost = $_GET['NewPost']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'NewPost' parametr!"));
		return;
	}

	if(isset($_GET['NewPassportNumber'])){ $NewPassportNumber = $_GET['NewPassportNumber']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'NewPassportNumber' parametr!"));
		return;
	}

	if(isset($_GET['NewPassportSeries'])){ $NewPassportSeries = $_GET['NewPassportSeries']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'NewPassportSeries' parametr!"));
		return;
	}

	if(isset($_GET['NewAccount'])){ $NewAccount = $_GET['NewAccount']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'NewAccount' parametr!"));
		return;
	}

	if(isset($_GET['NewEducation'])){ $NewEducation = $_GET['NewEducation']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'NewEducation' parametr!"));
		return;
	}

	if(isset($_GET['NewIsDeleted'])){ $NewIsDeleted = $_GET['NewIsDeleted']; }
	else
	{
		http_response_code(400);
		echo json_encode(array('Error' => "No found 'NewIsDeleted' parametr!"));
		return;
	}

	if($OldPassportNumber == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "OldPassportNumber must not be empty!"));
		return;
	}

	if($OldPassportSeries == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "NewPassportSeries must not be empty!"));
		return;
	}

	if($NewFirstName == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "NewFirstName must not be empty!"));
		return;
	}

	if($NewLastName == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "NewLastName must not be empty!"));
		return;
	}

	if($NewPatronymic == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "NewPatronymic must not be empty!"));
		return;
	}

	if($NewPost == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "NewPost must not be empty!"));
		return;
	}

	if($NewPassportNumber == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "NewPassportNumber must not be empty!"));
		return;
	}

	if($NewPassportSeries == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "NewPassportSeries must not be empty!"));
		return;
	}

	if($NewAccount == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "NewAccount must not be empty!"));
		return;
	}

	if($NewEducation == "")
	{
		http_response_code(400);
		echo json_encode(array('Error' => "NewEducation must not be empty!"));
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

	$Stmt->bind_param("sssiiiisiii", $NewFirstName, $NewLastName, $NewPatronymic, $NewPost, $NewPassportNumber, $NewPassportSeries, $NewAccount, $NewEducation, $NewIsDeleted, $OldPassportNumber, $OldPassportSeries);

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
