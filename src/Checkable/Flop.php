<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 24.11.18
 * Time: 21:02
 */

namespace PokerProbabilities\Checkable;

use PokerProbabilities\Card;

class Flop implements CheckableInterface
{
    /**
     * @var Card[]|array
     */
    protected $cards;

    /**
     * @param array|Card[] $cards
     * @return Flop
     */
    public function setCards($cards)
    {
        $this->cards = $cards;

        return $this;
    }

    /**
     * RandomPair constructor.
     * @param array|Card[] $cards
     */
    public function __construct($cards)
    {
        if (count($cards) !== 3) {
            throw new \RuntimeException('Flop should contain three cards');
        }

        foreach ($cards as $card) {
            if (!$card instanceof Card) {
                throw new \RuntimeException('Each card in flop should be instance of Card');
            }
        }

        $this->cards = $cards;
    }

    /**
     * @return array|Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }
}