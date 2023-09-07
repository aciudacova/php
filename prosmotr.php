<!DOCTYPE html>
<html>
<head>
  <title>Apartamente</title>
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['codOras'])) {
        $codOras = $_POST['codOras'];
        $denumire = $_POST['denumire'];
        $numarulLocuitori = $_POST['numarulLocuitori'];
        $codTara = $_POST['codTara'];

        // Формируем и выполняем запрос на обновление данных города
        $sql_agent = "UPDATE orase SET codOras=?, denumire=?, numarulLocuitori=? WHERE codTara=?";
        $stmt_agent = $conn->prepare($sql_agent);
        $stmt_agent->bind_param("ssisi", $codOras, $denumire, $numarulLocuitori, $codTara);

        if ($stmt_agent->execute()) {
            echo "<script>alert('Данные города успешно обновлены.');</script>";
        } else {
            echo "<script>alert('Ошибка при обновлении данных города.');</script>";
        }
    }

    if (isset($_POST['codTara'])) {
        $codTara = $_POST['codTara'];
        $denumire = $_POST['denumire'];
        $continent = $_POST['continent'];

        // Формируем и выполняем запрос на обновление данных страны
        $sql_apartament = "UPDATE tara SET denumire=?, continent=? WHERE codTara=?";
        $stmt_apartament = $conn->prepare($sql_apartament);
        $stmt_apartament->bind_param("iiiii", $codTara, $denumire, $continent);

        if ($stmt_apartament->execute()) {
            echo "<script>alert('Данные страны успешно обновлены.');</script>";
        } else {
            echo "<script>alert('Ошибка при обновлении данных страны.');</script>";
        }
    }
}

// формируем запрос к базе данных
$sql = "SELECT * FROM orase";

// выполняем запрос и выводим результаты
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  echo "<table><tr><th>codOras</th><th>denumire</th><th>numarulLocuitori</th><th>codTara</th><th>Actions</th></tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['codOras'] . "</td>";
    echo "<td>" . $row['denumire'] . "</td>";
    echo "<td>" . $row['numarulLocuitori'] . "</td>";
    echo "<td>" . $row['codTara'] . "</td>";
    echo "<td>";
    echo "<button type=\"submit\" name=\"submit\" onclick=\"location.href='update_oras.php?codOras=" . $row['codOras'] . "'\" class=\"back-button\">Update</button>";
    echo "<button type=\"button\" onclick=\"confirmDeleteAgent('".$row['codOras']."')\" class=\"back-button\">Delete</button>";
    echo "</td>";
    echo "</tr>";
  }
  echo "</table><br>";
} else {
  echo "По вашему запросу ничего не найдено.";
}

$sql_agent = "SELECT * FROM orase";

// выполняем запрос и получаем результаты для таблицы "agent"
$result_agent = $conn->query($sql_agent);
$agents = array();
if ($result_agent->num_rows > 0) {
  while ($row_agent = $result_agent->fetch_assoc()) {
    $agents[$row_agent['codOras']] = $row_agent['denumire'] . ' ' . $row_agent['numarulLocuitori'];
  }
}

// формируем запрос к базе данных для таблицы 
$sql_apartament = "SELECT * FROM tara";

// выполняем запрос и выводим результаты для таблицы
$result_apartament = $conn->query($sql_apartament);
if ($result_apartament->num_rows > 0) {
  echo "<table><tr><th>codTara</th><th>denumire</th><th>continent</th><th>Actions</th></tr>";
  while ($row_apartament = $result_apartament->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row_apartament['codTara'] . "</td>";
    echo "<td>" . $row_apartament['denumire'] . "</td>";
    echo "<td>" . $row_apartament['continent'] . "</td>";
    echo "<td>";
    echo "<button type=\"submit\" name=\"submit\" onclick=\"location.href='update_tara.php?codTara=" . $row_apartament['codTara'] . "'\" class=\"back-button\">Update</button>";
    echo "<button type=\"button\" onclick=\"confirmDeleteApartament('".$row_apartament['codTara']."')\" class=\"back-button\">Delete</button>";
    echo "</td>";
    echo "</tr>";
  }
  echo "</table><br>";
} else {
  echo "По вашему запросу ничего не найдено.";
}

// закрываем соединение с базой данных
$conn->close();
?>
<button type="submit" name="submit" onclick="location.href='add_oras.php'" class="back-button">Добавить город</button><br><br>
<button type="submit" name="submit" onclick="location.href='add_tara.php'" class="back-button">Добавить страну</button> 
<button type="submit" name="submit" onclick="location.href='index.php'" class="back-button">Меню</button> 


<script type="text/javascript">
  function confirmDeleteAgent(codOras) {
  if (confirm("Вы уверены, что хотите удалить запись?")) {
    window.location.href = "delete_oras.php?codOras=" + codOras;
  }
}

  function confirmDeleteApartament(codTara) {
  if (confirm("Вы уверены, что хотите удалить запись?")) {
    window.location.href = "delete_tara.php?codTara=" + codTara;
  }
}
</script>
</body>
