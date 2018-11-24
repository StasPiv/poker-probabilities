<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 13.11.18
 * Time: 12:18
 */

namespace PokerProbabilities\Checkable;

use PokerProbabilities\Card;

class RandomPair implements CheckableInterface
{
    /**
     * @var Card[]|array
     */
    protected $cards;

    /**
     * RandomPair constructor.
     * @param array|Card[] $cards
     */
    public function __construct($cards)
    {
        if (count($cards) !== 2) {
            throw new \RuntimeException('Random pair should contain two cards');
        }

        foreach ($cards as $card) {
            if (!$card instanceof Card) {
                throw new \RuntimeException('Each card in random pair should be instance of Card');
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