<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 12.11.18
 * Time: 12:33
 */

namespace PokerProbabilities;


class PokerGame
{
    /**
     * @var CardDeck
     */
    protected $deck;

    /**
     * @var PokerPlayer[]|array
     */
    protected $players;

    /**
     * @var int
     */
    protected $countOfPlayers = 2;

    /**
     * PokerGame constructor.
     * @param CardDeck $deck
     * @param int $countOfPlayers
     */
    public function __construct(CardDeck $deck, int $countOfPlayers = 2)
    {
        $this->deck = $deck;
        $this->countOfPlayers = $countOfPlayers;
        $this->createPlayers();
    }

    /**
     * @return array|PokerPlayer[]
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @return CardDeck
     */
    public function getDeck(): CardDeck
    {
        return $this->deck;
    }

    protected function createPlayers()
    {
        for ($i = 0; $i < $this->countOfPlayers; $i++) {
            $this->players[$i] = new PokerPlayer(
                'Player ' . $i,
                [
                    $this->deck->getRandomCard(),
                    $this->deck->getRandomCard()
                ]
            );
        }
    }
}