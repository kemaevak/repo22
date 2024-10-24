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
        $order_id = $_POST['order_id'];
        $reason = $_POST['reason'];

        // SQL-запрос для добавления данных в таблицу `cancellations`
        $sql = "INSERT INTO cancellations (order_id, reason) VALUES (:order_id, :reason)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['order_id' => $order_id, 'reason' => $reason]);

        echo "Заказ #$order_id успешно отменен!";
    }
} catch (PDOException $e) {
    echo 'Ошибка подключения: ' . $e->getMessage();
}
?>
