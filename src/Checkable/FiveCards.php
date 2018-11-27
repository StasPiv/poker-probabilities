<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 26.11.18
 * Time: 16:43
 */

namespace PokerProbabilities\Checkable;


use PokerProbabilities\Card;

class FiveCards implements FiveCardsInterface
{
    /**
     * @var int
     */
    protected $kickerWeight;

    /**
     * @var int
     */
    protected $baseWeight;

    /**
     * @var Card[]|array
     */
    protected $cards;

    /**
     * @var string
     */
    protected $result = '';

    /**
     * @var string
     */
    protected $combination = '';

    /**
     * FiveCards constructor.
     * @param array|Card[] $cards
     */
    public function __construct($cards)
    {
        $this->cards = $cards;
    }

    /**
     * @return array|Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @param array|Card[] $cards
     * @return FiveCards
     */
    public function setCards($cards)
    {
        $this->cards = $cards;

        return $this;
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
     * @return FiveCards
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
     * @return FiveCards
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
     * @return FiveCards
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
     * @return FiveCards
     */
    public function setCombination(string $combination): self
    {
        $this->combination = $combination;

        return $this;
    }

}