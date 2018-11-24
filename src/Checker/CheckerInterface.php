<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 13.11.18
 * Time: 12:15
 */

namespace PokerProbabilities\Checker;

use PokerProbabilities\Checkable\CheckableInterface;

interface CheckerInterface
{
    public function check(CheckableInterface $checkable);
}