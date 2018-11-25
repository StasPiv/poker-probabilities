<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 24.11.18
 * Time: 21:02
 */

namespace PokerProbabilities\Checkable;

use PokerProbabilities\Card;

class River implements CheckableInterface
{
    /**
     * @var Card[]|array
     */
    protected $cards;

    /**
     * @param array|Card[] $cards
     * @return River
     */
    public function setCards($cards)
    {
        $this->cards = $cards;

        return $this;
    }

    /**
     * RandomPair constructor.
     * @param Card $card
     */
    public function __construct(Card $card)
    {
        $this->cards = [$card];
    }

    /**
     * @return array|Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }
}