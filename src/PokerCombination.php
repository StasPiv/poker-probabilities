<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 27.11.18
 * Time: 1:00
 */

namespace PokerProbabilities;


class PokerCombination
{
    const KICKER = 'kicker';
    const PAIR = 'pair';
    const TWO_PAIRS = 'two pairs';
    const TRIPS = 'trips';
    const STREET = 'street';
    const FLASH = 'flash';
    const FULL_HOUSE = 'full house';
    const KARE = 'kare';
    const STREET_FLASH = 'street flash';

    static public function getAll(): array
    {
        $oClass = new \ReflectionClass(__CLASS__);
        return array_reverse($oClass->getConstants());
    }
}