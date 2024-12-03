<?php
session_start();
require_once 'generate.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $meal = $_POST['meal'];
    if ($meal != 'Завтрак' && $meal != 'Обед' && $meal != 'Ужин') {
        $_SESSION['errors'][] = "Некорректный выбор! Выберите Завтрак, Обед или Ужин.";
        header("Location: index.php");
        exit;
    }
    $generated_recipe = generate_recipe($meal);

    $main=$generated_recipe['main'][array_rand($generated_recipe['main'])];
    $side=$generated_recipe['side'][array_rand($generated_recipe['side'])];
    $drink=$generated_recipe['drink'][array_rand($generated_recipe['drink'])];
    $dessert=$generated_recipe['dessert'][array_rand($generated_recipe['dessert'])];
    $soup=$generated_recipe['soup'][array_rand($generated_recipe['soup'])];
    $timestamp = date("Y-m-d H:i:s");

    $_SESSION['meal']=$meal;
    $_SESSION['main']=$main;
    $_SESSION['side']=$side;
    $_SESSION['drink']=$drink;
    $_SESSION['dessert']=$dessert;
    $_SESSION['soup']=$soup;
    $_SESSION['timestamp']=$timestamp;

    

    $_SESSION['last_recipe'] = "Ваш $meal:\n \n" .
                                ($meal === 'Ужин' ? "Гарнир: " . $side . "\n" : "") .
                                ($meal === 'Завтрак' || $meal === 'Ужин' ? "Основное: " . $main . "\n" : "") .
                                ($meal === 'Обед' ? "Суп: " . $soup . "\n" : "") .
                                "Напиток: " . $drink . "\n" .
                                "Десерт: " . $dessert . "\n";

    header("Location: recipe.php");
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>
