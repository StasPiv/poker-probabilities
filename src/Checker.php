<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 12.11.18
 * Time: 14:07
 */

namespace PokerProbabilities;


class Checker
{
    /**
     * @param Card[]|array $cards
     * @return bool
     */
    private static $ranks = [
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

    public static function checkSuit(array $cards)
    {
        $suits = [
            CardSuit::HEART => 0,
            CardSuit::DIAMOND => 0,
            CardSuit::CLUB => 0,
            CardSuit::SPADE => 0,
        ];

        foreach ($cards as $card) {
            $suits[$card->getSuit()]++;
        }

        return !empty(
            array_filter(
                $suits,
                function (int $number) {
                    return $number > 1;
                }
            )
        );
    }

    /**
     * @param Card[]|array $cards
     * @return bool
     */
    public static function checkPair(array $cards)
    {
        $ranks = self::$ranks;

        foreach ($cards as $card) {
            $ranks[$card->getRank()]++;
        }

        return !empty(
            array_filter(
                $ranks,
                function (int $number) {
                    return $number > 1;
                }
            )
        );
    }

    /**
     * @param Card[]|array $cards
     * @return bool
     */
    public static function checkPairAces(array $cards)
    {
        $ranks = [
            CardRank::ACE => 0,
        ];

        foreach ($cards as $card) {
            if (!in_array($card->getRank(), array_keys($ranks))) {
                continue;
            }
            $ranks[$card->getRank()]++;
        }

        return !empty(
            array_filter(
                $ranks,
                function (int $number) {
                    return $number > 1;
                }
            )
        );
    }

    /**
     * @param Card[]|array $cards
     * @return bool
     */
    public static function checkAceKing(array $cards)
    {
        $ranks = [
            CardRank::KING => 0,
            CardRank::ACE => 0,
        ];

        $desiredRanks = [
            CardRank::KING => '=1',
            CardRank::ACE => '=1',
        ];

        foreach ($cards as $card) {
            if (!in_array($card->getRank(), array_keys($ranks))) {
                return false;
            }
            $ranks[$card->getRank()]++;
        }

        return !empty(
            array_filter(
                $ranks,
                function (int $number, int $key) use ($desiredRanks) {
                    if (!isset($desiredRanks)) {
                        return false;
                    }

                    return $desiredRanks[$key] === $number;
                },
                ARRAY_FILTER_USE_BOTH
            )
        );
    }
}