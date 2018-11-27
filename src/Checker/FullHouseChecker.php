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

class FullHouseChecker implements FiveCardsCheckerInterface
{
    /**
     * @var FiveCardsInterface
     */
    protected $fiveCards;

    protected $matched = false;

    protected $checked = false;

    protected $tripsWeights = [];
    
    protected $pairWeights = [];

    public function getName(): string
    {
        return PokerCombination::FULL_HOUSE;
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
            $this->tripsWeights = $this->countTripsWeights($ranks);
            $this->pairWeights = $this->countPairsWeights($ranks);
            $this->checked = true;
            return $this->matched = 
                (new OnePairChecker($this->fiveCards))->check() && 
                (new TripsChecker($this->fiveCards))->check();
        }

        return $this->matched;
    }

    public function printResult(): string
    {
        if (!$this->check()) {
            return '';
        }

        switch (key($this->tripsWeights)) {
            case CardRank::TWO:
                $tripsRank = 'twos';
                break;
            case CardRank::THREE:
                $tripsRank = 'threes';
                break;
            case CardRank::FOUR:
                $tripsRank = 'fours';
                break;
            case CardRank::FIVE:
                $tripsRank = 'fives';
                break;
            case CardRank::SIX:
                $tripsRank = 'sixs';
                break;
            case CardRank::SEVEN:
                $tripsRank = 'sevens';
                break;
            case CardRank::EIGHT:
                $tripsRank = 'eights';
                break;
            case CardRank::NINE:
                $tripsRank = 'nines';
                break;
            case CardRank::TEN:
                $tripsRank = 'tens';
                break;
            case CardRank::JACK:
                $tripsRank = 'jacks';
                break;
            case CardRank::QUEEN:
                $tripsRank = 'queens';
                break;
            case CardRank::KING:
                $tripsRank = 'kings';
                break;
            case CardRank::ACE:
                $tripsRank = 'aces';
                break;
            default:
                throw new \RuntimeException('Unknown trips');
        }

        switch (key($this->pairWeights)) {
            case CardRank::TWO:
                $pairRank = 'twos';
                break;
            case CardRank::THREE:
                $pairRank = 'threes';
                break;
            case CardRank::FOUR:
                $pairRank = 'fours';
                break;
            case CardRank::FIVE:
                $pairRank = 'fives';
                break;
            case CardRank::SIX:
                $pairRank = 'sixs';
                break;
            case CardRank::SEVEN:
                $pairRank = 'sevens';
                break;
            case CardRank::EIGHT:
                $pairRank = 'eights';
                break;
            case CardRank::NINE:
                $pairRank = 'nines';
                break;
            case CardRank::TEN:
                $pairRank = 'tens';
                break;
            case CardRank::JACK:
                $pairRank = 'jacks';
                break;
            case CardRank::QUEEN:
                $pairRank = 'queens';
                break;
            case CardRank::KING:
                $pairRank = 'kings';
                break;
            case CardRank::ACE:
                $pairRank = 'aces';
                break;
            default:
                throw new \RuntimeException('Unknown pair');
        }

        return $this->check() ? 'Full house from ' . $tripsRank . ' and ' . $pairRank : '';
    }

    public function boldCards(): void
    {
        if (!$this->check()) {
            return;
        }

        foreach ($this->fiveCards->getCards() as $card) {
            $card->setBolded(true);
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
        return $count === 3;
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
    private function countTripsWeights($ranks): array
    {
        $tripsWeights = [];

        foreach ($ranks as $rank => $rankCount) {
            if ($rankCount === 3) {
                $tripsWeights[$rank] = $rank;
            }
        }

        return $tripsWeights;
    }

    /**
     * @param $ranks
     * @return array
     */
    private function countPairsWeights($ranks): array
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
        if ($this->check()) {
            return pow(10, 7) + 100 * pow(2, key($this->tripsWeights)) + 10 * pow(2, key($this->pairWeights));
        }

        return 0;
    }
}