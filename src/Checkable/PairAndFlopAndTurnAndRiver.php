<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 24.11.18
 * Time: 21:13
 */

namespace PokerProbabilities\Checkable;


use PokerProbabilities\Card;

class PairAndFlopAndTurnAndRiver implements SevenCardsInterface
{
    /**
     * @var Card[]|array
     */
    protected $cards;

    /**
     * @param array|Card[] $cards
     * @return PairAndFlopAndTurnAndRiver
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
     * @param Turn $turn
     * @param River $river
     */
    public function __construct(Pair $pair, Flop $flop, Turn $turn, River $river)
    {
        $this->cards = array_merge($pair->getCards(), $flop->getCards(), $turn->getCards(), $river->getCards());
    }


    /**
     * @return array|Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }
}