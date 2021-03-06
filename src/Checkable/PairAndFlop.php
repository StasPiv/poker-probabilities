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
     * @var int
     */
    protected $kickerWeight;

    /**
     * @var int
     */
    protected $baseWeight;

    /**
     * @var string
     */
    protected $result = '';

    /**
     * @var string
     */
    protected $combination = '';

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

    /**
     * @return int
     */
    public function getKickerWeight(): int
    {
        return $this->kickerWeight;
    }

    /**
     * @param int $kickerWeight
     * @return PairAndFlop
     */
    public function setKickerWeight(int $kickerWeight): self
    {
        $this->kickerWeight = $kickerWeight;

        return $this;
    }

    /**
     * @return int
     */
    public function getBaseWeight(): int
    {
        return $this->baseWeight;
    }

    /**
     * @param int $baseWeight
     * @return PairAndFlop
     */
    public function setBaseWeight(int $baseWeight): self
    {
        $this->baseWeight = $baseWeight;

        return $this;
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }

    /**
     * @param string $result
     * @return PairAndFlop
     */
    public function setResult(string $result): self
    {
        $this->result = $result;

        return $this;
    }

    /**
     * @return string
     */
    public function getCombination(): string
    {
        return $this->combination;
    }

    /**
     * @param string $combination
     * @return PairAndFlop
     */
    public function setCombination(string $combination): self
    {
        $this->combination = $combination;

        return $this;
    }
}