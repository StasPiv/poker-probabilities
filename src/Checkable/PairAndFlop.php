<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 24.11.18
 * Time: 21:13
 */

namespace PokerProbabilities\Checkable;


use PokerProbabilities\Card;

class PairAndFlop implements FiveCardsInterface
{
    /**
     * @var Card[]|array
     */
    protected $cards;

    /**
     * @param array|Card[] $cards
     * @return PairAndFlop
     */
    public function setCards($cards)
    {
        $this->cards = $cards;

        return $this;
    }

    /**
     * PairAndFlop constructor.
     * @param Pair $pair
     * @param Flop $flop
     */
    public function __construct(Pair $pair, Flop $flop)
    {
        $this->cards = array_merge($pair->getCards(), $flop->getCards());
    }


    /**
     * @return array|Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }
}