<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 24.11.18
 * Time: 21:33
 */

namespace PokerProbabilities\Checker;

use PokerProbabilities\Card;
use PokerProbabilities\Checkable\FiveCardsInterface;
use PokerProbabilities\PokerCombination;
use PokerProbabilities\Printer;

class KickerChecker implements FiveCardsCheckerInterface
{
    /**
     * @var FiveCardsInterface
     */
    protected $fiveCards;

    public function getName(): string
    {
        return PokerCombination::KICKER;
    }

    /**
     * OnePairChecker constructor.
     * @param FiveCardsInterface $fiveCards
     */
    public function __construct(FiveCardsInterface $fiveCards)
    {
        $this->fiveCards = $fiveCards;
    }

    public function getFiveCards(): FiveCardsInterface
    {
        return $this->fiveCards;
    }

    public function check(): bool
    {
        return true;
    }

    public function printResult(): string
    {
        if (!$this->check()) {
            return '';
        }

        $sortedCards = $this->fiveCards->getCards();

        usort(
            $sortedCards,
            function (Card $firstCard, Card $secondCard) {
                return $firstCard->getRank() <=> $secondCard->getRank();
            }
        );

        return 'Kicker: ' . Printer::printCard($sortedCards[count($sortedCards) - 1]);
    }

    public function boldCards(): void
    {
        foreach ($this->fiveCards->getCards() as $card) {
            $card->setBolded(false);
        }
    }

    public function getWeight(): int
    {
        return 0;
    }
}