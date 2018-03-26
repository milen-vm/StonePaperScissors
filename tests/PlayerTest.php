<?php
use PHPUnit\Framework\TestCase;
use App\Player;

class PlayerTest extends TestCase
{

    /**
     * @var Player
     */
    private $player;

    public function setUp()
    {
        $this->player = new Player('Linus');
    }

    public function testCanInstantiatePlayer()
    {
        $this->assertInstanceOf(Player::class, $this->player);
        $this->assertEquals('Linus', $this->player->getName());
    }

    public function testIsCorrectOneScoreAddingToThePlayersResult()
    {
        $this->player->addScore();

        $this->assertEquals(1, $this->player->getScore());
    }

    public function testCanAddMoreThatOneScoresToThePlayersResult()
    {
        $this->player->addScore();
        $this->player->addScore(2);

        $this->assertEquals(3, $this->player->getScore());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionIfTryToSetInvalidScores()
    {
        $this->player->addScore(2.45);
    }
}