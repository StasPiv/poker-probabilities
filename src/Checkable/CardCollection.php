<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 26.11.18
 * Time: 15:56
 */

namespace PokerProbabilities\Checkable;


use PokerProbabilities\Card;

class CardCollection implements CheckableInterface
{
    /**
     * @var Card[]
     */
    protected $cards;

    /**
     * CardCollection constructor.
     * @param Card[] $cards
     */
    public function __construct(array $cards)
    {
        $this->cards = $cards;
    }

    /**
     * @return Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @param Card[] $cards
     * @return CardCollection
     */
    public function setCards(array $cards): self
    {
        $this->cards = $cards;

        return $this;
    }
}