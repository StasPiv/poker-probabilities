<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 24.11.18
 * Time: 21:33
 */

namespace PokerProbabilities\Checker;

use PokerProbabilities\CardRank;
use PokerProbabilities\Checkable\CheckableInterface;
use PokerProbabilities\Checkable\FiveCardsInterface;
use PokerProbabilities\PokerCombination;

class TwoPairChecker implements FiveCardsCheckerInterface
{
    /**
     * @var FiveCardsInterface
     */
    protected $fiveCards;

    protected $matched = false;

    protected $checked = false;

    protected $pairWeights = [];

    public function getName(): string
    {
        return PokerCombination::TWO_PAIRS;
    }

    /**
     * OnePairChecker constructor.
     * @param FiveCardsInterface $fiveCards
     */
    public function __construct(FiveCardsInterface $fiveCards)
    {
        $this->fiveCards = $fiveCards;
    }

    /**
     * @return bool
     */
    public function isMatched(): bool
    {
        return $this->matched;
    }

    public function getFiveCards(): FiveCardsInterface
    {
        return $this->fiveCards;
    }

    public function check(): bool
    {
        if (!$this->checked) {
            $ranks = $this->countRanks($this->getFiveCards());
            $this->pairWeights = $this->countPairWeights($ranks);
            return $this->matched = count($this->pairWeights) === 2;
        }

        return $this->matched;
    }

    public function printResult(): string
    {
        if (!$this->check()) {
            return '';
        }

        reset($this->pairWeights);
        ksort($this->pairWeights);
        $reversedPairWeights = array_reverse($this->pairWeights, true);
        $pairRanks = [];

        foreach ($reversedPairWeights as $pairRank => $pairWeight) {
            switch ($pairRank) {
                case CardRank::TWO:
                    $firstPairRank = 'twos';
                    break;
                case CardRank::THREE:
                    $firstPairRank = 'threes';
                    break;
                case CardRank::FOUR:
                    $firstPairRank = 'fours';
                    break;
                case CardRank::FIVE:
                    $firstPairRank = 'fives';
                    break;
                case CardRank::SIX:
                    $firstPairRank = 'sixs';
                    break;
                case CardRank::SEVEN:
                    $firstPairRank = 'sevens';
                    break;
                case CardRank::EIGHT:
                    $firstPairRank = 'eights';
                    break;
                case CardRank::NINE:
                    $firstPairRank = 'nines';
                    break;
                case CardRank::TEN:
                    $firstPairRank = 'tens';
                    break;
                case CardRank::JACK:
                    $firstPairRank = 'jacks';
                    break;
                case CardRank::QUEEN:
                    $firstPairRank = 'queens';
                    break;
                case CardRank::KING:
                    $firstPairRank = 'kings';
                    break;
                case CardRank::ACE:
                    $firstPairRank = 'aces';
                    break;
                default:
                    throw new \RuntimeException('Unknown pair');
            }

            $pairRanks[] = $firstPairRank;
        }

        return $this->check() ? 'Two pairs of ' . implode(' and ', $pairRanks) : '';
    }

    public function boldCards(): void
    {
        if (!$this->check()) {
            return;
        }

        foreach ($this->fiveCards->getCards() as $card) {
            $card->setBolded(false);
        }

        foreach ($this->fiveCards->getCards() as $card) {
            if (in_array($card->getRank(), array_keys($this->pairWeights))) {
                $card->setBolded(true);
            }
        }
    }

    /**
     * This function returns true if rank compare is passed
     *
     * @param int $count
     * @param int $rank
     * @return bool
     */
    protected function checkCount(int $count, int $rank)
    {
        return $count === 2;
    }

    /**
     * @param CheckableInterface $checkable
     * @return array
     */
    protected function countRanks(CheckableInterface $checkable): array
    {
        $ranks = [
            CardRank::TWO => 0,
            CardRank::THREE => 0,
            CardRank::FOUR => 0,
            CardRank::FIVE => 0,
            CardRank::SIX => 0,
            CardRank::SEVEN => 0,
            CardRank::EIGHT => 0,
            CardRank::NINE => 0,
            CardRank::TEN => 0,
            CardRank::JACK => 0,
            CardRank::QUEEN => 0,
            CardRank::KING => 0,
            CardRank::ACE => 0,
        ];

        foreach ($checkable->getCards() as $card) {
            $ranks[$card->getRank()]++;
        }

        return $ranks;
    }

    /**
     * @param $countRanks
     * @return bool
     */
    protected function checkCounts($countRanks): bool
    {
        return !empty(
        array_filter(
            $countRanks,
            [$this, 'checkCount'],
            ARRAY_FILTER_USE_BOTH
        )
        );
    }

    /**
     * @param $ranks
     * @return array
     */
    private function countPairWeights($ranks): array
    {
        $pairWeights = [];

        foreach ($ranks as $rank => $rankCount) {
            if ($rankCount === 2) {
                $pairWeights[$rank] = $rank;
            }
        }

        return $pairWeights;
    }

    public function getWeight(): int
    {
        if (!$this->check()) {
            return 0;
        }

        reset($this->pairWeights);
        ksort($this->pairWeights);

        $weightIndex = 2;
        $weight = 0;

        foreach ($this->pairWeights as $pairRank => $pairWeight) {
            $weight += pow(10, $weightIndex++) * $pairRank;
        }

        return $weight;
    }
}