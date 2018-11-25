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
use PokerProbabilities\Checker\BothRanksOrPairChecker;
use PokerProbabilities\Checker\BothRanksRankChecker;
use PokerProbabilities\Checker\CheckerFactory;
use PokerProbabilities\Checker\OneOfRanksRankChecker;
use PokerProbabilities\Checker\OnePairChecker;
use PokerProbabilities\Checker\PairChecker;
use PokerProbabilities\Checker\SpecificRankChecker;
use PokerProbabilities\Checker\SuitChecker;
use PokerProbabilities\Checker\TripsChecker;
use PokerProbabilities\Checker\TwoPairChecker;
use PokerProbabilities\Generator;
use PokerProbabilities\Printer;

require_once 'vendor/autoload.php';

$myPocketPairString = 'As;Ks';
$opponentPocketPairString = '2h;2c';

$flopString = '10s;Js;Qs';

$myPocketPair = new Pair(CardFactory::createCards($myPocketPairString));
$opponentPocketPair = new Pair(CardFactory::createCards($opponentPocketPairString));

$myHandAfterFlop = new PairAndFlop($myPocketPair, new Flop(CardFactory::createCards($flopString)));
$opponentHandAfterFlop = new PairAndFlop($opponentPocketPair, new Flop(CardFactory::createCards($flopString)));

$myCheckers = [];
$opponentCheckers = [];

foreach ([
             'street flash',
             'kare',
             'full house',
             'flash',
             'street',
             'trips',
             'two pairs',
             'pair',
    ] as $checkerType) {
    $myChecker = CheckerFactory::createCheckerForFiveCards($checkerType, $myHandAfterFlop);
    $opponentChecker = CheckerFactory::createCheckerForFiveCards($checkerType, $opponentHandAfterFlop);

    $myCheckers[] = $myChecker;
    $opponentCheckers[] = $opponentChecker;

    $myChecker->boldCards();
    $opponentChecker->boldCards();

    if ($myChecker->check() || $opponentChecker->check()) {
        echo '-----------------' . PHP_EOL . strtoupper($checkerType) . PHP_EOL . '-----------------' . PHP_EOL;
    }

    if ($myChecker->check()) {
        echo 'My hand after flop (bolded): ' . Printer::printCheckable($myHandAfterFlop) . PHP_EOL;
        echo $myChecker->printResult() . PHP_EOL;
        echo 'Weight: ' . $myChecker->getWeight() . PHP_EOL;
    }

    if ($opponentChecker->check()) {
        echo 'Opponent hand after flop (bolded): ' . Printer::printCheckable($opponentHandAfterFlop) . PHP_EOL;
        echo $opponentChecker->printResult() . PHP_EOL;
        echo 'Weight: ' . $opponentChecker->getWeight() . PHP_EOL;
    }
}
