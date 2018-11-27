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
use PokerProbabilities\Checkable\SevenCardsInterface;
use PokerProbabilities\Checkable\SixCardsInterface;

class SplitterBasedOnSeven implements SplitterInterface
{
    /**
     * @var SevenCardsInterface
     */
    protected $sevenCards;

    /**
     * SplitterBasedOnSeven constructor.
     * @param $sevenCards
     */
    public function __construct(SevenCardsInterface $sevenCards)
    {
        $this->sevenCards = $sevenCards;

    }

    public function getAllFiveCards(): array
    {
        return array_map(
            function (array $cards) {
                return new FiveCards($cards);
            },
            Combination::get($this->sevenCards->getCards(), 5)
        );
    }
}