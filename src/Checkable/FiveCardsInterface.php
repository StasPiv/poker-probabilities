<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 24.11.18
 * Time: 21:27
 */

namespace PokerProbabilities\Checkable;

interface FiveCardsInterface extends CheckableInterface
{
    public function getKickerWeight(): int;

    public function setKickerWeight(int $weight);

    public function setBaseWeight(int $weight);

    public function getBaseWeight(): int;

    public function setResult(string $result);

    public function setCombination(string $combination);

    public function getCombination(): string ;

    public function getResult(): string ;
}