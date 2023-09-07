<!DOCTYPE html>
<html>
<head>
	<title>Добавить новую страну</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<style type="text/css">
		body {
		font-family: Arial, sans-serif;
		background-color: #f2f2f2;
	}
	h2 {
		color: #333;
		text-align: center;
	}
	form {
		background-color: #fff;
		padding: 20px;
		border-radius: 5px;
		box-shadow: 0px 0px 10px #ccc;
		max-width: 600px;
		margin: 0 auto;
	}
	label {
		display: block;
		font-weight: bold;
		margin-bottom: 10px;
	}
	input[type="number"], button, input[type="text"], textarea {
		padding: 10px;
		border-radius: 5px;
		border: none;
		width: 95%;
		margin-bottom: 20px;
		background-color: #f2f2f2;
	}
	input[type="number"]:focus, button, input[type="text"]:focus, textarea:focus {
		outline: none;
		background-color: #e6e6e6;
	}
	button {
		background-color: #333;
		color: #fff;
		cursor: pointer;
		width: 98%;
		transition: background-color 0.3s ease;
	}
	button:hover {
		background-color: #555;
	}
	table {
		margin-top: 20px;
		border-collapse: collapse;
		width: 100%;
	}
	table th, table td {
		padding: 10px;
		text-align: center;
		border: 1px solid #ccc;
	}
	table th {
		background-color: #f2f2f2;
	}

	  .back-button {
  top: 20px;
  left: 20px;
  background-color: #333;
  color: white;
  border: none;
  padding: 10px;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.back-button:hover {
  background-color: #555;
}

	</style>
</head>

<body>
	<h2>Добавление</h2>

	<form method="POST" enctype="multipart/form-data" action="add_tara.php">

	<label>codTara:</label>
		<input type="number" name="codTara" step="any" required><br>

		<label>denumire:</label>
		<input type="text" step="any" name="denumire" required><br>

		<label>continent:</label>
		<input type="text" name="continent" step="any" required><br>

		<button type="submit" name="submit">Добавить</button><br>
	</form>

	<button type="submit" name="submit" onclick="location.href='prosmotr.php'" class="back-button">Назад</button>

	<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "orase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["submit"])) {
	$codTara = isset($_POST["codTara"]) ? $_POST["codTara"] : "";
	$denumire = isset($_POST["denumire"]) ? $_POST["denumire"] : "";
	$continent = isset($_POST["continent"]) ? $_POST["continent"] : "";

	if (trim($codTara) === "" || trim($denumire) === "" || trim($continent) === "") {
		echo "<script>alert('Заполните все поля.');</script>";
	} else {
		$sql = "INSERT INTO tara (codTara, denumire, continent) VALUES ('$codTara', '$denumire', '$continent')";

		if ($conn->query($sql) === TRUE) {
			echo "<script>alert('Новая запись успешно создана.');</script>";
			echo "<script>window.location.href = 'prosmotr.php';</script>";
		} else {
			echo "<script>alert('Ошибка: " . $conn->error . "');</script>";
		}
	}
}

$conn->close();
?>

</body>
</html>
