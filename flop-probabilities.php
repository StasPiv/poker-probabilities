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
use PokerProbabilities\Checker\OnePairChecker;
use PokerProbabilities\Checker\PairChecker;
use PokerProbabilities\Checker\SpecificRankChecker;
use PokerProbabilities\Checker\SuitChecker;
use PokerProbabilities\Generator;
use PokerProbabilities\Printer;

require_once 'vendor/autoload.php';

$deck = new CardDeck();

$randomPair = Generator::generateRandomPairForDeck($deck);
$randomFlop = Generator::generateRandomFlopForDeck($deck);
$randomTurn = Generator::generateRandomTurnForDeck($deck);
$randomRiver = Generator::generateRandomRiverForDeck($deck);

$myHandAfterFlop = new \PokerProbabilities\Checkable\PairAndFlop($randomPair, $randomFlop);
$myHandAfterTurn = new \PokerProbabilities\Checkable\PairAndFlopAndTurn($randomPair, $randomFlop, $randomTurn);
$myHandAfterRiver = new \PokerProbabilities\Checkable\PairAndFlopAndTurnAndRiver($randomPair, $randomFlop,
    $randomTurn, $randomRiver);

echo 'My pocket cards: ' . Printer::printCheckable($randomPair) . PHP_EOL;
echo 'Flop: ' . Printer::printCheckable($randomFlop) . PHP_EOL;
echo 'My hand after flop: ' . Printer::printCheckable($myHandAfterFlop) . PHP_EOL;
//echo 'Turn: ' . Printer::printCheckable($randomTurn) . PHP_EOL;
//echo 'My hand after turn: ' . Printer::printCheckable($myHandAfterTurn) . PHP_EOL;
//echo 'River: ' . Printer::printCheckable($randomRiver) . PHP_EOL;
//echo 'My hand after river: ' . Printer::printCheckable($myHandAfterRiver) . PHP_EOL;

$onePairChecker = new OnePairChecker($myHandAfterFlop);

$onePairChecker->boldCards();

if ($onePairChecker->check()) {
    echo 'My hand after flop (bolded): ' . Printer::printCheckable($myHandAfterFlop) . PHP_EOL;
    echo $onePairChecker->printResult() . PHP_EOL;
    echo 'Weight: ' . $onePairChecker->getWeight() . PHP_EOL;
}
