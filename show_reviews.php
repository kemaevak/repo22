<?php
// Подключение к базе данных
$dsn = 'mysql:host=localhost;dbname=my_project_db'; // Замените 'my_project_db' на имя вашей базы данных
$username = 'root'; // Стандартное имя пользователя для MySQL
$password = ''; // Оставьте пустым, если не устанавливали пароль

try {
    // Подключаемся к базе данных
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получаем все отзывы из таблицы `reviews`
    $sql = "SELECT * FROM reviews";
    $stmt = $pdo->query($sql);
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Отображаем отзывы на странице
    echo "<h2>Отзывы о товарах</h2>";
    foreach ($reviews as $review) {
        echo "<p><strong>Имя:</strong> " . htmlspecialchars($review['name']) . "<br>";
        echo "<strong>Отзыв:</strong> " . htmlspecialchars($review['review']) . "<br>";
        echo "<strong>Рейтинг:</strong> " . htmlspecialchars($review['rating']) . "/5<br>";
        echo "<strong>Дата:</strong> " . htmlspecialchars($review['created_at']) . "<br><br></p>";
    }
} catch (PDOException $e) {
    echo 'Ошибка подключения: ' . $e->getMessage();
}
?>
