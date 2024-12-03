<?php
function generate_recipe($meal) {
    $recipes = [
        'Завтрак' => [
            'main' => ['Омлет', 'Яичница', 'Сырники', 'Блины', 'Оладьи', 'Овсяная каша', 'Гречневая каша', 'Мюсли', 'Манная каша', 'Рисовая каша', 'Творожная запеканка', 'Гренки'],
            'drink' => ['Чай', 'Вода', 'Сок', 'Компот', 'Кофе', 'Молоко', 'Морс ягодный'],
            'dessert' => ['Фрукты', 'Йогурт', 'Панна-котта', 'Желе', 'Кусок торта', 'Суфле', 'Пудинг'],
            'side' => [],
            'soup' => []
        ],
        'Обед' => [
            'soup' => ['Щи', 'Борщ', 'Рассольник', 'Куриный бульон', 'Солянка', 'Окрошка', 'Гороховый', 'Шпинатовый', 'Грибной', 'Рыбный', 'Харчо', 'Томатный', 'Молочный', 'Луковый'],
            'drink' => ['Компот', 'Сок', 'Вода', 'Морс ягодный', 'Чай', 'Лимонад'],
            'dessert' => ['Кусок торта', 'Вафли', 'Пряник', 'Печенье', 'Кусок пирога', 'Курник', 'Пончик', 'Слойка', 'Чизкейк'],
            'main' => [],
            'side' => []
        ],
        'Ужин' => [
            'main' => ['Курица', 'Ленивые голубцы', 'Котлета', 'Отбивная', 'Тушеная свинина', 'Котлета по-киевски', 'Форель, запеченная в сливках', 'Запеченная скумбрия'],
            'side' => ['Овощной салат', 'Жареная картошка', 'Макароны', 'Рис', 'Гречка', 'Пюре', 'Чечевица', 'Тушенная капуста', 'Стручковая фасоль', ''],
            'drink' => ['Вино', 'Сок', 'Лимонад', 'Компот', 'Кефир', 'Ряженка', 'Чай','Вода'],
            'dessert' => ['Мороженое', 'Слойка', 'Сочник', 'Шоколадный фондан', 'Тирамису', 'Печенье', 'Панна-котта'],
            'soup' => []
        ]
    ];

    return $recipes[$meal];
}
?>