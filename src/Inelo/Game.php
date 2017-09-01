<?php

declare(strict_types=1);

namespace Inelo;

class Game
{

    private $frames = [];
    private $currentFrame = 0;

    public function roll($pin): void
    {
        $this->frames[$this->currentFrame][] = $pin;

        if (count($this->frames[$this->currentFrame]) === 2) {
            ++$this->currentFrame;
        }
    }

    public function score(): int
    {
        $score = 0;

        for ($i=0; $i < 10; ++$i) {

            $frameScore = array_sum($this->frames[$i]);
            $score += $frameScore;

            if ($this->isSpare($i, $frameScore)) {
                $score += $this->frames[$i + 1][0];
            }

            if (count($this->frames[$i]) === 1 && $frameScore === 10) {
                $score += $this->frames[$i + 1][0];
            }
        }

        return $score;
    }

    /**
     * @param $i
     * @param $frameScore
     * @return bool
     */
    private function isSpare($i, $frameScore): bool
    {
        return count($this->frames[$i]) === 2 && $frameScore === 10;
    }
}
