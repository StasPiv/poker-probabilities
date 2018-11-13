<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 12.11.18
 * Time: 12:35
 */

namespace PokerProbabilities;


class Printer
{
    static public function printRank(int $rank)
    {
        switch ($rank) {
            case CardRank::TWO:
            case CardRank::THREE:
            case CardRank::FOUR:
            case CardRank::FIVE:
            case CardRank::SIX:
            case CardRank::SEVEN:
            case CardRank::EIGHT:
            case CardRank::NINE:
            case CardRank::TEN:
                return $rank;
            case CardRank::JACK:
                return 'Jack';
            case CardRank::QUEEN:
                return 'Queen';
            case CardRank::KING:
                return 'King';
            case CardRank::ACE:
                return 'Ace';
            default:
                throw new \RuntimeException('Unknown rank: ' . $rank);
        }
    }

    static public function printSuit(int $suit)
    {
        switch ($suit) {
            case CardSuit::HEART:
                return 'Heart';
            case CardSuit::DIAMOND:
                return 'Diamond';
            case CardSuit::CLUB:
                return 'Club';
            case CardSuit::SPADE:
                return 'Spade';
            default:
                throw new \RuntimeException('Unknown suit: ' . $suit);
        }
    }

    static public function printShortRank(int $rank)
    {
        switch ($rank) {
            case CardRank::TWO:
            case CardRank::THREE:
            case CardRank::FOUR:
            case CardRank::FIVE:
            case CardRank::SIX:
            case CardRank::SEVEN:
            case CardRank::EIGHT:
            case CardRank::NINE:
            case CardRank::TEN:
                return $rank;
            case CardRank::JACK:
                return 'J';
            case CardRank::QUEEN:
                return 'Q';
            case CardRank::KING:
                return 'K';
            case CardRank::ACE:
                return 'A';
            default:
                throw new \RuntimeException('Unknown rank: ' . $rank);
        }
    }

    static public function printShortSuit(int $suit)
    {
        switch ($suit) {
            case CardSuit::HEART:
                return 'h';
            case CardSuit::DIAMOND:
                return 'd';
            case CardSuit::CLUB:
                return 'c';
            case CardSuit::SPADE:
                return 's';
            default:
                throw new \RuntimeException('Unknown suit: ' . $suit);
        }
    }

    static public function printCard(Card $card)
    {
        return self::printRank($card->getRank()) . ' of ' . self::printSuit($card->getSuit());
    }

    static public function printShortCard(Card $card)
    {
        return self::printShortRank($card->getRank()) . self::printShortSuit($card->getSuit());
    }

    static public function printShortDeck(CardDeck $deck)
    {
        return implode(
            ' ',
            array_map(
                function (Card $card) {
                    return self::printShortCard($card);
                },
                $deck->getCards()
            )
        );
    }

    /**
     * @param Card[]|array $cards
     * @return array
     */
    static public function printShortCards(array $cards)
    {
        return implode(
            ' ',
            array_map(
                function (Card $card) {
                    return self::printShortCard($card);
                },
                $cards
            )
        );
    }

    static public function printGame(PokerGame $game) {
        return implode(
            PHP_EOL,
            array_map(
                function (PokerPlayer $player)
                {
                    return $player->getName() . ': ' . self::printShortCards($player->getPocketCards());
                },
                $game->getPlayers()
            )
        );
    }
}