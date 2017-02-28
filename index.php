<?php

namespace Seostat;

include 'Task.php';

use Seostat\Task;

try
{
    $task = new Task();
    echo '<h2>Задача 1</h2>';
    echo '<ul>';
    foreach ($task->first() as $add) {
        echo '<li><img src="' . $add['image'] . '" alt="" /></li>';
    }
    echo '</ul>';
    
    echo '<h2>Задача 2</h2>';
    echo '<p>В ' . $task->second() . ' было живо наибольшее количество президентов.</p>';
    
} catch (\ErrorException $e) {
    // обработка исключения
    echo '<h2>Ошибка</h2>';
    echo 'Сообщение: '   . $e->getMessage();
}
?>