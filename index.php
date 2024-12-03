<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Генератор приема пищи</title>
</head>
<body>
    <h1>Генератор приема пищи</h1>
    <form action="process.php" method="post">
        <label for="meal">Выберите прием пищи:</label>
        <select name="meal" required>
            <option value="">--Выберите--</option>
            <option value="Завтрак">Завтрак</option>
            <option value="Обед">Обед</option>
            <option value="Ужин">Ужин</option>
        </select>
        <button type="submit">Сгенерировать</button>
    </form>

    <?php if (isset($_SESSION['errors'])): ?>
        <div style="color: red;">
            <?= nl2br(htmlspecialchars(implode("\n", $_SESSION['errors']))) ?>
            <?php unset($_SESSION['errors']); ?>
        </div>
    <?php endif; ?>
</body>
</html>
