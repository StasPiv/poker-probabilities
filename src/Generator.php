<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 12.11.18
 * Time: 14:18
 */

namespace PokerProbabilities;


class Generator
{
    public static function generateRandomPair()
    {
        $deck = new CardDeck();
        return [
            $deck->getRandomCard(),
            $deck->getRandomCard()
        ];
    }
}