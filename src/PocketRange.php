<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 27.11.18
 * Time: 1:47
 */

namespace PokerProbabilities;


use Math\Combinatorics\Combination;

class PocketRange
{
    public static function getPairs()
    {
        $pairs = [];

        foreach (CardRank::getAll() as $rank) {
            switch ($rank) {
                case CardRank::ACE:
                    $rank = 'A';
                    break;
                case CardRank::KING:
                    $rank = 'K';
                    break;
                case CardRank::QUEEN:
                    $rank = 'Q';
                    break;
                case CardRank::JACK:
                    $rank = 'J';
                    break;
            }
            $pairs+=Combination::get([$rank.'h',$rank.'d',$rank.'c',$rank.'s'], 2);
        }

        return array_map(
            function (array $pair) {
                return implode(';', $pair);
            },
            $pairs
        );
    }

    public static function getAcesOrKings()
    {
        $pairs = [];

        foreach ([CardRank::ACE, CardRank::KING] as $rank) {
            $pairs+=Combination::get([$rank.'h',$rank.'d',$rank.'c',$rank.'s'], 2);
        }

        return array_map(
            function (array $pair) {
                return implode(';', $pair);
            },
            $pairs
        );
    }

    public static function getTopPairs()
    {
        $pairs = [];

        foreach ([
            'A',
            'K',
            'Q',
            'J',
            CardRank::TEN,
            CardRank::NINE,
            CardRank::EIGHT,
            CardRank::SEVEN,
            CardRank::SIX,
            CardRank::FIVE,
            CardRank::FOUR,
            CardRank::THREE,
            CardRank::TWO
        ] as $rank) {
            $pairs= array_merge($pairs, Combination::get([$rank.'h',$rank.'d',$rank.'c',$rank.'s'], 2));
        }

        return array_map(
            function (array $pair) {
                return implode(';', $pair);
            },
            $pairs
        );
    }
}