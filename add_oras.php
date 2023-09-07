<!DOCTYPE html>
<html>
<head>
	<title>Добавить новую квартиру</title>
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
		background-color: #f2f3f3;
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
	<h2>Добавление городa</h2>
	<form method="POST" enctype="multipart/form-data" action="add_oras.php">


<label>denumire:</label>
<input type="text" name="denumire" required><br>

<label>numarulLocuitori:</label>
<input type="number" step="1000" name="numarulLocuitori" required><br>

<label>codTara:</label>
<select name="codOras">
	<?php
	// Подключение к базе данных
	$servername = "localhost:3306";
	$username = "root";
	$password = "";
	$dbname = "orase";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Получение списка агентов из базы данных
	$sql = "SELECT codOras, denumire, numarulLocuitori FROM orase";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$codOras = $row["codOras"];
			$denumire = $row["denumire"];
			$numarulLocuitori = $row["numarulLocuitori"];
			echo "<option value='$codTara'>$codOras $denumire</option>";
		}
	}

	$conn->close();
	?>
</select><br>

<button type="submit" name="submit">Добавить</button><br>

</form>
<br>
<button type="button" name="submit" onclick="location.href='prosmotr.php'" class="back-button">Назад</button>	
<?php
	// Обработка отправки формы
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$codOras = $_POST["codOras"];
		$denumire = $_POST["denumire"];
		$numarulLocuitori = $_POST["numarulLocuitori"];
		$codTara = $_POST["codTara"];

		// Подключение к базе данных
		$servername = "localhost:3306";
		$username = "root";
		$password = "";
		$dbname = "orase";

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Вставка данных в базу данных
		$sql = "INSERT INTO orase (codOras, denumire, numarulLocuitori, codTara)
				VALUES ('$codOras', '$denumire', '$numarulLocuitori', '$codTara')";

		if (empty($codOras) || empty($denumire) || empty($numarulLocuitori) || empty($codTara)) {
			echo "<script>alert('Заполните все поля.');</script>";
		} else {
			if ($conn->query($sql) === TRUE) {
				echo "<script>alert('Новая запись успешно создана.');</script>";
				echo "<script>window.location.href = 'prosmotr.php';</script>";
			} else {
				echo "<script>alert('Ошибка: " . $conn->error . "');</script>";
			}
		}

		$conn->close();
	}
?>

</body>

</html>
