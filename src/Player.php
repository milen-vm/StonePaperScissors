<?php
namespace App;

class Player
{

    private $name = '';
    private $score = 0;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
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
}