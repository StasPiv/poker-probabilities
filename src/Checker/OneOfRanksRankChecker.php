<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 13.11.18
 * Time: 14:45
 */

namespace PokerProbabilities\Checker;


use PokerProbabilities\CardRank;

class OneOfRanksRankChecker extends RankChecker
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

    protected function checkCount(int $count, int $rank)
    {
        if (!in_array($rank, $this->desiredRanks)) {
            return false;
        }

        return $count > 0;
    }

}