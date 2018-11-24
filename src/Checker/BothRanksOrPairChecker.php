<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 13.11.18
 * Time: 15:04
 */

namespace PokerProbabilities\Checker;


class BothRanksOrPairChecker extends BothRanksRankChecker
{
    protected function checkCounts($countRanks): bool
    {
        $count = 0;

        foreach ($countRanks as $rank => $countRank) {
            if (!in_array($rank, $this->desiredRanks)) {
                continue;
            }

            $count += $countRank;
        }

        return $count === 2;
    }

}