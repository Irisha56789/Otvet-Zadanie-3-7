<?php
// Инициализация массива для хранения отзывов
$reviews = [
    ['name' => 'Иван', 'review' => 'Отличный товар!', 'rating' => 5],
];

// Обработка отзыва о товаре
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    $name = htmlspecialchars($_POST['name']);
    $review = htmlspecialchars($_POST['review']);
    $rating = intval($_POST['rating']);

    if (!empty($name) && !empty($review) && $rating >= 1 && $rating <= 5) {
        $reviews[] = ['name' => $name, 'review' => $review, 'rating' => $rating];
    } else {
        $error_review = "Пожалуйста, заполните все поля корректно.";
    }
}

// Обработка отмены заказа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_order'])) {
    $order_id = htmlspecialchars($_POST['order_id']);
    $cancellation_reason = htmlspecialchars($_POST['cancellation_reason']);

    if (!empty($order_id) && !empty($cancellation_reason)) {
        $order_info = "Номер заказа: $order_id<br>Причина отмены: $cancellation_reason";
    } else {
        $error_order = "Пожалуйста, заполните все поля корректно.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обработка данных из форм</title>
</head>
<body>
    <h1>Отзыв о товаре</h1>
    <?php if (isset($error_review)): ?>
        <p style="color: red;"><?php echo $error_review; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="name">Имя:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="review">Отзыв:</label><br>
        <textarea id="review" name="review" required></textarea><br><br>

        <label for="rating">Рейтинг (1-5):</label><br>
        <select id="rating" name="rating" required>
            <option value="">Выберите рейтинг</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select><br><br>

        <input type="submit" name="submit_review" value="Отправить отзыв">
    </form>

    <h2>Отзывы:</h2>

<?php foreach ($reviews as $rev): ?>
    <p><strong>Имя:</strong> <?php echo $rev['name']; ?></p>
    <p><strong>Отзыв:</strong> <?php echo $rev['review']; ?></p>
    <p><strong>Рейтинг:</strong> <?php echo $rev['rating']; ?></p>
    <hr>
<?php endforeach; ?>

    <h1>Отмена заказа</h1>
    <?php if (isset($error_order)): ?>
        <p style="color: red;"><?php echo $error_order; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="order_id">Номер заказа:</label><br>
        <input type="text" id="order_id" name="order_id" required><br><br>

        <label for="cancellation_reason">Причина отмены:</label><br>
        <textarea id="cancellation_reason" name="cancellation_reason" required></textarea><br><br>

        <input type="submit" name="submit_order" value="Отменить заказ">
    </form>

    <?php if (isset($order_info)): ?>
        <h2>Информация об отмене:</h2>
        <p><?php echo $order_info; ?></p>
    <?php endif; ?>
</body>
</html>
