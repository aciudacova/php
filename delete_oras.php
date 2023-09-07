<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "orase";

// Создание подключения к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);
// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['codOras'])) {
    $codOras = $_GET['codOras'];

    // Формирование запроса на удаление записи
    $deleteSql = "DELETE FROM orase WHERE codOras='$codOras'";
if ($conn->query($deleteSql) === TRUE) {
    // Квартиры успешно удалены, теперь можно удалить агента
    $deleteAgentSql = "DELETE FROM orase WHERE codOras='$codOras'";
    if ($conn->query($deleteAgentSql) === TRUE) {
        echo "<script>alert('успешно удалено.');</script>";
        echo "<script>window.location.href = 'prosmotr.php';</script>";
    } else {
        echo "<script>alert('Ошибка при удалении.');</script>";
    }
} else {
    echo "<script>alert('Ошибка при удалении.');</script>";
}

$conn->close();
}
?>
