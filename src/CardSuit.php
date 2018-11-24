<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 12.11.18
 * Time: 12:24
 */

namespace PokerProbabilities;


class CardSuit
{
    const HEART = 0;

    const DIAMOND = 1;

    const CLUB = 2;

    const SPADE = 3;

    static public function getAll(): array
    {
        $oClass = new \ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }
}