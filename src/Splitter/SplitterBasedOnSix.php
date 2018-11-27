<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 26.11.18
 * Time: 16:41
 */

namespace PokerProbabilities\Splitter;


use Math\Combinatorics\Combination;
use PokerProbabilities\Checkable\FiveCards;
use PokerProbabilities\Checkable\SixCardsInterface;

class SplitterBasedOnSix implements SplitterInterface
{
    /**
     * @var SixCardsInterface
     */
    protected $sixCards;

    /**
     * SplitterBasedOnSix constructor.
     * @param $sixCards
     */
    public function __construct($sixCards)
    {
        $this->sixCards = $sixCards;
    }

    public function getAllFiveCards(): array
    {
        return array_map(
            function (array $cards) {
                return new FiveCards($cards);
            },
            Combination::get($this->sixCards->getCards(), 5)
        );
    }
}