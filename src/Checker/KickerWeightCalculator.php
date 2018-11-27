<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 24.11.18
 * Time: 21:33
 */

namespace PokerProbabilities\Checker;

use PokerProbabilities\Checkable\CardCollection;
use PokerProbabilities\Checkable\CheckableInterface;
use PokerProbabilities\Checkable\FiveCardsInterface;

class KickerWeightCalculator
{
    public static function calculateWeight(CheckableInterface $checkable)
    {
        $weight = 0;

        foreach ($checkable->getCards() as $card) {
            $weight += pow(2, $card->getRank());
        }

        return $weight;
    }

    public static function initKickerWeight(FiveCardsInterface $fiveCards): void
    {
        $cards = [];

        foreach ($fiveCards->getCards() as $card) {
            if (!$card->isBolded()) {
                $cards[] = $card;
            }
        }

        $fiveCards->setKickerWeight(self::calculateWeight(new CardCollection($cards)));
    }
}