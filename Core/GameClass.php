<?php
namespace Core;

class Game
{

    private $playerOneResult = 0;

    private $playerTwoResult = 0;

    private $roundsCount = 0;

    private $hands = [];

    public function __construct()
    {
        $this->hands = [
            1 => 'Stone',
            2 => 'Paper',
            3 => 'Scissors',
        ];
    }

    public function playRounds($num)
    {
        $count = (int)$num;
        if ($count != $num) {
            throw new \Exception('Rounds count must be a integer.');
        }

        $this->roundsCount = $count;
    }

    public function play()
    {
        for ($i = 0; $i < $this->roundsCount; $i++) {
            $playerOneHand = mt_rand(1, count($this->hands));
            $playerTwoHand = mt_rand(1, count($this->hands));

            if ($playerOneHand === $playerTwoHand) {
                --$i;
                continue;
            }

            $this->addScore($playerOneHand, $playerTwoHand);
        }
    }

    public function winner()
    {
        // display winner
    }

    private function addScore($playerOneHand, $playerTwoHand)
    {

    }

    private function getMove()
    {
        // returns random item
    }

}