<?php
use PHPUnit\Framework\TestCase;
use App\Game;
use App\Player;

final class GameTest extends TestCase
{

    private $game;

    protected function setUp() {
        $playerOne = new Player('One');
        $playerTwo = new Player('Two');
        $this->game = new Game($playerOne, $playerTwo);
    }

    public function testCanBeCreatedNewGame()
    {
        $this->assertInstanceOf(
            Game::class,
            $this->game
        );
    }

    public function testIsSetRoundsCountCorrectly()
    {
        $this->game->playRounds(3);

        $this->assertEquals(3, $this->game->getRoundsCount());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionIfTryToSetInvalidRoundsCount()
    {
        $this->game->playRounds(3.5);
    }

    public function testIsRoundsCountEqualToSumOfPlayersScore()
    {
        $this->game->playRounds(6);
        $this->game->play();

        $scoreSum = $this->game->playerOneScore();
        $scoreSum += $this->game->playerTwoScore();

        $this->assertEquals($this->game->getRoundsCount(), $scoreSum);
    }
}