<?php
use PHPUnit\Framework\TestCase;
use App\Player;

class PlayerTest extends TestCase
{

    public function testCanInstantiatePlayer()
    {
        $player = new Player('Linus');

        $this->assertInstanceOf(Player::class, $player);
        $this->assertEquals('Linus', $player->getName());
    }

    public function testIsCorrectOneScoreAddingToThePlayersResult()
    {
        $player = new Player('Linus');

        $player->addScore();

        $this->assertEquals(1, $player->getScore());
    }

    public function testCanAddMoreThatOneScoresToThePlayersResult()
    {
        $player = new Player('Linus');

        $player->addScore();
        $player->addScore(2);

        $this->assertEquals(3, $player->getScore());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionIfTryToSetInvalidScoresToPlayersResult()
    {
        $player = new Player('Linus');

        $player->addScore(2.45);
    }
}