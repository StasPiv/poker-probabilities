<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 12.11.18
 * Time: 12:14
 */

namespace PokerProbabilities;


class PokerPlayer
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Card[]
     */
    protected $pocketCards;

    /**
     * PokerPlayer constructor.
     * @param string $name
     * @param Card[] $pocketCards
     */
    public function __construct(string $name, array $pocketCards)
    {
        $this->name = $name;

        if (count($pocketCards) !== 2) {
            throw new \RuntimeException('Count of pocket cards should be 2');
        }

        if ($pocketCards[0]->isEqual($pocketCards[1])) {
            throw new \RuntimeException('Pocket cards should be different');
        }

        $this->pocketCards = $pocketCards;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Card[]
     */
    public function getPocketCards(): array
    {
        return $this->pocketCards;
    }
}