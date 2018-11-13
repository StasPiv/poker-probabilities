<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 12.11.18
 * Time: 12:21
 */

namespace PokerProbabilities;


class Card
{
    /**
     * one of CardRank constants
     *
     * @var int
     */
    protected $rank;

    /**
     * one of CardSuit constants
     *
     * @var int
     */
    protected $suit;

    /**
     * Card constructor.
     * @param $rank
     * @param $suit
     */
    public function __construct($rank, $suit)
    {
        $this->rank = $rank;
        $this->suit = $suit;
    }

    /**
     * @return int
     */
    public function getRank(): int
    {
        return $this->rank;
    }

    /**
     * @return int
     */
    public function getSuit(): int
    {
        return $this->suit;
    }

    public function isEqual(Card $card)
    {
        return $card->getSuit() === $this->getSuit() && $card->getRank() === $this->getRank();
    }
}