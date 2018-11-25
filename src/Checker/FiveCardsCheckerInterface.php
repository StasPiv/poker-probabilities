<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 24.11.18
 * Time: 20:59
 */

namespace PokerProbabilities\Checker;

use PokerProbabilities\Checkable\FiveCardsInterface;

interface FiveCardsCheckerInterface
{
    public function check(): bool ;

    public function boldCards(): void ;

    public function printResult(): string ;

    public function getFiveCards(): FiveCardsInterface;

    public function getWeight(): int;
}