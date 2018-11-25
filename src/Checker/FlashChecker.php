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
use PokerProbabilities\Printer;

class FlashChecker implements FiveCardsCheckerInterface
{
    /**
     * @var FiveCardsInterface
     */
    protected $fiveCards;

    protected $matched = false;

    protected $checked = false;

    protected $tripsWeights = [];

    protected $ranksSum = 0;

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
                return $firstCard->getSuit() <=> $secondCard->getSuit();
            }
        );

        $matched = $sortedCards[0]->getSuit() === $sortedCards[count($sortedCards) - 1]->getSuit();

        if ($matched) {
            $sortedByRankCards = $this->fiveCards->getCards();

            usort(
                $sortedByRankCards,
                function (Card $firstCard, Card $secondCard) {
                    return $firstCard->getRank() <=> $secondCard->getRank();
                }
            );

            $weightRank = 0;
            $sum =


            $this->ranksSum = array_sum(
                array_map(
                        function (Card $card) use ($weightRank) {
                            return pow(2, $card->getRank() - 2);
                        },
                        $sortedByRankCards
                )
            );
        }

        return $this->matched = $matched;
    }

    public function printResult(): string
    {
        if (!$this->check()) {
            return '';
        }

        return $this->check() ? 'This is flash' : '';
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
            return pow(10, 6) + $this->ranksSum;
        }

        return 0;
    }
}