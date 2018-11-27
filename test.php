<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 12.11.18
 * Time: 12:14
 */

use PokerProbabilities\CardDeck;
use PokerProbabilities\CardFactory;
use PokerProbabilities\CardRank;
use PokerProbabilities\Checkable\Flop;
use PokerProbabilities\Checkable\Pair;
use PokerProbabilities\Checkable\PairAndFlop;
use PokerProbabilities\Checkable\PairAndFlopAndTurn;
use PokerProbabilities\Checkable\PairAndFlopAndTurnAndRiver;
use PokerProbabilities\Checkable\River;
use PokerProbabilities\Checkable\Turn;
use PokerProbabilities\Checker\BothRanksOrPairChecker;
use PokerProbabilities\Checker\BothRanksRankChecker;
use PokerProbabilities\Checker\CheckerFactory;
use PokerProbabilities\Checker\FullChecker;
use PokerProbabilities\Checker\KickerWeightCalculator;
use PokerProbabilities\Checker\OneOfRanksRankChecker;
use PokerProbabilities\Checker\OnePairChecker;
use PokerProbabilities\Checker\PairChecker;
use PokerProbabilities\Checker\SpecificRankChecker;
use PokerProbabilities\Checker\SuitChecker;
use PokerProbabilities\Checker\TripsChecker;
use PokerProbabilities\Checker\TwoPairChecker;
use PokerProbabilities\Generator;
use PokerProbabilities\PocketRange;
use PokerProbabilities\PokerCombination;
use PokerProbabilities\Printer;
use PokerProbabilities\Splitter\SplitterBasedOnSeven;
use PokerProbabilities\Splitter\SplitterBasedOnSix;

require_once 'vendor/autoload.php';

//$myPocketPairString = '10d;9d';
//$flopString = '10s;Js;Qs';
//$turnString = 'Ah';
//$riverString = '8c';

//$pocketPair = new Pair(CardFactory::createCards($myPocketPairString));
//$flop = new Flop(CardFactory::createCards($flopString));
//$turn = new Turn(CardFactory::createCard($turnString));
//$river = new River(CardFactory::createCard($riverString));
//
//$myHandAfterFlop = new PairAndFlop($pocketPair, $flop);
//$myHandAfterFlopAndTurn = new PairAndFlopAndTurn($pocketPair, $flop, $turn);
//$myHandAfterFlopAndTurnAndRiver = new PairAndFlopAndTurnAndRiver($pocketPair, $flop, $turn, $river);
//
//$splitterBasedOnSix = new SplitterBasedOnSix($myHandAfterFlopAndTurn);
//$allFiveCards = $splitterBasedOnSix->getAllFiveCards();
//
//print_r(FullChecker::checkHandFrom5Cards($myHandAfterFlop, true));
//print_r(FullChecker::checkHandFrom6Cards($myHandAfterFlopAndTurn, true));
//print_r(FullChecker::checkHandFrom7Cards($myHandAfterFlopAndTurnAndRiver, true));

$myPocketPairString = '2h;8c';

$opponentRange = [
//    'Jh;Jd',
    '6d;7d'
];

$deck = new CardDeck();

//$deck->removeCardByString('10d');
//echo Printer::printCheckable($deck) . PHP_EOL;
//$deck->restoreCardByString('10d');
//echo Printer::printCheckable($deck) . PHP_EOL;
//$randomCard = $deck->getRandomCard();
//echo Printer::printShortCard($randomCard, true) . PHP_EOL;
//echo Printer::printCheckable($deck) . PHP_EOL;
//return;

$pocketPair = new Pair(CardFactory::createCards($myPocketPairString));
foreach ($pocketPair->getCards() as $card) {
    $deck->removeCard($card);
}

$hands = 100000;
$iWin = 0;
$kicker = 0;
$onePair = 0;
$twoPairs = 0;
$trips = 0;
$street = 0;
$flash = 0;
$fullHouse = 0;
$kare = 0;
$streetFlash = 0;
$royalFlash = 0;
$opponentWin = 0;
$tie = 0;

for ($i=0; $i< $hands; $i++) {
    $pocketPair = Generator::generateRandomPairForDeck($deck);

    $flop = Generator::generateRandomFlopForDeck($deck);
    $turn = Generator::generateRandomTurnForDeck($deck);
    $river = Generator::generateRandomRiverForDeck($deck);

    $deck->removeCards($pocketPair);
    $deck->removeCards($flop);
    $deck->removeCards($turn);
    $deck->removeCards($river);

    $myFlopHand = new PairAndFlop($pocketPair, $flop);

    $myRiverHand = new PairAndFlopAndTurnAndRiver($pocketPair, $flop, $turn, $river);

    $myResult = FullChecker::checkHandFrom7Cards($myRiverHand, true);

    $deck->restoreCards($pocketPair);
    $deck->restoreCards($flop);
    $deck->restoreCards($turn);
    $deck->restoreCards($river);

    if ($myResult->getCombination() === PokerCombination::KICKER) {
        $kicker++;
    }

    if ($myResult->getCombination() === PokerCombination::PAIR) {
        $onePair++;
    }

    if ($myResult->getCombination() === PokerCombination::TWO_PAIRS) {
        $twoPairs++;
    }

    if ($myResult->getCombination() === PokerCombination::TRIPS) {
        $trips++;
    }

    if ($myResult->getCombination() === PokerCombination::STREET) {
        $street++;
    }

    if ($myResult->getCombination() === PokerCombination::FLASH) {
        $flash++;
    }


    if ($myResult->getCombination() === PokerCombination::FULL_HOUSE) {
        $fullHouse++;
    }

    if ($myResult->getCombination() === PokerCombination::KARE) {
        $kare++;
    }

    if ($myResult->getCombination() === PokerCombination::STREET_FLASH) {
        $streetFlash++;

        if ($myResult->getResult() === 'This is royale flash') {
            $royalFlash++;
        }
    }
}

echo 'Kicker: ' . 100 * ($kicker / $hands) . PHP_EOL;
echo 'One pair: ' . 100 * ($onePair / $hands) . PHP_EOL;
echo 'Two pairs: ' . 100 * ($twoPairs / $hands) . PHP_EOL;
echo 'Trips: ' . 100 * ($trips / $hands) . PHP_EOL;
echo 'Street: ' . 100 * ($street / $hands) . PHP_EOL;
echo 'Flash: ' . 100 * ($flash / $hands) . PHP_EOL;
echo 'Full house: ' . 100 * ($fullHouse / $hands) . PHP_EOL;
echo 'Kare: ' . 100 * ($kare / $hands) . PHP_EOL;
echo 'Street flash: ' . 100 * ($streetFlash / $hands) . PHP_EOL;
echo 'Royal flash: ' . 100 * ($royalFlash / $hands) . PHP_EOL;
