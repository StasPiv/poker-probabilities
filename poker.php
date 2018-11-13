<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 12.11.18
 * Time: 12:14
 */

use PokerProbabilities\CardDeck;
use PokerProbabilities\Checker;
use PokerProbabilities\Generator;

require_once 'vendor/autoload.php';

$deck = new CardDeck();

//$pokerGame = new PokerGame($deck, 2);

//echo Printer::printGame($pokerGame) . PHP_EOL;
//echo Printer::printShortDeck($pokerGame->getDeck()) . PHP_EOL;

//foreach ($pokerGame->getPlayers() as $player) {
//    echo Printer::printShortCards($player->getPocketCards()) .
//        ' pair: ' . (int)Checker::checkPair($player->getPocketCards()) .
//        ' suit: ' . (int)Checker::checkSuit($player->getPocketCards()) . PHP_EOL;
//}

$pairCount = 0;
$suitCount = 0;
$pairAcesCount = 0;
$aceKingCount = 0;
$hands = 100000;

for ($i = 0; $i < $hands; $i++) {
    $cards = Generator::generateRandomPair();
    $pairCount += (int)Checker::checkPair($cards);
    $pairAcesCount += (int)Checker::checkPairAces($cards);
    $aceKingCount += (int)Checker::checkAceKing($cards);
    $suitCount += (int)Checker::checkSuit($cards);
}

echo 'Pairs probability = ' . 100 * ($pairCount / $hands). PHP_EOL;
echo 'Pair Aces probability = ' . 100 * ($pairAcesCount / $hands) . PHP_EOL;
echo 'Ace King probability = ' . 100 * ($aceKingCount / $hands) . PHP_EOL;
echo 'Suit probability = ' . 100 * ($suitCount / $hands). PHP_EOL;