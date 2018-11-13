<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 12.11.18
 * Time: 12:27
 */

namespace PokerProbabilities;


class CardDeck
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
        $keys = array_keys($this->cards);

        $index = $keys[mt_rand(0, count($keys) - 1)];
        $card = $this->cards[$index];
        $this->removeCardByIndex($index);

        return $card;
    }

    public function removeCardByIndex(int $index)
    {
        unset($this->cards[$index]);
    }

}