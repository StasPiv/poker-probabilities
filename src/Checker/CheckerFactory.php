<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 25.11.18
 * Time: 0:32
 */

namespace PokerProbabilities\Checker;


use PokerProbabilities\Checkable\FiveCardsInterface;
use PokerProbabilities\PokerCombination;

class CheckerFactory
{
    public static function createCheckerForFiveCards(string $type, FiveCardsInterface $fiveCards) {
        switch ($type) {
            case PokerCombination::KICKER:
                return new KickerChecker($fiveCards);
            case PokerCombination::PAIR:
                return new OnePairChecker($fiveCards);
            case PokerCombination::TWO_PAIRS:
                return new TwoPairChecker($fiveCards);
            case PokerCombination::TRIPS:
                return new TripsChecker($fiveCards);
            case PokerCombination::STREET:
                return new StreetChecker($fiveCards);
            case PokerCombination::FLASH:
                return new FlashChecker($fiveCards);
            case PokerCombination::FULL_HOUSE:
                return new FullHouseChecker($fiveCards);
            case PokerCombination::KARE:
                return new KareChecker($fiveCards);
            case PokerCombination::STREET_FLASH:
                return new StreetFlashChecker($fiveCards);
            default:
                throw new \RuntimeException('Unknown checker type: ' . $type);
        }
    }
}