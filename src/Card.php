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
     * @var bool
     */
    protected $bolded = false;

    /**
     * @var bool
     */
    protected $removed = false;

    /**
     * Card constructor.
     * @param int $rank
     * @param int $suit
     * @param bool $bolded
     */
    public function __construct(int $rank, int $suit, bool $bolded = false)
    {
        $this->rank = $rank;
        $this->suit = $suit;
        $this->bolded = $bolded;
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

    /**
     * @return bool
     */
    public function isBolded(): bool
    {
        return $this->bolded;
    }

    /**
     * @param bool $bolded
     * @return Card
     */
    public function setBolded(bool $bolded): self
    {
        $this->bolded = $bolded;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRemoved(): bool
    {
        return $this->removed;
    }

    /**
     * @param bool $removed
     * @return Card
     */
    public function setRemoved(bool $removed): self
    {
        $this->removed = $removed;

        return $this;
    }
}