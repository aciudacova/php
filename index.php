<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Меню приложения</title>

  <style>
    .custom-btn {
      width: 200px;
      height: 100px;
      margin-right: 15px;
      border-radius: 0;
    }

    .custom-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
  </style>
</head>

<body>
  <div class="custom-container">
    <h1>Города</h1>
   
      <button class="btn btn-primary custom-btn"onclick="window.location.href = 'prosmotr.php';">Посмотреть список стран и гордов</button>
      <button class="btn btn-primary custom-btn" onclick="window.location.href = 'add_oras.php';">Добавить город</button>
      <button class="btn btn-primary custom-btn" onclick="window.location.href = 'add_tara.php';">Добавить страну</button>
      <button class="btn btn-primary custom-btn" onclick="window.location.href = 'itogi.php';">Список городов страны</button>
    </div>
  </div>
</body>

</html>
