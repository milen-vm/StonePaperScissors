<?php

spl_autoload_register(function ($class)
{
    $pathElements = explode('\\', $class);
    $path = dirname(__FILE__) . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $pathElements) . 'Class.php';

    if (file_exists($path)) {
        require_once $path;
    }
});

$game = new Core\Game();
$game->playRounds('7');