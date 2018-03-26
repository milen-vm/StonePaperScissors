<?php
/**
 * run the game
 * php -f start.php
 *
 * execute the unit tests
 * ./vendor/bin/phpunit
 */

require_once __DIR__ . '/vendor/autoload.php';

$playerOne = new \App\Player('George');
$playerTwo = new \App\Player('Michel');

$game = new \App\Game($playerOne, $playerTwo);
//$game->playRounds(3);
//$game->play();
//
//$winner = $game->winner();
//$game->printResult();

$playerOne->setHand('Paper');
$playerTwo->setHand('Stone');
echo $game->fight();
$game->printResult();


