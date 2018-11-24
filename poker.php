<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 12.11.18
 * Time: 12:14
 */

use PokerProbabilities\CardDeck;
use PokerProbabilities\CardRank;
use PokerProbabilities\Checker\BothRanksOrPairChecker;
use PokerProbabilities\Checker\BothRanksRankChecker;
use PokerProbabilities\Checker\OneOfRanksRankChecker;
use PokerProbabilities\Checker\RankChecker;
use PokerProbabilities\Checker\SpecificRankChecker;
use PokerProbabilities\Checker\SuitChecker;
use PokerProbabilities\Generator;

require_once 'vendor/autoload.php';

$deck = new CardDeck();

$pairChecker = new RankChecker();
$acesChecker = new SpecificRankChecker(CardRank::ACE);
$kingOrAceOrQueenChecker = new OneOfRanksRankChecker([CardRank::ACE, CardRank::KING, CardRank::QUEEN]);
$kingAndAceChecker = new BothRanksRankChecker([CardRank::ACE, CardRank::KING]);
$topCardsChecker = new BothRanksOrPairChecker([CardRank::ACE, CardRank::KING, CardRank::QUEEN]);
$suitChecker = new SuitChecker();

$pairCount = 0;
$suitCount = 0;
$pairAcesCount = 0;
$kingOrAceOrQueenCount = 0;
$kingAndAceCount = 0;
$topCardsCount = 0;
$hands = 100000;

for ($i = 0; $i < $hands; $i++) {
    $randomPair = Generator::generateRandomPair();
    $pairCount += $pairChecker->check($randomPair);
    $pairAcesCount += $acesChecker->check($randomPair);
    $kingOrAceOrQueenCount += $kingOrAceOrQueenChecker->check($randomPair);
    $kingAndAceCount += $kingAndAceChecker->check($randomPair);
    $topCardsCount += $topCardsChecker->check($randomPair);
    $suitCount += $suitChecker->check($randomPair);
}

echo 'Pairs probability = ' . 100 * ($pairCount / $hands). PHP_EOL;
echo 'Pair Aces probability = ' . 100 * ($pairAcesCount / $hands) . PHP_EOL;
echo 'King Or Ace Or Queen probability = ' . 100 * ($kingOrAceOrQueenCount / $hands) . PHP_EOL;
echo 'King And Ace probability = ' . 100 * ($kingAndAceCount / $hands) . PHP_EOL;
echo 'Top cards (ace,king,queen) probability = ' . 100 * ($topCardsCount / $hands) . PHP_EOL;
echo 'Suit probability = ' . 100 * ($suitCount / $hands). PHP_EOL;