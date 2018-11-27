<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 26.11.18
 * Time: 16:28
 */

namespace PokerProbabilities\Checker;

use PokerProbabilities\Checkable\FiveCardsInterface;
use PokerProbabilities\Checkable\SevenCardsInterface;
use PokerProbabilities\Checkable\SixCardsInterface;
use PokerProbabilities\PokerCombination;
use PokerProbabilities\Printer;
use PokerProbabilities\Splitter\SplitterBasedOnSeven;
use PokerProbabilities\Splitter\SplitterBasedOnSix;

class FullChecker
{
    public static function checkHandFrom5Cards(FiveCardsInterface $fiveCards, bool $silent = false): FiveCardsInterface
    {
        foreach (PokerCombination::getAll() as $checkerType) {
            $myChecker = CheckerFactory::createCheckerForFiveCards($checkerType, $fiveCards);

            $myChecker->boldCards();

            if ($myChecker->check()) {
                $fiveCards->setBaseWeight($myChecker->getWeight());
                KickerWeightCalculator::initKickerWeight($fiveCards);
                $fiveCards->setResult($myChecker->printResult());
                $fiveCards->setCombination($myChecker->getName());

                if (!$silent) {
                    echo '-----------------'.PHP_EOL.strtoupper($checkerType).PHP_EOL.'-----------------'.PHP_EOL;
                    echo 'My hand after flop (bolded): '.Printer::printCheckable($fiveCards).PHP_EOL;
                    echo $myChecker->printResult().PHP_EOL;
                    echo 'Weight: '.$fiveCards->getBaseWeight().PHP_EOL;
                    echo 'Kicker weight: '.$fiveCards->getKickerWeight().PHP_EOL;
                }

                return $fiveCards;
            }
        }

        return $fiveCards;
    }

    public static function checkHandFrom6Cards(SixCardsInterface $sixCards, bool $silent = false)
    {
        $basedOnSix = new SplitterBasedOnSix($sixCards);
        $bestCombination = FullChecker::findBestCombination($basedOnSix->getAllFiveCards());
        return self::checkHandFrom5Cards($bestCombination, $silent);
    }

    public static function checkHandFrom7Cards(SevenCardsInterface $sevenCards, bool $silent = false)
    {
        $basedOnSeven = new SplitterBasedOnSeven($sevenCards);
        $bestCombination = FullChecker::findBestCombination($basedOnSeven->getAllFiveCards());
        return self::checkHandFrom5Cards($bestCombination, $silent);
    }

    /**
     * @param FiveCardsInterface[]|array $allFiveCards
     * @return FiveCardsInterface
     */
    private static function findBestCombination(array $allFiveCards): FiveCardsInterface
    {
        $maxBaseWeight = 0;
        $maxKickerWeight = 0;
        $bestCombination = $allFiveCards[0];

        foreach ($allFiveCards as $fiveCards) {
            self::checkHandFrom5Cards($fiveCards, true);
            if ($fiveCards->getBaseWeight() > $maxBaseWeight) {
                $maxBaseWeight = $fiveCards->getBaseWeight();
                $maxKickerWeight = $fiveCards->getKickerWeight();
                $bestCombination = $fiveCards;
            } elseif ($fiveCards->getBaseWeight() === $maxBaseWeight) {
                if ($fiveCards->getKickerWeight() > $maxKickerWeight) {
                    $maxKickerWeight = $fiveCards->getKickerWeight();
                    $bestCombination = $fiveCards;
                }
            }
        }

        return $bestCombination;
    }
}