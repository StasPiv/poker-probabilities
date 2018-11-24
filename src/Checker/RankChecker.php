<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 13.11.18
 * Time: 12:26
 */

namespace PokerProbabilities\Checker;

use PokerProbabilities\CardRank;
use PokerProbabilities\Checkable\CheckableInterface;

class RankChecker implements CheckerInterface
{
    public function check(CheckableInterface $checkable)
    {
        return $this->checkCounts(
            $this->countRanks($checkable)
        );
    }

    /**
     * This function returns true if rank compare is passed
     *
     * @param int $count
     * @param int $rank
     * @return bool
     */
    protected function checkCount(int $count, int $rank)
    {
        return $count === 2;
    }

    /**
     * @param CheckableInterface $checkable
     * @return array
     */
    protected function countRanks(CheckableInterface $checkable): array
    {
        $ranks = [
            CardRank::TWO => 0,
            CardRank::THREE => 0,
            CardRank::FOUR => 0,
            CardRank::FIVE => 0,
            CardRank::SIX => 0,
            CardRank::SEVEN => 0,
            CardRank::EIGHT => 0,
            CardRank::NINE => 0,
            CardRank::TEN => 0,
            CardRank::JACK => 0,
            CardRank::QUEEN => 0,
            CardRank::KING => 0,
            CardRank::ACE => 0,
        ];

        foreach ($checkable->getCards() as $card) {
            $ranks[$card->getRank()]++;
        }

        return $ranks;
    }

    /**
     * @param $countRanks
     * @return bool
     */
    protected function checkCounts($countRanks): bool
    {
        return !empty(
            array_filter(
                $countRanks,
                [$this, 'checkCount'],
                ARRAY_FILTER_USE_BOTH
            )
        );
    }
}