<?php

namespace spec\Inelo;

use Inelo\Game;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Game::class);
    }

    public function it_should_return_score_0_for_gutter_game()
    {
        $this->rollMany(20, 0);

        $this->score()->shouldBe(0);
    }

    public function it_should_return_score_20_for_all_rolls_one()
    {
        $this->rollMany(20, 1);

        $this->score()->shouldBe(20);
    }

    public function it_should_add_next_role_value_to_spare_roll_result()
    {
        $this->rollSpare();
        $this->roll(5);
        $this->rollMany(17, 0);

        $this->score()->shouldBe(20);
    }

    public function it_should_add_next_two_roles_value_to_strike_roll_result()
    {
        $this->rollStrike();
        $this->roll(5);
        $this->roll(3);
        $this->rollMany(16, 0);

        $this->score()->shouldBe(26);
    }

    private function rollMany($cnt, $pin): void
    {
        for ($i = 0; $i < $cnt; ++$i) {
            $this->roll($pin);
        }
    }

    private function rollSpare(): void
    {
        $this->roll(4);
        $this->roll(6);
    }

    private function rollStrike(): void
    {
        $this->roll(10);
    }
}
