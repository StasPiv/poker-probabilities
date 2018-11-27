<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 24.11.18
 * Time: 23:28
 */

namespace PokerProbabilities;


class CardFactory
{
    public static function createCard(string $cardString): Card
    {
        $suitString = substr($cardString, strlen($cardString) - 1, 1);
        $rankString = rtrim($cardString, 'hdcs');
        $rank = self::createRank($rankString);
        $suit = self::createSuit($suitString);

        if ($rankString.$suitString !== $cardString) {
            throw new \RuntimeException('Unknown card: ' . $cardString . '. Rank:' . $rankString . '. Suit:' . $suitString);
        }

        if (!in_array($rank, CardRank::getAll())) {
            throw new \RuntimeException('Unknown rank: ' . $rankString);
        }

        if (!in_array($suit, CardSuit::getAll())) {
            throw new \RuntimeException('Unknown suit: ' . $rankString);
        }

        return new Card($rank, self::createSuit($suitString));
    }

    public static function createCards(string $cardsString)
    {
        return array_map(
            function (string $cardString) {
                return self::createCard($cardString);
            },
            explode(';', $cardsString)
        );
    }

    public static function createSuit(string $suitString): int
    {
        switch ($suitString) {
            case 'h':
                return CardSuit::HEART;
            case 'd':
                return CardSuit::DIAMOND;
            case 'c':
                return CardSuit::CLUB;
            case 's':
                return CardSuit::SPADE;
            default:
                throw new \RuntimeException('Unknown suit: ' . $suitString);
        }
    }

    public static function createRank(string $rankString): int
    {
        switch ($rankString) {
            case 'A':
            case CardRank::ACE:
                return CardRank::ACE;
            case 'K':
            case CardRank::KING:
                return CardRank::KING;
            case 'Q':
            case CardRank::QUEEN:
                return CardRank::QUEEN;
            case 'J':
            case CardRank::JACK:
                return CardRank::JACK;
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
            case '7':
            case '8':
            case '9':
            case '10':
                return (int)$rankString;
            default:
                throw new \RuntimeException('Unknown rank: ' . $rankString);
        }
    }
}