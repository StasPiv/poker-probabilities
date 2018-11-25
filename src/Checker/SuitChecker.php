<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 13.11.18
 * Time: 15:08
 */

namespace PokerProbabilities\Checker;


use PokerProbabilities\Card;
use PokerProbabilities\Checkable\CheckableInterface;

class SuitChecker implements PairCheckerInterface
{
    public function check(CheckableInterface $checkable)
    {
        $suits = array_map(
            function (Card $card) {
                return $card->getSuit();
            },
            $checkable->getCards()
        );

        sort($suits);

        return $suits[0] === $suits[count($suits) - 1];
    }

}