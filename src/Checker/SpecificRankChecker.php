<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 13.11.18
 * Time: 12:36
 */

namespace PokerProbabilities\Checker;


use PokerProbabilities\CardRank;

class SpecificRankChecker extends RankChecker
{
    protected $desiredRank;

    /**
     * SpecificPairChecker constructor.
     * @param $desiredRank
     */
    public function __construct($desiredRank)
    {
        if (!in_array($desiredRank, CardRank::getAll())) {
            throw new \RuntimeException('Card rank should be valid. Use constants of class CardRank');
        }

        $this->desiredRank = $desiredRank;
    }

    protected function checkCount(int $count, int $rank)
    {
        if ($rank !== $this->desiredRank) {
            return false;
        }

        return parent::checkCount($count, $rank);
    }
}