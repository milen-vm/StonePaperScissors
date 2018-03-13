<?php
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{

    private $game;

    protected function setUp() {
        $this->game = new \Core\Game();
    }

    public function testCanBeCreatedNewGame()
    {
        $this->assertInstanceOf(
            \Core\Game::class,
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

        $scoreSum = $this->game->getPlayerOneScore();
        $scoreSum += $this->game->getPlayerTwoScore();

        $this->assertEquals($this->game->getRoundsCount(), $scoreSum);
    }
}