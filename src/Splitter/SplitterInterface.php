<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 26.11.18
 * Time: 16:40
 */

namespace PokerProbabilities\Splitter;


use PokerProbabilities\Checkable\FiveCardsInterface;

interface SplitterInterface
{
    /**
     * @return FiveCardsInterface[]|array
     */
    public function getAllFiveCards(): array ;
}