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

if (isset($_GET['codTara'])) {
    $codTara = $_GET['codTara'];

    // Формирование запроса на удаление записи
    $deleteSql = "DELETE FROM tara WHERE codTara='$codTara'";
if ($conn->query($deleteSql) === TRUE) {
        echo "<script>alert('Страна успешно удалена.');</script>";
        echo "<script>window.location.href = 'prosmotr.php';</script>";
    } else {
        echo "<script>alert('Ошибка при удалении страны.');</script>";
    }

$conn->close();
}
?>
