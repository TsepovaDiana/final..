<?php
function validate($name, $recipe_name) {
    $errors = [];

    // Проверка имени
    if (empty(trim($name)) || !preg_match('/^[а-яА-ЯЁё\s]+$/u', $name) || strlen($name) > 100) {
        $errors[] = "Имя должно содержать только русские буквы и пробелы, и быть не более 100 символов.";
    }

    // Проверка названия рецепта
    if (empty(trim($recipe_name)) || !preg_match('/^[а-яА-ЯЁё\s]+$/u', $recipe_name) || strlen($recipe_name) > 100) {
        $errors[] = "Название рецепта должно содержать только русские буквы и пробелы, и быть не более 100 символов.";
    }


    return $errors;
}
?>
