<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Итог</title>
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
  <h1>Итог </h1>
  <table>
    <tr>
      <th>Города</th>
      <th>Страна</th>
    </tr>
    <?php
    // подключаемся к базе данных
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "orase";

    // Создаем подключение
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверяем подключение
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Запрос для получения списка городов указанной страны
    $sql = "SELECT orase.denumire AS total_sales FROM orase INNER JOIN tara ON orase.codOras = tara.codTara WHERE orase.denumire='Marocco' GROUP BY orase.codOras";

    //$sql = "SELECT o.denumire AS city FROM orase o JOIN tara t ON o.codTara = t.codTara WHERE t.denumire = 'Spain'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Выводим данные в таблицу
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";

        echo "<td>" . $row["total_sales"] . "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='2'>Нет данных</td></tr>";
    }

    $conn->close();
    ?>
    <button type="submit" name="submit" onclick="location.href='index.php'" class="back-button">Меню</button> 
  </table>
</body>

</html>
