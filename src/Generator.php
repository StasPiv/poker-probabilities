<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 12.11.18
 * Time: 14:18
 */

namespace PokerProbabilities;


use PokerProbabilities\Checkable\RandomPair;

class Generator
{
    public static function generateRandomPair()
    {
        $deck = new CardDeck();
        return new RandomPair([
            $deck->getRandomCard(),
            $deck->getRandomCard()
        ]);
    }
}