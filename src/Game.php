<?php
namespace App;

class Game
{

    /**
     * @var Player
     */
    private $playerOne;
    /**
     * @var Player
     */
    private $playerTwo;
    /**
     * @var int
     */
    private $roundsCount = 1;
    /**
     * @var array
     */
    private $hands = [
        1 => 'Stone',
        2 => 'Paper',
        3 => 'Scissors',
    ];
    /**
     * @var string
     */
    private $result = '';

    public function __construct(Player $playerOne, Player $playerTwo)
    {
        $this->playerOne = $playerOne;
        $this->playerTwo = $playerTwo;
    }

    public function getRoundsCount()
    {
        return $this->roundsCount;
    }

    public function playRounds($num)
    {
        $count = (int)$num;
        if (!is_numeric($num) || $count != $num) {
            throw new \InvalidArgumentException('Rounds count must be a integer.');
        }

        $this->roundsCount = $count;
    }

    public function playerOneScore()
    {
        return $this->playerOne->getScore();
    }

    public function playerTwoScore()
    {
        return $this->playerTwo->getScore();
    }

    public function playerOneHand()
    {
        return $this->playerOne->getHand();
    }

    public function playerTwoHand()
    {
        return $this->playerTwo->getHand();
    }

    public function playerOneName()
    {
        return $this->playerOne->getName();
    }

    public function playerTwoName()
    {
        return $this->playerTwo->getName();
    }

    public function play()
    {
        $handsCount = count($this->hands);
        $this->result = '';

        for ($i = 1; $i <= $this->roundsCount; $i++) {
            $handIndexPlayerOne = mt_rand(1, $handsCount);
            $this->playerOne->setHand($this->hands[$handIndexPlayerOne]);

            $handIndexPlayerTwo = mt_rand(1, $handsCount);
            $this->playerTwo->setHand($this->hands[$handIndexPlayerTwo]);

            $this->result .= "Round: {$i}" . PHP_EOL .
                "{$this->playerOne->getName()}: {$this->playerOne->getHand()}" . PHP_EOL .
                "{$this->playerTwo->getName()}: {$this->playerTwo->getHand()}" . PHP_EOL;

            $roundWinner = $this->getRoundWinner($this->playerOne, $this->playerTwo);
            if (!$roundWinner) {
                --$i;
                $this->result .= "Round is Tie" . PHP_EOL . PHP_EOL;

                continue;
            }

            $roundWinner->addScore();

            $this->result .= "Round is for {$roundWinner->getName()}." . PHP_EOL . PHP_EOL;
        }
    }

    /**
     * @return Player
     */
    public function fight()
    {
        if (!$this->playerOneHand()) {
            // or set by on random
            throw new \InvalidArgumentException("Hand of player {$this->playerOneName()} must be set.");
        } else {
            $playerOneHandIndex = array_search($this->playerOneHand(), $this->hands);

            if (!$playerOneHandIndex) {
                throw new \InvalidArgumentException("Hand of player {$this->playerOneName()} is not valid.");
            }
        }

        if (!$this->playerOneHand()) {
            // or set it by random
            throw new \InvalidArgumentException("Hand of player {$this->playerOneName()} must be set.");
        } else {
            $playerTwoHandIndex = array_search($this->playerTwoHand(), $this->hands);

            if (!$playerTwoHandIndex) {
                throw new \InvalidArgumentException("Hand of player {$this->playerTwoName()} is not valid.");
            }
        }

        $winner = $this->getRoundWinner($this->playerOne, $this->playerTwo);
        if ($winner) {
            $winner->addScore();
        }

        return $winner;
    }

    /**
     * @param Player $playerOne
     * @param Player $playerTwo
     * @return Player
     */
    private function getRoundWinner(Player $playerOne, Player $playerTwo)
    {
        $handIndexPlayerOne = array_search($playerOne->getHand(), $this->hands);
        $handIndexPlayerTwo = array_search($playerTwo->getHand(), $this->hands);

        if ($handIndexPlayerOne === $handIndexPlayerTwo) {
            return null;
        }

        $isHandsEvenOrOdd = (bool)($handIndexPlayerOne % 2) === (bool)($handIndexPlayerTwo % 2);
        $roundWinner = null;

        if ($isHandsEvenOrOdd) {
            if ($handIndexPlayerOne < $handIndexPlayerTwo) {
                $roundWinner = $playerOne;
            } else {
                $roundWinner = $playerTwo;
            }
        } else {
            if ($handIndexPlayerOne > $handIndexPlayerTwo) {
                $roundWinner = $playerOne;
            } else {
                $roundWinner = $playerTwo;
            }
        }

        return $roundWinner;
    }

    /**
     * @return Player
     */
    public function winner()
    {
        if ($this->playerOneScore() === $this->playerTwoScore()) {
            return null;
        }

        if ($this->playerOneScore() > $this->playerTwoScore()) {
            return $this->playerOne;
        }

        return $this->playerTwo;
    }

    public function printResult()
    {
        $str = "{$this->playerOneName()}'s Score: {$this->playerOneScore()}" . PHP_EOL .
            "{$this->playerTwoName()}'s Score: {$this->playerTwoScore()}" . PHP_EOL .
            'Game is for: ';

        $winner = $this->winner();
        if ($winner) {
            $str .= $winner->getName();
        } else {
            $str .= 'No winner';
        }

        echo $this->result . $str . PHP_EOL;
    }
}