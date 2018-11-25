<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 12.11.18
 * Time: 14:18
 */

namespace PokerProbabilities;


use PokerProbabilities\Checkable\Flop;
use PokerProbabilities\Checkable\Pair;
use PokerProbabilities\Checkable\River;
use PokerProbabilities\Checkable\Turn;

class Generator
{
    public static function generateRandomPair()
    {
        $deck = new CardDeck();
        return new Pair([
            $deck->getRandomCard(),
            $deck->getRandomCard()
        ]);
    }

    public static function generateRandomPairForDeck(CardDeck $deck)
    {
        return new Pair([
            $deck->getRandomCard(),
            $deck->getRandomCard()
        ]);
    }

    public static function generateRandomFlopForDeck(CardDeck $deck)
    {
        return new Flop([
            $deck->getRandomCard(),
            $deck->getRandomCard(),
            $deck->getRandomCard()
        ]);
    }

    public static function generateRandomTurnForDeck(CardDeck $deck)
    {
        return new Turn($deck->getRandomCard());
    }

    public static function generateRandomRiverForDeck(CardDeck $deck)
    {
        return new River($deck->getRandomCard());
    }
}