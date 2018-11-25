<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 25.11.18
 * Time: 0:32
 */

namespace PokerProbabilities\Checker;


use PokerProbabilities\Checkable\FiveCardsInterface;

class CheckerFactory
{
    public static function createCheckerForFiveCards(string $type, FiveCardsInterface $fiveCards) {
        switch ($type) {
            case 'pair':
                return new OnePairChecker($fiveCards);
            case 'two pairs':
                return new TwoPairChecker($fiveCards);
            case 'trips':
                return new TripsChecker($fiveCards);
            case 'street':
                return new StreetChecker($fiveCards);
            case 'flash':
                return new FlashChecker($fiveCards);
            case 'full house':
                return new FullHouseChecker($fiveCards);
            case 'kare':
                return new KareChecker($fiveCards);
            case 'street flash':
                return new StreetFlashChecker($fiveCards);
            default:
                throw new \RuntimeException('Unknown checker type: ' . $type);
        }
    }
}