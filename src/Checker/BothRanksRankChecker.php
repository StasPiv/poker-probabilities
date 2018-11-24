<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 13.11.18
 * Time: 14:56
 */

namespace PokerProbabilities\Checker;


use PokerProbabilities\CardRank;

class BothRanksRankChecker extends RankChecker
{
    /**
     * @var array
     */
    protected $desiredRanks;

    /**
     * SpecificPairChecker constructor.
     * @param $desiredRanks
     */
    public function __construct(array $desiredRanks)
    {
        foreach ($desiredRanks as $desiredRank) {
            if (!in_array($desiredRank, CardRank::getAll())) {
                throw new \RuntimeException('Card rank should be valid. Use constants of class CardRank');
            }
        }

        $this->desiredRanks = $desiredRanks;
    }

    protected function checkCounts($countRanks): bool
    {
        return $countRanks[$this->desiredRanks[0]] === 1 && $countRanks[$this->desiredRanks[1]] === 1;
    }
}