<?php
// Подключение к базе данных
$dsn = 'mysql:host=localhost;dbname=my_project_db'; // Замените 'my_project_db' на имя вашей базы данных
$username = 'root'; // Стандартное имя пользователя для MySQL
$password = ''; // Оставьте пустым, если не устанавливали пароль

try {
    // Подключаемся к базе данных
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Получаем данные из формы
        $name = $_POST['name'];
        $review = $_POST['review'];
        $rating = (int) $_POST['rating'];

        // SQL-запрос для добавления данных в таблицу `reviews`
        $sql = "INSERT INTO reviews (name, review, rating) VALUES (:name, :review, :rating)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['name' => $name, 'review' => $review, 'rating' => $rating]);

        echo "Отзыв успешно добавлен!";
    }
} catch (PDOException $e) {
    echo 'Ошибка подключения: ' . $e->getMessage();
}
?>
