<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 24.11.18
 * Time: 21:33
 */

namespace PokerProbabilities\Checker;

use PokerProbabilities\Card;
use PokerProbabilities\CardRank;
use PokerProbabilities\Checkable\FiveCardsInterface;
use PokerProbabilities\PokerCombination;

class StreetChecker implements FiveCardsCheckerInterface
{
    /**
     * @var FiveCardsInterface
     */
    protected $fiveCards;

    protected $matched = false;

    protected $checked = false;

    protected $tripsWeights = [];

    protected $maxRank = 0;

    public function getName(): string
    {
        return PokerCombination::STREET;
    }

    /**
     * OnePairChecker constructor.
     * @param FiveCardsInterface $fiveCards
     */
    public function __construct(FiveCardsInterface $fiveCards)
    {
        $this->fiveCards = $fiveCards;
    }

    /**
     * @return bool
     */
    public function isMatched(): bool
    {
        return $this->matched;
    }

    public function getFiveCards(): FiveCardsInterface
    {
        return $this->fiveCards;
    }

    public function check(): bool
    {
        if ($this->checked) {
            return $this->matched;
        }

        $sortedCards = $this->fiveCards->getCards();

        usort(
            $sortedCards,
            function (Card $firstCard, Card $secondCard) {
                return $firstCard->getRank() <=> $secondCard->getRank();
            }
        );

        $minRank = $sortedCards[0]->getRank();

        $ranks = [];

        foreach ($sortedCards as $card) {
            $ranks[] = $card->getRank() - $minRank;
        }

        $matched = $ranks == [0, 1, 2, 3, 4];

        if ($matched) {
            $this->matched = true;
            $this->maxRank = $sortedCards[count($sortedCards) - 1]->getRank();
            return true;
        }

        $matched = $ranks == [0, 1, 2, 3, 12];

        if ($matched) {
            $this->matched = true;
            $this->maxRank = CardRank::FIVE;
            return true;
        }

        return false;
    }

    public function printResult(): string
    {
        if (!$this->check()) {
            return '';
        }

        return $this->check() ? 'This is street' : '';
    }

    public function boldCards(): void
    {
        if (!$this->check()) {
            return;
        }

        foreach ($this->fiveCards->getCards() as $card) {
            $card->setBolded(true);
        }

        $sortedCards = $this->fiveCards->getCards();

        usort(
            $sortedCards,
            function (Card $firstCard, Card $secondCard) {
                return $firstCard->getRank() <=> $secondCard->getRank();
            }
        );

        $this->fiveCards->setCards($sortedCards);
    }

    public function getWeight(): int
    {
        if ($this->check()) {
            return pow(10, 5) + $this->maxRank;
        }

        return 0;
    }
}