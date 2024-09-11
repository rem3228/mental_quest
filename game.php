<?php

// Переменные состояния игрока
$player_lives = 3;
$player_score = 0;

// Основная функция запуска игры
function start_game() {
    global $player_lives, $player_score;

    echo "Добро пожаловать в 'Психический Квест'!" . PHP_EOL;
    echo "Вы начинаете свое путешествие в темной комнате..." . PHP_EOL;
    echo "У вас есть $player_lives жизни и $player_score очков." . PHP_EOL;

    // Переход в первую комнату
    first_room();
}

// Получение и проверка ввода пользователя
function get_user_input($valid_choices) {
    $choice = trim(fgets(STDIN));
    while (!in_array($choice, $valid_choices)) {
        echo "Неправильный выбор. Попробуйте снова: ";
        $choice = trim(fgets(STDIN));
    }
    return $choice;
}

// Уменьшение жизни игрока и проверка на окончание игры
function decrease_life() {
    global $player_lives;
    $player_lives--;
    echo "Вы теряете 1 жизнь. Осталось жизней: $player_lives." . PHP_EOL;

    if ($player_lives <= 0) {
        end_game("Проигрыш", "У вас закончились жизни.");
    }
}

// Увеличение очков игрока
function increase_score($points) {
    global $player_score;
    $player_score += $points;
    echo "Вы получили $points очков. Ваши очки: $player_score." . PHP_EOL;
}

// Первая комната
function first_room() {
    echo "Вы находитесь в темной комнате с двумя дверями." . PHP_EOL;
    echo "1. Войти в левую дверь." . PHP_EOL;
    echo "2. Войти в правую дверь." . PHP_EOL;
    echo "Выберите (1 или 2): ";

    $choice = get_user_input(['1', '2']);

    if ($choice == '1') {
        echo "Вы выбрали левую дверь и вошли в следующую комнату." . PHP_EOL;
        increase_score(10);
        second_room(); // Переход во вторую комнату
    } elseif ($choice == '2') {
        echo "Вы выбрали правую дверь и провалились в ловушку." . PHP_EOL;
        decrease_life();
        first_room(); // Повторяем комнату
    }
}

// Вторая комната
function second_room() {
    echo "Вы находитесь в освещенной комнате с тремя кнопками на стене." . PHP_EOL;
    echo "1. Нажать синюю кнопку." . PHP_EOL;
    echo "2. Нажать красную кнопку." . PHP_EOL;
    echo "3. Нажать зеленую кнопку." . PHP_EOL;
    echo "Выберите (1, 2 или 3): ";

    $choice = get_user_input(['1', '2', '3']);

    if ($choice == '1') {
        echo "Вы нажали синюю кнопку, и открылась тайная дверь." . PHP_EOL;
        increase_score(20);
        third_room(); // Переход в третью комнату
    } elseif ($choice == '2') {
        echo "Вы нажали красную кнопку, и из потолка начала капать вода." . PHP_EOL;
        decrease_life();
        second_room(); // Повторяем комнату
    } elseif ($choice == '3') {
        echo "Вы нажали зеленую кнопку, и зажглись яркие лампы. Ничего не произошло." . PHP_EOL;
        second_room(); // Повторяем комнату
    }
}

// Третья комната
function third_room() {
    echo "Вы попадаете в комнату с двумя зеркалами. Одно из них правдивое, другое - ложное." . PHP_EOL;
    echo "1. Посмотреть в правое зеркало." . PHP_EOL;
    echo "2. Посмотреть в левое зеркало." . PHP_EOL;
    echo "Выберите (1 или 2): ";

    $choice = get_user_input(['1', '2']);

    if ($choice == '1') {
        echo "Вы смотрите в правое зеркало и видите себя. Все в порядке." . PHP_EOL;
        increase_score(30);
        fourth_room(); // Переход в четвертую комнату
    } elseif ($choice == '2') {
        echo "Вы смотрите в левое зеркало, и оно разбивается." . PHP_EOL;
        decrease_life();
        third_room(); // Повторяем комнату
    }
}

// Четвертая комната
function fourth_room() {
    echo "Вы оказались в комнате с надписью на стене: 'Решите уравнение: 3 + x = 7'. Найдите x." . PHP_EOL;
    echo "Введите ответ: ";

    $answer = trim(fgets(STDIN));

    if ($answer == '4') {
        echo "Правильно! Вы нашли решение." . PHP_EOL;
        increase_score(40);
        end_game("Победа", "Вы завершили игру с высоким результатом!");
    } else {
        echo "Неправильно!" . PHP_EOL;
        decrease_life();
        fourth_room(); // Повторяем комнату
    }
}

// Завершение игры
function end_game($result, $message) {
	global $player_score;
    echo "Конец игры: $result. $message" . PHP_EOL;
    echo "Ваш итоговый счет: " . $player_score . PHP_EOL;
    exit;
}

// Запуск игры
start_game();

?>
