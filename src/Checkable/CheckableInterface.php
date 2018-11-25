<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 13.11.18
 * Time: 12:17
 */

namespace PokerProbabilities\Checkable;

use PokerProbabilities\Card;

interface CheckableInterface
{
    /**
     * @return Card[]|array
     */
    public function getCards(): array;

    /**
     * @param array $cards
     * @return mixed
     */
    public function setCards(array $cards);
}