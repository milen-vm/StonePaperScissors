<?php
namespace Core;

class Game
{

    private $playerOneScore = 0;

    private $playerTwoScore = 0;

    private $roundsCount = 0;

    private $hands = [];

    private $result = '';

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
        if (!is_numeric($num) || $count != $num) {
            throw new \InvalidArgumentException('Rounds count must be a integer.');
        }

        $this->roundsCount = $count;
    }

    public function play()
    {
        for ($i = 1; $i <= $this->roundsCount; $i++) {
            $playerOneHand = mt_rand(1, count($this->hands));
            $playerTwoHand = mt_rand(1, count($this->hands));

            $this->result .= "Round: {$i}\n";
            $this->result .= "Player One: {$this->hands[$playerOneHand]}\nPlayer Two: {$this->hands[$playerTwoHand]}\n";

            if ($playerOneHand === $playerTwoHand) {
                --$i;
                $this->result .= "Round is Tie.\n\n";

                continue;
            }

            $this->addScore($playerOneHand, $playerTwoHand);
        }
    }

    public function winner()
    {
        $this->result .= "Player One Score: {$this->playerOneScore}\nPlayer Two Score: {$this->playerTwoScore}\n";
        $this->result .= "Game Winner: ";

        if ($this->playerOneScore > $this->playerTwoScore) {
            $this->result .= "Player One\n";
        } elseif ($this->playerOneScore < $this->playerTwoScore) {
            $this->result .= "Player Two\n";
        } else {
            $this->result .= "No Winner\n";
        }

        echo $this->result;
    }

    private function addScore($playerOneHand, $playerTwoHand)
    {
        $isHandsEvenOrOdd = (bool)($playerOneHand % 2) === (bool)($playerTwoHand % 2);
        $roundWinner = 'Player ';

        if ($isHandsEvenOrOdd) {
            if ($playerOneHand < $playerTwoHand) {
                ++$this->playerOneScore;
                $roundWinner .= 'One';
            } else {
                ++$this->playerTwoScore;
                $roundWinner .= 'Two';
            }
        } else {
            if ($playerOneHand > $playerTwoHand) {
                ++$this->playerOneScore;
                $roundWinner .= 'One';
            } else {
                ++$this->playerTwoScore;
                $roundWinner .= 'Two';
            }
        }

        $this->result .= "Round is for {$roundWinner}.\n\n";
    }
}