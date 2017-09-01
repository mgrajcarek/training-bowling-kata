<?php

namespace tests\Inelo;

use Inelo\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase {

    /**
     * @var Game
     */
    private $game;

    public function setup()
    {
        $this->game = new Game();
    }

    /**
     * @test
     */
    public function it_should_return_score_0_for_gutter_game()
    {
        $this->rollMany(20, 0);

        $score = $this->game->score();
        $this->assertEquals(0, $score);
    }

    /**
     * @param $cnt
     * @param $pin
     */
    private function rollMany($cnt, $pin): void
    {
        for ($i = 0; $i < $cnt; ++$i) {
            $this->game->roll($pin);
        }
    }

}