<?php
/**
 * run the game
 * php -f start.php
 *
 * execute the unit tests
 * ./vendor/bin/phpunit
 */

require_once __DIR__ . '/vendor/autoload.php';

$game = new Core\Game();
$game->playRounds(3);
$game->play();
$game->winner();
