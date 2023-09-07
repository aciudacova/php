<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update oras</title>
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
  input[type="number"], input[type="submit"], input[type="text"], textarea {
    padding: 10px;
    border-radius: 5px;
    border: none;
    width: 95%;
    margin-bottom: 20px;
    background-color: #f2f2f2;
  }
  input[type="number"]:focus, input[type="submit"], input[type="text"]:focus, textarea:focus {
    outline: none;
    background-color: #e6e6e6;
  }
  input[type="submit"] {
    background-color: #333;
    color: #fff;
    cursor: pointer;
    width: 98%;
    transition: background-color 0.3s ease;
  }
  input[type="submit"]:hover {
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
<?php
  // подключаемся к базе данных
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
  if (isset($_GET['codOras'])) {
  $codOras = $_GET['codOras'];

  // формируем запрос к базе данных для получения информации 
  $sql = "SELECT * FROM orase WHERE codOras = $codOras";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
        <form action="prosmotr.php" method="POST">
        codOras: <input type="number" name="nume" value="<?php echo $row['codOras']; ?>"> <br>
        denumire: <input type="text" name="denumire" value="<?php echo $row['denumire']; ?>"> <br>
        numarulLocuitori: <input type="text" name="numarulLocuitori" value="<?php echo $row['numarulLocuitori']; ?>"> <br>
            <input type="hidden" name="codTara" value="<?php echo $codTara; ?>">
            <input type="submit" value="Сохранить">
        </form>
        <?php
  } else {
    echo "Город не найден.";
  }

  $conn->close();
} else {
  echo "Идентификатор города не передан.";
}
?>

</body>
</html>