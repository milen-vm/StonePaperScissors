<?php
namespace App;

class Player
{

    private $name;
    private $hand;
//    private $handIndex;
    private $score = 0;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getHand()
    {
        return $this->hand;
    }

    public function setHand($hand)
    {
        $this->hand = $hand;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function addScore($num = 1)
    {
        $score = (int)$num;
        if (!is_numeric($num) || $score != $num) {
            throw new \InvalidArgumentException('Rounds count must be a integer.');
        }

        $this->score += $score;
    }

    public function __toString()
    {
        return $this->name;
    }
}