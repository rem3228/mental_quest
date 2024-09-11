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

// Первая комната
function first_room() {
    global $player_lives, $player_score;

    echo "Вы находитесь в темной комнате с двумя дверями." . PHP_EOL;
    echo "1. Войти в левую дверь." . PHP_EOL;
    echo "2. Войти в правую дверь." . PHP_EOL;
    echo "Выберите (1 или 2): ";

    $choice = trim(fgets(STDIN));

    if ($choice == '1') {
        echo "Вы выбрали левую дверь и вошли в следующую комнату." . PHP_EOL;
        $player_score += 10; // Увеличение очков
        second_room(); // Переход во вторую комнату
    } elseif ($choice == '2') {
        echo "Вы выбрали правую дверь и провалились в ловушку. Вы теряете 1 жизнь." . PHP_EOL;
        $player_lives--; // Потеря жизни
        if ($player_lives > 0) {
            first_room(); // Повторяем комнату
        } else {
            game_over();
        }
    } else {
        echo "Неправильный выбор. Попробуйте снова." . PHP_EOL;
        first_room(); // Повторяем комнату
    }
}

// Вторая комната
function second_room() {
    global $player_lives, $player_score;

    echo "Вы находитесь в освещенной комнате с тремя кнопками на стене." . PHP_EOL;
    echo "1. Нажать синюю кнопку." . PHP_EOL;
    echo "2. Нажать красную кнопку." . PHP_EOL;
    echo "3. Нажать зеленую кнопку." . PHP_EOL;
    echo "Выберите (1, 2 или 3): ";

    $choice = trim(fgets(STDIN));

    if ($choice == '1') {
        echo "Вы нажали синюю кнопку, и открылась тайная дверь." . PHP_EOL;
        $player_score += 20; // Увеличение очков
        third_room(); // Переход в третью комнату
    } elseif ($choice == '2') {
        echo "Вы нажали красную кнопку, и из потолка начала капать вода. Вы теряете 1 жизнь." . PHP_EOL;
        $player_lives--; // Потеря жизни
        if ($player_lives > 0) {
            second_room(); // Повторяем комнату
        } else {
            game_over();
        }
    } elseif ($choice == '3') {
        echo "Вы нажали зеленую кнопку, и зажглись яркие лампы. Ничего не произошло." . PHP_EOL;
        second_room(); // Повторяем комнату
    } else {
        echo "Неправильный выбор. Попробуйте снова." . PHP_EOL;
        second_room(); // Повторяем комнату
    }
}

// Третья комната
function third_room() {
    global $player_lives, $player_score;

    echo "Вы попадаете в комнату с двумя зеркалами. Одно из них правдивое, другое - ложное." . PHP_EOL;
    echo "1. Посмотреть в правое зеркало." . PHP_EOL;
    echo "2. Посмотреть в левое зеркало." . PHP_EOL;
    echo "Выберите (1 или 2): ";

    $choice = trim(fgets(STDIN));

    if ($choice == '1') {
        echo "Вы смотрите в правое зеркало и видите себя. Все в порядке." . PHP_EOL;
        $player_score += 30; // Увеличение очков
        echo "Поздравляем, вы завершили начальную часть игры!" . PHP_EOL;
    } elseif ($choice == '2') {
        echo "Вы смотрите в левое зеркало, и оно разбивается. Вы теряете 1 жизнь." . PHP_EOL;
        $player_lives--; // Потеря жизни
        if ($player_lives > 0) {
            third_room(); // Повторяем комнату
        } else {
            game_over();
        }
    } else {
        echo "Неправильный выбор. Попробуйте снова." . PHP_EOL;
        third_room(); // Повторяем комнату
    }
}

// Функция завершения игры
function game_over() {
    echo "Игра окончена. У вас закончились жизни." . PHP_EOL;
    exit;
}

// Запуск игры
start_game();

?>
