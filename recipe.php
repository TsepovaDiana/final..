<?php
session_start();

if (!isset($_SESSION['last_recipe'])) {
    header("Location: index.php");
    exit;
}

$errors = [];
$name = '';
$recipe_name = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $recipe_name = trim($_POST['recipe_name']);

    // Убедитесь, что validate.php существует и корректно работает
    if (file_exists('validate.php')) {
        require_once 'validate.php';
        $errors = validate($name, $recipe_name);
    } else {
        $errors[] = 'Файл валидации не найден.';
    }

    if (empty($errors)) {
        // Получаем сгенерированный рецепт
        $meal = $_SESSION['meal'] ?? 'Неизвестно'; 
        $main = $_SESSION['main'] ?? 'Неизвестно'; 
        $side = $_SESSION['side'] ?? 'Неизвестно';
        $drink = $_SESSION['drink'] ?? 'Неизвестно'; 
        $dessert = $_SESSION['dessert'] ?? 'Неизвестно'; 
        $soup = $_SESSION['soup'] ?? 'Неизвестно';
        $timestamp = $_SESSION['timestamp'] ?? date('Y-m-d H:i:s');

        // Формируем строку рецепта
        $recipe_string = "Ваш $meal: " .
                         ($meal === 'Ужин' ? "Гарнир: " . $side . ", " : "") .
                         ($meal === 'Завтрак' || $meal === 'Ужин' ? "Основное: " . $main . ", " : "") .
                         ($meal === 'Обед' ? "Суп: " . $soup . ", " : "") .
                         "Напиток: " . $drink . ", " .
                         "Десерт: " . $dessert;

        // Читаем существующие рецепты из файла, если файл существует
        $existing_recipes = [];
        if (file_exists('recipes.txt')) {
            // Читаем существующие рецепты из файла
            $existing_recipes = file('recipes.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        } else {
            $existing_recipes = []; // Если файла нет, просто инициализируем пустой массив
        }
        
        $is_duplicate = false;

        // Проверка на дубликат
        foreach ($existing_recipes as $existing_record) {
            if (strpos($existing_record, $recipe_string) !== false) {
                $is_duplicate = true;
                list($user_name, $user_recipe_name) = explode('|', $existing_record);
                $user_name = str_replace('Имя: ', '', $user_name);
                $user_recipe_name = str_replace('Название: ', '', $user_recipe_name);
                break;
            }
        }

        // Если дубликата нет, сохраняем рецепт
        $record_string = "Имя: $name | Название: $recipe_name | $recipe_string | Дата: $timestamp" . PHP_EOL;
        if (!$is_duplicate) {
            file_put_contents('recipes.txt', $record_string, FILE_APPEND | LOCK_EX);
            echo 'Данные успешно записаны!';
        } else {
            file_put_contents('recipes.txt', $record_string, FILE_APPEND | LOCK_EX);
            echo "Данные успешно записаны, но такой же рецепт уже был сгенерирован пользователем: $user_name с названием: $user_recipe_name.";
        }

        unset($_SESSION['last_recipe']);
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Рецепт</title>
</head>
<body>
    <?php if ($_SERVER['REQUEST_METHOD'] != 'POST') { ?>
    <h1>Ваш сгенерированный рецепт</h1>
    <?php } ?>
    <pre style="font-family: 'Times New Roman';"><?php echo htmlspecialchars($_SESSION['last_recipe']); ?></pre>
    
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($errors)) { ?>
        <ul style="color:red;">
            <?php foreach ($errors as $error) { ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <?php if ($_SERVER['REQUEST_METHOD'] != 'POST' || !empty($errors)) { ?>
    <form method="POST" action="">
        <label for="name">Ваше имя:</label>
        <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($name); ?>"><br>
        <label for="recipe_name">Название рецепта:</label>
        <input type="text" id="recipe_name" name="recipe_name" required value="<?php echo htmlspecialchars($recipe_name); ?>">
        <button type="submit">Сохранить</button><br>
    </form>
    <?php } ?>
    <a href="index.php">Выйти</a>
</body>
</html>
