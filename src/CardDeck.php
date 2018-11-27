<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 12.11.18
 * Time: 12:27
 */

namespace PokerProbabilities;

use PokerProbabilities\Checkable\CheckableInterface;
use PokerProbabilities\Checkable\Flop;

class CardDeck implements CheckableInterface
{
    /**
     * @var Card[]|array
     */
    protected $cards = [];

    public function __construct()
    {
        $ranks = [
            CardRank::TWO,
            CardRank::THREE,
            CardRank::FOUR,
            CardRank::FIVE,
            CardRank::SIX,
            CardRank::SEVEN,
            CardRank::EIGHT,
            CardRank::NINE,
            CardRank::TEN,
            CardRank::JACK,
            CardRank::QUEEN,
            CardRank::KING,
            CardRank::ACE
        ];

        $suits = [
            CardSuit::HEART,
            CardSuit::DIAMOND,
            CardSuit::CLUB,
            CardSuit::SPADE
        ];

        foreach ($ranks as $rank) {
            foreach ($suits as $suit) {
                $this->cards[] = new Card($rank, $suit);
            }
        }
    }

    public function getCountCardsInDeck()
    {
        return count($this->cards);
    }

    /**
     * @return array
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    public function getRandomCard(): Card
    {
        $keys = array_keys(
            array_filter(
                $this->cards,
                function (Card $card) {
                    return !$card->isRemoved();
                }
            )
        );

        $index = $keys[mt_rand(0, count($keys) - 1)];
        $card = $this->cards[$index];
        $this->removeCardByIndex($index);

        return $card;
    }

    public function removeCardByIndex(int $index)
    {
        $this->cards[$index]->setRemoved(true);
    }

    public function restoreCardByIndex(int $index)
    {
        $this->cards[$index]->setRemoved(false);
    }

    public function restoreCardByString(string $cardString)
    {
        $this->restoreCard(CardFactory::createCard($cardString));
    }

    public function removeCardByString(string $cardString)
    {
        $this->removeCard(CardFactory::createCard($cardString));
    }

    public function removeCards(CheckableInterface $checkable)
    {
        foreach ($checkable->getCards() as $card) {
            $this->removeCard($card);
        }
    }

    public function restoreCards(CheckableInterface $checkable)
    {
        foreach ($checkable->getCards() as $card) {
            $this->restoreCard($card);
        }
    }

    public function removeCard(Card $neededCard)
    {
        $index = $this->findCardIndex($neededCard);

        $this->removeCardByIndex($index);
    }

    public function restoreCard(Card $neededCard)
    {
        $index = $this->findCardIndex($neededCard);

        $this->restoreCardByIndex($index);
    }

    /**
     * @param array|Card[] $cards
     * @return CardDeck
     */
    public function setCards($cards)
    {
        $this->cards = $cards;

        return $this;
    }

    /**
     * @param Card $neededCard
     * @return int|null|string
     */
    private function findCardIndex(Card $neededCard)
    {
        $filteredCards = array_filter(
            $this->cards,
            function (Card $card) use ($neededCard) {
                return $neededCard->isEqual($card);
            }
        );

        $index = key($filteredCards);

        return $index;
    }
}